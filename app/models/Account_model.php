<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Account_model extends Model {

//Login and Reg
    public function Register($username, $email, $password, $token, $phone, $region, $province, $municipality, $barangay, $street, $zipcode, $status){
        $bind = [
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'token' => $token,
            'phone' => $phone,
            'region' => $region,
            'province' => $province,
            'municipality' => $municipality,
            'barangay' => $barangay,
            'street' => strtoupper($street),
            'zipcode' => $zipcode,
            'status' => $status
        ];
        return $this->db->table('user_account')->insert($bind);
    }

    public function Get_Id($username) {
        return $this->db->table('user_account')->select('id')->where('username',$username)->get();
    }

    public function User_Role($id, $role) {
        $bind = [
            'user_id' => $id,
            'role_name' => $role,
        ];
        return $this->db->table('user_role')->insert($bind);
    }

    public function Login_Uname($username) {
        return $this->db->table('user_account as acc')->select('email,password,token,status,role_name')->inner_join('user_role as role','acc.id=role.user_id')->where('username',$username)->get();
    }

    public function Login_Email($email) {
        return $this->db->table('user_account as acc')->select('email,password,token,status,role_name')->inner_join('user_role as role', 'acc.id=role.user_id')->where('email',$email)->get();
    }

    public function Access_Token($email, $token) {
        $bind = [
            'token' => $token,
        ];
        return $this->db->table('user_account')->where('email',$email)->update($bind);
    }

    public function New_Token($token, $newToken) {
        $bind = [
            'token' => $newToken,
        ];
        return $this->db->table('user_account')->where('token', $token)->update($bind);
    }

    // VERIFICATION
    public function Active($email) {
        return $this->db->table('user_account')->where('email', $email)->update(['status'=>'ACTIVE']);
    }

    public function Verifying($email) {
        return $this->db->table('user_account')->where('email', $email)->get();
    }

    //ACCOUNT RECOVERY
    public function Recovery($email, $password) {
        return $this->db->table('user_account')->where('email', $email)->update(['password'=>$password]);
    }

    //Info
    public function Get_Info($token) {
        return $this->db->table('user_account')->where('token',$token)->get();
    }

    public function Get_Details($token) {
        return $this->db->table('user_account as acc')->select('info.id AS infoid ,gender, civilstatus, birthdate, firstname, middlename, lastname, photo')->inner_join('account_info as info','acc.id=info.user_id')->where('token',$token)->get();
    }

    public function Check_Email_Upd($email, $token) {
        return $this->db->table('user_account')->where('email', $email)->not_where('token', $token)->get();
    }

    public function Check_Uname_Upd($username, $token) {
        return $this->db->table('user_account')->where('username', $username)->not_where('token', $token)->get();
    }

    public function Check_Phone_Upd($phone, $token) {
        return $this->db->table('user_account')->where('phone', $phone)->not_where('token', $token)->get();
    }

    public function Update_AccountInfo($token, $username, $email, $region, $province, $municipality, $barangay, $street, $zipcode, $phone) {
        $bind = [
            'username' => $username,
            'email' => $email,
            'region' => $region,
            'province' => $province,
            'municipality' => $municipality,
            'barangay' => $barangay,
            'street' => strtoupper($street),
            'zipcode' => $zipcode,
            'phone' => $phone,
        ];

        return $this->db->table('user_account')->where('token', $token)->update($bind);
    }

    public function Save_Details($userid, $gender, $civilstatus, $birthdate, $firstname, $middlename, $lastname, $photo) {
        $bind = [
            'civilstatus' => $civilstatus,
            'gender' => $gender,
            'birthdate' => $birthdate,
            'firstname' => $firstname,
            'middlename' => $middlename,
            'lastname' => $lastname,
            'photo' => $photo,
            'user_id' => $userid
        ];

        return $this->db->table('account_info')->insert($bind);
    }

    public function Edit_Details($id, $gender, $civilstatus, $firstname, $middlename, $lastname, $photo) {
        $bind = [
            'gender' => $gender,
            'civilstatus' => $civilstatus,
            'firstname' => $firstname,
            'middlename' => $middlename,
            'lastname' => $lastname,
            'photo' => $photo,
        ];

        return $this->db->table('account_info')->where('id', $id)->update($bind);
    }

    public function userinfo() {
        return $this->db->table('user_account as user')->select('user.id AS id, firstname, middlename, lastname')->inner_join('account_info as info','user.id = info.user_id')->inner_join('user_role as role', 'user.id = role.user_id')->where('role_name', 'TOURIST')->get_all();
    } 

    //USERS MANAGEMENT

    public function users_tourist() {
        return $this->db->table('user_account as user')->select('user.id as id, username, email, phone, street, barangay, municipality, province, region, zipcode, status')->inner_join('user_role as role', 'user.id = role.user_id')->where('role_name','TOURIST')->get_all();
    }

    public function users_admin() {
        return $this->db->table('user_account as user')->select('user.id as id, username, email, phone, street, barangay, municipality, province, region, zipcode, status')->inner_join('user_role as role', 'user.id = role.user_id')->where('role_name','ADMIN')->get_all();
    }

    public function tourist_booking() {
        return $this->db->table('user_account as user')->select('res.id as id, username, reference, name, check_in, check_out, total, res.status as status')->inner_join('reservations as res','user.id = res.user_id')->inner_join('room as r','res.room_id = r.id')->inner_join('user_role as role','user.id = role.user_id')->where('role_name','TOURIST')->get_all();
    }

    public function tourist_appointment() {
        return $this->db->table('user_account as user')->select('app.id as id, username, reference, name, date, time, total, app.status as status')->inner_join('appointment as app','user.id = app.user_id')->inner_join('services as serv','app.service_id = serv.id')->inner_join('user_role as role','user.id = role.user_id')->where('role_name','TOURIST')->get_all();
    }

    public function active_user($id) { 
        $bind = [
            'status'=> 'ACTIVE'
        ];
        return $this->db->table('user_account')->where('id', $id)->update($bind);
    }

    public function ban_user($id) { 
        $bind = [
            'status'=> 'BANNED'
        ];
        return $this->db->table('user_account')->where('id', $id)->update($bind);
    }

    public function get_role($id) {
        return $this->db->table('user_role')->where('user_id', $id)->get();
    }

    //booking
    public function book_save($users, $rooms, $qty, $pax, $days, $check_in, $reference, $status, $total, $note) {
        $bind = [
            'user_id' => $users,
            'room_id' => $rooms,
            'qty' => $qty,
            'pax' => $pax,
            'days' => $days,
            'check_in'=> $check_in,
            'reference'=> $reference,
            'status'=> $status,
            'total'=> $total,
            'note'=> $note
        ]; 
        return $this->db->table('reservations')->insert($bind);
    }

    public function getres($reference) {
        return $this->db->table('reservations as res')->select('reference, total, category, name, qty, res.pax as pax, days, check_in, check_out, code, res.status as status, note')->inner_join('room as r', 'res.room_id = r.id')->where('reference',$reference)->get();
    }

    public function process_res($reference) {
        $bind = [
            'status' => 'PROCESSING',
        ];
        return $this->db->table('reservations')->where('reference',$reference)->update($bind);
    }

    public function cancel_res($reference) {
        $bind = [
            'status' => 'CANCELLED',
        ]; 
        return $this->db->table('reservations')->where('reference',$reference)->update($bind);
    }

    public function reapply_res($reference) {
        $bind = [
            'status' => 'REAPPLIED',
        ]; 
        return $this->db->table('reservations')->where('reference',$reference)->update($bind);
    }

    public function bookings($token) {
        return $this->db->table('reservations as res')->select('reference, name, res.status as status, check_in, check_out')->inner_join('room as r', 'res.room_id = r.id')->inner_join('user_account as acc', 'res.user_id = acc.id')->where('token',$token)->get_all();
    }

    //appointment
    public function app_save($users, $serv, $date, $time, $reference, $status, $total, $note) {
        $bind = [
            'user_id' => $users,
            'service_id' => $serv,
            'date'=> $date,
            'time'=> $time,
            'reference'=> $reference,
            'status'=> $status,
            'total'=> $total,
            'note'=> $note
        ]; 
        return $this->db->table('appointment')->insert($bind);
    }

    public function getapp($reference) {
        return $this->db->table('appointment as app')->select('reference, total, name, date ,time, note, code, status')->inner_join('services as serv', 'app.service_id = serv.id')->where('reference',$reference)->get();
    }

    public function process_app($reference) {
        $bind = [
            'status' => 'PROCESSING',
        ];
        return $this->db->table('appointment')->where('reference',$reference)->update($bind);
    }

    public function cancel_app($reference) {
        $bind = [
            'status' => 'CANCELLED',
        ]; 
        return $this->db->table('appointment')->where('reference',$reference)->update($bind);
    }

    public function reapply_app($reference) {
        $bind = [
            'status' => 'REAPPLIED',
        ]; 
        return $this->db->table('appointment')->where('reference',$reference)->update($bind);
    }

    //payment
    public function pay($reference, $photo, $downpayment) {
        $bind = [
            'reference' => $reference,
            'photo'=> $photo,
            'downpayment'=> $downpayment
        ];
        return $this->db->table('payment')->insert($bind);
    }

    public function pay_again($reference, $photo, $downpayment) {
        $bind = [
            'photo'=> $photo,
            'downpayment'=> $downpayment
        ];
        return $this->db->table('payment')->where('reference', $reference)->update($bind);
    }

    public function check_pay($reference) {
        return $this->db->table('payment')->where('reference', $reference)->get();
    }

    //cancelled
    public function cancel() {
        return $this->db->table('cancelled')->get_all();
    }
}
?>
