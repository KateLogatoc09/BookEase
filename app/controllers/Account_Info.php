<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Account_Info extends Controller {
	
    public function __construct() {
        parent:: __construct();
        $this->call->model('Account_Model', 'users');
        $this->call->model('Resort_Model', 'res');
        $this->call->model('Spa_Model', 'spa');
    }

    public function get_userinfo() {
        if(isset($_SESSION['token'])) {
            $Token = sha1($_SESSION['token']);
            $res = $this->users->Get_Info($Token);
            $res2 = $this->users->Get_Details($Token);
            if(isset($_SESSION['role'])){
                if($_SESSION['role'] == "TOURIST") {
                    if($res && $res2) {
                        $data = [
                            'username' => $res['username'],
                            'email' => $res['email'],
                            'phone' => $res['phone'],
                            'address' => $res['street'].', '.$res['barangay'].', '.$res['municipality'].', '.$res['province'].', '.$res['region'].', '.$res['zipcode'],
                            'region' => $res['region'],
                            'province' => $res['province'],
                            'municipality' => $res['municipality'],
                            'barangay' => $res['barangay'],
                            'street' => $res['street'],
                            'zipcode' => $res['zipcode'], 
                            'civilstatus' => $res2['civilstatus'],
                            'gender' => $res2['gender'],
                            'birthdate' =>$res2['birthdate'],
                            'firstname' => $res2['firstname'],
                            'middlename' => $res2['middlename'],
                            'lastname' => $res2['lastname'],
                            'photo' => $res2['photo'],
                            'once' => true, 
                        ];
                        $this->call->view('account', $data);
                    } else {
                        $data = [
                            'username' => $res['username'],
                            'email' => $res['email'],
                            'phone' => $res['phone'],
                            'address' => $res['street'].', '.$res['barangay'].', '.$res['municipality'].', '.$res['province'].', '.$res['region'].', '.$res['zipcode'],
                            'region' => $res['region'],
                            'province' => $res['province'],
                            'municipality' => $res['municipality'],
                            'barangay' => $res['barangay'],
                            'street' => $res['street'],
                            'zipcode' => $res['zipcode'], 
                            'civilstatus' => 'your civil status',
                            'gender' => 'your gender',
                            'birthdate' => 'your birthdate',
                            'firstname' => 'your firstname',
                            'middlename' => 'your middlename',
                            'lastname' => 'your lastname',
                            'once' => false,
                        ];
                        $this->call->view('account', $data);
                    }
                } else {
                    if($res && $res2) {
                        $data = [
                            'username' => $res['username'],
                            'email' => $res['email'],
                            'phone' => $res['phone'],
                            'address' => $res['street'].', '.$res['barangay'].', '.$res['municipality'].', '.$res['province'].', '.$res['region'].', '.$res['zipcode'],
                            'region' => $res['region'],
                            'province' => $res['province'],
                            'municipality' => $res['municipality'],
                            'barangay' => $res['barangay'],
                            'street' => $res['street'],
                            'zipcode' => $res['zipcode'], 
                            'civilstatus' => $res2['civilstatus'],
                            'gender' => $res2['gender'],
                            'birthdate' =>$res2['birthdate'],
                            'firstname' => $res2['firstname'],
                            'middlename' => $res2['middlename'],
                            'lastname' => $res2['lastname'],
                            'photo' => $res2['photo'],
                            'once' => true, 
                        ];
                        $this->call->view('admin_account', $data);
                    } else {
                        $data = [
                            'username' => $res['username'],
                            'email' => $res['email'],
                            'phone' => $res['phone'],
                            'address' => $res['street'].', '.$res['barangay'].', '.$res['municipality'].', '.$res['province'].', '.$res['region'].', '.$res['zipcode'],
                            'region' => $res['region'],
                            'province' => $res['province'],
                            'municipality' => $res['municipality'],
                            'barangay' => $res['barangay'],
                            'street' => $res['street'],
                            'zipcode' => $res['zipcode'], 
                            'civilstatus' => 'your civil status',
                            'gender' => 'your gender',
                            'birthdate' => 'your birthdate',
                            'firstname' => 'your firstname',
                            'middlename' => 'your middlename',
                            'lastname' => 'your lastname',
                            'once' => false,
                        ];
                        $this->call->view('admin_account', $data);
                    }
                }
            }
        }
    
    }

    public function edit_info() {
        $this->form_validation
		->name('username')
			->required()
			->min_length(6)
			->max_length(30)
        ->name('email')
			->required()
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
        ->name('phone')
            ->required()
            ->min_length(11,"Your phone number minimum and maximum length is 11 digits.")
            ->max_length(11,"Your phone number minimum and maximum length is 11 digits.")
            ->custom_pattern("^(09)\d{9}$","Your Phone Number must follow this format: 09XXXXXXXXX")
        ->name('birthdate')
            ->required()
        ->name('gender')
            ->required()
        ->name('civilstatus')
            ->required()
        ->name('first_name')
            ->required()
        ->name('last_name')
            ->required();
        if ($this->form_validation->run() == FALSE) {

            if(isset($_SESSION['role'])) {
                if($_SESSION['role'] == 'TOURIST') {
                    $this->session->set_flashdata('msg', $this->form_validation->errors());
                    redirect(site_url().'/account');
                } else {
                    $this->session->set_flashdata('msg', $this->form_validation->errors());
                    redirect(site_url().'/admin_account');
                }
            }
        
        }
        else {
            if(isset($_SESSION['token'])) {
                $Token = sha1($_SESSION['token']);
                $res = $this->users->Get_Details($Token);
                $fetch = $this->users->Get_Info($Token);
                if(isset($_SESSION['role'])) {
                    if($_SESSION['role'] == 'ADMIN') {
                        if ($res) {
                            //if image is filled
                            if($_FILES['photo']['name']) {
                                //account
                                $username = $_POST['username'];
                                $email = $_POST['email'];
                                $phone = $_POST['phone'];
                                $region = $_POST['region'];
                                $province = $_POST['province'];
                                $municipality = $_POST['municipality'];
                                $barangay = $_POST['barangay'];
                                $street = $_POST['street'];
                                $zipcode = $_POST['zipcode'];
                                //tour_inf
                                $civilstatus = $_POST['civilstatus'];
                                $gender = $_POST['gender'];
                                $lastname = html_escape($_POST['last_name']);
                                $middlename = html_escape($_POST['middle_name']);
                                $firstname = html_escape($_POST['first_name']);
                                $id = $res['infoid'];

                                //check
                                $checkuname = $this->users->Check_Uname_Upd($username, $Token);
                                $checkemail = $this->users->Check_Email_Upd($email, $Token);
                                $checkphone = $this->users->Check_Phone_Upd($phone, $Token);
                                
                                if($checkemail) {
                                    $this->session->set_flashdata('msg', 'Email has been taken.');
                                    redirect(site_url().'/admin_account');
                                } else if($checkuname) {
                                    $this->session->set_flashdata('msg', 'Username has been taken.');
                                    redirect(site_url().'/admin_account');
                                } else if($checkphone) {
                                    $this->session->set_flashdata('msg', 'Phone number has been taken.');
                                    redirect(site_url().'/admin_account');
                                } else {
                                    //test photo upload
                                    $this->call->library('upload', $_FILES['photo']);
                                    $this->upload
                                        ->set_dir('public/admin/'.$fetch['id'])
                                        ->is_image();
                                    if($this->upload->do_upload()) {
                                        $photo = 'public/admin/'.$fetch['id'].'/'.$this->upload->get_filename();
                                        $result1 = $this->users->Edit_Details($id, $gender, $civilstatus, $firstname, $middlename, $lastname, $photo);
                                        $result2 = $this->users->Update_AccountInfo($Token, $username, $email, $region, $province, $municipality, $barangay, $street, $zipcode, $phone);
                                        if($result1 && $result2) {
                                            $this->session->set_flashdata('msg', 'Your profile information was updated successfully.');
                                            redirect(site_url().'/admin_account');
                                        } else {
                                            $this->session->set_flashdata('msg', 'Something went wrong. Please try again later.');
                                            redirect(site_url().'/admin_account');
                                            unlink('C:\laragon\www\bookease\\'.$photo);
                                        }
                                    } else {
                                        $this->session->set_flashdata('msg', $this->upload->get_errors());
                                        redirect(site_url().'/admin_account');
                                    }
                                }
                            } else if(!$_FILES['photo']['name']) {

                                    //account
                                    $username = $_POST['username'];
                                    $email = $_POST['email'];
                                    $phone = $_POST['phone'];
                                    $region = $_POST['region'];
                                    $province = $_POST['province'];
                                    $municipality = $_POST['municipality'];
                                    $barangay = $_POST['barangay'];
                                    $street = $_POST['street'];
                                    $zipcode = $_POST['zipcode'];
                                    //tour_inf
                                    $civilstatus = $_POST['civilstatus'];
                                    $gender = $_POST['gender'];
                                    $lastname = html_escape($_POST['last_name']);
                                    $middlename = html_escape($_POST['middle_name']);
                                    $firstname = html_escape($_POST['first_name']);
                                    $photo = $res['photo'];
                                    $id = $res['infoid'];
            
                                    //check
                                    $checkuname = $this->users->Check_Uname_Upd($username, $Token);
                                    $checkemail = $this->users->Check_Email_Upd($email, $Token);
                                    $checkphone = $this->users->Check_Phone_Upd($phone, $Token);
                                    
                                    if($checkemail) {
                                        $this->session->set_flashdata('msg', 'Email has been taken.');
                                        redirect(site_url().'/admin_account');
                                    } else if($checkuname) {
                                        $this->session->set_flashdata('msg', 'Username has been taken.');
                                        redirect(site_url().'/admin_account');
                                    } else if($checkphone) {
                                        $this->session->set_flashdata('msg', 'Phone number has been taken.');
                                        redirect(site_url().'/admin_account');
                                    } else {
                                        $result1 = $this->users->Edit_Details($id, $gender, $civilstatus, $firstname, $middlename, $lastname, $photo);
                                        $result2 = $this->users->Update_AccountInfo($Token, $username, $email, $region, $province, $municipality, $barangay, $street, $zipcode, $phone);
                                        if($result1 && $result2) {
                                            $this->session->set_flashdata('msg', 'Your profile information was updated successfully.');
                                            redirect(site_url().'/admin_account');
                                        } else {
                                            $this->session->set_flashdata('msg', 'Something went wrong. Please try again later.');
                                            redirect(site_url().'/admin_account');
                                        }
                                    }
                                }
                            //insert if true 
                            } else {
                                if($_FILES['photo']['name']) {

                                    //account
                                    $username = $_POST['username'];
                                    $email = $_POST['email'];
                                    $phone = $_POST['phone'];
                                    $region = $_POST['region'];
                                    $province = $_POST['province'];
                                    $municipality = $_POST['municipality'];
                                    $barangay = $_POST['barangay'];
                                    $street = $_POST['street'];
                                    $zipcode = $_POST['zipcode'];
                                    //tour_inf
                                    $civilstatus = $_POST['civilstatus'];
                                    $gender = $_POST['gender'];
                                    $lastname = html_escape($_POST['last_name']);
                                    $middlename = html_escape($_POST['middle_name']);
                                    $firstname = html_escape($_POST['first_name']);
                                    $birthdate = $_POST['birthdate'];
                                    $user_id = $fetch['id'];

                                    //check
                                    $checkuname = $this->users->Check_Uname_Upd($username, $Token);
                                    $checkemail = $this->users->Check_Email_Upd($email, $Token);
                                    $checkphone = $this->users->Check_Phone_Upd($phone, $Token);
                                    
                                    if($checkemail) {
                                        $this->session->set_flashdata('msg', 'Email has been taken.');
                                        redirect(site_url().'/admin_account');
                                    } else if($checkuname) {
                                        $this->session->set_flashdata('msg', 'Username has been taken.');
                                        redirect(site_url().'/admin_account');
                                    } else if($checkphone) {
                                        $this->session->set_flashdata('msg', 'Phone number has been taken.');
                                        redirect(site_url().'/admin_account');
                                    } else {
                                        //test photo upload
                                        $this->call->library('upload', $_FILES['photo']);
                                        $this->upload
                                            ->set_dir('public/admin/'.$fetch['id'])
                                            ->is_image();
                                        if($this->upload->do_upload()) {
                                            $photo = 'public/admin/'.$fetch['id'].'/'.$this->upload->get_filename();
                                            $result1 = $this->users->Save_Details($user_id, $gender, $civilstatus, $birthdate, $firstname, $middlename, $lastname, $photo);
                                            $result2 = $this->users->Update_AccountInfo($Token, $username, $email, $region, $province, $municipality, $barangay, $street, $zipcode, $phone);
                                            if($result1 && $result2) {
                                                $this->session->set_flashdata('msg', 'Your profile information was updated successfully.');
                                                redirect(site_url().'/admin_account');
                                            } else {
                                                $this->session->set_flashdata('msg', 'Something went wrong. Please try again later.');
                                                redirect(site_url().'/admin_account');
                                            }
                                        } else {
                                            $this->session->set_flashdata('msg', $this->upload->get_errors());
                                            redirect(site_url().'/admin_account');
                                        }
                                    }

                                } else if(!$_FILES['photo']['name']) {

                                    //account
                                    $username = $_POST['username'];
                                    $email = $_POST['email'];
                                    $phone = $_POST['phone'];
                                    $region = $_POST['region'];
                                    $province = $_POST['province'];
                                    $municipality = $_POST['municipality'];
                                    $barangay = $_POST['barangay'];
                                    $street = $_POST['street'];
                                    $zipcode = $_POST['zipcode'];
                                    //tour_inf
                                    $civilstatus = $_POST['civilstatus'];
                                    $gender = $_POST['gender'];
                                    $lastname = html_escape($_POST['last_name']);
                                    $middlename = html_escape($_POST['middle_name']);
                                    $firstname = html_escape($_POST['first_name']);
                                    $birthdate = $_POST['birthdate'];
                                    $user_id = $fetch['id'];
                                    $photo = 'public/img/user-1.jpg';

                                    //check
                                    $checkuname = $this->users->Check_Uname_Upd($username, $Token);
                                    $checkemail = $this->users->Check_Email_Upd($email, $Token);
                                    $checkphone = $this->users->Check_Phone_Upd($phone, $Token);
                                    
                                    if($checkemail) {
                                        $this->session->set_flashdata('msg', 'Email has been taken.');
                                        redirect(site_url().'/admin_account');
                                    } else if($checkuname) {
                                        $this->session->set_flashdata('msg', 'Username has been taken.');
                                        redirect(site_url().'/admin_account');
                                    } else if($checkphone) {
                                        $this->session->set_flashdata('msg', 'Phone number has been taken.');
                                        redirect(site_url().'/admin_account');
                                    } else {
                                        $result1 = $this->users->Save_Details($user_id, $gender, $civilstatus, $birthdate, $firstname, $middlename, $lastname, $photo);
                                        $result2 = $this->users->Update_AccountInfo($Token, $username, $email, $region, $province, $municipality, $barangay, $street, $zipcode, $phone);
                                        if($result1 && $result2) {
                                            $this->session->set_flashdata('msg', 'Your profile information was updated successfully.');
                                            redirect(site_url().'/admin_account');
                                        } else {
                                            $this->session->set_flashdata('msg', 'Something went wrong. Please try again later.');
                                            redirect(site_url().'/admin_account');
                                        }

                                    }
                                }
                            }
                        
                        } else {
                        //update if true
                        if ($res) {
                            //if image is filled
                            if($_FILES['photo']['name']) {
                                //account
                                $username = $_POST['username'];
                                $email = $_POST['email'];
                                $phone = $_POST['phone'];
                                $region = $_POST['region'];
                                $province = $_POST['province'];
                                $municipality = $_POST['municipality'];
                                $barangay = $_POST['barangay'];
                                $street = $_POST['street'];
                                $zipcode = $_POST['zipcode'];
                                //tour_inf
                                $civilstatus = $_POST['civilstatus'];
                                $gender = $_POST['gender'];
                                $lastname = html_escape($_POST['last_name']);
                                $middlename = html_escape($_POST['middle_name']);
                                $firstname = html_escape($_POST['first_name']);
                                $id = $res['infoid'];

                                //check
                                $checkuname = $this->users->Check_Uname_Upd($username, $Token);
                                $checkemail = $this->users->Check_Email_Upd($email, $Token);
                                $checkphone = $this->users->Check_Phone_Upd($phone, $Token);
                                
                                if($checkemail) {
                                    $this->session->set_flashdata('msg', 'Email has been taken.');
                                    redirect(site_url().'/account');
                                } else if($checkuname) {
                                    $this->session->set_flashdata('msg', 'Username has been taken.');
                                    redirect(site_url().'/account');
                                } else if($checkphone) {
                                    $this->session->set_flashdata('msg', 'Phone number has been taken.');
                                    redirect(site_url().'/account');
                                } else {
                                    //test photo upload
                                    $this->call->library('upload', $_FILES['photo']);
                                    $this->upload
                                        ->set_dir('public/tourist/'.$fetch['id'])
                                        ->is_image();
                                    if($this->upload->do_upload()) {
                                        $photo = 'public/tourist/'.$fetch['id'].'/'.$this->upload->get_filename();
                                        $result1 = $this->users->Edit_Details($id, $gender, $civilstatus, $firstname, $middlename, $lastname, $photo);
                                        $result2 = $this->users->Update_AccountInfo($Token, $username, $email, $region, $province, $municipality, $barangay, $street, $zipcode, $phone);
                                        if($result1 && $result2) {
                                            $this->session->set_flashdata('msg', 'Your profile information was updated successfully.');
                                            redirect(site_url().'/account');
                                        } else {
                                            $this->session->set_flashdata('msg', 'Something went wrong. Please try again later.');
                                            redirect(site_url().'/account');
                                            unlink('C:\laragon\www\bookease\\'.$photo);
                                        }
                                    } else {
                                        $this->session->set_flashdata('msg', $this->upload->get_errors());
                                        redirect(site_url().'/account');
                                    }
                                }
                            } else if(!$_FILES['photo']['name']) {

                                    //account
                                    $username = $_POST['username'];
                                    $email = $_POST['email'];
                                    $phone = $_POST['phone'];
                                    $region = $_POST['region'];
                                    $province = $_POST['province'];
                                    $municipality = $_POST['municipality'];
                                    $barangay = $_POST['barangay'];
                                    $street = $_POST['street'];
                                    $zipcode = $_POST['zipcode'];
                                    //tour_inf
                                    $civilstatus = $_POST['civilstatus'];
                                    $gender = $_POST['gender'];
                                    $lastname = html_escape($_POST['last_name']);
                                    $middlename = html_escape($_POST['middle_name']);
                                    $firstname = html_escape($_POST['first_name']);
                                    $photo = $res['photo'];
                                    $id = $res['infoid'];
            
                                    //check
                                    $checkuname = $this->users->Check_Uname_Upd($username, $Token);
                                    $checkemail = $this->users->Check_Email_Upd($email, $Token);
                                    $checkphone = $this->users->Check_Phone_Upd($phone, $Token);
                                    
                                    if($checkemail) {
                                        $this->session->set_flashdata('msg', 'Email has been taken.');
                                        redirect(site_url().'/account');
                                    } else if($checkuname) {
                                        $this->session->set_flashdata('msg', 'Username has been taken.');
                                        redirect(site_url().'/account');
                                    } else if($checkphone) {
                                        $this->session->set_flashdata('msg', 'Phone number has been taken.');
                                        redirect(site_url().'/account');
                                    } else {
                                        $result1 = $this->users->Edit_Details($id, $gender, $civilstatus, $firstname, $middlename, $lastname, $photo);
                                        $result2 = $this->users->Update_AccountInfo($Token, $username, $email, $region, $province, $municipality, $barangay, $street, $zipcode, $phone);
                                        if($result1 && $result2) {
                                            $this->session->set_flashdata('msg', 'Your profile information was updated successfully.');
                                            redirect(site_url().'/account');
                                        } else {
                                            $this->session->set_flashdata('msg', 'Something went wrong. Please try again later.');
                                            redirect(site_url().'/account');
                                        }
                                    }
                                }
                            //insert if true 
                            } else {
                                if($_FILES['photo']['name']) {

                                    //account
                                    $username = $_POST['username'];
                                    $email = $_POST['email'];
                                    $phone = $_POST['phone'];
                                    $region = $_POST['region'];
                                    $province = $_POST['province'];
                                    $municipality = $_POST['municipality'];
                                    $barangay = $_POST['barangay'];
                                    $street = $_POST['street'];
                                    $zipcode = $_POST['zipcode'];
                                    //tour_inf
                                    $civilstatus = $_POST['civilstatus'];
                                    $gender = $_POST['gender'];
                                    $lastname = $_POST['last_name'];
                                    if(isset($_POST['middle_name'])) {
                                    $middlename = $_POST['middle_name'];
                                    } else {
                                        $middlename = null;
                                    }
                                    $firstname = $_POST['first_name'];
                                    $birthdate = $_POST['birthdate'];
                                    $user_id = $fetch['id'];

                                    //check
                                    $checkuname = $this->users->Check_Uname_Upd($username, $Token);
                                    $checkemail = $this->users->Check_Email_Upd($email, $Token);
                                    $checkphone = $this->users->Check_Phone_Upd($phone, $Token);
                                    
                                    if($checkemail) {
                                        $this->session->set_flashdata('msg', 'Email has been taken.');
                                        redirect(site_url().'/account');
                                    } else if($checkuname) {
                                        $this->session->set_flashdata('msg', 'Username has been taken.');
                                        redirect(site_url().'/account');
                                    } else if($checkphone) {
                                        $this->session->set_flashdata('msg', 'Phone number has been taken.');
                                        redirect(site_url().'/account');
                                    } else {
                                        //test photo upload
                                        $this->call->library('upload', $_FILES['photo']);
                                        $this->upload
                                            ->set_dir('public/tourist/'.$fetch['id'])
                                            ->is_image();
                                        if($this->upload->do_upload()) {
                                            $photo = 'public/tourist/'.$fetch['id'].'/'.$this->upload->get_filename();
                                            $result1 = $this->users->Save_Details($user_id, $gender, $civilstatus, $birthdate, $firstname, $middlename, $lastname, $photo);
                                            $result2 = $this->users->Update_AccountInfo($Token, $username, $email, $region, $province, $municipality, $barangay, $street, $zipcode, $phone);
                                            if($result1 && $result2) {
                                                $this->session->set_flashdata('msg', 'Your profile information was updated successfully.');
                                                redirect(site_url().'/account');
                                            } else {
                                                $this->session->set_flashdata('msg', 'Something went wrong. Please try again later.');
                                                redirect(site_url().'/account');
                                            }
                                        } else {
                                            $this->session->set_flashdata('msg', $this->upload->get_errors());
                                            redirect(site_url().'/account');
                                        }
                                    }

                                } else if(!$_FILES['photo']['name']) {

                                    //account
                                    $username = $_POST['username'];
                                    $email = $_POST['email'];
                                    $phone = $_POST['phone'];
                                    $region = $_POST['region'];
                                    $province = $_POST['province'];
                                    $municipality = $_POST['municipality'];
                                    $barangay = $_POST['barangay'];
                                    $street = $_POST['street'];
                                    $zipcode = $_POST['zipcode'];
                                    //tour_inf
                                    $civilstatus = $_POST['civilstatus'];
                                    $gender = $_POST['gender'];
                                    $lastname = html_escape($_POST['last_name']);
                                    $middlename = html_escape($_POST['middle_name']);
                                    $firstname = html_escape($_POST['first_name']);
                                    $birthdate = $_POST['birthdate'];
                                    $user_id = $fetch['id'];
                                    $photo = 'public/img/user-1.jpg';

                                    //check
                                    $checkuname = $this->users->Check_Uname_Upd($username, $Token);
                                    $checkemail = $this->users->Check_Email_Upd($email, $Token);
                                    $checkphone = $this->users->Check_Phone_Upd($phone, $Token);
                                    
                                    if($checkemail) {
                                        $this->session->set_flashdata('msg', 'Email has been taken.');
                                        redirect(site_url().'/account');
                                    } else if($checkuname) {
                                        $this->session->set_flashdata('msg', 'Username has been taken.');
                                        redirect(site_url().'/account');
                                    } else if($checkphone) {
                                        $this->session->set_flashdata('msg', 'Phone number has been taken.');
                                        redirect(site_url().'/account');
                                    } else {
                                        $result1 = $this->users->Save_Details($user_id, $gender, $civilstatus, $birthdate, $firstname, $middlename, $lastname, $photo);
                                        $result2 = $this->users->Update_AccountInfo($Token, $username, $email, $region, $province, $municipality, $barangay, $street, $zipcode, $phone);
                                        if($result1 && $result2) {
                                            $this->session->set_flashdata('msg', 'Your profile information was updated successfully.');
                                            redirect(site_url().'/account');
                                        } else {
                                            $this->session->set_flashdata('msg', 'Something went wrong. Please try again later.');
                                            redirect(site_url().'/account');
                                        }

                                    }
                                }
                            }
                        }
                
                    } else {
                        redirect(site_url().'/');
                }   
                
            }
            
        }
    }

    public function book() {
    $check = $this->users->Get_Details(sha1($_SESSION['token']));
    if ($check) {
        $random2 = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ", 60)), 0, 16);
        $rooms = $this->res->selected($_POST['room_id']);

        $room = $_POST['room_id'];
        $user = $_POST['user_id'];
        $qty = $_POST['qty'];
        $pax = $_POST['pax'];
        $days = $_POST['days'];
        $date = date_create($_POST['check_in']);
        $check_in = date_format($date, 'Y/m/d');
        $reference = $random2;
        $status = $_POST['status'];
        $total = $rooms['actual_price'] * $qty;
        $note = $_POST['note'];

        $save = $this->users->book_save($user, $room, $qty, $pax, $days, $check_in, $reference, $status, $total, $note);
        if ($save) {
            $this->session->set_flashdata('msg','Booked Successfully.');
            redirect(site_url().'/account');
        } else {
            $this->session->set_flashdata('msg','Something went wrong.');
            redirect(site_url().'/book/'.$room);
        }

    } else {
        $this->session->set_flashdata('msg','Update your Account Information first.');
        redirect(site_url().'/account');
    }

    }

    public function appointment() {
    $check = $this->users->Get_Details(sha1($_SESSION['token']));
    if ($check) {
        $random2 = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ", 60)), 0, 16);
        $services = $this->spa->selected($_POST['service_id']);

        $service = $_POST['service_id'];
        $user = $_POST['user_id'];
        $d = date_create($_POST['check_in']);
        $date = date_format($d, 'Y/m/d');
        $time = $_POST['time'];
        $reference = $random2;
        $status = $_POST['status'];
        $total = $services['actual_price'];
        $note = $_POST['note'];

        $save = $this->users->app_save($user, $service, $date, $time, $reference, $status, $total, $note);
        if ($save) {
            $this->session->set_flashdata('msg','Booked Successfully.');
            redirect(site_url().'/account');
        } else {
            $this->session->set_flashdata('msg','Something went wrong.');
            redirect(site_url().'/appointment/'.$service);
        }
    } else {
        $this->session->set_flashdata('msg','Update your Account Information first.');
        redirect(site_url().'/account');
    }

    }
    public function bookings() {
        $check = $this->users->bookings(sha1($_SESSION['token']));
        $data = [
            'bookings' => $check,
        ];
        return $this->call->view('bookings', $data);
    }

    public function payment($reference) {
        if($this->users->getres($reference)) {
            $check = $this->users->getres($reference);
        } else {
            $check = $this->users->getapp($reference);
        }
        $data = [
            'selected' => $check,
        ];
        return $this->call->view('payment', $data);
    }

    public function booking($reference) {
        if($this->users->getres($reference)) {
            $data = [
                'selbook' => $this->users->getres($reference),
            ];
            return $this->call->view('bookings', $data);
        } else {
            $data = [
                'selapp' => $this->users->getapp($reference),
            ];
            return $this->call->view('bookings', $data);
        }
    }

    public function cancel($reference) {
        if($this->users->getres($reference)) {
            $check = $this->users->cancel_res($reference);
            if($check) {
                $this->session->set_flashdata('msg','Successfully Cancelled Your Reservation with a reference code:'.$reference.'.');
                redirect(site_url().'/bookings');
            } else {
                $this->session->set_flashdata('msg','Something went wrong. Please try again later.');
                redirect(site_url().'/bookings');
            }
        } else {
            $check = $this->users->cancel_app($reference);
            if($check) {
                $this->session->set_flashdata('msg','Successfully Cancelled Your Appointment with a reference code:'.$reference.'.');
                redirect(site_url().'/bookings');
            } else {
                $this->session->set_flashdata('msg','Something went wrong. Please try again later.');
                redirect(site_url().'/bookings');
            }
        }
    }

    public function reapply($reference) {
        if($this->users->getres($reference)) {
            $check = $this->users->reapply_res($reference);
            if($check) {
                $this->session->set_flashdata('msg','Successfully Cancelled Your Reservation with a reference code:'.$reference.'.');
                redirect(site_url().'/bookings');
            } else {
                $this->session->set_flashdata('msg','Something went wrong. Please try again later.');
                redirect(site_url().'/bookings');
            }
        } else {
            $check = $this->users->reapply_app($reference);
            if($check) {
                $this->session->set_flashdata('msg','Successfully Cancelled Your Appointment with a reference code:'.$reference.'.');
                redirect(site_url().'/bookings');
            } else {
                $this->session->set_flashdata('msg','Something went wrong. Please try again later.');
                redirect(site_url().'/bookings');
            }
        }
    
    }

    public function pay() {
        $get = $this->users->Get_Info(sha1($_SESSION['token']));
        $check = $this->users->check_pay($_POST['reference']);

        if($check) {
            if($this->users->getres($_POST['reference'])) {
                $this->call->library('upload', $_FILES['proof']);
                $this->upload
                    ->set_dir('public/tourist/'.$get['id'])
                    ->is_image();
                if($this->upload->do_upload()) {
                    $photo = 'public/tourist/'.$get['id'].'/'.$this->upload->get_filename();
                    $result = $this->users->pay_again($_POST['reference'], $photo, $_POST['downpayment']);
                    $result2 = $this->users->process_res($_POST['reference']);
                    if($result && $result2) {
                        $this->session->set_flashdata('msg', 'Your request is on processed.');
                        redirect(site_url().'/bookings');
                    } else {
                        $this->session->set_flashdata('msg', 'Something went wrong. Please try again later.');
                        redirect(site_url().'/bookings');
                        unlink('C:\laragon\www\bookease\\'.$photo);
                    }
                } else {
                    $this->session->set_flashdata('msg', $this->upload->get_errors());
                    redirect(site_url().'/bookings');
                }
            } else {
                $this->call->library('upload', $_FILES['proof']);
                $this->upload
                    ->set_dir('public/tourist/'.$get['id'])
                    ->is_image();
                if($this->upload->do_upload()) {
                    $photo = 'public/tourist/'.$get['id'].'/'.$this->upload->get_filename();
                    $result = $this->users->pay_again($_POST['reference'], $photo, $_POST['downpayment']);
                    $result2 = $this->users->process_app($_POST['reference']);
                    if($result && $result2) {
                        $this->session->set_flashdata('msg', 'Your request is on processed.');
                        redirect(site_url().'/bookings');
                    } else {
                        $this->session->set_flashdata('msg', 'Something went wrong. Please try again later.');
                        redirect(site_url().'/bookings');
                        unlink('C:\laragon\www\bookease\\'.$photo);
                    }
                } else {
                    $this->session->set_flashdata('msg', $this->upload->get_errors());
                    redirect(site_url().'/bookings');
                }
            }
        
        } else {
            if($this->users->getres($_POST['reference'])) {
                $this->call->library('upload', $_FILES['proof']);
                $this->upload
                    ->set_dir('public/tourist/'.$get['id'])
                    ->is_image();
                if($this->upload->do_upload()) {
                    $photo = 'public/tourist/'.$get['id'].'/'.$this->upload->get_filename();
                    $result1 = $this->users->pay($_POST['reference'], $photo, $_POST['downpayment']);
                    $result2 = $this->users->process_res($_POST['reference']);
                    if($result1 && $result2) {
                        $this->session->set_flashdata('msg', 'Your request is on processed.');
                        redirect(site_url().'/bookings');
                    } else {
                        $this->session->set_flashdata('msg', 'Something went wrong. Please try again later.');
                        redirect(site_url().'/bookings');
                        unlink('C:\laragon\www\bookease\\'.$photo);
                    }
                } else {
                    $this->session->set_flashdata('msg', $this->upload->get_errors());
                    redirect(site_url().'/bookings');
                }
            } else {
                $this->call->library('upload', $_FILES['proof']);
                $this->upload
                    ->set_dir('public/tourist/'.$get['id'])
                    ->is_image();
                if($this->upload->do_upload()) {
                    $photo = 'public/tourist/'.$get['id'].'/'.$this->upload->get_filename();
                    $result1 = $this->users->pay($_POST['reference'], $photo, $_POST['downpayment']);
                    $result2 = $this->users->process_app($_POST['reference']);
                    if($result1 && $result2) {
                        $this->session->set_flashdata('msg', 'Your request is on processed.');
                        redirect(site_url().'/bookings');
                    } else {
                        $this->session->set_flashdata('msg', 'Something went wrong. Please try again later.');
                        redirect(site_url().'/bookings');
                        unlink('C:\laragon\www\bookease\\'.$photo);
                    }
                } else {
                    $this->session->set_flashdata('msg', $this->upload->get_errors());
                    redirect(site_url().'/bookings');
                }
            }
        }
    }
}
?>
