<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Main extends Controller {
    public function __construct() {
        parent:: __construct();
        $this->call->model('Resort_Model', 'res');
        $this->call->model('Apartment_model', 'ap');
        $this->call->model('Account_Model','acc');
        $this->call->model('Spa_Model','spa');
        $this->call->model('Main_Model','main');
    }
	public function index() {
		$this->call->view('homepage');
	}
    public function try() {
		$this->call->view('try');
	}
    public function about() {
		$this->call->view('about');
	}
    public function book($id) {
        if(isset($_SESSION['token'])) {
            $token = $_SESSION['token'];
        } else {
            $token = '';
        }   
        $data = [
            'selected' => $this->res->selected($id),
            'user' => $this->acc->Get_Info(sha1($token)),
            'rooms_r' => $this->res->list(),
            'rooms_a' => $this->ap->list(),
            'checkr' => $this->res->check_availability(),
            'checka' => $this->ap->check_availability(),
        ];
		$this->call->view('book', $data);
	}
    public function appointment($id) {
        if(isset($_SESSION['token'])) {
            $token = $_SESSION['token'];
        } else {
            $token = '';
        }   
        $data = [
            'selected' => $this->spa->selected($id),
            'user' => $this->acc->Get_Info(sha1($token)),
            'appointments' => $this->spa->appointment(),
            'services' => $this->spa->list(),
        ];
		$this->call->view('appointment', $data);
	}

    public function apartments(){
        $data = [
            'rooms' => $this->ap->list(),
        ];
        $this->call->view('apartments', $data);
    }
    public function resorts(){
        $data = [
            'rooms' => $this->res->list(),
        ];
        $this->call->view('resorts', $data);
    }
    public function spa(){
        $data = [
            'services' => $this->spa->list(),
        ];
        $this->call->view('spa', $data);
    }
    public function admin(){
        $data = [
            'spa' => $this->spa->transactions(),
            'ap' => $this->ap->transactions(),
            'res' => $this->res->transactions(),
            'main' => $this->main->sales(),
        ];
        $this->call->view('admin', $data);
    }
    public function register(){
        $this->call->view('register');
    }
    public function admin_register(){
        $this->call->view('admin_register');
    }
    public function login(){
        $this->call->view('login');
    }
    public function verify(){
        $this->call->view('verify');
    }
    public function recovery(){
        $this->call->view('forgot');
    }
}
?>
