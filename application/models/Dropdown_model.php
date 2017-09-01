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

		public function get_educ_attain() {
			$this->db->select("*");
			$this->db->from("educ_attainment");
			$this->db->where("flag = 0");
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

		//essay questions
		public function get_essayq() {
			$this->db->select("*");
			$this->db->from("essay_question");
			$this->db->where("flag = 0");
			$query = $this->db->get();
			return $query->result();
		}
	}
?>