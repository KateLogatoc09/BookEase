<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Main extends Controller {
	public function index() {
		$this->call->view('homepage');
	}
    public function account(){
        $this->call->view('account');
    }
    public function apartments(){
        $this->call->view('apartments');
    }
    public function resorts(){
        $this->call->view('resorts');
    }
    public function spa(){
        $this->call->view('spa');
    }
    public function admin(){
        $this->call->view('admin');
    }
    public function register(){
        $this->call->view('register');
    }
    public function login(){
        $this->call->view('login');
    }
    public function adminlogin(){
        $this->call->view('adminlogin');
    }
}
?>
