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
	}
?>