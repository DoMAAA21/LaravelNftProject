$(document).ready(function () {

   


$("#loginbtn").on("click", function (e) {
    e.preventDefault();
    var data = $('#loginform')[0];
    console.log(data);
    let formData = new FormData(data);
    console.log(formData);
    for (var pair of formData.entries()) {
        console.log(pair[0] + ',' + pair[1]);
    }

    console.log(data);


    $.ajax({
        type: "POST",
        url: "/api/login",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json",
        success: function (data) {
            console.log(data.user);

            sessionStorage.setItem('token',data.token)
           //alert(data.verify)

           if(data.verify === null)
           {
            $("#logindiv").hide();
            $("#verifydiv").show();
            $("#logoutbtn").show();
            $("#loginbtn").show();
            $("#regl").hide();

           }
           else{
          if(data.role === 'customer')
          {
             // $("#logindiv").hide();
            // $("#characterdiv").hide();
            // $("#employeediv").hide();
            $('#hometable').DataTable().ajax.reload();
            $('#baltable').DataTable().ajax.reload();
           $("#logindiv").hide();
           // $("#loginl").hide();
          $("#homediv").show();
          $("#customerl").show();
          $("#employeel").show();
          $("#characterl").show();
          $("#characterl").show();
          $("#cryptol").show();
          $("#chartsl").show();
          $("#charnftl").show();
          $("#logoutbtn").show();
          $("#verifydiv").hide();
          $("#myownl").show();
            $("#tradel").show();
          $("#portal").hide();
          $("#searchl").hide();
          $('#crypto_ownedtable').DataTable().ajax.reload();
          $('#chartable').DataTable().ajax.reload();
          $('#hometable').DataTable().ajax.reload();
          $('#baltable').DataTable().ajax.reload();
          funccharts();
          }else
          {
            $("#verifydiv").hide();
            $("#logindiv").hide();
            // $("#loginl").hide();
           $("#homediv").show();
           $("#customerl").show();
           $("#employeel").show();
        //    $("#characterl").show();
           $("#characterl").hide();
           $("#cryptol").hide();
           $("#chartsl").show();
           $("#charnftl").hide();
           $("#logoutbtn").show();
           $("#portal").show();
           $("#searchl").show();
           $("#notifdiv").hide();
           $("#balancediv").hide();
           $('#crypto_ownedtable').DataTable().ajax.reload();
           $('#chartable').DataTable().ajax.reload();
          
          }
        }
         
           //location.reload();

           document.getElementById("loginform").reset();
             console.log(data);
          
          
            
       
           
        },
        error: function (error) {
       

           
        }

        
    })



  
 
});



$("#btnregister").on("click", function (e) {


    e.preventDefault();
    var data = $('#regform')[0];
    console.log(data);
    let formData = new FormData(data);
    console.log(formData);
    for (var pair of formData.entries()) {
        console.log(pair[0] + ',' + pair[1]);
    }

    console.log(data);


    $.ajax({
        type: "POST",
        url: "/api/registercus",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json",
        success: function (data) {
            console.log(data.role);
            console.log(data.verify);
            $('#hometable').DataTable().ajax.reload();
            $('#baltable').DataTable().ajax.reload();
            if(data.verify === null)
            {
             $("#logindiv").hide();
             $("#regdiv").hide();
             $("#verifydiv").show();
             $("#logoutbtn").show();
             $("#loginbtn").show();
             $("#regl").hide();
 
            }
            else{
           if(data.role === 'customer')
           {
              // $("#logindiv").hide();
             // $("#characterdiv").hide();
             // $("#employeediv").hide();
             $('#hometable').DataTable().ajax.reload();
             $('#baltable').DataTable().ajax.reload();
            $("#logindiv").hide();
            // $("#loginl").hide();
           $("#homediv").show();
           $("#customerl").show();
           $("#employeel").show();
           $("#characterl").show();
           $("#characterl").show();
           $("#cryptol").show();
           $("#chartsl").show();
           $("#charnftl").show();
           $("#logoutbtn").show();
 
           $("#myownl").show();
             $("#tradel").show();
           $("#portal").hide();
           $("#searchl").hide();
           $('#crypto_ownedtable').DataTable().ajax.reload();
           $('#chartable').DataTable().ajax.reload();
           $('#hometable').DataTable().ajax.reload();
           $('#baltable').DataTable().ajax.reload();
           funccharts();
           }else
           {
             $("#logindiv").hide();
             // $("#loginl").hide();
            $("#homediv").show();
            $("#customerl").show();
            $("#employeel").show();
         //    $("#characterl").show();
            $("#characterl").hide();
            $("#cryptol").hide();
            $("#chartsl").show();
            $("#charnftl").hide();
            $("#logoutbtn").show();
            $("#portal").show();
            $("#searchl").show();
            $("#notifdiv").hide();
            $("#balancediv").hide();
            $('#crypto_ownedtable').DataTable().ajax.reload();
            $('#chartable').DataTable().ajax.reload();
           
           }
         }
           
         
           //location.reload();

           document.getElementById("regform").reset();
             console.log(data);
          
          
            
       
           
        },
        error: function (error) {
       

           
        }

        
    })

});




$("#logoutbtn").on("click", function (e) {
    // e.preventDefault();
  


    $.ajax({
        type: "POST",
        url: "/api/logout",
        // data: formData,
        contentType: false,
        processData: false,
        headers: {
            "Authorization":'Bearer '+ sessionStorage.getItem('token'),
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json",
        success: function (data) {

            $("#verifydiv").hide();
            $("#homediv").hide();
            $("#logindiv").show();
            $("#logoutbtn").hide();
            $("#customerl").hide();
            $("#employeel").hide();
            $("#characterl").hide();
            $("#characterl").hide();
            $("#cryptol").hide();
            $("#chartsl").hide();
            $("#charnftl").hide();
            $("#myownl").hide();
            $("#tradel").hide();
            $("#portal").hide();
            $("#chartsdiv").hide();
            $("#logindiv").hide();
            $("#characterdiv").hide();
            $("#employeediv").hide();
            $("#homel").hide();
            $("#customerdiv").hide();
            $("#buynftdiv").hide();
            $("#cryptodiv").hide();
            $("#logindiv").show();
            $("mynftdiv").hide();
            $("#tradediv").hide();
            $("#searchcrypdiv").hide();
            $("mynftdiv").hide();
            $("#loginl").show();
            $("#regl").show();
            $("#searchl").hide();
            $("#cryptodiv").hide();
            $("mynftdiv").hide();
            $("verifydiv").hide();





           
            $("#cryptodiv").hide("slow");
         
         
             $("#buynftdiv").hide("slow");
             $("#mynftdiv").hide("slow");
           
            // $("#tradediv").show("slow");
             console.log(data);
          
          
            
       
           
        },
        error: function (error) {
       

           
        }

        
    })


 
  
 
});


$("#login").on("click", function (e) {

    $.ajax({
         
        type: "POST",
        url: "/api/refresh",
        // data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            console.log(data.role);



         if(data.role === 'no') 
         {
            
             $("#customerdiv").hide();
             $("#employeediv").hide();
             $("#characterdiv").hide();
             $("#cryptodiv").hide();
             $("#customerl").hide();
             $("#employeel").hide();
$("#characterl").hide();
$("#characterl").hide();
$("#cryptol").hide();
$("#chartsl").hide();
$("#charnftl").hide();
$("#homediv").hide();
$("#chartsdiv").hide();
$("#buynftdiv").hide("slow");                        
$("#chartsdiv").hide()
$("#portal").hide()
$("#searchnftdiv").hide("slow");
$("#searchcrypdiv").hide("slow");
            $("#logindiv").show();
         }
         else if (data.role === 'customer' )
         {


            $("#logindiv").hide();
            $("#homediv").show();
            $("#customerl").show();
            $("#employeel").show();
            $("#characterl").show();
            $("#characterl").show();
            $("#cryptol").show();
            $("#chartsl").show();
            $("#charnftl").show();
            $("#logoutbtn").show();
            $("#logindiv").hide();
            $("#portal").hide();
            $("#searchnftdiv").hide("slow");
            $("#searchcrypdiv").hide("slow");
            $("#searchl").hide();
            $("#homel").show();
            $('#crypto_ownedtable').DataTable().ajax.reload();
            $('#chartable').DataTable().ajax.reload();
         }

         else if(data.role === 'employee')
         {
            $("#logindiv").hide();
            $("#homediv").show();
            $("#customerl").show();
            $("#employeel").show();
            $("#characterl").show();
            $("#cryptol").hide();
            $("#chartsl").show();
            $("#charnftl").hide();
            $("#logoutbtn").show();
            $("#logindiv").hide();
            $("#characterdiv").hide();
            $("#portal").show();
            $('#crypto_ownedtable').DataTable().ajax.reload();
            $('#chartable').DataTable().ajax.reload();
         }

         else 
         {
            $("#logindiv").hide();
            $("#homediv").show();
            $("#customerl").show();
            $("#employeel").show();
            $("#characterl").show();
            $("#cryptol").hide();
            $("#chartsl").show();
            $("#charnftl").hide();
            $("#logoutbtn").show();
            $("#logindiv").hide();
            $("#characterdiv").hide();
            $("#portal").show();

            $('#crypto_ownedtable').DataTable().ajax.reload();
            $('#chartable').DataTable().ajax.reload();
            
         }



           
        
         
          
            
       
           
        },
        error: function (error) {
       

           alert('Incorrect Credentials');
        }

        
    })
})

})