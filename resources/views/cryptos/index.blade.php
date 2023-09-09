{{-- @extends('layouts.base')
@section('body') --}}


    <div class="container">

        <table id="crypto_ownedtable" class="table table-striped table-hover" style="width:100%;">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Crypto</th>
                    <th>Quantity</th>    
                    <th>Last Price Bought per Stock </th>
                   
                    <th>Image </th> 
                    <th>Action </th>
                </tr>
            </thead>
            <tbody id="crypbody">
            </tbody>
        </table>
    </div>
    </div>

    


<div class="modal" id="crypModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:75%;">
      <div class="modal-content">
<div class="modal-header text-center">
  

           <h3 class="modal-title" id="lccreate">Create Crypto</h3> 
            <h3 class="modal-title" id="lcupdate">Sell Crypto</h4> 
         </div> 
     
 <form id="crypform" action="#" method="#" enctype="multipart/form-data">


<div class="card pmd-card bg-success text-dark">

    <div class="card-body"> 
     


        
                                <input type="hidden" class="form-control" id="cryp_id" name="cryp_id">

                                 <input type="hidden" class="form-control" id="crypto_id" name="crypto_id">
                                 <input type="hidden" class="form-control" id="lprc" name="lprc">
        <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Name</label>
            <input id="name" class="form-control" type="text" name = "name" class="form-control @error('name') is-invalid @enderror"  value="{{ old('fname') }}" required autocomplete="fname"  autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>



        <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Quantity</label>
            <input id="qty" class="form-control" type="number" name = "qty" class="form-control @error('stock') is-invalid @enderror"  value="{{ old('qty') }}" required autocomplete="qty" autofocus>
            @error('qty')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
             @enderror
        </div>
       


         <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Last Price</label>
            <input id="lprice" class="form-control" type="number" name = "lprice" class="form-control @error('lprice') is-invalid @enderror"  value="{{ old('lprice') }}" required autocomplete="lprice"  autofocus>
            @error('lprice')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>


        


         <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">Your Price</label>
            <input id="cprice" class="form-control" type="number" name = "cprice" value ="0" step="10" min="1" max="100000" class="form-control @error('cprice') is-invalid @enderror"  value="{{ old('cprice') }}" required autocomplete="cprice" autofocus>
            @error('cprice')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
             @enderror
        </div>

        {{-- <div class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">On Trade</label>
              <select name="ontrade" id="ontrade" class="form-select" >
            <option value="yes">Yes</option>
            <option value="no">No</option> --}}
          
  
                 </select>
             @error('status')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
             @enderror
        </div>

        

        
          
<div class="modal-footer d-flex justify-content-center">
           



                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                   <button id="crypSubmit" type="submit" class="btn btn-primary">Save</button>
                     <button id="crypupdate" type="submit" class="btn btn-primary">Trade</button>

                   


          </div>
        </form>
</div>
    </div>
    </div>
  </div>
   
  
{{-- @endsection --}}
