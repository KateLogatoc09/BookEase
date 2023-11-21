<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Tourist_Account_model extends Model {
	
    public function Register_Tourist($username, $email, $password, $token, $phone, $address, $status){
        $bind = [
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'token' => $token,
            'phone' => $phone,
            'address' => $address,
            'status' => $status
        ];
        return $this->db->table('tourist_account')->insert($bind);
    }

    public function Login_User_Uname($username) {
        return $this->db->table('tourist_account')->select('username,password,token')->where('username',$username)->get();
    }

    public function Login_User_Email($email) {
        return $this->db->table('tourist_account')->select('email,password,token')->where('email',$email)->get();
    }

    public function New_Token_Uname($username, $token) {
        $bind = [
            'token' => $token,
        ];
        return $this->db->table('tourist_account')->where('username',$username)->update($bind);
    }

    public function New_Token_Email($email, $token) {
        $bind = [
            'token' => $token,
        ];
        return $this->db->table('tourist_account')->where('email',$email)->update($bind);
    }

    public function New_Token($token, $newToken) {
        $bind = [
            'token' => $newToken,
        ];
        return $this->db->table('tourist_account')->where('token', $token)->update($bind);
    }

    public function Get_Info($token) {
        return $this->db->table('tourist_account')->where('token',$token)->get();
    }

    public function Get_Details($token) {
        return $this->db->table('tourist_account as acc')->select('gender, birthdate, firstname, middlename, lastname')->inner_join('tourist_info as info','acc.id=info.user_id')->where('token',$token)->get();
    }
}
?>
