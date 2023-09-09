<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use App\Models\Crypto;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use View;
use DB;
use file;
use PDF;
class CryptoTransactionController extends Controller
{
    public function index(Request $request)

    {

        
        $cryp = Crypto::join('crypto_points','cryptos.id','crypto_points.crypto_id')->where('status','available')->select('cryptos.*','crypto_points.points','crypto_points.price')->orderBy('id')->get();
        return response()->json($cryp);
     
    }


    public function postCheckout(Request $request){
        $items = json_decode($request->getContent(),true);
        Log::info(print_r($items, true));
          try {
            DB::beginTransaction();
            
             $customer =  Customer::where('user_id',auth()->id())->first();
           // $customer = 1;
            $bal = $customer->balance;
            //$tprc = 0;
            
          


            foreach($items as $item) {

              // $tprc +=  $item['price'];
              // if($bal > $tprc)
              // {
              //   throw new \Exception('Error message');
              // }
        
              DB::table('customers')
               ->where('user_id', auth()->id())
              
               ->decrement('balance',(float) $item['price']);

            
            DB::table('orderline')->insert(
                ['crypto_id' =>  $item['item_id'] , 
                'cus_id' =>     $customer->id,
                'qty'=> $item['quantity'],
                'date' => now()]
            );
 
            $c = Crypto::where([
              'cus_id' => $customer->id,
              'crypto_id' => $item['item_id'],
            ])->first();

            $message ="You bought ". strval($item['quantity']) . "pc(s) of " . $item['item_id'] ;
            DB::table('notifications')->insert(
              ['cus_id' => $customer->id, 
              'note' =>  $message]
          );

            if($c == null )
            {
              DB::table('crypto_owned')->insert(
                ['crypto_id' =>  $item['item_id'] , 
                'cus_id' =>     $customer->id,
                'qty'=> $item['quantity'],
                'price' => $item['price'],
                'img_path' => $item['image'],
                ]
            );
  
            }
            else
            {
              DB::table('crypto_owned')
               ->where('crypto_id', $item['item_id'])
               ->where('cus_id', $customer->id)
               ->increment('qty', $item['quantity']);
            }

          }

          
          $pdf = PDF::loadView('pdf');
        
         $hatdog =  $pdf->download('receipt.pdf');
        
         

            
          }
        catch (\Exception $e) {
              DB::rollback();
              return response()->json(array('status' => 'Order failed due to Insufficient Balance','code'=>409,'error'=>$e->getMessage()));
        }

       
      
          DB::commit();
          return response()->json(array('status' => 'Order Success','code'=>200,'pdf'=> $pdf));
      
        
    }


    public function trade()
    {
    $trade =  DB::table('crypto_trade')->get();

      return response()->json($trade);
    }



    public function tradecrypto($id)
    {


      try {
        DB::beginTransaction();
      $customer =  Customer::where('user_id',auth()->id())->first();

    $trade = DB::table('crypto_trade')->find($id);


    $crypto = Crypto::where('cus_id',$customer->id)->get();



    $c = Crypto::where([
      'cus_id' =>$customer->id,
      'crypto_id' => $trade->crypto_id,
    ])->first();

    if($c == null )
    {
      DB::table('crypto_owned')->insert(
        ['crypto_id' => $trade->crypto_id , 
        'cus_id' =>   $customer->id,
        'qty'=> $trade->qty,
        'price' => $trade->cprice,
        'img_path' => $trade->img_path,
        ]
    );

    }
    else
    {
      DB::table('crypto_owned')
       ->where('crypto_id', $trade->crypto_id)
       ->where('cus_id',$customer->id)
       ->increment('qty', $trade->qty);
    }
    $price = $trade->qty * $trade-> cprice;


    $message ="You bought ". strval($trade->qty) . "pc(s) of " . $trade->crypto_id ;
    DB::table('notifications')->insert(
      ['cus_id' => $customer->id, 
      'note' =>  $message]
  );








    DB::table('customers')
    ->where('user_id', auth()->id())
   
    ->decrement('balance', $price);


    DB::table('customers')
    ->where('user_id',  $trade->cus_id)
   
    ->increment('balance', $price);

    $message2 ="You sold your ". strval($trade->qty) . "pc(s) of " . $trade->crypto_id ;
    DB::table('notifications')->insert(
      ['cus_id' => $trade->cus_id, 
      'note' =>  $message2]
  );


     $trd = DB::table('crypto_trade')->delete($id);




    }
    catch (\Exception $e) {
          DB::rollback();
          return response()->json(array('status' => 'Order failed due to Insufficient Balance','code'=>409,'error'=>$e->getMessage()));
    }

   
  
      DB::commit();

    return response()->json(["success" => "Crypto Traded Succesfuly.", "trade" => $trade, "status" => 200]);
    }

}
