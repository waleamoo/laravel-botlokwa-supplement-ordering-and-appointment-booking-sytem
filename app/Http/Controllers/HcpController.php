<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Service;
use App\Supplement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Invoice;
use App\Order;
use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use DateTime;

class HcpController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:hcp'); 
    }
    
    // function to show dashboard
    public function getAdminDashboard()
    {
        $day = DB::table('orders')
                ->selectRaw('SUM(totalPrice) as total_sales')
                ->whereRaw("date_format(created_at, '%Y-%m-%d') = CURRENT_DATE")
                ->value('total_sales');
        $week = DB::table('orders')
                ->selectRaw('SUM(totalPrice) as total_sales')
                ->whereRaw("WEEK(date_format(created_at, '%Y-%m-%d')) = WEEK(CURRENT_DATE)")
                ->value('total_sales');
        $month = DB::table('orders')
                ->selectRaw('SUM(totalPrice) as total_sales')
                ->whereRaw("MONTH(date_format(created_at, '%Y-%m-%d')) = MONTH(CURRENT_DATE)")
                ->value('total_sales');

        
        $bweek = DB::table('bookings')
                ->selectRaw('SUM(booking_total) as total_sales')
                ->whereRaw("WEEK(date_format(created_at, '%Y-%m-%d')) = WEEK(CURRENT_DATE)")
                ->value('total_sales');
        $bmonth = DB::table('bookings')
                ->selectRaw('SUM(booking_total) as total_sales')
                ->whereRaw("MONTH(date_format(created_at, '%Y-%m-%d')) = MONTH(CURRENT_DATE)")
                ->value('total_sales');

        return view('hcp.dashboard', compact('day', 'week', 'month')); // only authenticated admin user has access
    }
    
    public function getChart(){
        return view('hcp.chart');
    }
    

    public function getAllBooking(){
        $books = Booking::orderBy('status', 'desc')->get();

        return view('hcp.booking', ['books' => $books]);
    }

    public function postAddService(Request $request){
        $service = new Service([
            'service_name' => $request->input('service_name'),
            'service_desc' => $request->input('service_desc'),
            'service_price' => $request->input('service_price')
        ]);
        $service->save();
        return redirect()->back()->with('success', 'Service added');
    }

    public function getCompleted(Request $request, $id){
        $booking = Booking::find($id);
        $booking->status = 'Completed';
        $booking->save();
        return redirect()->back()->with('success', 'Booking completed.');
    }

    public function getDelete(Request $request, $id){
        $booking = Booking::find($id);
        $booking->delete();
        return redirect()->back()->with('success', 'Booking deleted');;
    }

    public function getHcpLogout(Request $request){
        Auth::logout();
        $request->session()->flush();
        return redirect()->route("home");
    }

    public function getAddProduct(){
        // get all supplement 
        $supplements = Supplement::orderBy('qty_in_stock', 'desc')->get();

        return view('hcp.product-add', ['supplements' => $supplements]);
    }

    public function postAddProduct(Request $request){
        // get the file 
        if($request->hasFile('supplement_pic')){
            $fileNameWithExt = $request->file('supplement_pic')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('supplement_pic')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '-' . time() . '.' . $extension;
            $request->file('supplement_pic')->move('images', $fileNameToStore);

        }else{
            $fileNameToStore = 'noimage.jpg';
        }
        $supplement = new Supplement([
            'supplement_name' => $request['supplement_name'], 
            'supplement_price' => $request['supplement_price'], 
            'supplement_price_old' => null,
            'discount' => null,
            'rating' => null,
            'supplement_description' => $request['supplement_description'],
            'supplement_pic' => $fileNameToStore,
            'supplement_category_id' => $request['supCategory'],
            'qty_in_stock' => $request['qty_in_stock']
        ]);
        $supplement->save();
        // show a success message 
        return redirect()->back()->with('success', 'Supplement added to inventory.');
    }

    public function updateQuantity(Request $request, $id){
        //$supplement = Supplement::where('supplement_id', $id);
        $supplement = DB::table('supplements')->where('supplement_id', $id)->update(['qty_in_stock' => $request->input('qty')]);
        return redirect()->back()->with('success', 'Supplement updated.');
    }

    public function addSupplementDiscount(Request $request){
        // calculate discount
        $percentage = $request['discount'] / 100; // 3.9
        $amount = (int) DB::table('supplements')->where('supplement_id', $request['supplement_id'])->value('supplement_price');
        $discounted_price = $amount - ($amount * $percentage);
        // update the supplement 
        $supplement = DB::table('supplements')->where('supplement_id', $request['supplement_id'])
        ->update(['supplement_price' => $discounted_price, 'supplement_price_old' => $amount, 'discount' => $percentage]);
        return redirect()->back()->with('success', 'Supplement updated.');
    }

    public function getAdmin(){
        return view('hcp.admin');
    }

    public function getUser(){
        $users = User::all();
        return view('hcp.user', ['users' => $users]);
    }

    public function getOrder(){
        $orders = Order::orderBy('order_id', 'desc')->get();
        $orders->transform(function($order, $key){
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('hcp.order', ['orders' => $orders]);
    }

    public function getCompletedOrder(Request $request, $id){
        //$supplement = DB::table('supplements')->where('supplement_id', $id)->update(['qty_in_stock' => $request->input('qty')]);
        $order = DB::table('orders')->where('order_id', $id)->update(['status' => 'Completed']);
        return redirect()->back()->with('success', 'Order completed.');
    }
}
