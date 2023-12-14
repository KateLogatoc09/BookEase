<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Mail_model extends Model {
	
    //subscription
    public function subscription($email) {
        $bind =[
            'email' => $email,
            'status' => 'ACTIVE',
        ];
        return $this->db->table('subscription')->insert($bind);
    }

    public function update($id, $status) {
        $bind =[
            'status' => strtoupper($status),
        ];
        return $this->db->table('subscription')->where('id', $id)->update($bind);
    }

    public function list() {
        return $this->db->table('subscription')->get_all();
    }

    public function active() {
        return $this->db->table('subscription')->where('status', 'ACTIVE')->get_all();
    }

    public function check($email) {
        return $this->db->table('subscription')->where('email', $email)->get();
    }
}
?>
