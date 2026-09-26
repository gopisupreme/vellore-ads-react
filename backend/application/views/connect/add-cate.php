<?php 
	include("../dbconnect.php");

	$category = $_POST['category'];
	$uid = $_POST['uid'];
	$cdate = $_POST['cdate'];

	$query = mysqli_query($conn, "INSERT INTO `category`(`c_name`, `c_userid`, `c_adddate`, `c_status`) VALUES ('$category', '$uid', '$cdate', 'active')");
	if($query == true){
		header("Location: all-category.php?err=success");
	}
	else{
		header("Location: all-category.php?err=failed");
	}

?>