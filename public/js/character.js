$(document).ready(function () {


//Source

//window.onerror=ignoreerror();




    $("#chartable").DataTable({

        ajax: {
            url: "/api/character/index",
            dataSrc: "",
            
               
        },
        dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
        buttons: [{
                extend: 'pdf',
                className: 'btn btn-danger glyphicon glyphicon-file'
            },
            {
                extend: 'excel',
                className: 'btn btn-danger glyphicon glyphicon-list-alt'
            },
            {
                text: "Add Character",
                className: "btn btn-danger",
              
                action: function (e, dt, node, config) {
                    $("#charform").trigger("reset");
                    $("#charModal").modal("show");
                    $('#charSubmit').show();
                    $('#charupdate').hide();
                    $("#charform")[0].reset();
                    $('#ontrade').hide();
                    $('#lchupdate').hide();
                    $('#lchreate').show();
                   
                },
            },
        ],

       
        columns: [{
                        data: "id",
                    },
                    {
                        data: "nickname",
                    },
                    {
                        data: "class",
                    },
                    {
                        data: "strenght",
                    },
                    {
                        data: "agility",
                    },
                    {
                        data: "intelligence",
                    },
                    {
                        data: "price",
                    },
            {
                data: null,
                render: function (data, type, JsonResultRow, row) {
                    return '<img src="/storage/' + JsonResultRow.img_path + '" height="100px" width="100px">';
                }
            },
            {
                data: null,
                render: function (data, type, row) {
                    return "<a href='#' class='editBtn' id='cuseditbtn' data-id=" +
                        data.id +
                        "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" + data.id + "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>";
                },
            },
        ],
    });


    $("#charSubmit").on("click", function (e) {
        e.preventDefault();
        var data = $('#charform')[0];
        console.log(data);
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ',' + pair[1]);
        }

        console.log(data);
        $.ajax({
            type: "POST",
            url: "/api/character/",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "Authorization":'Bearer '+ sessionStorage.getItem('token'),
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('#charModal').modal("hide");
                var $itable = $('#chartable').DataTable();
                $itable.row.add(data.character).draw(true);
              
                    alert(data.success);
                    window.location = response.url;
                    
               
            },
            error: function (error) {
                console.log(error)
                alert("Error! Please Fill Up Neccessary Information");

               
            }

            
        })

    });


    $("#chartable tbody").on("click", 'a.deletebtn', function (e) {

        console.log(id);
    
    var table = $('#chartable').DataTable();
    var id = $(this).data("id");
    var $row = $(this).closest("tr");
    
    
    e.preventDefault();
    bootbox.confirm({
        message: "Do you want to delete this NFT Character?",
        buttons: {
            confirm: {
                label: "yes",
                className: "btn-success",
            },
            cancel: {
                label: "no",
                className: "btn-danger",
            },
        },
        callback: function (result) {
            console.log(result);
            if (result)
                $.ajax({
                    type: "DELETE",
                    url: "/api/character/" + id,
                    headers: {
                        "Authorization":'Bearer '+ sessionStorage.getItem('token'),
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        // bootbox.alert('success');
                        $row.fadeOut(4000, function () {
                            table.row($row).remove().draw(false);
                        });
                        bootbox.alert(data.success);
                    },
                    error: function (error) {
                        console.log("error");
                       
                    },
                });
        },
    });
    });



    
    $("#chartable tbody").on("click", 'a.editBtn', function (e) {
        e.preventDefault();
        $('#charModal').modal('show');
        var id = $(this).data("id");
        var $save = $('#charSubmit').hide();
        $('#charupdate').show();
        $('#lchupdate').show();
        $('#lchcreate').hide();
        $('#ontrade').show();      
        // $('#btnss').append('<button id="itemupdate" type="submit" class="btn btn-primary">Update</button>');

        $.ajax({
            type: "GET",
            enctype: 'multipart/form-data',
            processData: false, // Important!
            contentType: false,
            cache: false,
            url: "/api/character/" + id + "/edit",
            headers: {
                "Authorization":'Bearer '+ sessionStorage.getItem('token'),
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            dataType: "json",
            success: function (data) {

                    


                console.log(data);
                $('#char_id').val(data.id);
                $('#nickname').val(data.nickname);
             //   $('#class').val(data.class);
                $('#strenght').val(data.strenght);
                $('#agility').val(data.agility);
                $('#intelligence').val(data.intelligence);
                $('#price').val(data.price);
                // $('#email').val(data.email);
                // // $("#imagepath").html(
                //     <img src="/storage/${data.imagePath}" width="100" class="img-fluid img-thumbnail">);
                // $('#itemimage').val(data.imagePath);
            },
            error: function (error) {
                console.log("error");
                alert("Error! Please Fill Up Neccessary Information");
            },
        });
    });

   



    
    $("#charupdate").on("click", function (e) {
        var id = $("#char_id").val();
        e.preventDefault();
        var data = $('#charform')[0];
        console.log(data);
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ',' + pair[1]);
        }
        var table = $('#chartable').DataTable();
        table.ajax.reload();
        console.log(data);
        $.ajax({
            type: "POST",
            url: "/api/character/post/" + id,
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "Authorization":'Bearer '+ sessionStorage.getItem('token'),
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('#charModal').modal("hide");
              //  var $itable = $('#custable').DataTable();
                //$table.row.add(data.customer).draw(true);
                $('#chartable').DataTable().ajax.reload();
                    alert(data.success);
                    window.location = response.url;
                  //  $('#custable').DataTable().ajax.reload();
                  
               
            },
            error: function (error) {
                console.log(error)
                alert("Error! Please Fill Up Neccessary Information");
            }

            
        })

    });

//end Character



//Start Customer


  



   
        $("#custable").DataTable({

    //         paging: false,
    // searching: false,
            ajax: {
                url: "/api/customer/index",
                dataSrc: "",
            },
            dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
            buttons: [{
                    extend: 'pdf',
                    className: 'btn btn-danger glyphicon glyphicon-file'
                },
                {
                    extend: 'excel',
                    className: 'btn btn-danger glyphicon glyphicon-list-alt'
                },
                {
                    text: "Add Customer",
                    className: "btn btn-danger",
                    action: function (e, dt, node, config) {

                      
                        $("#iform").trigger("reset");
                        $("#cusModal").modal("show");
                        $('#cusSubmit').show();
                        $('#cusupdate').hide();
                        $("#cusform")[0].reset();
                       
                        $('#lupdate').hide();
                        $('#lcreate').show();
                       
                    },
                },
            ],
            columns: [{
                            data: "id",
                        },
                        {
                            data: "fname",
                        },
                        {
                            data: "lname",
                        },
                        {
                            data: "addressline",
                        },
                        {
                            data: "town",
                        },
                        {
                            data: "zipcode",
                        },
                        {
                            data: "phone",
                        },
                        {
                            data: "email",
                        },
                {
                    data: null,
                    render: function (data, type, JsonResultRow, row) {
                        return '<img src="/storage/' + JsonResultRow.img_path + '" height="100px" width="100px">';
                    }
                },
                {
                    data: null,
                    render: function (data, type, row) {
                        return "<a href='#' class='editBtn' id='cuseditbtn' data-id=" +
                            data.id +
                            "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='cusdeletebtn' data-id=" + data.id + "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>";
                    },
                },
            ],
        });








    $("#custable tbody").on("click", 'a.cusdeletebtn', function (e) {

        console.log(id);

    var table = $('#custable').DataTable();
    var id = $(this).data("id");
    var $row = $(this).closest("tr");

 
    e.preventDefault();
    bootbox.confirm({
        message: "Do you want to delete this Customer",
        buttons: {
            confirm: {
                label: "yes",
                className: "btn-success",
            },
            cancel: {
                label: "no",
                className: "btn-danger",
            },
        },
        callback: function (result) {
            console.log(result);
            if (result)
                $.ajax({
                    type: "DELETE",
                    url: "/api/customer/" + id,
                    headers: {
                        "Authorization":'Bearer '+ sessionStorage.getItem('token'),
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                         bootbox.alert('success');
                        $row.fadeOut(4000, function () {
                            table.row($row).remove().draw(false);
                        });
                        bootbox.alert(data.success);
                    },
                    error: function (error) {
                        console.log("error");
                        alert("Error! Please Fill Up Neccessary Information");
                    },
                });
        },
    });
});



    $("#cusSubmit").on("click", function (e) {
        e.preventDefault();
        var data = $('#cusform')[0];
        console.log(data);
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ',' + pair[1]);
        }

        console.log(data);
        $.ajax({
            type: "POST",
            url: "/api/customer/",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "Authorization":'Bearer '+ sessionStorage.getItem('token'),
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('#cusModal').modal("hide");
                var $itable = $('#custable').DataTable();
                $itable.row.add(data.customer).draw(true);
              
                    alert(data.success);
                    window.location = response.url;
                    
               
            },
            error: function (error) {
                console.log(error)
                alert("Error! Please Fill Up Neccessary Information");

               
            }

            
        })

    });

function btoken(){

    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        processData: false, // Important!
        contentType: false,
        cache: false,
        url: "/api/token",
        headers: {
            "Authorization":'Bearer '+ sessionStorage.getItem('token'),
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
        dataType: "json",
        success: function (data) {
                console.log(data);
         
            console.log(data.token);

            return(data.token);
           
        }
      
    });
    //return(data.token);
}


    $("#custable tbody").on("click", 'a.editBtn', function (e) {
        e.preventDefault();
        $('#cusModal').modal('show');
        var id = $(this).data("id");
        var $save = $('#cusSubmit').hide();
        $('#cusupdate').show();
        $('#lupdate').show();
        $('#lcreate').hide();
                       
        // $('#btnss').append('<button id="itemupdate" type="submit" class="btn btn-primary">Update</button>');

        $.ajax({
            type: "GET",
            enctype: 'multipart/form-data',
            processData: false, // Important!
            contentType: false,
            cache: false,
            url: "/api/customer/" + id + "/edit",
            headers: {
                "Authorization":'Bearer '+ sessionStorage.getItem('token'),
               
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            dataType: "json",
            success: function (data) {

                //token();

              //console.log(token);
                    //console.log(data.role);
                // let h = new headers();
                // h.append( "X-CSRF-TOKEN","X-CSRF-TOKEN",$('meta[name="csrf-token"]').attr(
                //     "content"
                // ))
                // h.append("Authorization",'Bearer '+ data.token);
                console.log(data);
                $('#cus_id').val(data.id);
                $('#fname').val(data.fname);
                $('#lname').val(data.lname);
                $('#addressline').val(data.addressline);
                $('#town').val(data.town);
                $('#zipcode').val(data.zipcode);
                $('#phone').val(data.phone);
                $('#email').val(data.email);
                // $("#imagepath").html(
                //     <img src="/storage/${data.imagePath}" width="100" class="img-fluid img-thumbnail">);
                // $('#itemimage').val(data.imagePath);
            },
            error: function (error) {
                console.log("error");
                alert("Error! Please Fill Up Neccessary Information");
            },
        });
    });

   



    
    $("#cusupdate").on("click", function (e) {
        var id = $("#cus_id").val();
        e.preventDefault();
        var data = $('#cusform')[0];
        console.log(data);
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ',' + pair[1]);
        }
        var table = $('#custable').DataTable();
        table.ajax.reload();
        console.log(data);
        $.ajax({
            type: "POST",
            url: "/api/customer/post/" + id,
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "Authorization":'Bearer '+ sessionStorage.getItem('token'),
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('#cusModal').modal("hide");
              //  var $itable = $('#custable').DataTable();
                //$table.row.add(data.customer).draw(true);
                $('#custable').DataTable().ajax.reload();
                    alert(data.success);
                    window.location = response.url;
                  //  $('#custable').DataTable().ajax.reload();
                  
               
            },
            error: function (error) {
                console.log(error)
                alert("Error! Please Fill Up Neccessary Information");
            }

            
        })

    });



//End Customer

//Start Employee

$("#emptable").DataTable({
    ajax: {
        url: "/api/employee/index",
        dataSrc: "",
    },
    dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
    buttons: [{
            extend: 'pdf',
            className: 'btn btn-danger glyphicon glyphicon-file'
        },
        {
            extend: 'excel',
            className: 'btn btn-danger glyphicon glyphicon-list-alt'
        },
        {
            text: "Add Employee",
            className: "btn btn-danger",
            action: function (e, dt, node, config) {
                $("#empform").trigger("reset");
                $("#empModal").modal("show");
                $('#empSubmit').show();
                $('#empupdate').hide();
                $("#empform")[0].reset();
               
                $('#leupdate').hide();
                $('#lecreate').show();
               
            },
        },
    ],
    columns: [{
                    data: "id",
                },
                {
                    data: "fname",
                },
                {
                    data: "lname",
                },
                {
                    data: "addressline",
                },
                {
                    data: "town",
                },
                {
                    data: "zipcode",
                },
                {
                    data: "phone",
                },
                {
                    data: "email",
                },
        {
            data: null,
            render: function (data, type, JsonResultRow, row) {
                return '<img src="/storage/' + JsonResultRow.img_path + '" height="100px" width="100px">';
            }
        },
        {
            data: null,
            render: function (data, type, row) {
                return "<a href='#' class='editBtn' id='cuseditbtn' data-id=" +
                    data.id +
                    "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" + data.id + "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>";
            },
        },
    ],
});




$("#empSubmit").on("click", function (e) {
    e.preventDefault();
    var data = $('#empform')[0];
    console.log(data);
    let formData = new FormData(data);
    console.log(formData);
    for (var pair of formData.entries()) {
        console.log(pair[0] + ',' + pair[1]);
    }

    console.log(data);
    $.ajax({
        type: "POST",
        url: "/api/employee/",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            "Authorization":'Bearer '+ sessionStorage.getItem('token'),
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            $('#empModal').modal("hide");
            var $itable = $('#emptable').DataTable();
            $itable.row.add(data.employee).draw(true);
          
                alert(data.success);
                window.location = response.url;
                
           
        },
        error: function (error) {
            console.log(error)
            alert("Error! Please Fill Up Neccessary Information");

           
        }

        
    })

});


$("#emptable tbody").on("click", 'a.deletebtn', function (e) {

    console.log(id);

var table = $('#emptable').DataTable();
var id = $(this).data("id");
var $row = $(this).closest("tr");


e.preventDefault();
bootbox.confirm({
    message: "Do you want to delete this Employee",
    buttons: {
        confirm: {
            label: "yes",
            className: "btn-success",
        },
        cancel: {
            label: "no",
            className: "btn-danger",
        },
    },
    callback: function (result) {
        console.log(result);
        if (result)
            $.ajax({
                type: "DELETE",
                url: "/api/employee/" + id,
                headers: {
                    "Authorization":'Bearer '+ sessionStorage.getItem('token'),
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    // bootbox.alert('success');
                    $row.fadeOut(4000, function () {
                        table.row($row).remove().draw(false);
                    });
                    bootbox.alert(data.success);
                },
                error: function (error) {
                    console.log("error");
                   
                },
            });
    },
});
});




$("#emptable tbody").on("click", 'a.editBtn', function (e) {
    e.preventDefault();
    $('#empModal').modal('show');
    var id = $(this).data("id");
    var $save = $('#empSubmit').hide();
    $('#empupdate').show();
    $('#leupdate').show();
    $('#lecreate').hide();
                   
    // $('#btnss').append('<button id="itemupdate" type="submit" class="btn btn-primary">Update</button>');

    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        processData: false, // Important!
        contentType: false,
        cache: false,
        url: "/api/employee/" + id + "/edit",
        headers: {
            "Authorization":'Bearer '+ sessionStorage.getItem('token'),
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            $('#emp_id').val(data.id);
            $('#efname').val(data.fname);
            $('#elname').val(data.lname);
            $('#eaddressline').val(data.addressline);
            $('#etown').val(data.town);
            $('#ezipcode').val(data.zipcode);
            $('#ephone').val(data.phone);
            $('#eemail').val(data.email);
            // $("#imagepath").html(
            //     <img src="/storage/${data.imagePath}" width="100" class="img-fluid img-thumbnail">);
            // $('#itemimage').val(data.imagePath);
        },
        error: function (error) {
            console.log("error");
            alert("Error! Please Fill Up Neccessary Information");
        },
    });
});






$("#empupdate").on("click", function (e) {
    var id = $("#emp_id").val();
    e.preventDefault();
    var data = $('#empform')[0];
    console.log(data);
    let formData = new FormData(data);
    console.log(formData);
    for (var pair of formData.entries()) {
        console.log(pair[0] + ',' + pair[1]);
    }

    var crow = $("tr td:contains(" + id + ")").closest("tr");
    var table = $('#emptable').DataTable();

    table.ajax.reload();
    console.log(data);
    console.log(crow);
    $.ajax({
        type: "POST",
        url: "/api/employee/post/" + id,
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            "Authorization":'Bearer '+ sessionStorage.getItem('token'),
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            $('#empModal').modal("hide");
          //  var $itable = $('#custable').DataTable();
          // $table.row.add(data.employee).draw(true);
           // table.row(crow).data(data.employee).invalidate().draw(true);
           $('#emptable').DataTable().ajax.reload();
                alert(data.success);
                window.location = response.url;
              
              
           
        },
        error: function (error) {
            console.log(error)
            alert("Error! Please Fill Up Neccessary Information");
        }

        
    })

});



//End Employee



//Start Crypto

var  liveprice = {
    "async" : true,
    "scroosDomain" :true,
    "url" : "https://api.coingecko.com/api/v3/simple/price?ids=bitcoin%2Cethereum&vs_currencies=usd",
    "method" : "GET",
    "headers" : {}

}


$.ajax(liveprice).done(function (response)
{
    console.log(response)

    var bitcoin = response.bitcoin.usd;
    console.log(bitcoin)
})


// $("#cryptable").DataTable({


//     ajax: {
//         url: "https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd",
//         dataSrc: "",
        
//     },
//     dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
//     buttons: [{
//             extend: 'pdf',
//             className: 'btn btn-success glyphicon glyphicon-file'
//         },
//         {
//             extend: 'excel',
//             className: 'btn btn-success glyphicon glyphicon-list-alt'
//         },
//         {
//             text: "Add Crypto",
//             className: "btn btn-success",
//             action: function (e, dt, node, config) {
//                 $("#crypform").trigger("reset");
//                 $("#crypModal").modal("show");
//                 $('#crypSubmit').show();
//                 $('#crypupdate').hide();
//                 $("#crypform")[0].reset();
               
//                 $('#lcupdate').hide();
//                 $('#lccreate').show();
//                 // console.log(data);
               
//             },
//         },
//     ],
//     columns: [{
//                     data: "id" ,  
//                     //response.bitcoin.usd,
//                 },
//                 {
//                     data: "name",
//                 },
//                 {
//                     data: "stock",
//                 },
//                 {
//                     data: "points",
//                 },
//                 {
//                     data: "current_price",
//                 },
//                 {
//                     data: "status",
//                 },
               
//         {
//             data: null,
//             render: function (data, type, JsonResultRow, row) {
//                 return '<img src=' + data.image + ' height="100px" width="100px">';
//             }
//         },
//         {
//             data: null,
//             render: function (data, type, row) {
//                 return "<a href='#' class='editBtn' id='crypeditbtn' data-id=" +
//                     data.id +
//                     "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='crypdeletebtn' data-id=" + data.id + "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>";
//             },
//         },
//     ],
    
// });


// $("#crypSubmit").on("click", function (e) {
//     e.preventDefault();
//     var data = $('#crypform')[0];
//     console.log(data);
//     let formData = new FormData(data);
//     console.log(formData);
//     for (var pair of formData.entries()) {
//         console.log(pair[0] + ',' + pair[1]);
//     }

//     console.log(data);
//     $.ajax({
//         type: "POST",
//         url: "/api/crypto/",
//         data: formData,
//         contentType: false,
//         processData: false,
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         dataType: "json",
//         success: function (data) {
//             console.log(data);
//             $('#crypModal').modal("hide");
//             var $itable = $('#cryptable').DataTable();
//             $itable.row.add(data.crypto).draw(true);
          
//                 alert(data.success);
//                 window.location = response.url;
                
           
//         },
//         error: function (error) {
//             console.log(error)
//             alert("Error! Please Fill Up Neccessary Information");

           
//         }

        
//     })





// });


// $("#cryptable tbody").on("click", 'a.crypdeletebtn', function (e) {

//     console.log(id);

// var table = $('#cryptable').DataTable();
// var id = $(this).data("id");
// var $row = $(this).closest("tr");


// e.preventDefault();
// bootbox.confirm({
//     message: "Do you want to delete this Crypto",
//     buttons: {
//         confirm: {
//             label: "yes",
//             className: "btn-success",
//         },
//         cancel: {
//             label: "no",
//             className: "btn-danger",
//         },
//     },
//     callback: function (result) {
//         console.log(result);
//         if (result)
//             $.ajax({
//                 type: "DELETE",
//                 url: "/api/crypto/" + id,
//                 headers: {
//                     "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
//                         "content"
//                     ),
//                 },
//                 dataType: "json",
//                 success: function (data) {
//                     console.log(data);
//                     // bootbox.alert('success');
//                     $row.fadeOut(4000, function () {
//                         table.row($row).remove().draw(false);
//                     });
//                     bootbox.alert(data.success);
//                 },
//                 error: function (error) {
//                     console.log("error");
                   
//                 },
//             });
//     },
// });
// });





// $("#cryptable tbody").on("click", 'a.editBtn', function (e) {
//     e.preventDefault();
//     $('#crypModal').modal('show');
//     var id = $(this).data("id");
//     var $save = $('#crypSubmit').hide();
//     $('#crypupdate').show();
//     $('#lcupdate').show();
//     $('#lccreate').hide();
                   
//     // $('#btnss').append('<button id="itemupdate" type="submit" class="btn btn-primary">Update</button>');

//     $.ajax({
//         type: "GET",
//         enctype: 'multipart/form-data',
//         processData: false, // Important!
//         contentType: false,
//         cache: false,
//         url: "/api/crypto/" + id + "/edit",
//         headers: {
//             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
//                 "content"
//             ),
//         },
//         dataType: "json",
//         success: function (data) {
//             console.log(data);
//             $('#cryp_id').val(data.id);
//             $('#name').val(data.name);
//             $('#info').val(data.info);
//             $('#founder').val(data.founder);
//             $('#stock').val(data.stock);
//             $('#status').val(data.status);
//             $('#points').val(data.points);
//             $('#price').val(data.price);
          
//             // $("#imagepath").html(
//             //     <img src="/storage/${data.imagePath}" width="100" class="img-fluid img-thumbnail">);
//             // $('#itemimage').val(data.imagePath);
//         },
//         error: function (error) {
//             console.log("error");
//             alert("Error! Please Fill Up Neccessary Information");
//         },
//     });
// });






// $("#crypupdate").on("click", function (e) {
//     var id = $("#cryp_id").val();
//     e.preventDefault();
//     var data = $('#crypform')[0];
//     console.log(data);
//     let formData = new FormData(data);
//     console.log(formData);
//     for (var pair of formData.entries()) {
//         console.log(pair[0] + ',' + pair[1]);
//     }

//     var crow = $("tr td:contains(" + id + ")").closest("tr");
//     var table = $('#cryptable').DataTable();

//     table.ajax.reload();
//     console.log(data);
//     console.log(crow);
//     $.ajax({
//         type: "POST",
//         url: "/api/crypto/post/" + id,
//         data: formData,
//         contentType: false,
//         processData: false,
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         dataType: "json",
//         success: function (data) {
//             console.log(data);
//             $('#crypModal').modal("hide");
//           //  var $itable = $('#custable').DataTable();
//           // $table.row.add(data.employee).draw(true);
//            // table.row(crow).data(data.employee).invalidate().draw(true);
//            $('#cryptable').DataTable().ajax.reload();
//                 alert(data.success);
//                 window.location = response.url;
              
              
           
//         },
//         error: function (error) {
//             console.log(error)
//             alert("Error! Please Fill Up Neccessary Information");
//         }

        
//     })

// });









//End Crypto


//Start MyCrypto


$("#crypto_ownedtable").DataTable({
    ajax: {
        url: "/api/crypto/index",
        dataSrc: "",
    },
    dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
    buttons: [{
            extend: 'pdf',
            className: 'btn btn-danger glyphicon glyphicon-file'
        },
        {
            extend: 'excel',
            className: 'btn btn-danger glyphicon glyphicon-list-alt'
        },
        {
            text: "Add Crypto",
            className: "btn btn-danger",
            action: function (e, dt, node, config) {
                $("#employeediv").hide("slow");
                $("#customerdiv").hide("slow");
                $("#homediv").hide("slow");
                $("#chartsdiv").hide("slow");
                
                 $("#characterdiv").hide("slow");
                 $("#buynftdiv").hide();
                 $("#mynftdiv").hide("slow");
                 $("#cryptodiv").show("slow");
               
            },
        },
    ],
    columns: [
                 {
                    data: "id",
                 },      
                 {
                    data: "crypto_id",
                },
                {
                    data: "qty",
                },
              
                {
                    data: "price",
                },
             
               
        {
            data: null,
            render: function (data, type, JsonResultRow, row) {
                return '<img src="' + JsonResultRow.img_path + '" height="100px" width="100px">';
            }
        },
        {
            data: null,
            render: function (data, type, row) {
                return "<a href='#' class='editBtn' id='cuseditbtn' data-id=" +
                    data.id +
                    "><i class='fas fa-shipping-fast' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" + data.id + "><i class='fa fa-dollar' style='font-size:24px; color:red; margin-left:15px;'></a></i>";
            },
        },
    ],
});






$("#crypto_ownedtable tbody").on("click", 'a.deletebtn', function (e) {

    console.log(id);

var table = $('#crypto_ownedtable').DataTable();
var id = $(this).data("id");
var $row = $(this).closest("tr");


e.preventDefault();
bootbox.confirm({
    message: "Do you want to Sellout this Crypto?",
    buttons: {
        confirm: {
            label: "yes",
            className: "btn-success",
        },
        cancel: {
            label: "no",
            className: "btn-danger",
        },
    },
    callback: function (result) {
        console.log(result);
        if (result)
            $.ajax({
                type: "DELETE",
                url: "/api/crypto/" + id,
                headers: {
                    "Authorization":'Bearer '+ sessionStorage.getItem('token'),
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    // bootbox.alert('success');
                    $row.fadeOut(4000, function () {
                        table.row($row).remove().draw(false);
                    });
                    bootbox.alert(data.success);
                    bootbox.alert("Profit:" + data.profit);
                },
                error: function (error) {
                    console.log("error");
                   
                },
            });
    },
});
});




$("#crypto_ownedtable tbody").on("click", 'a.editBtn', function (e) {
    e.preventDefault();
    $('#crypModal').modal('show');
    var id = $(this).data("id");
    var $save = $('#crypSubmit').hide();
    $('#crypupdate').show();
    $('#lcupdate').show();
    $('#lccreate').hide();
                   
    // $('#btnss').append('<button id="itemupdate" type="submit" class="btn btn-primary">Update</button>');

    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        processData: false, // Important!
        contentType: false,
        cache: false,
        url: "/api/crypto/" + id + "/edit",
        headers: {
            "Authorization":'Bearer '+ sessionStorage.getItem('token'),
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            $('#cryp_id').val(data.id);
            $('#name').val(data.crypto_id);
            $('#crypto_id').val(data.crypto_id);
            $('#lprice').val(data.price);
            $('#lprc').val(data.price);
            $('#qty').val(data.qty);
        
            
            $('#price').val(data.price);
        },
        error: function (error) {
            console.log("error");
            alert("Error! Please Fill Up Neccessary Information");
        },
    });
});






$("#crypupdate").on("click", function (e) {
    var id = $("#cryp_id").val();
    e.preventDefault();
    var data = $('#crypform')[0];
    console.log(data);
    let formData = new FormData(data);
    console.log(formData);
    for (var pair of formData.entries()) {
        console.log(pair[0] + ',' + pair[1]);
    }

    var crow = $("tr td:contains(" + id + ")").closest("tr");
    var table = $('#cryptable').DataTable();

    table.ajax.reload();
    console.log(data);
    console.log(crow);
    $.ajax({
        type: "POST",
        url: "/api/crypto/post/" + id,
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            "Authorization":'Bearer '+ sessionStorage.getItem('token'),
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            $('#crypModal').modal("hide");
        
           $('#crypto_ownedtable').DataTable().ajax.reload();
           $('#trdtable').DataTable().ajax.reload();
                alert(data.success);
                //window.location = response.url;
              
              
           
        },
        error: function (error) {
            console.log(error)
            alert("Error! Please Fill Up Neccessary Information");
        }

        
    })

});






//END CRYPTO


// START TRADE


$("#trdtable").DataTable({
    ajax: {
        url: "/api/trade-all",
        dataSrc: "",
    },
    dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
    buttons: [{
            extend: 'pdf',
            className: 'btn btn-danger glyphicon glyphicon-file'
        },
        {
            extend: 'excel',
            className: 'btn btn-danger glyphicon glyphicon-list-alt'
        },
        {
            text: "Check Market",
            className: "btn btn-danger",
            action: function (e, dt, node, config) {
                $("#employeediv").hide("slow");
                $("#customerdiv").hide("slow");
                $("#homediv").hide("slow");
                $("#chartsdiv").hide("slow");
                
                 $("#characterdiv").hide("slow");
                 $("#buynftdiv").hide();
                 $("#mynftdiv").hide("slow");
                 $("#tradediv").hide("slow");
                 $("#cryptodiv").show("slow");
               
            },
        },
    ],
    columns: [
                 {
                    data: "id",
                 },      
                 {
                    data: "crypto_id",
                },
                {
                    data: "qty",
                },
              
                {
                    data: "cprice",
                },
             
               
        {
            data: null,
            render: function (data, type, JsonResultRow, row) {
                return '<img src="' + JsonResultRow.img_path + '" height="100px" width="100px">';
            }
        },
        {
            data: null,
            render: function (data, type, row) {
                return "<a href='#' class='editBtn' id='cuseditbtn' data-id=" +
                    data.id +
                    "><i class='fas fa-balance-scale' aria-hidden='true' style='font-size:24px' ></i>";
            },
        },
    ],
});



$("#trdtable tbody").on("click", 'a.editBtn', function (e) {

    console.log(id);

var table = $('#trdtable').DataTable();
var id = $(this).data("id");
var $row = $(this).closest("tr");


e.preventDefault();
bootbox.confirm({
    message: "Do you want to Buy this Crypto?",
    buttons: {
        confirm: {
            label: "yes",
            className: "btn-success",
        },
        cancel: {
            label: "no",
            className: "btn-danger",
        },
    },
    callback: function (result) {
        console.log(result);
        if (result)
            $.ajax({
                type: "POST",
                url: "/api/trade/crypto/" + id,
                headers: {
                    "Authorization":'Bearer '+ sessionStorage.getItem('token'),
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (data) {
                    console.log(data);
                   // bootbox.alert('success');
                    $row.fadeOut(4000, function () {
                        table.row($row).remove().draw(false);
                    });
                    bootbox.alert(data.success);
                    $('#crypto_ownedtable').DataTable().ajax.reload();
                    
                 $('#trdtable').DataTable().ajax.reload();
                },
                error: function (error) {
                    console.log("error");
                   
                },
            });
    },
});
});

// END TRADE


//HOME
// $("#hometable").DataTable({

//     ajax: {
//         url: "/api/homedashboard",
//         dataSrc: "",
        
           
//     },

//     order: [[3, 'desc']],
//     "paging":   false,
//     "ordering": false,
//     "info":     false,
//     "searching":     false,
    

   
//     columns: [{
//                     data: "notes",
//                 },
//                 {
//                     data: "nickname",
//                 },
//                 {
//                     data: "class",
//                 },
//                 {
//                     data: "strenght",
//                 },
//                 {
//                     data: "agility",
//                 },
//                 {
//                     data: "intelligence",
//                 },
//                 {
//                     data: "price",
//                 },
//         {
//             data: null,
//             render: function (data, type, JsonResultRow, row) {
//                 return '<img src="/storage/' + JsonResultRow.img_path + '" height="100px" width="100px">';
//             }
//         },
//         {
//             data: null,
//             render: function (data, type, row) {
//                 return "<a href='#' class='editBtn' id='cuseditbtn' data-id=" +
//                     data.id +
//                     "><i class='fa-solid fa-pen' aria-hidden='true' style='font-size:24px' ></i></a><a href='#' class='deletebtn' data-id=" + data.id + "><i class='fa-solid fa-trash-can' style='font-size:24px; color:red; margin-left:15px;'></a></i>";
//             },
//         },
//     ],
// });



$("#hometable").DataTable({
    "order": [[ 0, "desc" ]],
    ajax: {
        url: "/api/homedashboard",
        dataSrc: "",
        // order: [[3, 'desc']],
            
        order: [[0, 'desc']],
            
          
            "dom": 'rtip',
            "bPaginate": false,
        "bFilter": false,
        "bInfo": false
    },
    info:     false,
    paging:   false,
    searching: false,
    
    columns: [
                {
                    data: "note",
                },
               
     
       
    ],
});


//END HOME

//BALANCE

$("#baltable").DataTable({

    fnDrawCallback: function() {
        $("#baltable thead").remove();
      },
    
    "order": [[ 0, "desc" ]],
    ajax: {
        url: "/api/homebalance",
        dataSrc: "",
        // order: [[3, 'desc']],
            
        order: [[0, 'desc']],
            
          
            "dom": 'rtip',
            "bPaginate": false,
        "bFilter": false,
        "bInfo": false
    },
    info:     false,
    paging:   false,
    searching: false,



    
    
    columns: [
                {
                    data: "balance",
                },
               
     
       
    ],
});


$("#addSubmit").on("click", function (e) {
    e.preventDefault();
    var data = $('#addform')[0];
    console.log(data);
    let formData = new FormData(data);
    console.log(formData);
    for (var pair of formData.entries()) {
        console.log(pair[0] + ',' + pair[1]);
    }

    console.log(data);
    $.ajax({
        type: "POST",
        url: "/api/homebalanceadd/",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            "Authorization":'Bearer '+ sessionStorage.getItem('token'),
            
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            
            $('#addModal').modal("hide");

            $('#baltable').DataTable().ajax.reload();
            $('#hometable').DataTable().ajax.reload();
            // var $itable = $('#custable').DataTable();
            // $itable.row.add(data.customer).draw(true);
            alert('Succesfully Recharged');
            //     alert(data.success);
            //     window.location = response.url;
                
           
        },
        error: function (error) {
            console.log(error)
            alert("Error! Please Fill Up Neccessary Information");

           
        }

        
    })

});

//END BALANCE

});