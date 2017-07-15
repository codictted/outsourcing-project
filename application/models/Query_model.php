<?php

	class Query_model extends CI_Model {


		public function get_client() {

			$query = $this->db->get("client");
			return $query->result();
		}

		public function get_applicant() {

			$query = $this->db->get("applicant");
			return $query->result();
		}

		// public function get_staff() {

		// 	$query = $this->db->get("staff");
		// 	return $query->result();
		// }
	}
?>