<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Customer;
use App\Models\User;
use View;
use DB;
use Auth;
use File;
class CustomerController extends Controller
{
    public function index(Request $request)

    {


        // $char = Character::orderBy('id')->get();

        //$char = Customer::orderBy('id')->get();
        $char = Customer::join('users','customers.user_id','users.id')->select('customers.*','users.email')->orderBy('customers.id','DESC')->get();
        return response()->json($char);
     
    }


    public function getCus()
    {
        
        return View::make('customers.index');
    }

    public function show()
    {

    }

    public function store(Request $request)
    {

       // dd($request->all());

        //dd($request->all());
        $user = new User();
      //  $user->customer()->associate($lid);
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 'customer';
        $user->save();
        $lid = DB::getPdo()->lastInsertId();

        $customer = new Customer();
        $customer->users()->associate($lid);
        $customer->fname = $request->fname;
        $customer->lname = $request->lname;
        $customer->addressline = $request->addressline;
        $customer->town = $request->town;
        $customer->zipcode = $request->zipcode;
        $customer->phone = $request->phone;
       
      
       $user->sendEmailVerificationNotification();
       $files = $request->file('uploads');
      // $customer->img_path ='default.jpg';
       $customer->img_path = time().'-'.$files->getClientOriginalName();
       $customer->save();
       $customer->email =  $request->email;
       $data = array('status' => 'saved');
       Storage::put(time().'-'.$files->getClientOriginalName(), file_get_contents($files));
       return response()->json(["success" => "Customer Created Successfully.", "customer" => $customer, "status" => 200]);
   // return response()->json(["customer" => $customer, "status" => 200])->with('status', 'Customer Creater');
    }

    public function destroy($id)
    {
        
        $cus = Customer::findOrFail($id);
       
        if (File::exists("storage/".$cus->img_path)) {
            File::delete("storage/".$cus->img_path);
        }

        $cus->delete();
        $user = User::where('id',$cus->user_id)->delete();
        $data = array('success' =>'Deleted','code'=>'200');
        return response()->json($data);
    }
    


    public function edit($id)
    {
        $item = Customer::join('users','customers.user_id','users.id')->select('customers.*','users.email')->Find($id);
        
        return response()->json($item);
    }


    public function update(Request $request, $id)
    {


       // dd($id);
         $customer = Customer::find($id);

       // dd($request->all());
         $user = User::find($customer->user_id);
        //  $user->customer()->associate($lid);

        //dd($user);
          $user->email = $request->email;
          $user->password = bcrypt($request->password);
          $user->role = 'customer';
          $user->save();
        
  
         
          $customer->fname = $request->fname;
          $customer->lname = $request->lname;
          $customer->addressline = $request->addressline;
          $customer->town = $request->town;
          $customer->zipcode = $request->zipcode;
          $customer->phone = $request->phone;
         
        
        
      $files = $request->file('uploads');
  
       $customer->img_path = time().'-'.$files->getClientOriginalName();        
      //$customer->img_path = 'default.jpg';
         $customer->save();
         $customer->email =  $request->email;
         $data = array('status' => 'saved');
       Storage::put(time().'-'.$files->getClientOriginalName(), file_get_contents($files));
         return response()->json(["success" => "Customer Updated Successfully.", "customer" => $customer, "status" => 200]);











       
    }
}
