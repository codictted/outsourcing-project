<?php
	class Admin_model extends CI_Model {


		public function get_client_list($id) {

			$query = $this->db->query("SELECT c.comp_name, c.full_name, jo.order_id, jo.job_id, jpos.name from client as c JOIN job_order as jo ON c.id = jo.client_id JOIN job_position as jpos ON jpos.id=jo.job_id WHERE jo.job_id = $id");

			return $query->result();
		}

		public function get_education_name($id) {

			$this->db->select("education");
			$this->db->from("education");
			$this->db->where("id", $id);
			$query = $this->db->get();
			return $query->result();
		}

		public function get_course_name($id) {

			$this->db->select("name");
			$this->db->from("course");
			$this->db->where("id", $id);
			$query = $this->db->get();
			return $query->result();
		}

		public function get_job_name($id) {

			$this->db->select("name");
			$this->db->from("job_position");
			$this->db->where("id", $id);
			$query = $this->db->get();

			return $query->result();
		}

		public function get_skill_name($id) {

			$this->db->from("skill");
			$this->db->where("id", $id);
			$query = $this->db->get();

			return $query->result();
		}

		public function get_job_order_details($id) {

			$this->db->from("job_order");
			$this->db->where("order_id", $id);
			$query = $this->db->get();

			return $query->result();
		}

		public function get_job_order_skills($id) {

			$this->db->select("job_order_skill.skill");
			$this->db->from("job_order_skill");
			$this->db->join("skill", "job_order_skill.skill = skill.id");
			$this->db->where("job_order_skill.job_order_id", $id);
			$query = $this->db->get();

			return $query->result();
		}

		public function get_sms_message(){

			$this->db->select("interview_message1, interview_message2, interview_message3");
			$this->db->from("utilities");
			$query = $this->db->get();

			return $query->result();
		}

		public function insert_interview($data) {

			$this->db->insert("applicant_intervew", $data);
		}

		public function update_applicant_status($id, $stat) {

			$this->db->where("id", $id);
			$this->db->set("status", $stat);
			$this->db->update("applicant");

			return $this->db->affected_rows();
		}

		public function add_remarks($id, $data) {

			$this->db->where("applicant_id", $id);
			$this->db->set("remarks", $data);
			$this->db->update("applicant_intervew");

			return $this->db->affected_rows();
		}

		public function get_client_active_job_orders() {

			$query = $this->db->query("SELECT DISTINCT c.id, c.comp_name, c.full_name, jo.job_id, jpos.name from client as c left JOIN job_order as jo ON c.id = jo.client_id JOIN job_position as jpos ON jpos.id=jo.job_id WHERE jo.status = 0 OR jo.status = 1");

			return $query->result();
		}

		public function get_job_order($id) {

			$query = $this->db->query("SELECT jo.client_id, jo.order_id, jo.job_id, jpos.name FROM job_order as jo JOIN job_position as jpos ON jo.job_id = jpos.id WHERE jo.client_id = $id AND "."(jo.status = 0 OR jo.status = 1)");
			return $query->result();
		}

		public function get_applicant_shortlist($id) {

			$this->db->select("id, first_name, last_name, gender");
			$this->db->from("applicant");
			$this->db->where("status", 5);
			$this->db->where("job_id", $id);
			$query = $this->db->get();

			return $query->result();
		}

		public function update_client_status($id, $stat) {

			$this->db->where("id", $id);
			$this->db->set("status", $stat);
			$this->db->update("client");
		}

		public function post_job_order($data) {

			$this->db->insert("job_order_post", $data);
		}

		public function update_joborder_status($id, $stat) {

			$this->db->where("order_id", $id);
			$this->db->set("status", $stat);
			$this->db->update("job_order");	
		}

		public function get_all_job_post() {

			$this->db->select("job_order.order_id, job_order.description, job_position.name as jname");
			$this->db->from("job_order");
			$this->db->join("job_position", "job_order.job_id = job_position.id", "left");
			$this->db->where("job_order.status", 1);
			$query = $this->db->get();

			return $query->result();
		}

		public function get_job_post($id) {

			$sk = FALSE; $bn = FALSE; $rq = FALSE;
			$query_str = "SELECT ";
			$fields = array("employer", "slot", "age", "education", "course", "single",
				"height", "weight", "urgent", "skills", "benefits", "requirements", "description");
			
			foreach($fields as $field) {

				switch($field) {
					case "employer":
						$query_str .= "client_id, ";
						break;
					case "slot":
						$query_str .= "total_openings, num_male, num_female, ";
						break;
					case "age":
						$query_str .= "min_age, max_age, ";
						break;
					case "skills":
						$sk = TRUE;
						break;
					case "benefits":
						$bn = TRUE;
						break;
					case "requirements":
						$rq = TRUE;
						break;
					default:
						$query = $this->db->query("SELECT ".$field." FROM job_order_post WHERE order_id = $id");
						$qa = $query->result();
						if($qa[0]->$field == 0);
						$query_str .= $field.", ";
						break;
				}
			}
			$query_str = substr($query_str, 0, strlen($query_str)-2);
			$query_str .= " FROM job_order WHERE order_id = $id";
			$query = $this->db->query($query_str);
			$query = $query->result();
			if($sk){

				$this->db->from("job_order_skill");
				$this->db->where("job_order_id", $id);
				$raw = $this->db->get();
				array_push($query, $raw->result());
			}

			if($bn){

				$this->db->from("job_order_benefit");
				$this->db->where("job_order_id", $id);
				$raw = $this->db->get();
				array_push($query, $raw->result());
			}

			if($rq){

				$this->db->from("job_order_req");
				$this->db->where("job_order_id", $id);
				$raw = $this->db->get();
				array_push($query, $raw->result());
			}
			
			return $query;
		}

		public function get_applicant_require($id) {

			$this->db->select("applicant_requirement.status as is_submitted, requirement.*");
			$this->db->from("applicant_requirement");
			$this->db->join("requirement", "applicant_requirement.requirement_id = requirement.id");
			$this->db->where("applicant_requirement.applicant_id", $id);
			$query = $this->db->get();
			return $query->result();
		}

		public function insert_shortlist($data) {

			$this->db->insert("shortlist", $data);
		}

		public function get_shortlist_det($id) {

			$query = $this->db->query("SELECT sh.*, cl.comp_name, cl.full_name, jpos.name as jname FROM shortlist as sh JOIN job_order as jo ON jo.order_id = sh.order_id JOIN job_position as jpos ON jpos.id = jo.job_id JOIN client as cl ON cl.id = sh.client_id WHERE sh.applicant_id = $id AND sh.status = 0");
			return $query->result();
		}
	}
?>