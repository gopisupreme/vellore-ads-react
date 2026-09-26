<?php
#events-content.php
foreach($company as $companyRow) { }
$listingId = $this->input->get('id');
$headRow = $this->db->query("SELECT * FROM `blog` WHERE `b_id` = '".$listingId."'")->row_array();
$cateBlog = $this->db->query("SELECT * FROM `category` WHERE `c_id` = '".$headRow['b_cate']."'")->row_array();
?>
	<!--TOP SEARCH SECTION-->
	<section class="bottomMenu dir-il-top-fix">
		<?php $this->load->view('templates/header-index.php'); ?>		
	</section>
	<section class="inn-page-bg">
		<div class="container">
			<div class="row">
				<div class="inn-pag-ban">
					<h2><?php echo $headRow['b_title']; ?> from <?php echo $cateBlog['c_name']; ?></h2>
					<h5>Grow your business by getting relevant and verified leads</h5> </div>
			</div>
		</div>
	</section>
	<section class="p-about com-padd">
		<div class="container">
			<div class="row blog-single con-com-mar-bot-o">
				<div class="col-md-4">
					<div class="blog-img"> <img src="<?php echo base_url() ?>assets/images/services/<?php echo $headRow['b_image']; ?>" alt="<?php echo $headRow['b_title']; ?>" /> </div>
				</div>
				<div class="col-md-8">
					<div class="page-blog">
						<h3><?php echo $headRow['b_title']; ?></h3> <span><?php echo date("M d, Y",strtotime( $headRow['b_date'])); ?></span>
						<p style="text-align:justify;"><?php echo $headRow['b_message']; ?></p>
						<a class="waves-effect waves-light btn-large full-btn" href="<?php echo base_url() ?>events">Back</a>
					</div>
				</div>
			</div>
		</div>
	</section>