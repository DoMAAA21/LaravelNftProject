<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ChartController extends Controller
{
    public function salesChart() {
        $customer = DB::table('orderline')->groupBy('crypto_id')->orderBy('total')->pluck(DB::raw('count(crypto_id) as total'),'crypto_id')->all();
        $labels = (array_keys($customer));
        
        $data= array_values($customer);
        // dd($customer, $data, $labels);
        return response()->json(array('data' => $data, 'labels' => $labels));
    }

    public function classChart() {
        
        $sales = DB::table('characters as c')
                    ->join('characterline as cl', 'c.id', 'cl.character_id')
                    ->groupBy('c.class')
                    ->orderBy('total')
                    ->pluck(DB::raw('count(c.class) as total'),'c.class')->all();
                    // ->select(DB::raw('monthname(oi.date_placed) as month, sum(ol.quantity * i.sell_price) as total'))
                    // ->groupBy('oi.date_placed')
                    // ->pluck('total','month')
                    // ->all();
                    
         //dd($sales);
        $labels = (array_keys($sales));
        
        $data= array_values($sales);
        // dd($sales, $data, $labels);
        return response()->json(array('data' => $data, 'labels' => $labels));

    }


    // public function index(Request $request)
    // {

    //     dd('hatdog');
    //     if(auth()->id() == null){
    
    //         $notif = DB::table('notifications')->orderBy('id','DESC')->get();
            
            
    //         }
    //       else{
      
    //         $cus = Customer::where('user_id',auth()->id())->first();
          
    //         $notif = DB::table('notifications')->where('cus_id',$cus->id)->orderBy('id','DESC')->get();
         
    //       }
      
    //   return response()->json($notif);
    // }

    public function topChart() {
        
        $sales = DB::table('customers as c')
                    ->join('crypto_owned as co', 'c.id', 'co.cus_id')
                    ->groupBy('c.fname')
                    ->orderBy('total')
                    ->pluck(DB::raw('count(co.cus_id) as total'),'c.fname')->all();
                    // ->select(DB::raw('monthname(oi.date_placed) as month, sum(ol.quantity * i.sell_price) as total'))
                    // ->groupBy('oi.date_placed')
                    // ->pluck('total','month')
                    // ->all();
                    
         //dd($sales);
        $labels = (array_keys($sales));
        
        $data= array_values($sales);
        // dd($sales, $data, $labels);
        return response()->json(array('data' => $data, 'labels' => $labels));

    }

    public function topcharChart() {
        
        $sales = DB::table('orderline as ol')
                    // ->join('orderline as ol', 'i.item_id', '=', 'ol.item_id')
                    // ->join('orderinfo as oi', 'ol.orderinfo_id', '=', 'oi.orderinfo_id')
                    ->select(DB::raw('monthname(ol.date) as month, sum(ol.qty) as total'))
                    ->groupBy('ol.date')
                    ->pluck('total','month')
                    ->all();




        $labels = (array_keys($sales));
        
        $data= array_values($sales);
       
        return response()->json(array('data' => $data, 'labels' => $labels));

    }



    public function topnftChart() {
        
        $sales = DB::table('characterline as cl')
                    ->select(DB::raw('monthname(cl.date) as month, count(cl.date) as total'))
                    ->groupBy('month')
                    ->pluck('total','month')
                    ->all();




        $labels = (array_keys($sales));
        
        $data= array_values($sales);
       
        return response()->json(array('data' => $data, 'labels' => $labels));

    }


    public function tradeChart() {
        
        $sales = DB::table('crypto_trade')->groupBy('crypto_id')
        ->orderBy('total')->pluck(DB::raw('count(crypto_id) as total'),'crypto_id')->all();




        $labels = (array_keys($sales));
        
        $data= array_values($sales);
       
        return response()->json(array('data' => $data, 'labels' => $labels));

    }




}
