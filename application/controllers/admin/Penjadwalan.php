<?php
/**
 * Created by PhpStorm.
 * User: Syarif
 * Date: 01-Jul-19
 * Time: 7:52 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class penjadwalan extends CI_Controller
{
    private $session_user;

    public function __construct()
    {
        parent::__construct();
        $this->session_user = $this->session->user_sess;
        if (!($this->session_user)) {
            redirect(base_url('login'), 'auto');
        } elseif (strtolower($this->session_user['hakAkses']) == 'staff administrasi') {
            //load library and models
            $this->load->model('verify_model');
            $this->load->model('Jadwal_model');
            $this->load->model('Penelitian_model');
            $this->load->library('encryption');
            $this->load->library('my_encrypt');
        } else {
            redirect(base_url('error/403'));
        }
    }

    public function index()
    {
        $myAdmin = $this->session_user;
        $myAdmin['data'] = $this->Jadwal_model->lihatjadwal();
        $myAdmin['label'] = "Penjadwalan";
        $myAdmin['title'] = "Jadwal Sidang dan Seminar";
        $myAdmin['plugins'] = array('datatables', 'datepicker');
        $this->load->view('staff_admin/templates/header', $myAdmin);
        $this->load->view('_partials/logout_modal');
        $this->load->view('staff_admin/pages/jadwal');
        $this->load->view('staff_admin/templates/footer', $myAdmin['plugins']);
    }

    public function updatebatal($id, $val, $tgl)
    {
        $this->Jadwal_model->deleteSertem($val, $tgl);
        $this->Jadwal_model->update($id, "Diproses");
        redirect(base_url('admin/penjadwalan/'), 'refresh');
    }

    public function updatevalid($datajson)
    {
        $json_data = $this->my_encrypt->custom_decrypt($datajson);
        if ($json_data) {
            $row = json_decode($json_data);
            $this->Jadwal_model->insertSertem($row);
            $id= $row->id;
        $this->Jadwal_model->update($id, "Diterima");
    }
        redirect(base_url('admin/penjadwalan/'), 'refresh');
    }

    public function delete($id)
    {

        $this->Jadwal_model->hapus($id);
        redirect(base_url('admin/penjadwalan/'), 'refresh');
    }

    public function cetak($cipher)
    {

        $time_start = microtime(true);

        function konversi($tgl_inggris)
        {
            if ($tgl_inggris == "Sunday") {
                $tgl_indo = "Minggu";
            } elseif ($tgl_inggris == 'Monday') {
                $tgl_indo = "Senin";
            } elseif ($tgl_inggris == 'Tuesday') {
                $tgl_indo = "Selasa";
            } elseif ($tgl_inggris == 'Wednesday') {
                $tgl_indo = "Rabu";
            } elseif ($tgl_inggris == 'Thursday') {
                $tgl_indo = "Kamis";
            } elseif ($tgl_inggris == 'Friday') {
                $tgl_indo = "Jum'at";
            } elseif ($tgl_inggris == 'Saturday') {
                $tgl_indo = "Sabtu";
            }
            return $tgl_indo;
        }

        $bulan = array(
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $thnajar = $this->input->post("thnajar");
        $semester = $this->input->post("sem");
        $json_data = $this->my_encrypt->custom_decrypt($cipher);
        if ($json_data) {
            $row = json_decode($json_data);
            $pecahkan = explode('-', $row->tanggal);
            if (substr($pecahkan[2], 0, 1) == 0) {
                $pecahkan[2] = substr($pecahkan[2], 1);
            }
            if($row->nama_jenjang=="S1"){
                $data['jenisUjian'] = "Skripsi";
            }
            elseif ($row->nama_jenjang=="D3") {
                $data['jenisUjian'] = "Tugas Akhir";
            }
            $data['semester'] = $semester;
            $data['tahunAjaran'] = $thnajar;
            $data['nim'] = $row->nim;
            $data['nama'] = $row->nama_lengkap;
            $data['prodi'] = $row->nama_jenjang . " " . $row->nama_prodi;
            $data['nomorhp'] = $row->kontak;
            $data['judul'] = $row->judul;

            $data['hari_seminar'] = konversi(date("l", strtotime($row->tanggal)));
            $data['tanggal_seminar'] = $pecahkan[2];
            $data['bulan_seminar'] = $bulan[(int)$pecahkan[1]];
            $data['tahun_seminar'] = $pecahkan[0];
            $data['jam'] = date("H:i", strtotime($row->jam));
            $data['ruang'] = $row->ruang;

            $data['kaprodi'] = $this->Penelitian_model->getDataKaprodi($row->nama_jenjang, $row->nama_prodi);
            $data['pembimbing1'] = $row->pembimbing1;
            $data['pembimbing2'] = $row->pembimbing2;
            $data['penguji'] = $row->penguji;
            $data['nip_pembimbing1'] = $this->Jadwal_model->getNip($row->pembimbing1);
            $data['nip_pembimbing2'] = $this->Jadwal_model->getNip($row->pembimbing2);
        }
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "BeritaAcara_".$data['nim']."_". $data['tanggal_seminar'].$data['bulan_seminar'].$data['tahun_seminar'].".pdf";
        //Print Disposisi
        $this->pdf->load_view('staff_admin/document/beritaAcara', $data);
    }

}

