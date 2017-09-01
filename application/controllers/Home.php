<?php
    class Home extends CI_Controller {


    	function __construct() {

    		parent::__construct();
    		$this->load->library("session");
    		$this->load->helper("url");
            $this->load->model("Admin_model");
            $this->load->model("Client_model");
    	}

        public function index() {
            $this->load->model("Dropdown_model");
            $data["business_nature"] = $this->Dropdown_model->get_business_nature();
            $data['title'] = "Your best Outsourcing Management";
            $this->load->view('header', $data);
            $this->load->view('home');
        }

        public function contact_us() {

            $this->form_validation->set_rules(
                "contact_client_type",
                "Customer Type",
                "required"
            );

            if($this->form_validation->run() !== FALSE) {

                $type = $this->input->post("contact_client_type");
                if($type == 1) {

                    $this->form_validation->set_rules(
                        "business_nature",
                        "Nature of Business", 
                        "required");
                    $this->form_validation->set_rules(
                        "comp_name",
                        "Company Name",
                        "required");
                    $this->form_validation->set_rules(
                        "job_position",
                        "Job Position",
                        "required");
                }
            	$this->form_validation->set_rules(
            		"comp_name", 
            		"Company Name", 
            		"strip_tags|xss_clean"
                );
                
            	$this->form_validation->set_rules(
            		"contact_name",
            		"Full Name",
            		"required|strip_tags|xss_clean"
            	);
                $this->form_validation->set_rules(
                    "job_position",
                    "Job Position",
                    "strip_tags|xss_clean"
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
            		"inquiry",
            		"Inquiry",
            		"required|strip_tags|xss_clean"
            	);

            	if($this->form_validation->run() !== FALSE) {

                    $this->load->model("Client_model");
                    $nature = $type == 1 ? $this->input->post("business_nature") : "N/A";
                    $comp_name = $this->input->post("comp_name");
                    $contact_name = $this->input->post("contact_name");
                    $cont_job_pos = $this->input->post("job_position");
                    $email = $this->input->post("contact_email");
                    $cnumber = $this->input->post("contact_contact_number");
                    $tnumber = $this->input->post("contact_tel_number");
                    $street = $this->input->post("contact_street_address");
                    $city = $this->input->post("contact_city_address");
                    $province = $this->input->post("contact_province_address");
                    $zip = $this->input->post("contact_zip_address");
                    $inquiry = $this->input->post("inquiry");
                    $now = new DateTime(NULL, new DateTimeZone("Asia/Manila"));

                    $nature = $this->Client_model->check_select_business_nature($nature);
                  
                    $data = array(
                        "type" => $type,
                        "business_nature" => $nature,
                        "comp_name" => $comp_name,
                        "full_name" => $contact_name,
                        "job_position" => $cont_job_pos,
                        "email" => $email,
                        "mobile_no" => $cnumber,
                        "tel_no" => $tnumber,
                        "street_address" => $street,
                        "city" => $city,
                        "province" => $province,
                        "zip" => $zip,
                        "inquiry" => $inquiry,
                        "application_date" => $now->format("Y-m-d H:i:s"),
                    );

                    $this->Client_model->add_client($data);

                    $data = $this->Admin_model->get_agency_email_details();

                    //send email to the agency
                    $this->load->library('email');


                    $config['protocol']     = 'smtp';
                    $config['smtp_host']    = 'smtp.gmail.com';
                    $config['smtp_port']    = '465';
                    $config['smtp_timeout'] = '7';
                    $config['smtp_crypto']  = 'ssl';
                    $config['smtp_user']    = $data[0]->agency_email_text;
                    $config['smtp_pass']    = $data[0]->agency_email_pword;
                    $config['charset']      = 'utf-8';
                    $config['newline']      = "\r\n";
                    $config['mailtype']     = 'text';

                    $final_message = "Company Name: ".$comp_name."\n"."Nature of Business: ".$nature."\n"."Contact Person: ".$contact_name."\n"."Job Position".$cont_job_pos."\n"."E-mail: ".$email."\n"."Contact Number: ".$cnumber."\n"."Telephone Number: ".$tnumber."\n"."Address: ".$street." ".$city." ".$province." ".$zip."\n"."Inquiry: ".$inquiry;

                    $this->email->initialize($config);
                    $this->email->from($email, $contact_name);
                    $this->email->to($data[0]->agency_email_text);

                    $this->email->subject('Inquiry');
                    $this->email->message($final_message);

                    $this->email->send();
                    echo $this->email->print_debugger();

                    $this->session->set_flashdata("success_notification_contact_us", "Congratulations! You have successfully sent your request to us! Please check your email frequently. Thank you very much for choosing us");

                    redirect(base_url()."#contact_us");
                }

        	}
            $this->session->set_flashdata("fail_notification_contact_us", "Sorry, there were some errors encountered in your application. Please review your form or try again later.");

            $data['title'] = "Your best Outsourcing Management";
            $this->load->view('header', $data);
            $this->load->view('home');
        }

        public function open_jobs_list() {

            $data['title'] = "List of Job Openings";
            $data['order_det'] = $this->Admin_model->get_all_job_post();
            $this->load->view('header', $data);
            $this->load->view('open_jobs_list');
        }

        public function job_ad_full($id) {

            $data['title'] = "Full Details of Job Advertisement";
            $details = $this->Admin_model->get_job_post($id);
            var_dump($details);
            
        }
    }
?>