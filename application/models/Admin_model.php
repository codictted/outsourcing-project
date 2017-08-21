<?php
	class Admin_model extends CI_Model {

		public function client_list_matching($id) {

			$query = $this->db->query("SELECT c.comp_name, c.full_name, jo.order_id, jo.job_id, jpos.name from client as c JOIN job_order as jo ON c.id = jo.client_id JOIN job_position as jpos ON jpos.id=jo.job_id WHERE jo.job_id = $id");

			return $query->result();
		}
	}
?>