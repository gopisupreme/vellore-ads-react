<?php include 'header.php';?>
<?php include 'header.php';
 $order_id= $this->session->userdata('order_id');
$row = $this->db->query("SELECT * FROM `rb_order_master_data` WHERE `order_id` = '".$order_id."'")->row_array();
?>

<section class="dir-alp dir-pa-sp-top custom_products_details custom_products_list">

    <div class="top_section">
        <div class="container">
            <div class="row">
                <div class="dir-alp-tit">
                    <h1>Billing </h1>
                     <ol class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>products/all_product">Home</a> </li>
                        <li class="active">Details</li>
                        
				           <?php echo $this->session->flashdata('success'); ?>
				          
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
    <div class="row">
        <div class="col s12 m6">
            <div class="card  darken-1">
                <div class="card-content">
                    <span class="card-title"><h1>Thank You For Your Order</h1></span>
                    <p>Order Number: <?php echo $row['order_id']; ?></p><br>
                    <p>Order Date : <?php echo $row['created_dt']; ?></p><br>
                    <p>Customer: <?php echo $row['fname']; ?> <?php echo $row['lname']; ?></p><br>
                    <!--<p>Please keep the above numbers for your reference. We will also send a confirmation to the email address your used for this order. -->
                    <!--Please allow up to 24 hours for us to process your order for shipment  </p>-->
                    <p>Shpping Address :</p><br>
                    <p><?php echo $row['saddress']; ?></p><br><br>
                    <p>Billing Address :</p><br>
                    <p><?php echo $row['address']; ?></p>
                </div>
            </div>
        </div>
        <div class="col s12 m6">
            <div class="card  darken-1">
                <div class="card-content">
                    <span class="card-title">Order Summary</span>
                     <table class="table  yourorder">
                        <thead>
                        <tr>
                            <th style="text-align: center">Product</th>
                            <th style="text-align: center">Name</th>
                            <th style="text-align: center">Qty</th>
                            <th style="text-align: center">Price</th>
                        </tr>
                        </thead>
                        <tbody id="show_data">
                        <tfoot id="table-footer">
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!--<div class="row">-->
    <!--    <div class="col s12 m8">-->
    <!--        <div class="card  darken-1">-->
    <!--            <div class="card-content">-->
                    <!--<span class="card-title"><h1>Item Your Order</h1></span>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
            show_product();
        function show_product() {
            var u_id = "<?php echo $this->session->userdata('order_id') ?>";
            $.ajax({
                type: 'ajax',
                url: 'https://velloreads.com/cart/order_data',
                async: true,
                dataType: 'json',
                type:"POST",
                data:{id:u_id},
                success: function (data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<tr>' +
                            '<td class="col-md-1" style="text-align: center"><img height="60px" width="60px" src="/assets/images/list-deta/' + data[i].product_image + '"></td>' +
                            '<td class="col-md-1" style="text-align: center">' + data[i].product_name + '</td>' +
                            '<td class="col-md-1" style="text-align: center">' + data[i].product_quantity + '</td>' +
                            '<td class="col-md-1 text-center"><strong><i class="fa fa-inr"></i>' + data[i].product_price + '</strong></td>' +
                            '</tr>';
                    }
                    var htmlfooter = '';
                    if(data.length > 0) {
                        htmlfooter += '<tr style="border-bottom: 1px solid #ddd;">' +
                            
                            '<td colspan="4" class="subtotal">'+
                            '<div class="col-md-9 col-xs-9">Total</div>'+
                            '<div class="col-md-3 col-xs-3" style="text-align:right;"><i class="fa fa-inr"></i>'+
                            <?php
                                $userId = $this->session->userdata('order_id');
                                $this->db->where('order_id', $userId);
                                $query = $this->db->select('*')->from('rb_order_details')->get();
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
                            ' <tr>';

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
<!--FOOTER SECTION-->
<?php // include 'footer.php';?>