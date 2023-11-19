<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Main extends Controller {
	public function index() {
		$this->call->view('homepage');
	}
    public function about(){
        $this->call->view('about');
    }
    public function services(){
        $this->call->view('services');
    }
    public function package(){
        $this->call->view('package');
    }
    public function contact(){
        $this->call->view('contact');
    }
}
?>
