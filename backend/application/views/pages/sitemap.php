<?php
#sitemap.php
foreach($company as $companyRow) { }
?>
	<section class="bottomMenu dir-il-top-fix">
		<?php $this->load->view('templates/header-index.php'); ?>
	</section>
	<section>
		<div class="con-page">
			<div class="con-page-ri">
				<div class="col s12">
				<script async src="https://cse.google.com/cse.js?cx=002448487294081478173:vstwp2nl9mi">
</script>
<div class="gcse-search"></div>
				</div>
				<div class="con-com">
					<h4 class="con-tit-top-o">Sitemap</h4>
				</div>	
				<h4 style="text-align: center;">Category</h4>
				<br>
				<div class="row">
					<?php
					$sql = $this->db->query("SELECT * FROM category ORDER BY `c_name` asc");
					$res = $sql->result_array();
					foreach($res as $row) {
						if($row['c_name'] != "") {
					?>
						<div class="col-md-4">
							<ul>							
								<li><a href="<?php echo base_url(); ?><?php echo $companyRow->city; ?>/<?php echo str_replace("-"," ",$row['c_name']); ?>"><?php $cname =  $row['c_name'];  echo $cname;?></a>
								<?php $csql = $this->db->query("SELECT * FROM `listing` WHERE `l_category` LIKE '%$cname%' AND `l_city` = '".$companyRow->city."' AND `l_status` = 'active'");
									  $cont = $csql->num_rows();
								 ?>
								(<?php echo $cont; ?>)</li>	
							</ul>
						</div>
					<?php } 
					}
					?>
				</div>						
			</div>		
	</section>