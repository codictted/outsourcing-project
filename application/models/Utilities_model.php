<?php
	class Utilities_model extends CI_Model {

		function __construct() {
			parent::__construct();
			$this->load->database();
		}

		public function get_rate() {
		    $query = $this->db->select('jobmatch_rate')->from('jobmatch_rate')->where('flag', 1)->get();
		    return $query->row()->jobmatch_rate;
		}

		public function update_rate($newrate) {
			$this->db->set("jobmatch_rate", $newrate);
			$this->db->update("jobmatch_rate");    
		}

		public function get_educ_attain() {
			$this->db->select("*");
			$this->db->from("educ_attainment");
			$this->db->where("flag != 3");
			$query = $this->db->get();

			return $query->result();
		}

		//status
		public function status_educ_attain($id, $data) {
			$this->db->where("educ_attainment_id", $id);
			$this->db->update("educ_attainment", $data);
			return $this->db->affected_rows();
		}

		//converter
		public function educ_attain_col_status_converter($educ_attain) {
			
	        $this->db->select("*");
		    $this->db->from("educ_attainment");
		    $this->db->where("educ_attainment", $educ_attain);
		    $getFlag = $this->db->get();
		    $count = $getFlag->num_rows(); 

		        foreach ($getFlag->result() as $row){
				    if($count > 0){
				    	if($row->flag == 3){
				    		$id = $row->educ_attainment_id;
					    	$data = array(
				                'flag' => 0
				            );
				            $this->db->where("educ_attainment_id", $id);
							$this->db->update("educ_attainment", $data);
							return $count;
				    	}
				    	else{
				    		return 0;
				    	}
				    }
				}
			return 0;
		}

		//insert
		public function insert_educ_attain($data) {
			$this->db->insert("educ_attainment", $data);
		}

		//update
		public function update_educ_attain($id, $data) {
			$this->db->where("educ_attainment_id", $id);
			$this->db->update("educ_attainment", $data);
			return $this->db->affected_rows();
		}

		//delete
		public function delete_educ_attain($id) {
			$this->db->where("educ_attainment_id", $id);
			$this->db->set("flag", 3);
			$this->db->update("educ_attainment");
		}

		public function get_agency_email() {
		    $this->db->select("*");
			$this->db->from("agency_default_email");
			$query = $this->db->get();
			return $query->result();
		}

		public function update_agency_email($email, $pword) {
			$this->db->set("agency_email", $email);
			$this->db->set("agency_pword", $pword);
			$this->db->update("agency_default_email");
		}
	}
?>