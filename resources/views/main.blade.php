<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NFTs</title>
</head>

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






  @include('partials.navigation')
     @include('layouts.header')
<body>



  {{-- @if(Auth::check()) --}}
<div class ="sd" id ="homediv" >
     @include('home')
<div>
{{-- @endif --}}
 <div class ="sd" id ="customerdiv" >
    @include('customers.index')
<div>


<div class ="sd" id ="employeediv" >
    @include('employees.index')
<div>

<div class ="sd" id ="characterdiv" >
 @include('character.index')
<div>

<div class ="sd" id ="buynftdiv" >
 @include('charactertransaction.index')
<div>

<div  class ="sd" id ="logindiv" >
    @include('login.index')
<div>

<div  class ="sd" id ="chartsdiv" >
    @include('charts.index')
<div>



<div  class ="sd" id ="mynftdiv" >
    @include('cryptos.index')
<div>


<div  class ="sd" id ="tradediv" >
    @include('cryptotransaction.trade')
<div>


<div  class ="sd" id ="regdiv" >
    @include('login.register')
<div>








</body>
<script>
//  function logins() {

//         $("#characterdiv").hide("slow");
//         $("#homediv").hide("slow");
//         $("#employeediv").hide("slow");
//         $("#customerdiv").hide("slow");
//         $("#customerl").hide();
//         $("#employeel").hide();
//         $("#characterl").hide();
//         $("#characterl").hide();
//         $("#logoutbtn").hide();
//          $("#logindiv").show();
//     }


//     function logouts() {

//         $("#characterdiv").hide("slow");
//         $("#homediv").hide("slow");
//         $("#employeediv").hide("slow");
//         $("#customerdiv").hide("slow");
//         $("#customerl").hide();
//         $("#employeel").hide();
//         $("#characterl").hide();
//         $("#characterl").hide();
//         $("#logoutbtn").hide();
//          $("#logindiv").show();
//     }
</script>
</html>


<div  class ="sd" id ="cryptodiv" >
    @include('cryptotransaction.index')
<div>

    
    <div  class ="sd" id ="verifydiv" >
        @include('login.verify')
    <div>
    
<div  class ="sd" id ="searchcrypdiv" >
    @include('search.searchcrypto')
<div>

   
    
{{-- <div  class ="sd" id ="searchnftdiv" >
    @include('search.searchnft')
<div> --}}


