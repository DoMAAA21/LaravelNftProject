$(document).ready(function () {

    // $('#search1').on('keyup', function()
    // {
    //  alert('hello')
    // $value=$(this).val();
    
    // $.ajax({
    
    //     type : 'GET',
    //     url : '/search',
    //     data: {'search':$value},
    
    //     success::function(data)
    //     {
    //         console.log(data)
    
    //         $('#content').html(data);
    //     }
    
    //     });
    
    // })


    $("#search1").on("keyup", function (e) {

        //console.log(id);
     //   alert('hello')
   

        var value =  $("#search1").val();

        if(value)
        {
                
        }
        else
        {

        }
    
 
        console.log(value);
       
       
                $.ajax({
                    type: "POST",
                    url: "/api/search",
                    data: value, 
    
                    success: function (data) {

                        console.log(data)
                        $('#content1').html(data);

                    },
                    error: function (error) {
                        console.log("error");
                       
                    },
                });

 
    });


});  