<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Crypto;
use App\Models\Customer;
use View;
use DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Http\Client\Response;
use file;
use Auth;

class CryptoController extends Controller
{
    public function index(Request $request)

    {


      
    if(auth()->id() == null){
    
     $cryp = Crypto::orderby('crypto_id','ASC')->get();
      
      
      }
    else{


      if( Auth::user()->role == 'customer')
      {
        $customer =  Customer::where('user_id',auth()->id())->first();
        $cryp = Crypto::where('cus_id',$customer->id)->orderby('crypto_id','ASC')->get();
      }else
      {
        $cryp = Crypto::orderby('crypto_id','ASC')->get();
      }
     
   
    }



     //  $customer =  Customer::where('user_id',auth()->id())->first();
        // $cryp = Crypto::where('cus_id',1)->orderby('crypto_id','ASC')->get();
        return response()->json($cryp);
     
    }


    public function getCry()
    {
        
        return View::make('cryptos.index');
    }

    public function show()
    {

    }


   

    


    public function store(Request $request)
    {

      

       
    //     $cryp = new Crypto();
    
    //     $cryp->name = $request->name;
    //     $cryp->stock = $request->stock;
    //     $cryp->info = $request->info;
    //     $cryp->status = $request->status;
    //     $cryp->founder = $request->status;


    //     $cont = new CryptoController();
    //     $price =  $cont->pointing($request->points);
    //     $cryp->save();


    //     $lid = DB::getPdo()->lastInsertId();
    //     DB::table('crypto_points')->insert(
    //         ['crypto_id' => $lid, 
    //         'points' => $request->points,
    //         'price' => $price]
    //     );
     

       
    //    $files = $request->file('uploads');
   
    //    $cryp->img_path = time().'-'.$files->getClientOriginalName();
    //    $cryp->save();
    //    $cryp->points = $request->points;
    //    $cryp->price = $price;
    //    $data = array('status' => 'saved');
    //    Storage::put(time().'-'.$files->getClientOriginalName(), file_get_contents($files));
    //    return response()->json(["success" => "Crypto Created Successfully.", "crypto" => $cryp, "status" => 200]);

    }


    
    public function destroy($id)
    {
        $cryp = Crypto::findOrFail($id);
        $client = new GuzzleClient();
        $reqs = $client->get('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd');
         //$res = $reqs->json();
       // $res = $reqs->getBody('id')->getContents();

       $reqs = json_decode($reqs->getBody(), true);
     
              //  dd($reqs->where('id', $cryp->crypto_id));

                $hat=collect($reqs);

                $filtered = $hat->where('id', $cryp->crypto_id)->toArray();
               $key = array_key_first($filtered);
                //dd($key);
               //dd( $filtered[$key]['current_price']);

               $lprc = $cryp->qty * $cryp->price;
               $cprc = $cryp->qty * $filtered[$key]['current_price'];
               $profit = $cprc - $lprc;
  //dd($profit);

        DB::table('customers')
            ->where('user_id', auth()->id())
 
        ->increment('balance',(float) $profit) ;
       


          $cryp->delete();
      
    //      $data = array('success' =>'Deleted','code'=>'200');
       //  return response()->json($data);

         return response()->json(["profit"=> $profit, "success" => "Crypto Sold Successfully.", "crypto" => $cryp, "status" => 200]);
    }
    


    public function edit($id)
    {
        // $emp = Employee::join('users','employees.user_id','users.id')->Find($id);
       // $cryp= Crypto::join('crypto_points','cryptos.id','crypto_points.crypto_id')->select('cryptos.*','crypto_points.points','crypto_points.price')->Find($id);
        $cryp =Crypto::find($id);
        //dd($cryp);
        return response()->json($cryp);
    }


    public function update(Request $request, $id)
    {


   //   dd($request->all());
      $customer =  Customer::where('user_id',auth()->id())->first();
          $cryp = Crypto::find($id);

      $cqty = $request->qty ;


       if($cqty >= $cryp->qty)
       {
        $cqty =  $cryp->qty;



        DB::table('crypto_trade')->insert(
          ['crypto_id' => $request->crypto_id,
          'cus_id' => $customer->id,
          'qty' => $cqty,
          'lprice' => $request->lprice,
          'cprice' => $request->cprice,
          'img_path' => $cryp->img_path ]
        );




        $cryp->delete();


        return response()->json(["success" => "Crypto Put On Trade Successfully.", "crypto" => $cryp, "status" => 200]);



       }
       else
       {
        DB::table('crypto_owned')
        ->where('id',$id)
       
        ->decrement('qty',$request->qty);


        
        DB::table('crypto_trade')->insert(
          ['crypto_id' => $request->crypto_id,
          'cus_id' => $customer->id,
          'qty' => $request->qty,
          'lprice' => $request->lprice,
          'cprice' => $request->cprice,
          'img_path' => $cryp->img_path ]
        );

        return response()->json(["success" => "Crypto Put On Trade Successfully.", "crypto" => $cryp, "status" => 200]);

       }

    
          
  
       

    }


    public function all() {
        $response = $client->request('GET', 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd'); // Pass the third parameter as an array if you have to set headers
        $response = json_decode($response->getBody(), true); // The API response data
    
        // You should put your data in the loop.
        $data = collect($response); // So we create an collection to use helper methods
        $data->map(function ($item) {
    
            // Now, we can save the data to the database with two methods
    
            // Model:
            Crypto::create([
                'name' => $item['name'],
                'info' => 'hahahah',
                'stock' => 100000,
                'founder' => $item['name'],
                'img_path' => $item['image'],
            ]);
    
            
            DB::table('crypto_points')->insert([
                'column' => $item['key'],
            ]);
        });
    }
}
