<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load company data
foreach ($company as $companyRow) {}
$categoryId = NULL;
$cateS = NULL;
$cityS = $this->session->userdata('city');
$cityU = $companyRow->city;
$city = $cityS != "" ? $cityS : $cityU;
$cateS = $this->session->userdata('title');

$company = $this->companydata;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo isset($page_title) ? $page_title : 'My Website'; ?></title>

<!-- CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/responsive.css'); ?>">

<!-- Custom Header Styles -->
<style>
/* Header Container */

body{
    background-color: #141F31;
}


.ts-menu-4 {
    float: right;
    width: 16%;
    padding: 10px 0 0 1px;
}
.top-search-main {
    background: grey;
    border-bottom: 2px solid #ff7043;
    /*padding: 15px 0;*/
    font-family: 'Lato', sans-serif;
}

/* Logo */
.ts-menu-1 img {
    max-height: 60px;
    transition: transform 0.3s;
}
.ts-menu-1 img:hover {
    transform: scale(1.1);
}

/* Category Menu */
.ts-menu-2 {
    position: relative;
}
.ts-menu-2 .t-bb {
    font-weight: bold;
    color: #ff5722;
    cursor: pointer;
}
.cat-menu {
    display: none;
    position: absolute;
    top: 35px;
    left: 0;
    background: #152032;
    width: 300px;
    border-radius: 8px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.2);
    z-index: 1000;
}
.ts-menu-2:hover .cat-menu {
    display: block;
}
.cat-menu ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.cat-menu ul li a {
    display: block;
    padding: 10px 15px;
    color: #ff5722;
    text-decoration: none;
    transition: background 0.3s;
}
.cat-menu ul li a:hover {
    background: #ffccbc;
    border-radius: 5px;
}

/* Search Box */
.ts-menu-3 {
    margin-top: 10px;
}
.tourz-top-search-form {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}
.tourz-top-search-form input[type="text"] {
    padding: 10px 15px;
    border: 1px solid #ffccbc;
    border-radius: 6px;
    width: 200px;
    transition: all 0.3s;
}
.tourz-top-search-form input[type="text"]:focus {
    border-color: #ff5722;
    box-shadow: 0 0 5px #ff5722;
}

/* Submit Button */
.tourz-top-sear-btn {
    background: #ff5722;
    border: none;
    color: white;
    padding: 10px 20px;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s;
}
.tourz-top-sear-btn:hover {
    background: #ff7043;
}

/* User Menu */
.ts-menu-4 ul {
    list-style: none;
    display: flex;
    gap: 15px;
    padding: 0;
    margin: 0;
    align-items: center;
}
.ts-menu-4 ul li a {
    color: #ff5722;
    font-size: 16px;
    text-decoration: none;
    transition: color 0.3s;
}
.ts-menu-4 ul li a:hover {
    color: #d84315;
}

/* Mobile Menu */
.ts-menu-5 span {
    display: none;
    font-size: 24px;
    cursor: pointer;
}
@media (max-width: 768px) {
    .ts-menu-3, .ts-menu-4, .ts-menu-2 {
        display: none;
    }
    .ts-menu-5 span {
        display: block;
        color: #ff5722;
    }
}



.mob-right-nav {
    display: none;
    position: absolute;
    top: 60px; /* adjust depending on header height */
    left: 0;
    width: 100%;
    background: #152032;
    z-index: 9999;
    padding: 15px;
}


/* Remove hover effect on mobile */
@media (max-width: 768px) {
    .ts-menu-2:hover .cat-menu {
        display: none !important;
    }
}

</style>

<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<script>
$(document).ready(function(){
    $('.mob-right-nav').hide(); // hide initially
    $('.ts-menu-5 span').click(function(e){
        e.preventDefault();
        $('.mob-right-nav').stop(true,true).slideToggle(); // stop previous animations
    });
});

</script>
</head>
<body>

<div class="container top-search-main">
    <div class="row align-items-center">
        <!-- LOGO -->
        <div class="ts-menu-1 col-md-2">
            <a href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url('assets/images/aff-logo.png'); ?>" alt="<?php echo $companyRow->cName; ?>">
            </a>
        </div>

        <!-- CATEGORY MENU -->
        <div class="ts-menu-2 col-md-3">
            <a href="#" class="t-bb">Category <i class="fa fa-angle-down"></i></a>
            <div class="cat-menu cat-menu-1">
                <ul>
                    <li><a href="<?php echo base_url($city.'/Hospital'); ?>">Hospital & Clinics</a></li>
                    <li><a href="<?php echo base_url($city.'/Medical'); ?>">Medical Shop</a></li>
                    <li><a href="<?php echo base_url($city.'/Hotel'); ?>">Hotel & Resort</a></li>
                    <li><a href="<?php echo base_url($city.'/Restaurants'); ?>">Restaurant</a></li>
                </ul>
            </div>
        </div>

        <!-- SEARCH BOX -->
        <div class="ts-menu-3 col-md-4">
            <form class="tourz-search-form tourz-top-search-form" action="<?php echo base_url('pages/searchAutocomplete'); ?>" method="post">
                <input type="text" name="cityNm" placeholder="City" value="<?php echo $city; ?>" required>
                <input type="text" name="categoryNm" placeholder="Search your nearby listings..." required>
                <input type="submit" class="tourz-top-sear-btn" value="Search">
            </form>
        </div>

        <!-- USER MENU -->
        <div class="ts-menu-4 col-md-3 text-end">
            <ul>
                <?php if ($this->session->userdata('login')) {
                    $userType = $this->session->userdata('type');
                    $profile = ($userType=="admin") ? "connect/profile" : (($userType=="listing") ? "users/profile" : "customer/profile");
                ?>
                    <li><a href="<?php echo base_url('product/shopping_cart'); ?>"><i class="fa fa-shopping-cart"></i></a></li>
                    <li><a href="<?php echo base_url($profile); ?>"><i class="fa fa-user"></i></a></li>
                    <li><a href="<?php echo base_url('users/logout'); ?>"><i class="fa fa-sign-out"></i></a></li>
                <?php } else { ?>
                    <li><a href="<?php echo base_url('users/login'); ?>"><i class="fa fa-sign-in"></i> Sign In</a></li>
                    <li><a href="<?php echo base_url('post-free-ads'); ?>">Post Free Ads</a></li>
                <?php } ?>
            </ul>
        </div>

        <!-- MOBILE MENU ICON -->
        <div class="ts-menu-5 col-12 text-end mt-2">
            <span><i class="fa fa-bars"></i></span>
        </div>

        <!-- MOBILE MENU CONTAINER -->
        <div class="mob-right-nav col-12" style="display:none; background:#152032; padding:15px; border-radius:8px;">
            <ul>
                <li><a href="<?php echo base_url('users/login'); ?>">Sign In</a></li>
                <li><a href="<?php echo base_url('post-free-ads'); ?>">Post Free Ads</a></li>
            </ul>
        </div>
    </div>
</div>
