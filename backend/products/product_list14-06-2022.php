<?php
//  include 'header.php';
include('database_connection.php');

?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <section class="dir-alp dir-pa-sp-top custom_products_list">
        <div class="container">
            <div class="alert alert-success alert-dismissable hide">
                <button type="button" class="close close-icon " data-dismiss="" aria-hidden="true">&times;</button>
                Product added successfully.
            </div>
        </div>
        <div class="top_section">
            <div class="container">
                <div class="row">
                    <div class="dir-alp-tit">
                        <h1>Products List</h1>
                        <ol class="breadcrumb">
                            <li><a href="active">Home</a> </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="dir-alp-con"  style="margin-bottom: 20px;">
                    <div class="col-md-3 dir-alp-con-left producst_catagories">
                        <div class="dir-alp-l3 dir-alp-l-com head_section">
                            <h4>Category</h4></div>
                        <div class="dir-alp-l-com1 dir-alp-p3 dir-alp-l3">
                            <div class="ul_list">
                                <form action="#">
                                    <ul>
                                        <?php

                                        $query = "SELECT c_id, c_title FROM categories WHERE c_status = '1' GROUP BY c_title DESC";
                                        $statement = $connect->prepare($query);
                                        $statement->execute();
                                        $result = $statement->fetchAll();
                                        foreach($result as $row)
                                        {
                                            ?>
                                            <li>
                                                <input type="checkbox" class="common_selector category" id="<?php echo $row['c_title']; ?>" value="<?php echo $row['c_title']; ?>" />
                                                <label for="<?php echo $row['c_title']; ?>"><?php echo $row['c_title']; ?></label>
                                                <span>
                                                        <ul style="margin: 15px">
                                                             <?php
                                                             $query = "SELECT DISTINCT(s_title) FROM sub_categories WHERE s_status = '1' AND   s_category = '".$row['c_id']."'  ORDER BY s_id DESC";
                                                             $statement = $connect->prepare($query);
                                                             $statement->execute();
                                                             $result = $statement->fetchAll();
                                                             foreach($result as $row)
                                                             {
                                                                 ?>
                                                                 <li>
                                                                        <input type="checkbox" class="common_selector subcategory" id="<?php echo $row['s_title']; ?>" value="<?php echo $row['s_title']; ?>" style="margin-right: 10px" />
                                                                        <label for="<?php echo $row['s_title']; ?>"><?php echo $row['s_title']; ?></label>
                                                                        </li>
                                                                 <?php
                                                             }
                                                             ?>
                                                        </ul>
                                                </span>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </form>
                            </div>

                            <!--</select>-->
                        </div>

                        <!--==========Brand Filter============-->
                        <div class="dir-alp-l3 dir-alp-l-com">
                            <h4>Brand Filter</h4>
                            <div class="dir-alp-l-com1 dir-alp-p3">
                                <div class="ul_list">
                                    <form action="#">
                                        <ul>
                                            <?php

                                            $query = "SELECT DISTINCT(b_title) FROM brand WHERE b_status = '1' ORDER BY b_id DESC";
                                            $statement = $connect->prepare($query);
                                            $statement->execute();
                                            $result = $statement->fetchAll();
                                            foreach($result as $row)
                                            {
                                                ?>
                                                <li>
                                                    <input type="checkbox" class="common_selector brand" id="<?php echo $row['b_title']; ?>" value="<?php echo $row['b_title']; ?>" />
                                                    <label for="<?php echo $row['b_title']; ?>"><?php echo $row['b_title']; ?></label>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--==========End Brand Filter============-->
                        <!--==========Price Filter============-->
                        <div class="dir-alp-l3 dir-alp-l-com">
                            <h4>Price</h4>
                            <div class="dir-alp-l-com1 dir-alp-p3">
                                 <input type="hidden" id="list_id" value="<?php echo $listingId; ?>" />
                                <input type="hidden" id="hidden_minimum_price" value="0" />
                                <input type="hidden" id="hidden_maximum_price" value="65000" />
                                <p id="price_show">0 - 65000</p>
                                <div id="price_range"></div>
                                <!--<form>-->
                                <!--	<ul>-->
                                <!--		<li>-->
                                <!--			<input class="with-gap" name="group1" type="radio" id="ldis1" />-->
                                <!--			<label for="ldis1">Above <i class="fa fa-inr" aria-hidden="true"></i> 1000</label>-->
                                <!--		</li>-->
                                <!--		<li>-->
                                <!--			<input class="with-gap" name="group1" type="radio" id="ldis2" />-->
                                <!--			<label for="ldis2"><i class="fa fa-inr" aria-hidden="true"></i> 501 - <i class="fa fa-inr" aria-hidden="true"></i>1000</label>-->
                                <!--		</li>-->
                                <!--		<li>-->
                                <!--			<input class="with-gap" name="group1" type="radio" id="ldis3" />-->
                                <!--			<label for="ldis3"><i class="fa fa-inr" aria-hidden="true"></i> 251 - <i class="fa fa-inr" aria-hidden="true"></i>500</label>-->
                                <!--		</li>-->
                                <!--		<li>-->
                                <!--			<input class="with-gap" name="group1" type="radio" id="ldis4" />-->
                                <!--			<label for="ldis4"><i class="fa fa-inr" aria-hidden="true"></i> 101 - <i class="fa fa-inr" aria-hidden="true"></i>250</label>-->
                                <!--		</li>-->
                                <!--		<li>-->
                                <!--			<input class="with-gap" name="group1" type="radio" id="ldis5" />-->
                                <!--			<label for="ldis5">Below <i class="fa fa-inr" aria-hidden="true"></i> 100</label>-->
                                <!--		</li>-->
                                <!--	</ul>-->
                                <!--</form> -->
                            </div>
                        </div>
                        <!--==========End Price Filter============-->
                        <!--==========Price Filter============-->
                        <div class="dir-alp-l3 dir-alp-l-com">
                            <h4>Discount</h4>
                            <div class="dir-alp-l-com1 dir-alp-p3">
                                <input type="hidden" id="hidden_minimum_discount" value="0" />
                                <input type="hidden" id="hidden_maximum_discount" value="100" />
                                <p id="discount_show">0 - 100</p>
                                <div id="discount_range"></div>
                                <!-- <form>
                                    <ul>
                                        <li>
                                            <input class="with-gap" name="group1" type="radio" id="ldid1" />
                                            <label for="ldid1">Above 70%</label>
                                        </li>
                                        <li>
                                            <input class="with-gap" name="group1" type="radio" id="ldid2" />
                                            <label for="ldid2">51% - 70%</label>
                                        </li>
                                        <li>
                                            <input class="with-gap" name="group1" type="radio" id="ldid3" />
                                            <label for="ldid3">26% - 50%</label>
                                        </li>
                                        <li>
                                            <input class="with-gap" name="group1" type="radio" id="ldid4" />
                                            <label for="ldid4">11% - 25%</label>
                                        </li>
                                        <li>
                                            <input class="with-gap" name="group1" type="radio" id="ldid5" />
                                            <label for="ldid5">Below 10%</label>
                                        </li>
                                    </ul>
                                </form>  -->
                            </div>
                        </div>
                        <!--==========End Price Filter============-->
                    </div>
                    <div class="col-md-9 dir-alp-con-right list-grid-rig-pad">
                        <div class="dir-alp-con-right-1">
                            <div class="row">

                                <div class="row span-none filter_data">




                                </div>


                                <!--Pagination-->

                                <!--<div class="row">-->
                                <!--		<ul class="pagination list-pagenat">-->
                                <!--			<li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a> </li>-->
                                <!--			<li class="active"><a href="#!">1</a> </li>-->
                                <!--			<li class="waves-effect"><a href="#!">2</a> </li>-->
                                <!--			<li class="waves-effect"><a href="#!">3</a> </li>-->
                                <!--			<li class="waves-effect"><a href="#!">4</a> </li>-->
                                <!--			<li class="waves-effect"><a href="#!">5</a> </li>-->
                                <!--			<li class="waves-effect"><a href="#!">6</a> </li>-->
                                <!--			<li class="waves-effect"><a href="#!">7</a> </li>-->
                                <!--			<li class="waves-effect"><a href="#!">8</a> </li>-->
                                <!--			<li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a> </li>-->
                                <!--		</ul>-->
                                <!--	</div>-->
                                <!--</div>-->
                                <!--End  Pagination-->
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


    <!-- Product Filter -->

    <script>
        $(document).ready(function(){

            filter_data();

            function filter_data()
            {
                $('.filter_data').html('<div id="loading" style="" ></div>');
                var action = 'fetch_data';
                var list_id=$('#list_id').val();
               
                var minimum_price = $('#hidden_minimum_price').val();
                var maximum_price = $('#hidden_maximum_price').val();
                var minimum_discount = $('#hidden_minimum_discount').val();
                var maximum_discount = $('#hidden_maximum_discount').val();
                var brand = get_filter('brand');
                var category = get_filter('category');
                var subcategory = get_filter('subcategory');
                $.ajax({
                    url:"https://velloreads.com/products/fetch_data.php",
                    method:"POST",
                    data:{action:action,list_id:list_id, minimum_price:minimum_price, maximum_price:maximum_price, minimum_discount:minimum_discount, maximum_discount:maximum_discount, brand:brand, category:category, subcategory:subcategory},
                    success:function(data){
                        $('.filter_data').html(data);
                        addto_cart();
                    }
                });
            }

            function addto_cart() {
                $('.add_to_cart').click(function() {
                    var u_id = "11";
                    if(u_id){
                        var product_id = $(this).data("productid");
                        var product_name  = $(this).data("productname");
                        var product_price = $(this).data("productprice");
                        var product_image = $(this).data("productimage");

                        var quantity      = 1;
                        $.ajax({
                            url:"https://velloreads.com/cart/save",
                            type:"POST",
                            data:{product_id:product_id, product_name:product_name, product_price:product_price, product_image:product_image, quantity:quantity, u_id:u_id},
                            success:function(resp){
                                $("html").animate({ scrollTop: 0 }, "slow");
                                $('.alert').removeClass("hide");
                                setTimeout(function() {
                                    $('.alert').addClass("hide");
                                }, 2000);
                            },
                            error:function (resp) {
                                alert(resp)
                            }
                        });

                        $('.close-icon').click(function() {
                            $('.alert').addClass("hide")
                        });
                    } else {
                        var baseurl = window.location.origin + "/users/login";
                        location.replace(baseurl)
                    }

                });
            }

            function get_filter(class_name)
            {
                var filter = [];
                $('.'+class_name+':checked').each(function(){
                    filter.push($(this).val());
                });
                return filter;
            }

            $('.common_selector').click(function(){
                filter_data();
            });

            $('#price_range').slider({
                range:true,
                min:0,
                max:65000,
                values:[00, 65000],
                step:500,
                stop:function(event, ui)
                {
                    $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                    $('#hidden_minimum_price').val(ui.values[0]);
                    $('#hidden_maximum_price').val(ui.values[1]);
                    filter_data();
                }
            });

            $('#discount_range').slider({
                range:true,
                min:0,
                max:100,
                values:[00, 100],
                step:5,
                stop:function(event, ui)
                {
                    $('#discount_show').html(ui.values[0] + ' - ' + ui.values[1]);
                    $('#hidden_minimum_discount').val(ui.values[0]);
                    $('#hidden_maximum_discount').val(ui.values[1]);
                    filter_data();
                }
            });

            $('.category').on('click',function(){
                var category_id = $(this).val();
                if(category_id){
                    console.log(category_id)
                }else{
                }

            });

        });
    </script>

    <!-- End Product Filter -->


<?php //include 'footer.php';?>