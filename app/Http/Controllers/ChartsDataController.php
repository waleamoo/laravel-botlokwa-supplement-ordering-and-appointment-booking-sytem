<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Support\Facades\DB;
use DateTime;

class ChartsDataController extends Controller
{
    public function getAllMonths(){
        $month_array = array();
        $invoice_dates = Invoice::orderBy('created_at', 'ASC')->pluck('created_at');
        $invoice_dates = json_decode($invoice_dates);
        
        if(!empty($invoice_dates)){
            foreach($invoice_dates as $date){
                $date = new DateTime($date);
                $month_name = $date->format('M');
                $month_no = $date->format('m');
                $month_array[$month_no] = $month_name;
            }
        }
        return $month_array;
    }

    public function getMonthlySum($month){
        //$monthly_sum = Invoice::whereMonth('created_at', '=', $month)->sum('order_id');
        $monthly_sum = DB::table('invoices')->join('orders', 'orders.order_id', '=', 'invoices.order_id')
        ->whereMonth('invoices.created_at', '=', $month)->sum('orders.totalPrice');
        return $monthly_sum;
    }

    public function getMonthlyPostData(){
        $monthly_sum_array = array();
        $month_array = $this->getAllMonths();
        $month_name_array = array();
        if(!empty($month_array)){
            foreach($month_array as $month_no => $month_name){
                $monthly_sum = $this->getMonthlySum($month_no);
                array_push($monthly_sum_array, $monthly_sum);
                array_push($month_name_array, $month_name);
            }
        }
        $max_no = max($monthly_sum_array);
        $max = round(($max_no + 10/2) / 10) * 10;
        $monthly_post_data_array = array(
            'months' => $month_name_array,
            'month_sum' => $monthly_sum_array,
            'max' => $max
        );
        return $monthly_post_data_array;
    }
}
