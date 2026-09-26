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

				<a href="<?php echo base_url(); ?>users/dashboard" ><img src="<?php echo base_url(); ?>assets/images/icon/dbl1.png" alt="<?php echo $companyRow['cName']; ?> - My Dashboard" /> My Dashboard</a>

			</li>

			<li>

				<a href="<?php echo base_url(); ?>users/db_all_listing"><img src="<?php echo base_url(); ?>assets/images/icon/dbl2.png" alt="<?php echo $companyRow['cName']; ?> - All Listing" /> All Listing</a>

			</li>
			<li>

				<a href="<?php echo base_url(); ?>users/all_product" ><img src="<?php echo base_url(); ?>assets/images/icon/dbl1.png" alt="<?php echo $companyRow['cName']; ?> - Shopping" /> My Shop</a>

			</li>

			<li>

				<a href="<?php echo base_url(); ?>users/db_listing_add"><img src="<?php echo base_url(); ?>assets/images/icon/dbl3.png" alt="<?php echo $companyRow['cName']; ?> - Add New Listing" /> Add New Listing</a>

			</li>

			<!--<li>

				<a href="#" data-toggle="modal" data-target="#add-cate"><img src="<?php echo base_url(); ?>assets/images/icon/dbl7.png" alt="<?php echo $companyRow['cName']; ?> - Add New Category" /> Add New Category</a>

			</li>-->

			<li>

				<a href="<?php echo base_url(); ?>users/db_review"><img src="<?php echo base_url(); ?>assets/images/icon/dbl13.png" alt="<?php echo $companyRow['cName']; ?> - Reviews" /> Reviews(<?php echo 0; ?>)</a>

			</li>
			
			<li>

				<a href="<?php echo base_url(); ?>users/db_jobs"><img src="<?php echo base_url(); ?>assets/images/icon/dbl13.png" alt="<?php echo $companyRow['cName']; ?> - Applied Jobs" /> Applied Jobs</a>

			</li>

			<li>

				<a href="<?php echo base_url(); ?>users/profile"><img src="<?php echo base_url(); ?>assets/images/icon/dbl6.png" alt="<?php echo $companyRow['cName']; ?> - My Profile" /> My Profile</a>

			</li>
			
			<li>

				<a href="<?php echo base_url(); ?>users/db_all_post"><img src="<?php echo base_url(); ?>assets/images/icon/dbl2.png" alt="<?php echo $companyRow['cName']; ?> - All Listing" /> All Post Ads</a>

			</li>

			<li>

				<a href="<?php echo base_url(); ?>users/db_post_add"><img src="<?php echo base_url(); ?>assets/images/icon/dbl3.png" alt="<?php echo $companyRow['cName']; ?> - Add New Listing" /> Add New Post</a>

			</li>

			<li>

				<a href="<?php echo base_url(); ?>users/db_post_review"><img src="<?php echo base_url(); ?>assets/images/icon/dbl13.png" alt="<?php echo $companyRow['cName']; ?> - Reviews" /> Reviews(<?php echo 0; ?>)</a>

			</li>
			
			<li>

				<a href="<?php echo base_url(); ?>users/db_all_matrimony"><img src="<?php echo base_url(); ?>assets/images/icon/dbl2.png" alt="<?php echo $companyRow['cName']; ?> - All Matrimony Listing" /> All Matrimony Listing</a>

			</li>

			<li>

				<a href="<?php echo base_url(); ?>users/db_matrimony_add"><img src="<?php echo base_url(); ?>assets/images/icon/dbl3.png" alt="<?php echo $companyRow['cName']; ?> - Add Matrimony Listing" /> Add Matrimony Listing</a>

			</li>

			<li>

				<a href="<?php echo base_url(); ?>users/db_matrimony_review"><img src="<?php echo base_url(); ?>assets/images/icon/dbl13.png" alt="<?php echo $companyRow['cName']; ?> - Matrimony Reviews" /> Matrimony Reviews(<?php echo 0; ?>)</a>

			</li>
			
			<li>

				<a href="<?php echo base_url(); ?>users/db_all_spa"><img src="<?php echo base_url(); ?>assets/images/icon/dbl2.png" alt="<?php echo $companyRow['cName']; ?> - All Spa Listing" /> All Spa Listing</a>

			</li>

			<li>

				<a href="<?php echo base_url(); ?>users/db_spa_add"><img src="<?php echo base_url(); ?>assets/images/icon/dbl3.png" alt="<?php echo $companyRow['cName']; ?> - Add Spa Listing" /> Add Spa Listing</a>

			</li>

			<li>

				<a href="<?php echo base_url(); ?>users/db_spa_review"><img src="<?php echo base_url(); ?>assets/images/icon/dbl13.png" alt="<?php echo $companyRow['cName']; ?> - Spa Reviews" /> Spa Reviews(<?php echo 0; ?>)</a>

			</li>
			
			<li>

				<a href="<?php echo base_url() ?>users/claim_business"><img src="<?php echo base_url(); ?>assets/images/icon/dbl7.png" alt="<?php echo $companyRow['cName']; ?> - Claim Business" /> Claim Business</a>

			</li>
			
			<li>

				<a href="<?php echo base_url() ?>users/db_all_enquiry"><img src="<?php echo base_url(); ?>assets/images/icon/dbl7.png" alt="<?php echo $companyRow['cName']; ?> - Lead Management" /> Lead Management</a>

			</li>
			
			<li>

				<a href="http://worksuite.company/" target="_blank" ><img src="<?php echo base_url(); ?>assets/images/icon/dbl7.png" alt="<?php echo $companyRow['cName']; ?> - Free Business CRM" /> <span style="background:#ffe500;padding:5px;">Free Business CRM</span></a>

			</li>

			<li>

				<a href="#"><img src="<?php echo base_url(); ?>assets/images/icon/dbl9.png" alt="<?php echo $companyRow['cName']; ?> - Check Out" /> Check Out</a>

			</li>
			
			<li>

				<a href="#"><img src="<?php echo base_url(); ?>assets/images/icon/db21.png" alt="<?php echo $companyRow['cName']; ?> - Invoice" /> Invoice</a>

			</li>
			
			<li>

				<a href="#"><img src="<?php echo base_url(); ?>assets/images/icon/dbl7.png" alt="<?php echo $companyRow['cName']; ?> - Claim & Refund" /> Claim & Refund</a>

			</li>
			
			<li>

				<a href="#"><img src="<?php echo base_url(); ?>assets/images/icon/dbl7.png" alt="<?php echo $companyRow['cName']; ?> - Advertise" /> Advertise</a>

			</li>

			<li>

				<a href="<?php echo base_url(); ?>users/logout"><img src="<?php echo base_url(); ?>assets/images/icon/dbl12.png" alt="<?php echo $companyRow['cName']; ?> - Log Out" /> Log Out</a>

			</li>

		</ul>

	</div>

</div>