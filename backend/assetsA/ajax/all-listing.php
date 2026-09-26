<?php 
						include("../../dbconnect.php");

						if(isset($_POST['send']))
						{
							$id = $_POST['id'];
							$asql = mysqli_query($conn,"UPDATE listing SET l_status ='active' WHERE l_id ='$id' ");
						}

						$lsql = "SELECT * FROM listing";
						$lres = mysqli_query($conn,$lsql);

					 ?>

				

										<!--<div class="inn-title">

										<h4>All Listing Details</h4>

										<p>Airtport Hotels The Right Way To Start A Short Break Holiday</p> 

									
					<a class="dropdown-button drop-down-meta" href="#" data-activates="dr-list"><i class="material-icons">more_vert</i></a>	
										<ul id="dr-list" class="dropdown-content">

											<li><a href="#!">Add New</a> </li>

											<li><a href="#!">Edit</a> </li>

											<li><a href="#!">Update</a> </li>

											<li class="divider"></li>

											<li><a href="#!"><i class="material-icons">delete</i>Delete</a> </li>

											<li><a href="#!"><i class="material-icons">subject</i>View All</a> </li>

											<li><a href="#!"><i class="material-icons">play_for_work</i>Download</a> </li>

										</ul> -->

										<!-- Dropdown Structure 

									</div>-->

									<div class="tab-inn">

										<div class="table-responsive table-desi">


											<table class="datatable table table-hover">

												<thead>

													<tr>

														

														<th>Title</th>

														<th>Phone</th>

														<th>Listing Type</th>

														<th>Status</th>
														<th>Action</th>

													</tr>

												</thead>

												<tbody>
												<?php $x=0; while($lrow = mysqli_fetch_assoc($lres)){ ?>
													<tr>

													

														<td><a href="#"><span class="list-enq-name"><?php echo $lrow['l_title']; ?></span><span class="list-enq-city"><?php echo $lrow['l_category']; ?></span></a> </td>

														<td>+91 <?php $phone = explode(",", $lrow['l_phone']); echo $phone[0]; ?></td>

														

													
														<td> 
														<?php if($lrow['l_type'] == 'gold'){ ?>
														<a href="#" data-toggle="modal" data-target="#list-type<?php echo $x;?>" class="label label-info">Premium</a>
														<?php } elseif($lrow['l_type'] == 'free'){ ?>
														<a href="#" data-toggle="modal" data-target="#list-type<?php echo $x;?>" class="label label-danger">Free</a>
														<?php } ?>

														</td>

														<td> 
															<?php if($lrow['l_status'] == 'active'){ ?>
														<a href="list-inactive.php?id=<?php echo $lrow['l_id']; ?>" onclick="" class="btn btn-success">Active</a>
														<?php } else {?>
														<button onclick="myActive('<?php echo $lrow['l_id']; ?>')" class="btn btn-primary">pending</button>
														<?php } ?>
														 </td>
														 <td width="100"><span class="list-enq-name"><a href="edit-list.php?id=<?php echo $lrow['l_id']; ?>" title="Edit"><i class="fa fa-pencil" style="background-color: #263a78;"></i></a> <a href="#" data-toggle="modal" data-target="#del-list<?php echo $x; ?>" title="Delete"><i class="fa fa-trash" style="background-color: #ef0b0b;"></i></a></span></td>

													</tr>
			<div class="modal fade dir-pop-com " id="del-list<?php echo $x; ?>" role="dialog" >
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header dir-pop-head">
						<button type="button" class="close" data-dismiss="modal">×</button>
						<h3 class="modal-title" style="color:#fff;"> Are You Sure Want to Delete <?php echo $lrow['l_title']; ?> ?</h3>
						<!--<i class="fa fa-pencil dir-pop-head-icon" aria-hidden="true"></i>-->
					</div>
					<div class="modal-body dir-pop-body">
								
						<form action="del-list.php" method="post" class="form-horizontal">
							<!--LISTING INFORMATION-->

							<input type="hidden" name="id" value="<?php echo $lrow['l_id']; ?>">
							<!--LISTING INFORMATION-->
							<div class="form-group has-feedback ak-field">
								<div class="col-md-6 col-md-offset-4">
									<input type="submit" value="Yes" class="pop-btn"> <input type="button" value="No" class="pop-btn" data-dismiss="modal">  </div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>										
		<div class="modal fade dir-pop-com in" id="list-type<?php echo $x; ?>" role="dialog" >
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header dir-pop-head">
						<button type="button" class="close" data-dismiss="modal">×</button>
						<h3 class="modal-title" style="color:#fff;"> Are You Change the Listing Type ?</h3>
						<!--<i class="fa fa-pencil dir-pop-head-icon" aria-hidden="true"></i>-->
					</div>
					<div class="modal-body">
						<form action="change-type.php" method="get">
							<!--LISTING INFORMATION-->
							<div style="padding: 20px;">
								<label>Listing Type *</label>
										<select class="" name="ltype" required>
										<option value="" disabled selected> Select Listing Type</option>
											<option value="free">FREE</option>
											<option value="gold">PREMIUM</option>
											<option value="daimond">PLATIMUM</option>

										</select>

							<input type="hidden" name="id" value="<?php echo $lrow['l_id']; ?>">
										</div>

							<!--LISTING INFORMATION-->
							<br><br>
							<div class="form-group has-feedback ak-field">
								<div class="col-md-6 col-md-offset-4">
									<input type="submit" value="Update" class="pop-btn"> <input type="button" value="Close" class="pop-btn" data-dismiss="modal">  </div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
											<?php $x++; } ?>
												</tbody>

											</table>
</div>
										</div>

				


	<script type="text/javascript">
	
		$(document).ready(function() {
	
			$('.datatable').dataTable({
				"sPaginationType": "bs_normal"
			});	
			$('.datatable').each(function(){
				var datatable = $(this);
				// SEARCH - Add the placeholder for Search and Turn this into in-line form control
				var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
				search_input.attr('placeholder', 'Search');
				search_input.addClass('form-control input-sm');
				// LENGTH - Inline-Form control
				var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
				length_sel.addClass('form-control input-sm');
			});
				)};
		</script>