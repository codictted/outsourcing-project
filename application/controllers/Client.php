<?php
	class Client extends CI_Controller {


		function __construct() {

            parent::__construct();
            $this->load->model("Dropdown_model");
            $this->load->model("Client_model");
        }
        public function index() {

            if($this->session->userdata("usertype") == "2") {
            $data['title'] = "Home";
            $this->load->view("client-header", $data);
            $this->load->view("client_home");  
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function client_order_list() {

            if($this->session->userdata("usertype") == "2") {
                $data['title'] = "Job Order List";
                $id = $this->session->userdata('id');
                $data['order'] = $this->Client_model->get_client_order($id);
                $this->load->view("client-header", $data);
                $this->load->view("client_order_list");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function job_order_details($id) {

            $data = $this->Client_model->get_joborder_details($id);
            echo json_encode($data);
        }

        public function job_order_skills($id) {

            $data = $this->Client_model->get_job_order_skills($id);
            echo json_encode($data);
        }

        public function job_order_benefits($id) {

            $data = $this->Client_model->get_job_order_benefits($id);
            echo json_encode($data);
        }

        public function job_order_req($id) {

            $data = $this->Client_model->get_job_order_req($id);
            echo json_encode($data);
        }

        public function job_order_sched($id) {

            $data = $this->Client_model->get_job_order_sched($id);
            echo json_encode($data);
        }

		public function client_job_order() {

            if($this->session->userdata("usertype") == "2") {
                $data['title'] = "New Job Order";
                $data['job_cat'] = $this->Dropdown_model->get_job_category();
                $data["set"] = $this->Dropdown_model->get_skill_set();
                $this->load->view("client-header", $data);
                $this->load->view("client_job_order");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            } 
        }

         public function order_confirm() {

            if($this->session->userdata("usertype") == "2") {
            $data['title'] = "Job Order Confirmation";
            $this->load->view("client-header", $data);
            $this->load->view("client_order_confirm"); 
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }  
        }
	}
?>