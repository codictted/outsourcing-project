<?php
	class Dropdown_model extends CI_Model {


		public function get_business_nature() {

			$this->db->from("business_nature");
			$this->db->where("status", 0);
			$query = $this->db->get();
			return $query->result();
		}

		public function get_new_client() {

			$this->db->from("client");
			$this->db->where("status", 0);
			$query = $this->db->get();
			return $query->result();
		}

		public function get_job_category() {

			$this->db->from("job_category");
			$this->db->where("status", 0);
			$query = $this->db->get();
			return $query->result();
		}

		public function get_job_position_list($id) {

			$this->db->select("id, name");
			$this->db->from("job_position");
			$this->db->where(array("job_cat" => $id, "status" => 0));
			$query = $this->db->get();
			return $query->result();
		}

		public function get_skill_set() {

			$this->db->from("skill_set");
			$this->db->where("status", 0);
			$query = $this->db->get();
			return $query->result();
		}

		public function get_skill_list($id) {

			$this->db->select("id, name");
			$this->db->from("skill");
			$this->db->where(array("skill_set" => $id, "status" => 0));
			$query = $this->db->get();
			return $query->result();
		}

		public function get_education() {

			$this->db->from("education");
			$this->db->where("status", 0);
			$query = $this->db->get();
			return $query->result();
		}

		public function get_course_list() {

			$this->db->from("course");
			$this->db->where("status", 0);
			$query = $this->db->get();
			return $query->result();
		}

		public function get_bnature($id) {

			$this->db->select("name");
			$this->db->from("business_nature");
			$this->db->where("id", $id);
			$query = $this->db->get();
			return $query->result();
		}

		public function get_benefit() {

			$this->db->from("benefits");
			$this->db->where("status", 0);
			$query = $this->db->get();
			return $query->result();
		}

		public function get_requirement() {

			$this->db->from("requirement");
			$this->db->where("status", 0);
			$query = $this->db->get();
			return $query->result();
		}

		public function get_spoken_lang() {

			$this->db->from("spoken_languages");
			$this->db->where("status", 0);
			$query = $this->db->get();
			return $query->result();
		}

		public function get_religion() {

			$this->db->from("religion");
			$this->db->where("status", 0);
			$query = $this->db->get();
			return $query->result();
		}

		public function check_select_religion($religion_val) {
			
	        $query = $this->db->get_where('religion', array('name' => $religion_val));

	        $count = $query->num_rows(); 

	        if ($count === 0) {
	        	$data = array(
	                'name' => $religion_val,
	                'status' => 0
	            );
	        	$this->db->insert("religion", $data);
	        	return $this->db->insert_id();
	        }
	        else{
	        	$this->db->select("id");
		        $this->db->from("religion");
		        $this->db->where("name", $religion_val);
		        $getID = $this->db->get();

		        foreach ($getID->result() as $row){
				    return $row->id;
				}
	        }

		}

		public function check_select_spoken_language($spoken_val) {
			
	        $query = $this->db->get_where('spoken_languages', array('language' => $spoken_val));

	        $count = $query->num_rows(); 

	        if ($count === 0) {
	        	$data = array(
	                'language' => $spoken_val,
	                'status' => 0
	            );
	        	$this->db->insert("spoken_languages", $data);
	        	return $this->db->insert_id();
	        }
	        else{
	        	$this->db->select("id");
		        $this->db->from("spoken_languages");
		        $this->db->where("language", $spoken_val);
		        $getID = $this->db->get();

		        foreach ($getID->result() as $row){
				    return $row->id;
				}
		        
	        }

		}

	}
?>