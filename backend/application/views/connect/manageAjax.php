<?php
#manageAjax.php
include("../dbconnect.php");
session_start();
 if(isset($_POST['action']) && $_POST['action'] == "subCategory") {
	 #$_SESSION['cateVal'] = $_POST['value'];
	 echo $num = $_POST['value'];
	 //header("Location:add-list.php?cateVal=$num");
 }
?>
<?php
 /*if(isset($_POST['action']) && $_POST['action'] == "subCategory") {
	 $num = $_POST['value'];
	 $listCate = mysqli_query($conn, "SELECT * FROM `category` WHERE `c_name` = '".$num."'");
	 $listCateRow = mysqli_fetch_array($listCate);
	#echo "SELECT * FROM `sub_category` WHERE `c_id` = '".$listCateRow['c_id']."' AND `status` = '1'";
	$listSub = mysqli_query($conn, "SELECT * FROM `sub_category` WHERE `c_id` = '".$listCateRow['c_id']."' AND `status` = '1'");
	 while($listSubRow = mysqli_fetch_array($listSub)) {
		echo "<option value='$listSubRow[name]'>$listSubRow[name]</option>";
	 }
 }*/
?>
