<?php
#all-users.php
?>
<div class="tz-2 tz-2-admin">

	<div class="tz-2-com tz-2-main">

		<h4>Users Details Search By</h4>
		<div id="wrap">
			<div class="split-row">
				<div class="col-md-12">
					<div class="box-inn-sp ad-inn-page">
						<div class="tab-inn ad-tab-inn">
							<div class="hom-cre-acc-left hom-cre-acc-right">
								<!-- Nav tabs -->
								<ul class="nav nav-pills nav-justified" role="tablist">
									<li role="presentation" class="active"><a href="#home" aria-controls="home"
											role="tab" data-toggle="tab">Date Range</a></li>
									<li role="presentation"><a href="#profile" aria-controls="profile" role="tab"
											data-toggle="tab">Name</a></li>
									<li role="presentation"><a href="#messages" aria-controls="messages" role="tab"
											data-toggle="tab">Email ID</a></li>
									<li role="presentation"><a href="#service" aria-controls="service" role="tab"
											data-toggle="tab">Mobile No</a></li>
								</ul>

								<!-- Tab panes -->
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="home">
										<div class="">
											<form method="post" action="" name="searchUserForm1" class="">
												<input type="hidden" name="do" value="doRange" />
												<div class="row">
													<div class="input-field col s6">
														<input id="fromDate" name="fromDate" type="date"
															class="validate" required autocomplete="off">
													</div>
													<div class="input-field col s6">
														<input id="toDate" name="toDate" type="date" class="validate"
															required autocomplete="off">
													</div>
												</div>
												<div class="row">
													<div class="input-field col s12"> <button type="submit"
															class="waves-effect waves-light btn-large full-btn"
															href="#!">Search User</button> </div>
												</div>
											</form>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane" id="profile">
										<div class="">
											<form method="post" action="" name="searchUserForm2" class="">
												<input type="hidden" name="do" value="doName" />
												<div class="row">
													<div class="input-field col s12">
														<input id="fullName" name="fullName" type="text"
															class="validate" required autocomplete="off">
														<label for="first_name">Full Name</label>
													</div>
												</div>
												<div class="row">
													<div class="input-field col s12"> <button type="submit"
															class="waves-effect waves-light btn-large full-btn"
															href="#!">Search User</button> </div>
												</div>
											</form>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane" id="messages">
										<div class="">
											<form method="post" action="" name="searchUserForm3" class="">
												<input type="hidden" name="do" value="doEmail" />
												<div class="row">
													<div class="input-field col s12">
														<input id="email" name="email" type="email" class="validate"
															required autocomplete="off">
														<label for="email">Email Address</label>
													</div>
												</div>
												<div class="row">
													<div class="input-field col s12"> <button type="submit"
															class="waves-effect waves-light btn-large full-btn"
															href="#!">Search User</button> </div>
												</div>
											</form>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane" id="service">
										<div class="">
											<form method="post" action="" name="searchUserForm4" class="">
												<input type="hidden" name="do" value="doMobile" />
												<div class="row">
													<div class="input-field col s12">
														<input id="mobile" name="mobile" type="number" class="validate"
															autocomplete="off" required>
														<label for="mobile">Mobile No</label>
													</div>
												</div>
												<div class="row">
													<div class="input-field col s12"> <button type="submit"
															class="waves-effect waves-light btn-large full-btn"
															href="#!">Search User</button> </div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<div class="row" style="margin-bottom:20px;">&nbsp;</div>
<div class="tz-2 tz-2-admin">

	<div class="tz-2-com tz-2-main">

		<h4>All Users Details</h4>
		<?php
		if (isset($_POST['do']) && $_POST['do'] == 'doRange') {
			$lsql = "SELECT * FROM `users` WHERE `u_type` = 'listing' AND `u_date` BETWEEN '" . $_POST['fromDate'] . "' AND '" . $_POST['toDate'] . "' ORDER BY `u_date` ASC";
		} elseif (isset($_POST['do']) && $_POST['do'] == 'doName') {
			$lsql = "SELECT * FROM `users` WHERE `u_type` = 'listing' AND `u_fullname` LIKE '%$_POST[fullName]%' ORDER BY `u_date` ASC";
		} elseif (isset($_POST['do']) && $_POST['do'] == 'doEmail') {
			$lsql = "SELECT * FROM `users` WHERE `u_type` = 'listing' AND `u_email` = '" . $_POST['email'] . "' ORDER BY `u_date` ASC";
		} elseif (isset($_POST['do']) && $_POST['do'] == 'doMobile') {
			$lsql = "SELECT * FROM `users` WHERE `u_type` = 'listing' AND `u_mobile` = '" . $_POST['mobile'] . "' ";
		} else {
			$lsql = "SELECT * FROM `users` WHERE `u_type` = 'listing' ORDER BY `u_id` DESC LIMIT 100";
		}
		$lres = $this->db->query($lsql)->result_array();
		?>
		<div style="margin-top:10px;">
			<?php echo $this->session->flashdata("user_listed"); ?>
		</div>
		<div id="wrap">
			<div class="split-row">

				<div class="col-md-12">

					<div class="box-inn-sp">

						<div class="tab-inn">

							<div class="table-responsive table-desi">

								<table class="datatable table table-hover">

									<thead>

										<tr>

											<th width="5%">S.No</th>
											<th width="15%">Date</th>
											<th width="5%">Photo</th>
											<th width="15%">Name/ Mobile No/ Email</th>
											<th width="8%">Listings</th>
											<th width="8%">Enquiry</th>
											<th width="8%">Reviews</th>
											<th width="15%">Action</th>

										</tr>

									</thead>

									<tbody>
										<?php $x = 0;
										$i = 1;
										foreach ($lres as $lrow) {
											?>
											<tr>
												<td style="vertical-align:middle;"> <?php echo $i; ?> </td>
												<td style="vertical-align:middle;">
													<?php echo date("d M Y", strtotime($lrow['u_date'])); ?>
												</td>
												<td style="vertical-align:middle;">
													<?php if ($lrow['u_img'] != "") { ?>
														<span><img
																src="<?php echo base_url() ?>assets/uploads/<?php echo $lrow['u_img']; ?>"
																alt="<?php echo $lrow['u_fullname']; ?>"
																style="border-radius: 50px;width:50px;height:50px;"></span>
													<?php } else { ?>
														<span><img src="<?php echo base_url() ?>assets/uploads/default.png"
																alt="<?php echo $lrow['u_fullname']; ?>"
																style="border-radius: 50px;width:50px;height:50px;"></span>
													<?php } ?>
												</td>
												<td style="vertical-align:middle;">
													<a href="#"><span
															class="list-enq-name"><?php echo $lrow['u_fullname']; ?></span></a>
													+91 <?php echo $lrow['u_mobile']; ?><br>
													<?php echo $lrow['u_email']; ?>
												</td>
												<td align="center" style="vertical-align:middle;">
													<a
														href="<?php echo base_url() ?>connect/all_user_listing/<?php echo $lrow['u_id'] ?>"><span
															class="label label-primary">
															<?php
															$uid = $lrow['u_id'];
															$sqls = "SELECT * FROM `listing` WHERE `l_userid` = '$uid'";
															$ress = $this->db->query($sqls);
															$coun = $ress->num_rows();
															echo $coun;
															?>
														</span></a>
												</td>
												<td align="center" style="vertical-align:middle;">
													<span class="label label-danger">
														<?php
														$sqlQ = "SELECT * FROM `quick_service` WHERE `email` = '" . $lrow['u_email'] . "'";
														$resQ = $this->db->query($sqlQ);
														$countService = $resQ->num_rows();
														echo $countService;
														?>
													</span>
												</td>
												<td align="center" style="vertical-align:middle;">
													<a
														href="<?php echo base_url() ?>connect/all_user_review/<?php echo $lrow['u_id'] ?>">
														<span class="label label-success">
															<?php
															$sqlR = "SELECT * FROM `reviews` WHERE `r_userid` = '$uid'";
															$resR = $this->db->query($sqlR);
															$countReviews = $resR->num_rows();
															echo $countReviews;
															?>
														</span></a>
												</td>
												<td style="vertical-align:middle;">
													<span class="list-enq-name"><a
															href="<?php echo base_url() ?>connect/edit_user/<?php echo $lrow['u_id']; ?>"
															title="Edit"
															onclick="return confirm('Are you sure want to continue?');"><i
																class="fa fa-pencil"
																style="background-color: #263a78;"></i></a>
														<?php if ($lrow['u_email'] == $_SESSION['email']) {
														} else { ?>
															<a href="#" data-toggle="modal"
																data-target="#del-list<?php echo $x; ?>" title="Delete"><i
																	class="fa fa-trash"
																	style="background-color: #ef0b0b;"></i></a>
														<?php } ?>
													</span>
												</td>

											</tr>
											<div class="modal fade dir-pop-com " id="del-list<?php echo $x; ?>"
												role="dialog">
												<div class="modal-dialog"
													style="position: absolute; top: 40%; left: 50%; transform: translate(-50%, -30%);">
													<div class="modal-content">
														<div class="modal-header dir-pop-head">
															<button type="button" class="close" data-dismiss="modal"
																style="padding: 10px 15px; background: #ededed;">×</button>
															<h3 class="modal-title" style="color:#fff;"> Are You Sure Want
																to Delete User?</h3>
														</div>
														<div class="modal-body dir-pop-body">

															<form
																action="<?php echo base_url() ?>connect/action_user/<?php echo $lrow['u_id']; ?>/delete"
																method="post" class="form-horizontal">
																<!--LISTING INFORMATION-->

																<input type="hidden" name="id"
																	value="<?php echo $lrow['u_id']; ?>">
																<!--LISTING INFORMATION-->
																<div class="form-group has-feedback ak-field">
																	<div class="col-md-6 col-md-offset-4">
																		<input type="submit" value="Yes" class="pop-btn">
																		<input type="button" value="No" class="pop-btn"
																			data-dismiss="modal">
																	</div>
																</div>
															</form>
														</div>
													</div>
												</div>
											</div>

											<?php $x++;
											$i++;
										} ?>
									</tbody>

								</table>
							</div>
						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>

<!--SCRIPT FILES-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$.noConflict();
		$('.datatable').dataTable({
			"sPaginationType": "bs_normal"
		});
		$('.datatable').each(function () {
			var datatable = $(this);
			// SEARCH - Add the placeholder for Search and Turn this into in-line form control
			var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
			search_input.attr('placeholder', 'Search');
			search_input.addClass('form-control input-sm');
			// LENGTH - Inline-Form control
			var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
			length_sel.addClass('form-control input-sm');
		});
	});
</script>