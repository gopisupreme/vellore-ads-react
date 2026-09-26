<?php
	class Listing_Model extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
			$this->db->db_debug = true;
			
		}
		
		public function get_listitem_usingid($id){
		    
		    if($id)
		    {
		    $this->db->select('listing.*,ROUND(avg(reviews.r_rating),1) as avg_rating, COUNT(reviews.r_postid) as total_review');
            $this->db->from('listing');
            $this->db->join('reviews', 'reviews.r_postid = listing.l_id and reviews.r_status="active"');
		    
            $this->db->where('listing.l_id', $id );
            
            $this->db->group_by('listing.l_id'); 
            $query = $this->db->get();
            return $query->row_array(); 
		    }
		    
		}

		

		public function get_listing_all($catagory, $subcatagory, $fetaures, $rating, $city, $limit, $offset = ''){

		    $this->db->db_debug = true;
		    
		    $this->db->select('listing.*,ROUND(avg(reviews.r_rating),1) as avg_rating, COUNT(reviews.r_postid) as total_review ');
		    $this->db->from('listing');
		    $this->db->join('reviews', 'reviews.r_postid = listing.l_id and reviews.r_status="active"');
		   
		    //$this->db->join('category', 'category.c_name = listing.l_category');
		    //$this->db->join('sub_category', 'sub_category.c_id = category.c_id');
		    //$this->db->join('location', 'location.loc_city = listing.l_city');
		    //$this->db->join('categories', 'categories.id = posts.category_id');
		    
		    
		    $ratingstring="";
		    if($rating) 
		    {
		        $i=1;
		        foreach ($rating as & $value) {
                    if($i==1)
                    $ratingstring=' avg_rating = "'.$value.'" ';
                    else
                    $ratingstring .=' OR avg_rating = "'.$value.'" ';
                    
                     $i++;
		        }  
		        
		        $this->db->having($ratingstring);
		       

		    }
		    
		        foreach ($subcatagory as & $value) {
		            //echo $value;
		            $this->db->or_like('listing.l_subcategory', $value );
                    
		        }  
		        
		        
		        
		        
		    
		    
		    
		   
		    
		    
		        
	        foreach ($fetaures as & $value) {
	           
	        
	            switch ($value) {
                    case 'trusted':
                        $this->db->where('listing.l_trusted', "1");
                        break;
                    case 'verified':
                        $this->db->where('listing.l_verified', "1");
                        break;
                    case 'premium':
                        $this->db->where('listing.l_type', 'Premium');
                    break;    
                    
                }
                
	        }  
		    
		    
		   


		    
            if($catagory)
                $this->db->like('listing.l_category', $catagory );
            if($city)
                $this->db->where('listing.l_city', $city );
                             
            $this->db->group_by('listing.l_id'); 
            


            $this->db->limit($limit,$offset);
            $this -> db -> order_by('FIELD ( listing.l_type, "Premium", "platinum", "gold", "free" )');
            $data = $this->db->get()->result();
            return $data;
            
            
            


		    
		}
		
		public function get_listing_subcategory($data,$city){
		    
            $this->db->db_debug = true;
		    
		    $this->db->select('name,s_id');
		    $this->db->from('sub_category');
		    
		    $this->db->join('category', 'category.c_id = sub_category.c_id');
		    $this->db->join('listing', 'listing.l_category = category.c_name');
		    $this->db->join('location', 'location.loc_city = listing.l_city');
		    
		    
		    if($data)
                $this->db->like('listing.l_category', $data );
            if($city)
                $this->db->where('listing.l_city', $city );
                
            $this->db->group_by('sub_category.s_id'); 
            

            $data = $this->db->get()->result();
            
            return $data;
                
                
	
        
		}
		
		
		public function get_subcategory_bycategory($cat=null){
		    
            $this->db->select('*');
            $this->db->from('sub_category');
	        $query = $this->db->get();
            return $query->result_array(); 
                
                
	
        
		}
		
		
		public function get_country_by_city($loc){
		    
            $this->db->select('loc_country');
            $this->db->from('location');
            $this->db->where('loc_name', $loc );
            $this->db->or_where('loc_city =', $loc);
            return $this->db->get()->row()->loc_country;
        
		}
		
		public function get_listing_count($cat=null,$city=null,$status=null){
		    
            if($cat)
                $this->db->where('l_category', $cat );
            if($city)
                $this->db->where('l_city', $city );
            if($status)
                $this->db->where('l_status', $status );
                
            $query = $this->db->get('listing');
            return $query->num_rows();
        
		}
		
		
		
		
		public function get_catagory_list($name=null,$status=null){
		    if($name)
		    {
		    $this->db->select('*');
            $this->db->from('category');
		    
            if($name)
                $this->db->where('c_name', $name );
           
            if($status)
                $this->db->where('c_status', $status );
            
            $query = $this->db->get();
            return $query->row_array(); 
		    }
		    else
		    {
		        $this->db->select('*');
                $this->db->from('category');
		        if($status)
                $this->db->where('c_status', $status );
                $query = $this->db->get();
                return $query->result_array(); 
		    }
        
		}
		
		
		
		
		
		public function get_average_rating($id){
		    $this->db->db_debug = true;
            $this->db->select('avg(r_rating) as avg_rating');
            $this->db->from('reviews');
            $this->db->where('r_postid', $id );
            $this->db->where('r_status', 'active' );
            return $this->db->get()->row()->avg_rating;
        
		}
		
		public function get_total_reviews($id){
		    $this->db->db_debug = true;
            $this->db->where('r_postid', $id );
            $this->db->where('r_status', 'active' );
            $query = $this->db->get('reviews');
            return $query->num_rows();
        
        
		}
		
		
		
		
		
	}