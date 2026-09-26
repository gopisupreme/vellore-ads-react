<?php
class Cart_Model extends CI_Model
    {
    function add_to_cart()
        {
            $u_id = $this->input->post('u_id'); 
            $product_id=$this->input->post('product_id');
            $qty= $this->input->post('quantity');
           
            $this->db->where('u_id', $u_id);
			$this->db->where('product_id', $product_id);

			$lres = $this->db->get('product_cart');
            $lrow=$lres->row_array();
		   	  if ($lres->num_rows() == 1) {
                     $cid=$lrow['id'];
		  		   
		  		    $this->db->set('product_quantity', "product_quantity+$qty", FALSE);
                    $this->db->where('id', $cid);
                    $this->db->update('product_cart'); 
		  		}
		  		else{
                $data = array(
                 'u_id' => $this->input->post('u_id'),
                'product_id' => $this->input->post('product_id'),
                'product_name' => $this->input->post('product_name'),
                'product_price' => $this->input->post('product_price'),
                'product_image' => $this->input->post('product_image'),
                'product_quantity' => $this->input->post('quantity'),
                'list_id' => $this->input->post('list_id'),
                 );
                 $result=$this->db->insert('product_cart',$data);
		  		}
            return $result;
        }

        function product_list(){
            $u_id = $this->input->post('id');
            $this->db->where('u_id', $u_id);
            $query = $this->db->select('*')->from('product_cart')->get();
            return $query->result();
        }

        function delete_product() {
            $id = $this->input->post('id');
             $u_id = $this->input->post('u_id');
            $result = $this->db->delete('product_cart', array('id' => $id, 'u_id' =>$u_id ));
            return $result;
        }
        function update_product() {
            $new_quantity = $_POST["new_quantity"];
            $cart_id = $_POST["cart_id"];
            $this->db->where('id' , $cart_id);
            $result = $this->db->update('product_cart' , array('product_quantity' => $new_quantity));
            return $result;
         }
         function order_product_list(){
            $u_id = $this->input->post('id');
            $this->db->where('order_id', $u_id);
            $query = $this->db->select('*')->from('rb_order_details')->get();
            return $query->result();
        }

    }
?>