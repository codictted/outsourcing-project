<?php
	class Query extends CI_Controller {


		function __construct() {

			parent::__construct();
			$this->load->model("Query_model");
			$this->load->model("Applicant_model");
		}

		public function index() {

            if($this->session->userdata("usertype") == "1") {
				$data['title'] = "Filter Client";
				$data['client'] = $this->Query_model->get_client();
				$data['business_nature'] = $this->Query_model->get_business_nature();
				$this->load->view("admin-header", $data);
				$this->load->view("nav-queries");
				$this->load->view("queries_client");
			}
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
		}

	
		public function filter_applicant() {

            if($this->session->userdata("usertype") == "1") {
				$data['title'] = "Filter Applicant";
				$data['client'] = $this->Query_model->get_client();
				$data['applicant'] = $this->Query_model->get_all();
				$data['job_position'] = $this->Query_model->get_job_position();
				$this->load->view("admin-header", $data);
				$this->load->view("nav-queries");
				$this->load->view("queries_applicant");
				
			}
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }

		}



		public function showlist_applicant() {
			$status = $this->input->post('status');
			$job_position = $this->input->post('job_position');
			$application_date_from = $this->input->post('application_date_from');
			$application_date_to  = $this->input->post('application_date_to');
		    
			
			$filter = array(
			    'status' => $status,
			    'job_position' => $job_position,
			    'application_date_from' => $application_date_from,
			    'application_date_to' => $application_date_to,
			    
			    
			);
			
			echo json_encode($this->Query_model->filter_by_applicant($filter));

		}

		public function showlist_staff() {
			$status = $this->input->post('status');
			$client = $this->input->post('client');
			$job_position  = $this->input->post('job_position');
			$deployment_date_from = $this->input->post('deployment_date_from');
			$deployment_date_to  = $this->input->post('deployment_date_to');
			
			$filter = array(
			    'status' => $status,
			    'client' => $client,
			    'job_position' => $job_position,
			    'deployment_date_from' => $deployment_date_from,
			    'deployment_date_to' => $deployment_date_to,
			   
			    
			);
			
			echo json_encode($this->Query_model->filter_by_staff($filter));

		}

		public function showlist_client() {
			$status = $this->input->post('status');
			$business_nature  = $this->input->post('business_nature');
			$acc_creation_date_from = $this->input->post('acc_creation_date_from');
			$acc_creation_date_to  = $this->input->post('acc_creation_date_to');
			
			$filter = array(
			    'status' => $status,
			    'business_nature' => $business_nature,
			    'acc_creation_date_from' => $acc_creation_date_from,
			    'acc_creation_date_to' => $acc_creation_date_to,
			   
			    
			);
			
			echo json_encode($this->Query_model->filter_by_client($filter));

		}


		public function applicant_info($id) {

            if($this->session->userdata("usertype") == "1") {

                $data['title'] = "Applicant Details";
                $data['applicant_det'] = $this->Applicant_model->get_details($id);
                $data['applicant_family'] = $this->Applicant_model->get_family($id);
                $data['applicant_exp'] = $this->Applicant_model->get_exp($id);
                $data['applicant_sem'] = $this->Applicant_model->get_sem($id);
                $data['applicant_personality'] = $this->Applicant_model->get_personality($id);
                $data['applicant_essay'] = $this->Applicant_model->get_essay($id);
                $this->load->view("admin-header", $data);
                $this->load->view("nav-queries");
                $this->load->view("applicant_info");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }


		public function filter_staff() {

            if($this->session->userdata("usertype") == "1") {
				$data['title'] = "Filter Staff";
				$data['staff'] = $this->Query_model->get_staff();
				$data['client'] = $this->Query_model->get_client();
				$data['job_position'] = $this->Query_model->get_job_position();
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