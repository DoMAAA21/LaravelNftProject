<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Auth;
use View;
use App\Mail\ContactMail;
use Event;
use App\Events\SendMail;
class LoginController extends Controller
{


    public function showLogin()
    {
        return View::make('login.index');
    }
    public function login(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
          
        ]);
     
        $user = User::where('email', $request->email)->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }



   

    if(Auth::attempt(['email' => $request->input('email'),'password' => $request->password])){

        $r  = Auth::user()->role;
        $v = Auth::user()->email_verified_at;
        // dd($r);
            if($r == 'customer')
        {

          $token =  $user->createToken(time())->plainTextToken;

           return response()->json(["role" => "customer","success" => "Logged In.","token"=> $token, "user" => $user, "status" => 200,"verify" => $v]);

           // return response()->json(["token" => $token]);
          
        }
        else if($r == 'employee')
        {
            $token =  $user->createToken(time())->plainTextToken;

             return response()->json(["role" => "employee","success" => "Logged In.","token"=> $token, "user" => $user, "status" => 200]);
           
        }
        else
        {
            $token =  $user->createToken(time())->plainTextToken;

             return response()->json(["role" => "admin","success" => "Logged In.", "token"=> $token, "user" => $user, "status" => 200]);
        }

        
    } else{
      
    };
 
    
    
   
     
       
    }


    public function register(Request $request)
    {
        $user = User::create([
           
            'email' => $request->email,
             'role' => 'customer',
            'password' => Hash::make($request->password),
        ]);

        $last = DB::getPdo()->lastInsertId();
        $customer =  Customer::create([
            'user_id' => $last,
            'fname' =>$request->fname,
            'lname' =>$request->lname,
            'addressline' => $request->addressline,
            'town' => $request->town,
            'zipcode' => $request->zipcode,
            'phone' => $request->phone,
            'img_path' => 'default.jpg',
        ]);

        if(Auth::attempt(['email' => $request->input('email'),'password' => $request->password])){

            $user->createToken(time())->plainTextToken;

            $data = array(
                'sender'   => $request->fname.' '.$request->fname,
                'title'   =>  $request->title,
                'email'   =>   $request->email
                
            );

            // if (!$request->hasValidSignature()) {
            //     return response()->json(["msg" => "Invalid/Expired url provided."], 401);
            // }
        
            // $userv = User::findOrFail( $last);
        
            // if (!$userv->hasVerifiedEmail()) {
            //     $userv->markEmailAsVerified();
            // }
            

        auth()->user()->sendEmailVerificationNotification();
            // return redirect()->to('/');
            Event::dispatch(new SendMail($data));




            return response()->json(["role" => "customer","success" => "Logged In.","verify" => null, "user" => $user, "status" => 200]);

        }
    }


    public function logout(Request $request)
    {

    
        auth()->guard('web')->logout();
 
      $user = 'loggedout';
       return response()->json(["success" => "Logged Out", "user" => $user, "status" => 200]);
    }


    public function main()
    {


        return View::make('main');
        
    }


    public function refresh(Request $request)
    {
        // $r  = Auth::user()->role;

        //  dd($r);
        if(Auth::check())
        {
            $r=  Auth::user()->role;
            $user = 1;

            return response()->json(["role" => $r,"success" => "Logged In.", "user" => $user, "status" => 200]);
       



        }
        else
        {

            $user = 0;
            return response()->json(["role" => "no","success" => "Logged Out", "user" => $user, "status" => 200]);
        }
        

        
    }


    // public function verify($id, Request $request) {
    //     if (!$request->hasValidSignature()) {
    //         return response()->json(["msg" => "Invalid/Expired url provided."], 401);
    //     }
    
    //     $user = User::findOrFail($id);
    
    //     if (!$user->hasVerifiedEmail()) {
    //         $user->markEmailAsVerified();
    //     }
    
    //     return redirect()->to('/');
    // }
    
    // public function resend() {
    //     if (auth()->user()->hasVerifiedEmail()) {
    //         return response()->json(["msg" => "Email already verified."], 400);
    //     }
    
    //     auth()->user()->sendEmailVerificationNotification();
    
    //     return response()->json(["msg" => "Email verification link sent on your email id"]);
    // }
}
