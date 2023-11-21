<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Authentication extends Controller {

    public function __construct() {
        parent:: __construct();
        $this->call->model('Tourist_Account_Model', 'users');
    }

    public function register(){
        $random = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ", 60)), 0, 60);
        $this->form_validation
		->name('username')
			->required()
            ->is_unique('tourist_account', 'username', $_POST['username'], 'A user exists with that username. Please change your username.')
			->min_length(6)
			->max_length(30)
        ->name('email')
			->required()
            ->is_unique('tourist_account', 'email', $_POST['email'], 'A user exists with that email. Please change your email.')
            ->valid_email()
        ->name('address')
            ->required()
		->name('password')
			->required()
            ->custom_pattern("^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$", 'The password must contain a minimum of eight characters, at least one letter, one number and one special character:')
		->name('c_password')
			->matches('password')
			->required()
        ->name('phone')
            ->required()
            ->is_unique('tourist_account', 'phone', $_POST['phone'], 'A user exists with that phone number. Please change your phone number.')
            ->min_length(11,"")
            ->max_length(11,"")
            ->custom_pattern("^(09)\d{9}$","Your Phone Number must follow this format: 09XXXXXXXXX");

        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('msg', $this->form_validation->errors());
            redirect(site_url().'/register');
        
        }
        else {

            $data = [
                'username' => html_escape($_POST['username']),
                'email' => html_escape($_POST['email']),
                'password' => password_hash(html_escape($_POST['password']), PASSWORD_DEFAULT),
                'token' => sha1($random),
                'phone' => html_escape($_POST['phone']),
                'address' => html_escape($_POST['address']),
                'status' => 'UNVERIFIED'
            ];

            $result = $this->users->Register_Tourist($data['username'] ,$data['email'], $data['password'], $data['token'], $data['phone'], $data['address'], $data['status']);
            if ($result) {
                $this->session->set_flashdata('msg','You have registered sucessfully.');
                redirect(site_url().'/account');
            }else {
                $this->session->set_flashdata('msg','Something went wrong.');
                redirect(site_url().'/register');
            }
        }

    }

    public function login() {
        $random = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ", 60)), 0, 60);
        $newToken = $random;
        
        if($_POST['username']) {

            $username = $_POST['username'];
            $password = $_POST['password'];

            $result = $this->users->Login_User_Uname($username);

            if($result){ 

                $pass = $result['password'];
                $authenticatePassword = password_verify($password, $pass);

                if($authenticatePassword){ 
                    $new = $this->users->New_Token_Uname($username, sha1($newToken));
                    if($new) {
                        $userdata = array(
                            'token' => $newToken,
                            'logged_in' => TRUE
                        );
                        $this->session->set_userdata($userdata);
                        redirect(site_url().'/account');

                    } else {
                        $this->session->set_flashdata('msg','A session could not be started. Please try again later.');
                        redirect(site_url().'/login');
                    }
    
                }else{ 
    
                    $this->session->set_flashdata('msg','wrong password.');
                    redirect(site_url().'/login');
    
                } 
    
            } else {
                $this->session->set_flashdata('msg','User doesn\'t exists.');
                redirect(site_url().'/login');
            }
        } else {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $result = $this->users->Login_User_Email($email);

            if($result){ 

                $pass = $result['password'];
                $authenticatePassword = password_verify($password, $pass);

                if($authenticatePassword){ 
                    $new = $this->users->New_Token_Email($email, sha1($newToken));
                    if($new) {
                        $userdata = array(
                            'token' => $newToken,
                            'logged_in' => TRUE
                        );
                        $this->session->set_userdata($userdata);
                        redirect(site_url().'/account');

                    } else {
                        $this->session->set_flashdata('msg','A session could not be started. Please try again later.');
                        redirect(site_url().'/login');
                    }
    
                }else{ 
    
                    $this->session->set_flashdata('msg','wrong password.');
                    redirect(site_url().'/login');
    
                } 
    
            } else {
                $this->session->set_flashdata('msg','User doesn\'t exists.');
                redirect(site_url().'/login');
            }
        }
    }

    public function logout() {
        $random = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ", 60)), 0, 60);
        $newToken = $random;
        $prevToken = sha1($_SESSION['token']);
        $new = $this->users->New_Token($prevToken, sha1($newToken));
        if($new) {
            session_destroy();
            redirect(site_url().'/login');
        } else {
            $this->session->set_flashdata('msg','Something went wrong');
            redirect(site_url().'/');
        }
    }
	
}
?>
