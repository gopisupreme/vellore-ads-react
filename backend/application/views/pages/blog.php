<?php
#blog.php
foreach($company as $companyRow) { }
?>
	<!--TOP SEARCH SECTION-->
	<section class="bottomMenu dir-il-top-fix">
		<?php $this->load->view('templates/header-index.php'); ?>		
	</section>
	<section class="inn-page-bg">
		<div class="container">
			<div class="row">
				<div class="inn-pag-ban">
					<h2>Vellore Blog</h2>
					<!--<h5>Grow your business by getting relevant and verified leads</h5>-->
					<h5>Stories and solutions for the modern entrepreneur</h5>
					
					</div>
			</div>
		</div>
	</section>
	<section class="p-about com-padd">
		<div class="container">
			<?php
			$headLines = $this->db->query("SELECT * FROM `blog` WHERE `b_status` = '1' ORDER BY `b_id` DESC LIMIT 25");
			$countLines = $headLines->num_rows();
			
			if($countLines != 0) {
				$headLines2 = $headLines->result_array();
				foreach($headLines2 as $headRow) {
				     $title = str_replace(' ', '-', $headRow['b_title']);
					$cateBlog = $this->db->query("SELECT * FROM `category` WHERE `c_id` = '".$headRow['b_cate']."'")->row_array();
					
					if (strlen($headRow['b_message']) > 300) {
						$stringCut = substr($headRow['b_message'], 0, 300);
						$stringReview = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
					}else{
						$stringReview = $headRow['b_message'];
					}
					
					
			?>
			<div class="row blog-single">
				<div class="col-md-4">
					<div class="blog-img"> <img src="<?php echo base_url() ?>assets/images/services/<?php echo $headRow['b_image']; ?>" alt="<?php echo $headRow['b_title']; ?>" /> </div>
				</div>
				<div class="col-md-8">
					<div class="page-blog">
					    
						<h3><?php echo $headRow['b_title']; ?></h3> <span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp <?php echo date("M d, Y",strtotime( $headRow['b_date'])); ?> &nbsp&nbsp&nbsp<i class="fa fa-tag"> </i> <?php echo $cateBlog['c_name']; ?></span>
						<p><?php echo  html_entity_decode($stringReview); ?></p>
							<a class="waves-effect waves-light btn-large full-btn" href="<?php echo base_url() ?>blog/<?php echo $title; ?>/<?php echo $headRow['b_id']; ?>" title="<?php echo $headRow['b_title']; ?>">Read More</a> </div>
				</div>
			</div>
			<?php }
			}
			?>
		</div>
	</section>