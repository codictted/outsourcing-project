<?php
	class Reports extends CI_Controller {

        function __construct() {

            parent::__construct();
            $this->load->model("Reports_model");
        }

    
        public function print_client_cjo_date() {
            if($this->session->userdata("usertype") == "1") {
                $this->load->library('pdf');
               
                $minDate = $this->input->get("mindate");
                $maxDate = $this->input->get("maxdate");
                $data['header'] = (object) array(
                        'head' => "Clients with most job ordered"
                    );
                $data['client_cjo_date_detail_count'] = $this->Reports_model->get_print_client_cjo_date_detail_count(date("Y-m-d", strtotime($minDate)), date("Y-m-d", strtotime($maxDate)));
                $data['client_cjo_date_sum_detail_count'] = $this->Reports_model->get_print_client_cjo_date_sum_detail_count(date("Y-m-d", strtotime($minDate)), date("Y-m-d", strtotime($maxDate)));
                $data['client_cjo_date_sum_count'] = $this->Reports_model->get_print_client_cjo_date_sum_count(date("Y-m-d", strtotime($minDate)), date("Y-m-d", strtotime($maxDate)));
                
                $data['date'] = (object) array(
                        'minDate' => $minDate,
                        'maxDate' => $maxDate
                    );
           
                $this->load->view("print_client_cjo_date", $data);
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }

        }

        public function print_client_cns_date() {
            if($this->session->userdata("usertype") == "1") {
                $this->load->library('pdf');
               
                $minDate = $this->input->get("mindate");
                $maxDate = $this->input->get("maxdate");
                $data['header'] = (object) array(
                        'head' => "Clients with most number of staff"
                    );
                $data['client_cns_date_detail_count'] = $this->Reports_model->get_print_client_cns_date_detail_count(date("Y-m-d", strtotime($minDate)), date("Y-m-d", strtotime($maxDate)));
                $data['client_cns_date_sum_detail_count'] = $this->Reports_model->get_print_client_cns_date_sum_detail_count(date("Y-m-d", strtotime($minDate)), date("Y-m-d", strtotime($maxDate)));
                $data['client_cns_date_sum_count'] = $this->Reports_model->get_print_client_cns_date_sum_count(date("Y-m-d", strtotime($minDate)), date("Y-m-d", strtotime($maxDate)));
                
                $data['date'] = (object) array(
                        'minDate' => $minDate,
                        'maxDate' => $maxDate
                    );
           
                $this->load->view("print_client_cns_date", $data);
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }

        }

        public function print_applicant_ama_date() {
            if($this->session->userdata("usertype") == "1") {
                $this->load->library('pdf');
               
                $minDate = $this->input->get("mindate");
                $maxDate = $this->input->get("maxdate");
                $data['header'] = (object) array(
                        'head' => "Months with most applicants"
                    );
                $data['applicant_ama_date_detail_count'] = $this->Reports_model->get_print_applicant_ama_date_detail_count(date("Y-m-d", strtotime($minDate)), date("Y-m-d", strtotime($maxDate)));
                $data['applicant_ama_date_sum_detail_count'] = $this->Reports_model->get_print_applicant_ama_date_sum_detail_count(date("Y-m-d", strtotime($minDate)), date("Y-m-d", strtotime($maxDate)));
                $data['applicant_ama_date_sum_count'] = $this->Reports_model->get_print_applicant_ama_date_sum_count(date("Y-m-d", strtotime($minDate)), date("Y-m-d", strtotime($maxDate)));
                
                $data['date'] = (object) array(
                        'minDate' => $minDate,
                        'maxDate' => $maxDate
                    );
           
                $this->load->view("print_applicant_ama_date", $data);
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }

        }

        public function print_applicant_aaa_date() {
            if($this->session->userdata("usertype") == "1") {
                $this->load->library('pdf');
               
                $minDate = $this->input->get("mindate");
                $maxDate = $this->input->get("maxdate");
                $data['header'] = (object) array(
                        'head' => "Area with most applicants"
                    );
                $data['applicant_aaa_date_detail_count'] = $this->Reports_model->get_print_applicant_aaa_date_detail_count(date("Y-m-d", strtotime($minDate)), date("Y-m-d", strtotime($maxDate)));
                $data['applicant_aaa_date_sum_detail_count'] = $this->Reports_model->get_print_applicant_aaa_date_sum_detail_count(date("Y-m-d", strtotime($minDate)), date("Y-m-d", strtotime($maxDate)));
                $data['applicant_aaa_date_sum_count'] = $this->Reports_model->get_print_applicant_aaa_date_sum_count(date("Y-m-d", strtotime($minDate)), date("Y-m-d", strtotime($maxDate)));
                
                $data['date'] = (object) array(
                        'minDate' => $minDate,
                        'maxDate' => $maxDate
                    );
           
                $this->load->view("print_applicant_aaa_date", $data);
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }

        }
        
        public function print_job_moj_date() {
            if($this->session->userdata("usertype") == "1") {
                $this->load->library('pdf');
               
                $minDate = $this->input->get("mindate");
                $maxDate = $this->input->get("maxdate");
                $data['header'] = (object) array(
                        'head' => "Most ordered jobs"
                    );
                $data['job_moj_date_detail_count'] = $this->Reports_model->get_print_job_moj_date_detail_count(date("Y-m-d", strtotime($minDate)), date("Y-m-d", strtotime($maxDate)));
                $data['job_moj_date_sum_detail_count'] = $this->Reports_model->get_print_job_moj_date_sum_detail_count(date("Y-m-d", strtotime($minDate)), date("Y-m-d", strtotime($maxDate)));
                $data['job_moj_date_sum_count'] = $this->Reports_model->get_print_job_moj_date_sum_count(date("Y-m-d", strtotime($minDate)), date("Y-m-d", strtotime($maxDate)));
                
                $data['date'] = (object) array(
                        'minDate' => $minDate,
                        'maxDate' => $maxDate
                    );
           
                $this->load->view("print_job_moj_date", $data);
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }

        }

        public function print_job_maj_date() {
            if($this->session->userdata("usertype") == "1") {
                $this->load->library('pdf');
               
                $minDate = $this->input->get("mindate");
                $maxDate = $this->input->get("maxdate");
                $data['header'] = (object) array(
                        'head' => "Most applied jobs"
                    );
                $data['job_maj_date_detail_count'] = $this->Reports_model->get_print_job_maj_date_detail_count(date("Y-m-d", strtotime($minDate)), date("Y-m-d", strtotime($maxDate)));
                $data['job_maj_date_sum_detail_count'] = $this->Reports_model->get_print_job_maj_date_sum_detail_count(date("Y-m-d", strtotime($minDate)), date("Y-m-d", strtotime($maxDate)));
                $data['job_maj_date_sum_count'] = $this->Reports_model->get_print_job_maj_date_sum_count(date("Y-m-d", strtotime($minDate)), date("Y-m-d", strtotime($maxDate)));
                
                $data['date'] = (object) array(
                        'minDate' => $minDate,
                        'maxDate' => $maxDate
                    );
           
                $this->load->view("print_job_maj_date", $data);
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }

        }

        public function index() {

            if($this->session->userdata("usertype") == "1") {
                $data["title"] = "Clients with most job ordered";

                $data['date'] = $this->Reports_model->get_client_job_order_date_summary();
                $data['base_date'] = $this->Reports_model->get_base_date_summary("order_date", "job_order");
                

                $this->load->view("admin-header", $data);
                $this->load->view("nav-reports");
                $this->load->view("reports_client_most_job_ordered");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }


        public function client_cns() {

            if($this->session->userdata("usertype") == "1") {
                $data["title"] = "Clients with most number of staff";
                $data['date'] = $this->Reports_model->get_client_staff_date_summary();
                $data['base_date'] = $this->Reports_model->get_base_date_summary("deployment_date", "staff");
             
                $this->load->view("admin-header", $data);
                $this->load->view("nav-reports");
                $this->load->view("reports_client_most_number_staff");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function applicant_ama() {

            if($this->session->userdata("usertype") == "1") {
                $data["title"] = "Months with most applicants";
                $data['date'] = $this->Reports_model->get_applicant_ama_date_summary();
                $data['base_date'] = $this->Reports_model->get_base_status_date_summary("application_date", "status < 4" ,"applicant");
             
                $this->load->view("admin-header", $data);
                $this->load->view("nav-reports");
                $this->load->view("reports_applicant_month_most_applicant");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function applicant_aaa() {

            if($this->session->userdata("usertype") == "1") {
                $data["title"] = "Area with most applicants";
                $data['date'] = $this->Reports_model->get_applicant_aaa_date_summary();
                $data['base_date'] = $this->Reports_model->get_base_status_date_summary("application_date", "status < 4" ,"applicant");
             
                $this->load->view("admin-header", $data);
                $this->load->view("nav-reports");
                $this->load->view("reports_applicant_area_most_applicant");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function job_moj() {

            if($this->session->userdata("usertype") == "1") {
                $data["title"] = "Most ordered jobs";
                $data['date'] = $this->Reports_model->get_job_moj_date_summary();
                $data['base_date'] = $this->Reports_model->get_base_date_summary("order_date","job_order");
             
                $this->load->view("admin-header", $data);
                $this->load->view("nav-reports");
                $this->load->view("reports_job_most_ordered_job");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        public function job_maj() {

            if($this->session->userdata("usertype") == "1") {
                $data["title"] = "Most applied jobs";
                $data['date'] = $this->Reports_model->get_job_maj_date_summary();
                $data['base_date'] = $this->Reports_model->get_base_date_summary("application_date","applicant");
             
                $this->load->view("admin-header", $data);
                $this->load->view("nav-reports");
                $this->load->view("reports_job_most_applied_job");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }

        //filter date_week
        public function filter_date_week_client_cjo() {
         
            $this->form_validation->set_rules("date_picker_week_first", "Date from", "required");
            $this->form_validation->set_rules("date_picker_week_last", "Date to", "required");

            if($this->form_validation->run() !== FALSE) {
                $data["title"] = "Filtered by week";
                $data['date'] = $this->Reports_model->get_client_cjo_filtered_date($this->input->post("date_picker_week_first"), $this->input->post("date_picker_week_last"));
                $data['base_date'][] = (object) array(
                        'min' => $this->input->post("date_picker_week_first"),
                        'max' => $this->input->post("date_picker_week_last")
                    );

                $this->load->view("admin-header", $data);
                $this->load->view("nav-reports");
                $this->load->view("reports_client_most_job_ordered");

            }
            else {
                redirect(base_url("reports/"));
            }
        }

        public function filter_date_week_client_cns() {
           
            $this->form_validation->set_rules("date_picker_week_first", "Date from", "required");
            $this->form_validation->set_rules("date_picker_week_last", "Date to", "required");

            if($this->form_validation->run() !== FALSE) {
                $data["title"] = "Filtered by week";
                $data['date'] = $this->Reports_model->get_client_cns_filtered_date($this->input->post("date_picker_week_first"), $this->input->post("date_picker_week_last"));
                $data['base_date'][] = (object) array(
                        'min' => $this->input->post("date_picker_week_first"),
                        'max' => $this->input->post("date_picker_week_last")
                    );

                $this->load->view("admin-header", $data);
                $this->load->view("nav-reports");
                $this->load->view("reports_client_most_number_staff");

            }
            else {
                redirect(base_url("reports/client_cns"));
            }
        }

        public function filter_date_week_applicant_ama() {
           
            $this->form_validation->set_rules("date_picker_week_first", "Date from", "required");
            $this->form_validation->set_rules("date_picker_week_last", "Date to", "required");

            if($this->form_validation->run() !== FALSE) {
                $data["title"] = "Filtered by week";
                $data['date'] = $this->Reports_model->get_applicant_ama_filtered_date($this->input->post("date_picker_week_first"), $this->input->post("date_picker_week_last"));
                $data['base_date'][] = (object) array(
                        'min' => $this->input->post("date_picker_week_first"),
                        'max' => $this->input->post("date_picker_week_last")
                    );

                $this->load->view("admin-header", $data);
                $this->load->view("nav-reports");
                $this->load->view("reports_applicant_month_most_applicant");

            }
            else {
                redirect(base_url("reports/applicant_ama"));
            }
        }

        public function filter_date_week_applicant_aaa() {
           
            $this->form_validation->set_rules("date_picker_week_first", "Date from", "required");
            $this->form_validation->set_rules("date_picker_week_last", "Date to", "required");

            if($this->form_validation->run() !== FALSE) {
                $data["title"] = "Filtered by week";
                $data['date'] = $this->Reports_model->get_applicant_aaa_filtered_date($this->input->post("date_picker_week_first"), $this->input->post("date_picker_week_last"));
                $data['base_date'][] = (object) array(
                        'min' => $this->input->post("date_picker_week_first"),
                        'max' => $this->input->post("date_picker_week_last")
                    );

                $this->load->view("admin-header", $data);
                $this->load->view("nav-reports");
                $this->load->view("reports_applicant_area_most_applicant");

            }
            else {
                redirect(base_url("reports/applicant_aaa"));
            }
        }

        public function filter_date_week_job_moj() {
           
            $this->form_validation->set_rules("date_picker_week_first", "Date from", "required");
            $this->form_validation->set_rules("date_picker_week_last", "Date to", "required");

            if($this->form_validation->run() !== FALSE) {
                $data["title"] = "Filtered by week";
                $data['date'] = $this->Reports_model->get_job_moj_filtered_date($this->input->post("date_picker_week_first"), $this->input->post("date_picker_week_last"));
                $data['base_date'][] = (object) array(
                        'min' => $this->input->post("date_picker_week_first"),
                        'max' => $this->input->post("date_picker_week_last")
                    );

                $this->load->view("admin-header", $data);
                $this->load->view("nav-reports");
                $this->load->view("reports_job_most_ordered_job");

            }
            else {
                redirect(base_url("reports/job_moj"));
            }
        }

        public function filter_date_week_job_maj() {
           
            $this->form_validation->set_rules("date_picker_week_first", "Date from", "required");
            $this->form_validation->set_rules("date_picker_week_last", "Date to", "required");

            if($this->form_validation->run() !== FALSE) {
                $data["title"] = "Filtered by week";
                $data['date'] = $this->Reports_model->get_job_maj_filtered_date($this->input->post("date_picker_week_first"), $this->input->post("date_picker_week_last"));
                $data['base_date'][] = (object) array(
                        'min' => $this->input->post("date_picker_week_first"),
                        'max' => $this->input->post("date_picker_week_last")
                    );

                $this->load->view("admin-header", $data);
                $this->load->view("nav-reports");
                $this->load->view("reports_job_most_applied_job");

            }
            else {
                redirect(base_url("reports/job_maj"));
            }
        }

        //filter date_month
        public function filter_date_month_client_cjo() {
           
            $this->form_validation->set_rules("date_picker_month_first", "Date from", "required");
            $this->form_validation->set_rules("date_picker_month_last", "Date to", "required");

            if($this->form_validation->run() !== FALSE) {
                $data["title"] = "Filtered by month";
                $data['date'] = $this->Reports_model->get_client_cjo_filtered_date($this->input->post("date_picker_month_first"), $this->input->post("date_picker_month_last"));
                $data['base_date'][] = (object) array(
                        'min' => $this->input->post("date_picker_month_first"),
                        'max' => $this->input->post("date_picker_month_last")
                    );

                $this->load->view("admin-header", $data);
                $this->load->view("nav-reports");
                $this->load->view("reports_client_most_job_ordered");

            }
            else {
                redirect(base_url("reports/"));
            }
        }

        public function filter_date_month_client_cns() {
           
            $this->form_validation->set_rules("date_picker_month_first", "Date from", "required");
            $this->form_validation->set_rules("date_picker_month_last", "Date to", "required");

            if($this->form_validation->run() !== FALSE) {
                $data["title"] = "Filtered by month";
                $data['date'] = $this->Reports_model->get_client_cns_filtered_date($this->input->post("date_picker_month_first"), $this->input->post("date_picker_month_last"));
                $data['base_date'][] = (object) array(
                        'min' => $this->input->post("date_picker_month_first"),
                        'max' => $this->input->post("date_picker_month_last")
                    );

                $this->load->view("admin-header", $data);
                $this->load->view("nav-reports");
                $this->load->view("reports_client_most_number_staff");

            }
            else {
                redirect(base_url("reports/client_cns"));
            }
        }
        
        public function filter_date_month_applicant_ama() {
           
            $this->form_validation->set_rules("date_picker_month_first", "Date from", "required");
            $this->form_validation->set_rules("date_picker_month_last", "Date to", "required");

            if($this->form_validation->run() !== FALSE) {
                $data["title"] = "Filtered by month";
                $data['date'] = $this->Reports_model->get_applicant_ama_filtered_date($this->input->post("date_picker_month_first"), $this->input->post("date_picker_month_last"));
                $data['base_date'][] = (object) array(
                        'min' => $this->input->post("date_picker_month_first"),
                        'max' => $this->input->post("date_picker_month_last")
                    );

                $this->load->view("admin-header", $data);
                $this->load->view("nav-reports");
                $this->load->view("reports_applicant_month_most_applicant");

            }
            else {
                redirect(base_url("reports/applicant_ama"));
            }
        }

        public function filter_date_month_applicant_aaa() {
           
            $this->form_validation->set_rules("date_picker_month_first", "Date from", "required");
            $this->form_validation->set_rules("date_picker_month_last", "Date to", "required");

            if($this->form_validation->run() !== FALSE) {
                $data["title"] = "Filtered by month";
                $data['date'] = $this->Reports_model->get_applicant_aaa_filtered_date($this->input->post("date_picker_month_first"), $this->input->post("date_picker_month_last"));
                $data['base_date'][] = (object) array(
                        'min' => $this->input->post("date_picker_month_first"),
                        'max' => $this->input->post("date_picker_month_last")
                    );

                $this->load->view("admin-header", $data);
                $this->load->view("nav-reports");
                $this->load->view("reports_applicant_area_most_applicant");

            }
            else {
                redirect(base_url("reports/applicant_aaa"));
            }
        }

        public function filter_date_month_job_moj() {
           
            $this->form_validation->set_rules("date_picker_month_first", "Date from", "required");
            $this->form_validation->set_rules("date_picker_month_last", "Date to", "required");

            if($this->form_validation->run() !== FALSE) {
                $data["title"] = "Filtered by month";
                $data['date'] = $this->Reports_model->get_job_moj_filtered_date($this->input->post("date_picker_month_first"), $this->input->post("date_picker_month_last"));
                $data['base_date'][] = (object) array(
                        'min' => $this->input->post("date_picker_month_first"),
                        'max' => $this->input->post("date_picker_month_last")
                    );

                $this->load->view("admin-header", $data);
                $this->load->view("nav-reports");
                $this->load->view("reports_job_most_ordered_job");

            }
            else {
                redirect(base_url("reports/job_moj"));
            }
        }

        public function filter_date_month_job_maj() {
           
            $this->form_validation->set_rules("date_picker_month_first", "Date from", "required");
            $this->form_validation->set_rules("date_picker_month_last", "Date to", "required");

            if($this->form_validation->run() !== FALSE) {
                $data["title"] = "Filtered by month";
                $data['date'] = $this->Reports_model->get_job_maj_filtered_date($this->input->post("date_picker_month_first"), $this->input->post("date_picker_month_last"));
                $data['base_date'][] = (object) array(
                        'min' => $this->input->post("date_picker_month_first"),
                        'max' => $this->input->post("date_picker_month_last")
                    );

                $this->load->view("admin-header", $data);
                $this->load->view("nav-reports");
                $this->load->view("reports_job_most_applied_job");

            }
            else {
                redirect(base_url("reports/job_maj"));
            }
        }

        //filter date_year
        public function filter_date_year_client_cjo() {
           
            $this->form_validation->set_rules("date_picker_year_first", "Date from", "required");
            $this->form_validation->set_rules("date_picker_year_last", "Date to", "required");

            if($this->form_validation->run() !== FALSE) {
                $data["title"] = "Filtered by year";
                $data['date'] = $this->Reports_model->get_client_cjo_filtered_date($this->input->post("date_picker_year_first"), $this->input->post("date_picker_year_last"));
                $data['base_date'][] = (object) array(
                        'min' => $this->input->post("date_picker_year_first"),
                        'max' => $this->input->post("date_picker_year_last")
                    );

                $this->load->view("admin-header", $data);
                $this->load->view("nav-reports");
                $this->load->view("reports_client_most_job_ordered");

            }
            else {
                redirect(base_url("reports/"));
            }
        }

        public function filter_date_year_client_cns() {
           
            $this->form_validation->set_rules("date_picker_year_first", "Date from", "required");
            $this->form_validation->set_rules("date_picker_year_last", "Date to", "required");

            if($this->form_validation->run() !== FALSE) {
                $data["title"] = "Filtered by year";
                $data['date'] = $this->Reports_model->get_client_cns_filtered_date($this->input->post("date_picker_year_first"), $this->input->post("date_picker_year_last"));
                $data['base_date'][] = (object) array(
                        'min' => $this->input->post("date_picker_year_first"),
                        'max' => $this->input->post("date_picker_year_last")
                    );

                $this->load->view("admin-header", $data);
                $this->load->view("nav-reports");
                $this->load->view("reports_client_most_number_staff");

            }
            else {
                redirect(base_url("reports/client_cns"));
            }
        }
        
        public function filter_date_year_applicant_ama() {
           
            $this->form_validation->set_rules("date_picker_year_first", "Date from", "required");
            $this->form_validation->set_rules("date_picker_year_last", "Date to", "required");

            if($this->form_validation->run() !== FALSE) {
                $data["title"] = "Filtered by year";
                $data['date'] = $this->Reports_model->get_applicant_ama_filtered_date($this->input->post("date_picker_year_first"), $this->input->post("date_picker_year_last"));
                $data['base_date'][] = (object) array(
                        'min' => $this->input->post("date_picker_year_first"),
                        'max' => $this->input->post("date_picker_year_last")
                    );

                $this->load->view("admin-header", $data);
                $this->load->view("nav-reports");
                $this->load->view("reports_applicant_month_most_applicant");

            }
            else {
                redirect(base_url("reports/applicant_ama"));
            }
        }

        public function filter_date_year_applicant_aaa() {
           
            $this->form_validation->set_rules("date_picker_year_first", "Date from", "required");
            $this->form_validation->set_rules("date_picker_year_last", "Date to", "required");

            if($this->form_validation->run() !== FALSE) {
                $data["title"] = "Filtered by year";
                $data['date'] = $this->Reports_model->get_applicant_aaa_filtered_date($this->input->post("date_picker_year_first"), $this->input->post("date_picker_year_last"));
                $data['base_date'][] = (object) array(
                        'min' => $this->input->post("date_picker_year_first"),
                        'max' => $this->input->post("date_picker_year_last")
                    );

                $this->load->view("admin-header", $data);
                $this->load->view("nav-reports");
                $this->load->view("reports_applicant_area_most_applicant");

            }
            else {
                redirect(base_url("reports/applicant_aaa"));
            }
        }

        public function filter_date_year_job_moj() {
           
            $this->form_validation->set_rules("date_picker_year_first", "Date from", "required");
            $this->form_validation->set_rules("date_picker_year_last", "Date to", "required");

            if($this->form_validation->run() !== FALSE) {
                $data["title"] = "Filtered by year";
                $data['date'] = $this->Reports_model->get_job_moj_filtered_date($this->input->post("date_picker_year_first"), $this->input->post("date_picker_year_last"));
                $data['base_date'][] = (object) array(
                        'min' => $this->input->post("date_picker_year_first"),
                        'max' => $this->input->post("date_picker_year_last")
                    );

                $this->load->view("admin-header", $data);
                $this->load->view("nav-reports");
                $this->load->view("reports_job_most_ordered_job");

            }
            else {
                redirect(base_url("reports/job_moj"));
            }
        }

        public function filter_date_year_job_maj() {
           
            $this->form_validation->set_rules("date_picker_year_first", "Date from", "required");
            $this->form_validation->set_rules("date_picker_year_last", "Date to", "required");

            if($this->form_validation->run() !== FALSE) {
                $data["title"] = "Filtered by year";
                $data['date'] = $this->Reports_model->get_job_maj_filtered_date($this->input->post("date_picker_year_first"), $this->input->post("date_picker_year_last"));
                $data['base_date'][] = (object) array(
                        'min' => $this->input->post("date_picker_year_first"),
                        'max' => $this->input->post("date_picker_year_last")
                    );

                $this->load->view("admin-header", $data);
                $this->load->view("nav-reports");
                $this->load->view("reports_job_most_applied_job");

            }
            else {
                redirect(base_url("reports/job_maj"));
            }
        }

	}
?>