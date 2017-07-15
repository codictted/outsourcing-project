<?php
	class Admin extends CI_Controller {


        function __construct() {

            parent::__construct();
            $this->load->model("Client_model");
            $this->load->model("Applicant_model");
            $this->load->model("Dropdown_model");
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
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("jo_new");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
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

        public function admin_applicant_new($id) {

            if($this->session->userdata("usertype") == "1") {

                $data['title'] = "Applicant Details";
                $data['applicant_det'] = $this->Applicant_model->get_details($id);
                $data['applicant_family'] = $this->Applicant_model->get_family($id);
                $data['applicant_exp'] = $this->Applicant_model->get_exp($id);
                $data['applicant_sem'] = $this->Applicant_model->get_sem($id);
                $data['applicant_personality'] = $this->Applicant_model->get_personality($id);
                $data['applicant_essay'] = $this->Applicant_model->get_essay($id);
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
                $data['applicant_family'] = $this->Applicant_model->get_family($id);
                $data['applicant_exp'] = $this->Applicant_model->get_exp($id);
                $data['applicant_sem'] = $this->Applicant_model->get_sem($id);
                $data['applicant_personality'] = $this->Applicant_model->get_personality($id);
                $data['applicant_essay'] = $this->Applicant_model->get_essay($id);
                $this->load->view("admin-header", $data);
                $this->load->view("nav-transaction");
                $this->load->view("applist_new");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function applist_matched() {

            if($this->session->userdata("usertype") == "1") {
                $data['title'] = "Applicant Job Match Result";
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