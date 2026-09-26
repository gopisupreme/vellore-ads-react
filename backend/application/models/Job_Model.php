<?php
class Job_Model  extends CI_Model
{
     public function count_all_job_list($job,$job_type,$edu_level,$min,$max,$work_mode,$area)
     {
      $query = $this->fetch_query_job($job,$job_type,$edu_level,$min,$max,$work_mode,$area);
      $data = $this->db->query($query);
      $num_rows=$data->num_rows();
      return $num_rows;
     }
     public function fetch_query_job($job,$job_type,$edu_level,$min,$max,$work_mode,$area)
    {
        $query = "SELECT * from job  WHERE status='1' and ((`position` LIKE '%".$this->db->escape_like_str($job)."%') OR (`job_category` LIKE '%".$this->db->escape_like_str($job)."%'))";
         if(isset($job_type))
        {
           $job_type_filter = implode("','", $job_type);
       $query .= "AND job_type IN('".$job_type_filter."')";
        }
        
        if(isset($edu_level))
        {
           $edu_level_filter = implode("','", $edu_level);
           $query .= "AND edu_level IN('".$edu_level_filter."')";
        }
         if(isset($min) && isset($max)){
          
             $query .= "AND (salary_from BETWEEN $min AND $max) OR (salary_to BETWEEN $min AND $max)";
             
         }
       
         if(isset($work_mode))
        {
           $work_mode_filter = implode("','", $work_mode);
           $query .= "AND work_mode IN('".$work_mode_filter."')";
        }
        if(!empty($area))
        {
          
          $query .= "AND city='$area'";
        }
         return $query;
     }

	 public function fetch_job_list_model($limit,$start,$job,$job_type,$edu_level,$min,$max,$work_mode,$area)
     {
     $query = $this->fetch_query_job($job,$job_type,$edu_level,$min,$max,$work_mode,$area);
     $query .= ' LIMIT '.$start.', ' . $limit;
     $data = $this->db->query($query);
     $num=$data->num_rows;
     $output = ''; 
     if(isset($price)){
        // $price_filter=str_replace("-",",",$price);
    //   $max = array_reduce($price_filter, function($a, $b) {
    //             return $a > $b ? $a : $b;
    //          });

         
             
         }
     if($data->num_rows() > 0)
      {
         foreach($data->result_array() as $row)
         {
           $c_name = $row['company_name']; 
           $query1 = $this->db->query("SELECT * FROM `job_company` WHERE `id`='$c_name'");
            $count1 = $query1->row_array();
        $job1=str_replace(" ","-",$row['position']);
          $output .= '<div class="col-md-12 home-list-pop-desc home-list-pop  inn-list-pop-desc">
          
									   <a href="'.base_url().'job/list/'.$job1.'/'.$row['id'].'"><h3>'.$row['position'].' </h3>
									   <h4><i class="fa fa-building" aria-hidden="true"></i> '.$count1['company_name'].'</h4>
									   <p><i class="fa fa-map-marker" aria-hidden="true"></i> '.$row['city'].', '.$row['state'].'</p>
										<div class="list-number">
											<ul>
											    <li><i class="fa fa-suitcase" aria-hidden="true"></i> '.$row['experience'].'</li>
												<li><i class="fa fa-inr" aria-hidden="true"></i>'.$row['salary_from'].' - <i class="fa fa-inr" aria-hidden="true"></i>'.$row['salary_to'].' a year</li>
											</ul>
										</div> 
										
										<p>'.substr($row['company_desc'],0,200).'...</p>
										<span class="posted-date">Posted on '.date('d M, Y',strtotime($row['created_date'])).'</span>
									 
										</a>
									</div>';
         }
     
      }
      else
      {
          $output = '<div class="col-sm-3"></div><div class="col-sm-6"><h2>No data found</h2></div>';
      }
    // $output='1';
      return $output;
   }
         public function visitor_counter($slug,$lastNo) {
			
		    	$slug = str_replace("-", " ", $slug);
		
			// return current listing views 
				$this->db->where('id', $lastNo);
				$this->db->select('j_visitor');
				$count = $this->db->get('listing')->row();
			// then increase by one 
				$this->db->where('id', $lastNo);
				$this->db->set('j_visitor', ($count->l_visitor + 1));
				$this->db->update('job');
			
		}
		 
}

?>