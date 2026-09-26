
<?php include("../../../dbconnect.php");
	session_start();

	if($_SESSION['email'] == "" or $_SESSION['type'] == "listing")
	{
		header("Location: ../login.php");
	}
?>

 <?php 

		$email = $_SESSION['email'];

		$h_sql = "SELECT * FROM users where u_email ='$email'";

		$h_res = mysqli_query($conn,$h_sql);

		$h_count = mysqli_num_rows($h_res);

		if($h_count == 1)

		{

			$h_rows = mysqli_fetch_assoc($h_res);

		}

	 ?>

<!DOCTYPE html>

<html lang="en">


<head>

	<title>Vellore ads | admin dashboard</title>

	<!-- META TAGS -->

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- FAV ICON(BROWSER TAB ICON) -->

	<link rel="shortcut icon" href="../images/fav.ico" type="image/x-icon">

	<!-- GOOGLE FONT -->

	<link href="https://fonts.googleapis.com/css?family=Poppins%7CQuicksand:500,700" rel="stylesheet">

	<!-- FONTAWESOME ICONS -->

	<link rel="stylesheet" href="../css/font-awesome.min.css">

	<!-- ALL CSS FILES -->

	<link href="../css/materialize.css" rel="stylesheet">

	<link href="../css/style.css" rel="stylesheet">

	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" />

	<!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->

	<link href="../css/responsive.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/datatables.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

	<!--[if lt IE 9]>

	<script src="js/html5shiv.js"></script>

	<script src="js/respond.min.js"></script>

	<![endif]-->

</head>



<body>

	<div id="preloader">

		<div id="status">&nbsp;</div>

	</div>

	<!--== MAIN CONTRAINER ==-->

	<?php include("header.php"); ?>

	<!--== BODY CONTNAINER ==-->

	<div class="container-fluid sb2">

		<div class="row">

			<?php include("sidebar.php"); ?>

			<!--== BODY INNER CONTAINER ==-->

			<div class="sb2-2">

				<!--== breadcrumbs ==-->

				<div class="sb2-2-2">

					<ul>

						<li><a href="main.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a> </li>

						<li class="active-bre"><a href="dashboard.php"> Dashboard</a> </li>

						<li class="page-back"><a href="#" onclick="window.history.back();"><i class="fa fa-backward" aria-hidden="true"></i> Back</a> </li>

					</ul>

				</div>

				<div class="tz-2 tz-2-admin">

							<div class="tz-2-com tz-2-main">

					<h4>Manage Listing</h4>

					

					<div class="db-list-com tz-db-table">

						<div class="ds-boar-title">

							<h2>Add New Lisiting</h2>

							<!--<p>All the Lorem Ipsum generators on the All the Lorem Ipsum generators on the</p>-->

						</div>

							<div class="hom-cre-acc-left hom-cre-acc-right">

							<div class="">

						<?php 

									if(isset($_POST['sample'])){

										$uid = $h_rows['u_id'];

$fname = $_POST['fname'];

$lname = $_POST['lname'];

$fullname = $fname." ".$lname;

$title = $_POST['title'];

$phone = $_POST['phone'];

$email = $_POST['email'];

$address = $_POST['address'];

$location = $_POST['location'];

$category = implode(', ', $_POST['cate']);

$opendays = implode(' : ', $_POST['time']);

$opentime = $_POST['opentime'];

$closetime = $_POST['closetime'];

$timing = $opentime." to ".$closetime;

$desc = $_POST['desc'];

$date = date("Y-m-d");

$l_sql = "INSERT into listing(l_userid,l_fullname,l_title,l_phone,l_email,l_address,l_loc_id,l_category,l_opendays,l_timing,l_desc,l_img,l_adddate,l_type,l_status) values ('$uid','$fullname','$title','$phone','$email','$address','$location','$category','$opendays','$timing','$desc','listing-default-img.png','$date','free','active') ";

$l_res = mysqli_query($conn,$l_sql);

if($l_res == true)

{

	echo "<p class='text-success' style='text-align:center;'>Your Ad is Added Successfully!</p>";

}

else

{

	echo "<p class='text-danger'>Failed! Please Try Again!</p>";

}

		}							 ?>

							<form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">

								<div class="row">

									<div class="input-field col s6">

										<input id="first_name" type="text" class="validate" name="fname" required>

										<label for="first_name">First Name</label>

									</div>

									<div class="input-field col s6">

										<input id="last_name" type="text" class="validate" name="lname" required>

										<label for="last_name">Last Name</label>

									</div>

								</div>

								<div class="row">

									<div class="input-field col s12">

										<input id="list_name" type="text" class="validate" name="title" required>

										<label for="list_name">Listing Title</label>

									</div>

								</div>

								<div class="row">

									<div class="input-field col s12">

										<input id="list_phone" type="text" class="validate" name="phone" required>

										<label for="list_phone">Phone / Mobile</label>

									</div>

								</div>

								<div class="row">

									<div class="input-field col s12">

										<input id="email" type="email" class="validate" name="email" >

										<label for="email">Email</label>

									</div>

								</div>

							

								<div class="row">

									<div class="input-field col s12">

										<input id="list_addr" type="text" class="validate" name="address" required>

										<label for="list_addr">Address</label>

									</div>

								</div>

								<div class="row">

									<div class="input-field col s12">

										<select name="location" required>

											<option value="" disabled selected>Choose your location in Vellore</option>

											<?php 

												$c_sql = "SELECT * FROM location where loc_status = 'active' and loc_city = 'vellore' order by loc_name asc";

												$c_res = mysqli_query($conn,$c_sql);

												while($c_rows = mysqli_fetch_assoc($c_res)){

													?>

													<option value="<?php echo $c_rows['loc_id']; ?>"><?php echo $c_rows['loc_name']; ?></option>

											<?php }	 ?>



										</select>

									</div>

								</div>

								<div class="row">

									<div class="input-field col s12">

										<?php 

										$csql="SELECT * FROM category where c_status = 'active' order by c_name asc";

										$cres= mysqli_query($conn,$csql);



									 ?>

										<select multiple name="cate[]" required>

											<option value="" disabled selected>Select Category</option>

											<?php 

												while($crow = mysqli_fetch_assoc($cres)) {

											 ?>

											<option value="<?php echo $crow['c_name']; ?>"><?php echo $crow['c_name']; ?></option>

											<?php } ?>

										</select>

									</div>

								</div>

								<div class="row">

									<div class="input-field col s12">

										<select multiple name="time[]" required>

											<option value="" disabled selected>Opening Days</option>

											<option value="All Days">All Days</option>

											<option value="Mon">Monday</option>

											<option value="Tue">Tuesday</option>

											<option value="Wed">Wednesday</option>

											<option value="Thu">Thursday</option>

											<option value="Fri">Friday</option>

											<option value="Sat">Saturday</option>

											<option value="Sun">Sunday</option>

										</select>

									</div>

								</div>

								<div class="row">

									<div class="input-field col s6">

										<select name="opentime" required>

											<option value="" disabled selected>Open Time</option>

											<option value="12:00 AM">12:00 AM</option>

											<option value="01:00 AM">01:00 AM</option>

											<option value="02:00 AM">02:00 AM</option>

											<option value="03:00 AM">03:00 AM</option>

											<option value="04:00 AM">04:00 AM</option>

											<option value="05:00 AM">05:00 AM</option>

											<option value="06:00 AM">06:00 AM</option>

											<option value="07:00 AM">07:00 AM</option>

											<option value="08:00 AM">08:00 AM</option>

											<option value="09:00 AM">09:00 AM</option>

											<option value="10:00 AM">10:00 AM</option>

											<option value="11:00 AM">11:00 AM</option>

											<option value="12:00 PM">12:00 PM</option>

											<option value="01:00 PM">01:00 PM</option>

											<option value="02:00 PM">02:00 PM</option>

											<option value="03:00 PM">03:00 PM</option>

											<option value="04:00 PM">04:00 PM</option>

											<option value="05:00 PM">05:00 PM</option>

											<option value="06:00 PM">06:00 PM</option>

											<option value="07:00 PM">07:00 PM</option>

											<option value="08:00 PM">08:00 PM</option>

											<option value="09:00 PM">09:00 PM</option>

											<option value="10:00 PM">10:00 PM</option>

											<option value="11:00 PM">11:00 PM</option>											

										</select>

									</div>

									<div class="input-field col s6">

										<select name="closetime" required>

											<option value="" disabled selected>Closing Time</option>

											<option value="12:00 AM">12:00 AM</option>

											<option value="01:00 AM">01:00 AM</option>

											<option value="02:00 AM">02:00 AM</option>

											<option value="03:00 AM">03:00 AM</option>

											<option value="04:00 AM">04:00 AM</option>

											<option value="05:00 AM">05:00 AM</option>

											<option value="06:00 AM">06:00 AM</option>

											<option value="07:00 AM">07:00 AM</option>

											<option value="08:00 AM">08:00 AM</option>

											<option value="09:00 AM">09:00 AM</option>

											<option value="10:00 AM">10:00 AM</option>

											<option value="11:00 AM">11:00 AM</option>

											<option value="12:00 PM">12:00 PM</option>

											<option value="01:00 PM">01:00 PM</option>

											<option value="02:00 PM">02:00 PM</option>

											<option value="03:00 PM">03:00 PM</option>

											<option value="04:00 PM">04:00 PM</option>

											<option value="05:00 PM">05:00 PM</option>

											<option value="06:00 PM">06:00 PM</option>

											<option value="07:00 PM">07:00 PM</option>

											<option value="08:00 PM">08:00 PM</option>

											<option value="09:00 PM">09:00 PM</option>

											<option value="10:00 PM">10:00 PM</option>

											<option value="11:00 PM">11:00 PM</option>	

										</select>

									</div>

								</div>

								<div class="row"> </div>

								<div class="row">

									<div class="input-field col s12">

										<textarea id="textarea1" class="materialize-textarea" name="desc"></textarea>

										<label for="textarea1">Listing Descriptions</label>

									</div>

								</div>

								

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

			</div>

		</div>

	</div>

	

	<!--SCRIPT FILES-->

	<script src="../js/jquery.min.js"></script>

	<script src="../js/bootstrap.js" type="text/javascript"></script>

	<script src="../js/jquery.dataTables.min.js"></script> 

	<script type="text/javascript" src="../js/datatables.js"></script>

	<script src="../js/materialize.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.datatable').dataTable({
				"sPaginationType": "bs_normal"
			});	
			$('.datatable').each(function(){
				var datatable = $(this);
				// SEARCH - Add the placeholder for Search and Turn this into in-line form control
				var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
				search_input.attr('placeholder', 'Search');
				search_input.addClass('form-control input-sm');
				// LENGTH - Inline-Form control
				var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
				length_sel.addClass('form-control input-sm');
			});
		});
		</script>


	<script src="../js/custom.js"></script>

</body>







</html>