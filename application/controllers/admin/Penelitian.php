<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penelitian extends CI_Controller
{
    private $session_user;


    public function __construct()
    {
        parent::__construct();
        $this->session_user = $this->session->user_sess;
        if (!($this->session_user)) {
            redirect(base_url('login'), 'auto');
        } elseif (strtolower($this->session_user['hakAkses']) == 'staff administrasi') {
            $this->load->model('Penelitian_model');
            $this->load->model('observasi_model');
            $this->load->model('verify_model');
            $this->load->library('encryption');
            $this->load->library('my_encrypt');
        }
        else
        {
            redirect(base_url('error/403'));
        }
    }

    public function izin_penelitian()
    {
            $myAdmin = $this->session_user;
            # code...
            $myAdmin['query'] = $this->Penelitian_model->datapenelitian();
            $myAdmin['label'] = "Penelitian";
            $myAdmin['title'] = "Surat Izin Penelitian";
            $myAdmin['plugins'] = array('datatables', 'datepicker');
            $this->load->view('staff_admin/templates/header', $myAdmin);
            $this->load->view('staff_admin/pages/izinpenelitian');
            $this->load->view('staff_admin/templates/footer', $myAdmin['plugins']);
    }

    public function studi_lapangan()
    {
        $myAdmin = $this->session_user;
        $myAdmin['label'] = "Penelitian";
        $myAdmin['title'] = "Rekap Studi Lapangan";
        $myAdmin['data'] = $this->observasi_model->getLapanganAll();
        $myAdmin['plugins'] = array(
            'datatables'
        );
        $this->load->view('staff_admin/templates/header', $myAdmin);
        $this->load->view('staff_admin/pages/rekapstudilapangan', $myAdmin);
        $this->load->view('staff_admin/templates/footer', $myAdmin);
    }

    public function hapus_studilapangan($id, $nim)
    {
        $id = $this->my_encrypt->custom_decrypt($id);
        $nim = $this->my_encrypt->custom_decrypt($nim);
        $this->observasi_model->hapus($id, $nim);
        redirect(base_url('admin/penelitian/studi_lapangan'), 'refresh');
    }

    public function hapus_izinpenelitian($id, $kategori)
    {
        $id = $this->my_encrypt->custom_decrypt($id);
        $kategori = $this->my_encrypt->custom_decrypt($kategori);
        $this->Penelitian_model->delete($id, $kategori);
        redirect(base_url('admin/penelitian/izin_penelitian'), 'refresh');
    }

}

/* End of file Controllername.php */
