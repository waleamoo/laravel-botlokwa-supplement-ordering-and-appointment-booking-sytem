<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Cart;
use App\Invoice;
use App\Order;
use App\Service;
use App\Supplement;
use App\SupplementRating;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Session\Store;

class HomeController extends Controller
{

    public function home(){
        $supplements = DB::table('supplements')->orderBy('supplement_id', 'desc')->take(3)->get(); 
        
        return view('welcome', ['supplements' => $supplements]);
    }
    // finds the service details
    public function getService($id){
        $service = Service::find($id);
        return view('user.service', ['service' => $service]);
    }

    // finds the supplement details
    public function getSupplement($id){

        $supplements = DB::table('supplements')->where('supplement_id', $id)->get();
        $supplement_ratings = DB::table('supplement_ratings')->where('supplement_id', $id)->get();
        return view('shop.supplement-details', compact('supplements', 'supplement_ratings'));
    }

    public function getAllSupplements(){
        $supplements = DB::table('supplements')->paginate(6);
        return view('shop.supplements', ['supplements' => $supplements]);
    }

    // get the supplement category 
    public function getSupplementCategory($id){
        $supplements = DB::table('supplements')->where('supplement_category_id', $id)->paginate(6);
        //dd($supplements);
        return view('shop.supplements', ['supplements' => $supplements]);
    }

    // search supplement 
    public function getSearchSupplements(Request $request){
        if(!empty($request->input('searchSupplement'))){
            $search = $request->input('searchSupplement');
            $supplements = DB::table('supplements')->where("supplement_name", "like", "%$search%")
            ->orderBy('supplement_name', 'asc')->paginate(6);
            return view('shop.supplements', ['supplements' => $supplements]);

        }else{
            return redirect()->back()->with('error', 'Enter a supplement in the search box');
        }
    }
    // get the booking 
    public function getBooking(Request $request){
        // validate if the user is logged in or not and has a session id 
        if(!$request->session()->has('sid')){
            return redirect()->route('getLogin')->with('error', 'Please login here or create an account.');
        }

        // show the view with the available time slot opened for booking 
        $services = Service::all();
        $nine = $this->getBookingTimeCount('09:00:00');
        $eleven = $this->getBookingTimeCount('11:00:00');
        $one = $this->getBookingTimeCount('13:00:00');
        $three = $this->getBookingTimeCount('15:00:00');

        return view('booking.book', compact('one', 'three', 'nine', 'eleven', 'services'));
    }

    public function getBookingTimeCount($time){
        $date = new DateTime();
        $day = $date->format('d');
        $count = DB::table('bookings')
        ->whereDay('booking_date', '=', $day)
        ->where('booking_time', '=', $time)->get();
        $count = count($count);
        if($count < 1){
            $count = 0;
        }
        return $count;
    }

    public function postBooking(Request $request){
        // check if the user is registered 
        if(!$request->session()->has('sid')){
            return redirect()->route('getLogin')->with('error', 'Please login here or create an account.');
        }

        // check for time slot availability for the user chosen time 
        if(!$request->session()->has('booking')){

            // validate the number of patients per hour - only 5 patients per hour
            $time = $request->input('time');
            if($this->getBookingTimeCount($time) >= 5){
                return redirect()->back()->with("error", "$time is fully booked. Please choose another time");
            }

            // only one booking for a user per day
            if($this->getNumberOfDayBookings() > 0){
                return redirect()->back()->with("error", "You have placed a booking already");
            }

            // validate multiple bookings for a sesssion and a particular day
            if($this->getNumberOfDayBookings() > 0){
                return redirect()->back()->with('error', 'Multiple bookings not allowed');
            }

            // store the booking in a session 
            $booking = $request->session()->put('booking', $request->all()); // store the request data in a session name booking
            $bDate = new DateTime('tomorrow'); $bDate = $bDate->format('Y-m-d'); $request->session()->put('date', $bDate);
            $bName = DB::table('services')->where('id', Session::get('booking')['service'])->value('service_name'); $request->session()->put('service', $bName);
            $bPrice = DB::table('services')->where('id', Session::get('booking')['service'])->value('service_price'); $request->session()->put('price', $bPrice);
            
            // show the user booking preview 
            return view('booking.booking', ['booking' => $booking]);

        }else if($request->session()->has('booking')){
            return redirect()->back()->with('error', 'You have a booking been placed earlier');
        }

        
    }

    // get the number of booking in a day for a user 
    public function getNumberOfDayBookings(){
        $date = new DateTime();
        $day = $date->format('d');
        $count = DB::table('bookings')
        ->whereDay('created_at', '=', $day)
        ->where('user_id', '=', Auth::id())->get();
        $count = count($count);
        return $count;
    }

    public function deleteBooking(Request $request){
        $request->session()->flush();
        return redirect()->back()->with('success', 'Booking deleted successfully');
    }

    public function confirmBooking(){
        // validate multiple user confirmation booking for one session 
        $count = DB::table('bookings')
            ->where('session_id', Session::get('sid'))
            ->where('user_id', Auth::id())
            ->count();
        if($count > 0){
            return redirect()->back()->with('error', 'The booking has already been placed and confirmed.');
        }

        // insert a new booking to the database 
        $newBooking = new Booking([
            'booking_date' => Session::get('date'),
            'booking_time' => Session::get('booking')['time'],
            'user_id' => Auth::id(),
            'service_id' => Session::get('booking')['service'],
            'session_id' => Session::get('sid'),
            'status' => 'pending',
            'booking_total' => Session::get('price')
        ]);
        $newBooking->save();

        // make an invoice
        $invoice = new Invoice([
            'invoice_number' => time(),
            'invoice_date' => date('Y-m-d'),
            'order_id' => null,
            'booking_id' => $newBooking->id,
            'user_id' => Auth::id()
        ]);
            $invoice->save();
        // email the user the booking comfirmation
        $service_name = DB::table('services')->where('id', Session::get('booking')["service"])->value('service_name');

        $to_name = Auth::user()->first_name;
        $to_email = Auth::user()->email;
        $data = array(
            'name'=> Auth::user()->last_name, 
            "body" => "You booking has been confirmed as outlined below:",
            'booking_date' => Session::get('date'), 
            'booking_time' => Session::get('booking')["time"],
            'service_name' => $service_name,
            'booking_total' => Session::get('price')
        );

        Mail::send('email.booking', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                    ->subject('Booking Confirmation');
            $message->from('flannagan07@gmail.com','Botlokwa Health Care');
        });

        // redirect to the user profile with confirmation message 

        return redirect()->route('getProfile')->with('success', 'Booking successfully placed.');
    }

    public function getAppointment(){
        return view('booking.booking');
    }

    // add an item to the cart
    public function getAddToCart(Request $request, $id){
        $supplement = DB::table('supplements')->where('supplement_id', $id)->first();
        //$supplement = Supplement::where('supplement_id', $id)->get();
        //dd($supplement->supplement_id);
        //$supplement = Supplement::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($supplement, $supplement->supplement_id);
        $request->session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Item added to cart');
    }

    public function postReview(Request $request, $id){
        // get the post data 
        $this->validate($request, [
            'msg' => 'required|min:3'
        ]);
        
        $supplementRating = new SupplementRating([
            'supplement_id' => $id,
            'rating' => $request['rating'],
            'msg' => $request['msg']
        ]);
        $supplementRating->save();
        return redirect()->back()->with('success', 'Rating saved!');
    }

    public function getCart(){
        if (!Session::has('cart')) {
            return view('shop.cart');
        }
        // if the cart already exists 
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.cart', ['supplements' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getRemoveItem(Request $request, $id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if(count($cart->items) > 0){
            Session::put('cart', $cart);
        }else{
            Session::forget('cart');
        }
        return redirect()->route('getCart');
    }

    public function getCheckout(){
        if (!Session::has('cart')){
            return view('welcome');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('shop.checkout', ['total' => $total]);
    }

    public function postCheckout(Request $request){
        if (!Session::has('cart')){
            return view('welcomes');
        }

        // get cart items to checkout
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        // create a new order 
        $order = Order::create([
            'cart' => serialize($cart),
            'address' => $request->input('address'),
            'name' => $request->input('name'),
            'user_id' => Auth::id(),
            'payment_id' => mt_rand(),
            'status' => 'Pending',
            'totalPrice' => $cart->totalPrice
        ]);
        //$id = $order->id;
        //dd($id);

        // draft an invoice 
        $invoice = new Invoice();
        $invoice->invoice_number = time();
        $invoice->invoice_date = date('Y-m-d');
        
        $invoice->order_id = $order->id; // id for new order created above
        $invoice->booking_id = null;
        Auth::user()->invoices()->save($invoice);

        // get the cart times and email user 
        // retrieve the last order by the user 
        $orders = Auth::user()->orders->sortByDesc('order_id')->take(1);
        $orders->transform(function($order, $key){
            $order->cart = unserialize($order->cart);
            return $order;
        });

        // reduce the stock quantity from the inventory 
        //foreach($orders as $a){
           // $qty = $a["qty"];
            //dd($qty);
            //$sid = $order["item"]->supplement_id;
            //DB::table('supplements')->where('supplement_id', $order["item"]['supplement_id'])
            //->update(['qty_in_stock' => (int) 'qty_in_stock' - (int) $order["qty"] ]);
            //->decrement('qty_in_stock', $qty);
            //dd($sid);
        //}

        /*
        $to_name = Auth::user()->last_name;
        $to_email = Auth::user()->email;
        $data = array('orders' => $orders, 'name'=> $to_name, 'body' => 'We have received your order for the following item(s):', 'address' => $request->input('address'), 'receiver_name' => $request->input('name'));
            
        Mail::send('shop.email', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                    ->subject('Order Confirmation');
            $message->from('flannagan07@gmail.com', 'Botlokwa Health Care');
        });
        */

        // forget the session 
        Session::forget('cart');
        return redirect()->route('home')->with('success', 'Thanks for purchasing with Botlokwa.');
    }

}
