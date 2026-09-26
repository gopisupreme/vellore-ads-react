<?php
#blog-content.php
foreach($company as $companyRow) { }
// $listingId = $this->input->get('id');
$headRow = $this->db->query("SELECT * FROM `blog` WHERE `b_id` = '".$listingId."'")->row_array();
$cateBlog = $this->db->query("SELECT * FROM `category` WHERE `c_id` = '".$headRow['b_cate']."'")->row_array();
 $pageTitle = $headRow['b_title'];
 
?>
<style>
    .page-blog{
        overflow:hidden;
    }
    
    
@media (max-width: 500px) {
    .inn-pag-ban1 {
        font-size: 2.5vh !important;
    }
    
}

    
@media (max-width: 500px) {
    
    .inn-pag-ban2{
        font-size: 10px !important;
    }
}
   
    
    
</style>
<script type="application/ld+json">
{
    "@context": "http://schema.org/",
    "@type": "Blog",
    "url": "<?php echo base_url() ?>blog/<?php echo $title; ?>/<?php echo $headRow['b_id']; ?>",
    "name": "<?php echo $headRow['b_title']; ?>",
    "image": "<?php echo base_url() ?>assets/images/services/<?php echo $headRow['b_image']; ?>",
	"description": "<?php echo  html_entity_decode($headRow['b_message']); ?>",
	
    
                
	"aggregateRating": {
        "@type": "AggregateRating",
        "@type": "AggregateRating",
"ratingValue": "5",
"bestRating": "5",
"ratingCount": "44"
    }
		
}
/*--------------*/



</script>
	<!--TOP SEARCH SECTION-->
	<section class="bottomMenu dir-il-top-fix">
		<?php $this->load->view('templates/header-index.php'); ?>		
	</section>
	<section class="inn-page-bg">
		<div class="container">
			<div class="row">
				<div class="inn-pag-ban">
					<h2 class="inn-pag-ban1"><?php echo $headRow['b_title']; ?></h2>
					<h5 class="inn-pag-ban2">Grow your business by getting relevant and verified leads</h5> </div>
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
						<h3><?php echo $headRow['b_title']; ?></h3>  <span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp <?php echo date("M d, Y",strtotime( $headRow['b_date'])); ?> &nbsp&nbsp&nbsp<i class="fa fa-tag"> </i> <?php echo $cateBlog['c_name']; ?></span>
						<p><?php echo  html_entity_decode($headRow['b_message']); ?></p>
					</div>
				</div>
			</div>
		</div>
	</section>