<?php
#get-all-listing.php
if(isset($action))
{
    
    if($action == "fetch")
    {

        $listing_query = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` < '$listid' ORDER BY `l_id` DESC LIMIT ".$getid."");
        $listing_count = $listing_query->num_rows();
        if($listing_count > 0)
        {
			$listing_query1 = $listing_query->result_array();
			foreach($listing_query1 as $listing_fetch)
            {
				#$cateList = explode(", ", $listing_fetch['l_category']);
				$premium = $this->db->query("SELECT * FROM `premium` WHERE `name` = '".$listing_fetch['l_type']."'");
				$premiumRow = $premium->row_array();
				$getUser = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '".$listing_fetch['l_userid']."'");
				$getUserRow = $getUser->row_array();
				$who = $getUserRow['u_type'];
				$title = url_title($listing_fetch['l_title']);
				if($who == 'admin') { $nameUser = 'Admin'; $color = 'warning'; } else { $nameUser = 'User'; $color = 'danger'; }
?>
            <tr id="del<?php echo $listing_fetch['l_id']; ?>">
                <td style="vertical-align:middle;">
                    <a href="<?php echo base_url(); ?>post-free-ads/<?php echo $listing_fetch['l_city']; ?>/<?php echo $title; ?>/<?php echo $listing_fetch['l_id']; ?>" target="_blank">
                        <span class="list-enq-name"><?php echo $listing_fetch['l_title']; ?></span>
                        <span class="list-enq-city"><?php echo $listing_fetch['l_category']; ?></span>
                    </a>
                </td>
                <td style="vertical-align:middle;">
					<?php echo date("d M Y",strtotime( $listing_fetch['l_adddate'])); ?><br>
					+91 <?php $phone = explode(",", $listing_fetch['l_phone']); echo $phone[0]; ?><br>
				</td>
                <td style="vertical-align:middle;"> 
                    <a href="#!" data-action="<?php echo $listing_fetch['l_type']; ?>" id="changeplan<?php echo $listing_fetch['l_id']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>" onclick="return confirm('Are you sure want to continue?');" class="label label-info change_plan"><?php echo $premiumRow['name']; ?></a><br><br>
					<a href="#!" class="label label-<?php echo $color; ?>"><?php echo $nameUser; ?></a>
                </td>
                <td style="vertical-align:middle;"> 
                    <?php 
                    if($listing_fetch['l_status'] == 'active')
                    { 
                    ?>
                        <a href="#!" onclick="return confirm('Are you sure want to continue?');" class="label label-success change_permission" id="changeid<?php echo $listing_fetch['l_id']; ?>" data-action="<?php echo $listing_fetch['l_status']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>">Active</a>
                    <?php 
                    } 
                    else 
                    {
                    ?>
                        <a href="#!" onclick="return confirm('Are you sure want to continue?');" class="label label-primary change_permission" id="changeid<?php echo $listing_fetch['l_id']; ?>" data-action="<?php echo $listing_fetch['l_status']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>">pending</a>
                    <?php 
                    } 
                    ?>
                </td>
                <td style="vertical-align:middle;">
                    <span class="list-enq-name">
                        <!--<a href="#!" title="Edit"><i class="fa fa-pencil" style="background-color: #263a78;"></i></a>-->
						<a href="edit-post.php?id=<?php echo $listing_fetch['l_id']; ?>" onclick="return confirm('Are you sure want to continue?');" title="Edit"><i class="fa fa-pencil" style="background-color: #263a78;"></i></a>
                        <a href="#!" class="delete_listing" data-action="delete" data-id="<?php echo $listing_fetch['l_id']; ?>" title="Delete"><i class="fa fa-trash" style="background-color: #ef0b0b;"></i></a>
                    </span>
                </td>
            </tr>
            <?php
            $last_id = $listing_fetch["l_id"];
            }
            ?>
            <tr id="remove_row">
                <td colspan="5">
                <button class="btn btn-block btn-primary" data-id="<?php echo $last_id; ?>" id="load_more"> Load More </button>
                </td>
            </tr>
    <?php
        }
    }
    elseif($action == "start")
    {
        $listing_query = $this->db->query("SELECT * FROM `post_ad` ORDER BY `l_id` DESC LIMIT 25");
        $listing_count = $listing_query->num_rows();
        if($listing_count > 0)
        {
			$listing_query1 = $listing_query->result_array();
			foreach($listing_query1 as $listing_fetch)
            {
				#$cateList = explode(", ", $listing_fetch['l_category']);
				//print_r($cateList);
				#$update = $this->db->query("UPDATE `listing` SET `l_category` = '".$cateList[0]."' WHERE `l_id` = '".$listing_fetch['l_id']."'");
				$premium = $this->db->query("SELECT * FROM `premium` WHERE `name` = '".$listing_fetch['l_type']."'");
				$premiumRow = $premium->row_array();
				
				$getUser = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '".$listing_fetch['l_userid']."'");
				$getUserRow = $getUser->row_array();
				$title = url_title($listing_fetch['l_title']);
				$who = $getUserRow['u_type'];
				if($who == 'admin') { $nameUser = 'Admin'; $color = 'warning'; } else { $nameUser = 'User'; $color = 'danger'; }
?>
            <tr id="del<?php echo $listing_fetch['l_id']; ?>">
                <td style="vertical-align:middle;">
                    <a href="<?php echo base_url(); ?>post-free-ads/<?php echo $listing_fetch['l_city']; ?>/<?php echo $title; ?>/<?php echo $listing_fetch['l_id']; ?>" target="_blank">
                        <span class="list-enq-name"><?php echo $listing_fetch['l_title']; ?></span>
                        <span class="list-enq-city">
						<?php //echo "UPDATE `listing` SET `l_category` = '".$cateList[0]."' WHERE `l_id` = '".$listing_fetch['l_id']."'"; ?>
						<?php  echo $listing_fetch['l_category']; ?></span>
                    </a>
                </td>
                <td style="vertical-align:middle;">
					<?php echo date("d M Y",strtotime( $listing_fetch['l_adddate'])); ?><br>
					+91 <?php $phone = explode(",", $listing_fetch['l_phone']); echo $phone[0]; ?><br>
				</td>
                <td style="vertical-align:middle;"> 
					<a href="#!" data-action="<?php echo $listing_fetch['l_type']; ?>" id="changeplan<?php echo $listing_fetch['l_id']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>" class="label label-info change_plan" onclick="return confirm('Are you sure want to continue?');"><?php echo $premiumRow['name']; ?></a><br><br>
					<a href="#!" class="label label-<?php echo $color; ?>"><?php echo $nameUser; ?></a>
                </td>
                <td style="vertical-align:middle;"> 
                    <div>
                    <?php 
                    if($listing_fetch['l_status'] == 'active')
                    { 
                    ?>
                        <a href="#!" class="label label-success change_permission" id="changeid<?php echo $listing_fetch['l_id']; ?>" data-action="<?php echo $listing_fetch['l_status']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>" onclick="return confirm('Are you sure want to continue?');">Active</a>
                    <?php 
                    } 
                    else 
                    {
                    ?>
                        <a href="#!" class="label label-primary change_permission" id="changeid<?php echo $listing_fetch['l_id']; ?>" data-action="<?php echo $listing_fetch['l_status']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>" onclick="return confirm('Are you sure want to continue?');">pending</a>
                    <?php 
                    } 
                    ?></div>
                    <div style="margin-top:10px;">
                    <?php 
                    if($listing_fetch['l_verified'] == 1)
                    { 
                    ?>
                        <a href="#!" class="label label-success change_verified" id="changeverified<?php echo $listing_fetch['l_id']; ?>" data-action="<?php echo $listing_fetch['l_verified']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>" onclick="return confirm('Are you sure want to continue?');">Verified</a>
                    <?php 
                    } 
                    else 
                    {
                    ?>
                        <a href="#!" class="label label-danger change_verified" id="changeverified<?php echo $listing_fetch['l_id']; ?>" data-action="<?php echo $listing_fetch['l_verified']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>" onclick="return confirm('Are you sure want to continue?');">Not Verified</a>
                    <?php 
                    } 
                    ?></div>
                    <div style="margin-top:10px;">
                    <?php 
                    if($listing_fetch['l_trusted'] == 1)
                    { 
                    ?>
                        <a href="#!" class="label label-primary change_trusted" id="changetrusted<?php echo $listing_fetch['l_id']; ?>" data-action="<?php echo $listing_fetch['l_trusted']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>" onclick="return confirm('Are you sure want to continue?');">Trusted</a>
                    <?php 
                    } 
                    else 
                    {
                    ?>
                        <a href="#!" class="label label-danger change_trusted" id="changetrusted<?php echo $listing_fetch['l_id']; ?>" data-action="<?php echo $listing_fetch['l_trusted']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>" onclick="return confirm('Are you sure want to continue?');">Not Trusted</a>
                    <?php 
                    } 
                    ?>
                    </div>
                </td>
                <td style="vertical-align:middle;">
                    <span class="list-enq-name">
                        <a href="<?php echo base_url() ?>connect/edit_post/<?php echo $listing_fetch['l_id']; ?>" title="Edit" onclick="return confirm('Are you sure want to continue?');"><i class="fa fa-pencil" style="background-color: #263a78;"></i></a>
                        <a href="#!" class="delete_listing" data-action="delete" data-id="<?php echo $listing_fetch['l_id']; ?>" title="Delete" ><i class="fa fa-trash" style="background-color: #ef0b0b;"></i></a>
                    </span>
                </td>
            </tr>
<?php
            $last_id = $listing_fetch["l_id"];
            }
?>
            <tr id="remove_row">
                <td colspan="5">
                <button class="btn btn-block btn-primary" data-id="<?php echo $last_id; ?>" id="load_more"> Load More </button>
                </td>
            </tr>
<?php
        }
    }
}
?>