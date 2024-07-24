<?php
/**
 * Created by PhpStorm.
 * User: Syarif
 * Date: 7/25/2019
 * Time: 1:50 PM
 *
 * Class Penelitian_dinas digunakan untuk menampilkan data mahasiswa yang hendak melakukan Penelitian berkategori Dinas
 */

class Penelitian_dinas extends CI_Controller
{
    private $session_user;

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->session_user = $this->session->user_sess;
        if (!($this->session_user)) {
            redirect(base_url('login'), 'auto');
        } elseif (strtolower($this->session_user['hakAkses']) == 'mahasiswa') {
            //load library and models
            $this->load->model('verify_model');
            $this->load->library('form_validation');
            $this->load->model('Penelitian/dinas_model');
            $this->load->model('Penelitian_model');
            $this->load->library('encryption');
            $this->load->library('my_encrypt');

        } else {
            redirect(base_url('error/403'));
        }
    }

    //View Data
    public function index()
    {
        $user = $this->session_user['username'];
        $myAdmin = $this->session_user;
        $this->db_sisinta = $this->load->database('db_sisinta', TRUE);
        $myAdmin            = $this->session_user;
        $myAdmin['label']   = "Daftar Penelitian";
        $myAdmin['title']   = "Riwayat Penelitian ke Jurusan";
        $query1 = $this->db_sisinta->query("SELECT COUNT(*) AS jml FROM data_judul WHERE nim=$user AND (status_judul='DITERIMA' OR status_judul='REVISI')");
        foreach ($query1->result() as $row) {
            if ($row->jml == 1) {
                $myAdmin['stat'] = "Berhasil";
            } else {
                $myAdmin['stat'] = "Gagal";
            }
        }
        $myAdmin['label'] = "Daftar Penelitian";
        $myAdmin['title'] = "Riwayat Penelitian ke Dinas";
        $myAdmin['data'] = $this->dinas_model->history_dinas($myAdmin['noInduk']);
        $myAdmin['plugins'] = array('datatables');
        $this->load->view('mahasiswa/templates/header', $myAdmin);
        $this->load->view('mahasiswa/pages/dinas');
        $this->load->view('mahasiswa/templates/footer');
    }

    //Add Data
    public function daftar()
    {
        $myAdmin = $this->Penelitian_model->getData($this->session_user);
        $myAdmin['label'] = "Daftar Penelitian";
        $myAdmin['title'] = "Penelitian ke Dinas";
        $myAdmin['plugins'] = array('datepicker');
        $this->load->view('mahasiswa/templates/header', $myAdmin);
        $this->load->view('mahasiswa/pages/daftardinas');
        $this->load->view('mahasiswa/templates/footer');
    }

    //Submit form
    public function submit()
    {
        $dataDinas = array(
            'nim' => $this->session_user['username'],
            'nama' => $this->session_user['nama'],
            'prodi' => $this->input->post('prodi'),
            'judul' => $this->input->post('judul'),
            'kategori' => "Dinas",
            'penerima_surat' => $this->input->post('pihak'),
            'alamat_instansi' => $this->input->post('alamat'),
            'tgl_mulai' => $this->input->post('tgl_mulai'),
            'tgl_berakhir' => $this->input->post('tgl_akhir'),
            'tgl_buat' => $this->input->post('tgl_buat')
        );
        $sta = $this->input->post('stat');
        $dataSekolah = array(
            'sekolah' => $this->input->post('namasekolah[]'),
            'alamat' => $this->input->post('alamatsekolah[]')
        );
        $this->form_validation->set_message('required', '%s wajib diisi');
        $this->form_validation->set_message('callback_xss_filter', 'Inputan %s invalid');
        $this->form_validation->set_rules("pihak", "Nama dinas tujuan", "required|callback_xss_filter");
        $this->form_validation->set_rules("alamat", "Alamat dinas tujuan", "required|callback_xss_filter");
        $this->form_validation->set_rules("tgl_mulai", "Tanggal mulai", "required");
        $this->form_validation->set_rules("tgl_akhir", "Tanggal akhir", "required");
        $this->form_validation->set_rules("tgl_buat", "Tanggal pengajuan penelitian", "required");
        $this->form_validation->set_rules("namasekolah[]", "Instansi tujuan", "required|callback_xss_filter");

        if ($this->form_validation->run()) {
            $query = $this->dinas_model->save($dataDinas, $dataSekolah);
            if ($query) {
                $tujuan = array();
                for ($i = 0; $i < count($dataSekolah['sekolah']); $i++) {
                    array_push($tujuan, array(
                        'Nama_sekolah' => $dataSekolah['sekolah'][$i],
                        'alamat' => $dataSekolah['alamat'][$i]
                    ));
                }
                $data_encrypt = $this->my_encrypt->custom_encode(
                    json_encode(
                        array(
                            'dinas' => $dataDinas,
                            'instansi' => $tujuan
                        )
                    )
                );

                redirect(base_url('mhs/penelitian_dinas/success/' . $data_encrypt.'/'.$sta));
            }
        } else {
            $this->daftar();
        }
    }

    public function success($cipher, $s)
    {
        if (isset($cipher)) {
            $myAdmin = $this->session_user;
            $myAdmin['label'] = "Daftar Penelitian";
            $myAdmin['title'] = 'Pendaftaran Penelitian Dinas';
            $url = "mhs/penelitian_dinas/";
            $myAdmin['url'] = $url;
            $myAdmin['stat'] = $s;
            $myAdmin['url2'] = "mhs/penelitian_dinas/printdoc/" . $cipher."/".$s;
            $this->load->view('mahasiswa/templates/header', $myAdmin);
            $this->load->view('mahasiswa/pages/success/berhasil');
            $this->load->view('mahasiswa/templates/footer', $myAdmin);
        }
    }

    //Print Data
    public function printdoc($cipher, $s)
    {
        $json_data = $this->my_encrypt->custom_decrypt($cipher);
        if ($json_data) {
            $json_data = json_decode($json_data);
//            print_r($json_data);
            $data['yth'] = $json_data->dinas->penerima_surat;
            $data['tgl_akhir'] = $json_data->dinas->tgl_berakhir;
            $data['tgl_buat'] = $json_data->dinas->tgl_buat;
            $data['alam'] = $json_data->dinas->alamat_instansi;
            $data['tgl_mulai'] = $json_data->dinas->tgl_mulai;
            $data['nama_mhs'] = $json_data->dinas->nama;
            $data['nim'] = $json_data->dinas->nim;
            $data['prodi'] = $json_data->dinas->prodi;
            $data['judul'] = $json_data->dinas->judul;
            $data['stat']     = $s;
            list($data['jenjang'], $data['prodi_']) = explode(" ", $data['prodi'], 2);

            $kategori = $json_data->dinas->kategori;
            if ($kategori == "Dinas") {
                $data['tuju'] = $json_data->instansi;
            }

            //Get Data Kaprodi by prodi mhs
            $data['kaprodi'] = $this->Penelitian_model->getDataKaprodi($data['jenjang'], $data['prodi_']);

            //Get Data Pembimbing 1
            if($s=='Gagal'){
                $p1=$this->input->post('pem1');
                $this->db_master = $this->load->database('db_master', TRUE);
                $quer = $this->db_master->query("SELECT * FROM `user` WHERE (level='11' OR level='8') AND nama_lengkap='$p1'");
                foreach ($quer->result() as $row) {
                    $np=$row->nomor_induk;
                }
                $tesarr=array(
                'nama_dosen' => $p1,
                'nip' => $np
                );
                $data['pem_1'] = $tesarr;
            }
            elseif($s=='Berhasil'){
            $data['pem_1'] = $this->Penelitian_model->getDataPembimbing1($data['nim']);
        }
            if ($data['jenjang'] == "S1") {
                $data['jenjang'] = "Skripsi";
            } else {
                $data['jenjang'] = "Tugas Akhir";
            }
            $this->load->library('pdf');
            $this->pdf->setPaper('A4', 'potrait');
            $this->pdf->filename = "Penelitian_" . $data['nim'] . ".pdf";
            $this->pdf->load_view('mahasiswa/document/my_penelitian_dinas', $data);
        }
    }

    public function xss_filter($str)
    {
        if ($this->security->xss_clean($str, TRUE) === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

}