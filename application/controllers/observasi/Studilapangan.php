<?php
/**
 * Created by PhpStorm.
 * User: Syarif
 * Date: 7/10/2019
 * Time: 9:28 PM
 *
 *
 * Class ini digunakan untuk pendaftaran studi lapangan dan izin penelitian
 */


class Studilapangan extends CI_Controller
{

    private $session_user;

    //Parent Construct

    public function __construct()
    {

        parent::__construct();
        $this->session_user = $this->session->user_sess;
        if (!($this->session_user)) {
            redirect(base_url('login'), 'auto');
        } elseif (strtolower($this->session_user['hakAkses']) == "mahasiswa") {
            $this->load->model('observasi_model');
            $this->load->model('verify_model');
            $this->load->library('form_validation');
            $this->load->library('encryption');
            $this->load->library('my_encrypt');
        } else {
            redirect(base_url('error/403'));
        }

    }

    public function index()
    {
        $myAdmin = $this->session_user;
        $myAdmin['label'] = "Penelitian";
        $myAdmin['title'] = "Riwayat Studi Lapangan";
        $myAdmin['plugins'] = array(
            'datatables'
        );
        $myAdmin['data'] = $this->observasi_model->getLapanganByNim($myAdmin['noInduk']);
        $this->load->view('mahasiswa/templates/header', $myAdmin);
        $this->load->view('mahasiswa/pages/studilapangan', $myAdmin);
        $this->load->view('mahasiswa/templates/footer', $myAdmin);
    }


//Methods
    public function daftarStudiLapangan()
    {
        //TODO Program Studi berupa Option Input
        $myAdmin = $this->session_user;
        $myAdmin['label'] = 'Studi Lapangan';
        $myAdmin['title'] = 'Pendaftaran Studi Lapangan';
        $this->load->view('mahasiswa/templates/header', $myAdmin);
        $this->load->view('mahasiswa/pages/daftar_studilapangan', $myAdmin);
        $this->load->view('mahasiswa/templates/footer', $myAdmin);
    }

    public function daftar()
    {
        $myAdmin = $this->session_user;
        $validation = $this->form_validation;
        $rules = $this->form_rules();
        $this->form_validation->set_message('required', '%s wajib diisi');
        $validation->set_rules($rules);
        if ($validation->run()) {
            //Memasukkan data instansi ke dalam tabel studi_lapangan
            $dataInstansi = array(
                'nim_ketua' => $myAdmin['username'],
                'mata_kuliah' => $this->input->post('matkul'),
                'prodi_kel' => $this->input->post('prodi_kel'),
                'alamat_instansi' => $this->input->post('alamat'),
                'tanggal_mulai' => $this->input->post('tgl_mulai'),
                'tanggal_akhir' => $this->input->post('tgl_akhir'),
                'tgl_buat' => $this->input->post('tgl_buat'),
                'instansi_tujuan' => $this->input->post('tujuan'),
                'kepada' => $this->input->post('kepada'),
                'judul' => $this->input->post('judul')
            );
            $dataAnggota = array(
                'nim' => $this->input->post('nim[]'),
                'nama' => $this->input->post('nama[]'),
                'prodi' => $this->input->post('prodi[]')
            );

            if ((count($dataAnggota['nim'])) == (count($dataAnggota['nama'])) && (count($dataAnggota['nim'])) == (count($dataAnggota['prodi']))) {
                $query = $this->observasi_model->addLapangan($dataInstansi, $dataAnggota);

                if ($query) {
                    $anggota = array();
                    for ($i = 0; $i < count($dataAnggota['nama']); $i++) {
                        array_push($anggota, array(
                            'nim' => $dataAnggota['nim'][$i],
                            'nama' => $dataAnggota['nama'][$i],
                            'prodi' => $dataAnggota['prodi'][$i]
                        ));
                    }

                    $data_encrypt = $this->my_encrypt->custom_encode(
                        json_encode(
                            array(
                                'instansi' => $dataInstansi,
                                'anggota' => $anggota
                            )
                        )
                    );

                    redirect(base_url('observasi/studilapangan/success/' . $data_encrypt));

                }
            }
        } else {

            $myAdmin['label'] = 'Studi Lapangan';
            $myAdmin['title'] = 'Pendaftaran Studi Lapangan';
            $this->load->view('mahasiswa/templates/header', $myAdmin);
            $this->load->view('mahasiswa/pages/daftar_studilapangan', $myAdmin);
            $this->load->view('mahasiswa/templates/footer', $myAdmin);
        }
    }


//Ketika sukses menambah maka panggil fungsi ini
    public function success($cipher)
    {
        $myAdmin = $this->session->user_sess;
        $myAdmin['label'] = 'Studi Lapangan';
        $myAdmin['title'] = 'Pendaftaran Studi Lapangan';
        $url = "observasi/studilapangan/";
        $myAdmin['url'] = $url;
        $myAdmin['url2'] = "observasi/studilapangan/printdoc/" . $cipher;
        $this->load->view('mahasiswa/templates/header', $myAdmin);
        $this->load->view('mahasiswa/pages/success/berhasil', $myAdmin);
        $this->load->view('mahasiswa/templates/footer', $myAdmin);
    }


    public function printDoc($json_data)
    {
        $session = $this->session->user_sess;
        if (!($session)) {
            redirect(base_url('login'), 'auto');
        } else {
            $statusjur=$this->input->post("vlds");
            $json_data = $this->my_encrypt->custom_decrypt($json_data);
            if ($json_data) {

                $json_data = json_decode($json_data);

                //Mempersiapkan data untuk ditampilkan di view
                if($statusjur=="kajur"){
                    $kajur = $this->verify_model->getMenjabat(10);
                    $jabat="Ketua Jurusan Teknik Elektro";
                }
                elseif ($statusjur=="sekjur") {
                    $kajur = $this->verify_model->getMenjabat(9);
                    $jabat="a.n. Ketua Jurusan Teknik Elektro<br>Sekretaris Jurusan Teknik Elektro,";
                }
                $data['judul'] = $json_data->instansi->judul;
                $data['yth'] = $json_data->instansi->kepada;
                $data['alamat'] = $json_data->instansi->alamat_instansi;
                $data['matkul'] = $json_data->instansi->mata_kuliah;
                $data['prodi'] = $json_data->instansi->prodi_kel;
                $data['tujuan'] = $json_data->instansi->instansi_tujuan;
                $data['mulai'] = $json_data->instansi->tanggal_mulai;
                $data['akhir'] = $json_data->instansi->tanggal_akhir;
                $data['anggota'] = $json_data->anggota;
                $data['kajur'] = $kajur;
                $data['jabat'] = $jabat;
                $data['tgl_ajukan'] = $json_data->instansi->tgl_buat;
                $data['jml_anggota'] = count($json_data->anggota);


                //Mengenerate PDF
                $this->load->library('pdf');
                $this->pdf->setPaper('A4', 'potrait');
                $this->pdf->filename = "StudiLapangan_".$json_data->anggota[0]->nim.".pdf";
                $this->pdf->load_view('mahasiswa/document/my_studi_lapangan', $data);

            } else {
                redirect(base_url());
            }
        }

    }

    public function nambahanggota($id)
    {
        $data = $this->verify_model->getMahasiswa($id);
        echo json_encode($data);
    }

    private function form_rules()
    {
        return array(
            array(
                'field' => 'matkul',
                'label' => 'Matakuliah',
                'rules' => 'required|callback_xss_filter'
            ),
            array(
                'field' => 'prodi_kel',
                'label' => 'Prodi kelompok',
                'rules' => 'required|callback_xss_filter'
            ),
            array(
                'field' => 'judul',
                'label' => 'Judul studi lapangan',
                'rules' => 'required|callback_xss_filter'
            ),
            array(
                'field' => 'tujuan',
                'label' => 'Instansi tujuan',
                'rules' => 'required|callback_xss_filter'
            ),
            array(
                'field' => 'kepada',
                'label' => 'Pihak instansi tujuan',
                'rules' => 'required|callback_xss_filter'
            ),
            array(
                'field' => 'alamat',
                'label' => 'Alamat instansi',
                'rules' => 'required|callback_xss_filter'
            ),
            array(
                'field' => 'tgl_mulai',
                'label' => 'Tanggal mulai',
                'rules' => 'required|callback_compareDate'
            ),
            array(
                'field' => 'tgl_akhir',
                'label' => 'Tanggal akhir',
                'rules' => 'required|callback_compareDate'
            ),
			array(
                'field' => 'tgl_buat',
                'label' => 'Tanggal Pengajuan',
                'rules' => 'required|callback_compareDate'
            ),
            array(
                'field' => 'nama[]',
                'label' => 'Nama',
                'rules' => 'required|callback_xss_filter'
            ),
            array(
                'field' => 'nim[]',
                'label' => 'NIM',
                'rules' => 'required|callback_xss_filter'
            ),
            array(
                'field' => 'prodi[]',
                'label' => 'Prodi',
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

    public function compareDate()
    {
        $startDate = strtotime($this->input->post('tgl_mulai'));
        $endDate = strtotime($this->input->post('tgl_akhir'));

        if ($endDate >= $startDate)
            return True;
        else {
            $this->form_validation->set_message('compareDate', 'Tanggal Berakhir tidak boleh lebih awal dari Tanggal Mulai.');
            return False;
        }
    }
}