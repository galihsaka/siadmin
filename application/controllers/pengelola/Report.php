<?php
/**
 * Created by PhpStorm.
 * User: Syarif
 * Date: 8/1/2019
 * Time: 10:35 AM
 */

class Report extends CI_Controller
{
    private $session_user;

    public function __construct()
    {
        parent::__construct();
        $this->session_user = $this->session->user_sess;
        if (!($this->session_user)) {
            redirect(base_url('login'), 'auto');
        } elseif (strtolower($this->session_user['hakAkses']) == 'staff administrasi') {
            $this->load->model('report_model');
        } else {
            redirect(base_url('error/403'));
        }
    }

    public function log_update()
    {
        $data = array(
            "surat_masuk" => $this->report_model->countSuratMasukByDay(),
            "studi_lapangan" => $this->report_model->countStudiLapanganByDay(),
            "penelitian" => $this->report_model->countPenelitianByDay()

        );

        echo json_encode($data);
    }

    public function getDataLog()
    {
        $data = array(
            "surat_masuk" => $this->report_model->getSuratMasuk(),
            "studi_lapangan" => $this->report_model->getStudiLapangan(),
            "penelitian" => $this->report_model->getPenelitian()
        );
        echo json_encode($data);

    }

    public function getDataLogSurat()
    {
        $surat = $this->report_model->getSuratMasuk();
        $value_occurs = array(
            'Print' => 0,
            'Update' => 0,
            'Create' => 0
        );
        foreach ($surat as $row) {
            $value_occurs[$row->crud_detail]++;
        }
        echo json_encode($value_occurs);
    }

    public function countDataLog()
    {
        $data = array(
            "surat_masuk" => $this->report_model->countSuratMasuk(),
            "studi_lapangan" => $this->report_model->countStudiLapangan(),
            "penelitian" => $this->report_model->countPenelitian(),
        );

        echo json_encode($data);
    }
}