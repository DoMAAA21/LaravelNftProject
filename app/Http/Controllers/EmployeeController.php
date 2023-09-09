<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Employee;
use App\Models\User;
use View;
use DB;

use file;
class EmployeeController extends Controller
{
    public function index(Request $request)

    {

        
        // $char = Character::orderBy('id')->get();

        //$char = Customer::orderBy('id')->get();
        $emp = Employee::join('users','employees.user_id','users.id')->select('employees.*','users.email')->orderBy('employees.id','DESC')->get();
        return response()->json($emp);
     
    }


    public function getEmp()
    {
        
        return View::make('employees.index');
    }

    public function show()
    {

    }

    public function store(Request $request)
    {

      

       
        $user = new User();
    
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 'employee';
        
        $user->save();

        $lid = DB::getPdo()->lastInsertId();

        $employee = new Employee();
        $employee->users()->associate($lid);
        $employee->fname = $request->fname;
        $employee->lname = $request->lname;
        $employee->addressline = $request->addressline;
        $employee->town = $request->town;
        $employee->zipcode = $request->zipcode;
        $employee->phone = $request->phone;
       
      
      
       $files = $request->file('uploads');
   
       $employee->img_path = time().'-'.$files->getClientOriginalName();
       $employee->save();
       $employee->email =  $request->email;
       $data = array('status' => 'saved');
       Storage::put(time().'-'.$files->getClientOriginalName(), file_get_contents($files));
       return response()->json(["success" => "Employee Created Successfully.", "employee" => $employee, "status" => 200]);

    }

    public function destroy($id)
    {
        
        $emp = Employee::findOrFail($id);
       
        // if (File::exists("storage/".$emp->img_path)) {
        //     File::delete("storage/".$emp->img_path);
        // }

        $emp->delete();
        $user = User::where('id',$emp->user_id)->delete();
        $data = array('success' =>'Deleted','code'=>'200');
        return response()->json($data);
    }
    


    public function edit($id)
    {
        // $emp = Employee::join('users','employees.user_id','users.id')->Find($id);
        $emp = Employee::join('users','employees.user_id','users.id')->select('employees.*','users.email')->Find($id);
        return response()->json($emp);
    }


    public function update(Request $request, $id)
    {


      
         $employee = Employee::find($id);

         $user = User::find($employee->user_id);


       
          $user->email = $request->email;
          $user->password = bcrypt($request->password);
          $user->role = 'employee';
          $user->save();
        
  
         
          $employee->fname = $request->fname;
          $employee->lname = $request->lname;
          $employee->addressline = $request->addressline;
          $employee->town = $request->town;
          $employee->zipcode = $request->zipcode;
          $employee->phone = $request->phone;
         
        
        
      $files = $request->file('uploads');
  
       $employee->img_path = time().'-'.$files->getClientOriginalName();        
      //$customer->img_path = 'default.jpg';
         $employee->save();
         $employee->email =  $request->email;
         $data = array('status' => 'saved');
       Storage::put(time().'-'.$files->getClientOriginalName(), file_get_contents($files));
         return response()->json(["success" => "Employee Updated Successfully.", "employee" => $employee, "status" => 200]);











       
    }
}
