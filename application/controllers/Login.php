<?php
/**
 * Created by PhpStorm.
 * User: Syarif
 * Date: 08-Jul-19
 * Time: 9:53 AM
 */

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('verify_model');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $this->load->view('pages/login');

    }

    public function verify_user()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) // apabila user salah tidak memenuhi form validation
        {
            $this->session->set_flashdata('fail', 'Your username or password are incorrect!');
            redirect(base_url('login'));
        } 
        else // apabila sukses validasi
        {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password', TRUE);
            $datauser = $this->verify_model->verify($username, $password);
            if ($datauser == 'noData') {
                $this->session->set_flashdata('fail', 'Your username or password are incorrect!');
                redirect(base_url('login'));
            } else {
                if ($datauser['aktif'] == 0) {
                    $this->session->set_flashdata('fail', 'Your account is not active!');
                    redirect(base_url('login'));
                } 
                else {
					if($datauser['hakAkses']=="Mahasiswa"){
						if($datauser['jenjang_']=='D3' || $datauser['jenjang_']=='S1'){
							$session = array('user_sess' => $datauser);
                            $this->session->set_userdata($session);
                            $this->add_log($username);
							redirect(base_url());
						}
						else{
							$this->session->set_flashdata('fail', 'Anda tidak memiliki akses');
							redirect(base_url('login'));
						}
                    } 
                    elseif($datauser['hakAkses']=="Staff Administrasi"){
						    $session = array('user_sess' => $datauser);
                            $this->session->set_userdata($session);
                            $this->add_log($username);
							redirect(base_url());
					}
					else{
						$this->session->set_flashdata('fail', 'Anda tidak memiliki akses');
						redirect(base_url('login'));
					}
                    
                }
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }

    private function add_log($username) 
    {
        // Inisialisasi data
        
        $ip = $this->input->ip_address(); // Mengambil ip address user
        $tgl = date('YmdHmmiis'); // Generate tanggal
        $random = (rand()%2); // Generate random string
        $id = "LL".$tgl."".$random; // Generate id log yang terdiri dari LL+tanggal+random string untuk dimasukkan ke dalam tabel log

        $this->db->order_by('waktu', 'DESC');
        $this->db->limit(1);
        $log_terakhir = $this->db->get_where('log_login', array('username' => $username))->row(); // Select log terakhir dari user dengan username tersebut di atas

        $status_log = "0"; // Default status log 0 = login

        if($log_terakhir){ // Memeriksa apakah username tersebut sudah pernah login atau belum, jika sudah maka:
            if($log_terakhir->status!="1"){ // Jika sudah pernah login dan status terakhirnya 1, maka:
            $status_log = "2"; // Nilai status log diubah menjadi 2 = session habis
            }
        }

        // Inisialisasi data log yang akan diinsert ke tabel log_login
        $data_log = array(
            'id' => $id,
            'username' => $username,
            'ip_pengakses' => $ip,
            'status' => $status_log
        );

        // Proses insert ke dalam tabel log_login
        $this->db->set('waktu', 'NOW()', FALSE); 
        $this->db->insert('log_login', $data_log);

        // Untuk proses logout atau login gagal caranya sama, hanya menyesuaikan controllernya saja dan statusnya diubah seperti berikut:
        // Detail status log:
        // "0" => Login berhasil
        // "1" => Logout
        // "2" => Session habis
        // "3" => Login gagal (Username / Password salah)



    }
}