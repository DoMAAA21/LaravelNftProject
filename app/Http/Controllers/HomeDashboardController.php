<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Passport\HasApiTokens;
use Auth;
use App\Models\Customer;
use DB;

class HomeDashboardController extends Controller
{
    public function index(Request $request)
    {
      //  $notif = DB::table('notifications')->orderBy('id','DESC')->get();
      //  dd('hatdog');


        if(auth()->id() == null){
    
            $notif = DB::table('notifications')->orderBy('id','DESC')->get();
            
            
            }
          else{

            if( Auth::user()->role == 'customer')
             {
      
              $cus = Customer::where('user_id',auth()->id())->first();
          
            $notif = DB::table('notifications')->where('cus_id',$cus->id)->get();
               }
            else
             {
              $notif = DB::table('notifications')->orderBy('id','DESC')->get();
              }
         
          }
      
      return response()->json($notif);
    }


    public function balance(Request $request)
    {
       
        if(auth()->id() == null){
    
          $bal = Customer::orderby('id','DESC')->get();
            
            
            }
          else{
      
            if( Auth::user()->role == 'customer')
            {
            $bal = Customer::where('user_id',auth()->id())->get();
            }
            else if( Auth::user()->role == 'employee')
            {
              $bal = Customer::orderby('id','DESC')->get();
            }
            else
            {
              $bal = Customer::orderby('id','DESC')->get();
            }
         
          }
      
      return response()->json($bal);
    }


    public function add(Request $request)
    {
      //dd($request->all());
      $cus = Customer::where('user_id',auth()->id())->first();
      $bal = $cus->balance + $request->add ;
      $cus->balance = $bal;
      $cus->save();
      //$bal = Customer::where('user_id',auth()->id())->increment('balance',$request->add);
      $message ="You deposited $". strval($request->add) . " to your account" ;
      DB::table('notifications')->insert(
      ['cus_id' => $cus->id, 
      'note' =>  $message]
  );
      
      return response()->json(["success" => "Crypto Traded Succesfuly.", "bal" => $bal, "status" => 200]);
    }
}
