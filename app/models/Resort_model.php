<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Resort_model extends Model {

    public function list() {
        return $this->db->table('room')->where('category', 'RESORT')->get_all();
    }

    public function list_avail() {
        $where = [
            'category'=> 'RESORT',
            'status' => 'AVAILABLE',
        ];
        return $this->db->table('room')->where($where)->get_all();
    }

    public function selected($sel) {
        return $this->db->table('room')->where('id', $sel)->get();
    }

    public function checkname( $name ) { 
        return $this->db->table('room')->where('name',$name)->not_where('category', 'APARTMENT')->get();
    }

    public function checkname_edit( $id , $name ) { 
        $not = [
            'id' => $id,
            'category' => 'APARTMENT',
        ];
        return $this->db->table('room')->where('name',$name)->not_where($not)->get();
    }

    public function delete( $id ) { 
        return $this->db->table('room')->where('id', $id)->delete();
    }
    
    public function save($photo, $name, $description, $pax, $qty, $og_price, $s_rate, $categ, $status) {
        $bind = [
            'photo' => $photo,
            'name' => $name, 
            'description' => $description,
            'pax' => $pax,
            'quantity'=> $qty,
            'original_price' => $og_price,
            'seasonal_rates' => $s_rate,
            'category' => $categ, 
            'status' => $status, 
        ];

        return $this->db->table('room')->insert($bind);
    }

    public function edit($id, $photo, $name, $description, $pax, $qty, $og_price, $s_rate, $categ, $status) {
        $bind = [
            'photo' => $photo,
            'name' => $name, 
            'description' => $description,
            'pax' => $pax,
            'quantity' => $qty,
            'original_price' => $og_price,
            'seasonal_rates' => $s_rate,
            'category' => $categ, 
            'status' => $status, 
        ];

        return $this->db->table('room')->where('id', $id)->update($bind);
    }

    //reservations
    public function reservations() {
        return $this->db->table('reservations AS res')->select('res.id AS resid, name, actual_price, qty, firstname, middlename, lastname, phone, res.pax as pax, days, check_in, check_out, total, code, reference, res.status as status, note')->inner_join('room AS r', 'res.room_id = r.id')->inner_join('account_info AS info', 'res.user_id = info.user_id')->inner_join('user_account AS acc', 'res.user_id = acc.id')->where('r.category', 'RESORT')->get_all();
    }

    public function select($sel) {
        return $this->db->table('reservations as res')->select('res.id AS id, res.user_id as user_id, firstname, middlename, lastname, room_id, name, qty, res.pax as pax, days, check_in, check_out, code, reference, res.status AS status, total, note ')->inner_join('room AS r', 'res.room_id = r.id')->inner_join('account_info AS info', 'res.user_id = info.user_id')->where('res.id', $sel)->get();
    }

    public function check_availability() {
        return $this->db->table('booked_dates as bdt')->select('date, bdt.room_id as room_id')->select_sum('bdt.qty', 'qty')->inner_join('room as r','bdt.room_id = r.id')->where('category', 'RESORT')->group_by(['room_id', 'date'])->get_all();
    }

    public function payment() {
        return $this->db->table('payment as pay')->select('pay.id as id, pay.photo as photo, pay.reference as reference, downpayment')->inner_join('reservations as res', 'pay.reference = res.reference')->inner_join('room as r', 'res.room_id = r.id')->where('category', 'RESORT')->get_all();
    }

    public function selpay($reference) {
        return $this->db->table('payment')->where('reference', $reference)->get();
    }

    public function save_res($userid, $roomid, $qty, $pax, $days, $check_in, $reference, $status, $total, $note) {
        $bind = [
            'user_id' => $userid,
            'room_id' => $roomid,
            'qty'=> $qty,
            'pax'=> $pax,
            'days'=> $days,
            'check_in'=> $check_in,
            'reference'=> $reference,
            'status'=> $status,
            'total'=> $total,
            'note'=> $note,
        ];
        return $this->db->table('reservations')->insert($bind);
    }

    public function edit_res($reference, $code, $roomid, $qty, $pax, $days, $check_in, $status, $total, $note) {
        $bind = [ 
            'code' => $code,
            'room_id' => $roomid,
            'qty'=> $qty,
            'pax'=> $pax,
            'days'=> $days,
            'check_in'=> $check_in,
            'status'=> $status,
            'total'=> $total,
            'note'=> $note,
        ];
        return $this->db->table('reservations')->where('reference', $reference)->update($bind);
    }

    public function transactions() {
        return $this->db->table('reservations as res')->select_count('res.id', 'total_row')->inner_join('room as r', 'res.room_id = r.id')->where('category', 'RESORT')->get();
    }
	
}
?>
