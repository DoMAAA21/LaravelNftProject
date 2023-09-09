





<body>
<div class="container">
    <h3 align="center">Customer NFT Transaction History</h3><br />
    <div class="row">
    <h2>Search Customer Total Data : <span id="total_records"></span></h2>
    <div class="col-12">
        <div class="form-group">
            <input type="text" name="search1" id="search1" class="form-control" placeholder="Search Customer Data" />
        </div>
        <div class="table-responsive">
            <table id="tbnft" class="table table-striped table-bordered">
            <thead>
                <tr>
                <th>Customer Name</th>
                 <th>Address</th>
                  <th>Zipcode</th>
                <th>Nickname</th>   
                <th>Date</th>
               
                </tr>
            </thead>
            <tbody ></tbody>
            </table>
        </div>
    </div>    
    </div>
</div>
<script>
$(document).ready(function(){
 
    fetch_customer_data();
 
    function fetch_customer_data(query1 = '')
    {
        $.ajax({
            url:"{{ route('action1') }}",
            method:'GET',
            data:{query1:query1},
            dataType:'json',
            success:function(data)
            {
                $('#tbnft tbody').html(data.table_data);
                $('#total_records').text(data.total_data);
            }
        })
    }
 
    $(document).on('keyup', '#search1', function(){
        //alert('hatdog')
        var query1 = $(this).val();
        fetch_customer_data(query1);
    });
});
</script>
</div>
