<?php include 'header.php';
 $order_id= $this->session->userdata('order_id');
$row = $this->db->query("SELECT * FROM `rb_order_master_data` WHERE `order_id` = '".$order_id."'")->row_array();
?>

	<!--Cart-->
	<section class="Checkout">
		<div class="tz">
		
		   <div class="container">
		    
				<div class="dir-alp-tit row">
					<h1>Checkout</h1>
					<ol class="breadcrumb">
						<li><a href="index.html">Home</a> </li>
						<li><a href="checkout.html">Checkout</a></li>
						<li class="active">Payment </li>
						
					</ol>
				</div>
			
			</div>
			<!--CART SECTION-->
			<div class="container">
			  <div class="row">
					<div class="col-md-4 order-md-2 mb-4 orderdetails">
					   <div class="row"
						  <h4 class="d-flex justify-content-between align-items-center mb-3">
							<span class="text-muted">Your cart</span>
							<!--<span class="badge badge-secondary badge-pill">3</span>-->
						  </h4>
						  <ul class="list-group mb-3">
							<!--<li class="list-group-item d-flex justify-content-between lh-condensed">-->
							<!--  <div>-->
							<!--	<h6 class="my-0">Product name</h6>-->
							<!--	<small class="text-muted">Brief description</small>-->
							<!--  </div>-->
							<!--  <span class="text-muted"><i class="fa fa-inr" aria-hidden="true"></i>12</span>-->
							<!--</li>-->
							<!--<li class="list-group-item d-flex justify-content-between lh-condensed">-->
							<!--  <div>-->
							<!--	<h6 class="my-0">Second product</h6>-->
							<!--	<small class="text-muted">Brief description</small>-->
							<!--  </div>-->
							<!--  <span class="text-muted"><i class="fa fa-inr" aria-hidden="true"></i>8</span>-->
							<!--</li>-->
							<!--<li class="list-group-item d-flex justify-content-between lh-condensed">-->
							<!--  <div>-->
							<!--	<h6 class="my-0">Third item</h6>-->
							<!--	<small class="text-muted">Brief description</small>-->
							<!--  </div>-->
							<!--  <span class="text-muted"><i class="fa fa-inr" aria-hidden="true"></i>5</span>-->
							<!--</li>-->
							<!--<li class="list-group-item d-flex justify-content-between bg-light">-->
							<!--  <div class="text-success">-->
							<!--	<h6 class="my-0">Promo code</h6>-->
							<!--	<small>EXAMPLECODE</small>-->
							<!--  </div>-->
							<!--  <span class="text-success">-<i class="fa fa-inr" aria-hidden="true"></i>5</span>-->
							<!--</li>-->
							<li class="list-group-item d-flex justify-content-between">
							  <span>Total </span>
							  <strong><i class="fa fa-inr" aria-hidden="true"></i><?php echo $row['total'];?></strong>
							</li>
						  </ul>

						  <!--<form class="card p-2">
							<div class="input-group">
							  <input type="text" class="form-control" placeholder="Promo code">
							  <div class="input-group-append">
								<button type="submit" class="btn btn-secondary">Redeem</button>
							  </div>
							</div>
						  </form>-->
					    </div>
					</div>
					
					<div class="col-md-8 order-md-1 paymentProcess">
					  <h4 class="mb-3">Payment</h4>
					    <a href="javascript:void(0)" class="btn  btn-primary buy_now w-100" id="rzp-button1">Pay Now</a>
						<!-- <div class="tz2-form-pay tz2-form-com">-->
						<!--		 <article class="card">-->
						<!--				<div class="card-body p-5">-->

									

											<!-- tab-content .// -->

						<!--				</div> <!-- card-body.// -->
						<!--	    </article> <!-- card.// -->

						<!--</div>-->
				  </div>
			</div>
		  </div>
		</div>
	</section>
	<div class="paddingTopBot30"></div>
	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
var siteurl = "<?php echo base_url() ?>";
$('body').on('click', '.buy_now', function(e){
var totalAmount = <?php echo $row['total'] *100 ?>;
var product_id = <?php echo $order_id ?>;
var options = {
"key": "rzp_live_mmBlvPOyxWqgw0",
"amount": totalAmount,
"name": "VelloreAds",
"description": "Payment",
"image": "https://velloreads.com/assets/images/logo-black.png",
    "handler": function (response){
    $.ajax({
    'url': 'https://velloreads.com/razor/save',
    'type': 'post',
    'dataType': 'json',
    'data': {razorpay_payment_id: response.razorpay_payment_id , totalAmount : totalAmount ,product_id : product_id}, 
    'success': function (msg) {
       
    window.location.href = 'https://velloreads.com/razor/RazorThankYou';
    },
    'error': function(xhr, status, error) {
      var err = eval("(" + xhr.responseText + ")");
    
    }
});
},

    
"theme": {
"color": "#528FF0"
}
};
var rzp1 = new Razorpay(options);
rzp1.open();
e.preventDefault();
});
</script>

<script>
    //     $('body').on('click', '.buy_now', function(e) {
    //     var totalAmount = <?php //echo $row['total'] *100 ?>;
    //     var product_id = 12;
    //     var product_name = "";
    //     var options = {
    //         "key": "rzp_live_WJOD674Qno8QJr",
    //         "currency": "INR",
    //         "amount": totalAmount,
    //         "name": "VelloreAds",
    //         "description": "Payment",
    //         "handler": function (response) {
    //             $.ajax({
    //                 url: 'https://velloreads.com/razor/save',
    //                 type: 'post',
    //                 dataType: 'json',
    //                 data: {
    //                     razorpay_payment_id: response.razorpay_payment_id,
    //                     totalAmount: totalAmount,
    //                     product_id: product_id,
    //                 },
    //                 success: function (msg) {
    //                     alert("success")
    //                 }
    //             });
    //         },
    //         "theme": {
    //             "color": "#528FF0"
    //         }
    //     };
    //     var rzp1 = new Razorpay(options);
    //     document.getElementById('rzp-button1').onclick = function (e) {
    //         rzp1.open();
    //         e.preventDefault();
    //     }
    // });



</script>
