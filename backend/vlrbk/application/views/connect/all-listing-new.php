
<?php include("../dbconnect.php");
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
<?php 
		$l_sql = "SELECT * FROM listing";
		$l_res = mysqli_query($conn,$l_sql);
		$l_con = mysqli_num_rows($l_res);
		$t_sql = "SELECT * FROM listing Where l_type = 'gold'";
		$t_res = mysqli_query($conn,$t_sql);
		$t_con = mysqli_num_rows($t_res);
		$u_sql = "SELECT * FROM users";
		$u_res = mysqli_query($conn,$u_sql);
		$u_con = mysqli_num_rows($u_res);
		$r_sql = "SELECT * FROM reviews";
		$r_res = mysqli_query($conn,$r_sql);
		$r_con = mysqli_num_rows($r_res);
	
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

						<li class="active-bre"><a href="#"> Dashboard</a> </li>

						<li class="page-back"><a href="#"><i class="fa fa-backward" aria-hidden="true"></i> Back</a> </li>

					</ul>

				</div>

				<div class="tz-2 tz-2-admin">

					<div class="tz-2-com tz-2-main">

						<h4>All Listing Details</h4>

						<div class="tz-2-main-com bot-sp-20">

							<div class="tz-2-main-1 tz-2-main-admin">

								<div class="tz-2-main-2"> <img src="../images/icon/d1.png" alt=""><span>All Listings</span>

									<p>All the Lorem Ipsum generators on the</p>

									<h2><?php echo $l_con; ?></h2> </div>

							</div>

							<div class="tz-2-main-1 tz-2-main-admin">

								<div class="tz-2-main-2"> <img src="../images/icon/d4.png" alt=""><span>Users</span>

									<p>All the Lorem Ipsum generators on the</p>

									<h2><?php echo $u_con; ?></h2> </div>

							</div>

							<div class="tz-2-main-1 tz-2-main-admin">

								<div class="tz-2-main-2"> <img src="../images/icon/d3.png" alt=""><span>Top Ads</span>

									<p>All the Lorem Ipsum generators on the</p>

									<h2><?php echo $t_con; ?></h2> </div>

							</div>

							<div class="tz-2-main-1 tz-2-main-admin">

								<div class="tz-2-main-2"> <img src="../images/icon/d2.png" alt=""><span>Reviews</span>

									<p>All the Lorem Ipsum generators on the</p>

									<h2><?php echo $r_con; ?></h2> </div>

							</div>

						</div> 

					<div id="wrap">

						<div class="split-row">

							<div class="col-md-12">

								<div class="box-inn-sp">
									<div id="get_result">
										
									</div>


								</div>
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

			$.ajax ({

				url:"ajax/all-listing.php",
				method:"GET",
				success: function(result){
					$("#get_result").html(result);
				}

		});

		});

		function myActive(id)
		{
			var send = 'active';
			$.ajax({
					url: "ajax/all-listing.php",
					method: "POST",
					data: {id:id, send:send},
					success: function(result){
						$("#get_result").html(result);
					}
			});

		}

		</script>





	<script src="../js/custom.js"></script>

</body>







</html>