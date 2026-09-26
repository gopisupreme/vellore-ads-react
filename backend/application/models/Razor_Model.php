<?php
class Razor_Model  extends CI_Model
{
    public function razor_payment_success()
    {
        $data = array(
            'user_id' => '1',
            'product_id' => $this->input->post('product_id'),
            'payment_id' => $this->input->post('razorpay_payment_id'),
            'amount' => $this->input->post('totalAmount')
         );
        $result=$this->db->insert('orders',$data);
        return $result;
    }
    
}

?>