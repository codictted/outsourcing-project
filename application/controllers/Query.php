<?php
	class Query extends CI_Controller {


		function __construct() {

			parent::__construct();
			$this->load->model("Query_model");
		}

		public function index() {

            if($this->session->userdata("usertype") == "1") {
				$data['title'] = "Filter Client";
				$data['client'] = $this->Query_model->get_client();
				$this->load->view("admin-header", $data);
				$this->load->view("nav-queries");
				$this->load->view("queries_client");
			}
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
		}

		// public function filter_job() {

		// 	$data['title'] = "Filter Job Position";
		// 	$this->load->view("admin-header", $data);
		// 	$this->load->view("nav-queries");
		// 	$this->load->view("queries_job");

		// }

		public function filter_applicant() {

            if($this->session->userdata("usertype") == "1") {
				$data['title'] = "Filter Applicant";
				$this->load->view("admin-header", $data);
				$this->load->view("nav-queries");
				$this->load->view("queries_applicant");
			}
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }

		}

		public function filter_staff() {

            if($this->session->userdata("usertype") == "1") {
				$data['title'] = "Filter Staff";
				$this->load->view("admin-header", $data);
				$this->load->view("nav-queries");
				$this->load->view("queries_staff");
			}
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }

		}
	}
?>