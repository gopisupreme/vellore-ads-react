<?php
	class User_Model2 extends CI_Model{
	    
        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }
	    
	    public function getUserInfo($userId){
			$this->db->where('u_id', $userId);
			$query = $this->db->select('*')->from('users')->get();
			return $query->row_array();
		}
		
		
		public function add_listing($data){
            if($data) {
                
               return ($this->db->insert('listing', $data))  ?   $this->db->insert_id()  :   false;
                
            }
        }
        
        public function add_listing_features($data){
           $this->db->insert('listing_features',$data);
           $last_id = $this->db->insert_id();
           return  $last_id;
        }
		
		
	}
?>	