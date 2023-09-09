

<body>
<div class="container">
    <h3 align="center">Customer Crypto Transaction History</h3><br />
    <div class="row">
    <h2>Search Customer Total Data : <span id="total_records"></span></h2>
    <div class="col-12">
        <div class="form-group">
            <input type="text" name="search" id="search" class="form-control" placeholder="Search Customer Data" />
        </div>
        <div class="table-responsive">
            <table id="tbcryp" class="table table-striped table-bordered">
            <thead>
                <tr>
                <th>Customer Name</th>
                 <th>Address</th>
                  <th>Zipcode</th>
                <th>Crypto</th>
                <th>Quantity</th>
                <th>Date</th>
               
                </tr>
            </thead>
            <tbody></tbody>
            {{-- </table> --}}
        </div>
    </div>    
    </div>
</div>
<script>
$(document).ready(function(){
 
    fetch_customer_data();
 
    function fetch_customer_data(query = '')
    {
        $.ajax({
            url:"{{ route('action') }}",
            method:'GET',
            data:{query:query},
            dataType:'json',
            success:function(data)
            {
                $('#tbcryp tbody').html(data.table_data);
                $('#total_records').text(data.total_data);
            }
        })
    }
 
    $(document).on('keyup', '#search', function(){
        //alert('hatdog')
        var query = $(this).val();
        fetch_customer_data(query);
    });
});
</script>
</body>
</div>