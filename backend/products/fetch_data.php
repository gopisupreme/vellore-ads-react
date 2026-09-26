<?php

//fetch_data.php

include('database_connection.php');

if(isset($_POST["action"]))
{
    $list=$_POST["list_id"];
    $query = "
  SELECT * FROM product WHERE p_status = '1' AND list_id='$list'";

//  Price Filter

    if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
    {
        $query .= "AND p_rate BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'";
    }

//  Discount Filter
   if(isset($_POST["minimum_discount"], $_POST["maximum_discount"]) && !empty($_POST["minimum_discount"]) && !empty($_POST["maximum_discount"]))
    {
        $query .= " AND p_discount BETWEEN '".$_POST["minimum_discount"]."' AND '".$_POST["maximum_discount"]."'";
    }

// Brand Filter

    if(isset($_POST["brand"]))
    {
        $brand_filter = implode("','", $_POST["brand"]);
        $query .= "
  AND p_brand IN('".$brand_filter."')
  ";
    }

    // Category Filter

    if(isset($_POST["category"]))
    {
        $category_filter = implode("','", $_POST["category"]);
        $query .= "
   AND p_category IN('".$category_filter."')
  ";
    }

    // Sub Category Filter

    if(isset($_POST["subcategory"]))
    {
        $subcategory_filter = implode("','", $_POST["subcategory"]);
        $query .= "
   AND p_subcategory IN('".$subcategory_filter."')
  ";
    }

    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();
    $output = '';
    if($total_row > 0)
    {
        foreach($result as $row)
        {
            header('Content-type: text/plain; charset=utf-8');
            $decoded= htmlspecialchars($row['p_name'], ENT_QUOTES);
            $output .= '
   <!--Products LISTINGS-->
	<div class="col-md-3 products_block" >
		<div class="thumbnail" >
		        <a href="products/product_details/'. $row['p_id'] .'" class="image_block center-image">
				 <img src="https://velloreads.com/assets/images/list-deta/'. $row['p_img'] .'"  alt="">
				</a>
				<div class="caption">
				<div  style="height:110px">
				  <h5><a href="product_details/'. $row['p_id'] .'">'. $row['p_name'] .' </a></h5>
				  </div>
				  <h6><span><i class="fa fa-inr" aria-hidden="true"></i> '. $row['p_rate'] .'</span> <span class="offPrice">'. $row['p_discount'] .' %off</span></h6>
				 
				 <h4 style="text-align:center;">
				 <a class="btn btn-primary view_details" href="product_details/'. $row['p_id'] .'" title="View Product Details"><i class="fa fa-eye" aria-hidden="true"></i></a> 
				 <span class="add_to_cart btn"  data-productid='. $row['p_id'] .'  data-listid='. $row['list_id'] .' data-productname="'.$decoded.'" data-productprice='. $row['p_rate'] .'  data-productimage='. $row['p_img'] .' data-login='. $row['p_img'] .'  style="font-size:12px; padding:5px">Add to Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></span> </h4>
				</div>
            </div>
	  </div>
	<!--End  Products LISTINGS-->
   ';
        }
    }
    else
    {
        $output = '<h3>No Data Found</h3>';
    }
    echo $output;
}

?>