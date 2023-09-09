{{-- @extends('layouts.base')
@section('body') --}}
<style>
        * {
            margin-top: 10px;
        }

        .left-col {
            float: left;
            width: 25%;
        }

        .center-col {
            float: left;
            width: 50%;
        }

        .right-col {
            float: left;
            width: 25%;
        }
    </style>

    <div id ="customerdiv" class="container">

        <table id="custable" class="table table-striped table-hover"  style="width:100%;">
            <thead>
                <tr>
                    <th  >ID</th>
                    <th>Last</th>
                    <th>First Name</th>
                    <th>Address</th>
                    <th>Town </th>
                    <th>Zipcode</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Action </th>
                </tr>
            </thead>
            <tbody id="cusbody">
            </tbody>
        </table>
    </div>
    </div>

    <div class="modal fade" id="cusModal" role="dialog" style="display:none">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="lcreate">Create Customer</h4>
                    <h4 class="modal-title" id="lupdate">Update Customer</h4>
                    
                    <div class="modal-body">
                        <form id="cusform" action="#" method="#" enctype="multipart/form-data">
                             {{-- {{ method_field('PUT') }} --}}
                          <div class="form-group">
                            
                                <input type="hidden" class="form-control" id="cus_id" name="cus_id">
                            </div>



                            <div class="form-group">
                                <label for="title" class="control-label">First Name</label>
                                <input type="text" class="form-control" id="fname" name="fname">
                            </div>
                           
                            <div class="form-group">
                                <label for="lname" class="control-label">Last Name</label>
                                <input type="text" class="form-control " id="lname" name="lname"></text>
                            </div>
                            <div class="form-group">
                                <label for="fname" class="control-label">Address</label>
                                <input type="text" class="form-control " id="addressline" name="addressline">
                            </div>
                            
                             <div class="form-group">
                                <label for="fname" class="control-label">Town</label>
                                <input type="text" class="form-control " id="town" name="town">
                            </div>

                            <div class="form-group">
                                <label for="fname" class="control-label">Zipcode</label>
                                <input type="text" class="form-control " id="zipcode" name="zipcode">
                            </div>
                            <div class="form-group">
                                <label for="fname" class="control-label">Phone</label>
                                <input type="text" class="form-control " id="phone" name="phone">
                            </div>

                             <div class="form-group">
                                <label for="fname" class="control-label">Email</label>
                                <input type="text" class="form-control " id="email" name="email">
                            </div>

                            <div class="form-group">
                                <label for="fname" class="control-label">Password</label>
                                <input type="password" class="form-control " id="password" name="password">
                            </div>

                              <div class="form-group">
                                <label for="fname" class="control-label">Confirm Password</label>
                                <input type="password" class="form-control " id="confirm_password" name="confirm_password">
                            </div>
                            <div class="form-group">
                                <label for="address" class="control-label">Item Image</label>
                                <input type="file" class="form-control" id="imagePath" name="uploads">
                            </div>
                        </form>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                   <button id="cusSubmit" type="submit" class="btn btn-primary">Save</button>
                     <button id="cusupdate" type="submit" class="btn btn-primary">Update</button>
                </div>

            </div>
        </div>
    </div>


{{-- Employee --}}
 {{-- <div  id="employeediv" class="container">

        <table id="emptable" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Last</th>
                    <th>First Name</th>
                    <th>Address</th>
                    <th>Town </th>
                    <th>Zipcode</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Action </th>
                </tr>
            </thead>
            <tbody id="empbody">
            </tbody>
        </table>
    </div>
    </div>

   


                    


<div class="modal" id="empModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:75%;">
      <div class="modal-content">
<div class="modal-header text-center">
  
{{--           
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
           {{-- <h3 class="modal-title" id="lecreate">Create Employee</h3> 
            <h3 class="modal-title" id="leupdate">Update Employee</h4> 
         </div> 
     
 <form id="empform" action="#" method="#" enctype="multipart/form-data">


<div class="card pmd-card bg-success text-dark">

    <div class="card-body"> 
        <!-- Regulat Input With Floating Label -->


        
                                <input type="hidden" class="form-control" id="emp_id" name="emp_id">
        <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">First Name</label>
            <input id="fname" class="form-control" type="text" name = "fname" class="form-control @error('fname') is-invalid @enderror"  value="{{ old('fname') }}" required autocomplete="fname" autofocus>
            @error('fname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>

        <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Last Name</label>
            <input id="lname" class="form-control" type="text" name = "lname" class="form-control @error('lname') is-invalid @enderror"  value="{{ old('lname') }}" required autocomplete="lname" autofocus>
            @error('lname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
             @enderror
        </div>

        <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Addressline</label>
            <input id="addressline" class="form-control" type="text" name = "addressline" class="form-control @error('addressline') is-invalid @enderror"  value="{{ old('addressline') }}" required autocomplete="addressline" autofocus>
            @error('addressline')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
             @enderror
        </div>

        <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Town</label>
            <input id="town" class="form-control" type="text" name = "town" class="form-control @error('town') is-invalid @enderror"  value="{{ old('town') }}" required autocomplete="town" autofocus>
             @error('town')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
             @enderror
        </div>

         <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Zipcode</label>
            <input id="zipcode" class="form-control" type="text" name = "zipcode" class="form-control @error('zipcode') is-invalid @enderror"  value="{{ old('zipcode') }}" required autocomplete="zipcode" autofocus>
             @error('zipcode')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
             @enderror
        </div>

        <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Phone</label>
            <input id="phone" class="form-control" type="text" name = "phone" class="form-control @error('phone') is-invalid @enderror"  value="{{ old('phone') }}" required autocomplete="phone" autofocus>
             @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
             @enderror
        </div>

        <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Email</label>
            <input id="email" class="form-control" type="text" name = "email" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('town')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
             @enderror
        </div>


        <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Password</label>
            <input id="inverse_regularfloating" class="form-control" type="password" name = "password" class="form-control @error('password') is-invalid @enderror"  value="{{ old('password') }}" required autocomplete="password" autofocus>
             @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
             @enderror
        </div>

          <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Confirm Password</label>
            <input id="inverse_regularfloating" class="form-control" type="password" name = "password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"  value="{{ old('password_confirmation') }}" required autocomplete="password_confirmation" autofocus>
        </div>


          <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Image</label>
            <input id="inverse_regularfloating" class="form-control" type="file" name = "uploads" class="form-control @error('image') is-invalid @enderror"  value="{{ old('image') }}" required autocomplete="image" autofocus>
             @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
             @enderror
        </div>
       --}}
        
          
{{-- <div class="modal-footer d-flex justify-content-center">
         



                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                   <button id="empSubmit" type="submit" class="btn btn-primary">Save</button>
                     <button id="empupdate" type="submit" class="btn btn-primary">Update</button>

                   


          </div>
        </form>
</div>
    </div>
    </div>
  </div>
</div> --}} 
{{-- End Employee --}}

{{-- Character  --}}
 {{-- <div   id ="characterdiv" class="container">

        <table id="chartable" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nickname</th>
                    <th>Class</th> 
                    <th>Strenght</th>
                    <th>Agility</th>
                    <th>Intelligence</th>
                    <th>Price</th>
                    <th>Image </th>
                    <th>Action </th>
                </tr>
            </thead>
            <tbody id="charbody">
            </tbody>
        </table>
    </div>
    </div>

    


<div class="modal" id="charModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:75%;">
      <div class="modal-content">
<div class="modal-header text-center">
  

           <h3 class="modal-title" id="lchcreate">Create Character</h3> 
            <h3 class="modal-title" id="lchupdate">Update Character</h4> 
         </div> 
     
 <form id="charform" action="#" method="#" enctype="multipart/form-data">


<div class="card pmd-card bg-success text-dark">

    <div class="card-body"> 
     


        
                                <input type="hidden" class="form-control" id="char_id" name="char_id">
        <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Nickname</label>
            <input id="nickname" class="form-control" type="text" name = "nickname" class="form-control @error('nickname') is-invalid @enderror"  value="" required autocomplete="fname" autofocus>
            @error('nickname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>



        


        <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Class</label>
              <select name="class" id="class" class="form-select" >
            <option value="Archer">Archer</option>
            <option value="Warrior">Warrior</option>
            <option value="Engineer">Engineer</option>
            <option value="Cleric">Cleric</option>
             <option value="Sorcerer">Sorcerer</option>

          
  
                 </select>
             @error('class')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
             @enderror
        </div>


       

         <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Strenght</label>
            <input id="strenght" class="form-control" type="number" name = "strenght" value ="1" step="1" min="1" max="100" class="form-control @error('stock') is-invalid @enderror"  value="{{ old('lname') }}" required autocomplete="lname" autofocus>
            @error('strenght')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
             @enderror
        </div>


        <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Agility</label>
            <input id="agility" class="form-control" type="number" name = "agility" value ="1" step="1" min="1" max="100" class="form-control @error('stock') is-invalid @enderror"  value="{{ old('lname') }}" required autocomplete="lname" autofocus>
            @error('agility')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
             @enderror
        </div>

         <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Intelligence</label>
            <input id="intelligence" class="form-control" type="number" name = "intelligence" value ="1" step="1" min="1" max="100" class="form-control @error('stock') is-invalid @enderror"  value="{{ old('lname') }}" required autocomplete="lname" autofocus>
            @error('intelligence')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
             @enderror
        </div>


        
        <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Price</label>
            <input id="price" class="form-control" type="number" name = "price" class="form-control @error('price') is-invalid @enderror"  value="{{ old('price') }}" required autocomplete="price" autofocus>
            @error('price')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
             @enderror
        </div>

        

        

          <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Image</label>
            <input id="inverse_regularfloating" class="form-control" type="file" name = "uploads" class="form-control @error('image') is-invalid @enderror"  value="{{ old('image') }}" required autocomplete="image" autofocus>
             @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
             @enderror
        </div>
      
        
          
        <div class="modal-footer d-flex justify-content-center">
           



                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                   <button id="charSubmit" type="submit" class="btn btn-primary">Save</button>
                     <button id="charupdate" type="submit" class="btn btn-primary">Update</button>

                   


          </div>
        </form>
</div>
    </div>
    </div>
  </div> --}}


     
{{--   
@endsection --}}
