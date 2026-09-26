<?php
#new-business.php
foreach($company as $companyRow) { }
$cityS = $this->session->userdata('city');
$cityU = $companyRow->city;
$city = $cityS != "" ? $cityS : $cityU;
?>
	<section class="bottomMenu dir-il-top-fix">
		<?php $this->load->view('templates/header-index.php'); ?>
	</section>
	<section class="inn-page-bg">
		<div class="container">
			<div class="row">
				<div class="inn-pag-ban">
					<h2>Local Services</h2>
					<h5>Grow your business by getting relevant and verified leads</h5> </div>
			</div>
		</div>
	</section>
	<section class="com-padd com-padd-redu-bot">
		<div class="container dir-hom-pre-tit">
			<div class="row">
				<div class="com-title">
					<h2>Business Directories <span>in your City</span></h2>
					<p>Explore some of the best tips from around the world from our partners and friends.</p>
				</div>
				<div class="col-md-12">

					<div class="local_service">
					    
						<div class="loacl_service_block">
						   <h3>AC Dealers</h3>
						   <ul>
						      <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">AC Dealers</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Split & Window AC for Home</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Second Hand AC Dealers</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">HVAC System</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">AC Dealers</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Blue Star AC Dealers</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Kenstar AC Dealers</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Electrolux AC Dealers</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Lloyd AC Dealers</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Mitsubishi AC Dealers</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Samsung AC Dealers</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Sharp AC Dealers</a></li>
						   </ul>
						</div>
						
						<div class="loacl_service_block">
						   <h3>Health Services & Medicine</h3>
						   <ul>
						      <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">AIDS & HIV Centers</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Ambulance Services</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Blood, Organ & Tissue Banks</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Medical Supplies & Equipment Suppliers</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Hospitals & Medical Centers</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Lens & Optics Shops</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Hearing & Speech Clinics</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Skin Care & Treatment</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Marriage Counseling</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Nebulizer Suppliers</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Handicap Aids & Equipment Suppliers</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Psychological Counseling & Healing Services</a></li>
						   </ul>
						</div>
						
						<div class="loacl_service_block">
						   <h3>Company Secretarial Services</h3>
						    <ul>
						      <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Company Secretarial Services</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Agmark Registration</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Business Planning and Initiation Services</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Corporate Legal & Advisory Services</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">ESI PF Registration</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Registration and Verification Services</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Trademark Registration</a></li>
							  <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Company Secretarial Services</a></li>
							</ul>
						</div>
					   
					</div>

				</div>
			</div>
		</div>
	</section>