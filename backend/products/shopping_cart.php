<?php  include 'header.php';?>
<section class="dir-alp dir-pa-sp-top custom_products_details custom_products_list">
    <div class="top_section">
        <div class="container">
            <div class="row">
                <div class="dir-alp-tit">
                    <h1>Shopping Cart</h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>product/all_product">Home</a> </li>
                        <li class="active">Shop Cart</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row shopping_cart" >
            <div class="table-responsive">
                <table class="table ">
                    <col style="width: 70%;">
                    <col style="width: 5%;">
                    <col style="width: 15%;">
                    <col style="width: 25%;">
                    <col style="width: 5%;">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody id="show_data">
                    <tfoot id="table-footer">
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>
<!--MOBILE APP-->
<section class="web-app com-padd">
    <div class="container">
        <div class="row">
            <div class="col-md-6 web-app-img"> <img src="images/mobile.png" alt="" /> </div>
            <div class="col-md-6 web-app-con">
                <h2>Looking for the Best Service Provider? <span>Get the App!</span></h2>
                <ul>
                    <li><i class="fa fa-check" aria-hidden="true"></i> Find nearby listings</li>
                    <li><i class="fa fa-check" aria-hidden="true"></i> Easy service enquiry</li>
                    <li><i class="fa fa-check" aria-hidden="true"></i> Listing reviews and ratings</li>
                    <li><i class="fa fa-check" aria-hidden="true"></i> Manage your listing, enquiry and reviews</li>
                </ul> <span>We'll send you a link, open it on your phone to download the app</span>
                <form>
                    <ul>
                        <li>
                            <input type="text" placeholder="+01" /> </li>
                        <li>
                            <input type="number" placeholder="Enter mobile number" /> </li>
                        <li>
                            <input type="submit" value="Get App Link" /> </li>
                    </ul>
                </form>
                <a href="#"><img src="images/android.png" alt="" /> </a>
                <a href="#"><img src="images/apple.png" alt="" /> </a>
            </div>
        </div>
    </div>
</section>
<!--FOOTER SECTION-->
<?php include 'footer.php';?>


<script src="<?php echo base_url(); ?>products/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>products/js/bootstrap.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        show_product();
        function show_product() {
            var u_id = "<?php echo $this->session->userdata('uid') ?>";
            $.ajax({
                type: 'ajax',
                url: 'https://velloreads.com/cart/product_data',
                async: true,
                dataType: 'json',
                type:"POST",
                data:{id:u_id},
                success: function (data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<tr>' +
                            '<td class="col-sm-8 col-md-6"> <div class="media"> <a class="thumbnail pull-left" href="products/product_details/'+ data[i].product_id +'"> <img class="media-object" src="https://velloreads.com/assets/images/list-deta/' + data[i].product_image + '" style="width: 72px; height: 72px;"> <div class="media-body">  <h4 class="media-heading"><a href="https://velloreads.com/shopping/listings/products/product_details/'+ data[i].product_id +'">' + data[i].product_name + '</a></h4></div></img></a></td></div>' +
                            '<td  class="col-md-1 text-center"><div class="cart-info quantity"><div class="btn-increment-decrement" onclick="decrement_quantity(' + data[i].id + ')">-</div>  <input class="input-quantity" id="input-quantity-' + data[i].id + '" value="' + data[i].product_quantity + '"> <div class="btn-increment-decrement" onclick="increment_quantity(' + data[i].id + ')">+</div> </div></td>' +
                            '<td class="col-md-1 text-center"><strong><i class="fa fa-inr"></i>' + data[i].product_price + '</strong></td>' +
                            '<td class="col-md-1 text-center"><strong><i class="fa fa-inr"></i>' + data[i].product_price * data[i].product_quantity + '</strong></td>' +
                            '<td class="col-md-1">' +
                            ' <button type="button" class="btn btn-danger remove-item" data-productid=' + data[i].id + '>' +
                            ' <i class="fa fa-times" aria-hidden="true"></i>' +
                            ' </button></td>' +
                            '</tr>';
                    }
                    var htmlfooter = '';
                    if(data.length > 0) {
                        htmlfooter += '<tr>' +
                            '<td></td>' +
                            '<td colspan="4" class="subtotal">'+
                            '<div class="col-md-6 col-xs-6">Total</div>'+
                            '<div class="col-md-4 col-xs-4 align_right"><i class="fa fa-inr"></i>'+
                            <?php
                                $userId = $this->session->userdata('uid');
                                $this->db->where('u_id', $userId);
                                $query = $this->db->select('*')->from('product_cart')->get();
                                $item_quantity = 0;
                                $item_price = 0;
                                foreach ($query->result() as $row)
                                {
                                    $item_quantity = $item_quantity +  $row->product_quantity;
                                    $item_price = $item_price + ($row->product_price * $row->product_quantity);

                                }
                                echo $item_price; ?>+'</i></div>'+
                            '</td>'+
                            '</tr>'+
                            ' <tr>' +
                            '<td></td>' +
                            '<td colspan="5" class="shopping_btn">' +
                            // '<button type="button" style="margin-right: 5px" class="btn btn-default continue_shopping" onclick="window.location.href = \'all_product\';">' +
                            // ' <i class="fa fa-shopping-cart" aria-hidden="true"></i> Continue Shopping' +
                            // ' </button>' +
                            '<button type="button" class="btn btn-success checkout"  onclick="window.location.href = \'checkout\';">' +
                            ' Checkout <i class="fa fa-chevron-right" aria-hidden="true"></i>' +
                            ' </button>' +
                            '</td>' +
                            '</tr>';

                    } else {
                        htmlfooter += '<tr>' +
                            '<td class="text-right"><b>No Result Found</b></td>' +
                            '</tr>';
                    }
                    $('#show_data').html(html);
                    $('#table-footer').html(htmlfooter);

                }
            });
        }

        $(document).on('click', '.remove-item', function () {
            var product_id = $(this).data("productid");
            var u_id = "<?php echo $this->session->userdata('uid') ?>";
            $.ajax({
                url:"https://velloreads.com/cart/delete_data",
                type:"POST",
                data:{id:product_id, u_id:u_id},
                success:function(resp){
                    window.location.reload();
                },
                error:function (resp) {
                    alert(resp)
                }
            });

        });

    });

    function decrement_quantity(cart_id){
        var inputQuantityElement = $("#input-quantity-"+cart_id);
        if($(inputQuantityElement).val() > 1)
        {
            var newQuantity = parseInt($(inputQuantityElement).val()) - 1;
            save_to_db(cart_id, newQuantity);
        }
    }
    function increment_quantity(cart_id) {
        var inputQuantityElement = $("#input-quantity-"+cart_id);
        var newQuantity = parseInt($(inputQuantityElement).val())+1;
        save_to_db(cart_id, newQuantity);
    }
    function save_to_db(cart_id, new_quantity) {
        var inputQuantityElement = $("#input-quantity-"+cart_id);
        $.ajax({
            url : "https://velloreads.com/cart/update_data",
            data : "cart_id="+cart_id+"&new_quantity="+new_quantity,
            type : 'post',
            success : function(response) {
                window.location.reload();
            }
        });
    }
    function show_product() {
        var u_id = "<?php echo $this->session->userdata('uid') ?>";
        $.ajax({
            type: 'ajax',
            url: 'https://velloreads.com/cart/product_data',
            async: true,
            dataType: 'json',
            type:"POST",
            data:{id:u_id},
            success: function (data) {
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<tr>' +
                        '<td class="col-sm-8 col-md-6"> <div class="media"> <a class="thumbnail pull-left" href="#"> <img class="media-object" src="https://velloreads.com/assets/images/list-deta/' + data[i].product_image + '" style="width: 72px; height: 72px;"> <div class="media-body">  <h4 class="media-heading"><a href="#">' + data[i].product_name + '</a></h4></div></img></a></td></div>' +
                        '<td  class="col-md-1 text-center"><div class="cart-info quantity"><div class="btn-increment-decrement" onclick="decrement_quantity(' + data[i].id + ')">-</div>  <input class="input-quantity" id="input-quantity-' + data[i].id + '" value="' + data[i].product_quantity + '"> <div class="btn-increment-decrement" onclick="increment_quantity(' + data[i].id + ')">+</div> </div></td>' +
                        '<td class="col-md-1 text-center"><strong><i class="fa fa-inr"></i>' + data[i].product_price + '</strong></td>' +
                        '<td class="col-md-1 text-center"><strong><i class="fa fa-inr"></i>' + data[i].product_price * data[i].product_quantity + '</strong></td>' +
                        '<td class="col-md-1">' +
                        ' <button type="button" class="btn btn-danger remove-item" data-productid=' + data[i].id + '>' +
                        ' <i class="fa fa-times" aria-hidden="true"></i>' +
                        ' </button></td>' +
                        '</tr>';
                }
                var htmlfooter = '';
                if(data.length > 0) {
                    htmlfooter += '<tr>' +
                        '<td></td>' +
                        '<td colspan="4" class="subtotal">'+
                        '<div class="col-md-6 col-xs-6">Total</div>'+
                        '<div class="col-md-4 col-xs-4 align_right"><i class="fa fa-inr"></i>'+
                        <?php
                            $userId = $this->session->userdata('uid');
                            $this->db->where('u_id', $userId);
                            $query = $this->db->select('*')->from('product_cart')->get();
                            $item_quantity = 0;
                            $item_price = 0;
                            foreach ($query->result() as $row)
                            {
                                $item_quantity = $item_quantity +  $row->product_quantity;
                                $item_price = $item_price + ($row->product_price * $row->product_quantity);

                            }
                            echo $item_price;
                            ?>+'</i></div>'+
                        '</td>'+
                        '</tr>'+
                        ' <tr>' +
                        '<td></td>' +
                        '<td colspan="5" class="shopping_btn">' +
                        '<button type="button" style="margin-right: 5px" class="btn btn-default continue_shopping" onclick="window.location.href = \'all_product\';">' +
                        ' <i class="fa fa-shopping-cart" aria-hidden="true"></i> Continue Shopping' +
                        ' </button>' +
                        '<button type="button" class="btn btn-success checkout"  onclick="window.location.href = \'checkout\';">' +
                        ' Checkout <i class="fa fa-chevron-right" aria-hidden="true"></i>' +
                        ' </button>' +
                        '</td>' +
                        '</tr>';

                } else {
                    htmlfooter += '<tr>' +
                        '<td class="text-right"><b>No Result Found</b></td>' +
                        '</tr>';
                }
                $('#show_data').html(html);
                $('#table-footer').html(htmlfooter);

            }
        });
    }
</script>
<style>
    .cart-info {
        border: #ccc 1px solid;
        margin-top: 5px;
        width: 107px;
        display: inline-block;
    }
    .btn-increment-decrement {
        display: inline-block;
        padding: 5px 0;
        background: #e2e2e2;
        width: 30px;
        text-align: center;
        cursor: pointer;
    }
    .input-quantity {
        border: 0;
        width: 30px !important;
        display: inline-block;
        margin: 0;
        box-sizing: border-box;
        text-align: center;
    }
    .btn-increment-decrement {
        display: inline-block;
        padding: 5px 0;
        background: #e2e2e2;
        width: 33px;
        text-align: center;
        cursor: pointer;
    }
</style>

