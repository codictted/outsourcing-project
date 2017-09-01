<?php
	class Admin extends CI_Controller {


        function __construct() {

            parent::__construct();
            $this->load->model("Client_model");
            $this->load->model("Applicant_model");
            $this->load->model("Dropdown_model");
            $this->load->model("Admin_model");
            $this->load->model("Staff_model");
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
                $this->load->helper('captcha');
                $config = array(
                'word'          => $this->random_word(),
                'img_path'      => './captcha/',
                'img_url'       => base_url().'captcha/',
                'img_width'     => '130',
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
                    $nature = "N/A";
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

                $nature = $this->Client_model->check_select_business_nature($nature);

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
                $data['staff'] = $this->Staff_model->get_all();
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
                $data['client'] = $this->Admin_model->get_client_active_job_orders();
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
                $data['order_post'] = $this->Client_model->get_joborder_post($id);
                $data['processed_data'] = 
                $this->process_data(
                    $this->Client_model->get_job_order_skills($id),
                    $this->Client_model->get_job_order_benefits($id),
                    $this->Client_model->get_job_order_req($id),
                    $this->Client_model->get_joborder_details($id)
                );
                $data['sched'] = $this->Client_model->get_job_order_sched($id);
                $data['emp_count'] = $this->Admin_model->count_deployed($id);
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
                $id = $this->input->post("jobid");
                $now = new DateTime(NULL, new DateTimeZone("Asia/Manila"));
                $data = array(
                    "order_id" => $id,
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
                    "date_posted" => $now->format("Y-m-d H:i:s"),
                    "ad_status" => 1
                );
                foreach($show as $col)
                    $data[$col] = 0;
                $this->Admin_model->post_job_order($data);
                $this->Admin_model->update_joborder_status($id, 1);
                $this->session->set_flashdata("success_notification_post_joborder", "You have successfully posted the client's job order!");
                    redirect(base_url("admin/admin_order_list"));
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

         public function applist_new($id) {

            if($this->session->userdata("usertype") == "1") {

                $data['title'] = "Applicant Details";
                $data['applicant_det'] = $this->Applicant_model->get_details($id);
                $data['status'] = $this->process_applicant_status($data['applicant_det']->status);
                $data['applicant_family'] = $this->Applicant_model->get_family($id);
                $data['applicant_exp'] = $this->Applicant_model->get_exp($id);
                $data['applicant_sem'] = $this->Applicant_model->get_sem($id);
                $data['applicant_personality'] = $this->Applicant_model->get_personality($id);
                $data['applicant_essay'] = $this->Applicant_model->get_essay($id);
                $client = $this->Admin_model->get_client_list($data['applicant_det']->job_id);
                $data['client_list'] = $this->get_cname($client);
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("applist_new");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function get_cname($data) {

            $extracted_data = array();
            foreach($data as $d) {

                $name = is_null($d->comp_name) ? $d->full_name : $d->comp_name;
                array_push($extracted_data, $name);
            }

            return $extracted_data;
        }

        public function applist_matched($id) {

            $this->Admin_model->update_applicant_status($id, 1);
            if($this->session->userdata("usertype") == "1") {

                $data['title'] = "Applicant Job Match Result";
                $data['applicant_det'] = $this->Applicant_model->get_details($id);
                $data['jname'] = $this->Admin_model->get_job_name($data['applicant_det']->job_id);
                $jo_details = $this->Admin_model->get_client_list($data['applicant_det']->job_id);
                $data['job_match'] = $this->compute_job_match($jo_details, $data['applicant_det']);
                $data['sms'] = $this->Admin_model->get_sms_message();
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("applist_matched");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function compute_job_match($job_order_list, $applicant) {

            $app_skill = $this->Applicant_model->get_app_skills($applicant->id);
            $birthdate = new DateTime($applicant->birthdate);
            $today = new DateTime('today');
            $app_age = $birthdate->diff($today)->y;
            $askill = array();

            foreach($app_skill as $sk) {

                array_push($askill, $sk->id);
            }

            $match_result = array();
            $index = 0;
            foreach($job_order_list as $j) {

                $name = is_null($j->comp_name) ? $j->full_name : $j->comp_name;
                array_push($match_result, array("client" => $name));

                $order_det = $this->Admin_model->get_job_order_details($j->order_id);
                $order_skills = $this->Admin_model->get_job_order_skills($j->order_id);

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

                // array_push($match_result[$index], array("match_skill" => $match_skill));
                // array_push($match_result[$index], array("nonmatch_skill" => $nonmatch_skill));
                $match_result[$index]['match_skill'] = $match_skill;
                $match_result[$index]['nonmatch_skill'] = $nonmatch_skill;

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

                $match_result[$index]['match_quali'] = $match_quali;
                $match_result[$index]['nonmatch_quali'] = $nonmatch_quali;
                $match_result[$index]['total'] = $no_items;
                $match_result[$index]['matched'] = $no_matched;

                $index++;
            }
            return $match_result;
        }

        public function itexmo($number,$message,$apicode){
            $url = 'https://www.itexmo.com/php_api/api.php';
            $itexmo = array('1' => $number, '2' => $message, '3' => $apicode);
            $param = array(
                'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($itexmo),
                ),
            );
            $context  = stream_context_create($param);
            return file_get_contents($url, false, $context);
       
        }

        public function send_interview_message() {

            $this->form_validation->set_rules("message", "Message", "required|strip_tags|xss_clean");
            if($this->form_validation->run() !== FALSE) {
                $num = $this->input->post("app_number");
                $message = $this->input->post("message");
                $time = $this->input->post("interview_time");
                $date = $this->input->post("interview_date");
                $app_id = $this->input->post("app_id");
                $date_time = "".$date."".$time;
                $message = $message." ".$date_time;
                $result = $this->itexmo($num, $message, "TR-JEABB956335_VA2MW");
<<<<<<< HEAD
=======
                
>>>>>>> 2993f3551a04ee5725f02dd5573c3f61cd2418bf
                if ($result == ""){
                    echo "iTexMo: No response from server!!!
                    Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
                    Please CONTACT US for help. ";  
                }
                else if ($result == 0){ 

                    $data = array(
                        "applicant_id" => $app_id,
                        "date" => $date_time,
                        "status" => 0
                    );
                    $this->Admin_model->insert_interview($data);
                    $this->Admin_model->update_applicant_status($app_id, 2);
                    $this->session->set_flashdata("success_notification", "You have successfully sent the message!");
                    redirect(base_url("admin/admin_applicant_list"));
                }
                else {

                    $this->session->set_flashdata("fail_notification", "Error Num ". $result . " was encountered!");
                    redirect(base_url("admin/admin_applicant_list"));
                }
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

        public function update_applicant_interview() {

            $this->form_validation->set_rules("result", "Interview Result", "required");
            $this->form_validation->set_rules("remarks", "Remarks", "strip_tags|xss_clean");

            if($this->form_validation->run() !== FALSE) {

                $id = $this->input->post("applicant_id");
                $res = $this->input->post("result");
                $remarks = $this->input->post("remarks");
                $stat = $res == 1 ? 5 : 4;
                $this->Admin_model->update_applicant_status($id, $stat);
                $this->Admin_model->add_remarks($id, $remarks);
                $this->session->set_flashdata("success_notification", "You have successfully updated the applicant's status.");
                redirect(base_url("admin/admin_applicant_list"));
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

        public function get_job_order($id) {

            $data = $this->Admin_model->get_job_order($id);
            echo json_encode($data);
        }

        public function get_job_order_details($id) {

            $data = $this->Client_model->get_joborder_details($id);
            echo json_encode($data);
        }

        public function get_applicant_shortlist($order_id) {

            $data['app_details'] = $this->Admin_model->get_applicant_shortlist($order_id);
            $index = 0;
            foreach($data['app_details'] as $app) {

                $data['app_details'][$index]->job_match = $this->compute_job_match_per_applicant($order_id, $app->id);
                $index++;
            }
            echo json_encode($data['app_details']);
        }

        public function get_applicant_det($id) {

            $data = $this->Applicant_model->get_details($id);
            echo json_encode($data);
        }

        public function send_job_offer() {

            $this->form_validation->set_rules("app_number", "Mobile Number", "required|numeric|exact_length[11]|strip_tags|xss_clean");
            $this->form_validation->set_rules("message", "Message", "required|strip_tags|xss_clean");
            $this->form_validation->set_rules("applicant_id", "Applicant ID", "required");

            if($this->form_validation->run() !== FALSE) {

                $num = $this->input->post("app_number");
                $mes = $this->input->post("message");
                // $result = $this->itexmo($num, $mes, "TR-PRINC971683_DKJI3");
                // if ($result == ""){
                //     echo "iTexMo: No response from server!!!
                //     Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
                //     Please CONTACT US for help. ";  
                // }
                // else if ($result == 0){

                    $app_id = $this->input->post("applicant_id");
                    $this->Admin_model->update_applicant_status($app_id, 9);
                    $this->session->set_flashdata("success_notification", "You have successfully sent the message!");
                    redirect(base_url("admin/admin_applicant_list"));
                // }
                // else {
                //     $this->session->set_flashdata("fail_notification", "Maximum number of messages sent reached.");
                //     redirect(base_url("admin/admin_applicant_list"));
                // }
            }
            else
                echo validation_errors();
        }

        public function terminate_client() {


            $this->form_validation->set_rules("code", "Code", "required");
            $this->form_validation->set_rules("captcha", "Captcha", "required|matches[code]|strip_tags|xss_clean");

            if($this->form_validation->run() !== FALSE) {

                $cid = $this->input->post("client_id");
                $reason = $this->input->post("reason");
                $this->Admin_model->update_client_status($cid, $reason);
                $this->session->set_flashdata("success_notification_client_terminate", "You have successfully terminated the client.");
                redirect(base_url('admin/admin_client_list'));
            }
            else {

                $data['title'] = "List of Client";
                $data['client'] = $this->get_client();
                $this->load->helper('captcha');
                $config = array(
                'word'          => $this->random_word(),
                'img_path'      => './captcha/',
                'img_url'       => base_url().'captcha/',
                'img_width'     => '130',
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


                $this->session->set_flashdata("fail_notification_client_terminate", "There were errors encountered.".validation_errors());
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("admin_client_list");
            }
        }

        public function job_offer_response() {

            $id = $this->input->post("applicant_id");
            $res = $this->input->post("result");
            $stat = $res == 1 ? 11 : 10;
            $this->Admin_model->update_applicant_status($id, $stat);
            $this->session->set_flashdata("success_notification", "You have successfully updated the applicant's status.");
            redirect(base_url('admin/admin_applicant_list'));
        }

        public function get_applicant_require($id) {

            $data = $this->Admin_model->get_applicant_require($id);
            echo json_encode($data);
        }

        public function save_applicant_require() {

            $id = $this->input->post("applicant_id");
            $checked = $this->input->post("passed");
            var_dump($checked);
            die();
        }

       

        public function save_shortlist() {

            $app_id = $this->input->post("applist");
            $cl_id = $this->input->post("client_id");
            $o_id = $this->input->post("order_id");
            $now = new DateTime(NULL, new DateTimeZone("Asia/Manila"));
            foreach($app_id as $aid) {

                $data = array(
                    "order_id" =>  $o_id,
                    "client_id" => $cl_id,
                    "applicant_id" => $aid,
                    "date_shortlist" => $now->format("Y-m-d H:i:s"),
                    "status" => 0
                );

                $this->Admin_model->insert_shortlist($data);
                $this->Admin_model->update_applicant_status($aid, 6);
            }

            $this->session->set_flashdata("success_notification", "You have successfully sent the shortlist to the client!");
            redirect(base_url("admin/admin_applicant_list"));
        }

        public function get_shortlist_det($id) {

            $data = $this->Admin_model->get_shortlist_det($id);
            echo json_encode($data);
        }

        public function get_replace_det($id) {

            $data = $this->Admin_model->get_replace_det($id);
            echo json_encode($data);
        }

<<<<<<< HEAD
        public function approve_staff_replacement($id, $app_id) {
            $this->Admin_model->update_applicant_stat($id, 5);
            $this->Admin_model->update_staff_stat($id, 2);
            $this->Admin_model->update_staff_history_stat($id, 2);
            $this->session->set_flashdata("success_notification", "You have successfully approved the replacement of staff!");
            redirect(base_url("admin/admin_staff_list"));
        }
        public function decline_staff_replacement($id, $app_id) {
            $this->Admin_model->update_applicant_stat($id, 5);
            $this->Admin_model->update_staff_stat($id, 2);
            $this->Admin_model->update_staff_history_stat($id, 1);
            $this->session->set_flashdata("success_notification", "You have successfully declined the replacement of staff!");
            redirect(base_url("admin/admin_staff_list"));
        }

       
=======
         public function compute_job_match_per_applicant($j, $applicant) {


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

        public function get_match_details($app_id, $order_id) {

            $data = $this->compute_job_match($order_id, $app_id);
            echo json_encode($data);
        }
>>>>>>> 2993f3551a04ee5725f02dd5573c3f61cd2418bf
	}
?>