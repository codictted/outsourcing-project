<?php
	class Reports_model extends CI_Model {

		//get
		public function get_print_client_cjo_date_detail_count($minDate, $maxDate) {
				$this->db->select("count(jo.client_id) as countClient, (case when c.comp_name IS NULL then c.full_name else c.comp_name end) as clientName, DATE_FORMAT(jo.order_date, '%M %d, %Y') as clientDate");
				$this->db->from("job_order jo");
				$this->db->join("client c","jo.client_id = c.id","left");
				$this->db->where("DATE_FORMAT(jo.order_date, '%Y-%m-%d') BETWEEN '$minDate' AND '$maxDate'");
				$this->db->order_by("countClient"); 
   	 			$this->db->group_by("clientName, clientDate");
				$get_client_date_count = $this->db->get();
			
				return $get_client_date_count->result();
		}

		public function get_print_client_cjo_date_sum_detail_count($minDate, $maxDate) {
				$this->db->select("count(jo.client_id) as countClient, (case when c.comp_name IS NULL then c.full_name else c.comp_name end) as clientName");
				$this->db->from("job_order jo");
				$this->db->join("client c","jo.client_id = c.id","left");
				$this->db->where("DATE_FORMAT(jo.order_date, '%Y-%m-%d') BETWEEN '$minDate' AND '$maxDate'");
				$this->db->order_by("countClient"); 
   	 			$this->db->group_by("clientName");
				$get_client_date_count = $this->db->get();
				
				return $get_client_date_count->result();
		}

		public function get_print_client_cjo_date_sum_count($minDate, $maxDate) {
				$this->db->select("count(jo.client_id) as clientTotal");
				$this->db->from("job_order jo");
				$this->db->join("client c","jo.client_id = c.id","left");
				$this->db->where("DATE_FORMAT(jo.order_date, '%Y-%m-%d') BETWEEN '$minDate' AND '$maxDate'");
				$get_client_date_count = $this->db->get();
			
				return $get_client_date_count->result();
		}

		public function get_print_client_cns_date_detail_count($minDate, $maxDate) {
				$this->db->select("count(s.staff_id) as countStaff, (case when c.comp_name IS NULL then c.full_name else c.comp_name end) as clientName, DATE_FORMAT(s.deployment_date, '%M %d, %Y') as clientDate");
				$this->db->from("staff s");
				$this->db->join("client c","s.client_id = c.id","left");
				$this->db->join("applicant a","s.applicant_id = a.id","left");
				$this->db->where("DATE_FORMAT(s.deployment_date, '%Y-%m-%d') BETWEEN '$minDate' AND '$maxDate'");
				$this->db->order_by("countStaff"); 
   	 			$this->db->group_by("clientName, clientDate");
				$get_client_date_count = $this->db->get();
			
				return $get_client_date_count->result();
		}

		public function get_print_client_cns_date_sum_detail_count($minDate, $maxDate) {
				$this->db->select("count(s.staff_id) as countStaff, (case when c.comp_name IS NULL then c.full_name else c.comp_name end) as clientName");
				$this->db->from("staff s");
				$this->db->join("client c","s.client_id = c.id","left");
				$this->db->join("applicant a","s.applicant_id = a.id","left");
				$this->db->where("DATE_FORMAT(s.deployment_date, '%Y-%m-%d') BETWEEN '$minDate' AND '$maxDate'");
				$this->db->order_by("countStaff"); 
   	 			$this->db->group_by("clientName");
				$get_client_date_count = $this->db->get();
				
				return $get_client_date_count->result();
		}

		public function get_print_client_cns_date_sum_count($minDate, $maxDate) {
				$this->db->select("count(s.client_id) as clientTotal");
				$this->db->from("staff s");
				$this->db->join("client c","s.client_id = c.id","left");
				$this->db->where("DATE_FORMAT(deployment_date, '%Y-%m-%d') BETWEEN '$minDate' AND '$maxDate'");
				$get_client_date_count = $this->db->get();
			
				return $get_client_date_count->result();
		}


		public function get_print_applicant_ama_date_detail_count($minDate, $maxDate) {
				$this->db->select("concat(first_name, ' ' , (case when middle_name IS NULL then '' else middle_name end), ' ', last_name) as appName, DATE_FORMAT(application_date, '%M %d, %Y') as appDate");
				$this->db->from("applicant");
				$this->db->where("status < 4");
				$this->db->where("DATE_FORMAT(application_date, '%Y-%m-%d') BETWEEN '$minDate' AND '$maxDate'");
				$this->db->order_by("application_date"); 
   	 			$this->db->group_by("appName, appDate");
				$get_app_date_count = $this->db->get();
			
				return $get_app_date_count->result();
		}

		public function get_print_applicant_ama_date_sum_detail_count($minDate, $maxDate) {
				$this->db->select("count(id) as countApp, DATE_FORMAT(application_date, '%M %d, %Y') as appDate");
				$this->db->from("applicant");
				$this->db->where("status < 4");
				$this->db->where("DATE_FORMAT(application_date, '%Y-%m-%d') BETWEEN '$minDate' AND '$maxDate'");
				$this->db->order_by("countApp"); 
   	 			$this->db->group_by("appDate");

				$get_app_date_count = $this->db->get();
				
				return $get_app_date_count->result();
		}

		public function get_print_applicant_ama_date_sum_count($minDate, $maxDate) {
				$this->db->select("count(id) as appTotal");
				$this->db->from("applicant");
				$this->db->where("status < 4");
				$this->db->where("DATE_FORMAT(application_date, '%Y-%m-%d') BETWEEN '$minDate' AND '$maxDate'");
				$get_app_date_count = $this->db->get();
			
				return $get_app_date_count->result();
		}

		public function get_print_applicant_aaa_date_detail_count($minDate, $maxDate) {
				$this->db->select("concat(first_name, ' ' , (case when middle_name IS NULL then '' else middle_name end), ' ', last_name) as appName, city as appLoc");
				$this->db->from("applicant");
				$this->db->where("status < 4");
				$this->db->where("DATE_FORMAT(application_date, '%Y-%m-%d') BETWEEN '$minDate' AND '$maxDate'");
				$this->db->order_by("application_date"); 
   	 			$this->db->group_by("appName, appLoc");
				$get_app_date_count = $this->db->get();
			
				return $get_app_date_count->result();
		}

		public function get_print_applicant_aaa_date_sum_detail_count($minDate, $maxDate) {
				$this->db->select("count(id) as countApp, city as appLoc");
				$this->db->from("applicant");
				$this->db->where("status < 4");
				$this->db->where("DATE_FORMAT(application_date, '%Y-%m-%d') BETWEEN '$minDate' AND '$maxDate'");
				$this->db->order_by("countApp"); 
   	 			$this->db->group_by("appLoc");
				$get_app_date_count = $this->db->get();
				
				return $get_app_date_count->result();
		}

		public function get_print_applicant_aaa_date_sum_count($minDate, $maxDate) {
				$this->db->select("count(id) as appTotal");
				$this->db->from("applicant");
				$this->db->where("status < 4");
				$this->db->where("DATE_FORMAT(application_date, '%Y-%m-%d') BETWEEN '$minDate' AND '$maxDate'");
				$get_app_date_count = $this->db->get();
			
				return $get_app_date_count->result();
		}

		public function get_print_job_moj_date_detail_count($minDate, $maxDate) {
				$this->db->select("count(jo.job_id) as countJob, jp.name as jobName, DATE_FORMAT(jo.order_date, '%M %d, %Y') as jobDate");
				$this->db->from("job_order jo");
				$this->db->join("job_position jp","jo.job_id = jp.id","left");
				$this->db->where("DATE_FORMAT(jo.order_date, '%Y-%m-%d') BETWEEN '$minDate' AND '$maxDate'");
				$this->db->order_by("countJob"); 
   	 			$this->db->group_by("jobName, jobDate");
				$get_job_moj_count = $this->db->get();
			
				return $get_job_moj_count->result();
		}

		public function get_print_job_moj_date_sum_detail_count($minDate, $maxDate) {
				$this->db->select("count(jo.job_id) as countJob, jp.name as jobName");
				$this->db->from("job_order jo");
				$this->db->join("job_position jp","jo.job_id = jp.id","left");
				$this->db->where("DATE_FORMAT(jo.order_date, '%Y-%m-%d') BETWEEN '$minDate' AND '$maxDate'");
				$this->db->order_by("countJob"); 
   	 			$this->db->group_by("jobName");
				$get_job_moj_count = $this->db->get();
				
				return $get_job_moj_count->result();
		}

		public function get_print_job_moj_date_sum_count($minDate, $maxDate) {
				$this->db->select("count(jo.job_id) as jobTotal");
				$this->db->from("job_order jo");
				$this->db->join("job_position jp","jo.job_id = jp.id","left");
				$this->db->where("DATE_FORMAT(order_date, '%Y-%m-%d') BETWEEN '$minDate' AND '$maxDate'");
				$get_job_moj_count = $this->db->get();
			
				return $get_job_moj_count->result();
		}

		public function get_print_job_maj_date_detail_count($minDate, $maxDate) {
				$this->db->select("count(a.job_id) as countJob, jp.name as jobName, DATE_FORMAT(a.application_date, '%M %d, %Y') as jobDate");
				$this->db->from("applicant a");
				$this->db->join("job_position jp","a.job_id = jp.id","left");
				$this->db->where("DATE_FORMAT(a.application_date, '%Y-%m-%d') BETWEEN '$minDate' AND '$maxDate'");
				$this->db->order_by("countJob"); 
   	 			$this->db->group_by("jobName, jobDate");
				$get_job_maj_count = $this->db->get();
			
				return $get_job_maj_count->result();
		}

		public function get_print_job_maj_date_sum_detail_count($minDate, $maxDate) {
				$this->db->select("count(a.job_id) as countJob, jp.name as jobName");
				$this->db->from("applicant a");
				$this->db->join("job_position jp","a.job_id = jp.id","left");
				$this->db->where("DATE_FORMAT(a.application_date, '%Y-%m-%d') BETWEEN '$minDate' AND '$maxDate'");
				$this->db->order_by("countJob"); 
   	 			$this->db->group_by("jobName");
				$get_job_maj_count = $this->db->get();
				
				return $get_job_maj_count->result();
		}

		public function get_print_job_maj_date_sum_count($minDate, $maxDate) {
				$this->db->select("count(a.job_id) as jobTotal");
				$this->db->from("applicant a");
				$this->db->join("job_position jp","a.job_id = jp.id","left");
				$this->db->where("DATE_FORMAT(a.application_date, '%Y-%m-%d') BETWEEN '$minDate' AND '$maxDate'");
				$get_job_maj_count = $this->db->get();
			
				return $get_job_maj_count->result();
		}

		//base_date
		public function get_base_date_summary($col_date, $tableName) {
			
			$this->db->select("MIN($col_date) as min, MAX($col_date) as max");
			$this->db->from("$tableName");
			$get_base_date = $this->db->get();

			return $get_base_date->result();
		}

		public function get_base_status_date_summary($col_date, $col_status, $tableName) {
			
			$this->db->select("MIN($col_date) as min, MAX($col_date) as max");
			$this->db->from("$tableName");
			$this->db->where("$col_status");
			$get_base_date = $this->db->get();

			return $get_base_date->result();
		}

		public function get_client_job_order_date_summary() {
			
			$this->db->select("MIN(order_date) as minDate, MAX(order_date) as maxDate");
			$this->db->from("job_order");
			$get_client_min_max = $this->db->get();


			foreach ($get_client_min_max->result() as $min_max) {
				$this->db->select("count(jo.client_id) as countClient, (case when c.comp_name IS NULL then c.full_name else c.comp_name end) as clientName, DATE_FORMAT(jo.order_date, '%M %d, %Y') as clientDate");
				$this->db->from("job_order jo");
				$this->db->join("client c","jo.client_id = c.id","left");
				$this->db->where("jo.order_date BETWEEN '$min_max->minDate' AND '$min_max->maxDate'");
				$this->db->order_by("jo.order_date"); 
   	 			$this->db->group_by("clientName, clientDate");
				$get_client_count = $this->db->get();
				
				return $get_client_count->result();
			
			}
		}

		public function get_client_staff_date_summary() {
			
			$this->db->select("MIN(deployment_date) as minDate, MAX(deployment_date) as maxDate");
			$this->db->from("staff");
			$get_client_min_max = $this->db->get();


			foreach ($get_client_min_max->result() as $min_max) {
				$this->db->select("count(s.staff_id) as countStaff, (case when c.comp_name IS NULL then c.full_name else c.comp_name end) as clientName, DATE_FORMAT(s.deployment_date, '%M %d, %Y') as clientDate");
				$this->db->from("staff s");
				$this->db->join("client c","s.client_id = c.id","left");
				$this->db->join("applicant a","s.applicant_id = a.id","left");
				$this->db->where("s.deployment_date BETWEEN '$min_max->minDate' AND '$min_max->maxDate'");
				$this->db->order_by("s.deployment_date"); 
   	 			$this->db->group_by("clientName, clientDate");
				$get_client_count = $this->db->get();
				
				return $get_client_count->result();
			
			}
		}

		public function get_applicant_ama_date_summary() {
			
			$this->db->select("MIN(application_date) as minDate, MAX(application_date) as maxDate");
			$this->db->where("status < 4");
			$this->db->from("applicant");
			$get_app_min_max = $this->db->get();


			foreach ($get_app_min_max->result() as $min_max) {
				$this->db->select("count(id) as countApp, DATE_FORMAT(application_date, '%M %d, %Y') as appDate");
				$this->db->from("applicant");
				$this->db->where("status < 4");
				$this->db->where("application_date BETWEEN '$min_max->minDate' AND '$min_max->maxDate'");
				$this->db->order_by("application_date"); 
   	 			$this->db->group_by("appDate");
				$get_app_count = $this->db->get();
				
				return $get_app_count->result();
			
			}
		}

		public function get_applicant_aaa_date_summary() {
			
			$this->db->select("MIN(application_date) as minDate, MAX(application_date) as maxDate");
			$this->db->where("status < 4");
			$this->db->from("applicant");
			$get_app_min_max = $this->db->get();


			foreach ($get_app_min_max->result() as $min_max) {
				$this->db->select("count(id) as countApp, city as appLoc, DATE_FORMAT(application_date, '%M %d, %Y') as appDate");
				$this->db->from("applicant");
				$this->db->where("status < 4");
				$this->db->where("application_date BETWEEN '$min_max->minDate' AND '$min_max->maxDate'");
				$this->db->order_by("application_date"); 
   	 			$this->db->group_by("appLoc, appDate");
				$get_app_count = $this->db->get();
				
				return $get_app_count->result();
			
			}
		}

		public function get_job_moj_date_summary() {
			
			$this->db->select("MIN(order_date) as minDate, MAX(order_date) as maxDate");
			$this->db->from("job_order");
			$get_job_min_max = $this->db->get();


			foreach ($get_job_min_max->result() as $min_max) {
				$this->db->select("count(jo.job_id) as countJob, jp.name as jobName, DATE_FORMAT(jo.order_date, '%M %d, %Y') as jobDate");
				$this->db->from("job_order jo");
				$this->db->join("job_position jp","jo.job_id = jp.id","left");
				$this->db->where("jo.order_date BETWEEN '$min_max->minDate' AND '$min_max->maxDate'");
				$this->db->order_by("jo.order_date"); 
   	 			$this->db->group_by("jobName, jobDate");
				$get_job_count = $this->db->get();
				
				return $get_job_count->result();
			
			}
		}

		public function get_job_maj_date_summary() {
			
			$this->db->select("MIN(application_date) as minDate, MAX(application_date) as maxDate");
			$this->db->from("applicant");
			$get_job_min_max = $this->db->get();


			foreach ($get_job_min_max->result() as $min_max) {
				$this->db->select("count(a.job_id) as countJob, jp.name as jobName, DATE_FORMAT(a.application_date, '%M %d, %Y') as jobDate");
				$this->db->from("applicant a");
				$this->db->join("job_position jp","a.job_id = jp.id","left");
				$this->db->where("a.application_date BETWEEN '$min_max->minDate' AND '$min_max->maxDate'");
				$this->db->order_by("a.application_date"); 
   	 			$this->db->group_by("jobName, jobDate");
				$get_job_count = $this->db->get();
				
				return $get_job_count->result();
			
			}
		}

		//filter client_cjo_date
		public function get_client_cjo_filtered_date($minDate, $maxDate) {
				$this->db->select("count(jo.client_id) as countClient, (case when c.comp_name IS NULL then c.full_name else c.comp_name end) as clientName, DATE_FORMAT(order_date, '%M %d, %Y') as clientDate");
				$this->db->from("job_order jo");
				$this->db->join("client c","jo.client_id = c.id","left");
				$this->db->where("DATE_FORMAT(order_date, '%Y-%m-%d') BETWEEN '$minDate' AND '$maxDate'");
				$this->db->order_by("order_date"); 
   	 			$this->db->group_by("clientName, clientDate");
				$get_client_count = $this->db->get();
			
				return $get_client_count->result();
			
		}

		public function get_client_cns_filtered_date($minDate, $maxDate) {
				$this->db->select("count(s.staff_id) as countStaff, (case when c.comp_name IS NULL then c.full_name else c.comp_name end) as clientName, DATE_FORMAT(deployment_date, '%M %d, %Y') as clientDate");
				$this->db->from("staff s");
				$this->db->join("client c","s.client_id = c.id","left");
				$this->db->join("applicant a","s.applicant_id = a.id","left");
				$this->db->where("DATE_FORMAT(deployment_date, '%Y-%m-%d') BETWEEN '$minDate' AND '$maxDate'");
				$this->db->order_by("deployment_date"); 
   	 			$this->db->group_by("clientName, clientDate");
				$get_client_count = $this->db->get();

				return $get_client_count->result();
			
		}
		
		public function get_applicant_ama_filtered_date($minDate, $maxDate) {
				$this->db->select("count(id) as countApp, concat(first_name, ' ' , (case when middle_name IS NULL then '' else middle_name end), ' ', last_name) as appName, DATE_FORMAT(application_date, '%M %d, %Y') as appDate");
				$this->db->from("applicant");
				$this->db->where("status < 4");
				$this->db->where("DATE_FORMAT(application_date, '%Y-%m-%d') BETWEEN '$minDate' AND '$maxDate'");
				$this->db->order_by("application_date"); 
   	 			$this->db->group_by("appName, appDate");
				$get_app_count = $this->db->get();

				return $get_app_count->result();
			
		}

		public function get_applicant_aaa_filtered_date($minDate, $maxDate) {
				$this->db->select("count(id) as countApp, city as appLoc, DATE_FORMAT(application_date, '%M %d, %Y') as appDate");
				$this->db->from("applicant");
				$this->db->where("status < 4");
				$this->db->where("DATE_FORMAT(application_date, '%Y-%m-%d') BETWEEN '$minDate' AND '$maxDate'");
				$this->db->order_by("application_date"); 
   	 			$this->db->group_by("appLoc, appDate");
				$get_app_count = $this->db->get();

				return $get_app_count->result();
			
		}
		
		public function get_job_moj_filtered_date($minDate, $maxDate) {
				$this->db->select("count(jo.job_id) as countJob, jp.name as jobName, DATE_FORMAT(order_date, '%M %d, %Y') as jobDate");
				$this->db->from("job_order jo");
				$this->db->join("job_position jp","jo.job_id = jp.id","left");
				$this->db->where("DATE_FORMAT(order_date, '%Y-%m-%d') BETWEEN '$minDate' AND '$maxDate'");
				$this->db->order_by("order_date"); 
   	 			$this->db->group_by("jobName, jobDate");
				$get_job_count = $this->db->get();

				return $get_job_count->result();
			
		}

		public function get_job_maj_filtered_date($minDate, $maxDate) {
				$this->db->select("count(a.job_id) as countJob, jp.name as jobName, DATE_FORMAT(a.application_date, '%M %d, %Y') as jobDate");
				$this->db->from("applicant a");
				$this->db->join("job_position jp","a.job_id = jp.id","left");
				$this->db->where("DATE_FORMAT(a.application_date, '%Y-%m-%d') BETWEEN '$minDate' AND '$maxDate'");
				$this->db->order_by("a.application_date"); 
   	 			$this->db->group_by("jobName, jobDate");
				$get_job_count = $this->db->get();

				return $get_job_count->result();
			
		}

	}
?>