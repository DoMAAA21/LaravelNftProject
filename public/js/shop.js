var itemCount = 0;
var priceTotal = 0.00;
var quantity = 0;
var clone = "";


var citemCount = 0;
var cpriceTotal = 0.00;
var cquantity = 0;
var cclone = "";

$(document).ready(function () {



    $.ajax({
        type: "GET",
        url: "https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd",
        dataType: 'json',
        success: function (data) {
            console.log(data);
         
            $.each(data, function (key, value) {
                console.log(value);
                //console.log(data);
                id = value.id;
                var cryp = "<div class='item'><div class='itemDetails'><div class='itemImage'><img src="  + value.image +
                    " width='200px', height='200px'/></div><div class='itemText'><p class='price-container'>Price:$ <span class='price'>" + value.current_price +
                    "</span></p><p>" +  value.name + "</p></div><input type='number'id='qty' class='qty' value='1' name='quantity' min='1' max='100'><input type='hidden' id ='cid' class='itemId' value=" + value.id +
                    "></p><input type='hidden' id ='cimg' class='cimg' value=" + value.image +
                    "></p><input type='hidden' id ='cprc' class='cprc' value=" + value.current_price +
                    "></p>        </div><button type='button' class='btn btn-primary add' style='margin-top:5px;'>Add to cart</button></div>";
                $("#items").append(cryp);

            });

        },
        error: function () {
            console.log('AJAX load did not work');
            alert("error");
        }
    });
 $('#cartclosebtn').on("click", function (e) {

    $('#shoppingCart').hide();


 })

    $("#items").on('click', '.add', function () {
    var cid = $('#cid').val;
        
        itemCount++;
       // let qty = 0;
        // qty = $("#qty").val();
        $('#itemCount').text(itemCount).css('display', 'block');
        clone = $(this).siblings().clone().appendTo('#cartItems')
            .append('<button class="removeItem">Remove Item</button>');
        var price = parseInt($(this).siblings().find('.price').text());
        var qty = parseInt($(this).siblings().find('#qty').val());
        priceTotal += price * qty;
        $('#cartTotal').text("Total: $" + priceTotal);
  
    });


    $('.openCloseCart').click(function () {
        $('#shoppingCart').toggle();
    });

    $('#shoppingCart').on('click', '.removeItem', function () {
        $(this).parent().remove();
        itemCount--;

       
      
        $('#itemCount').text(itemCount);

        // Remove Cost of Deleted Item from Total Price
        var price = parseInt($(this).siblings().find('.price').text());
        // var qty =parseInt($('#itemDetails').siblings().find('#qty').val());

        //var qty= qty = $("#qty").val();

      var qty  =   $(this).parent().find('input.qty').val();
      console.log(qty);
        priceTotal -= (price * qty);

        
        $('#cartTotal').text("Total: php" + priceTotal);

        if (itemCount == 0) {
            $('#itemCount').css('display', 'none');
        }
    });

    $('#emptyCart').click(function () {
        itemCount = 0;
        priceTotal = 0;

        $('#itemCount').css('display', 'none');
        $('#cartItems').text('');
        $('#cartTotal').text("Total: $" + priceTotal);
    });

    $('#checkout').click(function () {
        itemCount = 0;
        priceTotal = 0;
        let items = new Array();


      
        $("#cartItems").find(".itemDetails").each(function (i, element) {
            // console.log(element);
            let itemid = 'null';
            let qty = 0;
            let prc = 0;
            let img = 'default.jpg';

            qty = parseInt($(element).find($(".qty")).val());
           //itemid = $(this).siblings().find('.itemId').val();
           //itemid = $(this).siblings().find('.itemId').val();
      //   itemid = $(this).nextAll('#cid').val();
           itemid = $(element).find($(".itemId")).val();
           prc = parseFloat($(element).find($(".cprc")).val())
           img  = $(element).find($(".cimg")).val();
         console.log(itemid)
            items.push({
                "item_id": itemid,
                "quantity": qty,
                "price": prc,
                "image": img
            });

        });
        console.log(JSON.stringify(items));
        var data = JSON.stringify(items);

        $.ajax({
            type: "POST",
            url: "/api/item/checkout",
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            processData: false,
            contentType: 'application/json; charset=utf-8',
            success: function (data) {
                console.log(data);
                alert(data.status);

                $('#crypto_ownedtable').DataTable().ajax.reload();
            },
            error: function (error) {
                alert(data.status);
                
            }
        });
        $('#itemCount').css('display', 'none');
        $('#cartItems').text('');
        $('#cartTotal').text("Total: P" + priceTotal);
        $('#shoppingCart').css('display', 'none');

        // console.log(clone.find(".itemDetails"));

    });


//Character Cart
char();
function char()
{
$.ajax({
    type: "GET",
    url: "/api/characters-all",
    dataType: 'json',
    success: function (data) {
        console.log(data);
     
        $.each(data, function (key, value) {
            console.log(value);
            //console.log(data);
            id = value.id;
            var cryp = "<div class='citem'><div class='citemDetails'><div class='citemImage'><img src=/storage/"  + value.img_path +
                " width='200px', height='200px'/></div><div class='citemText'><p class='cprice-container'>Price:$ <span class='cprice'>" + value.price +
                "</span></p><p>" +  value.nickname + "</p></div><input type='hidden'id='cqty' class='cqty' value='1' name='quantity' min='1' max='100'><input type='hidden' id ='ccid' class='citemId' value=" + value.id +
                "></p>      </div><button type='button' class='btn btn-primary cadd' style='margin-top:5px;'>Add to cart</button></div>";
            $("#citems").append(cryp);

        });

    },
    error: function () {
        console.log('AJAX load did not work');
        alert("error");
    }
});
}

$('#ccartclosebtn').on("click", function (e) {

    $('#cshoppingCart').hide();


 })

 $("#citems").on('click', '.cadd', function () {
    
        
        citemCount++;
       // let qty = 0;
        // qty = $("#qty").val();
        $('#citemCount').text(citemCount).css('display', 'block');
        clone = $(this).siblings().clone().appendTo('#ccartItems')
            .append('<button class="cremoveItem">Remove Item</button>');
        var cprice = parseInt($(this).siblings().find('.cprice').text());
        var cqty = parseInt($(this).siblings().find('#cqty').val());
       cpriceTotal += cprice * cqty;
        $('#ccartTotal').text("Total: $" + cpriceTotal);
  
    });


    
    $('.copenCloseCart').click(function () {
        $('#cshoppingCart').show();
    });


    $('#cshoppingCart').on('click', '.cremoveItem', function () {
        $(this).parent().remove();
        citemCount--;

       
      
        $('#citemCount').text(citemCount);

        // Remove Cost of Deleted Item from Total Price
        var cprice = parseInt($(this).siblings().find('.cprice').text());
        // var qty =parseInt($('#itemDetails').siblings().find('#qty').val());

        //var qty= qty = $("#qty").val();

      var cqty  =   $(this).parent().find('input.cqty').val();
      console.log(cqty);
        cpriceTotal -= (cprice * cqty);

        
        $('#ccartTotal').text("Total: $" + cpriceTotal);

        if (itemCount == 0) {
            $('#citemCount').css('display', 'none');
        }
    });




    $('#emptyCart').click(function () {
        citemCount = 0;
        cpriceTotal = 0;

        $('#citemCount').css('display', 'none');
        $('#ccartItems').text('');
        $('#ccartTotal').text("Total: $" + cpriceTotal);
    });

    $('#ccheckout').click(function () {
        citemCount = 0;
        cpriceTotal = 0;
        let citems = new Array();


      
        $("#ccartItems").find(".citemDetails").each(function (i, element) {
            // console.log(element);
            let citemid = 'null';
            let cqty = 0;

            cqty = parseInt($(element).find($(".cqty")).val());
          //  citemid = $("#ccid").val();

         // citemid = $(element).find($("#ccid")).val();
          citemid = $(element).find($(".citemId")).val();
            //citemid =  parseInt($(this).siblings().find('#ccid').val());
           // itemid = document.getElementById('#cid').value;
         //itemid =  $("#cid").val();

         console.log(citemid)
            citems.push({
                "item_id": citemid,
                "quantity": cqty
            });

        });
        console.log(JSON.stringify(citems));
        var data = JSON.stringify(citems);

        $.ajax({
            type: "POST",
            url: "/api/citem/ccheckout",
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            processData: false,
            contentType: 'application/json; charset=utf-8',
            success: function (data) {
                console.log(data);
                alert(data.status);

                $('#chartable').DataTable().ajax.reload();

                //const element = document.getElementById('invoice');
				// Choose the element and save the PDF for your user.
               // $('#citems').load(location.href + "#citems");
               //$("#citems").remove();
            //    char();
			// 	var pdf = html2pdf().from(data.pdf).save();

               
            },
            error: function (error) {
                alert(data.status);
            }
        });
        $('#citemCount').css('display', 'none');
        $('#ccartItems').text('');
        $('#ccartTotal').text("Total: P" + priceTotal);
        $('#cshoppingCart').css('display', 'none');

        // console.log(clone.find(".itemDetails"));

    });




    


}) 
