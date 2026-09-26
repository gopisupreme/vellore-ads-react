<?php include 'header.php';?>

   
<style>
[type="radio"]:checked,
[type="radio"]:not(:checked) {
    position: absolute;
    left: -9999px;
}
[type="radio"]:checked + label,
[type="radio"]:not(:checked) + label
{
    position: relative;
    padding-left: 28px;
    cursor: pointer;
    line-height: 20px;
    display: inline-block;
    color: #666;
    font-size:14px;
}
[type="radio"]:checked + label:before,
[type="radio"]:not(:checked) + label:before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 18px;
    height: 18px;
    border: 1px solid #ddd;
    border-radius: 100%;
    background: #fff;
}
[type="radio"]:checked + label:after,
[type="radio"]:not(:checked) + label:after {
    content: '';
    width: 12px;
    height: 12px;
    background: #F87DA9;
    position: absolute;
    top: 4px;
    left: 4px;
    border-radius: 100%;
    -webkit-transition: all 0.2s ease;
    transition: all 0.2s ease;
}
[type="radio"]:not(:checked) + label:after {
    opacity: 0;
    -webkit-transform: scale(0);
    transform: scale(0);
}
[type="radio"]:checked + label:after {
    opacity: 1;
    -webkit-transform: scale(1);
    transform: scale(1);
}
        </style>
<section class="dir-alp dir-pa-sp-top custom_products_details custom_products_list">
    <div class="top_section">
        <div class="container">
            <div class="row">
                <div class="dir-alp-tit">
                    <h1>Shopping Cart</h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>product/all_product">Home</a> </li>
                        <li><a href="<?php echo base_url(); ?>product/shopping_cart">Shopping Cart</a> </li>
                        <li class="active">Checkout</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container">

<script>
    function myFunction() {
    var checkBox = document.getElementById("myCheck");  
    var fnameShip = document.getElementById("fname");
    var lnameShip = document.getElementById("lname");
    var companyNameShip = document.getElementById("companyName");
     var emailShip = document.getElementById("email");
    var phoneShip = document.getElementById("phone");
    var addressShip = document.getElementById("address");
    var stateShip = document.getElementById("state");
    var pincodeShip = document.getElementById("pincode");
   var additionalInfoShip = document.getElementById("additionalInfo");
    var sfnameBil = document.getElementById("sfname");
    var slnameBil = document.getElementById("slname");
    var scnameBil = document.getElementById("scname");
    var semailBil = document.getElementById("semail");
    var sphoneBil = document.getElementById("sphone");
    var saddressBil = document.getElementById("saddress");
    var sstateBil = document.getElementById("sstate");
    var spincodeBil = document.getElementById("spincode");
      var sinfoBil = document.getElementById("sinfo");
 
   
    if (checkBox.checked == true){
          sfnameBil.value=fnameShip.value; 
          slnameBil.value=lnameShip.value;
          scnameBil.value=companyNameShip.value; 
          semailBil.value=emailShip.value;
          sphoneBil.value=phoneShip.value; 
          saddressBil.value=addressShip.value;
          sstateBil.value=stateShip.value; 
          spincodeBil.value=pincodeShip.value;
          sinfoBil.value=additionalInfoShip.value;
    } else {
          sfnameBil.value="";
          slnameBil.value="";
          scnameBil.value="";
          semailBil.value="";
          sphoneBil.value="";
          saddressBil.value="";
          sstateBil.value="";
          spincodeBil.value="";
          sinfoBil.value="";
    }
  }
</script>

        <div class="row checkoutpage">
            <!-- Billing address Form -->
            <div class="col-md-8 col-sm-12 order-md-1 billingAddress">
                <h4 class="mb-5">Billing Address</h4>
                
                <div class="tz2-form-pay tz2-form-com">
                    <form  method="post" action="<?php echo base_url() ?>product/customer_data">
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <input type="text" class="validate" name="fname" id="fname" placeholder="First Name" required>
                            </div>
                            <div class="input-field col s12 m6">
                                <input type="text" class="validate" name="lname"  id="lname" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m12">
                                <input type="text" class="validate" name="companyName" id="companyName" placeholder="Company name (optional)">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <input type="email" class="validate" name="email" id="email" placeholder="Email id*" required>
                            </div>
                            <div class="input-field col s12 m6">
                                <input type="number" class="validate" name="phone" id="phone" placeholder="Phone*" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m12">
                                <textarea class="validate" name="address" id="address" placeholder="Address*"></textarea>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="input-field col s12 m6 state">
                                <select id="state" name="state">
                                    <option value="" disabled selected>Select State*</option>
                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                    <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                    <option value="Assam">Assam</option>
                                    <option value="Bihar">Bihar</option>
                                    <option value="Chandigarh">Chandigarh</option>
                                    <option value="Chhattisgarh">Chhattisgarh</option>
                                    <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                    <option value="Daman and Diu">Daman and Diu</option>
                                    <option value="Delhi">Delhi</option>
                                    <option value="Lakshadweep">Lakshadweep</option>
                                    <option value="Puducherry">Puducherry</option>
                                    <option value="Goa">Goa</option>
                                    <option value="Gujarat">Gujarat</option>
                                    <option value="Haryana">Haryana</option>
                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                    <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                    <option value="Jharkhand">Jharkhand</option>
                                    <option value="Karnataka">Karnataka</option>
                                    <option value="Kerala">Kerala</option>
                                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                                    <option value="Maharashtra">Maharashtra</option>
                                    <option value="Manipur">Manipur</option>
                                    <option value="Meghalaya">Meghalaya</option>
                                    <option value="Mizoram">Mizoram</option>
                                    <option value="Nagaland">Nagaland</option>
                                    <option value="Odisha">Odisha</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Rajasthan">Rajasthan</option>
                                    <option value="Sikkim">Sikkim</option>
                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                    <option value="Telangana">Telangana</option>
                                    <option value="Tripura">Tripura</option>
                                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                                    <option value="Uttarakhand">Uttarakhand</option>
                                    <option value="West Bengal">West Bengal</option>
                                </select>
                            </div>
                            <div class="input-field col s6 m6">
                                <input type="text" class="validate" name="pincode" id="pincode" placeholder="Postcode / ZIP *">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m12">
                                <textarea class="validate" name="additionalInformation"  id="additionalInfo" placeholder="Additional information (optional)"></textarea>
                            </div>
                        </div>
                        <!--<div class="row sameAddressBlock">-->
                        <!--    <div>-->
                        <!--        <input type="checkbox" class="sameAddress" name="ship" value="1" id="scf4" id="myCheck" onclick="myFunction()">-->
                        <!--        <label for="scf4">Ship to this address</label>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="row different_address">-->
                        <!--    <div>-->
                        <!--        <input type="checkbox" class="diffShip" value="0" name="ship" id="scf5">-->
                        <!--        <label for="scf5">Ship to different address</label>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <input type="checkbox" id="myCheck" onclick="myFunction()">  
	                  <label for="myCheck">Same as Billing Address:</label>   
                        <div class="shippingBlock ">
                            <h4 class="mb-3">Shipping Address</h4>
                            <div class="row">
                                <div class="input-field col s12 m6">
                                    <input type="text" class="validate" name="sfname"  id="sfname" placeholder="First Name*">
                                </div>
                                <div class="input-field col s12 m6">
                                    <input type="text" class="validate" name="slname" id="slname" placeholder="Last Name*">
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m12">
                                    <input type="text" class="validate" name="scname" id="scname" placeholder="Company name (optional)">
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6">
                                    <input type="email" class="validate" placeholder="Email id*" id="semail" name="semail">
                                </div>
                                <div class="input-field col s12 m6">
                                    <input type="number" class="validate" placeholder="Phone*" id="sphone" name="sphone">
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m12">
                                    <textarea class="validate" placeholder="Address*" id="saddress" name="saddress"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6 state">
                                    <select name="sstate" id="sstate">
                                        <option value="" disabled selected>Select State*</option>
                                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                                        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                        <option value="Assam">Assam</option>
                                        <option value="Bihar">Bihar</option>
                                        <option value="Chandigarh">Chandigarh</option>
                                        <option value="Chhattisgarh">Chhattisgarh</option>
                                        <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                        <option value="Daman and Diu">Daman and Diu</option>
                                        <option value="Delhi">Delhi</option>
                                        <option value="Lakshadweep">Lakshadweep</option>
                                        <option value="Puducherry">Puducherry</option>
                                        <option value="Goa">Goa</option>
                                        <option value="Gujarat">Gujarat</option>
                                        <option value="Haryana">Haryana</option>
                                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                                        <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                        <option value="Jharkhand">Jharkhand</option>
                                        <option value="Karnataka">Karnataka</option>
                                        <option value="Kerala">Kerala</option>
                                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                                        <option value="Maharashtra">Maharashtra</option>
                                        <option value="Manipur">Manipur</option>
                                        <option value="Meghalaya">Meghalaya</option>
                                        <option value="Mizoram">Mizoram</option>
                                        <option value="Nagaland">Nagaland</option>
                                        <option value="Odisha">Odisha</option>
                                        <option value="Punjab">Punjab</option>
                                        <option value="Rajasthan">Rajasthan</option>
                                        <option value="Sikkim">Sikkim</option>
                                        <option value="Tamil Nadu">Tamil Nadu</option>
                                        <option value="Telangana">Telangana</option>
                                        <option value="Tripura">Tripura</option>
                                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                                        <option value="Uttarakhand">Uttarakhand</option>
                                        <option value="West Bengal">West Bengal</option>
                                    </select>
                                </div>
                                <div class="input-field col s6 m6">
                                    <input type="text" class="validate" name="spincode" id="spincode" placeholder="Postcode / ZIP *">
                                </div>

                            </div>
                            <div class="row">
                                <div class="input-field col s12 m12">
                                    <textarea class="validate" placeholder="Additional information (optional)" id="sinfo" name="sinfo"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row terms">
                            <div>
                                <input type="checkbox" id="scf6" required>
                                <label for="scf6">I have read and agree to the website <a href="#">terms and conditions</a> *</label>
                            </div>
                        </div>
                        
                            <h4>Payment Option</h4>
                            <input type="radio" id="test1" name="payment" value="cod" checked>
                        <label for="test1">Cash On Delivery</label>
                      
                        <input type="radio" id="test2" name="payment" value="online">
                        <label for="test2">Pay Online</label>
                        <div class="row" style="display:none; padding:15px;" id="raz">
                            <div class="col-md-6">
                                <a href="javascript:void(0)" class="btn  btn-primary buy_now w-100" id="rzp-button1">Pay Now</a>
                            </div>
                        </div>
 
                        <button type="submit" value="SUBMIT" class="full-btn border-0" >Place Your Order</button>
                            </div>
                        </div>
                
                </form>
           
            <!-- End Billing address Form -->
            <!-- Order Details -->
            <div class="col-md-4 order-md-2 mb-4 orderdetails">
                <div class="row">
                    <h4 class="mb-5">Your Order</h4>
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
            <!-- End Order Details -->
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
            </div>
        </div>
    </div>
</section>
<!--FOOTER SECTION-->
<?php //include 'footer.php';?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $('input[name="payment"]').change(function(){
        if($('#test1').prop('checked')){
            $("#raz").hide();
        }else{
             $("#raz").show();
        }
    });
});
</script>
<script>
    $(document).ready(function() {
     $('body').on('click', '.bill', function(e) {
        var fname =  $('#fname').val();
        var lname =  $('#lname').val();
        var companyName =  $('#companyName').val();
        var email =  $('#email').val();
        var phone =  $('#phone').val();
        var address =  $('#address').val();
                  var pincode =  $('#pincode').val();
       var  additionalInformation = $('#additionalInformation').val();
       var state = $('#state option:selected').val()


       console.log(fname,lname,companyName,email,phone,address,pincode,additionalInformation, state)
    });
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
        // $(".diffShip").change(function(event){
        //     if (this.checked){
        //         $('.shippingBlock').removeClass("hide");
        //     } else {
        //         $('.shippingBlock').addClass("hide")
        //     }
        // });
    });
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
    ?>
    $('body').on('click', '.buy_now', function(e) {
        var totalAmount = <?php echo $item_price *100 ?>;
        var product_id = 12;
        var product_name = "";
        var options = {
            "key": "rzp_live_iSL4QRKyLjSg6Q",
            "currency": "INR",
            "amount": totalAmount,
            "name": "VelloreAds",
            "description": "Payment",
            "handler": function (response) {
                $.ajax({
                    url: 'https://velloreads.com/razor/save',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        razorpay_payment_id: response.razorpay_payment_id,
                        totalAmount: totalAmount,
                        product_id: product_id,
                    },
                    success: function (msg) {
                        alert("success")
                    }
                });
            },
            "theme": {
                "color": "#528FF0"
            }
        };
        var rzp1 = new Razorpay(options);
        document.getElementById('rzp-button1').onclick = function (e) {
            rzp1.open();
            e.preventDefault();
        }
    });
</script>
<style>
    #rzp-button1 {
        width:100%;
    }
</style>