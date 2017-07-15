<?php
	class Dashboard_model extends CI_Model {


		public function get_new_applicants() {

			$this->db->from("applicant");
			$this->db->where("status", 0);
			$query = $this->db->get();
			return $query->num_rows();
		}

		public function get_new_job_orders() {

			$this->db->from("job_order");
			$this->db->where("status", 0);
			$query = $this->db->get();
			return $query->num_rows();
		}

	}
?>