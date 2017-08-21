<?php
	class Admin extends CI_Controller {


        function __construct() {

            parent::__construct();
            $this->load->model("Client_model");
            $this->load->model("Applicant_model");
            $this->load->model("Dropdown_model");
            $this->load->model("Admin_model");
        }

        public function get_client() {

            return $this->Client_model->get_client_list();
        }

        public function get_nature($id) {

            $b_name = $this->Dropdown_model->get_bnature($id);
            return $b_name[0]->name;
        }

        public function admin_client_list() {

            if($this->session->userdata("usertype") == "1") {
                $data['title'] = "List of Client";
                $data['client'] = $this->get_client();
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("admin_client_list");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }
        
        public function update_client($id) {

            $type = $this->input->post("contact_client_type");
            if($type == 1) {

                $this->form_validation->set_rules(
                    "client_nature",
                    "Nature of Business", 
                    "required");
                $this->form_validation->set_rules(
                    "comp_name",
                    "Company Name",
                    "required|strip_tags|xss_clean");
            }
            $this->form_validation->set_rules(
                "contact_name",
                "Full Name",
                "required|strip_tags|xss_clean"
            );
            $this->form_validation->set_rules(
                "contact_email",
                "Email Address",
                "required|valid_email|strip_tags|xss_clean"
            );
            $this->form_validation->set_rules(
                "contact_contact_number",
                "Contact Number",
                "required|numeric|exact_length[11]|strip_tags|xss_clean"
            );
            $this->form_validation->set_rules(
                "contact_tel_number",
                "Telephone Number",
                "numeric|exact_length[7]|strip_tags|xss_clean"
            );
            $this->form_validation->set_rules(
                "contact_street_address",
                "Street Address",
                "required|strip_tags|xss_clean"
            );
            $this->form_validation->set_rules(
                "contact_city_address",
                "City",
                "required|strip_tags|xss_clean"
            );
            $this->form_validation->set_rules(
                "contact_province_address",
                "Province",
                "required|strip_tags|xss_clean"
            );
            $this->form_validation->set_rules(
                "contact_zip_address",
                "Zip Code",
                "required|numeric|exact_length[4]|strip_tags|xss_clean"
            );
            $this->form_validation->set_rules(
                "client_username",
                "Username",
                "required|strip_tags|xss_clean"
            );
            $this->form_validation->set_rules(
                "client_password",
                "Username",
                "required|strip_tags|xss_clean"
            );

            if($this->form_validation->run() !== FALSE) {

                $cid = $this->input->post("client");
                $type = $this->input->post("contact_client_type");
                $nature = $this->input->post("client_nature");
                $comp_name = $this->input->post("comp_name");
                if($type == 2) {
                    $nature = 1;
                    $comp_name = NULL;
                }
                $contact_name = $this->input->post("contact_name");
                $email = $this->input->post("contact_email");
                $cnumber = $this->input->post("contact_contact_number");
                $tnumber = $this->input->post("contact_tel_number");
                $street = $this->input->post("contact_street_address");
                $city = $this->input->post("contact_city_address");
                $province = $this->input->post("contact_province_address");
                $zip = $this->input->post("contact_zip_address");
                $user = $this->input->post("client_username");
                $pass = $this->input->post("client_password");
                $now = new DateTime(NULL, new DateTimeZone("Asia/Manila"));
                $data = array(
                    "type" => $type,
                    "business_nature" => $nature,
                    "comp_name" => $comp_name,
                    "full_name" => $contact_name,
                    "email" => $email,
                    "mobile_no" => $cnumber,
                    "tel_no" => $tnumber,
                    "street_address" => $street,
                    "city" => $city,
                    "province" => $province,
                    "zip" => $zip,
                    "acc_username" => $user,
                    "acc_password" => $pass,
                    "acc_creation_date" => $now->format("Y-m-d H:i:s"),
                    "acc_status" => 0,
                    "status" => 1
                );

                is_null($cid) ? 
                $this->Client_model->add_client($data) :
                $this->Client_model->update_client($cid, $data);

                $this->session->set_flashdata("success_notification", "Congratulations! You have successfully updated the client's details and status.");
                echo json_encode(array("success" => TRUE));
                

                // redirect(base_url()."admin/create_client");
            }

            else {
                $this->session->set_flashdata("fail_notification", "Sorry, there were some errors encountered. Please review the form.");
                echo json_encode(array("success" => FALSE));
            }

            // $data['title'] = "Add New Client";
            // $data['new_client'] = $this->Dropdown_model->get_new_client();
            // $data['nature'] = $this->Dropdown_model->get_business_nature();
            // $this->load->view("admin-header", $data);
            // $this->load->view("nav-transaction");
            // $this->load->view("admin_add_client");
        }

        public function create_client() {

            if($this->session->userdata("usertype") == "1") {
                $data['title'] = "Add New Client";
                $data['new_client'] = $this->Dropdown_model->get_new_client();
                $data['nature'] = $this->Dropdown_model->get_business_nature();
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("admin_add_client");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

		public function admin_order_list() {

            if($this->session->userdata("usertype") == "1") {
                $data['title'] = "List of Job Orders";
                $data['orders'] = $this->Client_model->get_all_job_orders(); 
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("admin_order_list");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function admin_applicant_list() {

            if($this->session->userdata("usertype") == "1") {
                $data['title'] = "List of Applicant";
                $data['applicant'] = $this->Applicant_model->get_all();
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("admin_applicant_list"); 
             }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function admin_staff_list() {

            if($this->session->userdata("usertype") == "1") {
                $data['title'] = "List of Staff";
                //$data['staff'] = $this->Staff_model->get_all();
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("admin_staff_list"); 
             }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function get_client_details($id) {

            $this->load->helper("string");
            $data = $this->Client_model->get_details($id);
            $data->user = random_string("alnum", 8);
            echo json_encode($data);
        }

        public function post_job() {

            if($this->session->userdata("usertype") == "1") {
                $data['title'] = "Post a job advertisement";
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("admin_post_job_ad");
             }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function create_shortlist() {

            if($this->session->userdata("usertype") == "1") {
                $data['title'] = "Create a Shortlist";
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("create_shortlist");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function jo_ongoing($id) {

            if($this->session->userdata("usertype") == "1") {
                $data['title'] = "Job Order Details";
                $data['order_details'] = $this->Client_model->get_joborder_details($id);
                $data['order_skills'] = $this->Client_model->get_job_order_skills($id);
                $data['order_benefits'] = $this->Client_model->get_job_order_benefits($id);
                $data['order_req'] = $this->Client_model->get_job_order_req($id);
                $data['sched'] = $this->Client_model->get_job_order_sched($id);
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("jo_ongoing");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function jo_completed($id) {

            if($this->session->userdata("usertype") == "1") {
                $data['title'] = "Job Order Details";
                $data['order_details'] = $this->Client_model->get_joborder_details($id);
                $data['order_skills'] = $this->Client_model->get_job_order_skills($id);
                $data['order_benefits'] = $this->Client_model->get_job_order_benefits($id);
                $data['order_req'] = $this->Client_model->get_job_order_req($id);
                $data['sched'] = $this->Client_model->get_job_order_sched($id);
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("jo_completed");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }  
        }

        public function jo_terminated($id) {

            if($this->session->userdata("usertype") == "1") {
                $data['title'] = "Job Order Details";
                $data['order_details'] = $this->Client_model->get_joborder_details($id);
                $data['order_skills'] = $this->Client_model->get_job_order_skills($id);
                $data['order_benefits'] = $this->Client_model->get_job_order_benefits($id);
                $data['order_req'] = $this->Client_model->get_job_order_req($id);
                $data['sched'] = $this->Client_model->get_job_order_sched($id);
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("jo_terminated");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function jo_rejected($id) {

            if($this->session->userdata("usertype") == "1") {
                $data['title'] = "Job Order Details";
                $data['order_details'] = $this->Client_model->get_joborder_details($id);
                $data['order_skills'] = $this->Client_model->get_job_order_skills($id);
                $data['order_benefits'] = $this->Client_model->get_job_order_benefits($id);
                $data['order_req'] = $this->Client_model->get_job_order_req($id);
                $data['sched'] = $this->Client_model->get_job_order_sched($id);
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("jo_rejected");
                }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function jo_new($id) {

            if($this->session->userdata("usertype") == "1") {

                $data['title'] = "Job Order Details";
                $data['order_details'] = $this->Client_model->get_joborder_details($id);
                $data['processed_data'] = 
                $this->process_data(
                    $this->Client_model->get_job_order_skills($id),
                    $this->Client_model->get_job_order_benefits($id),
                    $this->Client_model->get_job_order_req($id),
                    $this->Client_model->get_joborder_details($id)
                );

                $data['job_id'] = $id;
                $this->load->helper('captcha');
                $config = array(
                'word'          => $this->random_word(),
                'img_path'      => './captcha/',
                'img_url'       => base_url().'captcha/',
                'img_width'     => '250',
                'img_height'    => 40,
                'expiration'    => 7200,
                'word_length'   => 5,
                'font_size'     => 16,
                 'colors'        => array(
                    'background' => array(255, 255, 255),
                    'border' => array(255, 255, 255),
                    'text' => array(0, 0, 0),
                    'grid' => array(255, 40, 40)
                    )
                );

                $captcha = create_captcha($config);
                $this->session->unset_userdata('captchaCode');
                $this->session->set_userdata('captchaCode',$captcha['word']);
                $data['captcha_img'] = $captcha['image'];
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("jo_new");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function random_word() {

            $this->load->helper("string");
            return random_string("alpha", 5);
        }

        public function process_data($skill, $benefit, $req, $quali) {

            $final_skills = "";
            foreach($skill as $sk) {
                $final_skills = $final_skills . $sk->sk . ', ';
            }

            $final_benefits = "";
            foreach($benefit as $ben) {
                $final_benefits = $final_benefits . $ben->ben . ', ';
            }

            $final_req = "";
            foreach($req as $requi) {
                $final_req = $final_req . $requi->req . ', ';
            }

            $final_age = "";
            if((is_null($quali->min_age) || $quali->min_age == "") && (is_null($quali->max_age) || $quali->max_age == ""))
                $final_age = "No age preferrence";
            elseif(!(is_null($quali->min_age) || $quali->min_age == "") && (is_null($quali->max_age) || $quali->max_age == ""))
                $final_age = "Atleast ".$quali->min_age." years old";
            elseif((is_null($quali->min_age) || $quali->min_age == "") && !(is_null($quali->max_age) || $quali->max_age == ""))
                $final_age = "Up to ".$quali->max_age." years old";
            else
                $final_age = "From ".$quali->min_age." to ".$quali->max_age." years old";

            $final_height = is_null($quali->height) || $quali->height == "" ? "N/A" : $quali->height;
            $final_weight = is_null($quali->weight) || $quali->weight == "" ? "N/A" : $quali->weight;
            $final_civil = is_null($quali->single) || $quali->single == "0" || $quali->single == "" ? "Not necessarily" : "Yes";

            $final_education = is_null($quali->educ_name) || $quali->educ_name == "" ? "No Preferrence" : $quali->educ_name;
            $final_course = is_null($quali->course_name) || $quali->course_name == "" ? "No Preferrence" : $quali->course_name;

            $male = is_null($quali->num_male) || $quali->num_male == "" ? 0 : $quali->num_male;
            $female = is_null($quali->num_female) || $quali->num_female == "" ? 0 : $quali->num_female;

            if($male == 0 && $female == 0)
                $final_gender = "No Preferrence";
            elseif($male != 0 && $female == 0)
                $final_gender = $male." (Male)";
            elseif($male == 0 && $female != 0)
                $final_gender = $female." (Female)";
            else
                $final_gender = $male." (Male), ".$female." (Female)";

            $num_mix = is_null($quali->total_openings) || $quali->total_openings == "" ? 0 : $quali->total_openings;

            $final_total = $male + $female + $num_mix;


            $final_name = is_null($quali->comp) || $quali->comp == "" ?
                $quali->full : $quali->comp;

            $cleaned = array(
                "name" => $final_name,
                "age" => $final_age,
                "height" => $final_height,
                "weight" => $final_weight,
                "single" => $final_civil,
                "gender" => $final_gender,
                "education" => $final_education,
                "course" => $final_course,
                "skills" => $final_skills,
                "benefits" => $final_benefits,
                "requirements" => $final_req,
                "total" => $final_total
            );
            return $cleaned;
            
        }
        
        public function post_ad() {

            $this->form_validation->set_rules("code", "Code", "required");
            $this->form_validation->set_rules("captcha", "Captcha", "required|matches[code]|strip_tags|xss_clean");

            if($this->form_validation->run() !== FALSE) {

                $show = $this->input->post("on");
                $data = array(
                    "order_id" => $this->input->post("jobid"),
                    "employer" => 1,
                    "slot" => 1,
                    "age" => 1,
                    "education" => 1,
                    "course" => 1,
                    "single" => 1,
                    "height" => 1,
                    "weight" => 1,
                    "urgent" => 1,
                    "skills" => 1,
                    "benefits" => 1,
                    "requirements" => 1,
                    "description" => 1,
                );
                foreach($show as $col)
                    $data[$col] = 0;
                print_r($data);
            }

            else {

                echo validation_errors();
                print_r($code);
                echo "lol";
            }
        }

        public function admin_applicant_new($id) {

            if($this->session->userdata("usertype") == "1") {

                $data['title'] = "Applicant Details";
                $data['applicant_det'] = $this->Applicant_model->get_details($id);
                $data['applicant_family'] = $this->Applicant_model->get_family($id);
                $data['applicant_exp'] = $this->Applicant_model->get_exp($id);
                $data['applicant_sem'] = $this->Applicant_model->get_sem($id);
                $data['applicant_personality'] = $this->Applicant_model->get_personality($id);
                $data['applicant_essay'] = $this->Applicant_model->get_essay($id);
                $data['skills'] = $this->Applicant_model->get_skills($id);
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("applist_new");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function process_client_name($data) {

            $clean_client_name = array();
            foreach($data as $d) {

                is_null($d->comp_name) ?
                array_push($clean_client_name, $d->full_name) : 
                array_push($clean_client_name, $d->comp_name);
            }
            return $clean_client_name;
        }
         public function applist_new($id) {

            if($this->session->userdata("usertype") == "1") {

                $data['title'] = "Applicant Details";
                $data['applicant_det'] = $this->Applicant_model->get_details($id);
                $data['applicant_family'] = $this->Applicant_model->get_family($id);
                $data['applicant_exp'] = $this->Applicant_model->get_exp($id);
                $data['applicant_sem'] = $this->Applicant_model->get_sem($id);
                $data['applicant_personality'] = $this->Applicant_model->get_personality($id);
                $data['applicant_essay'] = $this->Applicant_model->get_essay($id);
                $data['client_list'] = $this->Admin_model->client_list_matching($data['applicant_det']->job_id);
                $data['client_name'] = $this->process_client_name($data['client_list']);
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("applist_new");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function compute_job_match($job_order, $applicant) {

            $match_result = array();
            //get applicant skill list
            $app_skill = $this->Applicant_model->get_skills($applicant->id);
            $askill = array();
            foreach($app_skill as $sk) {

                array_push($askill, $sk->skill_id);
            }

            //get each job_order's details and required skills/qualification to match against applicant's
            foreach($job_order as $jo) {

                $index = 0;
                $no_items = 0;
                $no_match = 0;

                $jo_details = $this->Client_model->get_jdetails($jo->order_id);
                $jo_skills = $this->Client_model->get_job_order_skills($jo->order_id);
                //get skill id of a specific job order
                $jskills = array();
                foreach($jo_skills as $sk) {

                    array_push($jskills, $sk->skill);
                    $no_items++;
                }

                //get client name
                $cname = is_null($jo->comp_name) ? $jo->full_name : $jo->comp_name;
                $index == 0 ?
                array_push($match_result, array("client_name" => $cname)) :
                array_push($match_result[$index], array("client_name" => $cname));
                $match_skill = array();
                $nonmatch_skill = array();
                $match_quali = array();
                $nonmatch_quali = array();
                //compare job order skill and applicant skill
                foreach($jskills as $jsk) {

                    if(in_array($jsk, $askill)) {

                        $name = $this->Dropdown_model->get_skill_name($jsk);
                        array_push($match_skill, $name[0]->name);
                        $no_match++;
                        $no_items++;
                    }
                    else {

                        $name = $this->Dropdown_model->get_skill_name($jsk);
                        array_push($nonmatch_skill, $name[0]->name);
                        $no_items++;
                    }
                }
                array_push($match_result[$index], array("matched_skill" => $match_skill));
                array_push($match_result[$index], array("nonmatch_skill" => $nonmatch_skill));

                //match education
                if(!(is_null($jo_details[0]->education))) {

                    $no_items++;
                    $name = $this->Dropdown_model->get_education_name($jo_details[0]->education);
                    if($applicant->education == $jo_details[0]->education) {

                        array_push($match_quali, array("education" => $name));
                        $no_match++;
                    }
                    else
                        array_push($nonmatch_quali, array("education" => $name));
                }

                //match course
                if(!(is_null($jo_details[0]->course))) {

                    $no_items++;
                    $name = $this->Dropdown_model->get_course_name($jo_details[0]->course);
                    if($jo_details[0]->course == $applicant->course) {

                        array_push($match_quali, array("course" => $name));
                            $no_match++;
                    }

                    else
                        array_push($nonmatch_quali, array("course" => $name));
                }

                //match weight
                if(!(is_null($jo_details[0]->weight))) {

                    $no_items++;
                    if($jo_details[0]->weight == $applicant->weight) {

                        array_push($match_quali, array("weight" => $jo_details[0]->weight." kg"));
                        $no_match++;
                    }
                    else
                        array_push($nonmatch_quali, array("weight" => $jo_details[0]->weight." kg"));

                }

                //match height
                if(!(is_null($jo_details[0]->height))) {

                    $no_items++;
                    if($jo_details[0]->height == $applicant->height) {

                        array_push($match_quali, array("height" => $jo_details[0]->height));
                        $no_match++;
                    }
                    else
                        array_push($nonmatch_quali, array("height" => $jo_details[0]->height));
                }

                //match gender
                //$gender = $jo_details[0]->gender == 1 ? "Male" : "Female";

                //saka na yung gender, medyo complicated hehhehe

                //match single
                if($jo_details[0]->single == 1) {

                    $no_items++;
                    if($applicant->civil_status == 1) {

                        array_push($match_quali, array("civil_status" => "Must be single"));
                        $no_match++;
                    }

                    else
                        array_push($nonmatch_quali, array("civil_status" => "Must be single"));
                }

                //match age
                

                $index++;
            }

            var_dump($match_result);
            die();
        }

        public function applist_matched($id) {

            if($this->session->userdata("usertype") == "1") {
                $data['title'] = "Applicant Job Match Result";
                $data['applicant_det'] = $this->Applicant_model->get_details($id);
                $data['applicant_skills'] = $this->Applicant_model->get_skills($id);
                $data['client_list'] = $this->Admin_model->client_list_matching($data['applicant_det']->job_id);
                $data['match_result'] = $this->compute_job_match($data['client_list'], $data['applicant_det']);
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("applist_matched");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function applist_interview() {

            if($this->session->userdata("usertype") == "1") {

                $data['title'] = "List of Applicant";
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("applist_interview");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function applist_shortlist() {

            if($this->session->userdata("usertype") == "1") {
                $data['title'] = "List of Applicant";
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("applist_shortlist");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function applist_short_rejected() {

            if($this->session->userdata("usertype") == "1") {
                $data['title'] = "List of Applicant";
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("applist_short_rejected");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function applist_joboffer() {
            
            if($this->session->userdata("usertype") == "1") {
                $data['title'] = "List of Applicant";
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("applist_joboffer");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function applist_requirements() {

            if($this->session->userdata("usertype") == "1") {
                $data['title'] = "List of Applicant";
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("applist_requirements");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function applicant_full_details($id) {

            if($this->session->userdata("usertype") == "1") {
                $data['title'] = "List of Applicant";
                $data['applicant_det'] = $this->Applicant_model->get_details($id);
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


        public function client_full_details($id) {

            if($this->session->userdata("usertype") == "1") {
                $data['title'] = "Client Details";
                $data['client'] = $this->Client_model->get_details($id);
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("client_full_details");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            } 
        }

        public function edit_client($id) {

            if($this->session->userdata("usertype") == "1") {
    			$data['title'] = "Edit Client";
                $data['client'] = $this->Client_model->get_details($id);
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("admin_edit_client");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function jobopen_list() {

            if($this->session->userdata("usertype") == "1") {
    			$data['title'] = "Edit Client";
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("admin_jobopen_list");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

	}
?>