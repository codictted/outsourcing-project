<?php
	class Maintenance extends CI_Controller {

		public function index() {

			$data["title"] = "Job Maintenance";
			$this->load->view("admin-header", $data);
			$this->load->view("nav-maintenance");
			$this->load->view("maintenance_job");
		}
	}
?>