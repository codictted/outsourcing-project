<?php
	class Utilities_model extends CI_Model {

		function __construct() {
			parent::__construct();
			$this->load->database();
		}

		// //JOB MATCH PASS RATE
		// public function get_rate() {
		//     $query = $this->db->select('jobmatch_rate')->from('jobmatch_rate')->get();
		//     return $query->row()->jobmatch_rate;
		// }

		// public function update_rate($newrate) {
		// 	$this->db->set("jobmatch_rate", $newrate);
		// 	$this->db->update("jobmatch_rate");    
		// }

		//EDUC ATTAIN
		public function get_educ_attain() {
			$this->db->select("*");
			$this->db->from("educ_attainment");
			$this->db->where("flag != 3");
			$query = $this->db->get();

			return $query->result();
		}

		public function status_educ_attain($id, $data) {//status
			$this->db->where("educ_attainment_id", $id);
			$this->db->update("educ_attainment", $data);
			return $this->db->affected_rows();
		}

		public function educ_attain_col_status_converter($educ_attain) {//converter
			
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

		public function insert_educ_attain($data) {//insert
			$this->db->insert("educ_attainment", $data);
		}

		public function update_educ_attain($id, $data) {//update
			$this->db->where("educ_attainment_id", $id);
			$this->db->update("educ_attainment", $data);
			return $this->db->affected_rows();
		}

		//AGENCY's EMAIL
		public function get_agency_email() {
		    $this->db->select("*");
			$this->db->from("agency_default_email");
			$query = $this->db->get();
			return $query->result();
		}

		public function update_agency_email($email, $pword) {
			$this->db->set("agency_email_text", $email);
			$this->db->set("agency_email_pword", $pword);
			$this->db->update("agency_default_email");
		}

		// //TEXT MESSAGES
		// public function get_text_message() {
		//     $this->db->select("*");
		// 	$this->db->from("text_messages");
		// 	$query = $this->db->get();
		// 	return $query->result();
		// }

		// public function update_text_message($ji_text_mess, $jo_text_mess) {
		// 	$this->db->set("job_interview_text", $ji_text_mess);
		// 	$this->db->set("job_offer_text", $jo_text_mess);
		// 	$this->db->update("text_messages");
		// }

		//ESSAY QUESTIONS
		public function get_essay_question() {
			$this->db->select("*");
			$this->db->from("essay_question");
			$query = $this->db->get();

			return $query->result();
		}

		public function status_essay_question($id, $data) {//status
			$this->db->where("essay_question_id", $id);
			$this->db->update("essay_question", $data);
			return $this->db->affected_rows();
		}

		public function essay_question_col_status_converter($question) {//converter
			
	        $this->db->select("*");
		    $this->db->from("essay_question");
		    $this->db->where("essay_question", $question);
		    $getFlag = $this->db->get();
		    $count = $getFlag->num_rows(); 

		        foreach ($getFlag->result() as $row){
				    if($count > 0){
				    	if($row->flag == 3){
				    		$id = $row->essay_question_id;
					    	$data = array(
				                'flag' => 0
				            );
				            $this->db->where("essay_question_id", $id);
							$this->db->update("essay_question", $data);
							return $count;
				    	}
				    	else{
				    		return 0;
				    	}
				    }
				}
			return 0;
		}

		public function insert_essay_question($data) {//insert
			$this->db->insert("essay_question", $data);
		}

		public function update_essay_question($id, $data) {//update
			$this->db->where("essay_question_id", $id);
			$this->db->update("essay_question", $data);
			return $this->db->affected_rows();
		}
	}
?>