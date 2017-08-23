<?php
	class Reports extends CI_Controller {

        function __construct() {

            parent::__construct();
            $this->load->model("Reports_model");
        }

        //pages
        public function index() {

            if($this->session->userdata("usertype") == "1") {
                $data["title"] = "Total number of Applicants";
                $this->load->view("admin-header", $data);
               // $this->load->view("admin-header-switch");
                $this->load->view("nav-reports");
                $this->load->view("reports_total_number_of_applicants");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }
	}
?>