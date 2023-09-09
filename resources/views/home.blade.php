
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>







    <div  id="balancediv" class="container">
<h1>Balance $</h1>



    <table id="baltable" class="table table-striped table-hover" style="width:20%;">
        <thead>
            <tr>
            
            </tr>
        </thead>
        <tbody id="homebody">
        </tbody>
    </table>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        Add Balance
      </button>
</div>


<div  id ="notifdiv" class="container">

    <table id="hometable" class="table table-striped table-hover" style="width:100%;">
        <thead>
            <tr>
                {{-- <th>ID</th> --}}
                <th>Notifications</th>
                {{-- <th>First Name</th>
                <th>Address</th>
                <th>Town </th>
                <th>Zipcode</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Image</th>
                <th>Action </th> --}}
            </tr>
        </thead>
        <tbody id="empbody">
        </tbody>
    </table>
</div>

</div>




</div>



</div>


<div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:75%;">
      <div class="modal-content">
<div class="modal-header text-center">
  

           
            <h3 class="modal-title" id="">Deposit Balance</h4> 
         </div> 
     
 <form id="addform" action="#" method="#" enctype="multipart/form-data">


<div class="card pmd-card bg-success text-dark">

    <div class="card-body"> 
       

        
        
       

        <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Deposit</label>
            <input id="add" class="form-control" type="number" name = "add" class="form-control @error('add') is-invalid @enderror"  value=" " required autocomplete="add" autofocus>
            @error('add')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
             @enderror
        </div>


        
      
        
          
<div class="modal-footer d-flex justify-content-center">
            



                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                   <button id="addSubmit" type="submit" class="btn btn-primary">Save</button>
                  

                   


          </div>
        </form>
</div>
    </div>
    </div>
  </div>
   </div>


</div>