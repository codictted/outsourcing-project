<?php
	class Staff_model extends CI_Model {

		public function get_all() {

			$query = $this->db->query("SELECT st.*, app.first_name, app.last_name, app.birthdate, app.gender, jpos.name AS jname, st.*, cl.comp_name, cl.full_name FROM staff AS st JOIN applicant AS app ON st.applicant_id = app.id JOIN client AS cl ON cl.id = st.client_id JOIN job_position AS jpos ON app.job_id = jpos.id");

			return $query->result();
		}
	}
?>