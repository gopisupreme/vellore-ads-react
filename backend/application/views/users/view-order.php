<?php 
	#edit-major_district.php
	$lrow = $this->db->query("SELECT * FROM `rb_order_master_data` WHERE `order_id` = '".$listingId."'")->row_array();
?>
<section class="bottomMenu dir-il-top-fix">

		<?php $this->load->view('templates/header-index.php'); ?>

	</section>

	<!--DASHBOARD-->

	<section>

		<div class="tz">

			<!--LEFT SECTION-->

		<?php $this->load->view('templates/sidemenu.php'); ?>

			<!--CENTER SECTION-->

			<div class="tz-2">
			
				<div class="tz-2-com tz-2-main">
					<h4>Invoice</h4>
					<div class="db-list-com tz-db-table">
						<div class="ds-boar-title">
							<!--<h2>Amazon Directory </h2>-->
							<!--<p>All the Lorem Ipsum generators on the All the Lorem Ipsum generators on the</p>-->
						</div>
						<div class="invoice">
							<div class="invoice-1">
								<div class="invoice-1-logo">
									<img src="images/invoice-logo.png" alt=""><span>invoice</span>
								</div>
								<div class="invoice-1-add">
									<div class="invoice-1-add-left">
										<h3><?php echo $lrow['fname']; ?> <?php echo $lrow['lname']; ?></h3>
									     <br>
										<h5>Billing Address</h5><br>
										<p><?php echo $lrow['address']; ?> <?php echo $lrow['state']; ?> <?php echo $lrow['pincode']; ?></p>
										<br>
										<h5>Shipping Address</h5><br>
										<p><?php echo $lrow['saddress']; ?> <?php echo $lrow['sstate']; ?> <?php echo $lrow['spincode']; ?></p>
									</div>
									<div class="invoice-1-add-right">
										<ul>
											<li><span>Invoice Number</span> <?php echo $lrow['order_id']; ?></li>
											<li><span>Date</span> <?php echo $lrow['created_dt']; ?></li>
											<li><span>Payment Method</span> <?php echo $lrow['payment_opt']; ?> </li>
											
										</ul>
									</div>
								</div>
								<div class="invoice-1-tab">
									<table class="responsive-table bordered">
										<thead>
											<tr>
												<th>Description</th>
												<th>Price</th>
												<th>Quantity</th>
												<th>Subtotal</th>
											</tr>
										</thead>
											<?php 
												$lsql = "SELECT * FROM `rb_order_details` where order_id='".$listingId."'" ; 
				                                $lres = $this->db->query($lsql)->result_array();
				                                
												?>
										<tbody>
										    <?php 
												$x=0;
										      	$i =1;
										      	foreach($lres as $prow) {
												?>
											<tr>
												<td><?php echo $prow['product_name']; ?></td>
												<td><?php echo $prow['product_price']; ?></td>
												<td><?php echo $prow['product_quantity']; ?></td>
												<?php $total=$prow['product_quantity']*$prow['product_price'];?>
											
												<td class="invo-sub"><?php echo $total; ?></td>									
											</tr>
											<?php $x++; $i++; } ?>
																						
										</tbody>
									</table>								
								</div>
							</div>
							
							<div class="invoice-2">
								<div class="invoice-price text-right">
								    <h2>Total : <?php echo $lrow['total']; ?></h2>
								    
								    
															
								</div>							
							</div>
							<div class="invoice-print">
							<p>Thank you,<br>
							<!--It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.-->
							
							</p> <a href="db-payment.html" class="waves-effect waves-light btn-large">Pay Invoice</a><a href="db-invoice-download.html" target="_blank" class="waves-effect waves-light btn-large">Print</a> <a href="db-invoice-download.html" target="_blank" class="waves-effect waves-light btn-large">Download PDF</a> </div>
						</div>
					</div>
				</div>
			</div>
			</div>
		</section>