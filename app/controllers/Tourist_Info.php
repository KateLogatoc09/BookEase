<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Tourist_Info extends Controller {
	
    public function __construct() {
        parent:: __construct();
        $this->call->model('Tourist_Account_Model', 'users');
    }

    public function get_userinfo() {
        $Token = sha1($_SESSION['token']);
        $res = $this->users->Get_Info($Token);
        $res2 = $this->users->Get_Details($Token);
        if($res && $res2) {
            $data = [
                'username' => $res['username'],
                'email' => $res['email'],
                'phone' => $res['phone'],
                'address' => $res['address'],
                'gender' => $res2['gender'],
                'birthdate' =>$res2['birthdate'],
                'firstname' => $res2['firstname'],
                'middlename' => $res2['middlename'],
                'lastname' => $res2['lastname'],
            ];
            $this->call->view('account', $data);
        } else {
            $data = [
                'username' => $res['username'],
                'email' => $res['email'],
                'phone' => $res['phone'],
                'address' => $res['address'],
                'gender' => 'your gender',
                'birthdate' => 'your birthdate',
                'firstname' => 'your firstname',
                'middlename' => 'your middlename',
                'lastname' => 'your lastname',
            ];
            $this->call->view('account', $data);
        }
    }
}
?>
