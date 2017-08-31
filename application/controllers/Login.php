<?php
	class Login extends CI_Controller {


        public function index() {

        	$data['title'] = "Log In";
            $this->load->view("login", $data); 
        }

        public function check_user() {

            $user = $this->input->post("username");
            $pass = $this->input->post("password");
        	if ($user == 'admin' && $pass == 'admin') {

                $this->session->set_userdata("usertype" ,"1");
                redirect(base_url('dashboard/'));
            }
            else {
                $this->load->model("Client_model");
                if($this->Client_model->check_client($user, $pass)) {
                    $this->session->set_userdata("usertype", "2");
                    $client = $this->Client_model->check_client($user, $pass);
                    $name = $client->type == 1 ? $client->comp_name : $client->full_name;
                    $cl = array(
                        'id' => $client->id,
                        'name' => $name
                    );
                    $this->session->set_userdata($cl);
                    redirect(base_url('client/'));
                }
            }
            
            $this->session->set_flashdata("invalid", "Invalid username and password.");
            redirect(base_url("login"));
        }

        public function logout() {

            $this->session->unset_userdata("usertype");
            $this->session->unset_userdata($cl);
            redirect(base_url());
        }

        public function refresh(){
            // Captcha configuration
            $config = array(
                'img_path'      => 'captcha_images/',
                'img_url'       => base_url().'captcha_images/',
                'img_width'     => '150',
                'img_height'    => 50,
                'word_length'   => 8,
                'font_size'     => 16
            );
            $captcha = create_captcha($config);
            
            // Unset previous captcha and store new captcha word
            $this->session->unset_userdata('captchaCode');
            $this->session->set_userdata('captchaCode',$captcha['word']);
            
            // Display captcha image
            echo $captcha['image'];
        }
    }


?>