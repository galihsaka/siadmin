<?php
/**
 * Created by PhpStorm.
 * User: Syarif
 * Date: 8/9/2019
 * Time: 2:03 PM
 */

class Terima_skripsi extends CI_Controller
{
    private $session_user;


    public function __construct()
    {
        parent::__construct();
        $this->session_user = $this->session->user_sess;
        if (!($this->session_user)) {
            redirect(base_url('login'), 'auto');
        } elseif (strtolower($this->session_user['hakAkses']) == 'mahasiswa') {
            $this->load->model('Terima_model');
            //$this->load->library('encryption');
            //$this->load->library('my_encrypt');
        } else {
            redirect(base_url('error/403'));
        }
    }

    public function index()
    {
        $myAdmin = $this->session_user;
        $myAdmin['data'] = $this->Terima_model->dataterimaskripsi($myAdmin['noInduk']);
        $myAdmin['title'] = "Terima Skripsi/TA";
        $myAdmin['label'] = "Terima Skripsi/TA";
        $this->load->view("mahasiswa/templates/header", $myAdmin);
        $this->load->view("mahasiswa/pages/serah_terima");
        $this->load->view("mahasiswa/templates/footer");
    }

    public function upload_files()
    {
        $user_id = $this->session_user['username'];
        $user_name = $this->session_user['nama'];
        $success = false;
        $filesCount = count($_FILES['fileuploads']['name']);
        $uploadPath = './upload_tmp/';
        $source = array();
        $uploadData = array();
        for ($i = 0; $i < $filesCount; $i++) {
            $_FILES['file']['name'] = $_FILES['fileuploads']['name'][$i];
            $_FILES['file']['type'] = $_FILES['fileuploads']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['fileuploads']['tmp_name'][$i];
            $_FILES['file']['error'] = $_FILES['fileuploads']['error'][$i];
            $_FILES['file']['size'] = $_FILES['fileuploads']['size'][$i];

            // File upload configuration

            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|txt|docx';
            $config['overwrite'] = true;
            $config['file_name'] = $user_id."_".$_FILES['file']['name'];
            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            // Upload file to server
            if ($this->upload->do_upload('file')) {
                // Uploaded file data
                $fileData = $this->upload->data();
                array_push($uploadData, array("file_name" => $fileData['file_name']));
                array_push($source, $uploadPath.$uploadData[$i]['file_name']);
                $success = true;
            } else {
                $success = false;
                $this->session->set_flashdata('fail', 'File yang diupload gagal');
                break;
            }
        }

        //FTP
        if($success == true){
            $ftp_success = false;
            //ftp user folder akun sisinta
            // $userFolder = "/uploads/".$user_id."_".$user_name."/";
            //ftp user folder akun siadmin
            $userFolder = "/uploads/sisinta/".$user_id."_".$user_name."/";
            //Load codeigniter FTP class
            $this->load->library('ftp');
            echo $userFolder;
            //FTP configuration
            // $ftp_config['hostname'] = '127.0.0.1';
            // $ftp_config['username'] = 'test';
            // $ftp_config['password'] = '12345678';
            // $ftp_config['debug']    = FALSE;

            //FTP configuration server sisinta
            // $ftp_config['hostname'] = '10.9.8.4';
            // $ftp_config['username'] = 'sisinta';
            // $ftp_config['password'] = 'sisinta2019';
            // $ftp_config['debug']    = TRUE;

            //FTP configuration server siadmin
            $ftp_config['hostname'] = '10.9.8.4';
            $ftp_config['username'] = 'siadmin';
            $ftp_config['password'] = 'siadmin2019';
            $ftp_config['debug']    = TRUE;

            //Connect to the remote server
            $this->ftp->connect($ftp_config);

            //create dir
            if(!($this->ftp->list_files($userFolder))){
                if(!($this->ftp->mkdir($userFolder))){
                    $ftp_success = false;
                } else {
                    $ftp_success = true;
                }
            }
            for ($i = 0; $i < count($source); $i++){
                $destination = $userFolder.$uploadData[$i]['file_name'];
                if(! $this->ftp->upload($source[$i], $destination)){
                    $this->session->set_flashdata('fail', 'File yang diupload gagal');
                    $ftp_success = false;
                    break;
                } else{
                    $ftp_success = true;
                    $this->session->set_flashdata('success', 'File yang diupload berhasil');
                }
            }
            $this->ftp->close();
            //server url
            if($ftp_success){
                $id_data = $this->input->post('id');
                $this->Terima_model->updateupload($id_data, "http://10.9.8.4/siadmin/uploads/sisinta/".$user_id."_".$user_name."/");  
            }
        }
        for ($i = 0; $i < $filesCount; $i++){
            @unlink($source[$i]);
        }
        // redirect(base_url('mhs/upload-berkas'));
    }

}