{{-- @extends('layouts.base')
@section('body') --}}


    <div  class="container">

        <table id="emptable" class="table table-striped table-hover" style="width:100%;">
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
           <h3 class="modal-title" id="lecreate">Create Employee</h3> 
            <h3 class="modal-title" id="leupdate">Update Employee</h4> 
         </div> 
     
 <form id="empform" action="#" method="#" enctype="multipart/form-data">


<div class="card pmd-card bg-success text-dark">

    <div class="card-body"> 
        <!-- Regulat Input With Floating Label -->


        
                                <input type="hidden" class="form-control" id="emp_id" name="emp_id">
        <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">First Name</label>
            <input id="efname" class="form-control" type="text" name = "fname" class="form-control @error('fname') is-invalid @enderror"  value="{{ old('fname') }}" required autocomplete="fname" autofocus>
            @error('fname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>

        <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Last Name</label>
            <input id="elname" class="form-control" type="text" name = "lname" class="form-control @error('lname') is-invalid @enderror"  value="{{ old('lname') }}" required autocomplete="lname" autofocus>
            @error('lname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
             @enderror
        </div>

        <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Addressline</label>
            <input id="eaddressline" class="form-control" type="text" name = "addressline" class="form-control @error('addressline') is-invalid @enderror"  value="{{ old('addressline') }}" required autocomplete="addressline" autofocus>
            @error('addressline')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
             @enderror
        </div>

        <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Town</label>
            <input id="etown" class="form-control" type="text" name = "town" class="form-control @error('town') is-invalid @enderror"  value="{{ old('town') }}" required autocomplete="town" autofocus>
             @error('town')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
             @enderror
        </div>

         <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Zipcode</label>
            <input id="ezipcode" class="form-control" type="text" name = "zipcode" class="form-control @error('zipcode') is-invalid @enderror"  value="{{ old('zipcode') }}" required autocomplete="zipcode" autofocus>
             @error('zipcode')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
             @enderror
        </div>

        <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Phone</label>
            <input id="ephone" class="form-control" type="text" name = "phone" class="form-control @error('phone') is-invalid @enderror"  value="{{ old('phone') }}" required autocomplete="phone" autofocus>
             @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
             @enderror
        </div>

        <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Email</label>
            <input id="eemail" class="form-control" type="text" name = "email" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}" required autocomplete="email" autofocus>
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
      
        
          
<div class="modal-footer d-flex justify-content-center">
            {{-- <button  type="submit" class="btn btn-primary" id="empSubmit">Save</button>
            <button class="btn btn-light" data-dismiss="modal">Cancel</button> --}}




                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                   <button id="empSubmit" type="submit" class="btn btn-primary">Save</button>
                     <button id="empupdate" type="submit" class="btn btn-primary">Update</button>

                   


          </div>
        </form>
</div>
    </div>
    </div>
  </div>
   </div>
  
{{-- @endsection --}}
