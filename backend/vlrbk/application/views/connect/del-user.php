<?php 

	include("../dbconnect.php");



	$id = $_POST['id'];



	$sql = "DELETE FROM users WHERE u_id = '$id'";

	$res = mysqli_query($conn,$sql);

	if($res == true)

	{

		header("Location: all-users.php");

	}

?>