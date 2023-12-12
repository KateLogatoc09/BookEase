<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Authentication extends Controller {

    public function __construct() {
        parent:: __construct();
        $this->call->model('Account_Model', 'users');
    }

    public function register(){
        ini_set('SMTP','mailpit');
        ini_set('smtp_port',1025);

        $random = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ", 60)), 0, 60);

        $this->form_validation
		->name('username')
			->required()
            ->is_unique('user_account', 'username', $_POST['username'], 'A user exists with that username. Please change your username.')
			->min_length(6)
			->max_length(30)
        ->name('email')
			->required()
            ->is_unique('user_account', 'email', $_POST['email'], 'A user exists with that email. Please change your email.')
            ->valid_email()
        ->name('region')
            ->required()
        ->name('province')
            ->required()
        ->name('municipality')
            ->required()
        ->name('barangay')
            ->required()
        ->name('street')
            ->required()
        ->name('zipcode')
            ->required()
		->name('password')
			->required()
            ->custom_pattern("^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$", 'The password must contain a minimum of eight characters, at least one letter, one number and one special character:')
		->name('c_password')
			->matches('password')
			->required()
        ->name('phone')
            ->required()
            ->is_unique('user_account', 'phone', $_POST['phone'], 'A user exists with that phone number. Please change your phone number.')
            ->min_length(11,"Your phone number minimum and maximum length is 11 digits.")
            ->max_length(11,"Your phone number minimum and maximum length is 11 digits.")
            ->custom_pattern("^(09)\d{9}$","Your Phone Number must follow this format: 09XXXXXXXXX");

        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('msg', $this->form_validation->errors());
            if(isset($_POST['role'])) {
                if($_POST['role'] == 'admin') {
                    redirect(site_url().'/admin_register');
                } else {
                    redirect(site_url().'/register');
                }
            } else {
                redirect(site_url().'/');
            }

        } else {
            $username = html_escape($_POST['username']);
            $email = $_POST['email'];
            $password = password_hash(html_escape($_POST['password']), PASSWORD_DEFAULT);
            $token = sha1($random);
            $phone = $_POST['phone'];
            $region = $_POST['region'];
            $province = $_POST['province'];
            $municipality = $_POST['municipality'];
            $barangay = $_POST['barangay'];
            $street = $_POST['street'];
            $zipcode = $_POST['zipcode'];
            $status = 'UNVERIFIED';
            $role = $_POST['role'];

            $result = $this->users->Register($username ,$email , $password, $token, $phone, $region, $province, $municipality, $barangay, $street, $zipcode, $status);
                if ($result) {
                    $result2 = $this->users->Get_ID($username);
                    if($result2) {
                        $result3 = $this->users->User_Role($result2['id'], strtoupper($role));
                        if($result3) {
                            $random2 = substr(str_shuffle(str_repeat("0123456789", 6)), 0, 6);
                            $code = sha1($random2);

                            $this->email->sender('auto_mailing@gmail.com', 'Sample Mailer');
                            $this->email->recipient($email);
                            $this->email->subject('Verification Code');
                            $this->email->email_content($random2);
                            $test = $this->email->send();

                            if($test) {
                                $this->session->set_flashdata('msg','You have to verify your email first before you can login.');
                                $this->session->set_userdata(['email' => $email,'code' => $code]);
                                redirect(site_url().'/verify');
                            } else {
                                $this->session->set_flashdata('msg', 'Unable to send verification code at the moment. Please try again later.');
                                redirect(site_url()."/verify");
                            }
                        } else {
                            if(isset($_POST['role'])) {
                                if($_POST['role'] == 'admin') {
                                    $this->session->set_flashdata('msg','Something went wrong.');
                                    redirect(site_url().'/admin_register');
                                } else {
                                    $this->session->set_flashdata('msg','Something went wrong.');
                                    redirect(site_url().'/register');
                                }
                            } else {
                                redirect(site_url().'/');
                            }
                        }
                    } else {
                        if(isset($_POST['role'])) {
                            if($_POST['role'] == 'admin') {
                                $this->session->set_flashdata('msg','Something went wrong.');
                                redirect(site_url().'/admin_register');
                            } else {
                                $this->session->set_flashdata('msg','Something went wrong.');
                                redirect(site_url().'/register');
                            }
                        } else {
                            redirect(site_url().'/');
                        }
                    }
                } else {

                    if(isset($_POST['role'])) {
                        if($_POST['role'] == 'admin') {
                            $this->session->set_flashdata('msg','Something went wrong.');
                            redirect(site_url().'/admin_register');
                        } else {
                            $this->session->set_flashdata('msg','Something went wrong.');
                            redirect(site_url().'/register');
                        }
                    } else {
                        redirect(site_url().'/');
                    }

                }
                
        }

    }

    public function login() {
        ini_set('SMTP','mailpit');
        ini_set('smtp_port',1025);

        $random = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ", 60)), 0, 60);
        $newToken = $random;
        
        //For username login
        if($_POST['username']) {

            $username = $_POST['username'];
            $password = $_POST['password'];

            $result = $this->users->Login_Uname($username);
            //If user exists
            if($result){ 
                //If verified
                if($result['status'] == 'ACTIVE' || $result['status'] == 'VERIFIED') {
                    $pass = $result['password'];
                    $authenticatePassword = password_verify($password, $pass);
                    //If correct pass
                    if($authenticatePassword){ 
                        $new = $this->users->Access_Token($result['email'], sha1($newToken));
                        if($new) {
                            $fetch = $this->users->Get_Details(sha1($newToken));
                            if($fetch) {
                                $userdata = array(
                                    'token' => $newToken,
                                    'name' => $fetch['firstname'],
                                    'img' => $fetch['photo'], 
                                    'role' => $result['role_name'],
                                    'logged_in' => TRUE
                                );
                                $this->session->set_userdata($userdata);
                                if($_SESSION['role'] == 'ADMIN') {
                                    redirect(site_url().'/admin');
                                } else {
                                    redirect(site_url().'/account');
                                }
                            } else {
                                $userdata = array(
                                    'token' => $newToken,
                                    'role' => $result['role_name'],
                                    'logged_in' => TRUE
                                );
                                $this->session->set_userdata($userdata);
                                if($_SESSION['role'] == 'ADMIN') {
                                    redirect(site_url().'/admin');
                                } else {
                                    redirect(site_url().'/account');
                                }
                            }

                        } else {
                            $this->session->set_flashdata('msg','A session could not be started. Please try again later.');
                            redirect(site_url().'/login');
                        }
        
                    }else{ 
        
                        $this->session->set_flashdata('msg','wrong password.');
                        redirect(site_url().'/login');
        
                    } 
                } else {
                    $random2 = substr(str_shuffle(str_repeat("0123456789", 6)), 0, 6);
                    $code = sha1($random2);

                    $this->email->sender('auto_mailing@gmail.com', 'Sample Mailer');
                    $this->email->recipient($result['email']);
                    $this->email->subject('Verification Code');
                    $this->email->email_content($random2);
                    $test = $this->email->send();
                    
                    if($test) {
                        $this->session->set_flashdata('msg','Please verify your email first before login.');
                        $this->session->set_userdata(['email' => $result['email'],'code' => $code]);
                        redirect(site_url().'/verify');
                    } else {
                        $this->session->set_flashdata('msg', 'Unable to send verification code at the moment. Please try again later.');
                        redirect(site_url()."/verify");
                    }
                }
    
            } else {
                $this->session->set_flashdata('msg','User doesn\'t exists.');
                redirect(site_url().'/login');
            }
        } else {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $result = $this->users->Login_Email($email);

            if($result){ 
                if($result['status'] == 'ACTIVE' || $result['status'] == 'VERIFIED') {
                    $pass = $result['password'];
                    $authenticatePassword = password_verify($password, $pass);

                    if($authenticatePassword){ 
                        $new = $this->users->Access_Token($result['email'], sha1($newToken));
                        if($new) {
                            $fetch = $this->users->Get_Details($newToken);
                            if($fetch) {
                                $userdata = array(
                                    'token' => $newToken,
                                    'name' => $fetch['firstname'],
                                    'role' => $result['role_name'],
                                    'logged_in' => TRUE
                                );
                                $this->session->set_userdata($userdata);
                                if($_SESSION['role'] == 'ADMIN') {
                                    redirect(site_url().'/admin');
                                } else {
                                    redirect(site_url().'/account');
                                }
                            } else {
                                $userdata = array(
                                    'token' => $newToken,
                                    'role' => $result['role_name'],
                                    'logged_in' => TRUE
                                );
                                $this->session->set_userdata($userdata);
                                if($_SESSION['role'] == 'ADMIN') {
                                    redirect(site_url().'/admin');
                                } else {
                                    redirect(site_url().'/account');
                                }
                            }

                        } else {
                            $this->session->set_flashdata('msg','A session could not be started. Please try again later.');
                            redirect(site_url().'/login');
                        }
        
                    }else{ 
        
                        $this->session->set_flashdata('msg','wrong password.');
                        redirect(site_url().'/login');
        
                    } 
                } else {
                    $random2 = substr(str_shuffle(str_repeat("0123456789", 6)), 0, 6);
                    $code = sha1($random2);

                    $this->email->sender('auto_mailing@gmail.com', 'Sample Mailer');
                    $this->email->recipient($result['email']);
                    $this->email->subject('Verification Code');
                    $this->email->email_content($random2);
                    $test = $this->email->send();
                    
                    if($test) {
                        $this->session->set_flashdata('msg','Please verify your email first before login.');
                        $this->session->set_userdata(['email' => $result['email'],'code' => $code]);
                        redirect(site_url().'/verify');
                    } else {
                        $this->session->set_flashdata('msg', 'Unable to send verification code at the moment. Please try again later.');
                        redirect(site_url()."/verify");
                    }
                }
    
            } else {
                $this->session->set_flashdata('msg','User doesn\'t exists.');
                redirect(site_url().'/login');
            }
        }
    }

    public function verify() {
        ini_set('SMTP','mailpit');
        ini_set('smtp_port',1025);

        if (isset($_POST['sending'])) {
            $get = $this->users->Verifying($_POST['email']);
            if ($get) {
                if ($get['status'] == 'INACTIVE' || $get['status'] == 'UNVERIFIED') {
                    $random = substr(str_shuffle(str_repeat("0123456789", 6)), 0, 6);
                    $code = sha1($random);
                    
                    $this->email->sender('auto_mailing@gmail.com', 'Sample Mailer');
                    $this->email->recipient($get['email']);
                    $this->email->subject('Verification Code');
                    $this->email->email_content($random);
                    $test = $this->email->send();
                    if($test) {
                        $user = [
                            'email' => $get['email'],
                            'code' => $code,
                        ];
                        $this->session->set_userdata($user);
                        redirect(site_url()."/verify");
                    } else {
                        $this->session->set_flashdata('msg', 'Something went wrong, Please try again later.');
                        redirect(site_url()."/verify");
                    }

                } else if($get['status'] == 'ACTIVE') {
                    $this->session->set_flashdata('msg', 'Your email has already been verified.');
                    redirect(site_url()."/login");
                } 
            } else {
                    $this->session->set_flashdata('msg', 'User didn\'t exists.');
                    redirect(site_url()."/verify");
                }

        } else if(isset($_POST['resend'])) {
            if(isset($_SESSION['email'])) {
                $random = substr(str_shuffle(str_repeat("0123456789", 6)), 0, 6);
                $code = sha1($random);

                $this->email->sender('auto_mailing@gmail.com', 'Sample Mailer');
                $this->email->recipient($_SESSION['email']);
                $this->email->subject('Verification Code');
                $this->email->email_content($random);
                $test = $this->email->send();
                if($test) {
                    $user = [
                        'code' => $code,
                    ];
                    $this->session->set_userdata($user);
                    $this->session->set_flashdata('msg', 'A new code has been sent to your email.');
                    redirect(site_url()."/verify");
                } else {
                    $this->session->set_flashdata('msg', 'Something went wrong, Please try again later.');
                    redirect(site_url()."/verify");
                }
            } else {
                $this->session->set_flashdata('msg', 'Please input your email.');
                redirect(site_url()."/verify");
            }
        } else {
            if(isset($_SESSION['email'])) {
                if(isset($_SESSION['recovery'])) {
                    if(sha1($_POST['code']) == $_SESSION['code']) {
                        $_SESSION['recovery'] = true;
                        if($_SESSION['recovery']) {
                            redirect(site_url()."/recovery");
                        } else {
                            redirect(site_url()."/verify");
                        }
                    } else {
                        $this->session->set_flashdata('msg', 'Wrong verification code.');
                    }
                } else {
                    if(sha1($_POST['code']) == $_SESSION['code']) {
                        $verified = $this->users->Active($_SESSION['email']);
                        if($verified) {
                            $this->session->set_flashdata('msg', 'Email was verified successfully. You are now eligible for login.');
                            redirect(site_url()."/login");
                        } else {
                            $this->session->set_flashdata('msg', 'Couldn\'t be verified at this moment, Please try again later.');
                            redirect(site_url()."/verify");
                        }
                    } else {
                        $this->session->set_flashdata('msg', 'Wrong verification code.');
                        redirect(site_url()."/verify");
                    }
                }
            } else {
                $this->session->set_flashdata('msg', 'Please input your email.');
                redirect(site_url()."/verify");
            }
        }
    }

    public function recovering() {
        ini_set('SMTP','mailpit');
        ini_set('smtp_port',1025);

        $get = $this->users->Verifying($_POST['email']);
        if($get) {
            $random = substr(str_shuffle(str_repeat("0123456789", 6)), 0, 6);
            $code = sha1($random);

            $this->email->sender('auto_mailing@gmail.com', 'Sample Mailer');
            $this->email->recipient($get['email']);
            $this->email->subject('Verification Code');
            $this->email->email_content($random);
            $test = $this->email->send();
            if($test) {
                $user = [
                    'email' => $get['email'],
                    'code' => $code,
                    'recovery' => false,
                ];
                $this->session->set_userdata($user);
                $this->session->set_flashdata('msg', 'A code has been sent to your email.');
                redirect(site_url()."/verify");
            } else {
                $this->session->set_flashdata('msg', 'Something went wrong, Please try again later.');
                redirect(site_url()."/verify");
            }
        } else {
            $this->session->set_flashdata('msg', 'User doesn\'t Exist');
            redirect(site_url().'/recovery');
        }
    }

    public function recover() {
        $this->form_validation
		->name('password')
			->required()
            ->custom_pattern("^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$", 'The password must contain a minimum of eight characters, at least one letter, one number and one special character:')
		->name('c_password')
			->matches('password')
			->required();
        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('msg', $this->form_validation->errors());
            redirect(site_url().'/recovery');

        } else {
            $email = $_SESSION['email'];
            $password = password_hash(html_escape($_POST['password']), PASSWORD_DEFAULT);
            $res = $this->users->Recovery($email, $password);
            if($res) {
                session_unset();
                $this->session->set_flashdata('msg', 'Password changed successfully.');
                redirect(site_url().'login');
            } else {
                $this->session->set_flashdata('msg', 'Something went wrong. Please try again later.');
                redirect(site_url().'recovery');
            }
        }
    }

    public function logout() {
        $random = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ", 60)), 0, 60);
        $newToken = $random;
        if(isset($_SESSION['token'])) {
            $prevToken = sha1($_SESSION['token']);
        }
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
