<?php
	class Dashboard extends CI_Controller {


        public function index() {

            if($this->session->userdata("usertype") == "1") {
            	$this->load->model("Dashboard_model");
            	$data['title'] = "Welcome, Admin!";
            	$data['new_apps'] = $this->Dashboard_model->get_new_applicants();
            	$data['new_orders'] = $this->Dashboard_model->get_new_job_orders();
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