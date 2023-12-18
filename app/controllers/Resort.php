<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Resort extends Controller {
	
    public function __construct() {
        parent:: __construct();
        $this->call->model('Resort_Model', 'res');
        $this->call->model('Account_Model','acc');
    }

    public function manage() {
        $data = [
            'rooms' => $this->res->list(),
        ];
        $this->call->view('admin_resort_manage', $data);
    }

    public function reservation() {
        $data = [
            'rooms' => $this->res->list(),
            'payment' => $this->res->payment(),
            'account' => $this->acc->userinfo(),
            'reservations'=> $this->res->reservations(),
            'check' => $this->res->check_availability(),
        ];
        $this->call->view('admin_resort_reservation', $data);
    }

    public function edit($sel)  {
        $data = [
            'rooms' => $this->res->list(),
            'selected' => $this->res->selected($sel),
        ];
        $this->call->view('admin_resort_manage', $data);
    }

    public function save() { 
        if(isset($_POST['id'])) {
            //for update
            $id = $_POST['id'];
            $selected = $this->res->selected($id);
            if(!$_FILES['photo']['name']) {
                $photo = $selected['photo'];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $pax = $_POST['pax'];
                $quantity = $_POST['qty'];
                $og_price = $_POST['og_price'];
                $s_rate = $_POST['s_rate'];
                $category = $_POST['category'];
                $status = $_POST['status'];

                $check = $this->res->checkname_edit($id, $name);

                if($check) {
                    $this->session->set_flashdata('msg','a record has the same name.');
                    redirect(site_url().'/admin_resort_manage');
                } else {
                    $save = $this->res->edit($id ,$photo, $name, $description, $pax, $quantity, $og_price, $s_rate,$category, $status);
                    if($save)  {
                        $this->session->set_flashdata('msg','A record has been updated successfully.');
                        redirect(site_url().'/admin_resort_manage');
                    } else {
                        $this->session->set_flashdata('msg','Something went wrong. Please try again later.');
                        redirect(site_url().'/admin_resort_manage');
                    }
                }

            } else {

                $name = $_POST['name'];
                $description = $_POST['description'];
                $pax = $_POST['pax'];
                $quantity = $_POST['qty'];
                $og_price = $_POST['og_price'];
                $s_rate = $_POST['s_rate'];
                $category = $_POST['category'];
                $status = $_POST['status'];

                $check = $this->res->checkname_edit($id, $name);

                if($check) {
                    $this->session->set_flashdata('msg','a record has the same name.');
                    redirect(site_url().'/admin_resort_manage');
                } else {
                    $this->call->library('upload', $_FILES['photo']);
                    $this->upload
                        ->set_dir('public/resort/')	
                        ->is_image();
                    if($this->upload->do_upload()) {
                        $photo = 'public/resort/'.$this->upload->get_filename();
                        $save = $this->res->edit($id ,$photo, $name, $description, $pax, $quantity, $og_price, $s_rate,$category, $status);
                        if($save) {
                            $this->session->set_flashdata('msg', 'A record has been updated successfully.');
                            redirect(site_url().'/admin_resort_manage');
                        } else {
                            $this->session->set_flashdata('msg', 'Something went wrong. Please try again later.');
                            redirect(site_url().'/admin_resort_manage');
                            unlink('C:\laragon\www\bookease\\'.$photo);
                        }
                    } else {
                        $this->session->set_flashdata('msg', $this->upload->get_errors());
                        redirect(site_url().'/admin_resort_manage');
                    }
                }
            }
        } else {

            if(!$_FILES['photo']['name']) {

                $photo = 'public/default.jpg';
                $name = $_POST['name'];
                $description = $_POST['description'];
                $pax = $_POST['pax'];
                $quantity = $_POST['qty'];
                $og_price = $_POST['og_price'];
                $s_rate = $_POST['s_rate'];
                $category = $_POST['category'];
                $status = $_POST['status'];

                $check = $this->res->checkname($name);

                if($check) {
                    $this->session->set_flashdata('msg','a record has the same name.');
                    redirect(site_url().'/admin_resort_manage');
                } else {
                    $save = $this->res->save($photo, $name, $description, $pax, $quantity, $og_price, $s_rate,$category, $status);
                    if($save)  {
                        $this->session->set_flashdata('msg','A record has been inserted successfully.');
                        redirect(site_url().'/admin_resort_manage');
                    } else {
                        $this->session->set_flashdata('msg','Something went wrong. Please try again later.');
                        redirect(site_url().'/admin_resort_manage');
                    }
                }

            } else {

                $name = $_POST['name'];
                $description = $_POST['description'];
                $pax = $_POST['pax'];
                $quantity = $_POST['qty'];
                $og_price = $_POST['og_price'];
                $s_rate = $_POST['s_rate'];
                $category = $_POST['category'];
                $status = $_POST['status'];

                $check = $this->res->checkname($name);

                if($check) {
                    $this->session->set_flashdata('msg','a record has the same name.');
                    redirect(site_url().'/admin_resort_manage');
                } else {
                    $this->call->library('upload', $_FILES['photo']);
                    $this->upload
                        ->set_dir('public/resort/')	
                        ->is_image();
                    if($this->upload->do_upload()) {
                        $photo = 'public/resort/'.$this->upload->get_filename();
                        $save = $this->res->save($photo, $name, $description, $pax, $quantity, $og_price, $s_rate,$category, $status);
                        if($save) {
                            $this->session->set_flashdata('msg', 'A record has been inserted successfully.');
                            redirect(site_url().'/admin_resort_manage');
                        } else {
                            $this->session->set_flashdata('msg', 'Something went wrong. Please try again later.');
                            redirect(site_url().'/admin_resort_manage');
                            unlink('C:\laragon\www\bookease\\'.$photo);
                        }
                    } else {
                        $this->session->set_flashdata('msg', $this->upload->get_errors());
                        redirect(site_url().'/admin_resort_manage');
                    }
                }
            }
        }
    }

    public function delete($sel) {
        if($this->res->delete($sel)) {
            $this->session->set_flashdata('msg','Deleted Successfully.');
            redirect(site_url().'/admin_resort_manage');
        } else {
            $this->session->set_flashdata('msg','Something went wrong. Please try again later.');
            redirect(site_url().'/admin_resort_manage');
        }
    }

    //reservation
    public function res($sel)  {
        $data = [
            'reservations' => $this->res->reservations(),
            'payment' => $this->res->payment(),
            'rooms' => $this->res->list(),
            'account' => $this->acc->userinfo(),
            'selected' => $this->res->select($sel),
            'check' => $this->res->check_availability(),
        ];
        $this->call->view('admin_resort_reservation', $data);
    }

    public function save_res() {
        $random1 = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ", 60)), 0, 12);
        $random2 = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ", 60)), 0, 16);
        $room = $this->res->selected($_POST['room']);
        $payment = $this->res->selpay($_POST['reference']);
        if(isset($_POST['note'])) {
            $note = html_escape($_POST['note']);
        } else {
            $note = '';
        }
        if(isset($_POST['id'])) {

            $room_id = $_POST['room'];
            $qty = $_POST['qty'];
            $pax = $_POST['pax'];
            $days = $_POST['days'];
            $date = date_create($_POST['check_in']);
            $check_in = date_format($date, 'Y/m/d');
            $reference = $_POST['reference'];
            $status = $_POST['status'];
            $total = (($room['actual_price'] * $qty) * $days );

            if(!isset($_POST['code'])) {
                if($status == "ACCEPTED") {
                    $code = $random1;
                    $total - $payment['downpayment'];
                } else {
                    $code = '';
                }
            } else {
                $code = $_POST['code'];
                $total = $_POST['actual_price'];
            }

            $res = $this->res->edit_res($reference, $code, $room_id, $qty, $pax, $days, $check_in, $status, $total, $note);

            if($res) {
                $this->session->set_flashdata('msg','Changed successfully.');
                redirect(site_url().'/admin_resort_reservations');
            } else {
                $this->session->set_flashdata('msg','Something went wrong. Please try again later.');
                redirect(site_url().'/admin_resort_reservations');
            }

        } else {
            $user_id = $_POST['user'];
            $room_id = $_POST['room'];
            $qty = $_POST['qty'];
            $pax = $_POST['pax'];
            $days = $_POST['days'];
            $date = date_create($_POST['check_in']);
            $check_in = date_format($date, 'Y/m/d');
            $reference = $random2;
            $status = $_POST['status'];
            $total = (($room['actual_price'] * $qty) * $days );

            $res = $this->res->save_res($user_id, $room_id, $qty, $pax, $days, $check_in, $reference, $status, $total, $note);

            if($res) {
                $this->session->set_flashdata('msg','Booked successfully.');
                redirect(site_url().'/admin_resort_reservations');
            } else {
                $this->session->set_flashdata('msg','Something went wrong. Please try again later.');
                redirect(site_url().'/admin_resort_reservations');
            }
        }
    }
}
?>
