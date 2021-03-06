<?php
    class Utilities extends CI_Controller {

        function __construct() {
            parent::__construct();
            $this->load->model("Utilities_model");
        }

        public function index() {

            if($this->session->userdata("usertype") == "1") {
                $data["title"] = "Educational Attainment";
                $data['edat'] = $this->Utilities_model->get_educ_attain();
                $this->load->view("admin-header", $data);
                $this->load->view("admin-header-switch");
                $this->load->view("nav-utilities");
                $this->load->view("utilities_educ_attain");
                // $data['title'] = "Job Match Passing Rate";
                // $data['rate'] = $this->Utilities_model->get_rate();
                // $this->load->view("admin-header", $data);
                // $this->load->view("nav-utilities");
                // $this->load->view("utilities");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }
        // //JOB MATCH PASS RATE
        // public function update_rate() {
        //     $newrate = $this->input->post("jobmatch_passrate");
        //     $this->Utilities_model->update_rate($newrate);
        //     $this->session->set_flashdata("success_notification", "Congratulations! You have successfully updated the Job Match Passing Rate.");
        //     redirect(base_url("utilities"));
        // }

        //EDUC ATTAIN
        // public function utilities_educ_attain() {
        //     $data["title"] = "Educational Attainment";
        //     $data['edat'] = $this->Utilities_model->get_educ_attain();
        //     $this->load->view("admin-header", $data);
        //     $this->load->view("admin-header-switch");
        //     $this->load->view("nav-utilities");
        //     $this->load->view("utilities_educ_attain");

        // }

        public function status_educ_attain() {

            $this->form_validation->set_rules("educ_id", "Education ID", "required|alpha_dash");
            $this->form_validation->set_rules("educ_status", "Education Status", "required|alpha_dash");

            if($this->form_validation->run() !== FALSE) {
                $id = $this->input->post("educ_id");
                $data = array("flag" => $this->input->post("educ_status"));
                $this->Utilities_model->status_educ_attain($id, $data); 
            }
        }

        public function insert_educ_attain() {
            $if_exist = $this->Utilities_model->educ_attain_col_status_converter($this->input->post("add_educ_attainment"));
            $if_exist == 0 ? $is_unique = "|is_unique[educ_attainment.educ_attainment]": $is_unique = "";

            $this->form_validation->set_rules("add_educ_attainment", "Educational Attainment", "required|regex_match[/^[a-zA-Z\s'-\.]+$/]|strip_tags|xss_clean".$is_unique, array('is_unique' => '%s already exists.'));

            if($this->form_validation->run() !== FALSE) {
                if($if_exist == 0) {
                    $data = array("educ_attainment" => $this->input->post("add_educ_attainment"),"flag" => 0);

                    $this->Utilities_model->insert_educ_attain($data);
                }
                  
                $this->session->set_flashdata("success_notification", "Congratulations! You have successfully added a new record.");
                echo json_encode(array("success" => TRUE));

                redirect(base_url("utilities/"));
            }
            else {
                $this->session->set_flashdata("fail_notification", "Sorry, the record you are trying to add already exist.");
                $this->utilities_educ_attain();
            }

        }

        public function update_educ_attain($id) {
            $if_exist = $this->Utilities_model->educ_attain_col_status_converter($this->input->post("edit_educ_attainment"));
            $if_exist == 0 ? $is_unique = "|is_unique[educ_attainment.educ_attainment]": $is_unique = "";

            $this->form_validation->set_rules("edit_educ_attainment", "Educational Attainment", "required|regex_match[/^[a-zA-Z\s'-\.]+$/]|strip_tags|xss_clean".$is_unique, array('is_unique' => '%s already exists.'));

            if($this->form_validation->run() !== FALSE) {
                if($if_exist == 0) {
                    $id = $this->input->post("edit_ea");
                    $data = array("educ_attainment" => $this->input->post("edit_educ_attainment"));

                    $this->Utilities_model->update_educ_attain($id, $data);
                }
                  
                $this->session->set_flashdata("success_notification", "Congratulations! You have successfully updated a record.");
                echo json_encode(array("success" => TRUE));

                redirect(base_url("utilities/"));
            }
            else {
                $this->session->set_flashdata("fail_notification", "Sorry, the record you are trying to edit already exist.");
                redirect(base_url("utilities/"));
                // $this->utilities_educ_attain();
            }

            // $id = $this->input->post("edit_ea");
            // $data = array("educ_attainment" => $this->input->post("addedit_educ_attainment"));
            //$this->Utilities_model->update_educ_attain($id, $data);
            // $this->session->set_flashdata("success_notification", "Congratulations! You have successfully updated a record.");
            // redirect(base_url("utilities/utilities_educ_attain"));
        }

        //AGENCY EMAIL
        public function utilities_agency_email() {
            $data["title"] = "Agency's Default Email";
            $data['agem'] = $this->Utilities_model->get_agency_email();
            $this->load->view("admin-header", $data);
            $this->load->view("admin-header-switch");
            $this->load->view("nav-utilities");
            $this->load->view("utilities_email_pword", $data);

        }

        public function update_agency_email() {
            $email = $this->input->post("a_email");
            $pword = $this->input->post("a_pword");
            $this->Utilities_model->update_agency_email($email, $pword);
            $this->session->set_flashdata("success_notification", "Congratulations! You have successfully updated the Agency's Email and Password.");
            redirect(base_url("utilities/utilities_agency_email/"));
        }


        // //TEXT MESSAGES
        // public function utilities_text_message() {
        //     $data["title"] = "Text Messages";
        //     $data['teme'] = $this->Utilities_model->get_text_message();
        //     $this->load->view("admin-header", $data);
        //     $this->load->view("admin-header-switch");
        //     $this->load->view("nav-utilities");
        //     $this->load->view("utilities_text_message", $data);
        // }

        // public function update_text_message() {
        //     $ji_text_mess = $this->input->post("ji_text_mess");
        //     $jo_text_mess = $this->input->post("jo_text_mess");
        //     $this->Utilities_model->update_text_message($ji_text_mess, $jo_text_mess);
        //     $this->session->set_flashdata("success_notification", "Congratulations! You have successfully updated the text messages.");
        //     redirect(base_url("utilities/utilities_text_message/"));
        // }

        //ESSAY QUESTION
        public function utilities_essay_questions() {
            $data["title"] = "Essay Questions";
            $data['essayq'] = $this->Utilities_model->get_essay_question();
            $this->load->view("admin-header", $data);
            $this->load->view("admin-header-switch");
            $this->load->view("nav-utilities");
            $this->load->view("utilities_essay_questions", $data);
        }

        public function status_essay_question() {

            $this->form_validation->set_rules("essay_id", "Essay ID", "required|alpha_dash");
            $this->form_validation->set_rules("essay_status", "Essay Status", "required|alpha_dash");

            if($this->form_validation->run() !== FALSE) {
                $id = $this->input->post("essay_id");
                $data = array("flag" => $this->input->post("essay_status"));
                $this->Utilities_model->status_essay_question($id, $data); 
            }
        }

        public function insert_essay_question() {
            $data = array("essay_question" => $this->input->post("add_essay_question"));
            $this->Utilities_model->insert_essay_question($data);
            $this->session->set_flashdata("success_notification", "Congratulations! You have successfully added a new record.");
            redirect(base_url("utilities/utilities_essay_questions"));
        }

        public function update_essay_question() {
            $id = $this->input->post("edit_eq");
            $data = array("essay_question" => $this->input->post("edit_essay_question"));
            $this->Utilities_model->update_essay_question($id, $data);
            $this->session->set_flashdata("success_notification", "Congratulations! You have successfully updated a record.");
            redirect(base_url("utilities/utilities_essay_questions"));
        }
               
    }
?>