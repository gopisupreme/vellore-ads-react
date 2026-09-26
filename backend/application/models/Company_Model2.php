<?php
	class Company_Model2 extends CI_Model{
		
		public function get_Company_Info(){
			//Validate
			$this->db->where('id', 1);
			$query = $this->db->select('*')->from('companyinfo')->get();
			return $query->row_array();
		
            
		}
		

	}