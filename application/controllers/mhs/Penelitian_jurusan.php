 <?php
/**
 * Created by PhpStorm.
 * User: Syarif
 * Date: 7/25/2019
 * Time: 1:51 PM
 */

class Penelitian_jurusan extends CI_Controller
{
    private $session_user;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->session_user = $this->session->user_sess;
        if (!($this->session_user)) {
            redirect(base_url('login'), 'auto');
        } elseif (strtolower($this->session_user['hakAkses']) == 'mahasiswa') {
            //load library and models
            $this->load->model('verify_model');
            $this->load->library('form_validation');
            $this->load->model('Penelitian/jurusan_model');
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
        $myAdmin['data']    = $this->jurusan_model->history_jurusan($myAdmin['noInduk']);
        $myAdmin['plugins'] = array(
            'datatables'
        );
        $this->load->view('mahasiswa/templates/header', $myAdmin);
        $this->load->view('mahasiswa/pages/jurusan');
        $this->load->view('mahasiswa/templates/footer');
    }
    
    //Form view
    public function daftar()
    {
        $myAdmin            = $this->Penelitian_model->getData($this->session_user);
        $myAdmin['label']   = "Daftar Penelitian";
        $myAdmin['title']   = "Penelitian ke Jurusan";
        $myAdmin['plugins'] = array(
            'datepicker'
        );
        $this->load->view('mahasiswa/templates/header', $myAdmin);
        $this->load->view('mahasiswa/pages/daftarjurusan');
        $this->load->view('mahasiswa/templates/footer');
    }
    
    //Submit Form
    public function submit()
    {
        $this->form_validation->set_message('required', '%s wajib diisi');
        $this->form_validation->set_rules("tgl_mulai", "Tanggal mulai", "required");
        $this->form_validation->set_rules("tgl_akhir", "Tanggal akhir", "required");
        $this->form_validation->set_rules("tgl_buat", "Tanggal Pengajuan Penelitian", "required");
        
        if ($this->form_validation->run()) {
            $data  = array(
                'nim' => $this->session_user['username'],
                'nama' => $this->session_user['nama'],
                'prodi' => $this->input->post('prodi'),
                'judul' => $this->input->post('judul'),
                //Kategori: Jurusan
                'kategori' => "Jurusan",
                'nama_instansi' => "Jurusan Teknik Elektro Universitas Negeri Malang",
                'penerima_surat' => "Ketua Jurusan Teknik Elektro Universitas Negeri Malang",
                'alamat_instansi' => "Jl. Semarang 5 Malang",
                'tgl_buat' => $this->input->post('tgl_buat'),
                'tgl_mulai' => $this->input->post('tgl_mulai'),
                'tgl_berakhir' => $this->input->post('tgl_akhir')
            );
            $sta = $this->input->post('stat');
            $query = $this->jurusan_model->save($data);
            if ($query) {
                $data_encrypt = $this->my_encrypt->custom_encode(json_encode($data));
                redirect(base_url('mhs/penelitian_jurusan/success/' . $data_encrypt.'/'.$sta));
            }
            
        } else {
            $this->daftar();
            
        }
    }
    
    public function success($cipher, $s)
    {
        if (isset($cipher)) {
            $myAdmin          = $this->session_user;
            $myAdmin['label'] = "Daftar Penelitian";
            $myAdmin['title'] = 'Pendaftaran Penelitian Jurusan';
            $url              = "mhs/penelitian_jurusan/";
            $myAdmin['url']   = $url;
            $myAdmin['stat'] = $s;
            $myAdmin['url2']  = "mhs/penelitian_jurusan/printdoc/" . $cipher."/".$s;
            $this->load->view('mahasiswa/templates/header', $myAdmin);
            $this->load->view('mahasiswa/pages/success/berhasil');
            $this->load->view('mahasiswa/templates/footer', $myAdmin);
        }
    }
    
    //Print Doc
    public function printdoc($cipher,$s)
    {
        $json_data = $this->my_encrypt->custom_decrypt($cipher);
        if ($json_data) {
            $json_data         = json_decode($json_data);
            $data['tgl_akhir'] = $json_data->tgl_berakhir;
            $data['tgl_mulai'] = $json_data->tgl_mulai;
            $data['tgl_buat']  = $json_data->tgl_buat;
            $data['nama_mhs']  = $json_data->nama;
            $data['nim']       = $json_data->nim;
            $data['prodi']     = $json_data->prodi;
            $data['judul']     = $json_data->judul;
            $data['stat']     = $s;
            list($data['jenjang'], $data['prodi_']) = explode(" ", $data['prodi'], 2);
            
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
            elseif ($s=='Berhasil') {
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
            $this->pdf->load_view('mahasiswa/document/my_penelitian_jurusan', $data);
        }
    }
    
} 