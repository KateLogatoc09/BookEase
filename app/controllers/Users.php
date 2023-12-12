<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Users extends Controller {
	
    public function __construct() {
        parent:: __construct();
        $this->call->model('Account_Model', 'users');
    }

    public function t_manage() {
        $data = [
            'account'=> $this->users->users_tourist(),
            'booking' => $this->users->tourist_booking(),
            'appointment' => $this->users->tourist_appointment(),
        ];
        $this->call->view('admin_tourists_manage', $data);
    }

    public function active($id) { 
        $check = $this->users->active_user($id);
        if ($check) {
            $this->session->set_flashdata('msg','Updated Successfully.');
            $role = $this->users->get_role($id);
            if ($role['role_name'] == 'TOURIST') {
                redirect(site_url().'/admin_tourists_manage');
            } else {
                redirect(site_url().'/admin_admin_manage'); 
            }
        } else {
            $this->session->set_flashdata('msg','Something went wrong.');
            $role = $this->users->get_role($id);
            if ($role['role_name'] == 'TOURIST') {
                redirect(site_url().'/admin_tourists_manage');
            } else {
                redirect(site_url().'/admin_admin_manage'); 
            }
        }
    }

    public function ban($id) { 
        $check = $this->users->ban_user($id);
        if ($check) {
            $this->session->set_flashdata('msg','Updated Successfully.');
            $role = $this->users->get_role($id);
            if ($role['role_name'] == 'TOURIST') {
                redirect(site_url().'/admin_tourists_manage');
            } else {
                redirect(site_url().'/admin_admin_manage'); 
            }
        } else {
            $this->session->set_flashdata('msg','Something went wrong.');
            $role = $this->users->get_role($id);
            if ($role['role_name'] == 'TOURIST') {
                redirect(site_url().'/admin_tourists_manage');
            } else {
                redirect(site_url().'/admin_admin_manage'); 
            }
        }
    }

    public function a_manage() {
        $data = [
            'account'=> $this->users->users_admin(),
            'self'=> $this->users->Get_Info(sha1($_SESSION['token'])),
        ];
        $this->call->view('admin_admin_manage', $data);
    }


}
?>
