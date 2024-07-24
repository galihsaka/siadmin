<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
		$this->load->model('Penelitian_model');

    }

    public function index()
    {
        $session = $this->session->user_sess;
        if (!($session)) {

            redirect(base_url('login'), 'auto');
        } elseif (strtolower($session['hakAkses']) == 'staff administrasi') {
            $this->admin($session);
        } elseif (strtolower($session['hakAkses']) == 'mahasiswa'){

            $this->mahasiswa($session);
        } else {
            $this->session->sess_destroy();
            redirect(base_url('login'), 'auto');
        }

    }

    private function mahasiswa($session){
        $myAdmin = $session;
        $myAdmin['label'] = "Dashboard";
        $myAdmin['title'] = "Dashboard";
		$myAdmin['cek']=$this->Penelitian_model->cekSkripsi($session);
        $this->load->view('mahasiswa/templates/header', $myAdmin);
        $this->load->view('mahasiswa/pages/dashboard_mhs', $myAdmin);
        $this->load->view('mahasiswa/templates/footer', $myAdmin);
    }

    private function admin($session)
    {

        $myAdmin = $session;
        $myAdmin['label'] = "Dashboard";
        $myAdmin['title'] = "Dashboard";
        $myAdmin['plugins'] = array('data_log');
        $this->load->view('staff_admin/templates/header', $myAdmin);
        $this->load->view('staff_admin/pages/dashboard_admin', $myAdmin);
        $this->load->view('staff_admin/templates/footer', $myAdmin);
    }

}

    
