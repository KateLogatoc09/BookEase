<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Apartment extends Controller {
	
    public function __construct() {
        parent:: __construct();
        $this->call->model('Apartment_model', 'ap');
        $this->call->model('Account_model','acc');
    }

    public function manage() {
        $data = [
            'rooms' => $this->ap->list(),
        ];
        $this->call->view('admin_apartment_manage', $data);
    }

    public function report() {
        $this->call->view('admin_apartment_report');
    }

    public function reservation() {
        $data = [
            'rooms' => $this->ap->list(),
            'payment' => $this->ap->payment(),
            'account' => $this->acc->userinfo(),
            'reservations'=> $this->ap->reservations(),
            'check' => $this->ap->check_availability(),
        ];
        $this->call->view('admin_apartment_reservation', $data);
    }

    public function edit($sel)  {
        $data = [
            'rooms' => $this->ap->list(),
            'selected' => $this->ap->selected($sel),
        ];
        $this->call->view('admin_apartment_manage', $data);
    }

    public function save() { 
        if(isset($_POST['id'])) {
            //for update
            $id = $_POST['id'];
            $selected = $this->ap->selected($id);
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

                $check = $this->ap->checkname_edit($id, $name);

                if($check) {
                    $this->session->set_flashdata('msg','a record has the same name.');
                    redirect(site_url().'/admin_apartment_manage');
                } else {
                    $save = $this->ap->edit($id ,$photo, $name, $description, $pax, $quantity, $og_price, $s_rate,$category, $status);
                    if($save)  {
                        $this->session->set_flashdata('msg','A record has been updated successfully.');
                        redirect(site_url().'/admin_apartment_manage');
                    } else {
                        $this->session->set_flashdata('msg','Something went wrong. Please try again later.');
                        redirect(site_url().'/admin_apartment_manage');
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

                $check = $this->ap->checkname_edit($id, $name);

                if($check) {
                    $this->session->set_flashdata('msg','a record has the same name.');
                    redirect(site_url().'/admin_apartment_manage');
                } else {
                    $this->call->library('upload', $_FILES['photo']);
                    $this->upload
                        ->set_dir('public/apartment/')	
                        ->is_image();
                    if($this->upload->do_upload()) {
                        $photo = 'public/apartment/'.$this->upload->get_filename();
                        $save = $this->ap->edit($id ,$photo, $name, $description, $pax, $quantity, $og_price, $s_rate,$category, $status);
                        if($save) {
                            $this->session->set_flashdata('msg', 'A record has been updated successfully.');
                            redirect(site_url().'/admin_apartment_manage');
                        } else {
                            $this->session->set_flashdata('msg', 'Something went wrong. Please try again later.');
                            redirect(site_url().'/admin_apartment_manage');
                            unlink('C:\laragon\www\bookease\\'.$photo);
                        }
                    } else {
                        $this->session->set_flashdata('msg', $this->upload->get_errors());
                        redirect(site_url().'/admin_apartment_manage');
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

                $check = $this->ap->checkname($name);

                if($check) {
                    $this->session->set_flashdata('msg','a record has the same name.');
                    redirect(site_url().'/admin_apartment_manage');
                } else {
                    $save = $this->ap->save($photo, $name, $description, $pax, $quantity, $og_price, $s_rate,$category, $status);
                    if($save)  {
                        $this->session->set_flashdata('msg','A record has been inserted successfully.');
                        redirect(site_url().'/admin_apartment_manage');
                    } else {
                        $this->session->set_flashdata('msg','Something went wrong. Please try again later.');
                        redirect(site_url().'/admin_apartment_manage');
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

                $check = $this->ap->checkname($name);

                if($check) {
                    $this->session->set_flashdata('msg','a record has the same name.');
                    redirect(site_url().'/admin_apartment_manage');
                } else {
                    $this->call->library('upload', $_FILES['photo']);
                    $this->upload
                        ->set_dir('public/apartment/')	
                        ->is_image();
                    if($this->upload->do_upload()) {
                        $photo = 'public/apartment/'.$this->upload->get_filename();
                        $save = $this->ap->save($photo, $name, $description, $pax, $quantity, $og_price, $s_rate,$category, $status);
                        if($save) {
                            $this->session->set_flashdata('msg', 'A record has been inserted successfully.');
                            redirect(site_url().'/admin_apartment_manage');
                        } else {
                            $this->session->set_flashdata('msg', 'Something went wrong. Please try again later.');
                            redirect(site_url().'/admin_apartment_manage');
                            unlink('C:\laragon\www\bookease\\'.$photo);
                        }
                    } else {
                        $this->session->set_flashdata('msg', $this->upload->get_errors());
                        redirect(site_url().'/admin_apartment_manage');
                    }
                }
            }
        }
    }

    public function delete($sel) {
        if($this->ap->delete($sel)) {
            $this->session->set_flashdata('msg','Deleted Successfully.');
            redirect(site_url().'/admin_apartment_manage');
        } else {
            $this->session->set_flashdata('msg','Something went wrong. Please try again later.');
            redirect(site_url().'/admin_apartment_manage');
        }
    }

    //reservation
    public function res($sel)  {
        $data = [
            'reservations' => $this->ap->reservations(),
            'payment' => $this->ap->payment(),
            'rooms' => $this->ap->list(),
            'account' => $this->acc->userinfo(),
            'selected' => $this->ap->select($sel),
            'check' => $this->ap->check_availability(),
        ];
        $this->call->view('admin_apartment_reservation', $data);
    }

    public function save_res() {
        $random1 = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ", 60)), 0, 12);
        $random2 = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ", 60)), 0, 16);
        $room = $this->ap->selected($_POST['room']);
        $payment = $this->ap->selpay($_POST['reference']);
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
                    $total -= $payment['downpayment'];
                } else {
                    $code = '';
                }
            } else {
                $code = $_POST['code'];
                $total = $_POST['total'];
            }

            $res = $this->ap->edit_res($reference, $code, $room_id, $qty, $pax, $days, $check_in, $status, $total, $note);

            if($res) {
                $this->session->set_flashdata('msg','Changed successfully.');
                redirect(site_url().'/admin_apartment_reservations');
            } else {
                $this->session->set_flashdata('msg','Something went wrong. Please try again later.');
                redirect(site_url().'/admin_apartment_reservations');
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

            $res = $this->ap->save_res($user_id, $room_id, $qty, $pax, $days, $check_in, $reference, $status, $total, $note);

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
