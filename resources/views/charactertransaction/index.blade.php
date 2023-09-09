{{-- @extends('layouts.shop') --}}

 @section('body') 

     <h1>YourCart</h1> 

   <div id="ccart-container">
        <div id="ccart">
            <i class="fa fa-shopping-cart fa-2x copenCloseCart" aria-hidden="true"></i>
       
        </div>
        <span id="citemCount"></span>
    </div> 
 <link href="{{asset('css/shop.css') }}" rel="stylesheet"> 

    <div id="cshoppingCart">
        <div id="ccartItemsContainer">
            <h2>Items in your cart</h2>
            <i class="fa fa-times-circle-o fa-3x copenCloseCart" aria-hidden="true"></i>
            <div id="ccartItems">
             
            </div>
            <button class="btn btn-primary" id="ccheckout">Checkout</button>
     <button id="ccartclosebtn" type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
            <span id="ccartTotal"></span>
        </div>
    </div>

    <nav>
      
    </nav>
    <div class="container container-fluid" id="citems">

    </div>

</div>
{{-- <script>
  function yourFunction(){
      
        $('#citems').load(locatio.href + "#citems");

        setTimeout(yourFunction, 3000);
    }
    
    yourFunction();
<script> --}}