
<?php
$order_id=$this->session->userdata('order_id');
         $lsql1 = "SELECT * FROM `rb_order_details` WHERE order_id='".$order_id."' " ; 
		$lres1 = $this->db->query($lsql1)->result_array();
?>

                                <?php foreach($lres1 as $lrow1) {?>
                                <tr>
                                    <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;">
                                       <?php echo $lrow1['product_name'];?>
                                    </td>
                                    <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;">
                                      <?php echo $lrow1['product_price'];?>
                                    </td>
                                </tr>
                                <?php }?>
                               
                          