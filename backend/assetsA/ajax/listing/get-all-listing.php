<?php
include("../../../dbconnect.php");
if(isset($_POST["action"]))
{
    $action = $_POST["action"];
    if($action == "fetch")
    {
        $listid = $_POST["listid"];
        $getid = $_POST["getid"];

        $listing_query = mysqli_query($conn, "SELECT * FROM `listing` WHERE `l_id` < '$listid' ORDER BY `l_id` DESC LIMIT ".$getid."");
        $listing_count = mysqli_num_rows($listing_query);
        if($listing_count > 0)
        {
            while($listing_fetch = mysqli_fetch_array($listing_query))
            {
				$premium = mysqli_query($conn, "SELECT * FROM `premium` WHERE `name` = '".$listing_fetch['l_type']."'");
				$premiumRow = mysqli_fetch_array($premium);
				$getUser = mysqli_query($conn, "SELECT * FROM `users` WHERE `u_id` = '".$listing_fetch['l_userid']."'");
				$getUserRow = mysqli_fetch_array($getUser);
				$who = $getUserRow['u_type'];
				if($who == 'admin') { $nameUser = 'Admin'; $color = 'warning'; } else { $nameUser = 'User'; $color = 'danger'; }
?>
            <tr id="del<?php echo $listing_fetch['l_id']; ?>">
                <td style="vertical-align:middle;">
                    <a href="#!">
                        <span class="list-enq-name"><?php echo $listing_fetch['l_title']; ?></span>
                        <span class="list-enq-city"><?php echo $listing_fetch['l_category']; ?></span>
                    </a>
                </td>
                <td style="vertical-align:middle;">
					<?php echo date("d M Y",strtotime( $listing_fetch['l_adddate'])); ?><br>
					+91 <?php $phone = explode(",", $listing_fetch['l_phone']); echo $phone[0]; ?><br>
				</td>
                <td style="vertical-align:middle;"> 
                    <a href="#!" data-action="<?php echo $listing_fetch['l_type']; ?>" id="changeplan<?php echo $listing_fetch['l_id']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>" class="label label-info change_plan"><?php echo $premiumRow['name']; ?></a><br><br>
					<a href="#!" class="label label-<?php echo $color; ?>"><?php echo $nameUser; ?></a>
                </td>
                <td style="vertical-align:middle;"> 
                    <?php 
                    if($listing_fetch['l_status'] == 'active')
                    { 
                    ?>
                        <a href="#!" class="label label-success change_permission" id="changeid<?php echo $listing_fetch['l_id']; ?>" data-action="<?php echo $listing_fetch['l_status']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>">Active</a>
                    <?php 
                    } 
                    else 
                    {
                    ?>
                        <a href="#!" class="label label-primary change_permission" id="changeid<?php echo $listing_fetch['l_id']; ?>" data-action="<?php echo $listing_fetch['l_status']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>">pending</a>
                    <?php 
                    } 
                    ?>
                </td>
                <td style="vertical-align:middle;">
                    <span class="list-enq-name">
                        <!--<a href="#!" title="Edit"><i class="fa fa-pencil" style="background-color: #263a78;"></i></a>-->
						<a href="edit-list.php?id=<?php echo $listing_fetch['l_id']; ?>" title="Edit"><i class="fa fa-pencil" style="background-color: #263a78;"></i></a>
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
        $listing_query = mysqli_query($conn, "SELECT * FROM `listing` ORDER BY `l_id` DESC LIMIT 25");
        $listing_count = mysqli_num_rows($listing_query);
        if($listing_count > 0)
        {
            while($listing_fetch = mysqli_fetch_array($listing_query))
            {
				$premium = mysqli_query($conn, "SELECT * FROM `premium` WHERE `name` = '".$listing_fetch['l_type']."'");
				$premiumRow = mysqli_fetch_array($premium);
				
				$getUser = mysqli_query($conn, "SELECT * FROM `users` WHERE `u_id` = '".$listing_fetch['l_userid']."'");
				$getUserRow = mysqli_fetch_array($getUser);
				$who = $getUserRow['u_type'];
				if($who == 'admin') { $nameUser = 'Admin'; $color = 'warning'; } else { $nameUser = 'User'; $color = 'danger'; }
?>
            <tr id="del<?php echo $listing_fetch['l_id']; ?>">
                <td style="vertical-align:middle;">
                    <a href="#!">
                        <span class="list-enq-name"><?php echo $listing_fetch['l_title']; ?></span>
                        <span class="list-enq-city"><?php echo $listing_fetch['l_category']; ?></span>
                    </a>
                </td>
                <td style="vertical-align:middle;">
					<?php echo date("d M Y",strtotime( $listing_fetch['l_adddate'])); ?><br>
					+91 <?php $phone = explode(",", $listing_fetch['l_phone']); echo $phone[0]; ?><br>
				</td>
                <td style="vertical-align:middle;"> 
					<a href="#!" data-action="<?php echo $listing_fetch['l_type']; ?>" id="changeplan<?php echo $listing_fetch['l_id']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>" class="label label-info change_plan"><?php echo $premiumRow['name']; ?></a><br><br>
					<a href="#!" class="label label-<?php echo $color; ?>"><?php echo $nameUser; ?></a>
                </td>
                <td style="vertical-align:middle;"> 
                    <?php 
                    if($listing_fetch['l_status'] == 'active')
                    { 
                    ?>
                        <a href="#!" class="label label-success change_permission" id="changeid<?php echo $listing_fetch['l_id']; ?>" data-action="<?php echo $listing_fetch['l_status']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>">Active</a>
                    <?php 
                    } 
                    else 
                    {
                    ?>
                        <a href="#!" class="label label-primary change_permission" id="changeid<?php echo $listing_fetch['l_id']; ?>" data-action="<?php echo $listing_fetch['l_status']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>">pending</a>
                    <?php 
                    } 
                    ?>
                </td>
                <td style="vertical-align:middle;">
                    <span class="list-enq-name">
                        <a href="edit-list.php?id=<?php echo $listing_fetch['l_id']; ?>" title="Edit"><i class="fa fa-pencil" style="background-color: #263a78;"></i></a>
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
}
?>