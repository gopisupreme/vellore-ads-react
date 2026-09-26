<?php
#sidemenu.php
$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
$companyRow = $company1->row_array();
$lid = $h_rows['u_id'];
$dsql = "SELECT * FROM `listing` WHERE `l_userid` = '$lid'";
$dres = $this->db->query($dsql);
$dcon = $dres->num_rows();
$lsql = "SELECT * FROM `reviews` WHERE `r_userid` = '$lid'";
$lres = $this->db->query($lsql);
$lcon = $lres->num_rows();
?>
<div class="tz-l">
    <div class="tz-l-1">
		<ul>
			<li><img src="<?php echo base_url(); ?>assets/uploads/<?php echo $h_rows['u_img']; ?>" alt="<?php echo $h_rows['u_fullname']; ?>" /> </li>
			<li><span><?php echo $h_rows['u_fullname']; ?></span> </li>
		</ul>
	</div>
	<div class="tz-l-2">
		<ul>
			<li>
				<a href="<?php echo base_url(); ?>customer/dashboard" ><img src="<?php echo base_url(); ?>assets/images/icon/dbl1.png" alt="<?php echo $companyRow['cName']; ?> - My Dashboard" /> My Dashboard</a>
			</li>
			<li>
				<a href="<?php echo base_url(); ?>customer/profile"><img src="<?php echo base_url(); ?>assets/images/icon/dbl6.png" alt="<?php echo $companyRow['cName']; ?> - My Profile" /> My Profile</a>
			</li>
			<li>
				<a href="<?php echo base_url(); ?>users/logout"><img src="<?php echo base_url(); ?>assets/images/icon/dbl12.png" alt="<?php echo $companyRow['cName']; ?> - Log Out" /> Log Out</a>
			</li>
		</ul>
	</div>
</div>