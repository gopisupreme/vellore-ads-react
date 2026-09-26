<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Paypalpayment extends CI_Controller 
    {
         function  __construct(){
            parent::__construct();
            $this->load->library('paypal_lib');
            $this->load->model('Company_Model');
            $this->load->model('User_Model');
         }
         
         function success(){
            //get the transaction data
            $paypalInfo = $this->input->get();              
            $data['item_number'] = $paypalInfo['item_number']; 
            $data['txn_id'] = $paypalInfo["tx"];
            $data['payment_amt'] = $paypalInfo["amt"];
            $data['currency_code'] = $paypalInfo["cc"];
            $data['status'] = $paypalInfo["st"];
			
			$insert = array(
				'product_id' => $paypalInfo['item_number'],
				'txn_id' => $paypalInfo["tx"],
				'payment_gross' => $paypalInfo["amt"],
				'currency_code' => $paypalInfo["cc"],
				'payer_email' => 'raman@gmail.com',
				'payment_status' => $paypalInfo["st"],
				'payment_mode' => 'Online',
				'txn_date' => date('Y-m-d H:i:s'),
				'gateway_name' => 'PayPal',
				'user_id' => '1',
				'type' => '1'
			);
			$this->db->insert('payments', $insert);
			$updateRow = array( 'status' => 1, 'payment' => 'success', 'type' => '1');
			$this->db->where('id', 1);
			$update = $this->db->update('clients', $updateRow);
            $userId = $this->session->userdata('uid');
			$data['title'] = 'PayPal Payment Success';
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			//pass the transaction data to view
			$this->load->view('templates/header', $data);
            $this->load->view('pages/paypalsuccess', $data);
			$this->load->view('templates/footer', $data);
         }
         
         function cancel(){
			$userId = $this->session->userdata('uid');
			$data['title'] = 'PayPal Payment Cancel';
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$this->load->view('templates/header', $data);
			$this->load->view('pages/paypalcancel', $data);
			$this->load->view('templates/footer', $data);
         }
         
        function ipn(){
            //paypal return transaction details array
            $paypalInfo    = $this->input->post();
            $data['user_id'] = $paypalInfo['custom'];
            $data['product_id']    = $paypalInfo["item_number"];
            $data['txn_id']    = $paypalInfo["txn_id"];
            $data['payment_gross'] = $paypalInfo["payment_gross"];
            $data['currency_code'] = $paypalInfo["mc_currency"];
            $data['payer_email'] = $paypalInfo["payer_email"];
            $data['payment_status']    = $paypalInfo["payment_status"];

            $paypalURL = $this->paypal_lib->paypal_url;        
            $result    = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
            //check whether the payment is verified
            if(preg_match("/VERIFIED/i",$result)){
                //insert the transaction data into the database
				
					$this->Company_Model->insertTransaction($data);
			
            }
        }
    }
?>