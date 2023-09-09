$(document).ready(function () {



   



    $("#customerdiv").hide();
    $("#employeediv").hide();
    $("#characterdiv").hide();
     $("#cryptodiv").hide();
     $("#customerl").hide();
        $("#employeel").hide();
        $("#characterl").hide();
        $("#characterl").hide();
        $("#cryptol").hide();
        $("#homel").hide();
        $("#chartsl").hide();
        $("#charnftl").hide();
        $("#homediv").hide();
        $("#chartsdiv").hide();
        $("#buynftdiv").hide();                        
        $("#chartsdiv").hide()
        $("#tradediv").hide()
        $("#portal").hide()
        $("#myownl").hide();
            $("#tradel").hide();
            $("#regdiv").hide();
        $("#mynftdiv").hide();
        $("#searchl").hide();
         $("#searchcrypdiv").hide();
         $("#verifydiv").hide();
        
        if (window.performance) {
            console.info("window.performance works fine on this browser");
          }
          console.info(performance.navigation.type);
          if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
    
    
    
            console.info( "This page is reloaded" );
    
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
                            $("#regdiv").hide();
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
        $("#mynftdiv").hide("slow");
        $("#myownl").hide();
        $("#regl").show();
        $("#tradel").hide();
        $("#logoutbtn").hide();
        $("#homel").hide();
                            $("#logindiv").show();
                         }
                         else if (data.role === 'customer' )
                         {

                            $("#regdiv").hide();
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
                            $("#mynftdiv").hide("slow");
                            $("#myownl").show();
                            $("#tradel").show();
                            $("#portal").hide();
                            $("#regl").hide();
                            $("#regdiv").hide("slow");
                            $("#searchnftdiv").hide("slow");
                            $("#searchl").hide();
                            $("#homel").show();
                              $("#searchcrypdiv").hide("slow");
                         }

                         else if(data.role === 'employee')
                         {
                            $("#logindiv").hide();
                            $("#homediv").show();
                            $("#regl").hide();
                            $("#customerl").show();
                            $("#employeel").show();
                            $("#characterl").hide();
                            $("#cryptol").hide();
                            $("#chartsl").show();
                            $("#charnftl").hide();
                            $("#regdiv").hide();
                            $("#logoutbtn").show();
                            $("#logindiv").hide();
                            $("#notifdiv").hide();
                            $("#balancediv").hide();
                            $("#portal").show();
                            $("#searchl").show();
                            $("#homel").show();
                           
                           
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
                            $("#notifdiv").hide();
                            $("#balancediv").hide();
                            $("#mynftdiv").hide("slow");
                            $("#portal").show();
                            $("#regdiv").hide();
                            $("#homel").show();
                            $("#searchl").show();
                            
                         }

    
        
                           
                        
                         
                          
                            
                       
                           
                        },
                        error: function (error) {
                       
                
                           
                        }
                
                        
                    })
            
          } else {
            console.info( "This page is not reloaded");
          }
    
    $("#customerl").on("click", function (e) {
        // e.preventDefault();3
        $("#characterdiv").hide("slow");
        $("#employeediv").hide("slow");
        $("#homediv").hide("slow");
        $("#cryptodiv").hide("slow");
        $("#chartsdiv").hide("slow");
        $("#buynftdiv").hide();
        $("#mynftdiv").hide("slow");
        $("#regdiv").hide("slow");
        $("#searchnftdiv").hide("slow");
        $("#searchcrypdiv").hide("slow");
        $("#verifydiv").hide();
         $("#customerdiv").show("slow");
     
     
       
     });
    
     $("#employeel").on("click", function (e) {
        // e.preventDefault();3
        $("#characterdiv").hide("slow");
        $("#customerdiv").hide("slow");
        $("#homediv").hide("slow");
        $("#cryptodiv").hide("slow");
        $("#chartsdiv").hide("slow");
        $("#buynftdiv").hide();
        $("#mynftdiv").hide("slow");
        $("#tradediv").hide("slow");
        $("#regdiv").hide("slow");
        $("#searchnftdiv").hide("slow");
        $("#searchcrypdiv").hide("slow");
        $("#verifydiv").hide();
         $("#employeediv").show("slow");
     
     
       
     });
    
     $("#characterl").on("click", function (e) {
         e.preventDefault();
        $("#employeediv").hide("slow");
        $("#customerdiv").hide("slow");
        $("#cryptodiv").hide("slow");
        $("#homediv").hide("slow");
        $("#chartsdiv").hide("slow");
        $("#buynftdiv").hide();
        $("#mynftdiv").hide("slow");
        $("#tradediv").hide("slow");
        $("#regdiv").hide("slow");
        $("#searchnftdiv").hide("slow");
        $("#searchcrypdiv").hide("slow");
        $("#verifydiv").hide();
         $("#characterdiv").show("slow");
     
     
       
     });

     $("#cryptol").on("click", function (e) {
        e.preventDefault();
       $("#employeediv").hide("slow");
       $("#customerdiv").hide("slow");
       $("#homediv").hide("slow");
       $("#chartsdiv").hide("slow");
       
        $("#characterdiv").hide("slow");
        $("#buynftdiv").hide();
        $("#mynftdiv").hide("slow");
        $("#tradediv").hide("slow");
        $("#regdiv").hide("slow");
        $("#searchnftdiv").hide("slow");
        $("#searchcrypdiv").hide("slow");
        $("#verifydiv").hide();
        $("#cryptodiv").show("slow");
    
      
    });


    $("#chartsl").on("click", function (e) {
        // e.preventDefault();3
        $("#characterdiv").hide("slow");
        $("#employeediv").hide("slow");
        $("#homediv").hide("slow");
        $("#cryptodiv").hide("slow");
         $("#customerdiv").hide();
         $("#buynftdiv").hide();
         $("#mynftdiv").hide("slow");
         $("#tradediv").hide("slow");
         $("#regdiv").hide("slow");
         $("#searchnftdiv").hide("slow");
         $("#searchcrypdiv").hide("slow");
         $("#verifydiv").hide();
         $("#chartsdiv").show("slow");
     
       
     });


     $("#charnftl").on("click", function (e) {
        // e.preventDefault();3
        $("#characterdiv").hide("slow");
        $("#employeediv").hide("slow");
        $("#homediv").hide("slow");
        $("#cryptodiv").hide("slow");
         $("#customerdiv").hide();
         $("#chartsdiv").hide();
         $("#mynftdiv").hide("slow");
         $("#tradediv").hide("slow");
         $("#regdiv").hide("slow");
         $("#searchnftdiv").hide("slow");
         $("#searchcrypdiv").hide("slow");
         $("#verifydiv").hide();
         $("#buynftdiv").show("slow");
        
       
     });

     $("#mynftl").on("click", function (e) {
        // e.preventDefault();3
        $("#characterdiv").hide("slow");
        $("#employeediv").hide("slow");
        $("#homediv").hide("slow");
        $("#cryptodiv").hide("slow");
         $("#customerdiv").hide();
         $("#chartsdiv").hide();
         $("#buynftdiv").hide("slow");
         $("#tradediv").hide("slow");
         $("#regdiv").hide("slow");
         $("#searchnftdiv").hide("slow");
         $("#searchcrypdiv").hide("slow");
         $("#verifydiv").hide();
         $("#mynftdiv").show("slow");
       
     });


     $("#tradel").on("click", function (e) {
        // e.preventDefault();3
        $("#characterdiv").hide("slow");
        $("#employeediv").hide("slow");
        $("#homediv").hide("slow");
        $("#cryptodiv").hide("slow");
         $("#customerdiv").hide();
         $("#chartsdiv").hide();
         $("#buynftdiv").hide("slow");
         $("#mynftdiv").hide("slow");
         $("#regdiv").hide("slow");
         $("#searchnftdiv").hide("slow");
         $("#searchcrypdiv").hide("slow");
         $("#verifydiv").hide();
         $("#tradediv").show("slow");
       
     });

     $("#regl").on("click", function (e) {
        // e.preventDefault();3
        $("#characterdiv").hide("slow");
        $("#employeediv").hide("slow");
        $("#homediv").hide("slow");
        $("#cryptodiv").hide("slow");
         $("#customerdiv").hide();
         $("#chartsdiv").hide();
         $("#buynftdiv").hide("slow");
         $("#mynftdiv").hide("slow");
         $("#logindiv").hide("slow");
         $("#tradediv").hide("slow");

         $("#searchnftdiv").hide("slow");
         $("#searchcrypdiv").hide("slow");
         $("#logindiv").hide("slow");
         $("#verifydiv").hide();
         $("#regdiv").show("slow");
       
     });

     $("#login").on("click", function (e) {
        // e.preventDefault();3
        $("#characterdiv").hide("slow");
        $("#employeediv").hide("slow");
        $("#homediv").hide("slow");
        $("#cryptodiv").hide("slow");
         $("#customerdiv").hide();
         $("#chartsdiv").hide();
         $("#buynftdiv").hide("slow");
         $("#mynftdiv").hide("slow");
         $("#logindiv").hide("slow");
         $("#tradediv").hide("slow");

         $("#searchnftdiv").hide("slow");
         $("#searchcrypdiv").hide("slow");
         $("#regdiv").hide("slow");
         $("#verifydiv").hide();
         $("#logindiv").show("slow");
        
       
     });




      
     $("#cryptosl").on("click", function (e) {
        // e.preventDefault();3
        $("#characterdiv").hide("slow");
        $("#employeediv").hide("slow");
        $("#homediv").hide("slow");
        $("#cryptodiv").hide("slow");
         $("#customerdiv").hide();
         $("#chartsdiv").hide();
         $("#buynftdiv").hide("slow");
         $("#mynftdiv").hide("slow");
         $("#logindiv").hide("slow");
         $("#tradediv").hide("slow");
         $("#regdiv").hide("slow");
         $("#searchcrypdiv").hide("slow");
         $("#searchnftdiv").hide("slow");
// $("#searchnftdiv").hide("slow");
$("#verifydiv").hide();
         $("#searchcrypdiv").show("slow");
       
       
     });
   
     $("#homel").on("click", function (e) {

        $("#characterdiv").hide("slow");
        $("#employeediv").hide("slow");
        $("#homediv").hide("slow");
        $("#cryptodiv").hide("slow");
         $("#customerdiv").hide();
         $("#chartsdiv").hide();
         $("#buynftdiv").hide("slow");
         $("#mynftdiv").hide("slow");
         $("#logindiv").hide("slow");
         $("#tradediv").hide("slow");
         $("#regdiv").hide("slow");
         $("#searchcrypdiv").hide("slow");
         $("#searchnftdiv").hide("slow");

         $("#searchcrypdiv").hide("slow");
         $("#verifydiv").hide();
         $("#homediv").show("slow");
       
       
     });

     
    
})