<?php
	class Dashboard extends CI_Controller {

        function __construct() {

            parent::__construct();
            $this->load->model("Dashboard_model");
            $this->load->model("Admin_model");
        }

        public function index() {

            if($this->session->userdata("usertype") == "1") {
            	$this->load->model("Dashboard_model");
            	$data['title'] = "Welcome, Admin!";
            	$data['new_apps'] = $this->Dashboard_model->get_new_applicants();
            	$data['new_orders'] = $this->Dashboard_model->get_new_job_orders();
                $data['job_order_reminder'] = $this->Admin_model->get_job_order_reminder();
                $this->load->view("admin-header", $data);
                $this->load->view("dashboard"); 
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }
	}
?>