<?php
	class Applicant_model extends CI_Model {


		public function insert_applicant($data) {

			$this->db->insert("applicant", $data);
			$this->db->select_max("id");
			$this->db->from("applicant");
			$query = $this->db->get();
			return $query->result();
		}

		public function insert_descendants($data) {

			$this->db->insert("applicant_descendant", $data);
		}

		public function insert_exp($data) {

			$this->db->insert("applicant_experience", $data);
		}

		public function insert_skills($data) {

			$this->db->insert("applicant_skill", $data);
		}

		public function insert_training($data) {

			$this->db->insert("applicant_seminar", $data);
		}

		public function insert_personality_exam($data) {

			$this->db->insert_batch("applicant_personality", $data);
		}

		public function insert_essay_exam($data) {

			$this->db->insert_batch("applicant_essay", $data);
		}

		public function get_all() {

			$this->db->select("applicant.*, job_position.name as jname");
			$this->db->from("applicant");
			$this->db->join("job_position", "applicant.job_id = job_position.id");
			$this->db->order_by("application_date", "DESC");
			$query = $this->db->get();
			return $query->result();
		}

		public function get_details($id) {

			$this->db->select("applicant.*, applicant.id as appid, job_position.name as jname");
			$this->db->from("applicant");
			$this->db->join("job_position", "applicant.job_id = job_position.id");
			$this->db->where("applicant.id", $id);
			$query = $this->db->get();
			return $query->row();
		}

		public function get_family($id) {

			$this->db->from("applicant_descendant");
			$this->db->where("applicant_id", $id);
			$query = $this->db->get();
			return $query->result();
		}

		public function get_exp($id) {

			$this->db->from("applicant_experience");
			$this->db->where("applicant_id", $id);
			$query = $this->db->get();
			return $query->result();
		}

		public function get_skills($id) {

			$this->db->select("applicant_skill.*, skill.name as skname");
			$this->db->from("applicant_skill");
			$this->db->join("skill", "applicant_skill.skill_id = skill.id");
			$this->db->where("applicant_id", $id);
			$query = $this->db->get();
			return $query->result();
		}

		public function get_sem($id) {

			$this->db->from("applicant_seminar");
			$this->db->where("applicant_id", $id);
			$query = $this->db->get();
			return $query->result();
		}

		public function get_personality($id) {

			$this->db->select("applicant_personality.*, personality_exam.question");
			$this->db->from("applicant_personality");
			$this->db->join("personality_exam", "applicant_personality.question = personality_exam.id");
			$this->db->where("applicant_id", $id);
			$query = $this->db->get();
			return $query->result();
		}

		public function get_essay($id) {

			$this->db->select("applicant_essay.*, essay_question.question");
			$this->db->from("applicant_essay");
			$this->db->join("essay_question", "applicant_essay.question = essay_question.id");
			$this->db->where("applicant_id", $id);
			$query = $this->db->get();
			return $query->result();
		}

		public function get_app_skills($id) {

			$this->db->select("skill.id");
			$this->db->from("applicant");
			$this->db->join("applicant_skill", "applicant.id = applicant_skill.applicant_id");
			$this->db->join("skill", "applicant_skill.skill_id = skill.id");
			$this->db->where("applicant.id", $id);
			$query = $this->db->get();

			return $query->result();
		}

	}
?>