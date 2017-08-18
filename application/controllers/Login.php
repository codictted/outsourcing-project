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
            $config = array(
            'word'          => $this->random_word(),
            'img_path'      => './captcha/',
            'img_url'       => base_url().'captcha/',
            'img_width'     => '150',
            'img_height'    => 30,
            'expiration'    => 7200,
            'word_length'   => 8,
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
            $this->load->view("captcha", $data);
        }

        public function random_word() {

            $this->load->helper("string");
            return random_string("alpha", 4);
        }

        public function check() {

            $user = $this->input->post("captcha");
            var_dump($this->session->userdata("captchaCode"));
            var_dump($user);
            die();
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

        public function text_try() {

            $num = "09264678950";
            $message = "This is to inform you that we would like to schedule an interview for you tomorrow 4pm.";
            $result = $this->itexmo($num, $message, "TR-ARLEN678950_M2BY3");
            if ($result == ""){
                echo "iTexMo: No response from server!!!
                Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
                Please CONTACT US for help. ";  
            }
            else if ($result == 0){
                echo "Message Sent!";
            }
            else {
                echo "Error Num ". $result . " was encountered!";
            }
        }
    }


?>