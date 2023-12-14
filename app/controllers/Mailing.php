<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Mailing extends Controller {

	public function __construct() {
        parent:: __construct();
        $this->call->model('Mail_Model', 'mail');
    }

    public function email() {
        $this->call->view('admin_mail');
    }

    public function send() {
        ini_set('SMTP', 'mailpit');
        ini_set('smtp_port', 1025);

        if(!$_FILES['photo']['name']) {
            $this->email->sender('noreply_bookease@gmail.com', 'Bookease');
            $this->email->recipient($_POST['recipient']);
            $this->email->subject($_POST['subject']);
            $this->email->email_content($_POST['message']);

            $test = $this->email->send();
            if($test) {
                $this->session->set_flashdata('msg', 'Email was sent successfully.');
                redirect(site_url().'/admin_emails_send');
            } else {
                $this->session->set_flashdata('msg', 'Something went wrong, Please try again later.');
                redirect(site_url().'/admin_emails_send');
            }

        } else {
            $this->call->library('upload', $_FILES['photo']);
                $this->upload
                    ->set_dir('public/mail')
                    ->is_image();
                if($this->upload->do_upload()) {
                    $this->email->sender('noreply_bookease@gmail.com', 'Bookease');
                    $this->email->recipient($_POST['recipient']);
                    $this->email->subject($_POST['subject']);
                    $this->email->email_content($_POST['message']);
                    $this->email->attachment('public/mail/'.$this->upload->get_filename());

                    $test = $this->email->send();
                    if($test) {
                        $this->session->set_flashdata('msg', 'Email was sent successfully.');
                        redirect(site_url().'/admin_emails_send');
                    } else {
                        $this->session->set_flashdata('msg', 'Something went wrong, Please try again later.');
                        redirect(site_url().'/admin_emails_send');
                    }

                } else {
                    $this->session->set_flashdata('msg', $this->upload->get_errors());
                    redirect(site_url().'/admin_emails_send');
                }
        }
    }

    public function subs() {
        $data = [
            'subscribers'=> $this->mail->list(),
        ];
        $this->call->view('admin_subscription', $data);
    }

    public function subs_send() {
        ini_set('SMTP', 'mailpit');
        ini_set('smtp_port', 1025);

        $subscribers = $this->mail->active();

        if(!$_FILES['photo']['name']) {
            foreach($subscribers as $sub) {
                $this->email->sender('noreply_bookease@gmail.com', 'Bookease');
                $this->email->recipient($sub['email']);
                $this->email->subject($_POST['subject']);
                $this->email->email_content($_POST['message']);

                $test = $this->email->send();
            }
            if($test) {
                $this->session->set_flashdata('msg', 'Email was sent successfully.');
                redirect(site_url().'/admin_subscription_subscribers');
            } else {
                $this->session->set_flashdata('msg', 'Something went wrong, Please try again later.');
                redirect(site_url().'/admin_subscription_subscribers');
            }

        } else {
            $this->call->library('upload', $_FILES['photo']);
                $this->upload
                    ->set_dir('public/mail')
                    ->is_image();
                if($this->upload->do_upload()) {
                    foreach($subscribers as $sub) {
                        $this->email->sender('noreply_bookease@gmail.com', 'Bookease');
                        $this->email->recipient($sub['email']);
                        $this->email->subject($_POST['subject']);
                        $this->email->email_content($_POST['message']);
                        $this->email->attachment('public/mail/'.$this->upload->get_filename());

                        $test = $this->email->send();
                    }
                    if($test) {
                        $this->session->set_flashdata('msg', 'Email was sent successfully.');
                        redirect(site_url().'/admin_subscription_subscribers');
                    } else {
                        $this->session->set_flashdata('msg', 'Something went wrong, Please try again later.');
                        redirect(site_url().'/admin_subscription_subscribers');
                    }

                } else {
                    $this->session->set_flashdata('msg', $this->upload->get_errors());
                    redirect(site_url().'/admin_subscription_subscribers');
                }
        }
    }

    public function update($status, $id) {
        $check = $this->mail->update($id, $status);
        if($check) {
            $this->session->set_flashdata('msg', 'Updated Successfully.');
            redirect(site_url().'/admin_subscription_subscribers');
        } else {
            $this->session->set_flashdata('msg', 'Something went wrong. Please try again later.');
            redirect(site_url().'/admin_subscription_subscribers');
        }
    }

    public function query() {
        ini_set('SMTP', 'mailpit');
        ini_set('smtp_port', 1025);

        $this->email->sender($_POST['email'], $_POST['name']);
        $this->email->recipient('bookease_cs@gmail.com');
        $this->email->subject($_POST['subject']);
        $this->email->email_content($_POST['message']);

        $test = $this->email->send();

        if($test) {
            $this->session->set_flashdata('msg', 'message sent successfully.');
            redirect(site_url().'/');
        } else {
            $this->session->set_flashdata('msg', 'something went wrong, please try again later.');
            redirect(site_url().'/');
        }
    }

    public function subscribe() {
        ini_set('SMTP', 'mailpit');
        ini_set('smtp_port', 1025);

        $check = $this->mail->check($_POST['subs']);
        if($check) {
            $this->session->set_flashdata('msg','You are already subscribe.');
            redirect(site_url().'/');
        } else {
            $this->email->sender('no-reply_bookease@gmail.com', 'BookEase');
            $this->email->recipient($_POST['subs']);
            $this->email->subject('Subscription Letter');
            $this->email->email_content('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en"><head><meta charset="UTF-8"><meta content="width=device-width, initial-scale=1" name="viewport"><meta name="x-apple-disable-message-reformatting"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta content="telephone=no" name="format-detection"><title>New email template 2023-11-29</title> <!--[if (mso 16)]><style type="text/css">     a {text-decoration: none;}     </style><![endif]--> <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--> <!--[if gte mso 9]><xml> <o:OfficeDocumentSettings> <o:AllowPNG></o:AllowPNG> <o:PixelsPerInch>96</o:PixelsPerInch> </o:OfficeDocumentSettings> </xml>
            <![endif]--><style type="text/css">#outlook a { padding:0;}.es-button { mso-style-priority:100!important; text-decoration:none!important;}a[x-apple-data-detectors] { color:inherit!important; text-decoration:none!important; font-size:inherit!important; font-family:inherit!important; font-weight:inherit!important; line-height:inherit!important;}.es-desk-hidden { display:none; float:left; overflow:hidden; width:0; max-height:0; line-height:0; mso-hide:all;}@media only screen and (max-width:600px) {p, ul li, ol li, a { line-height:150%!important } h1, h2, h3, h1 a, h2 a, h3 a { line-height:120% } h1 { font-size:30px!important; text-align:center } h2 { font-size:26px!important; text-align:center } h3 { font-size:20px!important; text-align:center } .es-header-body h1 a, .es-content-body h1 a, .es-footer-body h1 a { font-size:30px!important } .es-header-body h2 a, .es-content-body h2 a, .es-footer-body h2 a { font-size:26px!important }
            .es-header-body h3 a, .es-content-body h3 a, .es-footer-body h3 a { font-size:20px!important } .es-menu td a { font-size:12px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:16px!important } .es-content-body p, .es-content-body ul li, .es-content-body ol li, .es-content-body a { font-size:16px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:16px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px!important } *[class="gmail-fix"] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important }
            .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:block!important } a.es-button, button.es-button { font-size:20px!important; display:block!important; border-left-width:0px!important; border-right-width:0px!important } .es-adaptive table, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0!important } .es-m-p0r { padding-right:0!important } .es-m-p0l { padding-left:0!important } .es-m-p0t { padding-top:0!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important }
            tr.es-desk-hidden, td.es-desk-hidden, table.es-desk-hidden { width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } tr.es-desk-hidden { display:table-row!important } table.es-desk-hidden { display:table!important } td.es-desk-menu-hidden { display:table-cell!important } .es-menu td { width:1%!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } .es-m-p5 { padding:5px!important } .es-m-p5t { padding-top:5px!important } .es-m-p5b { padding-bottom:5px!important } .es-m-p5r { padding-right:5px!important } .es-m-p5l { padding-left:5px!important } .es-m-p10 { padding:10px!important } .es-m-p10t { padding-top:10px!important } .es-m-p10b { padding-bottom:10px!important } .es-m-p10r { padding-right:10px!important }
            .es-m-p10l { padding-left:10px!important } .es-m-p15 { padding:15px!important } .es-m-p15t { padding-top:15px!important } .es-m-p15b { padding-bottom:15px!important } .es-m-p15r { padding-right:15px!important } .es-m-p15l { padding-left:15px!important } .es-m-p20 { padding:20px!important } .es-m-p20t { padding-top:20px!important } .es-m-p20r { padding-right:20px!important } .es-m-p20l { padding-left:20px!important } .es-m-p25 { padding:25px!important } .es-m-p25t { padding-top:25px!important } .es-m-p25b { padding-bottom:25px!important } .es-m-p25r { padding-right:25px!important } .es-m-p25l { padding-left:25px!important } .es-m-p30 { padding:30px!important } .es-m-p30t { padding-top:30px!important } .es-m-p30b { padding-bottom:30px!important } .es-m-p30r { padding-right:30px!important } .es-m-p30l { padding-left:30px!important } .es-m-p35 { padding:35px!important } .es-m-p35t { padding-top:35px!important }
            .es-m-p35b { padding-bottom:35px!important } .es-m-p35r { padding-right:35px!important } .es-m-p35l { padding-left:35px!important } .es-m-p40 { padding:40px!important } .es-m-p40t { padding-top:40px!important } .es-m-p40b { padding-bottom:40px!important } .es-m-p40r { padding-right:40px!important } .es-m-p40l { padding-left:40px!important } .es-desk-hidden { display:table-row!important; width:auto!important; overflow:visible!important; max-height:inherit!important } .h-auto { height:auto!important } }</style>
            </head>
            <body style="width:100%;font-family:arial, "helvetica neue", helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0"><div dir="ltr" class="es-wrapper-color" lang="en" style="background-color:#4B3636"> <!--[if gte mso 9]><v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t"> <v:fill type="tile" src="https://demo.stripocdn.email/content/guids/d72fce9d-dba6-4dac-86eb-d6ff80680b44/images/sample3.jpg" color="#4b3636" origin="0.5, 0" position="0.5, 0"></v:fill> </v:background><![endif]--><table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;background-image:url(https://ectushn.stripocdn.email/content/guids/d72fce9d-dba6-4dac-86eb-d6ff80680b44/images/sample3.jpg);background-color:#4B3636" background="https://ectushn.stripocdn.email/content/guids/d72fce9d-dba6-4dac-86eb-d6ff80680b44/images/sample3.jpg" role="none"><tr>
            <td valign="top" style="padding:0;Margin:0"><table cellpadding="0" cellspacing="0" class="es-header" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top"><tr><td align="center" style="padding:0;Margin:0"><table class="es-header-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px" role="none"><tr><td class="esdev-adapt-off" align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px"><table cellpadding="0" cellspacing="0" class="esdev-mso-table" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:560px"><tr>
            <td class="esdev-mso-td" valign="top" style="padding:0;Margin:0"><table cellpadding="0" cellspacing="0" align="left" class="es-left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left"><tr><td class="es-m-p0r" valign="top" align="center" style="padding:0;Margin:0;width:160px"><table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr class="es-mobile-hidden"><td align="center" height="40" style="padding:0;Margin:0"></td> </tr><tr><td style="padding:0;Margin:0"><table cellpadding="0" cellspacing="0" width="100%" class="es-menu" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr class="links">
            <td align="center" valign="top" width="100%" id="esd-menu-id-2" style="Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0" bgcolor="#ffffff"><a target="_blank" href="https://viewstripo.email" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, "helvetica neue", helvetica, sans-serif;color:#267908;font-size:14px">Booking</a></td></tr></table></td></tr></table></td></tr></table></td><td style="padding:0;Margin:0;width:5px"></td> <td class="esdev-mso-td" valign="top" style="padding:0;Margin:0"><table cellpadding="0" cellspacing="0" class="es-left" align="left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left"><tr>
            <td align="left" style="padding:0;Margin:0;width:230px"><table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr><td align="center" style="padding:0;Margin:0;font-size:0px"><img class="adapt-img" src="https://ectushn.stripocdn.email/content/guids/CABINET_f98e020270223e2a44e4a44fba0a2baa/images/41231616158491096.png" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="230" height="98"></td></tr></table></td></tr></table></td><td style="padding:0;Margin:0;width:5px"></td> <td class="esdev-mso-td" valign="top" style="padding:0;Margin:0"><table cellpadding="0" cellspacing="0" class="es-right" align="right" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right"><tr>
            <td align="left" style="padding:0;Margin:0;width:160px"><table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr class="es-mobile-hidden"><td align="center" height="40" style="padding:0;Margin:0"></td></tr> <tr><td style="padding:0;Margin:0"><table cellpadding="0" cellspacing="0" width="100%" class="es-menu" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr class="links"> <!--[if !mso]><!-- -->
            <td align="center" valign="top" width="100%" class="es-desk-menu-hidden es-desk-hidden" id="esd-menu-id-2" style="display:none;float:left;overflow:hidden;width:0;max-height:0;line-height:0;mso-hide:all;Margin:0;padding-left:5px;padding-right:5px;padding-top:10px;padding-bottom:10px;border:0" bgcolor="#ffffff"><a target="_blank" href="https://viewstripo.email" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;display:block;font-family:arial, "helvetica neue", helvetica, sans-serif;color:#267908;font-size:14px">Services</a></td> <!--<![endif]--></tr></table></td></tr></table></td></tr></table></td></tr></table></td></tr></table></td></tr></table> <table class="es-content" cellspacing="0" cellpadding="0" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%"><tr>
            <td align="center" style="padding:0;Margin:0"><table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#ffffff;width:600px" cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff" role="none"><tr><td align="left" style="padding:0;Margin:0"><table width="100%" cellspacing="0" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr><td class="es-m-p0r es-m-p20b" valign="top" align="center" style="padding:0;Margin:0;width:600px"><table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr>
            <td align="center" style="padding:0;Margin:0;font-size:0px"><a target="_blank" href="https://viewstripo.email" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#EFEFEF;font-size:14px"><img class="adapt-img" src="https://ectushn.stripocdn.email/content/guids/CABINET_f98e020270223e2a44e4a44fba0a2baa/images/20421621332367763.png" alt="Mardi Gras" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="600" title="Mardi Gras" height="600"></a> </td></tr><tr><td align="center" class="es-m-p20r es-m-p20l" style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:36px;color:#267908;font-size:24px">Be Updated for Limited Promotion and Offers.</p>
            </td></tr><tr><td align="center" style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;font-size:0"><table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr><td style="padding:0;Margin:0;border-bottom:2px solid #e6c37e;background:none;height:1px;width:100%;margin:0px"></td></tr></table></td></tr> <tr><td align="center" class="es-m-p20r es-m-p20l" style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:24px;color:#267908;font-size:16px">Don\'t miss our discounts and promos.</p></td></tr></table></td></tr></table></td></tr></table></td></tr></table>
            <table cellpadding="0" cellspacing="0" class="es-content" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%"><tr><td align="center" style="padding:0;Margin:0"><table bgcolor="#267908" class="es-content-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#267908;width:600px" role="none"><tr><td align="left" style="padding:20px;Margin:0"><table cellpadding="0" cellspacing="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr>
            <td align="center" valign="top" style="padding:0;Margin:0;width:560px"><table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-width:2px;border-style:dashed;border-color:#e6c37e;background-image:url(https://ectushn.stripocdn.email/content/guids/CABINET_f98e020270223e2a44e4a44fba0a2baa/images/11681621340147580.png);background-repeat:no-repeat;background-position:left top" background="https://ectushn.stripocdn.email/content/guids/CABINET_f98e020270223e2a44e4a44fba0a2baa/images/11681621340147580.png" role="presentation"><tr>
            <td align="center" style="padding:20px;Margin:0"><h1 style="Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;font-size:30px;font-style:normal;font-weight:bold;color:#FFFFFF"><strong><a target="_blank" href="localhost:8080" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#e6c37e;font-size:30px">You are now subscribe to our newsletter.</a> </strong></h1></td></tr></table></td></tr></table></td></tr> <tr><td align="left" style="padding:0;Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px"><table cellpadding="0" cellspacing="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr>
            <td align="center" valign="top" style="padding:0;Margin:0;width:560px"><table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr>
            <td align="center" style="padding:0;Margin:0"><span class="es-button-border" style="border-style:solid;border-color:#2CB543;background:#ffffff;border-width:0px;display:inline-block;border-radius:0px;width:auto"><a href="localhost:8080" class="es-button es-button-1621332819545" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#267908;font-size:18px;padding:15px 30px;display:inline-block;background:#ffffff;border-radius:0px;font-family:arial, "helvetica neue", helvetica, sans-serif;font-weight:bold;font-style:normal;line-height:22px;width:auto;text-align:center;mso-padding-alt:0;mso-border-alt:10px solid #ffffff">SEE MORE</a> </span></td></tr></table></td></tr></table></td></tr></table></td></tr></table>
            <table cellpadding="0" cellspacing="0" class="es-footer" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top"><tr><td align="center" style="padding:0;Margin:0"><table bgcolor="#267908" class="es-footer-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#267908;width:600px" role="none"><tr><td align="left" style="padding:0;Margin:0;padding-left:20px;padding-right:20px;padding-top:30px"> <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr>
            <td style="width:270px" valign="top"><![endif]--><table cellpadding="0" cellspacing="0" align="left" class="es-left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left"><tr><td class="es-m-p20b" align="center" valign="top" style="padding:0;Margin:0;width:270px"><table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr>
            <td align="left" class="es-m-txt-c" style="padding:0;Margin:0"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;color:#FFFFFF;font-size:14px"><a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#EFEFEF;font-size:14px" href="localhost:8080">Our hotels</a> </p></td></tr><tr>
            <td align="left" class="es-m-txt-c" style="padding:0;Margin:0"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;color:#FFFFFF;font-size:14px"><a target="_blank" href="localhost:8080" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#EFEFEF;font-size:14px">Booking</a></p></td></tr> <tr>
            <td align="left" class="es-m-txt-c" style="padding:0;Margin:0"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;color:#FFFFFF;font-size:14px"><a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:none;color:#EFEFEF;font-size:14px" href="localhost:8080">Services</a></p></td></tr></table></td></tr></table> <!--[if mso]></td><td style="width:20px"></td><td style="width:270px" valign="top"><![endif]--><table cellpadding="0" cellspacing="0" class="es-right" align="right" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right"><tr>
            <td align="left" style="padding:0;Margin:0;width:270px"><table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr><td align="left" class="es-m-txt-c h-auto" height="21" style="padding:0;Margin:0"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;color:#FFFFFF;font-size:14px">Be social with us</p></td></tr> <tr><td align="left" class="es-m-txt-c" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;font-size:0"><table cellpadding="0" cellspacing="0" class="es-table-not-adapt es-social" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr>
            <td align="center" valign="top" style="padding:0;Margin:0;padding-right:20px"><a target="_blank" href="facebook.com" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#EFEFEF;font-size:14px"><img title="Facebook" src="https://ectushn.stripocdn.email/content/assets/img/social-icons/square-white/facebook-square-white.png" alt="Fb" width="32" height="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
            <td align="center" valign="top" style="padding:0;Margin:0;padding-right:20px"><a target="_blank" href="twitter.com" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#EFEFEF;font-size:14px"><img title="Twitter" src="https://ectushn.stripocdn.email/content/assets/img/social-icons/square-white/twitter-square-white.png" alt="Tw" width="32" height="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
            <td align="center" valign="top" style="padding:0;Margin:0;padding-right:20px"><a target="_blank" href="instagram.com" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#EFEFEF;font-size:14px"><img title="Instagram" src="https://ectushn.stripocdn.email/content/assets/img/social-icons/square-white/instagram-square-white.png" alt="Inst" width="32" height="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
            <td align="center" valign="top" style="padding:0;Margin:0"><a target="_blank" href="youtube.com" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#EFEFEF;font-size:14px"><img title="Youtube" src="https://ectushn.stripocdn.email/content/assets/img/social-icons/square-white/youtube-square-white.png" alt="Yt" width="32" height="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td></tr></table></td></tr></table></td></tr></table> <!--[if mso]></td></tr></table><![endif]--></td></tr></table></td></tr></table> <table cellpadding="0" cellspacing="0" class="es-content" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%"><tr>
            <td class="es-info-area" align="center" style="padding:0;Margin:0"><table bgcolor="#267908" class="es-content-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#267908;width:600px" role="none"><tr><td align="left" style="padding:20px;Margin:0"><table cellpadding="0" cellspacing="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr><td align="center" valign="top" style="padding:0;Margin:0;width:560px"><table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr>
            <td align="center" class="es-infoblock" style="padding:0;Margin:0;line-height:14px;font-size:12px;color:#CCCCCC"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:14px;color:#CCCCCC;font-size:12px">No longer want to review this email?&nbsp;<a target="_blank" href="https://viewstripo.email/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#CCCCCC;font-size:12px">Unsubscribe</a> </p>
            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:14px;color:#CCCCCC;font-size:12px"><a target="_blank" href="https://viewstripo.email/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#CCCCCC;font-size:12px">View in your browser</a></p></td></tr></table></td></tr></table></td></tr></table></td></tr></table> <table cellpadding="0" cellspacing="0" class="es-content" align="center" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%"><tr>
            <td align="center" style="padding:0;Margin:0"><table class="es-content-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px" role="none"><tr><td align="left" style="padding:20px;Margin:0"><table cellpadding="0" cellspacing="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr><td align="center" valign="top" style="padding:0;Margin:0;width:560px"><table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr>
            <td align="center" class="es-infoblock made_with" style="padding:0;Margin:0;line-height:14px;font-size:0;color:#CCCCCC"><a target="_blank" href="https://viewstripo.email/?utm_source=templates&utm_medium=email&utm_campaign=hotels_2&utm_content=coupon_to_our_hotel" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#CCCCCC;font-size:12px"><img src="https://ectushn.stripocdn.email/content/guids/CABINET_09023af45624943febfa123c229a060b/images/7911561025989373.png" alt width="125" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" height="56"></a> </td></tr></table></td></tr></table></td></tr></table></td></tr></table></td></tr></table></div></body></html>', 'html');

            $test = $this->email->send();

            $test2 = $this->mail->subscription($_POST['subs']);

            if($test && $test2) {
                $this->session->set_flashdata('msg', 'successfully subscribed to our newsletter.');
                redirect(site_url().'/');
            } else {
                $this->session->set_flashdata('msg', 'something went wrong, please try again later.');
                redirect(site_url().'/');
            }
        }
    }
}
?>
