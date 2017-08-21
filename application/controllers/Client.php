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
                $data['education'] = $this->Dropdown_model->get_education();
                $data['course'] = $this->Dropdown_model->get_course_list();
                $data['job_cat'] = $this->Dropdown_model->get_job_category();
                $data['set'] = $this->Dropdown_model->get_skill_set();
                $data['benefit'] = $this->Dropdown_model->get_benefit();
                $data['requirement'] = $this->Dropdown_model->get_requirement();
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

        public function send_order() {

            // var_dump($this->input->post("single"));
            // die();
            $this->form_validation->set_rules(
                "job_pos",
                "Job Position",
                "required"
            );

            // $this->form_validation->set_rules(
            //     "skills",
            //     "Skills",
            //     "required"
            // );

            $this->form_validation->set_rules(
                "job_desc",
                "Job Description",
                "required|xss_clean"
            );

            $min_age = $this->input->post("min_age") == "" ? NULL : $this->input->post("min_age");
            $max_age = $this->input->post("max_age") == "" ? NULL : $this->input->post("max_age");

            if(is_null($min_age) && is_null($max_age))
                $this->form_validation->set_rules(
                    "no_age",
                    "Age",
                    "required"
            );

            $smale = $this->input->post("slot_male") == "" ? NULL : $this->input->post("slot_male");
            $sfemale = $this->input->post("slot_female") == "" ? NULL : $this->input->post("slot_female");

            if(is_null($smale) && is_null($sfemale))
                $this->form_validation->set_rules(
                    "slot",
                    "No of Slot",
                    "required"
            );
            
            if($this->form_validation->run() !== FALSE) {

                $id = $this->session->userdata('id');
                $jid = $this->input->post("job_pos");
                $desc = $this->input->post("job_desc");
                $educ = $this->input->post("educ");
                $course = $this->input->post("course");
                $height = $this->input->post("height") == "" ? NULL : $this->input->post("height");
                $weight = $this->input->post("weight") == "" ? NULL : $this->input->post("weight");
                $mix_slot = $this->input->post("slot");

                $single = is_null($this->input->post("age")) ? 0 : 1 ;
                $urgent = is_null($this->input->post("urgent")) ? 1 : 0 ;
                $status = 0;
                $now = new DateTime(NULL, new DateTimeZone("Asia/Manila"));

                $data = array(
                    "client_id" => $id,
                    "job_id" => $jid,
                    "education" => $educ,
                    "course" => $course,
                    "min_age" => $min_age,
                    "max_age" => $max_age,
                    "total_openings" => $mix_slot,
                    "num_male" => $smale,
                    "num_female" => $sfemale,
                    "single" => $single,
                    "height" => $height,
                    "weight" => $weight,
                    "description" => $desc,
                    "urgent" => $urgent,
                    "order_date" => $now->format("Y:m:d H:i:s"),
                    "is_rejected" => NULL,
                    "reason" => NULL,
                    "status" => 0
                );

                $jid = $this->Client_model->add_order($data);
                $jo = $jid[0]->order_id;

                $skills = $this->input->post("skills");
                $count = count($skills);
                if($count > 1) {

                    for($i = 1; $i < $count; $i++) {

                        $data = array(
                            "job_order_id" => $jo,
                            "skill" => $skills[$i]
                        );

                        $this->Client_model->insert_jo_skill($data);
                    }
                }

                $benefits = $this->input->post("benefits");
                $count = count($benefits);
                if($count > 0) {

                    for($i = 0; $i < $count; $i++) {

                        $data = array(
                            "job_order_id" => $jo,
                            "benefit" => $benefits[$i]
                        );

                        $this->Client_model->insert_jo_benefit($data);
                    }
                }

                $req = $this->input->post("requirements");
                $count = count($req);
                if($count > 0) {

                    for($i = 0; $i < $count; $i++) {

                        $data = array(
                            "job_order_id" => $jo,
                            "requirement" => $req[$i]
                        );
                        $this->Client_model->insert_jo_requirement($data);
                    }
                }


                $this->session->set_flashdata("success_notification", "Congratulations! You have successfully sent your job order");

                redirect(base_url()."client/client_job_order");

            }
            $this->session->set_flashdata("fail_notification", "Sorry, there were some errors encountered. Please review your form or try again later.");

            $data['title'] = "New Job Order";
            $data['job_cat'] = $this->Dropdown_model->get_job_category();
            $data['set'] = $this->Dropdown_model->get_skill_set();
            $data['benefit'] = $this->Dropdown_model->get_benefit();
            $data['requirement'] = $this->Dropdown_model->get_requirement();
            $this->load->view("client-header", $data);
            $this->load->view("client_job_order");


        }
	}
?>