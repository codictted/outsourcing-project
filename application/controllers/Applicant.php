<?php
    class Applicant extends CI_Controller {


        function __construct() {

            parent::__construct();
            $this->load->model("Dropdown_model");
        }

        public function get_skill_set() {

            return $this->Dropdown_model->get_skill_set();
        }

        public function get_job_cat() {

            return $this->Dropdown_model->get_job_category();
        }

        public function get_course() {

            return $this->Dropdown_model->get_course_list();
        }

        public function index() {

            $data["job_cat"] = $this->get_job_cat();
            $data["set"] = $this->get_skill_set();
            $data['education'] = $this->Dropdown_model->get_education();
            $data["course"] = $this->get_course();
            $data["spoken"] = $this->Dropdown_model->get_spoken_lang();
            $data["religion"] = $this->Dropdown_model->get_religion();
            $data["title"] = "Application Form";
            $this->load->view("header", $data);
            $this->load->view("nav");
            $this->load->view("application_form", $data);
        }

        public function get_job_position_list($id) {

            $data = $this->Dropdown_model->get_job_position_list($id);
            echo json_encode($data);
        }

        public function get_skill_list($id) {

            $data = $this->Dropdown_model->get_skill_list($id);
            echo json_encode($data);
        }

        public function submit() {

            $this->form_validation->set_rules(
                "job_pos",
                "Job Position",
                "required"
            );

            $this->form_validation->set_rules(
                "fname",
                "First Name",
                "required|strip_tags|xss_clean"
            );

            $this->form_validation->set_rules(
                "mname",
                "Middle Name",
                "strip_tags|xss_clean"
            );

            $this->form_validation->set_rules(
                "lname",
                "Last Name",
                "required|strip_tags|xss_clean"
            );

            $this->form_validation->set_rules(
                "ext",
                "Name Extension",
                "max_length[3]|strip_tags|xss_clean"
            );

            $this->form_validation->set_rules(
                "civil",
                "Civil Status",
                "required"
            );

            $this->form_validation->set_rules(
                "nationality",
                "Nationality",
                "required"
            );

            $this->form_validation->set_rules(
                "gender",
                "Gender",
                "required"
            );

            $this->form_validation->set_rules(
                "cnum",
                "Mobile Number",
                "required|numeric|exact_length[11]|strip_tags|xss_clean"
            );

            $this->form_validation->set_rules(
                "tnum",
                "Tel Number",
                "numeric|exact_length[7]|strip_tags|xss_clean"
            );
           
           $this->form_validation->set_rules(
                "street",
                "Street Address",
                "required|strip_tags|xss_clean"
            );

            $this->form_validation->set_rules(
                "city",
                "City",
                "required|strip_tags|xss_clean"
            );

            $this->form_validation->set_rules(
                "province",
                "Province",
                "required|strip_tags|xss_clean"
            );
            $this->form_validation->set_rules(
                "zip",
                "Zip Code",
                "numeric|exact_length[4]|strip_tags|xss_clean"
            );

            $this->form_validation->set_rules(
                "bdate",
                "Birth Date",
                "required"
            );

            $this->form_validation->set_rules(
                "religion",
                "Religion",
                "required"
            );

            $this->form_validation->set_rules(
                "course",
                "Course",
                "required|alpha"
            );

            $this->form_validation->set_rules(
                "spoken_lang[]",
                "Spoken Language",
                "required"
            );

            $this->form_validation->set_rules(
                "bstreet",
                "Street Address",
                "required|strip_tags|xss_clean"
            );

            $this->form_validation->set_rules(
                "bcity",
                "City",
                "required|strip_tags|xss_clean"
            );

            $this->form_validation->set_rules(
                "bprovince",
                "Province",
                "required|strip_tags|xss_clean"
            );
            $this->form_validation->set_rules(
                "bzip",
                "Zip Code",
                "numeric|exact_length[4]|strip_tags|xss_clean"
            );

            $this->form_validation->set_rules(
                "school",
                "School",
                "strip_tags|xss_clean"
            );

            $this->form_validation->set_rules(
                "spouse_name",
                "Spouse's Name",
                "strip_tags|xss_clean"
            );

            $this->form_validation->set_rules(
                "d_name",
                "Descendant's Name",
                "strip_tags|xss_clean"
            );

            $this->form_validation->set_rules(
                "guardian",
                "Guardian's Name",
                "required|strip_tags|xss_clean"
            );

            $this->form_validation->set_rules(
                "g_relation",
                "Relationship",
                "required|alpha_numeric_spaces|strip_tags|xss_clean"
            );

            $this->form_validation->set_rules(
                "g_contact",
                "Contact Number",
                "required|numeric|exact_length[11]|strip_tags|xss_clean"
            );

            $this->form_validation->set_rules(
                "employer",
                "Employer",
                "strip_tags|xss_clean"
            );

            $this->form_validation->set_rules(
                "exp_pos",
                "Position",
                "strip_tags|xss_clean"
            );

            $this->form_validation->set_rules(
                "emp_address",
                "Address",
                "strip_tags|xss_clean"
            );

            $this->form_validation->set_rules(
                "training_title",
                "Title",
                "strip_tags|xss_clean"
            );

            $this->form_validation->set_rules(
                "training_org",
                "Organizer",
                "strip_tags|xss_clean"
            );

             $this->form_validation->set_rules(
                "training_address",
                "Address",
                "strip_tags|xss_clean"
            );

            $this->form_validation->set_rules(
                "answer_1",
                "Question 1",
                "required",
                array('required' => 'Please answer question number 1')
            );

            $this->form_validation->set_rules(
                "answer_2",
                "Question 2",
                "required",
                array('required' => 'Please answer question number 2')
            );

            $this->form_validation->set_rules(
                "answer_3",
                "Question 3",
                "required",
                array('required' => 'Please answer question number 3')
            );

            $this->form_validation->set_rules(
                "answer_4",
                "Question 4",
                "required",
                array('required' => 'Please answer question number 4')
            );

            $this->form_validation->set_rules(
                "answer_5",
                "Question 5",
                "required",
                array('required' => 'Please answer question number 5')
            );

             $this->form_validation->set_rules(
                "IIanswer_1",
                "Question 1",
                "required",
                array('required' => 'Please answer question number 1')
            );

            $this->form_validation->set_rules(
                "IIanswer_2",
                "Question 2",
                "required",
                array('required' => 'Please answer question number 2')
            );

            $this->form_validation->set_rules(
                "IIanswer_3",
                "Question 3",
                "required",
                array('required' => 'Please answer question number 3')
            );

            $this->form_validation->set_rules(
                "IIanswer_4",
                "Question 4",
                "required",
                array('required' => 'Please answer question number 4')
            );

            $this->form_validation->set_rules(
                "IIanswer_5",
                "Question 5",
                "required",
                array('required' => 'Please answer question number 5')
            );

            $this->form_validation->set_rules(
                "essay_answer_1",
                "Essay 1",
                "required|strip_tags|xss_clean",
                array('required' => 'Please provide atleast a short answer')
            );

            $this->form_validation->set_rules(
                "essay_answer_2",
                "Essay 2",
                "required|strip_tags|xss_clean",
                array('required' => 'Please provide atleast a short answer')
            );

             $this->form_validation->set_rules(
                "essay_answer_3",
                "Essay 3",
                "required|strip_tags|xss_clean",
                array('required' => 'Please provide atleast a short answer')
            );

             if($this->form_validation->run() !== FALSE) {

                //applicant details
                $pos = $this->input->post("job_pos");
                $fname = $this->input->post("fname");
                $mname = $this->input->post("mname");
                $lname = $this->input->post("lname");
                $ext = $this->input->post("ext");
                $civil = $this->input->post("civil");
                $nationality = $this->input->post("nationality");
                $weight = $this->input->post("weight");
                $height = $this->input->post("height");
                $gender = $this->input->post("gender");
                $cel = $this->input->post("cnum");
                $tel = $this->input->post("tnum");
                $street = $this->input->post("street");
                $city = $this->input->post("city");
                $province = $this->input->post("province");
                $zip = $this->input->post("zip");
                $bdate = $this->input->post("bdate");
                $religion = $this->input->post("religion");
                $spoken_language = array_unique($this->input->post("spoken_lang[]"));
                $bstreet = $this->input->post("bstreet");
                $bcity = $this->input->post("bcity");
                $bprovince = $this->input->post("bprovince");
                $bzip = $this->input->post("bzip");
                $educ = $this->input->post("education");
                $year = $this->input->post("level");
                $school = $this->input->post("school");
                $course = $this->input->post("course");
                $spouse_name = $this->input->post("spouse_name");
                $spouse_bdate = $this->input->post("spouse_bdate");
                $guardian = $this->input->post("guardian");
                $g_relation = $this->input->post("g_relation");
                $g_contact = $this->input->post("g_contact");
                $status = 0;
                $now = new DateTime(NULL, new DateTimeZone("Asia/Manila"));

                $religion = $this->Dropdown_model->check_select_religion($religion);

                $course = $this->Dropdown_model->check_select_course($course);

                
                foreach ($spoken_language as $index => $spokenVal) {
                       $dataSpokenLang[$index] = $this->Dropdown_model->check_select_spoken_language($spokenVal);
                }
               

                $applicant_details = array(
                    "job_id" => $pos,
                    "first_name" => $fname,
                    "middle_name" => $mname,
                    "last_name" => $lname,
                    "name_ext" => $ext,
                    "civil_status" => $civil,
                    "nationality" => $nationality,
                    "weight" => $weight,
                    "height" => $height,
                    "gender" => $gender,
                    "mobile" => $cel,
                    "tel_num" => $tel,
                    "street_address" => $street,
                    "city" => $city,
                    "province" => $province,
                    "zip" => $zip,
                    "birthdate" => $bdate,
                    "religion" => $religion,
                    "birth_address" => $bstreet,
                    "birth_city" => $bcity,
                    "birth_province" => $bprovince,
                    "birth_zip" => $bzip,
                    "education" => $educ,
                    "year_level" => $year,
                    "school" => $school,
                    "course" => $course,
                    "spouse" => $spouse_name,
                    "spouse_bdate" => $spouse_bdate,
                    "guardian" => $guardian,
                    "relationship" => $g_relation,
                    "guardian_contact" => $g_contact,
                    "status" => $status,
                    "application_date" => $now->format("Y:m:d H:i:s")

                );

                //personality exam and essay
                $answer1 = $this->input->post("answer_1");
                $answer2 = $this->input->post("answer_2");
                $answer3 = $this->input->post("answer_3");
                $answer4 = $this->input->post("answer_4");
                $answer5 = $this->input->post("answer_5");
                $IIanswer1 = $this->input->post("IIanswer_1");
                $IIanswer2 = $this->input->post("IIanswer_2");
                $IIanswer3 = $this->input->post("IIanswer_3");
                $IIanswer4 = $this->input->post("IIanswer_4");
                $IIanswer5 = $this->input->post("IIanswer_5");
                $eanswer1 = $this->input->post("essay_answer_1");
                $eanswer2 = $this->input->post("essay_answer_2");
                $eanswer3 = $this->input->post("essay_answer_3");

                $this->load->model("Applicant_model");

                $app_id = $this->Applicant_model->insert_applicant($applicant_details);
            

                //insert dataspoken
                foreach ($dataSpokenLang as $spokenVal) {
                        $data = array(
                            "applicant_id" => $app_id,
                            "lang_id" => $spokenVal
                        );
                    $this->Applicant_model->insert_spoken_language($data); 
                }

                //insert descendants
                $descendants = $this->input->post("d_name");
                $d_gender = $this->input->post("d_gender");
                $d_date = $this->input->post("d_date");
                $counter = count($descendants);
                if($counter > 0  && ($descendants[0] != "")) {
                    for($i = 0; $i < $counter; $i++) {
                        $data = array(
                            "applicant_id" => $app_id,
                            "name" => $descendants[$i],
                            "gender" => $d_gender[$i],
                            "bdate" =>$d_date[$i]
                        );

                        $this->Applicant_model->insert_descendants($data);
                    }
                }

                //insert experience
                $employer = $this->input->post("employer");
                $exp_pos = $this->input->post("exp_pos");
                $emp_years = $this->input->post("year_exp");
                $emp_address = $this->input->post("emp_address");
                $counter = count($employer);
                if($counter > 0  && ($employer[0] != "")) {
                    for($i = 0; $i < $counter; $i++) {
                        $emp_address[$i] = $emp_address[$i] == "" ? "N/A" : $emp_address[$i];
                        $data = array(
                            "applicant_id" => $app_id,
                            "employer" => $employer[$i],
                            "address" => $emp_address[$i],
                            "years_employed" => $exp_pos[$i],
                            "position" => $exp_pos[$i]
                        );

                        $this->Applicant_model->insert_exp($data);
                    }
                }

                //insert skills
                $skill = $this->input->post("skills");
                $count = count($skill);
                if($count > 0) {

                    for($i = 0; $i < $count; $i++) {

                        $data = array(
                            "applicant_id" => $app_id,
                            "skill_id" => $skill[$i]
                        );

                        $this->Applicant_model->insert_skills($data);
                    }
                }

                //insert seminar/training
                $training_title = $this->input->post("training_title");
                $training_org = $this->input->post("training_org");
                $s_training_date = $this->input->post("start_traning_date");
                $e_training_date = $this->input->post("end_training_date");
                $training_address = $this->input->post("training_address");
                $count = count($training_title);
                if($counter > 0 && ($training_title[0] != "")) {
                    for($i = 0; $i < $count; $i++) {
                        $training_org[$i] = $training_org[$i] == "" ? "N/A" : $training_org[$i];
                        $e_training_date = is_null($e_training_date) ? $s_training_date[$i] : $e_training_date[$i];
                        $training_address[$i] = $training_address[$i] == "" ? "N/A" : $training_address[$i];

                        $data = array(
                            "applicant_id" => $app_id,
                            "name" => $training_title[$i],
                            "organizer" => $training_org[$i],
                            "train_from" => $s_training_date[$i],
                            "train_to" => $e_training_date[$i],
                            "address" => $training_address[$i]
                        );

                        $this->Applicant_model->insert_training($data);
                    }
                }

                $personality_exam = array(

                    array(
                        "applicant_id" => $app_id,
                        "question" => 1,
                        "answer" => $answer1
                    ),
                    array(
                        "applicant_id" => $app_id,
                        "question" => 2,
                        "answer" => $answer2
                    ),
                    array(
                        "applicant_id" => $app_id,
                        "question" => 3,
                        "answer" => $answer3
                    ),
                    array(
                        "applicant_id" => $app_id,
                        "question" => 4,
                        "answer" => $answer4
                    ),
                    array(
                        "applicant_id" => $app_id,
                        "question" => 5,
                        "answer" => $answer5
                    ),
                    array(
                        "applicant_id" => $app_id,
                        "question" => 6,
                        "answer" => $IIanswer1
                    ),
                    array(
                        "applicant_id" => $app_id,
                        "question" => 7,
                        "answer" => $IIanswer2
                    ),
                    array(
                        "applicant_id" => $app_id,
                        "question" => 8,
                        "answer" => $IIanswer3
                    ),
                    array(
                        "applicant_id" => $app_id,
                        "question" => 9,
                        "answer" => $IIanswer4
                    ),
                    array(
                        "applicant_id" => $app_id,
                        "question" => 10,
                        "answer" => $IIanswer5
                    )
                );

                $essay = array(

                    array(
                        "applicant_id" => $app_id,
                        "question" => 1,
                        "answer" => $eanswer1
                    ),
                    array(
                        "applicant_id" => $app_id,
                        "question" => 2,
                        "answer" => $eanswer2
                    ),
                    array(
                        "applicant_id" => $app_id,
                        "question" => 3,
                        "answer" => $eanswer3
                    )

                );

                $this->Applicant_model->insert_personality_exam($personality_exam);
                $this->Applicant_model->insert_essay_exam($essay);


                $this->session->set_flashdata("success_notification_application", "Congratulations! You have successfully sent your application form! Please check your phone at all times. Thank you very much for choosing us.");

                redirect(base_url()."applicant/");

             }
            $this->session->set_flashdata("fail_notification_application", "Sorry, there were some errors encountered in your application. Please review your form or try again later.");

            $data["job_cat"] = $this->get_job_cat();
            $data["set"] = $this->get_skill_set();
            $data['title'] = "Application Form";
            $this->load->view("header", $data);
            $this->load->view("nav");
            $this->load->view("application_form", $data);
        }
        public function info() {

        phpinfo();
    }

    }

    
?>
