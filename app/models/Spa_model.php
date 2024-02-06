<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Spa_model extends Model {
	public function list() {
        return $this->db->table('services')->get_all();
    }

    public function list_avail() {
        return $this->db->table('services')->where('status', 'AVAILABLE')->get_all();
    }

    public function selected($sel) {
        return $this->db->table('services')->where('id', $sel)->get();
    }

    public function checkname( $name ) { 
        return $this->db->table('services')->where('name',$name)->get();
    }

    public function checkname_edit( $id , $name ) { 
        return $this->db->table('services')->where('name',$name)->not_where('id', $id)->get();
    }

    public function delete( $id ) { 
        return $this->db->table('services')->where('id', $id)->delete();
    }
    
    public function save($photo, $name, $description, $og_price, $s_rate, $status) {
        $bind = [
            'photo' => $photo,
            'name' => $name, 
            'description' => $description,
            'original_price' => $og_price,
            'seasonal_rates' => $s_rate,
            'status' => $status, 
        ];

        return $this->db->table('services')->insert($bind);
    }

    public function edit($id ,$photo, $name, $description, $og_price, $s_rate, $status) {
        $bind = [
            'photo' => $photo,
            'name' => $name, 
            'description' => $description,
            'original_price' => $og_price,
            'seasonal_rates' => $s_rate,
            'status' => $status, 
        ];

        return $this->db->table('services')->where('id', $id)->update($bind);
    }
    public function bar() {
       
        $data = $this->db->table('appointment')
                         ->select('service_id, COUNT(id) as service')
                         ->group_by('service_id')
                         ->get_all();
        return $data;
    }

    //appoinment 
    public function appointment() {
        return $this->db->table('appointment as app')->select('app.id as id, firstname, middlename, lastname, phone, name, actual_price, date, time, reference, code, total, app.status as status, note')->inner_join('user_account as acc', 'app.user_id = acc.id')->left_join('account_info as info','app.user_id = info.user_id')->inner_join('services as serv','app.service_id = serv.id')->get_all();
    }

    public function select($sel) {
        return $this->db->table('appointment as app')->select('app.id as id, app.user_id as user_id, service_id, firstname, middlename, lastname, phone, name, actual_price, date, time, reference, code, total, app.status as status, note')->inner_join('user_account as acc', 'app.user_id = acc.id')->inner_join('account_info as info','app.user_id = info.user_id')->inner_join('services as serv','app.service_id = serv.id')->where('app.id',$sel)->get();
    }

    public function payment() {
        return $this->db->table('payment as pay')->select('pay.id as id, pay.photo as photo, pay.reference as reference, downpayment')->inner_join('appointment as app', 'pay.reference = app.reference')->get_all();
    }

    public function selpay($reference) {
        return $this->db->table('payment')->where('reference', $reference)->get();
    }

    public function edit_app($reference, $code, $service_id, $date, $time, $status, $total, $note) {
        $bind = [
            'code' => $code,
            'service_id' => $service_id,
            'date' => $date,
            'time' => $time,
            'status' => $status, 
            'total'=> $total,
            'note'=> $note
        ];

        return $this->db->table('appointment')->where('reference', $reference)->update($bind);
    }

    public function save_app($user_id, $service_id, $date, $time, $reference, $status, $total, $note) {
        $bind = [
            'user_id' => $user_id,
            'service_id' => $service_id,
            'date' => $date,
            'time' => $time,
            'reference' => $reference,
            'status' => $status, 
            'total'=> $total,
            'note'=> $note
        ];

        return $this->db->table('appointment')->insert($bind);
    }

    public function transactions() {
        return $this->db->table('appointment')->select_count('id', 'total_row')->get();
    }

}
?>
