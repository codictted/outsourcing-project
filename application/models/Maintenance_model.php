<?php
	class Maintenance_model extends CI_Model {

		//insert data
		public function insert_req_document($data) {

			$this->db->insert("requirement", $data);
		}

		public function insert_category($data) {

			$this->db->insert("job_category", $data);
		}

		public function insert_job_position($data) {

			$this->db->insert("job_position", $data);
			return $this->db->insert_id();
		}

		public function insert_job_position_skill($data) {

			$this->db->insert("job_position_skill", $data);
		}

		//update data
		public function update_req_document($id, $data) {
			$this->db->where("id", $id);
			$this->db->update("requirement", $data);
			return $this->db->affected_rows();
		}

		public function update_category($id, $data) {
			$this->db->where("id", $id);
			$this->db->update("job_category", $data);
			return $this->db->affected_rows();
		}

		public function update_job_position($id, $data) {
			$this->db->where("id", $id);
			$this->db->update("job_position", $data);
			return $this->db->affected_rows();
		}

		public function update_job_position_skill($id, $skill, $skill_set) {
			$this->db->set('status', 1);
			$this->db->where('job_position_id', $id);
			$this->db->update('job_position_skill'); 

            foreach ($skill as $index => $skillVal) {
                $dataSkill[$index] = $this->check_select_skill($skill_set, $skillVal);
            }

				foreach ($dataSkill as $index => $value) {
					$query = $this->db->get_where("job_position_skill", array('job_position_id' => $id, 'skill_id' => $value, 'status' => 1));
					$count = $query->num_rows();

						if($count == 0){
							$data = array(
		                        "job_position_id" => $id,
		                        "skill_id" => $value,
		                        "status" => 0
		                    );
		                    $this->db->insert("job_position_skill", $data);
						}
						else{
							$this->db->set('status', 0);
							$this->db->where('job_position_id', $id);
							$this->db->where('skill_id', $value);
							$this->db->update('job_position_skill'); 
						}
				}
		}
		
		//delete data
		public function delete_req_document($id, $data) {
			$this->db->where("id", $id);
			$this->db->update("requirement", $data);
			return $this->db->affected_rows();
		}

		public function delete_category($id, $data) {
			$this->db->where("id", $id);
			$this->db->update("job_category", $data);
			return $this->db->affected_rows();
		}

		public function delete_job_position($id, $data) {
			$this->db->where("id", $id);
			$this->db->update("job_position", $data);
			return $this->db->affected_rows();
		}

		//status data
		public function status_req_document($id, $data) {
			$this->db->where("id", $id);
			$this->db->update("requirement", $data);
			return $this->db->affected_rows();
		}

		public function status_category($id, $data) {
			$this->db->where("id", $id);
			$this->db->update("job_category", $data);
			return $this->db->affected_rows();
		}

		public function status_job($id, $data) {
			$this->db->where("id", $id);
			$this->db->update("job_position", $data);
			return $this->db->affected_rows();
		}

		//check data
		public function check_select_skill($skill_set_val, $skillVal) {
			
	        $query = $this->db->get_where('skill', array('name' => $skillVal, 'skill_set' => $skill_set_val));
	        $count = $query->num_rows();

	        if ($count === 0) {
	        	$data = array(
	                'name' => $skillVal,
	                'skill_set' => $skill_set_val,
	                'status' => 0
	            );
	        	$this->db->insert("skill", $data);
	        	return $this->db->insert_id();
	        }
	        else{
	        	$this->db->select("id");
		        $this->db->from("skill");
		        $this->db->where("name", $skillVal);
		        $getID = $this->db->get();

		        foreach ($getID->result() as $row){
				    return $row->id;
				}
	        }
		}

		public function check_select_skill_set($skill_set_val) {
			
	        $query = $this->db->get_where('skill_set', array('id' => $skill_set_val));

	        $count = $query->num_rows(); 

	        if ($count === 0) {
	        	$data = array(
	                'name' => $skill_set_val,
	                'status' => 0
	            );
	        	$this->db->insert("skill_set", $data);
	        	return $this->db->insert_id();
	        }
	        else{
		        return $skill_set_val;
	        }

		}

		public function category_col_status_converter($cat_name) {
			
	        $this->db->select("*");
		    $this->db->from("job_category");
		    $this->db->where("name", $cat_name);
		    $getStatus = $this->db->get();
		    $count = $getStatus->num_rows(); 

		        foreach ($getStatus->result() as $row){
				    if($count > 0){
				    	if($row->status == 3){
				    		$id = $row->id;
					    	$data = array(
				                'status' => 0
				            );
				            $this->db->where("id", $id);
							$this->db->update("job_category", $data);
							return $count;
				    	}
				    	else{
				    		return 0;
				    	}
				    }
				}
			return 0;
		}

		public function requirement_col_status_converter($req_name, $req_follow) {
			
	        $this->db->select("*");
		    $this->db->from("requirement");
		    $this->db->where("requirement", $req_name);
		    $getStatus = $this->db->get();
		    $count = $getStatus->num_rows(); 

		        foreach ($getStatus->result() as $row){
		        	$id = $row->id;
				    if($count > 0){
				    	if($row->status == 3){
					    	$data = array(
					    		'is_required' => $req_follow,
				                'status' => 0
				            );
				            $this->db->where("id", $id);
							$this->db->update("requirement", $data);
							return $count;
				    	}
				    	elseif($row->is_required != $req_follow){
				    		$data = array(
								'is_required' => $req_follow
							);
							$this->db->where("id", $id);
							$this->db->update("requirement", $data);
							return $count;
				    	}
				    	else{
				    		return 0;
				    	}
				    }
				}
			return 0;
		}

		public function job_position_col_status_converter($job_name, $job_cat, $job_sf, $skill_set, $skill) {
			
	        $this->db->select("*");
		    $this->db->from("job_position");
		    $this->db->where("name", $job_name);
		    $getStatus = $this->db->get();
		    $count = $getStatus->num_rows(); 

		        foreach ($getStatus->result() as $row){
		        	$skill_set = $this->check_select_skill_set($skill_set);
		        	$id = $row->id;
				    if($count > 0){
				    	if($row->status == 3){
					    	$data = array(
					    		'name' => $job_name,
					    		'job_cat' => $job_cat,
					    		'job_skill_set' => $skill_set,
					    		'service_fee' => $job_sf,
				                'status' => 0
				            );
				            $this->db->where("id", $id);
							$this->db->update("job_position", $data);
							$this->update_job_position_skill($id, $skill, $skill_set);
				    	}

				    	if($row->job_cat != $job_cat){
				    		$data = array(
								'job_cat' => $job_cat
							);
							$this->db->where("id", $id);
							$this->db->update("job_position", $data);
				    	}

				    	if($row->job_skill_set != $skill_set){
				    		$data = array(
								'job_skill_set' => $skill_set
							);
							$this->db->where("id", $id);
							$this->db->update("job_position", $data);
				    	}

				    	if($row->service_fee != $job_sf){
				    		$data = array(
								'service_fee' => $job_sf
							);
							$this->db->where("id", $id);
							$this->db->update("job_position", $data);
				    	}

				    	$this->db->select("s.*");
					    $this->db->from("job_position_skill jps");
					    $this->db->join("skill s", "jps.skill_id = s.id", "left");
					    $this->db->where("jps.job_position_id", $id);
					    $this->db->order_by("jps.skill_id");
					    $getSkill = $this->db->get();

					    foreach ($getSkill->result() as $index => $skillVal){
		        			$skill_name[$index] = $skillVal->name;

		        		}
		        	
		        		if($skill_name != $skill){
		        			$this->update_job_position_skill($id, $skill, $skill_set);
		        			return $count;
		        		}
		        		else{
		        			return 0;
		        		}
		        		
				    }
				}
			return 0;
		}

		public function double_col_checker($id, $job_name, $tableName, $col1, $col2) {
			
	        $query = $this->db->get_where($tableName, array($col1 => $id, $col2 => $job_name));

	        $count = $query->num_rows(); 
	        return $count;

		}

		public function get_req_document_check_details($id) {
			
			$this->db->select("*");
			$this->db->from("requirement");
			$this->db->where("id", $id); 
			$query = $this->db->get();
			return $query->result();
		}

		public function get_category_check_details($id) {
			
			$this->db->select("*");
			$this->db->from("job_category");
			$this->db->where("id", $id); 
			$query = $this->db->get();
			return $query->result();
		}

		public function get_position_check_details($id) {
			
			$this->db->select("*");
			$this->db->from("job_position");
			$this->db->where("id", $id); 
			$query = $this->db->get();
			return $query->result();
		}

		//get data
		public function get_job_position() {
			
			$this->db->select("jp.*, jc.name as JCName");
			$this->db->from("job_position jp");
			$this->db->join("job_category jc", "jp.job_cat = jc.id");
			$this->db->where("jp.status != 3"); 
			$query = $this->db->get();
			return $query->result();
		}

		public function get_req_document() {
			
			$this->db->select("*");
			$this->db->from("requirement");
			$this->db->where("status != 3"); 
			$query = $this->db->get();
			return $query->result();
		}

		public function get_job_category() {
			
			$this->db->select("*");
			$this->db->from("job_category");
			$this->db->where("status != 3"); 
			$query = $this->db->get();
			return $query->result();
		}

		public function get_skill_set() {
			
			$this->db->select("*");
			$this->db->from("skill_set");
			$this->db->where("status != 3"); 
			$query = $this->db->get();
			return $query->result();
		}

		public function get_skill() {
			
			$this->db->select("*");
			$this->db->from("skill");
			$this->db->where("status != 3"); 
			$query = $this->db->get();
			return $query->result();
		}

		public function get_req_document_details($id) {
			
			$this->db->select("*");
			$this->db->from("requirement");
			$this->db->where("id", $id); 
			$query = $this->db->get();
			return $query->row();
		}

		public function get_category_details($id) {
			
			$this->db->select("*");
			$this->db->from("job_category");
			$this->db->where("id", $id); 
			$query = $this->db->get();
			return $query->row();
		}

		public function get_job_position_details($id) {
			
			$this->db->select("jp.*, jps.skill_id");
			$this->db->from("job_position jp");
			$this->db->join("job_position_skill jps", "jp.id = jps.job_position_id", "left");
			$this->db->where("jp.id", $id); 
			$this->db->where("jps.status != 1"); 
			$query = $this->db->get();
			return $query->result();
		}

		public function get_job_position_all_details($id) {
			
			$this->db->select("jp.*, jc.name as JcName, ss.name as SSName, s.name as SName");
			$this->db->from("job_position jp");
			$this->db->join("job_position_skill jps", "jp.id = jps.job_position_id", "left");
			$this->db->join("job_category jc", "jp.job_cat = jc.id", "left");
			$this->db->join("skill_set ss", "jp.job_skill_set = ss.id", "left");
			$this->db->join("skill s", "jps.skill_id = s.id", "left");
			$this->db->where("jp.id", $id); 
			$this->db->where("jps.status != 1"); 
			$query = $this->db->get();
			return $query->result();
		}

		public function get_select_skill_name($id) {
			
			$this->db->select("name as id, name as text");
			$this->db->from("skill");
			$this->db->where(array("skill_set" => $id, "status" => 0)); 
			$query = $this->db->get();
			return $query->result();
		}

		public function get_req_document_id() {
			
			$this->db->select("COUNT(*) as num");
			$this->db->from("requirement");
			$query = $this->db->get();
			return $query->row();
		}

		public function get_category_id() {
			
			$this->db->select("COUNT(*) as num");
			$this->db->from("job_category");
			$query = $this->db->get();
			return $query->row();
		}

		public function get_job_position_id() {
			
			$this->db->select("COUNT(*) as num");
			$this->db->from("job_position");
			$query = $this->db->get();
			return $query->row();
		}
		
	}

?>
