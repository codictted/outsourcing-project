<?php
	class Maintenance extends CI_Controller {

		function __construct() {

            parent::__construct();
            $this->load->model("Maintenance_model");
        }

        //pages
		public function index() {

            if($this->session->userdata("usertype") == "1") {
                $data["title"] = "Job Category";
                $data['cat'] = $this->Maintenance_model->get_job_category();
                $this->load->view("admin-header", $data);
                $this->load->view("admin-header-switch");
                $this->load->view("nav-maintenance");
                $this->load->view("maintenance_category");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            } 
		}

        public function required_documents() {

            if($this->session->userdata("usertype") == "1") {
                $data["title"] = "Required Documents";
                $data['doc'] = $this->Maintenance_model->get_req_document();
                $this->load->view("admin-header", $data);
                $this->load->view("admin-header-switch");
                $this->load->view("nav-maintenance");
                $this->load->view("maintenance_requirement");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            } 
        }

        public function job_position() {

            if($this->session->userdata("usertype") == "1") {
                $data["title"] = "Job Maintenance";
                $data['job'] = $this->Maintenance_model->get_job_position();
                $this->load->view("admin-header", $data);
                $this->load->view("admin-header-switch");
                $this->load->view("nav-maintenance");
                $this->load->view("maintenance_job");;
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            }
        }


        //forms
        public function add_req_document_form() {

            if($this->session->userdata("usertype") == "1") {
                $data["title"] = "Add Required Documents";
                $data['doc'] = $this->Maintenance_model->get_req_document_id();
                $this->load->view("admin-header", $data);
                $this->load->view("admin-header-switch");
                $this->load->view("nav-maintenance");
                $this->load->view("maintenance_add_requirement");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            } 
        }

        public function add_category_form() {

            if($this->session->userdata("usertype") == "1") {
                $data["title"] = "Add Job Category";
                $data['cat'] = $this->Maintenance_model->get_category_id();
                $this->load->view("admin-header", $data);
                $this->load->view("nav-maintenance");
                $this->load->view("maintenance_add_category");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            } 
        }

        public function add_job_position_form() {

            if($this->session->userdata("usertype") == "1") {
                $data["title"] = "Add Job Position";
                $data['job'] = $this->Maintenance_model->get_job_position_id();
                $data['job_cat'] = $this->Maintenance_model->get_job_category();
                $data['job_skill_set'] = $this->Maintenance_model->get_skill_set();
           
                $this->load->view("admin-header", $data);
                $this->load->view("nav-maintenance");
                $this->load->view("maintenance_add_job_position");
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            } 
        }

        public function edit_req_document_form($id) {

            if($this->session->userdata("usertype") == "1") {
                $data["title"] = "Edit Required Documents";
                $data['doc'] = $this->Maintenance_model->get_req_document_details($id);
                $data['req'] = $this->Maintenance_model->get_req_document_check_details($id);
                foreach($data['req'] as $result) {
                    if(!empty($result) && $result->status != 3){   
                        $this->load->view("admin-header", $data);
                        $this->load->view("nav-maintenance");
                        $this->load->view("admin-header-switch");
                        $this->load->view("maintenance_edit_requirement");  
                    }
                    else{
                        $this->session->set_flashdata("access_error_notification", "Sorry, data doesn't exist.");
                        echo json_encode(array("success" => FALSE));
                        redirect(base_url("maintenance/required_documents/"));
                    }   
                }   
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            } 
        }

        public function edit_category_form($id) {

            if($this->session->userdata("usertype") == "1") {
                $data["title"] = "Edit Job Category";
                $data['cat'] = $this->Maintenance_model->get_category_details($id);
                $data['job_cat'] = $this->Maintenance_model->get_category_check_details($id);
                foreach($data['job_cat'] as $result) {
                    if(!empty($result) && $result->status != 3){   
                        $this->load->view("admin-header", $data);
                        $this->load->view("nav-maintenance");
                        $this->load->view("maintenance_edit_category");  
                    }
                    else{
                        $this->session->set_flashdata("access_error_notification", "Sorry, data doesn't exist.");
                        echo json_encode(array("success" => FALSE));
                        redirect(base_url("maintenance/"));
                    }   
                }   
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            } 
        }

        public function edit_job_position_form($id) {

            if($this->session->userdata("usertype") == "1") {
                $data["title"] = "Edit Job Position";
                $data['job'] = $this->Maintenance_model->get_job_position_details($id);
                $data['job_pos'] = $this->Maintenance_model->get_position_check_details($id);
                $data['job_cat'] = $this->Maintenance_model->get_job_category();
                $data['skill_set'] = $this->Maintenance_model->get_skill_set();
                $data['skill'] = $this->Maintenance_model->get_skill();
            
                foreach($data['job_pos'] as $result) {
                    if(!empty($result) && $result->status != 3){   
                        $this->load->view("admin-header", $data);
                        $this->load->view("nav-maintenance");
                        $this->load->view("maintenance_edit_job_position");  
                    }
                    else{
                        $this->session->set_flashdata("access_error_notification", "Sorry, data doesn't exist.");
                        echo json_encode(array("success" => FALSE));
                        redirect(base_url("maintenance/job_position/"));
                    }   
                }   
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            } 
        }


        public function delete_req_document_form($id) {

            if($this->session->userdata("usertype") == "1") {
                $data["title"] = "Delete Required Documents";
                $data['doc'] = $this->Maintenance_model->get_req_document_details($id);
                $data['req'] = $this->Maintenance_model->get_req_document_check_details($id);
                foreach($data['req'] as $result) {
                    if(!empty($result) && $result->status != 3){   
                        $this->load->view("admin-header", $data);
                        $this->load->view("nav-maintenance");
                        $this->load->view("maintenance_delete_requirement");  
                    }
                    else{
                        $this->session->set_flashdata("access_error_notification", "Sorry, data doesn't exist.");
                        echo json_encode(array("success" => FALSE));
                        redirect(base_url("maintenance/required_documents/"));
                    }   
                }   
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            } 
        }

        public function delete_category_form($id) {

            if($this->session->userdata("usertype") == "1") {
                $data["title"] = "Delete Job Category";
                $data['cat'] = $this->Maintenance_model->get_category_details($id);
                $data['job_cat'] = $this->Maintenance_model->get_category_check_details($id);
                foreach($data['job_cat'] as $result) {
                    if(!empty($result) && $result->status != 3){   
                        $this->load->view("admin-header", $data);
                        $this->load->view("nav-maintenance");
                        $this->load->view("maintenance_delete_category");  
                    }
                    else{
                        $this->session->set_flashdata("access_error_notification", "Sorry, data doesn't exist.");
                        echo json_encode(array("success" => FALSE));
                        redirect(base_url("maintenance/"));
                    }   
                }   
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            } 
        }

        public function delete_job_position_form($id) {

            if($this->session->userdata("usertype") == "1") {
                $data["title"] = "Delete Job Position";
                $data['job'] = $this->Maintenance_model->get_job_position_all_details($id);
                $data['job_pos'] = $this->Maintenance_model->get_position_check_details($id);
                foreach($data['job_pos'] as $result) {
                    if(!empty($result) && $result->status != 3){   
                        $this->load->view("admin-header", $data);
                        $this->load->view("nav-maintenance");
                        $this->load->view("maintenance_delete_job_position");  
                    }
                    else{
                        $this->session->set_flashdata("access_error_notification", "Sorry, data doesn't exist.");
                        echo json_encode(array("success" => FALSE));
                        redirect(base_url("maintenance/job_position/"));
                    }   
                }   
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            } 
        }

		public function view_job_position_form($id){

			if($this->session->userdata("usertype") == "1") {
                $data["title"] = "View Job Details";
                $data['job'] = $this->Maintenance_model->get_job_position_all_details($id);
                $data['job_pos'] = $this->Maintenance_model->get_position_check_details($id);
                foreach($data['job_pos'] as $result) {
                    if(!empty($result) && $result->status != 3){   
                        $this->load->view("admin-header", $data);
                        $this->load->view("nav-maintenance");
                        $this->load->view("maintenance_view_job_details");  
                    }
                    else{
                        $this->session->set_flashdata("access_error_notification", "Sorry, data doesn't exist.");
                        echo json_encode(array("success" => FALSE));
                        redirect(base_url("maintenance/job_position/"));
                    }   
                } 
            }
            else {
                $this->session->set_flashdata("invalid", "Sorry, you are unauthorized to view this page.");
                redirect(base_url("login"));
            } 
		}

        //add control
        public function add_req_document() {
            $this->input->post("req_follow") ? $req_follow = 0 : $req_follow = 1;
            $if_exist = $this->Maintenance_model->requirement_col_status_converter($this->input->post("req_name"), $req_follow);
            $if_exist == 0 ? $is_unique = "|is_unique[requirement.requirement]": $is_unique = "";
          
            $this->form_validation->set_rules("req_name", "Requirement Document Name", "required|regex_match[/^[a-zA-Z\s'-\.]+$/]|strip_tags|xss_clean".$is_unique, array('is_unique' => '%s already exists.'));

            if($this->form_validation->run() !== FALSE) {

                if($if_exist == 0){
                    $data = array(
                        "requirement" => $this->input->post("req_name"),
                        "is_required" => $req_follow,
                        "status" => 0
                    );

                    $this->Maintenance_model->insert_req_document($data);
                }

                $this->session->set_flashdata("success_notification", "Congratulations! You have successfully added new required document.");
                echo json_encode(array("success" => TRUE));

                redirect(base_url("maintenance/required_documents/"));
            }
            else {
                $this->session->set_flashdata("fail_notification", "Sorry, there were some errors encountered. Please review the form.");
                $this->add_req_document_form();
            }
        }

        public function add_category() {
            $if_exist = $this->Maintenance_model->category_col_status_converter($this->input->post("cat_name"));
            $if_exist == 0 ? $is_unique = "|is_unique[job_category.name]": $is_unique = "";

            $this->form_validation->set_rules("cat_name", "Job Category Name", "required|regex_match[/^[a-zA-Z\s'-\.]+$/]|strip_tags|xss_clean".$is_unique, array('is_unique' => '%s already exists.'));

            if($this->form_validation->run() !== FALSE) {
                if($if_exist == 0){
                    $data = array(
                        "name" => $this->input->post("cat_name"),
                        "status" => 0
                    );

                    $this->Maintenance_model->insert_category($data);
                }
                  
                $this->session->set_flashdata("success_notification", "Congratulations! You have successfully added new job category.");
                echo json_encode(array("success" => TRUE));

                redirect(base_url("maintenance/"));
            }
            else {
                $this->session->set_flashdata("fail_notification", "Sorry, there were some errors encountered. Please review the form.");
                $this->add_category_form();
            }
        }

        public function add_job_position() {
            $if_exist = $this->Maintenance_model->job_position_col_status_converter($this->input->post("job_name"), $this->input->post("job_cat"), $this->input->post("job_sf"), $this->input->post("skill_set"), array_unique($this->input->post("skill[]")));
            $if_exist == 0 ? $is_unique = "|is_unique[job_position.name]": $is_unique = "";

            $this->form_validation->set_rules("job_cat", "Job Category", "required|regex_match[/^[0-9]+$/]|strip_tags|xss_clean");
            $this->form_validation->set_rules("job_name", "Job Position Name", "required|regex_match[/^[a-zA-Z\s'-\.]+$/]|strip_tags|xss_clean".$is_unique, array('is_unique' => '%s already exists.'));
            $this->form_validation->set_rules("job_sf", "Job Service fee", "required|regex_match[/^[0-9,\.]+$/]|strip_tags|xss_clean");
            $this->form_validation->set_rules("skill_set", "Job Skill Set", "required|strip_tags|xss_clean");
            $this->form_validation->set_rules("skill[]", "Job Skill", "required|strip_tags|xss_clean");

            if($this->form_validation->run() !== FALSE) {
                
                if($if_exist == 0){
                    $skill_set = $this->input->post("skill_set");
                    $skill = array_unique($this->input->post("skill[]"));

                    $skill_set = $this->Maintenance_model->check_select_skill_set($skill_set);
                    foreach ($skill as $index => $skillVal) {
                       $dataSkill[$index] = $this->Maintenance_model->check_select_skill($skill_set, $skillVal);
                    }

                    $data = array(
                        "job_cat" => $this->input->post("job_cat"),
                        "job_skill_set" => $skill_set,
                        "name" => $this->input->post("job_name"),
                        "service_fee" => $this->input->post("job_sf"),
                        "status" => 0
                    );
                    $jobID = $this->Maintenance_model->insert_job_position($data);

                    foreach ($dataSkill as $skillVal) {
                        $data = array(
                            "job_position_id" => $jobID,
                            "skill_id" => $skillVal
                        );
                        $this->Maintenance_model->insert_job_position_skill($data); 
                    }
                }

                $this->session->set_flashdata("success_notification", "Congratulations! You have successfully added new job position.");
                echo json_encode(array("success" => TRUE));

                redirect(base_url("maintenance/job_position/"));
            }
            else {

                $this->session->set_flashdata("fail_notification", "Sorry, there were some errors encountered. Please review the form.");
                $this->add_job_position_form();
            }
        }


        //edit control
        public function edit_req_document() {
            $this->input->post("req_follow") ? $req_follow = 0 : $req_follow = 1;
            $if_exist = $this->Maintenance_model->requirement_col_status_converter($this->input->post("req_name"), $req_follow);
            $if_exist == 0 ? $is_unique = "|is_unique[requirement.requirement]": $is_unique = "";
            $id = $this->input->post("req_id");

            $this->form_validation->set_rules("req_name", "Requirement Document Name", "required|regex_match[/^[a-zA-Z\s'-\.]+$/]|strip_tags|xss_clean".$is_unique, array('is_unique' => '%s already exists.'));
      
            if($this->form_validation->run() !== FALSE) {
                if($if_exist == 0){
                   $this->input->post("req_follow") ? $req_follow = 0 : $req_follow = 1;
                    $data = array(
                        "requirement" => $this->input->post("req_name"),
                        "is_required" => $req_follow
                    );

                    $this->Maintenance_model->update_req_document($id, $data);
                }

                $this->session->set_flashdata("success_notification", "Congratulations! You have successfully edited required document.");
                echo json_encode(array("success" => TRUE));
                redirect(base_url("maintenance/required_documents/"));
            }
            else {
                $this->session->set_flashdata("fail_notification", "Sorry, there were some errors encountered. Please review the form.");
                $this->edit_req_document_form($id);
            }
        }

        public function edit_category() {
            $if_exist = $this->Maintenance_model->category_col_status_converter($this->input->post("cat_name"));
            $if_exist == 0 ? $is_unique = "|is_unique[job_category.name]": $is_unique = "";
            $id = $this->input->post("cat_id");

            $this->form_validation->set_rules("cat_name", "Job Category Name", "required|regex_match[/^[a-zA-Z\s'-\.]+$/]|strip_tags|xss_clean".$is_unique, array('is_unique' => '%s already exists.'));
           
            if($this->form_validation->run() !== FALSE) {
                if($if_exist == 0){
                   
                    $data = array(
                        "name" => $this->input->post("cat_name")
                    );

                    $this->Maintenance_model->update_category($id, $data);
                }

                $this->session->set_flashdata("success_notification", "Congratulations! You have successfully edited job category.");
                echo json_encode(array("success" => TRUE));

                redirect(base_url("maintenance/"));
            }
            else {
                $this->session->set_flashdata("fail_notification", "Sorry, there were some errors encountered. Please review the form.");
                $this->edit_category_form($id);
            }
        }

        public function edit_job_position() {

            $if_exist = $this->Maintenance_model->job_position_col_status_converter($this->input->post("job_name"), $this->input->post("job_cat"), $this->input->post("job_sf"), $this->input->post("skill_set"), array_unique($this->input->post("skill[]")));
            $if_exist == 0 ? $is_unique = "|is_unique[job_position.name]": $is_unique = "";
            $id = $this->input->post("job_id");

            $this->form_validation->set_rules("job_cat", "Job Category", "required|regex_match[/^[0-9]+$/]|strip_tags|xss_clean");
            $this->form_validation->set_rules("job_name", "Job name", "required|regex_match[/^[a-zA-Z\s'-\.]+$/]|strip_tags|xss_clean".$is_unique, array('is_unique' => '%s already exists.'));
            $this->form_validation->set_rules("job_sf", "Job Service fee", "required|regex_match[/^[0-9,\.]+$/]|strip_tags|xss_clean");
            $this->form_validation->set_rules("skill_set", "Skill set", "required|strip_tags|xss_clean");
            $this->form_validation->set_rules("skill[]", "skill", "required|strip_tags|xss_clean");


            if($this->form_validation->run() !== FALSE) {
                if($if_exist == 0){
                    $skill_set = $this->input->post("skill_set");
                    $skill = array_unique($this->input->post("skill[]"));

                    $skill_set = $this->Maintenance_model->check_select_skill_set($skill_set);
                
                    foreach ($skill as $index => $skillVal) {
                       $dataSkill[$index] = $this->Maintenance_model->check_select_skill($skill_set, $skillVal);
                    }
                      
                    $data = array(
                        "job_cat" => $this->input->post("job_cat"),
                        "job_skill_set" => $skill_set,
                        "name" => $this->input->post("job_name"),
                        "service_fee" => $this->input->post("job_sf"),
                        "status" => 0
                    );

                    $this->Maintenance_model->update_job_position($id, $data); 
                    $this->Maintenance_model->update_job_position_skill($id, $dataSkill);

                }
                
                $this->session->set_flashdata("success_notification", "Congratulations! You have successfully edited job position.");
                echo json_encode(array("success" => TRUE));

                redirect(base_url("maintenance/job_position/"));
            }
            else {
             
                $this->session->set_flashdata("fail_notification", "Sorry, there were some errors encountered. Please review the form.");
                $this->edit_job_position_form($id);
            }
        }


        //delete control
        public function delete_req_document() {

            $this->form_validation->set_rules("req_id", "Requirement Document ID", "required");
            $id = $this->input->post("req_id");

            if($this->form_validation->run() !== FALSE) {
                
                $data = array(
                    "status" => 3
                );

                $this->Maintenance_model->delete_req_document($id, $data);  
                $this->session->set_flashdata("success_notification", "Congratulations! You have successfully deleted required document.");
                echo json_encode(array("success" => TRUE));

                redirect(base_url("maintenance/required_documents/"));

            }
            else {
                $this->session->set_flashdata("fail_notification", "Sorry, there were some errors encountered. Please review the form.");
                $this->delete_req_document_form($id);
            }
        }

        public function delete_category() {

            $this->form_validation->set_rules("cat_id", "Job Category ID", "required");
            $id = $this->input->post("cat_id");

            if($this->form_validation->run() !== FALSE) {
                
                $data = array(
                    "status" => 3
                );

                $this->Maintenance_model->delete_category($id, $data);  
                $this->session->set_flashdata("success_notification", "Congratulations! You have successfully deleted job category.");
                echo json_encode(array("success" => TRUE));

                redirect(base_url("maintenance/"));
            }
            else {
                $this->session->set_flashdata("fail_notification", "Sorry, there were some errors encountered. Please review the form.");
                $this->delete_category_form($id);
            }
        }

        public function delete_job_position() {

            $this->form_validation->set_rules("job_id", "Job Position ID", "required");
            $id = $this->input->post("job_id");

            if($this->form_validation->run() !== FALSE) {
                $data = array(
                    "status" => 3
                );

                $this->Maintenance_model->delete_job_position($id, $data);  
                $this->session->set_flashdata("success_notification", "Congratulations! You have successfully deleted job position.");
                echo json_encode(array("success" => TRUE));

                redirect(base_url("maintenance/job_position/"));
            }
            else{
                $this->session->set_flashdata("fail_notification", "Sorry, there were some errors encountered. Please review the form.");
                $this->delete_job_position_form($id);
            }
        }

        //status control
        public function status_req_document(){

            $this->form_validation->set_rules("req_id", "Requirement ID", "required|numeric");
            $this->form_validation->set_rules("req_status", "Requirement Status", "required|greater_than_equal_to[0]|less_than_equal_to[1]");

            if($this->form_validation->run() !== FALSE) {
                $id = $this->input->post("req_id");
                $data = array(
                    "status" => $this->input->post("req_status")
                );

                $this->Maintenance_model->status_req_document($id, $data); 
            }
        }

        public function status_category(){

            $this->form_validation->set_rules("cat_id", "Category ID", "required|numeric");
            $this->form_validation->set_rules("cat_status", "Requirement Status", "required|greater_than_equal_to[0]|less_than_equal_to[1]");

            if($this->form_validation->run() !== FALSE) {
                $id = $this->input->post("cat_id");
                $data = array(
                    "status" => $this->input->post("cat_status")
                );

                $this->Maintenance_model->status_category($id, $data); 
            }
        }

        public function status_job(){

            $this->form_validation->set_rules("job_id", "Job position ID", "required|numeric");
            $this->form_validation->set_rules("job_status", "Job position Status", "required|greater_than_equal_to[0]|less_than_equal_to[1]");

            if($this->form_validation->run() !== FALSE) {
                $id = $this->input->post("job_id");
                $data = array(
                    "status" => $this->input->post("job_status")
                );

                $this->Maintenance_model->status_job($id, $data); 
            }
        }

        //change select control
        public function change_select_skill_id(){

            $this->form_validation->set_rules("skill_set", "Job skill set ID", "required|numeric");

            if($this->form_validation->run() !== FALSE) {
                $id = $this->input->post("skill_set");
                $data = $this->Maintenance_model->get_select_skill_name($id);
                echo json_encode($data);
            }
        }

	}
?>