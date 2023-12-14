<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Spa extends Controller {
	
    public function __construct() {
        parent:: __construct();
        $this->call->model('Spa_Model', 'spa');
        $this->call->model('Account_Model', 'acc');
    }

    public function manage() {
        $data = [
            'services' => $this->spa->list(),
        ];
        $this->call->view('admin_spa_manage', $data);
    }

    public function report() {
        $bar = $this->spa->bar();
        $appointments =[];
        $services =[];

        foreach ($bar as $it){
            $appointments[] = $it['service_id'];
            $services[] = $it['service'];
        }
        $data = [
            'appointment' => json_encode($appointments),
            'service' => json_encode($services),
        ];
    
        $this->call->view('admin_spa_report', $data);
    }

    public function reservation() {
        $data = [
            'appointments' => $this->spa->appointment(),
            'payment' => $this->spa->payment(),
            'account' => $this->acc->userinfo(),
            'services' => $this->spa->list(),
        ];
        $this->call->view('admin_spa_reservation', $data);
    }

    public function edit($sel) {
        $data = [
            'services' => $this->spa->list(),
            'selected' => $this->spa->selected($sel),
        ];
        $this->call->view('admin_spa_manage', $data);
    }

    public function save() { 
        if(isset($_POST['id'])) {
            //for update
            $id = $_POST['id'];
            $selected = $this->spa->selected($id);
            if(!$_FILES['photo']['name']) {
                $photo = $selected['photo'];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $og_price = $_POST['og_price'];
                $s_rate = $_POST['s_rate'];
                $status = $_POST['status'];

                $check = $this->spa->checkname_edit($id, $name);

                if($check) {
                    $this->session->set_flashdata('msg','a record has the same name.');
                    redirect(site_url().'/admin_spa_manage');
                } else {
                    $save = $this->spa->edit($id ,$photo, $name, $description, $og_price, $s_rate, $status);
                    if($save)  {
                        $this->session->set_flashdata('msg','A record has been updated successfully.');
                        redirect(site_url().'/admin_spa_manage');
                    } else {
                        $this->session->set_flashdata('msg','Something went wrong. Please try again later.');
                        redirect(site_url().'/admin_spa_manage');
                    }
                }

            } else {

                $name = $_POST['name'];
                $description = $_POST['description'];
                $og_price = $_POST['og_price'];
                $s_rate = $_POST['s_rate'];
                $status = $_POST['status'];

                $check = $this->spa->checkname_edit($id, $name);

                if($check) {
                    $this->session->set_flashdata('msg','a record has the same name.');
                    redirect(site_url().'/admin_spa_manage');
                } else {
                    $this->call->library('upload', $_FILES['photo']);
                    $this->upload
                        ->set_dir('public/spa/')	
                        ->is_image();
                    if($this->upload->do_upload()) {
                        $photo = 'public/spa/'.$this->upload->get_filename();
                        $save = $this->spa->edit($id ,$photo, $name, $description, $og_price, $s_rate, $status);
                        if($save) {
                            $this->session->set_flashdata('msg', 'A record has been updated successfully.');
                            redirect(site_url().'/admin_spa_manage');
                        } else {
                            $this->session->set_flashdata('msg', 'Something went wrong. Please try again later.');
                            redirect(site_url().'/admin_spa_manage');
                            unlink('C:\laragon\www\bookease\\'.$photo);
                        }
                    } else {
                        $this->session->set_flashdata('msg', $this->upload->get_errors());
                        redirect(site_url().'/admin_spa_manage');
                    }
                }
            }
        } else {

            if(!$_FILES['photo']['name']) {

                $photo = 'public/default.jpg';
                $name = $_POST['name'];
                $description = $_POST['description'];
                $og_price = $_POST['og_price'];
                $s_rate = $_POST['s_rate'];
                $status = $_POST['status'];

                $check = $this->spa->checkname($name);

                if($check) {
                    $this->session->set_flashdata('msg','a record has the same name.');
                    redirect(site_url().'/admin_spa_manage');
                } else {
                    $save = $this->spa->save($photo, $name, $description, $og_price, $s_rate, $status);
                    if($save)  {
                        $this->session->set_flashdata('msg','A record has been inserted successfully.');
                        redirect(site_url().'/admin_spa_manage');
                    } else {
                        $this->session->set_flashdata('msg','Something went wrong. Please try again later.');
                        redirect(site_url().'/admin_spa_manage');
                    }
                }

            } else {

                $name = $_POST['name'];
                $description = $_POST['description'];
                $og_price = $_POST['og_price'];
                $s_rate = $_POST['s_rate'];
                $status = $_POST['status'];

                $check = $this->spa->checkname($name);

                if($check) {
                    $this->session->set_flashdata('msg','a record has the same name.');
                    redirect(site_url().'/admin_spa_manage');
                } else {
                    $this->call->library('upload', $_FILES['photo']);
                    $this->upload
                        ->set_dir('public/spa/')	
                        ->is_image();
                    if($this->upload->do_upload()) {
                        $photo = 'public/spa/'.$this->upload->get_filename();
                        $save = $this->spa->save($photo, $name, $description, $og_price, $s_rate, $status);
                        if($save) {
                            $this->session->set_flashdata('msg', 'A record has been inserted successfully.');
                            redirect(site_url().'/admin_spa_manage');
                        } else {
                            $this->session->set_flashdata('msg', 'Something went wrong. Please try again later.');
                            redirect(site_url().'/admin_spa_manage');
                            unlink('C:\laragon\www\bookease\\'.$photo);
                        }
                    } else {
                        $this->session->set_flashdata('msg', $this->upload->get_errors());
                        redirect(site_url().'/admin_spa_manage');
                    }
                }
            }
        }
    }

    public function delete($sel) {
        if($this->spa->delete($sel)) {
            $this->session->set_flashdata('msg','Deleted Successfully.');
            redirect(site_url().'/admin_spa_manage');
        } else {
            $this->session->set_flashdata('msg','Something went wrong. Please try again later.');
            redirect(site_url().'/admin_spa_manage');
        }
    }

    //appointments
    public function app($sel)  {
        $data = [
            'appointments' => $this->spa->appointment(),
            'payment' => $this->spa->payment(),
            'services' => $this->spa->list(),
            'account' => $this->acc->userinfo(),
            'selected' => $this->spa->select($sel),
        ];
        $this->call->view('admin_spa_reservation', $data);
    }

    public function save_app() {
        $random1 = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ", 60)), 0, 12);
        $random2 = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ", 60)), 0, 16);
        $payment = $this->ap->selpay($_POST['reference']);
        $services = $this->ap->selected($_POST['service_id']);
        if(isset($_POST['note'])) {
            $note = html_escape($_POST['note']);
        } else {
            $note = '';
        }
        if(isset($_POST['id'])) {

            $service_id = $_POST['service_id'];
            $d = date_create($_POST['date']);
            $date = date_format($d, 'Y/m/d');
            $time = $_POST['time'];
            $reference = $_POST['reference'];
            $status = $_POST['status'];
            $total = $services['actual_price'];

            if(!isset($_POST['code'])) {
                if($status == "ACCEPTED") {
                    $code = $random1;
                    $total -= $payment['downpayment'];
                } else {
                    $code = '';
                }
            } else {
                $code = $_POST['code'];
                $total = $_POST['total'];
            }

            $res = $this->spa->edit_app($reference, $code, $service_id, $date, $time, $status, $total, $note);

            if($res) {
                $this->session->set_flashdata('msg','Changed successfully.');
                redirect(site_url().'/admin_apartment_reservations');
            } else {
                $this->session->set_flashdata('msg','Something went wrong. Please try again later.');
                redirect(site_url().'/admin_apartment_reservations');
            }

        } else {
            $user_id = $_POST['user'];
            $service_id = $_POST['service_id'];
            $d = date_create($_POST['date']);
            $date = date_format($d, 'Y/m/d');
            $time = $_POST['time'];
            $reference = $random2;
            $status = $_POST['status'];
            $total = $services['actual_price'];

            $res = $this->ap->save_app($user_id, $service_id, $date, $time, $reference, $status, $total, $note);

            if($res) {
                $this->session->set_flashdata('msg','Booked successfully.');
                redirect(site_url().'/admin_apartment_reservations');
            } else {
                $this->session->set_flashdata('msg','Something went wrong. Please try again later.');
                redirect(site_url().'/admin_apartment_reservations');
            }
        }
    }


}
?>
