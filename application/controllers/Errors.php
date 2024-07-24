<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('verify_model');

    }

    public function error($code = 404)
    {
        $session = $this->session->user_sess;
        $myAdmin['error_code'] = $code;
        $myAdmin['label'] = 'Error';

        if (!($session)) {
            $myAdmin['hakAkses'] = 'guest';
            $myAdmin['nama'] = 'Guest';

        } else {
            $myAdmin['username'] = $session['username'];
            $myAdmin['level'] = $session['level'];
            $myAdmin['nama'] = $session['nama'];
            $myAdmin['hakAkses'] = $session['hakAkses'];
        }
        if ($code == 403) {
            $myAdmin['error_message'] = 'Unauthorized User';
            $myAdmin['title'] = "Error 403";
        } else {
            $myAdmin['error_message'] = 'Page Not Found';
            $myAdmin['title'] = "Error 404";
        }


        //View
        if (strtolower($myAdmin['hakAkses']) == 'staff administrasi') {
            $this->load->view('staff_admin/templates/header.php', $myAdmin);
            $this->load->view('errors/error_template', $myAdmin);
            $this->load->view('staff_admin/templates/footer.php', $myAdmin);
        } elseif (strtolower($myAdmin['hakAkses']) == 'mahasiswa') {
            $myAdmin['tahunMasuk'] = $session['tahunMasuk'];
            $this->load->view('mahasiswa/templates/header.php', $myAdmin);
            $this->load->view('errors/error_template', $myAdmin);
            $this->load->view('mahasiswa/templates/footer.php', $myAdmin);
        } else {
            $this->load->view('_partials/header.php', $myAdmin);
            $this->load->view('errors/error_template', $myAdmin);
            $this->load->view('_partials/footer.php', $myAdmin);
        }

    }
}

