<?php

/**
 * Created by PhpStorm.
 * User: Syarif
 * Date: 01-Jul-19
 * Time: 9:06 AM
 *
 * class Suratmasuk memiliki ekstensi dari CodeIgniter Controller (CI_Controller)
 * yang memiliki 5 method yang akan dijelaskan sebagai berikut:
 * 1. __construct(): ketika class ini terpanggil, akan meload model surat_model yang terdapat di direktori models,
 *      dan library form_validation untuk melakukan proses validasi pengisian form.
 * 2. method index merupakan
 *
 *
 *
 *
 *
 *
 *
 *
 */

class Suratmasuk extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('surat_model');
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->load->library('encryption');
        $this->load->library('my_encrypt');

    }

    public function index($year = null)
    {
        // Ambil data user pada session
        $session = $this->session->user_sess;
        if (!($session)) {
            // Jika tidak ada session masuk ke halaman login
            redirect(base_url('login'), 'auto');
        } else {
            // Jika ada session
            if ($year == null) {
                // Mengambil tahun saat ini
                $year = date("Y");
            }
            $myAdmin = $session;
            // Verifikasi hak akses admin

            if (strtolower($myAdmin['hakAkses']) == 'staff administrasi') {
                // Menampilkan halaman surat masuk (admin)
                $myAdmin['year'] = $year;
                $myAdmin['data'] = $this->surat_model->getByYear($year);
                if(count($myAdmin['data']) == 0 & $myAdmin['year'] != date("Y")){
                    $this->session->set_flashdata('warning', 'Data pada tahun '.$myAdmin['year'].' tidak ditemukan. Kembali ke tahun sekarang');
                    $myAdmin['year'] = date("Y");
                    $myAdmin['data'] = $this->surat_model->getByYear($myAdmin['year']);
                }
                $myAdmin['label'] = "Surat Masuk";
                $myAdmin['title'] = $myAdmin['label']." ".$myAdmin['year'];
                $myAdmin['plugins'] = array(
                    'datatables',
                    'datepicker'
                );
//                echo date("Y-m-d 00:00:00", strtotime("today"));
//                echo date("Y-m-d 00:00:00", strtotime("tomorrow"));
                $this->load->view('staff_admin/templates/header', $myAdmin);
                $this->load->view('staff_admin/pages/surat_masuk');
                $this->load->view('staff_admin/templates/footer', $myAdmin['plugins']);
            } else {
                redirect(base_url('error/403'));
            }
        }
    }

    // Function untuk menambah data surat masuk
    public function add()
    {
        $validation = $this->form_validation;
        $rules = $this->form_rules();
        // Validasi form tambah surat masuk
        $validation->set_rules($rules);
        if ($validation->run()) {
            // Menambah data surat masuk lalu menampilkan berdasarkan tahun
            # Simpan data dari form ke dalam array
            $data = array(
                'tgl_terima' => $this->input->post('tgl_terima'),
                'tgl_pembuatan' => $this->input->post('tgl_pembuatan'),
                'no_surat' => $this->input->post('no_surat'),
                'perihal' => $this->input->post('perihal'),
                'asal' => $this->input->post('asal'),
                'kategori' => $this->input->post('kategori')
            );
            $date = $this->surat_model->model_tambah($data);
            $year = date("Y", strtotime($date));
            $this->session->set_flashdata('success', 'Berhasil ditambahkan');
            redirect(base_url('admin/suratmasuk/' . $year), 'refresh');
        } else {
            $this->session->set_flashdata('fail', 'Gagal ditambahkan');
            redirect(base_url('admin/suratmasuk/'), 'refresh');
        }
    }

    public function add_kosong()
    {
        $date = $this->surat_model->model_tambah_kosong();
        $year = date("Y", strtotime($date));
        $this->session->set_flashdata('success', 'Berhasil ditambahkan');
        redirect(base_url('admin/suratmasuk/' . $year), 'refresh');
    }

    public function update($id)
    {
        $id = $this->my_encrypt->custom_decrypt($id);
        # code...
        $rules = $this->form_rules();
        $surat = $this->surat_model;
        $validation = $this->form_validation;
        $validation->set_rules($rules);
        // Validasi form update surat masuk
        if ($validation->run()) {
            // Menambah data surat masuk lalu menampilkan berdasarkan tahun
            $year = $surat->model_edit($id);
            $this->session->set_flashdata('success', 'Berhasil diedit');
            redirect(base_url('admin/suratmasuk/' . $year), 'refresh');
        } else {
            $this->session->set_flashdata('fail', 'Gagal diedit');
            redirect(base_url('admin/suratmasuk/'), 'refresh');
        }

    }

    public function cetak($key)
    {
        $plain = $this->my_encrypt->custom_decrypt($key);
        $data = json_decode($plain);
        if ($data) {
            // Simpan data dari databaase surat_masuk berdasarkan ID ke dalam array $data
            $result['no_agenda'] = $data->no_agenda;
            $result['no'] = $data->no_surat;
            $result['asal'] = $data->asal;
            $result['hal'] = $data->perihal;
            $result['tgl_buat'] = $this->tgl_indo($data->tgl_pembuatan);
            $result['tgl_terima'] = $this->tgl_indo($data->tgl_terima);
            $result['thn'] = $this->tahun($data->tgl_terima);
            // Pengaturan ukuran kertas, orientasi, nama file
            $this->load->library('pdf');
            $this->pdf->setPaper('A5', 'potrait');
            $this->pdf->filename = "disposisi_".$result['no_agenda']."_".$result['thn'].".pdf";
            // Print Disposisi
            $this->pdf->load_view('staff_admin/document/disposisi', $result);
        }
    }

    public function cetak_coba()
    {
            $this->load->library('pdf');
            $this->pdf->setPaper('A4', 'potrait');
            $this->pdf->filename = "coba.pdf";
            // Print Disposisi
            $this->pdf->load_view('mahasiswa/document/terima_skripsi');
    }
    // Function untuk mengatur validasi form. nomor surat boleh dikosongi
    private function form_rules()
    {
        return array(
            array(
                'field' => 'tgl_terima',
                'label' => 'Tanggal Terima',
                'rules' => 'required'
            ),
            array(
                'field' => 'tgl_pembuatan',
                'label' => 'Tanggal Pembuatan',
                'rules' => 'required'
            ),
            array(
                'field' => 'no_surat',
                'label' => 'Nomor Surat',
                'rules' => 'callback_xss_filter'
            ),
            array(
                'field' => 'perihal',
                'label' => 'Perihal',
                'rules' => 'required|callback_xss_filter'
            ),
            array(
                'field' => 'asal',
                'label' => 'Asal',
                'rules' => 'required|callback_xss_filter'
            ),
            array(
                'field' => 'kategori',
                'label' => 'Kategori',
                'rules' => 'required|callback_xss_filter'
            )
        );
    }

    public function xss_filter($str)
    {
        if ($this->security->xss_clean($str, TRUE) === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function tgl_indo($tanggal)
    {
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
        $pecahkan = explode('-', $tanggal);
        if (substr($pecahkan[2], 0, 1) == 0) {
            $pecahkan[2] = substr($pecahkan[2], 1);
        }
        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }

    function tahun($tanggal)
    {
        $pecahkan = explode('-', $tanggal);
        return $pecahkan[0];
    }

} 