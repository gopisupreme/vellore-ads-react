
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
		
		if(isset($_POST['do']) && $_POST['do'] == "addRow"){

			$pname = $_POST['pname'];
			$pamount = $_POST['pamount'];
			
			if((strlen($pname) > 0) && (strlen($amount) > 0)) {
													
				$l_sql = "INSERT INTO `premium` SET `name` = '".ucfirst($pname)."', `amount` = '".$pamount."', `status` = '1'";

				$l_res = mysqli_query($conn,$l_sql);
				if($l_res == true)
				{
					header("Location:add-premium.php?success=1");
				}
				else
				{
					header("Location:add-premium.php?success=2");
				}
						
			} else { }
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

					<h4>Premium</h4>

					<div class="db-list-com tz-db-table">

						<div class="ds-boar-title">

							<h2>Add Premium</h2>

							<p>All the fields required</p>
							<?php if(isset($_GET['success']) && $_GET['success'] != "") {
									if($_GET['success'] == 1) {
										echo "<p class='text-success' style='text-align:center;'>Location Added Successfully!</p>";
									} elseif($_GET['success'] == 2) {
										echo "<p class='text-danger'>Failed! Please Try Again!</p>";
									} elseif($_GET['success'] == 3) {
										echo "<p class='text-danger'>Failed! Please Try Again with New Location!</p>";
									} 
							}
							?>
						</div>

						<div class="tz2-form-pay tz2-form-com">

							<form class="col s12" action="#" method="post" enctype="multipart/form-data">
								<input type="hidden" name="do" value="addRow"/>

								<div class="row">

									<div class="input-field col s12">

										<input type="text" required class="validate" name="pname" autocomplete="off" value="<?php if(isset($_POST['pname'])) { echo $_POST['pname']; } ?>">

										<label>Premium Name</label>

									</div>
									
								</div>
								
								<div class="row">

									<div class="input-field col s12">

										<input type="text" class="validate" name="pamount" autocomplete="off" value="<?php if(isset($_POST['amount'])) { echo $_POST['amount']; } ?>" required>

										<label>Premium Amount</label>

									</div>
									
								</div>																																			

								<div class="row">

									<div class="input-field col s12">
										<input type="submit" value="SUBMIT" class="waves-effect waves-light full-btn"> </div>

								</div>

							</form>

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