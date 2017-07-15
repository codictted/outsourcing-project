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
                redirect(base_url('dashboard'));
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

        public function captcha() {
            $this->load->helper('captcha');
            $vals = array(
            'word'          => 'Random word',
            'img_path'      => './captcha/',
            'img_url'       => base_url().'assets/captcha/',
            'img_width'     => '150',
            'img_height'    => 30,
            'expiration'    => 7200,
            'word_length'   => 8,
            'font_size'     => 16,
            'img_id'        => 'Imageid',
            'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

            // White background and border, black text and red grid
            'colors'        => array(
                    'background' => array(255, 255, 255),
                    'border' => array(255, 255, 255),
                    'text' => array(0, 0, 0),
                    'grid' => array(255, 40, 40)
                )
            );

            $cap = create_captcha($vals);
            print_r($cap['image']);
            echo $cap['image'];
        }
	}
?>