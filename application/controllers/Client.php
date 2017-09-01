<?php
	class Client extends CI_Controller {


		function __construct() {

            parent::__construct();
            $this->load->model("Dropdown_model");
            $this->load->model("Client_model");
            $this->load->model("Applicant_model");
            $this->load->model("Admin_model");
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
                $data['edat']    = $this->Dropdown_model->get_educ_attain();
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

        public function shortlist() {

            if($this->session->userdata("usertype") == "2") {
                $data['title'] = "Shortlist";
                $data['shortlist'] = $this->Client_model->get_shortlist($this->session->userdata("id"));
                $this->load->view("client-header", $data);
                $this->load->view("client_shortlist");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            } 
        }

        public function shortlist_full($id) {

            if($this->session->userdata("usertype") == "2") {
                $data['title'] = "Shortlist Details";
                $data['shortlist_det'] = $this->Client_model->get_shortlist_details($this->session->userdata("id"), $id);
                $index = 0;
                foreach($data['shortlist_det'] as $shortlist) {

                    $data['shortlist_det'][$index]->job_match = $this->compute_job_match($id, $shortlist->id);
                    $index++;
                }
                $this->load->view("client-header", $data);
                $this->load->view("client_shortlist_details");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            } 
        }

        public function compute_job_match($j, $applicant) {


            $applicant = $this->Applicant_model->get_details($applicant);
            $app_skill = $this->Applicant_model->get_app_skills($applicant->id);
            $birthdate = new DateTime($applicant->birthdate);
            $today = new DateTime('today');
            $app_age = $birthdate->diff($today)->y;
            $askill = array();

            foreach($app_skill as $sk) {

                array_push($askill, $sk->id);
            }

            $match_result = array();
            $order_det = $this->Admin_model->get_job_order_details($j);
            $order_skills = $this->Admin_model->get_job_order_skills($j);

            $no_items = 0;
            $no_matched = 0;

            $match_skill = array();
            $nonmatch_skill = array();
            $match_quali = array();
            $nonmatch_quali = array();

            //compare needed skills from job order to applicant's
            foreach($order_skills as $sk) {

                $name = $this->Admin_model->get_skill_name($sk->skill);
                if(in_array($sk->skill, $askill)) {

                    array_push($match_skill, $name[0]->name);
                    $no_matched++;
                }
                else
                    array_push($nonmatch_skill, $name[0]->name);

                $no_items++;
            }

            $match_result['match_skill'] = $match_skill;
            $match_result['nonmatch_skill'] = $nonmatch_skill;

            if(!(is_null($order_det[0]->weight)) OR !($order_det[0]->weight == 0.00) OR !($order_det[0]->weight == "")) {

                $no_items++;
                if($order_det[0]->weight == $applicant->weight) {

                    $no_matched++;
                    // array_push($match_quali, array("weight" => $order_det[0]->weight));
                    $match_quali['weight'] = $order_det[0]->weight;
                }
                else
                    // array_push($nonmatch_quali, array("weight" => $order_det[0]->weight));
                    $nonmatch_quali['weight'] = $order_det[0]->weight;
            }

            if(!(is_null($order_det[0]->height)) OR !($order_det[0]->height == 0.00) OR !($order_det[0]->height == "")) {

                $no_items++;
                if($order_det[0]->height == $applicant->height) {

                    $no_matched++;
                    // array_push($match_quali, array("height" => $order_det[0]->height));
                    $match_quali['height'] = $order_det[0]->height;
                }
                else
                    // array_push($nonmatch_quali, array("height" => $order_det[0]->height));
                    $nonmatch_quali['height'] = $order_det[0]->height;
            }

            if(!(is_null($order_det[0]->education)) OR !($order_det[0]->education == "")) {

                $no_items++;
                $name = $this->Admin_model->get_education_name($order_det[0]->education);
                if($order_det[0]->education == $applicant->education) {

                    $no_matched++;
                    // array_push($match_quali, array("education" => $name[0]->education));
                    $match_quali['education'] = $name[0]->education;
                }
                else
                    // array_push($nonmatch_quali, array("education" => $name[0]->education));
                    $nonmatch_quali['education'] = $name[0]->education;
            }

            if(!(is_null($order_det[0]->course)) OR !($order_det[0]->course == "")) {

                $no_items++;
                $name = $this->Admin_model->get_course_name($order_det[0]->course);
                if($order_det[0]->course == $applicant->course) {

                    $no_matched++;
                    // array_push($match_quali, array("course" => $name[0]->name));
                    $match_quali['course'] = $name[0]->name;
                }
                else
                    // array_push($nonmatch_quali, array("course" => $name[0]->name));
                    $nonmatch_quali['course'] = $name[0]->name;
            }

            if($order_det[0]->single == 1) {

                $no_items++;
                if($applicant->civil_status == 1) {

                    $no_matched++;
                    // array_push($match_quali, array("civil_status" => "Must be single"));
                    $match_quali['civil_status'] = "Must be single";
                }
                else
                    // array_push($match_quali, array("civil_status" => "Must be single"));
                    $nonmatch_quali['civil_status'] = "Must be single";
            }

            if((!(is_null($order_det[0]->min_age)) OR !($order_det[0]->min_age == 0) OR !($order_det[0]->min_age == "")) AND (!(is_null($order_det[0]->max_age)) OR !($order_det[0]->max_age == 0) OR !($order_det[0]->max_age == ""))) {

                $no_items++;
                $min = $order_det[0]->min_age;
                $max = $order_det[0]->max_age;

                if($app_age >= $min AND $app_age <= $max) {

                    $no_matched++;
                    // array_push($match_quali, array("age" => "From ".$min." to ".$max." years old"));
                    $match_quali['age'] = "From ".$min." to ".$max." years old";
                }
                else
                //     array_push($nonmatch_quali, array("age" => "From ".$min." to ".$max." years old"));
                    $nonmatch_quali['age'] = "From ".$min." to ".$max." years old";

            }
            else if((!(is_null($order_det[0]->min_age)) OR !($order_det[0]->min_age == 0) OR !($order_det[0]->min_age == "")) AND ((is_null($order_det[0]->max_age)) OR ($order_det[0]->max_age == 0) OR ($order_det[0]->max_age == ""))) {

                $no_items++;
                $min = $order_det[0]->min_age;
                if($app_age >= $min) {

                    $no_matched++;
                    // array_push($match_quali, array("age" => "From ".$min." years old"));
                    $match_quali['age'] = "From ".$min." years old";
                }
                else
                    // array_push($nonmatch_quali, array("age" => "From ".$min." years old"));
                    $nonmatch_quali['age'] = "From ".$min." years old";
            }

            if(((is_null($order_det[0]->min_age)) OR ($order_det[0]->min_age == 0) OR ($order_det[0]->min_age == "")) AND (!(is_null($order_det[0]->max_age)) OR !($order_det[0]->max_age == 0) OR !($order_det[0]->max_age == ""))) {

                $no_items++;
                $max = $order_det[0]->max_age;
                if($app_age <= $max) {

                    $no_matched++;
                    // array_push($match_quali, array("age" => "Up to ".$max." years old"));
                    $match_quali['age'] = "Up to ".$max." years old";
                }
                else
                    // array_push($nonmatch_quali, array("age" => "Up to ".$max." years old"));
                    $nonmatch_quali['age'] = "Up to ".$max." years old";
            }

            $match_result['match_quali'] = $match_quali;
            $match_result['nonmatch_quali'] = $nonmatch_quali;
            $match_result['total'] = $no_items;
            $match_result['matched'] = $no_matched;

            return $match_result;
        }

        public function send_shortlist() {

            var_dump($this->input->post("selected"));
            die();
        }

        public function staff() {

            if($this->session->userdata("usertype") == "2") {

                $data['title'] = "Staff List";
                $data['staff'] = $this->Client_model->get_staff_list($this->session->userdata("id"));
                $this->load->view("client-header", $data);
                $this->load->view("client_staff_list");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function applicant_full_details($id) {

            if($this->session->userdata("usertype") == "2") {
                $data['title'] = "Staff Details";
                $data['applicant_det'] = $this->Applicant_model->get_details($id);
                $data['status'] = $this->process_applicant_status($data['applicant_det']->status);
                $data['applicant_family'] = $this->Applicant_model->get_family($id);
                $data['applicant_exp'] = $this->Applicant_model->get_exp($id);
                $data['applicant_sem'] = $this->Applicant_model->get_sem($id);
                $data['applicant_personality'] = $this->Applicant_model->get_personality($id);
                $data['applicant_essay'] = $this->Applicant_model->get_essay($id);
                $data['skills'] = $this->Applicant_model->get_skills($id);
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("applicant_full_details");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            } 
        }

        public function process_applicant_status($stat) {

            $status = "";

            switch ($stat) {
                case '0':
                    $status = "New";
                    break;

                case '1':
                    $status = "Job Matched";
                    break;

                case '2':
                    $status = "For Interview";
                    break;
                
                case '3':
                    $status = "For Interview(Default)";
                    break;

                case '4':
                    $status = "Failed Interview";
                    break;

                case '5':
                    $status = "Ready to Shortlist";
                    break;

                case '6':
                    $status = "Shortlisted";
                    break;
                
                case '7':
                    $status = "Shortlisted - Rejected";
                    break;

                case '8':
                    $status = "Shortlisted - Selected";
                    break;

                case '9':
                    $status = "Job Offered";
                    break;

                case '10':
                    $status = "Job Offered - Rejected";
                    break;
                
                case '11':
                    $status = "Passing of Requirements";
                    break;

                case '12':
                    $status = "For Endorsement";
                    break;
                
                case '13':
                    $status = "Deployed";
                    break;
            }
            return $status;
        }

        public function submit_replace() {

            $staff = $this->input->post("staff");
            $reason = $this->input->post("reason");
            $date_request = new DateTime(NULL, new DateTimeZone("Asia/Manila"));
            foreach($staff as $st){

                $this->Admin_model->update_staff_stat($st, 1);

                $data = array(
                    "staff_id" => $st,
                    "client_id" => $this->session->userdata("id"),
                    "reason" => $reason,
                    "date_request" => $date_request->format("Y-m-d H:i:s"),
                    "status" => 0
                );

                $this->Admin_model->insert_replace_history($data);
            }

            $this->session->set_flashdata("success_notification_replace", "Congratulations! You have successfully sent your replacement request!");

            redirect(base_url()."client/staff");
        }

        public function get_match_details($app_id, $order_id) {

            $data = $this->compute_job_match($order_id, $app_id);
            echo json_encode($data);
        }

	}
?>