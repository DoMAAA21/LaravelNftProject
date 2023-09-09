<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Passport\HasApiTokens;
use Auth;
use Session;
use App\Models\User;
use View;
use Redirect;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected function login(Request $request) {
       
       // dd( $request->email);

    //     $user = User::where('email',$request->email)->first();
    //    // dd($user->id);
    //     Session::put('uid', $user->id);
    //   return view::make('home');


    $this->validate($request, [
        'email' => 'email| required',
        'password' => 'required| min:4'
    ]);
     if(Auth::attempt(['email' => $request->input('email'),'password' => $request->password])){

        $r  = Auth::user()->role;
        // dd($r);
            if($r == 'customer')
        {


            return Redirect::to('home');
        }
        else if($r == 'employee')
        {
           
            return Redirect::to('home');
        }
        else
        {
             return Redirect::to('home');
        }

        
    } else{
        return redirect()->back();
    };

      
    }
   

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
       
      
    }

    protected function loggedOut(Request $request) {
        return redirect()->route('login');
           }
}
