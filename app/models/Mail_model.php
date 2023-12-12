<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Mail_model extends Model {
	
    //subscription
    public function subscription($email) {
        $bind =[
            'email' => $email,
        ];
        return $this->db->table('subscription')->insert($bind);
    }

    public function check($email) {
        return $this->db->table('subscription')->where('email', $email)->get();
    }
}
?>
