
<?php
#edit-brand.php
$row = $this->db->query("SELECT * FROM `product` WHERE `p_id` = '".$listingId."'")->row_array();
?>
  <script type="application/ld+json">
      {
        "@context": "https://schema.org/",
        "@type": "Product",
        "name": "<?php echo $row['p_name']; ?>",
        "image": [
          "<?php echo base_url(); ?>assets/images/list-deta/<?php echo $row['p_img']; ?>",
          
         ],
        "description": "<?php echo  html_entity_decode($row['p_description']); ?>",
        "sku": "8189985559",
       
        "brand": {
          "@type": "Brand",
          "name": "<?php echo $row['p_brand']; ?>"
        },
        "review": {
          "@type": "Review",
          "reviewRating": {
            "@type": "Rating",
            "ratingValue": "4",
            "bestRating": "5"
          },
          "author": {
            "@type": "Person",
            "name": "Velloreads"
          }
        },
        "aggregateRating": {
          "@type": "AggregateRating",
          "ratingValue": "4.4",
          "reviewCount": "89"
        },
        "offers": {
          "@type": "AggregateOffer",
          "offerCount": "5",
          "lowPrice": "<?php echo $row['p_rate']; ?>",
          "highPrice": "<?php echo $row['p_rate']; ?>",
          "priceCurrency": "INR"
        }
      }
    </script>

<section class="dir-alp dir-pa-sp-top custom_products_details custom_products_list">
    <div class="top_section">
        <div class="container">
            <div class="row">
                <div class="dir-alp-tit">
                    <h1>Products Details</h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>product/all_product">Home</a> </li>
                        <li class="active">Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="dir-alp-con products_details">

                <!-- Products Details -->
                <div class="dir-alp-con-right">
                    <div class="col-md-6 poductsImageBlock">
                        <div class="poductsImageinner">
                            <div id="owl-example" class="owl-theme owl-carousel" >

                                <a href="<?php echo base_url(); ?>" class="center-image"  data-fancybox="gallery"><img class="childimg" style="height:450px"  src="<?php echo base_url(); ?>assets/images/list-deta/<?php echo $row['p_img']; ?>" alt=""></a>

                            </div>
                        </div>
                        <div class="buy_product">
                            <button class="buy-button add_to_cart btn orange-white btn_effect" data-userid = '<?php echo $this->session->userdata('uid'); ?>'   data-login ='<?php echo $this->session->userdata('login'); ?>' data-productid='<?php echo $row['p_id']; ?>' data-listid='<?php echo $row['list_id']; ?>' data-productname='<?php echo utf8_decode($row['p_name']) ; ?>' data-productprice='<?php if($row['p_discount']){$after_discount = $row['p_rate']*($row['p_discount']/100);$original_price = $row['p_rate'] - $after_discount; ?><?php echo $original_price; ?><?php }else{?><?php echo $row['p_rate']; ?><?php }?>'  data-productimage='<?php echo $row['p_img']; ?>'>ADD TO CART</button>
                            <button class="buy-button add_to_cart btn orange btn_effect" data-userid = '<?php echo $this->session->userdata('uid'); ?>'   data-login ='<?php echo $this->session->userdata('login'); ?>' data-productid='<?php echo $row['p_id']; ?>' data-listid='<?php echo $row['list_id']; ?>' data-productname='<?php echo utf8_decode($row['p_name']) ; ?>' data-productprice=' <?php if($row['p_discount']){$after_discount = $row['p_rate']*($row['p_discount']/100);$original_price = $row['p_rate'] - $after_discount; ?><?php echo $original_price; ?><?php }else{?><?php echo $row['p_rate']; ?><?php }?>'  data-productimage='<?php echo $row['p_img']; ?>'>Buy Now</button>
                        </div>
                    </div>
                    <!-- Products Discription -->
                    <div class="col-md-6  poductsDetailsBlock">
                        <h1 class="productsNmae"><?php echo $row['p_name']; ?></h1>
                        <p class="productsid"><span>Product Id :</span> <?php echo $row['p_id']; ?></p>

                        <!--Calculate Price-->
                        <?php if($row['p_discount']){
                            $after_discount = $row['p_rate']*($row['p_discount']/100);
                            $original_price = $row['p_rate'] - $after_discount;
                            ?>
                            <span class="currentPrice">Rs.<?php echo $original_price; ?></span>
                        <?php }else{?>
                            <span class="currentPrice">Rs.<?php echo $row['p_rate']; ?></span>
                        <?php }?>
                        <!-- end Calculate Price -->

                        <span class="sec_discounted_price">Rs.<?php echo $row['p_rate']; ?></span>
                        <span class="discount"><?php echo $row['p_discount']; ?>% off</span>
                        <div class="clear"></div>
                        <div class="qty"><input type="number" id="itemqty"  min="1" value="1" class="span1" placeholder="Qty."></div>

                        <div class="pro-pbox-4 pro-pbox-com">
                            <h4>Descriptions</h4>
                            <?php echo  html_entity_decode($row['p_description']); ?>
                           
                        </div>

                        <div class="pro-pbox-5 pro-pbox-com">
                            <h4>Specifications</h4>
                            <ul>
                                <?php
                                $specifications_label =  implode(',',json_decode($row['p_specification_label']));
                                $specification_label = explode(",",$specifications_label);

                                $specifications_desc =  implode(',',json_decode($row['p_specification_desc']));
                                $specification_desc = explode(",",$specifications_desc);
                                foreach ($specification_label as $key=>$label) {
                                    ?>
                                    <li>
                                        <span class="pro-spe-li"><?php echo $label;?></span>:
                                        <?php foreach ($specification_desc as $keys=>$desc) {
                                            if($key === $keys){
                                                ?>
                                                <span class="pro-spe-po">&nbsp;&nbsp;<?php echo $desc;?></span>
                                            <?php }}?>
                                    </li>
                                <?php }?>
                                <!--                                        <li>-->
                                <!--    <span class="pro-spe-li">Additional Content</span>:-->
                                <!--    <span class="pro-spe-po">&nbsp;&nbsp; Controller</span>-->
                                <!--</li>-->
                                <!--                                        <li>-->
                                <!--    <span class="pro-spe-li">Console Type</span>:-->
                                <!--    <span class="pro-spe-po">&nbsp;&nbsp; Detroit - Become Human</span>-->
                                <!--</li>-->
                                <!--                                        <li>-->
                                <!--    <span class="pro-spe-li">Processor</span>:-->
                                <!--    <span class="pro-spe-po">&nbsp;&nbsp;Controller</span>-->
                                <!--</li>-->

                            </ul>
                        </div>





                    </div>
                    <!-- End Products Discription -->
                    <div class="clear"></div>
                </div>
                <!-- End Products Details -->
                <!--<div class="col-md-12 custom_products_list related_products">-->
                <!--    <h2>Related Products </h2>-->
                <!--    <div class="dir-alp-con-right-1">-->
                <!--        <div class="row span-none related_products_wrapper">-->

                <!--            <div id="owl-example" class="owl-theme owl-carousel">-->
               
                <!--                $related_category = $row['p_category'];-->
                <!--                $related_item = $this->db->query("SELECT * FROM `product` WHERE `p_category` = '".$related_category."' group by p_id;")->result_array();-->
                               
                <!--                    foreach($related_item as $list){-->
                <!--                
                                        <!--Products LISTINGS-->
                <!--                        <div class="products_block">-->
                <!--                            <div class="thumbnail">-->
                <!--                                <a href="#" class="image_block center-image">-->
                <!--                                    <img src="<?php echo base_url(); ?>/assets/images/list-deta/<?php echo $list['p_img'];?>" height="300px"  alt="">-->
                <!--                                </a>-->
                <!--                                <div class="caption">-->
                <!--                                    <h5><a href="#"><?php echo $list['p_name'];?></a></h5>-->
                <!--                                    <h6><span><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $list['p_rate'];?></span> <span class="offPrice"><?php echo $list['p_discount'];?> %off</span></h6>-->
                <!--                                    <h4 style="text-align:center">-->
                <!--                                        <a class="btn btn-primary view_details" href="#">Details</a>-->
                <!--                                        <a class="add_to_cart btn" href="#">Add to Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></a> </h4>-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                        </div>-->
                                        <!--End  Products LISTINGS-->
            



                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!--MOBILE APP-->
<section class="web-app com-padd">
    <div class="container">
        <div class="row">
            <div class="col-md-6 web-app-img"> <img src="<?php echo base_url(); ?>/products/images/mobile.png" alt="" /> </div>
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

<script src="<?php echo base_url(); ?>products/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>products/js/bootstrap.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>products/js/materialize.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>products/js/owl.carousel.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>products/js/jquery.fancybox.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>products/js/custom.js"></script>
<script src="<?php echo base_url(); ?>products/js/mix.js"></script>
<script>
    $('.add_to_cart').click(function() {
        var login = $(this).data("login");
        if (login) {
            var u_id = $(this).data("userid");
            var list_id = $(this).data("listid");
            var product_id = $(this).data("productid");
            var product_name = $(this).data("productname");
            var product_price = $(this).data("productprice");
            var product_image = $(this).data("productimage");
            var inputVal = document.getElementById("itemqty").value;
            console.log(inputVal)

            var quantity = inputVal;
            $.ajax({
                url: "https://velloreads.com/cart/save",
                type: "POST",
                data: {
                    u_id: u_id,
                    product_id: product_id,
                    product_name: product_name,
                    product_price: product_price,
                    product_image: product_image,
                    quantity: quantity,
                    list_id:list_id
                },
                success: function (resp) {
                    $('.alert').removeClass("hide");
                    var baseurl = window.location.origin + "/product/shopping_cart";
                    location.replace(baseurl)
                },
                error: function (resp) {
                    alert(resp)
                }
            });
            $('.close-icon').click(function () {
                $('.alert').addClass("hide")
            });
        } else {
            var baseurl = window.location.origin + "/users/login";
            location.replace(baseurl)
        }
    });
</script>