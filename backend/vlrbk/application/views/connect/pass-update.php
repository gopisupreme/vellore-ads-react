<?php 
	include("../dbconnect.php");

	$oldpass = $_POST['oldpass'];
$newpass = $_POST['newpass'];
$confpass = $_POST['confpass'];
$uid = $_POST['uid'];

$sql = "SELECT * FROM users WHERE u_id = '$uid'";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);
if($oldpass == $row['u_password'])
{
	if($newpass == $confpass)
	{
		$sql1 = "UPDATE users SET u_password = '$newpass' WHERE u_id = '$uid'";
		$res1 = mysqli_query($conn,$sql1);
		if($res1 == true)
		{
			header("Location: change-password.php?err=success");
		}
	}
	else
	{
		header("Location: change-password.php?err=miss");
	}
} 
else
{
	header("Location: change-password.php?err=old");
}
?>
