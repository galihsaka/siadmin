<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Serahterima extends CI_Controller {
	private $session_user;

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->session_user = $this->session->user_sess;
        if (!($this->session_user)) {
            redirect(base_url('login'), 'auto');
        } elseif (strtolower($this->session_user['hakAkses']) == 'staff administrasi') {
            //load library and models
            $this->load->model('verify_model');
            $this->load->model('Terima_model');

        } else {
            redirect(base_url('error/403'));
        }
    }

    public function skripsi()
    {
        $myAdmin = $this->session_user;
		$myAdmin['data'] = $this->Terima_model->dataterimaskripsi();
        $myAdmin['label'] = "Laporan";
        $myAdmin['title'] = "Terima Laporan Skripsi/TA";
        $myAdmin['plugins'] = array('datatables', 'datepicker');
        $this->load->view('staff_admin/templates/header', $myAdmin);
        $this->load->view('staff_admin/pages/terimaskripsi');
        $this->load->view('staff_admin/templates/footer', $myAdmin['plugins']);
    
    } 
	public function seminar()
    {
        $myAdmin = $this->session_user;
		$myAdmin['data'] = $this->Terima_model->dataterimaseminar();
		
        $myAdmin['label'] = "Laporan";
        $myAdmin['title'] = "Terima Laporan Sempro/Semhas";
        $myAdmin['plugins'] = array('datatables', 'datepicker');
        $this->load->view('staff_admin/templates/header', $myAdmin);
        $this->load->view('staff_admin/pages/terimaseminar');
        $this->load->view('staff_admin/templates/footer', $myAdmin['plugins']);
    
    }
    public function cancelupdate($id,$kategori)
    {   
        $this->Terima_model->updatebatal($id);
        if($kategori=="Skripsi" || $kategori=="TA" ){
			redirect(base_url('admin/serahterima/skripsi'), 'refresh');
		}
		else{
			redirect(base_url('admin/serahterima/seminar'), 'refresh');
		}
    }
	public function update($id, $kategori)
    {
        $nilai1=$this->input->post("nila1");
        $nilai2=$this->input->post("nila2");
        $skrg=date("Y-m-d");
        $this->Terima_model->updatevalid($id,$skrg);
        if($kategori=="Skripsi" || $kategori=="TA"){
            $nilaip=$this->input->post("nilap");
        }
        elseif($kategori=="Semhas" || $kategori=="Sempro"){
            $nilaip=0;
        }
        $this->Terima_model->nilai($nilai1, $nilai2, $nilaip, $id);
        if($kategori=="Skripsi" || $kategori=="TA" ){
			redirect(base_url('admin/serahterima/skripsi'), 'refresh');
		}
		else{
			redirect(base_url('admin/serahterima/seminar'), 'refresh');
		}
    }

    public function hapus($id, $kategori)
    {
        $this->Terima_model->del($id);
        if($kategori=="Skripsi" || $kategori=="TA" ){
			redirect(base_url('admin/serahterima/skripsi'), 'refresh');
		}
		else{
			redirect(base_url('admin/serahterima/seminar'), 'refresh');
		}
    }
}

/* End of file Controllername.php */
