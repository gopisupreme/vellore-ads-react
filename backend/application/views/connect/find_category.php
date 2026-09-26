<?php
include("../dbconnect.php");
?>      
<?php
	 $num = $_GET['degree'];
	 $listCate = mysqli_query($conn, "SELECT * FROM `category` WHERE `c_name` = '".$num."'");
	 $listCateRow = mysqli_fetch_array($listCate);
	 #echo "SELECT * FROM `sub_category` WHERE `c_id` = '".$listCateRow['c_id']."' AND `status` = '1'";
	$listSub = mysqli_query($conn, "SELECT * FROM `sub_category` WHERE `c_id` = '".$listCateRow['c_id']."' AND `status` = '1'");
    while($listSubRow = mysqli_fetch_array($listSub)) {
            echo "<option value='$listSubRow[name]'>$listSubRow[name]</option>";
	}
	
?>