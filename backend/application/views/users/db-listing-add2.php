<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">  

<script src="<?php echo base_url(); ?>assets/js/highlight.js"></script>
<script src="<?php echo base_url(); ?>assets/js/wysiwyg.min.js"></script>
<link href="<?php echo base_url(); ?>assets/css/wysiwyg.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/highlight.min..css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



<style>
    .imagePreview {
    width: 100%;
    height: 180px;
    background-position: center center;
    background:url(http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg);
    background-color:#fff;
    background-size: cover;
    background-repeat:no-repeat;
    display: inline-block;
    box-shadow:0px -3px 6px 2px rgba(0,0,0,0.2);
    }
    .btn-primary
    {
    display:block;
    border-radius:0px;
    box-shadow:0px 4px 6px 2px rgba(0,0,0,0.2);
    margin-top:-5px;
    }
    .imgUp
    {
    margin-bottom:15px;
    }
    .del
    {
    position:absolute;
    top:0px;
    right:15px;
    width:30px;
    height:30px;
    text-align:center;
    line-height:30px;
    background-color:rgba(255,255,255,0.6);
    cursor:pointer;
    }
    .imgAdd
    {
    width:30px;
    height:30px;
    border-radius:50%;
    background-color:#4bd7ef;
    color:#fff;
    box-shadow:0px 0px 2px 1px rgba(0,0,0,0.2);
    text-align:center;
    line-height:30px;
    margin-top:0px;
    cursor:pointer;
    font-size:15px;
    }
    
    #file-photo {
   opacity: 0;
   position: absolute;
   z-index: -1;
}
    
    
</style>
  
<?php
#db-listing-add.php
foreach($company as $companyRow) { }
?>
	<!--TOP SEARCH SECTION-->

	<section class="bottomMenu dir-il-top-fix">

		<?php $this->load->view('templates/header-index.php'); ?>

	</section>

	<!--DASHBOARD-->

	<section>

		<div class="tz">

			<!--LEFT SECTION-->

		<?php $this->load->view('templates/sidemenu.php'); ?>

			<!--CENTER SECTION-->

			<div class="tz-2">

				<div class="tz-2-com tz-2-main">

					<h4>Manage Listing</h4>
				
					<div class="db-list-com tz-db-table">

						<div class="ds-boar-title">

							<h2>Add New Lisiting</h2>
							
							<?php echo validation_errors(); ?>
							<?php echo $this->session->flashdata('uploadError'); ?>
							<p>Fill (*) required fields </p>

						</div>
						

							<div class="hom-cre-acc-left hom-cre-acc-right">

							<div class="">

							<form class="" action="" method="post" enctype="multipart/form-data" >
								<input type="hidden" name="do" value="addListing"/>
								<input type="hidden" name="uid" value="<?php echo $h_rows['u_id']; ?>"/>
								<div class="row">
								    <div class="col s12">
								    <h5>Business Information</h5>
								    </div>
								    <div class="col s6">
								        <div class="form-group">
                                            <label for="first_name" id="fnameErr">First Name </label>
                                            <input id="fname" type="text" class="validate" name="fname" required autocomplete="off" pattern="^[A-Za-z]+$" title="Alphabetics Only" value="<?php echo set_value('fname');  ?>">
                                        </div>
                                    </div>
                                    <div class="col s6">
								        <div class="form-group">
                                            <label for="last_name" id="lnameErr">Last Name </label>
                                            <input id="lname" type="text" class="validate" name="lname" autocomplete="off" pattern="^[A-Za-z]+$" title="Alphabetics Only" value="<?php echo set_value('lname'); ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="col s12">
								        <div class="form-group">
                                            <label for="exampleInputEmail1">Listing Title *</label>
                                            <input type="text" class="validate" id="select-searchListingTitle" name="title" autocomplete="off" value="<?php echo set_value('title'); ?>" onkeyup="autoListingTitle();">
                                            <small id="emailHelp" class="form-text text-muted">Please conform its not listed in our site</small>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col s6">
								        <div class="form-group">
                                            <label for="phone" id="phoneErr">Mobile </label>
                                            <input id="phone" type="text" class="validate" name="phone" autocomplete="off"  value="<?php echo set_value('phone'); ?>" >
                                        </div>
                                    </div>
                                    
                                    <div class="col s6">
								        <div class="form-group">
                                            <label for="landline" id="phoneErr">Landline </label>
                                            <input id="landline" type="text" class="validate" name="landline" autocomplete="off"  value="<?php echo set_value('landline'); ?>" >
                                        </div>
                                    </div>
                                    <div class="col s6">
								        <div class="form-group">
                                            <label for="whatsapp" id="phoneErr">Whatsapp </label>
                                            <input id="whatsapp" type="text" class="validate" name="whatsapp" autocomplete="off"  value="<?php echo set_value('whatsapp'); ?>" >
                                        </div>
                                    </div>
                                    <div class="col s6">
								        <div class="form-group">
                                            <label for="email" id="emailErr">Email </label>
                                            <input id="email" type="email" class="validate" name="email" autocomplete="off" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="example@example.com" value="<?php echo set_value('email'); ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="col s6">
								        <div class="form-group">
                                            <label for="website" id="websiteErr">Website Link</label>
                                            <input id="website" type="text" class="validate" name="website" autocomplete="off" value="<?php echo set_value('website'); ?>" value="">
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col s6">
								        <div class="form-group">
                                            <label for="addresss" id="addressErr">Address *</label>
                                            <input id="address" type="text" class="validate" name="address" autocomplete="off" value="<?php echo set_value('address'); ?>" >
                                        </div>
                                    </div>
                                    
                                    <div class="col s6">
								        <div class="form-group">
                                            <label for="addresss" id="addressErr">Location *</label>
                                            <input type="text" id="select-searchLocation" placeholder="Choose your location" class="" autocomplete="off" name="location" value="<?php echo set_value('location'); ?>" onkeyup="autoListingLocation();">
                                            <span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showLocation" style="width:45%">
    											<ul  id="listingLocation">
    											
    											</ul>
    										</span>
    										<span id="locationErr"></span>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col s6">
								        <div class="form-group">
                                            <label for="addresss" id="addressErr">Category *</label>
                                            <select class="js-example-basic-multiple" name="cate[]" multiple="multiple">
                                                <option value="AL">Alabama</option>
                                                <option value="WY">Wyoming</option>
                                            </select>

                                            
										</span>
										<span id="cateErr"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="col s6">
								        <div class="form-group">
                                            <label for="addresss" id="addressErr">Sub Category *</label>
                                            <input type="text" id="select-searchSubCategory" placeholder="Choose Listing SubCategory" class="" autocomplete="off" name="subcate[]" value="" onkeyup="autoListingSubCategory();">
									    	<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showSubCategory" style="width:98%">
											<ul  id="listingSubCategory">
											
											</ul>
										</span>
										<span id="subcateErr"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="col s6">
								        <div class="form-group">
                                            <label for="addresss" id="addressErr">Opening Days</label>
                                            <select multiple name="time[]" id="opendays">

											
											<option value="All Days" <?php echo (set_value('time[]') == 'All Days')?" selected=' selected'":""?>>All Days</option>

											<option value="Mon" <?php if(isset($_REQUEST['time']) && $_REQUEST['time'] == "Mon") { ?>selected<?php  } ?>>Monday</option>

											<option value="Tue" <?php if(isset($_REQUEST['time']) && $_REQUEST['time'] == "Tue") { ?>selected<?php  } ?>>Tuesday</option>

											<option value="Wed" <?php if(isset($_REQUEST['time']) && $_REQUEST['time'] == "Wed") { ?>selected<?php  } ?>>Wednesday</option>

											<option value="Thu" <?php if(isset($_REQUEST['time']) && $_REQUEST['time'] == "Thu") { ?>selected<?php  } ?>>Thursday</option>

											<option value="Fri" <?php if(isset($_REQUEST['time']) && $_REQUEST['time'] == "Fri") { ?>selected<?php  } ?>>Friday</option>

											<option value="Sat" <?php if(isset($_REQUEST['time']) && $_REQUEST['time'] == "Sat") { ?>selected<?php  } ?>>Saturday</option>

											<option value="Sun" <?php if(isset($_REQUEST['time']) && $_REQUEST['time'] == "Sun") { ?>selected<?php  } ?>>Sunday</option>

										</select>
										
										<span id="timeErr"></span>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="col s3">
								        <div class="form-group">
                                            <label for="addresss" id="addressErr">OpeningTime</label>
                                            <select name="opentime" id="opentime">

											<option value="" disabled selected>Open Time *</option>

											<option value="12 HOURS" <?php echo (set_value('opentime') == '12 HOURS')?" selected=' selected'":""?>>12 HOURS</option>
											<option value="12:00 AM" <?php echo (set_value('opentime') == '12:00 AM')?" selected=' selected'":""?>>12:00 AM</option>
											<option value="12:30 AM" <?php echo (set_value('opentime') == '12:30 AM')?" selected=' selected'":""?>>12:30 AM</option>

											<option value="01:00 AM" <?php echo (set_value('opentime') == '01:00 AM')?" selected=' selected'":""?>>01:00 AM</option>
											<option value="01:30 AM" <?php echo (set_value('opentime') == '01:00 AM')?" selected=' selected'":""?>>01:30 AM</option>

											<option value="02:00 AM" <?php echo (set_value('opentime') == '02:00 AM')?" selected=' selected'":""?>>02:00 AM</option>
											<option value="02:30 AM" <?php echo (set_value('opentime') == '02:30 AM')?" selected=' selected'":""?>>02:30 AM</option>

											<option value="03:00 AM" <?php echo (set_value('opentime') == '03:00 AM')?" selected=' selected'":""?>>03:00 AM</option>
											<option value="03:30 AM" <?php echo (set_value('opentime') == '03:30 AM')?" selected=' selected'":""?>>03:30 AM</option>

											<option value="04:00 AM" <?php echo (set_value('opentime') == '04:00 AM')?" selected=' selected'":""?>>04:00 AM</option>
											<option value="04:30 AM" <?php echo (set_value('opentime') == '04:30 AM')?" selected=' selected'":""?>>04:30 AM</option>

											<option value="05:00 AM" <?php echo (set_value('opentime') == '05:00 AM')?" selected=' selected'":""?>>05:00 AM</option>
											<option value="05:30 AM" <?php echo (set_value('opentime') == '05:30 AM')?" selected=' selected'":""?>>05:30 AM</option>

											<option value="06:00 AM" <?php echo (set_value('opentime') == '06:00 AM')?" selected=' selected'":""?>>06:00 AM</option>
											<option value="06:30 AM" <?php echo (set_value('opentime') == '06:30 AM')?" selected=' selected'":""?>>06:30 AM</option>

											<option value="07:00 AM" <?php echo (set_value('opentime') == '07:00 AM')?" selected=' selected'":""?>>07:00 AM</option>
											<option value="07:30 AM" <?php echo (set_value('opentime') == '07:30 AM')?" selected=' selected'":""?>>07:30 AM</option>

											<option value="08:00 AM" <?php echo (set_value('opentime') == '08:00 AM')?" selected=' selected'":""?>>08:00 AM</option>
											<option value="08:30 AM" <?php echo (set_value('opentime') == '08:30 AM')?" selected=' selected'":""?>>08:30 AM</option>

											<option value="09:00 AM" <?php echo (set_value('opentime') == '09:00 AM')?" selected=' selected'":""?>>09:00 AM</option>
											<option value="09:30 AM" <?php echo (set_value('opentime') == '09:30 AM')?" selected=' selected'":""?>>09:30 AM</option>

											<option value="10:00 AM" <?php echo (set_value('opentime') == '10:00 AM')?" selected=' selected'":""?>>10:00 AM</option>
											<option value="10:30 AM" <?php echo (set_value('opentime') == '10:30 AM')?" selected=' selected'":""?>>10:30 AM</option>

											<option value="11:00 AM" <?php echo (set_value('opentime') == '11:00 AM')?" selected=' selected'":""?>>11:00 AM</option>
											<option value="11:30 AM" <?php echo (set_value('opentime') == '11:30 AM')?" selected=' selected'":""?>>11:30 AM</option>

											<option value="12:00 PM" <?php echo (set_value('opentime') == '12:00 PM')?" selected=' selected'":""?>>12:00 PM</option>
											<option value="12:30 PM" <?php echo (set_value('opentime') == '12:30 PM')?" selected=' selected'":""?>>12:30 PM</option>

											<option value="01:00 PM" <?php echo (set_value('opentime') == '01:00 PM')?" selected=' selected'":""?>>01:00 PM</option>
											<option value="01:30 PM" <?php echo (set_value('opentime') == '01:30 PM')?" selected=' selected'":""?>>01:30 PM</option>

											<option value="02:00 PM" <?php echo (set_value('opentime') == '02:00 PM')?" selected=' selected'":""?>>02:00 PM</option>
											<option value="02:30 PM" <?php echo (set_value('opentime') == '02:30 PM')?" selected=' selected'":""?>>02:30 PM</option>

											<option value="03:00 PM" <?php echo (set_value('opentime') == '03:00 PM')?" selected=' selected'":""?>>03:00 PM</option>
											<option value="03:30 PM" <?php echo (set_value('opentime') == '03:30 PM')?" selected=' selected'":""?>>03:30 PM</option>

											<option value="04:00 PM" <?php echo (set_value('opentime') == '04:00 PM')?" selected=' selected'":""?>>04:00 PM</option>
											<option value="04:30 PM" <?php echo (set_value('opentime') == '04:30 PM')?" selected=' selected'":""?>>04:30 PM</option>

											<option value="05:00 PM" <?php echo (set_value('opentime') == '05:00 PM')?" selected=' selected'":""?>>05:00 PM</option>
											<option value="05:30 PM" <?php echo (set_value('opentime') == '05:30 PM')?" selected=' selected'":""?>>05:30 PM</option>

											<option value="06:00 PM" <?php echo (set_value('opentime') == '06:00 PM')?" selected=' selected'":""?>>06:00 PM</option>
											<option value="06:30 PM" <?php echo (set_value('opentime') == '06:30 PM')?" selected=' selected'":""?>>06:30 PM</option>

											<option value="07:00 PM" <?php echo (set_value('opentime') == '07:00 PM')?" selected=' selected'":""?>>07:00 PM</option>
											<option value="07:30 PM" <?php echo (set_value('opentime') == '07:30 PM')?" selected=' selected'":""?>>07:30 PM</option>

											<option value="08:00 PM" <?php echo (set_value('opentime') == '08:00 PM')?" selected=' selected'":""?>>08:00 PM</option>
											<option value="08:30 PM" <?php echo (set_value('opentime') == '08:30 PM')?" selected=' selected'":""?>>08:30 PM</option>

											<option value="09:00 PM" <?php echo (set_value('opentime') == '09:00 PM')?" selected=' selected'":""?>>09:00 PM</option>
											<option value="09:30 PM" <?php echo (set_value('opentime') == '09:30 PM')?" selected=' selected'":""?>>09:30 PM</option>

											<option value="10:00 PM" <?php echo (set_value('opentime') == '10:00 PM')?" selected=' selected'":""?>>10:00 PM</option>
											<option value="10:30 PM" <?php echo (set_value('opentime') == '10:30 PM')?" selected=' selected'":""?>>10:30 PM</option>

											<option value="11:00 PM" <?php echo (set_value('opentime') == '11:00 PM')?" selected=' selected'":""?>>11:00 PM</option>											
											<option value="11:30 PM" <?php echo (set_value('opentime') == '11:30 PM')?" selected=' selected'":""?>>11:30 PM</option>											

										</select>
										
										<span id="opentimeErr"></span>
                                            
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col s3">
								        <div class="form-group">
                                            <label for="addresss" id="addressErr">Closing Time</label>
                                            <select name="closetime" id="closetime">

											<option value="" disabled selected>Closing Time *</option>

											<option value="12 HOURS" <?php echo (set_value('closetime') == '12 HOURS')?" selected=' selected'":""?>>12 HOURS</option>
											<option value="12:00 AM" <?php echo (set_value('closetime') == '12:00 AM')?" selected=' selected'":""?>>12:00 AM</option>
											<option value="12:30 AM" <?php echo (set_value('closetime') == '12:30 AM')?" selected=' selected'":""?>>12:30 AM</option>

											<option value="01:00 AM" <?php echo (set_value('closetime') == '01:00 AM')?" selected=' selected'":""?>>01:00 AM</option>
											<option value="01:30 AM" <?php echo (set_value('closetime') == '01:30 AM')?" selected=' selected'":""?>>01:30 AM</option>

											<option value="02:00 AM" <?php echo (set_value('closetime') == '02:00 AM')?" selected=' selected'":""?>>02:00 AM</option>
											<option value="02:30 AM" <?php echo (set_value('closetime') == '02:30 AM')?" selected=' selected'":""?>>02:30 AM</option>

											<option value="03:00 AM" <?php echo (set_value('closetime') == '03:00 AM')?" selected=' selected'":""?>>03:00 AM</option>
											<option value="03:30 AM" <?php echo (set_value('closetime') == '03:30 AM')?" selected=' selected'":""?>>03:30 AM</option>

											<option value="04:00 AM" <?php echo (set_value('closetime') == '04:00 AM')?" selected=' selected'":""?>>04:00 AM</option>
											<option value="04:30 AM" <?php echo (set_value('closetime') == '04:30 AM')?" selected=' selected'":""?>>04:30 AM</option>

											<option value="05:00 AM" <?php echo (set_value('closetime') == '05:00 AM')?" selected=' selected'":""?>>05:00 AM</option>
											<option value="05:30 AM" <?php echo (set_value('closetime') == '05:30 AM')?" selected=' selected'":""?>>05:30 AM</option>

											<option value="06:00 AM" <?php echo (set_value('closetime') == '06:00 AM')?" selected=' selected'":""?>>06:00 AM</option>
											<option value="06:30 AM" <?php echo (set_value('closetime') == '06:30 AM')?" selected=' selected'":""?>>06:30 AM</option>

											<option value="07:00 AM" <?php echo (set_value('closetime') == '07:00 AM')?" selected=' selected'":""?>>07:00 AM</option>
											<option value="07:30 AM" <?php echo (set_value('closetime') == '07:30 AM')?" selected=' selected'":""?>>07:30 AM</option>

											<option value="08:00 AM" <?php echo (set_value('closetime') == '08:00 AM')?" selected=' selected'":""?>>08:00 AM</option>
											<option value="08:30 AM" <?php echo (set_value('closetime') == '08:30 AM')?" selected=' selected'":""?>>08:30 AM</option>

											<option value="09:00 AM" <?php echo (set_value('closetime') == '09:00 AM')?" selected=' selected'":""?>>09:00 AM</option>
											<option value="09:30 AM" <?php echo (set_value('closetime') == '09:30 AM')?" selected=' selected'":""?>>09:30 AM</option>

											<option value="10:00 AM" <?php echo (set_value('closetime') == '10:00 AM')?" selected=' selected'":""?>>10:00 AM</option>
											<option value="10:30 AM" <?php echo (set_value('closetime') == '10:30 AM')?" selected=' selected'":""?>>10:30 AM</option>

											<option value="11:00 AM" <?php echo (set_value('closetime') == '11:00 AM')?" selected=' selected'":""?>>11:00 AM</option>
											<option value="11:30 AM" <?php echo (set_value('closetime') == '11:30 AM')?" selected=' selected'":""?>>11:30 AM</option>

											<option value="12:00 PM" <?php echo (set_value('closetime') == '12:00 PM')?" selected=' selected'":""?>>12:00 PM</option>
											<option value="12:30 PM" <?php echo (set_value('closetime') == '12:30 PM')?" selected=' selected'":""?>>12:30 PM</option>

											<option value="01:00 PM" <?php echo (set_value('closetime') == '01:00 PM')?" selected=' selected'":""?>>01:00 PM</option>
											<option value="01:30 PM" <?php echo (set_value('closetime') == '01:30 PM')?" selected=' selected'":""?>>01:30 PM</option>

											<option value="02:00 PM" <?php echo (set_value('closetime') == '02:00 PM')?" selected=' selected'":""?>>02:00 PM</option>
											<option value="02:30 PM" <?php echo (set_value('closetime') == '02:30 PM')?" selected=' selected'":""?>>02:30 PM</option>

											<option value="03:00 PM" <?php echo (set_value('closetime') == '03:00 PM')?" selected=' selected'":""?>>03:00 PM</option>
											<option value="03:30 PM" <?php echo (set_value('closetime') == '03:30 PM')?" selected=' selected'":""?>>03:30 PM</option>

											<option value="04:00 PM" <?php echo (set_value('closetime') == '04:00 PM')?" selected=' selected'":""?>>04:00 PM</option>
											<option value="04:30 PM" <?php echo (set_value('closetime') == '04:30 PM')?" selected=' selected'":""?>>04:30 PM</option>

											<option value="05:00 PM" <?php echo (set_value('closetime') == '05:00 PM')?" selected=' selected'":""?>>05:00 PM</option>
											<option value="05:30 PM" <?php echo (set_value('closetime') == '05:30 PM')?" selected=' selected'":""?>>05:30 PM</option>

											<option value="06:00 PM" <?php echo (set_value('closetime') == '06:00 PM')?" selected=' selected'":""?>>06:00 PM</option>
											<option value="06:30 PM" <?php echo (set_value('closetime') == '06:30 PM')?" selected=' selected'":""?>>06:30 PM</option>

											<option value="07:00 PM" <?php echo (set_value('closetime') == '07:00 PM')?" selected=' selected'":""?>>07:00 PM</option>
											<option value="07:30 PM" <?php echo (set_value('closetime') == '07:30 PM')?" selected=' selected'":""?>>07:30 PM</option>

											<option value="08:00 PM" <?php echo (set_value('closetime') == '08:00 PM')?" selected=' selected'":""?>>08:00 PM</option>
											<option value="08:30 PM" <?php echo (set_value('closetime') == '08:30 PM')?" selected=' selected'":""?>>08:30 PM</option>

											<option value="09:00 PM" <?php echo (set_value('closetime') == '09:00 PM')?" selected=' selected'":""?>>09:00 PM</option>
											<option value="09:30 PM" <?php echo (set_value('closetime') == '09:30 PM')?" selected=' selected'":""?>>09:30 PM</option>

											<option value="10:00 PM" <?php echo (set_value('closetime') == '10:00 PM')?" selected=' selected'":""?>>10:00 PM</option>
											<option value="10:30 PM" <?php echo (set_value('closetime') == '10:30 PM')?" selected=' selected'":""?>>10:30 PM</option>

											<option value="11:00 PM" <?php echo (set_value('closetime') == '11:00 PM')?" selected=' selected'":""?>>11:00 PM</option>											
											<option value="11:30 PM" <?php echo (set_value('closetime') == '11:30 PM')?" selected=' selected'":""?>>11:30 PM</option>	

										</select>
										
										<span id="opentimeErr"></span>
                                            
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="col s12">
								        <div class="form-group">
                                            <label for="textarea1" id="descErr">Listing Descriptions *</label>
                                            <textarea id="desc" class="materialize-textarea" name="desc"><?php echo set_value('desc'); ?></textarea>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="col s12">
								        <div class="form-group">
                                            <label > Job Apply Notifications Required?
    											<input type="checkbox" name="job_apply" value = "1" > <span class="lever"></span> </label>
                                            
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col s12">
								        <h5>Social Media Information</h5>
								    </div>
								    
								    <div class="col s6">
								        <div class="form-group">
                                            <label for="facebook" id="addressErr">Facebook</label>
                                            <input type="text" class="validate" name="facebook" id="facebook" value="<?php echo set_value('facebook'); ?>" autocomplete="off">
											<small id="facebook" class="form-text text-muted">Eg  : wwww.facebook.com/companyname</small>
                                        </div>
                                    </div>
                                    
                                    <div class="col s6">
								        <div class="form-group">
                                            <label for="google" id="addressErr">Google +</label>
                                            <input type="text" class="validate" name="google" id="google" value="<?php echo set_value('google'); ?>" autocomplete="off">
											<small id="facebook" class="form-text text-muted">Eg  : wwww.googleplus.com/companyname</small>
                                        </div>
                                    </div>
                                    
                                    <div class="col s6">
								        <div class="form-group">
                                            <label for="facebook" id="addressErr">Twitter</label>
                                            <input type="text" class="validate" name="twitter" id="twitter" value="<?php echo set_value('twitter'); ?>" autocomplete="off">
											<small id="facebook" class="form-text text-muted">Eg  : wwww.twitter.com/companyname</small>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="col s12">
								        <h5>Googel Map</h5>
								    </div>
								    
								    <div class="col s6">
								        <div class="form-group">
                                            <label for="facebook" id="addressErr">Google Map</label>
                                            <textarea class="validate" name="googleMap" id="googleMap" autocomplete="off"><?php echo set_value('googleMap'); ?></textarea>
											<small id="facebook" class="form-text text-muted">Place iframe code</small>
                                        </div>
                                    </div>
                                    
                                    <div class="col s6">
								        <div class="form-group">
                                            <label for="facebook" id="addressErr">360 Degree View:</label>
                                            <textarea class="validate" name="degreeView" id="degreeView" autocomplete="off"><?php echo set_value('degreeView'); ?></textarea>
											<small id="facebook" class="form-text text-muted">Place iframe code</small>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    </div>
                                    
                                    
                                    
                                    
                                   
                                    

								
								
								
								
								<!-- row -->
                                    <div class="row">
                                        <h5>Upload Profile Pictures</h5>
                                      <div class="col-sm-6 imgUp">
                                        <div class="imagePreview"></div>
                                    <label class="btn btn-primary">
						    			Upload<input type="file" class="uploadFile img" value="Upload Photo" id="file-photo" style="width: 0px;height: 0px;overflow: hidden;">
                                    				</label>
                                      </div><!-- col-2 -->
                                      
                                     </div><!-- row -->
								
								
								<!-- row -->
                                    <div class="row">
                                        <h5>Upload Services</h5>
                                      <div class="col-sm-4 imgUp">
                                        <div class="imagePreview"></div>
                                        <input type='text'class='services' placeholder="Service List Hera" style="">
                                    <label class="btn btn-primary">
						    			Upload<input type="file" class="uploadFile img" id="file-photo" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                                    				</label>
                                      </div><!-- col-2 -->
                                      <i class="fa fa-plus imgAdd"></i>
                                     </div><!-- row -->
                                     
                                     
                                     	<!-- row -->
                                    <div class="row">
                                        <h5>Features</h5>
                                        <div class="col s12">
    								        <div class="form-group">
                                                <label for="facebook" id="addressErr">Feature Title</label>
                                                <input type="text" id="select-searchCategory" placeholder="Choose Listing Category" class="" autocomplete="off" name="cate" value="<?php echo set_value('cate'); ?>" ">
    											<small id="facebook" class="form-text text-muted">Like Our Features, Departments, Activities..etc</small>
                                            </div>
                                            <div class="form-group">
                                                
                                            <div class="col-sm-4 imgUp">
                                                <div class="imagePreview"></div>
                                                <input type='text'class='services' placeholder="Service List Hera" style="">
                                                <label class="btn btn-primary">
                                                Upload<input type="file" class="uploadFile img" id="file-photo" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                                                </label>
                                            </div><!-- col-2 -->
                                            <i class="fa fa-plus imgAdd"></i>
                                            
                                            
                                            </div>
                                        </div>
                                    
                                    </div><!-- row -->

								

								
								
								
															
								
								
								<br>								

								<div class="row">

									<div class="col s12">

									 <input type="submit" name="sample" class="full-btn" value="Submit & Continue"> 

									 </div>

								</div>

								<div class="row">
															

								</div>

							</form>

					</div>

					</div>

					</div>


				</div>

			</div>

			<!--RIGHT SECTION-->

		</div>

	</section>
	
	<!--END DASHBOARD-->
	<!--SCRIPT FILES-->
	<script type="text/javascript">  
	
	$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    });

	
	function autoListingLocation() {
			var min_length = 0; // min characters to display the autocomplete
			var keyword = $('#select-searchLocation').val();
			var action = "search";
			if (keyword.length >= min_length) {
				$.ajax({
					url: '<?php echo base_url() ?>users/searchListingLocation',
					type: 'POST',
					data: {title:keyword, action:action},
					success:function(data){
						//console.log(data);
						$('#listingLocation').show();
						$('#listingLocation').html(data);
						$("#display_showLocation").css("display","block");
					}
				});
			} else {
				$('#listingLocation').hide();
			}
		}
		// set_item : this function will be executed when we select an item
		function setListingLocation(item) {
			// change input value
			$('#select-searchLocation').val(item);
			//$("#indexSearch").submit();
			// hide proposition list
			$('#listingLocation').hide();
		}
		
		
		function autoListingCategory() {
			var min_length = 0; // min characters to display the autocomplete
			var keyword = $('#select-searchCategory').val();
			var action = "search category";
			if (keyword.length >= min_length) {
				$.ajax({
					url: '<?php echo base_url() ?>users/searchListingCategory',
					type: 'POST',
					data: {title:keyword, action:action},
					success:function(data){
						//console.log(data);
						$('#listingCategory').show();
						$('#listingCategory').html(data);
						$("#display_showCategory").css("display","block");
					}
				});
			} else {
				$('#listingCategory').hide();
			}
		}
		// set_item : this function will be executed when we select an item
		function setListingCategory(item) {
			// change input value
			$('#select-searchCategory').val(item);
			//$("#indexSearch").submit();
			// hide proposition list
			$('#listingCategory').hide();
		}
		
		function autoListingSubCategory() {
			var min_length = 0; // min characters to display the autocomplete
			var keyword = $('#select-searchSubCategory').val();
			var cateTitle = $('#select-searchCategory').val();
			var action = "search subcategory";
			if (keyword.length >= min_length) {
				$.ajax({
					url: '<?php echo base_url() ?>users/searchListingSubCategory',
					type: 'POST',
					data: {title:keyword, cateTitle:cateTitle, action:action},
					success:function(data){
						//console.log(data);
						$('#listingSubCategory').show();
						$('#listingSubCategory').html(data);
						$("#display_showSubCategory").css("display","block");
					}
				});
			} else {
				$('#listingSubCategory').hide();
			}
		}
		// set_item : this function will be executed when we select an item
		function setListingSubCategory(item) {
			// change input value
			$('#select-searchSubCategory').val(item);
			//$("#indexSearch").submit();
			// hide proposition list
			$('#listingSubCategory').hide();
		}
		
		function autoListingTitle() {
			var min_length = 0; // min characters to display the autocomplete
			var keyword = $('#select-searchListingTitle').val();
			var action = "search title";
			if (keyword.length >= min_length) {
				$.ajax({
					url: '<?php echo base_url() ?>connect/searchListingTitle',
					type: 'POST',
					data: {title:keyword, action:action},
					success:function(data){
						//console.log(data);
						$('#listingTitle').show();
						$('#listingTitle').html(data);
						$("#display_showTitle").css("display","block");
					}
				});
			} else {
				$('#listingTitle').hide();
			}
		}
		// set_item : this function will be executed when we select an item
		function setListingTitle(item) {
			// change input value
			$('#select-searchListingTitle').val(item);
			//$("#indexSearch").submit();
			// hide proposition list
			$('#listingTitle').hide();
		}
  
 



$(".imgAdd").click(function(){
  $(this).closest(".row").find('.imgAdd').before('<div class="col-sm-4 imgUp"><div class="imagePreview"></div><input type="text" class="services" placeholder="Service List Hera" ><label class="btn btn-primary">Upload<input type="file" class="uploadFile" img" id="file-photo" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del"></i></div>');
});
$(document).on("click", "i.del" , function() {
// 	to remove card
  $(this).parent().remove();
// to clear image
  // $(this).parent().find('.imagePreview').css("background-image","url('')");
});
$(function() {
    $(document).on("change",".uploadFile", function()
    {
    		var uploadFile = $(this);
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
 
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
 
            reader.onloadend = function(){ // set image data as background of div
                //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url("+this.result+")");
            }
        }
      
    });
    
   
    
          
});    
  

  
</script>  
	
	
	
