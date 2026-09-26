<?php 
	#edit-product.php
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
				<div class="tz-2 tz-2-admin" style="min-height: 700px;">

					<div class="tz-2-com tz-2-main">

					<h4>Product</h4>

					<div class="db-list-com tz-db-table">

						<div class="ds-boar-title">

							<h2>Edit Product</h2>

							<p>All the fields required</p>
							<?php echo validation_errors() ?>
						</div>
						<?php
							$row = $this->db->query("SELECT * FROM `product` WHERE `p_id` = '".$editId."'");
							$fetch = $row->row_array();
						?>
						<div class="hom-cre-acc-left hom-cre-acc-right">

							<form class="" action="<?php echo base_url() ?>users/query_product/<?php echo $editId; ?>" method="post" enctype="multipart/form-data">
								<input type="hidden" name="do" value="updateC"/>
								<input type="hidden" name="uid" value="<?php echo $h_rows['u_id']; ?>">
								<input type="hidden" name="cdate" value="<?php echo date('Y-m-d'); ?>" >
								<input type="hidden" name="editId" value="<?php echo $editId; ?>"/>
								
								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Product Name</h5>
									</div>
								</div>
								<div class="row">

									<div class="input-field col s12">

										<input type="text" required class="validate" name="product" autocomplete="off" value="<?php echo $fetch['p_name']; ?>">

										<label>Product Name</label>

									</div>
									
								</div>

								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Product Group</h5>
									</div>
								</div>

								<div class="row">
									<div class="input-field col s12">
										<select name="group" id="group" required>
											<option value="" disabled selected>Select Groups</option>
											<?php $cate = $this->db->query("SELECT * FROM `groups` WHERE `g_status` = '1'")->result_array();
											foreach($cate as $cateRow) { 
												if($cateRow['g_title'] == $fetch['p_group']) {
											?>
												<option value="<?php echo $cateRow['g_title']; ?>" selected><?php echo $cateRow['g_title']; ?></option>
												<?php } else { ?>
												<option value="<?php echo $cateRow['g_title']; ?>"><?php echo $cateRow['g_title']; ?></option>
											<?php } } ?>
										</select>
									</div>									
								</div>

								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Product Category</h5>
									</div>
								</div>

								<div class="row">
									<div class="input-field col s12">
										<select name="category" id="category" required>
											<option value="" disabled selected>Select Category</option>
											<?php $cate = $this->db->query("SELECT * FROM `categories` WHERE `c_status` = '1'")->result_array();
											foreach($cate as $cateRow) { 
												if($cateRow['c_title'] == $fetch['p_category']) {
											?>
												<option value="<?php echo $cateRow['c_title']; ?>" selected><?php echo $cateRow['c_title']; ?></option>
												<?php } else { ?>
												<option value="<?php echo $cateRow['c_title']; ?>"><?php echo $cateRow['c_title']; ?></option>
											<?php } } ?>
										</select>
									</div>									
								</div>

								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Product Sub Category</h5>
									</div>
								</div>

								<div class="row">
									<div class="input-field col s12">
										<select name="subcategory" id="subcategory" required>
											<option value="" disabled selected>Select Sub Category</option>
											<?php $cate = $this->db->query("SELECT * FROM `sub_categories` WHERE `s_status` = '1'")->result_array();
											foreach($cate as $cateRow) { 
												if($cateRow['s_title'] == $fetch['p_subcategory']) {
											?>
												<option value="<?php echo $cateRow['s_title']; ?>" selected><?php echo $cateRow['s_title']; ?></option>
												<?php } else { ?>
												<option value="<?php echo $cateRow['s_title']; ?>"><?php echo $cateRow['s_title']; ?></option>
											<?php } } ?>
										</select>
									</div>									
								</div>

								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Product Size (Width)</h5>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<input type="number" required class="validate" name="size_width" autocomplete="off" value="<?php echo $fetch['p_size_width']; ?>">
										<label>Product Size (Width)</label>
									</div>
								</div>
								
								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Product Size (Height)</h5>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<input type="number" required class="validate" name="size_height" autocomplete="off" value="<?php echo $fetch['p_size_height']; ?>">
										<label>Product Size (Height)</label>
									</div>
								</div>

								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Product Weight</h5>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<input type="number" required pattern= "[0-9]" class="validate" name="weight" autocomplete="off" value="<?php echo $fetch['p_weight']; ?>">
										<label>Product Weight</label>
									</div>
								</div>

								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Product Brand</h5>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<!--<input type="text" required class="validate" name="brand" autocomplete="off" value="<?php //echo $fetch['p_brand']; ?>">-->
										<!--<label>Product Brand</label>-->
										
										
											<input type="text" list="brand" name="brand" required />
                                            <datalist id="brand">
                                              <option value="" disabled selected>Select Brand *</option>
        										<?php $cate = $this->db->query("SELECT * FROM `brand` WHERE `b_status` = '1'")->result_array();
											foreach($cate as $cateRow) { 
												if($cateRow['b_title'] == $fetch['p_brand']) {
											?>
												<option value="<?php echo $cateRow['b_title']; ?>" selected><?php echo $cateRow['b_title']; ?></option>
												<?php } else { ?>
												<option value="<?php echo $cateRow['b_title']; ?>"><?php echo $cateRow['b_title']; ?></option>
											<?php } } ?>
                                            </datalist>
									</div>
								</div>

								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Product Rate</h5>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<input type="number" required pattern= "[0-9]" class="validate" name="rate" autocomplete="off" value="<?php echo $fetch['p_rate']; ?>">
										<label>Product Rate</label>
									</div>
								</div>

								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Product Discount</h5>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<input type="number" required pattern= "[0-9]" class="validate" name="discount" autocomplete="off" value="<?php echo $fetch['p_discount']; ?>">
										<label>Product Discount</label>
									</div>
								</div>

								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Product Discount Expire Date</h5>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<input type="date" required class="validate" name="discount_exp" autocomplete="off" value="<?php echo $fetch['p_discount_exp']; ?>">
										<!-- <label>Product Discount Expire Date</label> -->
									</div>
								</div>

								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>No Of Discounts</h5>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<input type="number" required pattern= "[0-9]" class="validate" name="discount_count" autocomplete="off" value="<?php echo $fetch['p_discount_count']; ?>">
										<label>No.Of Discounts</label>
									</div>
								</div>

								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Select Waranty</h5>
									</div>
								</div>

								<div class="row">
									<div class="input-field col s12">
										<select name="waranty" id="waranty" required>
											<option value="" disabled selected>Select Status</option>
											<option value="1" <?php if($fetch['p_waranty'] == 1) { ?>selected<?php } ?>>Available</option>
											<option value="0" <?php if($fetch['p_waranty'] == 0) { ?>selected<?php } ?>>Not-Available</option>
										</select>
									</div>									
								</div>

								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Delivery Duration (Hours)</h5>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<input type="number" required pattern= "[0-9]" class="validate" name="delivery_duration" autocomplete="off" value="<?php echo $fetch['p_delivery_duration']; ?>">
										<label>Delivery Duration (Hours)</label>
									</div>
								</div>

								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Delivery Charge</h5>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<input type="number" required pattern= "[0-9]" class="validate" name="delivery_charge" autocomplete="off" value="<?php echo $fetch['p_delivery_charge']; ?>">
										<label>Delivery Charge</label>
									</div>
								</div>

								
								
								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Product Descriptions</h5>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<textarea id="desc" maxlength="1000" class="materialize-textarea" name="desc"><?php echo $fetch['p_description']; ?></textarea>
										<label for="textarea1" id="descErr">Product Descriptions</label>
									</div>
								</div>
								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Product FAQ Schema</h5>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">

										<textarea id="key" maxlength="750" class="materialize-textarea" name="faq"><?php echo $fetch['p_schema']; ?></textarea>

										<label for="textarea1" id="keyErr">Product FAQ Schema</label>

									</div>
								</div>

								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Product Refund Policy</h5>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">

										<textarea id="key" maxlength="750" class="materialize-textarea" name="refund_policy"><?php echo $fetch['p_refund_policy']; ?></textarea>

										<label for="textarea1" id="keyErr">Product Refund Policy</label>

									</div>
								</div>

								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Product Delivery Policy</h5>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">

										<textarea id="key" maxlength="750" class="materialize-textarea" name="delivery_policy"><?php echo $fetch['p_delivery_policy']; ?></textarea>

										<label for="textarea1" id="keyErr">Product Delivery Policy</label>

									</div>
								</div>

								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Product Warranty Policy</h5>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">

										<textarea id="key" maxlength="750" class="materialize-textarea" name="warranty_policy"><?php echo $fetch['p_warranty_policy']; ?></textarea>

										<label for="textarea1" id="keyErr">Product Warranty Policy</label>

									</div>
								</div>
								
								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Product Keywords</h5>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">

										<textarea id="key" maxlength="750" class="materialize-textarea" name="key"><?php echo $fetch['p_keywords']; ?></textarea>

										<label for="textarea1" id="keyErr">Product Keywords</label>

									</div>
								</div>

								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Select Replacement Status</h5>
									</div>
								</div>

								<div class="row">
									<div class="input-field col s12">
										<select name="replacement" id="replacement" required>
											<option value="" disabled selected>Select Status</option>
											<option value="1" <?php if($fetch['p_replacement'] == 1) { ?>selected<?php } ?>>Available</option>
											<option value="0" <?php if($fetch['p_replacement'] == 0) { ?>selected<?php } ?>>Not-Available</option>
										</select>
									</div>									
								</div>

								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Select Status</h5>
									</div>
								</div>

								<div class="row">
									<div class="input-field col s12">

										<select name="status" id="status" required>
											<option value="" disabled selected>Select Status</option>
											<option value="1" <?php if($fetch['p_status'] == 1) { ?>selected<?php } ?>>Available</option>
											<option value="0" <?php if($fetch['p_status'] == 0) { ?>selected<?php } ?>>Not-Available</option>
										</select>
									</div>									
								</div>
								
								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Cover Image Upload <span class="v2-db-form-note">(image size 1350x500):<span></h5>
									</div>
								</div>
								<div class="row tz-file-upload">
									<div class="file-field input-field">
										<div class="tz-up-btn"> <span>File</span>
											<input type="file" name="fileToUpload" id="fileToUpload"> </div>
										<div class="file-path-wrapper db-v2-pg-inp col s8">
											<input class="file-path validate" name="files" accept="image/*" type="text" placeholder="note: not more than 2MB" autocomplete="off">
										</div>
										<div class="col s2">
											<div style="margin-top:10px;">
												<?php if(isset($fetch['p_img']) && $fetch['p_img'] != "") { ?>
													<img src="<?php echo base_url(); ?>assets/images/list-deta/<?php echo $fetch['p_img']; ?>" alt="<?php echo $fetch['p_name']; ?>" width="150" height="75">
												<?php } else { ?>
													<img src="<?php echo base_url(); ?>assets/images/services/default.png" alt="Cover Image" width="150" height="75">
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Cover Image Upload 2 <span class="v2-db-form-note">(image size 728x90):<span></h5>
									</div>
								</div>
								<div class="row tz-file-upload">
									<div class="file-field input-field">
										<div class="tz-up-btn"> <span>File</span>
											<input type="file" name="coverImage" id="coverImage"> </div>
										<div class="file-path-wrapper db-v2-pg-inp col s8">
											<input class="file-path validate" name="coverFiles" type="text" placeholder="note: not more than 2MB" autocomplete="off">
										</div>
										<div class="col s2">
											<div style="margin-top:10px;">
												<?php if(isset($fetch['p_adsImage']) && $fetch['p_adsImage'] != "") { ?>
													<img src="<?php echo base_url(); ?>assets/advertise/<?php echo $fetch['p_adsImage']; ?>" alt="<?php echo $fetch['p_name']; ?>" width="150" height="75">
												<?php } else { ?>
													<img src="<?php echo base_url(); ?>assets/images/services/default.png" alt="Cover Image" width="150" height="75">
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Cover Image Upload 3 <span class="v2-db-form-note">(image size 300x250):<span></h5>
									</div>
								</div>
								<div class="row tz-file-upload">
									<div class="file-field input-field">
										<div class="tz-up-btn"> <span>File</span>
											<input type="file" name="wideImage" id="wideImage"> </div>
										<div class="file-path-wrapper db-v2-pg-inp col s8">
											<input class="file-path validate" name="wideFiles" type="text" placeholder="note: not more than 2MB" autocomplete="off">
										</div>
										<div class="col s2">
											<div style="margin-top:10px;">
												<?php if(isset($fetch['p_wideImage']) && $fetch['p_wideImage'] != "") { ?>
													<img src="<?php echo base_url(); ?>assets/advertise/<?php echo $fetch['p_wideImage']; ?>" alt="<?php echo $fetch['p_name']; ?>" width="150" height="75">
												<?php } else { ?>
													<img src="<?php echo base_url(); ?>assets/images/services/default.png" alt="Cover Image" width="150" height="75">
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
								
																													

								<div class="row">

									<div class="input-field col s12">
										<input type="submit" value="SUBMIT" class="waves-effect waves-light full-btn"> </div>

								</div>

							</form>

						</div>

						

					</div>

				</div>

				</div>
				</div>
				</div>