<?php 
	#add-product.php
?>

<style>

.dynamic_add{
    float:left;
    width:100%;
    padding:12px 5%;
    border:none;
    background:#fff;
    color:#000;
    font-size:13px;
    text-align:left;
}
.glyphicon{color:#fff;} 
.dynamic_remove{
    float:left;
    width:100%;
    padding:12px 5%;
    border:none;
    background:#de4040;
    color:#fff;
    font-size:13px;
    text-align:center;
}

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  

	<!--DASHBOARD-->


		<div class="sb2-2-2">

			<!--LEFT SECTION-->

	

			<!--CENTER SECTION-->

			<div class="sb2-2-2">

				<div class="tz-2 tz-2-admin" style="min-height: 700px;">

					<div class="tz-2-com tz-2-main">

					<h4>Product</h4>

					<div class="db-list-com tz-db-table">

						<div class="ds-boar-title">

							<h2>Add Product</h2>

							<p>All the fields required</p>
							<?php echo validation_errors() ?>
						</div>

						<div class="hom-cre-acc-left hom-cre-acc-right">

							<form class="" action="<?php echo base_url() ?>connect/query_product" method="post" enctype="multipart/form-data">
								<input type="hidden" name="do" value="addC"/>
								<input type="hidden" name="uid" value="<?php echo $h_rows['u_id']; ?>">
								<input type="hidden" name="cdate" value="<?php echo date('Y-m-d'); ?>" >
							
                                
								<div class="row">

									<div class="input-field col s12">

										<select name="list" id="list" required>
										<option value="" disabled selected>Select Listing *</option>
										<?php 
											$lid = $h_rows['u_id'];
										$list = $this->db->query("SELECT * FROM listing where  l_shopping='1' order by l_adddate desc")->result_array();
										foreach($list as $listRow) { ?>
											<option value="<?php echo $listRow['l_id']; ?>"><?php echo $listRow['l_title']; ?></option>
										<?php } ?>
									</select>
									
									</div>
									
								</div>

								<div class="row">

									<div class="input-field col s12">

										<input type="text" required  name="product" autocomplete="off" value="<?php echo set_value('product'); ?>">

										<label>Product Name *</label>

									</div>
									
								</div>

                      
								<div class="row">

								<div class="input-field col s6">
									<select name="group" id="group" required>
										<option value="" disabled selected>Select Group *</option>
										<?php $cate = $this->db->query("SELECT * FROM `groups` WHERE `g_status` = '1'")->result_array();
										foreach($cate as $cateRow) { ?>
											<option value="<?php echo $cateRow['g_title']; ?>"><?php echo $cateRow['g_title']; ?></option>
										<?php } ?>
									</select>
								</div>

								<div class="input-field col s6 category_field">
									<select name="category" id="category" required>
										<option value="" disabled selected>Select Category *</option>
										<?php $cate = $this->db->query("SELECT * FROM `categories` WHERE `c_status` = '1'")->result_array();
										foreach($cate as $cateRow) { ?>
											<option  data-category="<?php echo $cateRow['c_id']; ?>" value="<?php echo $cateRow['c_title']; ?>" style="display:none;"><?php echo $cateRow['c_title']; ?></option>
										<?php } ?>
									</select>
								</div>

								</div>

								<div class="row">

								<div class="input-field col s6">
									<select  name="subcategory" id="subcategory" >
                                        <option value="" disabled selected>Select Sub Category *</option>
                                    </select>
								</div>

								<div class="input-field col s6">
									<button type="button" name="add" class="add dynamic_add">
										Add Color And No.Of Stock * <span class="glyphicon glyphicon-plus"></span>
									</button>
								</div>
								</div>

								<!-- Dynamic Color Picker -->

								<div class="row" id="item_table">
									
								</div>

								<!-- end Dynamic Color Picker -->

								<div class="row">

									<div class="input-field col s6">

										<input type="number" pattern= "[0-9]"  name="quantity" autocomplete="off" value="<?php echo set_value('quantity'); ?>">

										<label>Product Quantity</label>

									</div>
									<div class="input-field col s6">

										<input type="number" pattern= "[0-9]"  name="weight" autocomplete="off" value="<?php echo set_value('weight'); ?>">

										<label>Product Weight</label>

									</div>
									
								</div>
								
								<div class="row">
                                            <div class="input-field col s6 half_width">
                                                <input type="number"  name="size_width" autocomplete="off" value="<?php echo set_value('size_width'); ?>">

										        <label>Product Size (Width)</label>
                                            </div>
                                            <div class="input-field col s6 half_width">
                                                <input type="number"  name="size_height" autocomplete="off" value="<?php echo set_value('size_height'); ?>">

										        <label>Product Size (Height) </label>
                                            </div>
                                        </div>

								<div class="row">

									<div class="input-field col s12">

										<!--<input type="text" required  name="brand" autocomplete="off" value="<?php //echo set_value('bramd'); ?>">-->

										<!---->
										
									
									<!--<input type="text" list="brand" name="brand" />-->
									<label>Product Brand *</label> 
                                    <select id="brand" name="brand">
                                      <option value="" disabled selected>Select Brand *</option>
										<?php $cate = $this->db->query("SELECT * FROM `brand` WHERE `b_status` = '1'")->result_array();
										foreach($cate as $cateRow) { ?>
											<option value="<?php echo $cateRow['b_title']; ?>"><?php echo $cateRow['b_title']; ?></option>
										<?php } ?>
                                    </select>

									</div>
									
								</div>

								<div class="row">

									<div class="input-field col s6">

										<input type="number" required  pattern= "[0-9]"  name="rate" autocomplete="off" value="<?php echo set_value('rate'); ?>">

										<label>Product Rate (In Rupees)*</label>

									</div>
									<div class="input-field col s6">

										<input type="number"  pattern= "[0-9]" name="discount" autocomplete="off" value="<?php echo set_value('discount'); ?>">

										<label>Product Discount</label>

									</div>
									
								</div>

	

								<div class="row">

									<div class="input-field col s6">

										<input type="date"  name="discount_exp" value="<?php echo set_value('discount_exp'); ?>">

										<!-- <label>Discount Expire Date</label> -->
									</div>

									<div class="input-field col s6">

										<input type="number"  pattern= "[0-9]" name="discount_count" autocomplete="off" value="<?php echo set_value('discount_count'); ?>">

										<label>No.of Discount Available</label>

									</div>

								</div>

								<div class="row">
									<div class="input-field col s6">
										<select name="waranty" id="waranty" required>
											<option value="" disabled selected>Select Waranty</option>
											<option value="1">Available</option>
											<option value="0">Not-Available</option>
										</select>
									</div>
									<div class="input-field col s6">
									<button type="button" name="specification_add" class="specification_add dynamic_add">
										Add Product Specification <span class="glyphicon glyphicon-plus"></span>
									</button>
									</div>
								</div>
								
								<div class="row" id="waranty_year" style="display:none;">

									<div class="input-field col s12">

										<input type="number"  pattern= "[0-9]" name="waranty_year"  autocomplete="off" value="<?php echo set_value('waranty_year'); ?>">

										<label>No.Of Waranty Year</label>

									</div>
									
								</div>

								<!-- Dynamic Specification -->

								<div class="row" id="specification_list">
									
								</div>

								<!-- end Dynamic Specification -->

								

								<div class="row">

									<div class="input-field col s12 m6">

										<input type="number"  pattern= "[0-9]" name="delivery_duration" autocomplete="off" value="<?php echo set_value('delivery_duration'); ?>">

										<label>Delivery Duration (Hours)</label>

									</div>

									<div class="input-field col s12 m6">

										<input type="number"  pattern= "[0-9]" name="delivery_charge" autocomplete="off" value="<?php echo set_value('delivery_charge'); ?>">

										<label>Delivery Charge</label>

									</div>
									
								</div>
								
								
								<div class="row">

									<div class="input-field col s12">

										<textarea class="validate" id="description" name="description" autocomplete="off" maxlength="3000" required><?php echo set_value('description'); ?></textarea>

							
										

									</div>

								</div>
								
                  <script>
                        CKEDITOR.replace( 'description' );
                </script>
								
								<div class="row">
									<div class="input-field col s12">

										<textarea id="faq"  maxlength="750" class="materialize-textarea" name="faq"><?php echo set_value('faq'); ?></textarea>

										<label for="textarea1" id="faqErr">Product FAQ Schema *</label>

									</div>
								</div>

								<div class="row">
									<div class="input-field col s12">

										<textarea id="refund_policy"  maxlength="750" class="materialize-textarea" name="refund_policy"><?php echo set_value('refund_policy'); ?></textarea>

										<label for="textarea1" id="refund_policyErr">Product Refund Policy *</label>

									</div>
								</div>

								<div class="row">
									<div class="input-field col s12">

										<textarea id="delivery_policy"  maxlength="750" class="materialize-textarea" name="delivery_policy"><?php echo set_value('delivery_policy'); ?></textarea>

										<label for="textarea1" id="delivery_policyErr">Product Delivery Policy *</label>

									</div>
								</div>

								<div class="row">
									<div class="input-field col s12">

										<textarea id="warranty_policy"  maxlength="750" class="materialize-textarea" name="warranty_policy"><?php echo set_value('warranty_policy'); ?></textarea>

										<label for="textarea1" id="warranty_policyErr">Product Warranty Policy *</label>

									</div>
								</div>
								
								<div class="row">
									<div class="input-field col s12">

										<textarea id="key" maxlength="750" class="materialize-textarea" name="key"><?php echo set_value('key'); ?></textarea>

										<label for="textarea1" id="keyErr">Product Keywords </label>

									</div>
								</div>

								<div class="row">
									<div class="input-field col s12">
										<select name="replacement" id="replacement" required>
											<option value="" disabled selected>Select Replacement Status *</option>
											<option value="1">Available</option>
											<option value="0">Non-Available</option>
										</select>
									</div>
								</div>

								<div class="row">
									<div class="input-field col s12">
										<select name="status" id="status" required>
											<option value="" disabled selected>Select Status *</option>
											<option value="1">Active</option>
											<option value="0">Non-Active</option>
										</select>
									</div>
								</div>

								
								<!-- <div class="row">

									<div class="input-field col s12">

										<input type="text"  name="stock" autocomplete="off" value="<?php //echo set_value('stock'); ?>">

										<label>No.of Stock</label>

									</div>
									
								</div> -->
								
								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Image Upload <span class="v2-db-form-note">(image size 1350x500):<span></h5>
									</div>
								</div>
								<div class="row tz-file-upload">
									<div class="file-field input-field">
										<div class="tz-up-btn"> <span>File</span>
											<input type="file" name="fileToUpload" id="fileToUpload"> </div>
										<div class="file-path-wrapper db-v2-pg-inp">
											<input class="file-path validate" name="files" accept="image/*" type="text" placeholder="note: not more than 2MB" autocomplete="off">
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Image Upload <span class="v2-db-form-note">(image size 728x90):<span></h5>
									</div>
								</div>
								<div class="row tz-file-upload">
									<div class="file-field input-field">
										<div class="tz-up-btn"> <span>File</span>
											<input type="file" name="coverImage" id="coverImage"> </div>
										<div class="file-path-wrapper db-v2-pg-inp">
											<input class="file-path validate" name="coverFiles" type="text" placeholder="note: not more than 2MB" autocomplete="off">
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Image Upload <span class="v2-db-form-note">(image size 250x250):<span></h5>
									</div>
								</div>
								<div class="row tz-file-upload">
									<div class="file-field input-field">
										<div class="tz-up-btn"> <span>File</span>
											<input type="file" name="wideImage" id="wideImage"> </div>
										<div class="file-path-wrapper db-v2-pg-inp">
											<input class="file-path validate" name="wideFiles" type="text" placeholder="note: not more than 2MB" autocomplete="off">
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


<!-- Color Picker -->

<script>
$(document).ready(function(){
 
 $(document).on('click', '.add', function(){ 
  var html = '';
  html += '<div class="color_pick">';
  html += '<div class="input-field col s6"><input type="color" value="#ffffff"  name="color[]" autocomplete="off" value="<?php echo set_value('color'); ?>"></div>';
  html += '<div class="input-field col s4"><input type="number"  name="stock[]" autocomplete="off" value="<?php echo set_value('stock'); ?>"><label>No.of Stock</label></div>';
  html += '<div class="input-field col s2"><button type="button" name="remove" class="dynamic_remove remove"><span class="glyphicon glyphicon-minus"></span></button></div></div>';
  $('#item_table').append(html);
 });
 
 $(document).on('click', '.remove', function(){
  $(this).closest('.color_pick').remove();
 });

 $(document).on('click', '.specification_add', function(){
  var html = '';
  html += '<div class="specification_div">';
  html += '<div class="input-field col s6"><input type="text"  name="specification_label[]" autocomplete="off" value="<?php echo set_value('specification_label'); ?>"><label>Product Specification Label</label></div>';
  html += '<div class="input-field col s4"><input type="text"  name="specification_desc[]" autocomplete="off" value="<?php echo set_value('specification_desc'); ?>"><label>Description</label></div>';
  html += '<div class="input-field col s2"><button type="button" name="specification_remove" class="dynamic_remove specification_remove"><span class="glyphicon glyphicon-minus"></span></button></div></div>';
  $('#specification_list').append(html);
 });
 
 $(document).on('click', '.specification_remove', function(){
  $(this).closest('.specification_div').remove();
 });
 
 
 $('#waranty').on('change', function() {
      if ( this.value == '1')
      {
        $("#waranty_year").show();
      }
      else
      {
        $("#waranty_year").hide();
      }
    });
    
    
$('#group').on('change',function(){
   var group_id = $(this).val(); 
   console.log(group_id)
   if(group_id){
       $.ajax({
          type:"GET",
          url:"{{url('category_list')}}?group_id="+group_id,
          success:function(res){        
           if(res){
               $("#category").empty();
               $("#category").append('<option value="">--Select--</option>');
               $.each(res,function(key,value){
                   $("#category").append('<option value="'+value+'">'+key+'</option>');
               }); 
           
           }else{
              $("#category").empty();
              $("#category").append('<option value="">--Select--</option>');
           }
          }
       });
   }else{
       $("#category").empty();
       $("#category").append('<option value="">--Select--</option>');
   }
       
  });    
    
    
    $('#category').on('change', function() {

        var category_id =  $(this).find(':selected').attr('data-category');
        var next_id = $("#subcategory");
        $.ajax({
            url:"<?php echo base_url(); ?>products/sub-category-dropdown.php",
            method:"POST",
            data:{category_id: category_id},
            success:function(data){
                $("#subcategory").empty();
                $(next_id).append($(data));
               $(next_id).material_select();
            }
        });
    });
 

});
</script>



<!-- end color Picker -->