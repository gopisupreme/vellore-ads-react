<?php
class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        // $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->load->library('session');

        $this->load->database();
        $this->load->model('Company_Model');
        $this->load->model('User_Model');
        $this->load->model('Connect_Model');
        $this->load->model('Listing_Model');
        $this->load->library('excel');
    }


    // Products All Data Page
    public function all_product()
    {
        $data['listingId'] = $this->uri->segment(4);
        $userId = $this->session->userdata('uid');
        $data['company'] = $this->Company_Model->getCompanyInfo();
        $data['category'] = $this->Company_Model->getCategory();
        $data['h_rows'] = $this->User_Model->getuserInfo($userId);
        $data['title'] = 'Product List';
        echo '+++++';
        echo $data['listingId'];
        echo '+++++';
        echo $data['company'];
        echo '+++++';
        echo $data['category'];
        echo '+++++';
        echo $data['title'];
        echo '_+++++_';
        echo $data['h_rows'];
        echo '_+++++_';
        echo $userId;
        echo '_++++_';
        var_dump($this->session->userdata('uid'));

        $this->load->view('../../products/header', $data);
        $this->load->view('../../products/products_list', $data);
        $this->load->view('../../products/footer', $data);
    }


    // Product Details
    public function product_details()
    {
        $data['listingId'] = $this->uri->segment(5);
        $userId = $this->session->userdata('uid');
        $data['company'] = $this->Company_Model->getCompanyInfo();
        $data['category'] = $this->Company_Model->getCategory();
        $data['h_rows'] = $this->User_Model->getuserInfo($userId);
        $data['title'] = 'Product Details';
        // echo ($data);
        // echo ('+++++++++++++');

        $this->load->view('../../products/header', $data);
        $this->load->view('../../products/products_details', $data);
        $this->load->view('../../products/footer', $data);
    }

    public function customer_data()
    {

        $userId = $this->session->userdata('uid');
        $data['company'] = $this->Company_Model->getCompanyInfo();
        $data['category'] = $this->Company_Model->getCategory();
        $postData = $this->input->post();
        $listings = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '$list_id'");
        $listingRow = $listings->row_array();
        $listingEmail = $listingRow['l_email'];
        $listingName = $listingRow['l_title'];
        $listingPhone = $listingRow['l_phone'];
        $listinguserid = $listingRow['l_userid'];
        $company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
        $companyRow = $company1->row_array();
        $companyWeb = $companyRow['web'];
        $companyName = $companyRow['cName'];
        $companyMobile = $companyRow['mobile'];
        $companyEmail = $companyRow['email'];
        $companyfacebook = $companyRow['facebook'];
        $companytwitter = $companyRow['twitter'];
        $companygoogle = $companyRow['google'];
        $companylinkedin = $companyRow['linkedin'];
        $companyyoutube = $companyRow['youtube'];
        $from = $companyEmail;
        $fromName = $companyName;
        $to = $postData['email'];
        $toName = $postData['fname'];
        $phone = $postData['phone'];
        $payment = $this->input->post('payment');
        $list_id = $this->input->post('list_id');
        $saddress = $this->input->post('saddress');
        $address = $this->input->post('address');
        $total = $this->input->post('total');
        if ($payment == 'cod') {

            $data = array(
                'fname' => $this->input->post('fname'),
                'lname' => $this->input->post('lname'),
                'company_name' => $this->input->post('companyName'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'address' => $this->input->post('address'),
                'state' => $this->input->post('state'),
                'pincode' => $this->input->post('pincode'),
                'additional_info' => $this->input->post('additionalInformation'),
                'sfname' => $this->input->post('sfname'),
                'slname' => $this->input->post('slname'),
                'scompany_name' => $this->input->post('scname'),
                'semail' => $this->input->post('semail'),
                'sphone' => $this->input->post('sphone'),
                'saddress' => $this->input->post('saddress'),
                'sstate' => $this->input->post('sstate'),
                'spincode' => $this->input->post('spincode'),
                'sadditional_info' => $this->input->post('sinfo'),
                'payment_opt' => $this->input->post('payment'),
                'total' => $this->input->post('total'),
                'list_id' => $this->input->post('list_id'),
                'list_userid' => $listinguserid,
                'paid' => 0
            );
            $this->db->insert('rb_order_master_data', $data);
            $order_id = $this->db->insert_id();


            $this->session->set_userdata('order_id', $order_id);
            $lsql = "SELECT * FROM `product_cart` WHERE `u_id` = $userId ";
            $lres = $this->db->query($lsql)->result_array();
            foreach ($lres as $order_product) {

                $o_details_data['order_id'] = $order_id;
                $o_details_data['product_id'] = $order_product['product_id'];
                $o_details_data['product_price'] = $order_product['product_price'];
                $o_details_data['product_quantity'] = $order_product['product_quantity'];
                $o_details_data['product_name'] = $order_product['product_name'];
                $o_details_data['product_image'] = $order_product['product_image'];


                $this->db->insert("rb_order_details", $o_details_data);
                $id = $order_product['id'];
                $pid = $order_product['product_id'];
                $product_quantity = $order_product['product_quantity'];
                $this->db->update('product');
                $rasql = "UPDATE product SET `p_quantity`=p_quantity-'" . $product_quantity . "' WHERE p_id='" . $o_details_data['product_id'] . "'";
                $rares = $this->db->query($rasql);
                $result = $this->db->delete('product_cart', array('id' => $id, 'u_id' => $userId));

            }

            $this->load->library('email');
            $subject = "Order Placed Successfully $order_id";
            $signature = '--<br>';
            $signature .= 'Sincerely,<br>';
            $signature .= 'Technical & Development Team<br>';
            $showMessage = "Thanks for your order, we will deliver your order soon.<br><br>
									For further assist reach us on " . $listingPhone;



            $lsql1 = "SELECT * FROM `rb_order_details` WHERE order_id='" . $order_id . "' ";
            $lres1 = $this->db->query($lsql1)->result_array();



            $body .=

                '<!DOCTYPE html>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<style type="text/css">

body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
img { -ms-interpolation-mode: bicubic; }

img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
table { border-collapse: collapse !important; }
body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }


a[x-apple-data-detectors] {
    color: inherit !important;
    text-decoration: none !important;
    font-size: inherit !important;
    font-family: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
}

@media screen and (max-width: 480px) {
    .mobile-hide {
        display: none !important;
    }
    .mobile-center {
        text-align: center !important;
    }
}
div[style*="margin: 16px 0;"] { margin: 0 !important; }
</style>
<body style="margin: 0 !important; padding: 0 !important; background-color: #eeeeee;" bgcolor="#eeeeee">




<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td align="center" style="background-color: #eeeeee;" bgcolor="#eeeeee">
        
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
            <tr>
                <td align="center" valign="top" style="font-size:0; padding: 35px;" bgcolor="#F44336">
               
                <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;">
                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                        <tr>
                            <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 36px; font-weight: 800; line-height: 48px;" class="mobile-center">
                                <h1 style="font-size: 36px; font-weight: 800; margin: 0; color: #ffffff;">Velloreads</h1>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;" class="mobile-hide">
                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                        <tr>
                            <td align="right" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; line-height: 48px;">
                                <table cellspacing="0" cellpadding="0" border="0" align="right">
                                    <tr>
                                       
                                        <td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 24px;">
                                            <a href="' . $companyWeb . '" target="_blank" style="color: #ffffff; text-decoration: none;"><img src="' . $companyWeb . '/assets/images/logo-header.png" width="187" height="123" style="display: block; border: 0px;"/></a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
              
                </td>
            </tr>
            <tr>
                <td align="center" style="padding: 35px 35px 20px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                    <tr>
                        <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
                            <img src="https://img.icons8.com/carbon-copy/100/000000/checked-checkbox.png" width="125" height="120" style="display: block; border: 0px;" /><br>
                            <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">
                                Thank You For Your Order!
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
                            <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">
                                Dear ' . $toName . ',
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" style="padding-top: 20px;">
                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td width="75%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;">
                                        Order Confirmation #
                                    </td>
                                    <td width="25%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;">
                                        ' . $order_id . '
                                    </td>
                                </tr>';


            foreach ($lres1 as $lrow1) {
                $body .= '<tr>
                                    <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;">
                                        ' . $lrow1["product_name"] . '
                                    </td>
                                    <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;">
                                        ' . $lrow1["product_price"] . '
                                    </td>
                                </tr>';
            }

            $body .= ' 
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" style="padding-top: 20px;">
                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;">
                                        TOTAL
                                    </td>
                                    <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;">
                                        ' . $total . '
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                
                </td>
            </tr>
             <tr>
                <td align="center" height="100%" valign="top" width="100%" style="padding: 0 35px 35px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:660px;">
                    <tr>
                        <td align="center" valign="top" style="font-size:0;">
                            <div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">

                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                    <tr>
                                        <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;">
                                            <p style="font-weight: 800;">Delivery Address</p>
                                            <p>' . $address . '</p>

                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">
                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                    <tr>
                                        <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;">
                                            <p style="font-weight: 800;">Shipping Address </p>
                                            <p>' . $saddress . '</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
                </td>
            </tr>
           
            <tr>
                <td align="center" style="padding: 35px; background-color: #ffffff;" bgcolor="#ffffff">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                    
                    <tr>
                        <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px; padding: 5px 0 10px 0;">
                            <p style="font-size: 14px; font-weight: 800; line-height: 18px; color: #333333;">
                               ' . $showMessage . '<br> ' . $signature . ' 
                                
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px;">
                            <p style="font-size: 14px; font-weight: 400; line-height: 20px; color: #777777;">
                              
                            </p>
                        </td>
                    </tr>
                </table>
                </td>
            </tr>
        </table>
        </td>
    </tr>
</table>
    
</body>
</html>
';


            $this->email->message($body);
            $this->email->from($from, $companyName);
            $this->email->to($to);
            $this->email->subject($subject);
            //  $this->email->message('Thank u for registering with us.'); 

            //Send mail 
            $user_mail = $this->email->send();


            $subject1 = "New Order: #$order_id";
            $signature1 .= 'Sincerely,<br>';
            $signature1 .= 'Technical & Development Team<br>';
            $showMessage1 = "Congratulations on the sale.";
            $subject11 = "New Order Received";
            $lsqlo = "SELECT * FROM `rb_order_details` WHERE order_id='" . $order_id . "' ";
            $lreso = $this->db->query($lsqlo)->result_array();

            $body1 .=
                '<!DOCTYPE html>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<style type="text/css">

body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
img { -ms-interpolation-mode: bicubic; }

img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
table { border-collapse: collapse !important; }
body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }


a[x-apple-data-detectors] {
    color: inherit !important;
    text-decoration: none !important;
    font-size: inherit !important;
    font-family: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
}

@media screen and (max-width: 480px) {
    .mobile-hide {
        display: none !important;
    }
    .mobile-center {
        text-align: center !important;
    }
}
div[style*="margin: 16px 0;"] { margin: 0 !important; }
</style>
<body style="margin: 0 !important; padding: 0 !important; background-color: #eeeeee;" bgcolor="#eeeeee">




<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td align="center" style="background-color: #eeeeee;" bgcolor="#eeeeee">
        
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
            <tr>
                <td align="center" valign="top" style="font-size:0; padding: 35px;" bgcolor="#F44336">
               
                <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;">
                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                        <tr>
                            <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 36px; font-weight: 800; line-height: 48px;" class="mobile-center">
                                <h1 style="font-size: 36px; font-weight: 800; margin: 0; color: #ffffff;">Velloreads</h1>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;" class="mobile-hide">
                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                        <tr>
                            <td align="right" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; line-height: 48px;">
                                <table cellspacing="0" cellpadding="0" border="0" align="right">
                                    <tr>
                                       
                                        <td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 24px;">
                                            <a href="' . $companyWeb . '" target="_blank" style="color: #ffffff; text-decoration: none;"><img src="' . $companyWeb . '/assets/images/logo-header.png" width="187" height="123" style="display: block; border: 0px;"/></a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
              
                </td>
            </tr>
            <tr>
                <td align="center" style="padding: 35px 35px 20px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                    <tr>
                        <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
                            <img src="https://img.icons8.com/carbon-copy/100/000000/checked-checkbox.png" width="125" height="120" style="display: block; border: 0px;" /><br>
                            <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">
                                New Order Received!
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
                            
                                 <p> Dear ' . $listingName . ',<br><br> You’ve received the following order from ' . $toName . '</p>
		                                                   <p>Contact Number: ' . $phone . '</p>
		                                                    <p>Email: ' . $to . '</p>
                           
                        </td>
                    </tr>
                    <tr>
                        <td align="left" style="padding-top: 20px;">
                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td width="75%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;">
                                        Order Confirmation #
                                    </td>
                                    <td width="25%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;">
                                        ' . $order_id . '
                                    </td>
                                </tr>';


            foreach ($lreso as $lrowo) {
                $body1 .= '<tr>
                                    <td width="50%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;">
                                        ' . $lrowo["product_name"] . '
                                    </td>
                                    <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;">
                                        ' . $lrowo["product_price"] . '
                                    </td>
                                    <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;">
                                        ' . $lrowo["product_quantity"] . '
                                    </td>
                                </tr>';
            }

            $body1 .= ' 
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" style="padding-top: 20px;">
                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;">
                                        TOTAL
                                    </td>
                                    <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;">
                                        ' . $total . '
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                
                </td>
            </tr>
             <tr>
                <td align="center" height="100%" valign="top" width="100%" style="padding: 0 35px 35px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:660px;">
                    <tr>
                        <td align="center" valign="top" style="font-size:0;">
                            <div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">

                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                    <tr>
                                        <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;">
                                            <p style="font-weight: 800;">Delivery Address</p>
                                            <p>' . $address . '</p>

                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">
                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                    <tr>
                                        <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;">
                                            <p style="font-weight: 800;">Shipping Address </p>
                                            <p>' . $saddress . '</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
                </td>
            </tr>
           
            <tr>
                <td align="center" style="padding: 35px; background-color: #ffffff;" bgcolor="#ffffff">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                    
                    <tr>
                        <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px; padding: 5px 0 10px 0;">
                            <p style="font-size: 14px; font-weight: 800; line-height: 18px; color: #333333;">
                               ' . $showMessage1 . '<br> ' . $signature1 . ' 
                                
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px;">
                            <p style="font-size: 14px; font-weight: 400; line-height: 20px; color: #777777;">
                              
                            </p>
                        </td>
                    </tr>
                </table>
                </td>
            </tr>
        </table>
        </td>
    </tr>
</table>
    
</body>
</html>
';

            $this->email->message($body1);
            $this->email->from($from, $companyName);
            $this->email->to($listingEmail);
            $this->email->subject($subject1);
            //  $this->email->message('Thank u for registering with us.'); 

            //Send mail 
            $seller_mail = $this->email->send();



            if ($result) {
                $this->session->set_flashdata('success', '<div class="alert alert-success">Order placed  Successfully.</div>');


                redirect('product/success', $data);
            } else {
                $this->session->set_flashdata('success', '<div class="alert alert-success">Order Failed Try again .</div>');


                redirect('product/success', $data);
            }
        } else {
            $data = array(
                'fname' => $this->input->post('fname'),
                'lname' => $this->input->post('lname'),
                'company_name' => $this->input->post('companyName'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'address' => $this->input->post('address'),
                'state' => $this->input->post('state'),
                'pincode' => $this->input->post('pincode'),
                'additional_info' => $this->input->post('additionalInformation'),
                'sfname' => $this->input->post('sfname'),
                'slname' => $this->input->post('slname'),
                'scompany_name' => $this->input->post('scname'),
                'semail' => $this->input->post('semail'),
                'sphone' => $this->input->post('sphone'),
                'saddress' => $this->input->post('saddress'),
                'sstate' => $this->input->post('sstate'),
                'spincode' => $this->input->post('spincode'),
                'sadditional_info' => $this->input->post('sinfo'),
                'payment_opt' => $this->input->post('payment'),
                'total' => $this->input->post('total'),
                'list_id' => $this->input->post('list_id'),
                'list_userid' => $listinguserid

            );
            $oresult = $this->db->insert('rb_order_master_data', $data);
            $order_id = $this->db->insert_id();

            $this->session->set_userdata('order_id', $order_id);
            if ($oresult) {
                redirect('product/payment', $data);

            } else {
                $this->session->set_flashdata('success', '<div class="alert alert-success">Order Not placed  </div>');
                redirect('product/success', $data);
            }

        }
    }
    public function payment()
    {

        $this->load->view('../../products/header', $data);
        $this->load->view('../../products/payment', $data);
        $this->load->view('../../products/footer', $data);
    }
    public function success()
    {

        $this->load->view('../../products/header', $data);
        $this->load->view('../../products/success', $data);
        $this->load->view('../../products/footer', $data);
    }

    // Shopping Card Page
    public function shopping_cart()
    {
        $this->load->view('../../products/shopping_cart');
    }

    // Shopping Card Page
    public function checkout()
    {
        $this->load->view('../../products/header', $data);
        $this->load->view('../../products/checkout', $data);
        $this->load->view('../../products/footer', $data);
        // $this->load->view('templates/checkout');
    }



}