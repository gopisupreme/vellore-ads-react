    <ul>
		<li class="adminlogo">
			<div class="center-image">
			   <?php if(!empty($h_rows['u_img'])){ ?>
			    <img src="<?php echo base_url(); ?>assets/uploads/<?php echo $h_rows['u_img']; ?>" alt="<?php echo $h_rows['u_fullname']; ?>" /> 
			    	<?php }else{ ?>
				<img src="<?php echo base_url() ?>assets/imagesJ/db-profile-user.jpg" class="childimg" alt="" /> 
				<?php } ?>
			</div>
		</li>
		<!--<li><span>80%</span> profile compl</li>-->
		<!--<li><span>18</span> Notifications</li>-->
	</ul>