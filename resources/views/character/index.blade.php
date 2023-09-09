{{-- @extends('layouts.base')
@section('body') --}}

 {{-- @include('layouts.header')  --}}


 
    <div   id ="characterdiv" class="container">

        <table id="chartable" class="table table-striped table-hover" style="width:100%;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nickname</th>
                    <th>Class</th> 
                    <th>Strength</th>
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

        
    
        <div id="ontrade" class="form-group pmd-textfield pmd-textfield-floating-label">
            <label for="inverse_regularfloating">On Trade</label>
              <select name="ontrade" id="ontrade" class="form-select" >
            <option value="no">no</option>
            <option value="yes">yes</option>

          
  
                 </select>
             @error('class')
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
  </div>
   </div>
  
{{--     --}}
