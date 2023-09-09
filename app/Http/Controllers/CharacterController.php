<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;
// use App\Models\Character;
// use App\Models\Customer;

// use View;
// use DB;
// use File;
// // use Illuminate\Support\Facades\Auth;
// use App\User;
// use Auth;
// use Session;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Passport\HasApiTokens;
use Auth;
use Session;
use App\Models\User;
use Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\Character;
use App\Models\Customer;
use View;
use File;
use Log;
use DB;
class CharacterController extends Controller
{

  

  public function id(Request $request,$id)

  {

  }


    public function index(Request $request)

    {

 
        

    if(auth()->id() == null){
    
      $char = Character::orderBy('id','DESC')->get();
      
      
      }
    else{

      if( Auth::user()->role == 'customer')
      {
        $cus = Customer::where('user_id',auth()->id())->first();
        $char = Character::where('owner_id',$cus->id)->get();
      }else
      {
        $char = Character::orderBy('id','DESC')->get();
      }

    
   
    }

return response()->json($char);
    }
  

    public function getChar()
    {
        
        return View::make('character.index');
    }

    public function show()
    {

    }

    public function store(Request $request)
    {

     

        $char = new Character();
  
        $char->nickname = $request->nickname;
        $char->class = $request->class;



        $cus = Customer::where('user_id',Auth()->id())->first();

        $char->owner_id = $cus->id;
     
        $char->strenght = $request->strenght;
        $char->agility = $request->agility;
        $char->intelligence = $request->intelligence;
        $char->price = $request->price;
       

      
       $files = $request->file('uploads');
       $char->img_path = time().'-'.$files->getClientOriginalName();
       $char->save();
     
       $data = array('status' => 'saved');
       Storage::put(time().'-'.$files->getClientOriginalName(), file_get_contents($files));
       return response()->json(["success" => "Character Created Successfully.", "character" => $char, "status" => 200]);

    }

    public function destroy($id)
    {
        
        $char = Character::findOrFail($id);
       
        if (File::exists("storage/".$char->img_path)) {
            File::delete("storage/".$char->img_path);
        }

        $char->delete();
        $data = array('success' =>'Deleted','code'=>'200');
        return response()->json($data);
    }
    


    public function edit($id)
    {

      //dd($id);
        $char = Character::find($id);
        return response()->json($char);
    }


    public function update(Request $request, $id)
    {


      $char = Character::find($id);
  
      $char->nickname = $request->nickname;
      $char->class = $request->class;



      $cus = Customer::where('user_id',Auth()->id())->first();

      $char->owner_id = $cus->id;
   
      $char->strenght = $request->strenght;
      $char->agility = $request->agility;
      $char->intelligence = $request->intelligence;
      $char->price = $request->price;
      $char->ontrade = $request->ontrade;
    
     $files = $request->file('uploads');
     $char->img_path = time().'-'.$files->getClientOriginalName();
     $char->save();
   
     $data = array('status' => 'saved');
     Storage::put(time().'-'.$files->getClientOriginalName(), file_get_contents($files));
     return response()->json(["success" => "Character Updated Successfully.", "character" => $char, "status" => 200]);
       



       
    }


    public function charTrans(Request $request)

    {


      
        $chars = Character::where('ontrade','yes')->orderBy('id','DESC')->get();
        return response()->json($chars);
     
    }


    public function postCheckout(Request $request){
        $citems = json_decode($request->getContent(),true);
        Log::info(print_r($citems, true));
          try {
            DB::beginTransaction();
            
            $customer =  Customer::where('user_id',auth()->id())->first();

            
            foreach($citems as $citem) {
          
             Character::where('id', $citem['item_id'] )
	          ->update([
	        	'owner_id' => $customer->id, 
		        'ontrade' => 'no'
	          ]);

            DB::table('characterline')->insert(
                ['character_id' =>  $citem['item_id'] , 
                'date' => now()]
            );

            



            }
            
          }
        catch (\Exception $e) {
              DB::rollback();
              return response()->json(array('status' => 'Order failed','code'=>409,'error'=>$e->getMessage()));
        }
      
          DB::commit();
          return response()->json(array('status' => 'Order Success','code'=>200,));
      
        
    }
}
