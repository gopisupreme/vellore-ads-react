<?php 

	$useruid = $this->session->userdata('uid');
	$ur1=$ur;
	
   	$c_sql = $this->db->query("SELECT * FROM `job_apply_resume` WHERE `id` = '$ur1' AND `recruiter_id` = '$useruid'");
    	$c_count = $c_sql->num_rows(); // check data is valid listing from  listing
    	
       if($c_count > 0) {
    	
    	
    		   header("Location:".base_url()."assets/uploads/Resume/".$resume); 
    	
    	} else {
		
    		header("Location:".base_url()."users/login");
    	}
		
		
