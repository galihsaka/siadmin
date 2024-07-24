<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ticket extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->session_user = $this->session->user_sess;
    if (!($this->session_user)) {
            redirect(base_url('login'), 'auto');
        } else{
    $this->load->model('model_ticket');
  }
  }

public function openTicketadm(){
      function generateRandomString($n) { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
}
function generateRandomString2($n) { 
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
} 
    if(isset($_POST['tambah'])){
      $ths=$this->session_user;
      $username = $ths['username'];
      $id_kategori_ticket = htmlspecialchars($this->input->post('kategori'));
      $sub_kategori_ticket = htmlspecialchars($this->input->post('sub_kategori'));
      $urgensi = htmlspecialchars($this->input->post('urgensi'));
      $judul_ticket = htmlspecialchars($this->input->post('judul_ticket'));
      $detail_kendala = htmlspecialchars($this->input->post('detail_kendala'));
      $tujuan_ticket = htmlspecialchars($this->input->post('tujuan_ticket'));
      $id_sistem = htmlspecialchars($this->input->post('id_sistem'));

        $config['upload_path'] = '../dashboard/file/ticket/lampiran';
        $config['file_name'] = generateRandomString(32);
        $config['allowed_types'] = '*';
        $config['max_size'] = 2000;
        $config['overwrite'] = false;
        $config['file_ext_tolower'] = true;
        $this->load->library('upload');
        $this->upload->initialize($config);

        if($this->upload->do_upload('lampiran')){
          $upload_data = $this->upload->data();
          $fileName = $upload_data['file_name'];
          $lampiran = $fileName;

          $data_ticket = array(
            'id' => generateRandomString2(10),
            'id_sistem' => $id_sistem,
            'id_kategori_ticket' => $id_kategori_ticket,
            'sub_kategori_ticket' => $sub_kategori_ticket,
            'judul_ticket' => $judul_ticket,
            'username' => $username,
            'urgensi' => $urgensi,
            'detail_kendala' => $detail_kendala,
            'lampiran' => $lampiran,
            'tujuan_ticket' => $tujuan_ticket
          );

          $this->model_ticket->insert($data_ticket);
          $this->session->set_flashdata(array('info' => 'Berhasil membuat ticket support', 'color_info' => 'success'));
        }else{
          $this->session->set_flashdata(array('info' => 'Gagal membuat ticket support', 'color_info' => 'danger'));
        }
    }
    $data_kategori = $this->model_ticket->getKategori();
    $myAdmin         = $this->session_user;
        $myAdmin['label']   = "Open Ticket";
        $myAdmin['data_kategori'] = $data_kategori;
        $myAdmin['title']   = "Buat Ticket Support";
        $myAdmin['plugins'] = array(
            'datepicker'
        );
        $this->load->view('staff_admin/templates/header', $myAdmin);
        $this->load->view('staff_admin/pages/openTicket');
        $this->load->view('staff_admin/templates/footer');
  }
  
  public function openTicket(){
      function generateRandomString($n) { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
}
function generateRandomString2($n) { 
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
} 
    if(isset($_POST['tambah'])){
      $ths=$this->session_user;
      $username = $ths['username'];
      $id_kategori_ticket = htmlspecialchars($this->input->post('kategori'));
      $sub_kategori_ticket = htmlspecialchars($this->input->post('sub_kategori'));
      $urgensi = htmlspecialchars($this->input->post('urgensi'));
      $judul_ticket = htmlspecialchars($this->input->post('judul_ticket'));
      $detail_kendala = htmlspecialchars($this->input->post('detail_kendala'));
      $tujuan_ticket = htmlspecialchars($this->input->post('tujuan_ticket'));

        $config['upload_path'] = '../dashboard/file/ticket/lampiran';
        $config['file_name'] = generateRandomString(32);
        $config['allowed_types'] = '*';
        $config['max_size'] = 2000;
        $config['overwrite'] = false;
        $config['file_ext_tolower'] = true;
        $this->load->library('upload');
        $this->upload->initialize($config);

        if($this->upload->do_upload('lampiran')){
          $upload_data = $this->upload->data();
          $fileName = $upload_data['file_name'];
          $lampiran = $fileName;

          $data_ticket = array(
            'id' => generateRandomString2(10),
            'id_sistem' => 4,
            'id_kategori_ticket' => $id_kategori_ticket,
            'sub_kategori_ticket' => $sub_kategori_ticket,
            'judul_ticket' => $judul_ticket,
            'username' => $username,
            'urgensi' => $urgensi,
            'detail_kendala' => $detail_kendala,
            'lampiran' => $lampiran,
            'tujuan_ticket' => $tujuan_ticket
          );

          $this->model_ticket->insert($data_ticket);
          $this->session->set_flashdata(array('info' => 'Berhasil membuat ticket support', 'color_info' => 'success'));
        }else{
          $this->session->set_flashdata(array('info' => 'Gagal membuat ticket support', 'color_info' => 'danger'));
        }
    }
    $data_kategori = $this->model_ticket->getKategori();
    $myAdmin         = $this->session_user;
        $myAdmin['label']   = "Open Ticket";
        $myAdmin['data_kategori'] = $data_kategori;
        $myAdmin['title']   = "Buat Ticket Support";
        $myAdmin['plugins'] = array(
            'datepicker'
        );
        $this->load->view('mahasiswa/templates/header', $myAdmin);
        $this->load->view('mahasiswa/pages/openTicket');
        $this->load->view('mahasiswa/templates/footer');
  }


public function statusAdm(){
    $data_ticket = $this->model_ticket->getTicketsadm();
    $myAdmin         = $this->session_user;
    $myAdmin['label']   = "Status Ticket";
        $myAdmin['data_ticket'] = $data_ticket;
        $myAdmin['title']   = "Status Ticket";
        $myAdmin['plugins'] = array(
            'datepicker'
        );
        $this->load->view('staff_admin/templates/header', $myAdmin);
        $this->load->view('staff_admin/pages/statusTicket');
        $this->load->view('staff_admin/templates/footer');
  }


  public function status(){
    $data_ticket = $this->model_ticket->getTickets();
    $myAdmin         = $this->session_user;
    $myAdmin['label']   = "Status Ticket";
    $myAdmin['data_ticket'] = $data_ticket;
    $myAdmin['title']   = "Status Ticket";
        $myAdmin['plugins'] = array(
            'datepicker'
        );
        $this->load->view('mahasiswa/templates/header', $myAdmin);
        $this->load->view('mahasiswa/pages/statusTicket');
        $this->load->view('mahasiswa/templates/footer');
  }

  public function view(){
    function generateRandomString($n) { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
}
function generateRandomString2($n) { 
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
}
    if(isset($_POST['kirim'])){
      $komentar = htmlspecialchars($this->input->post('komentar'));
      $id_ticket = htmlspecialchars($this->input->post('id_ticket'));
      $username = htmlspecialchars($this->input->post('username'));
      $lampiran = null;
        $config['upload_path'] = '../dashboard/file/ticket/lampiran';
        $config['file_name'] = generateRandomString(32);
        $config['allowed_types'] = '*';
        $config['max_size'] = 2000;
        $config['overwrite'] = false;
        $config['file_ext_tolower'] = true;
        $this->load->library('upload');
        $this->upload->initialize($config);
        if(isset($_FILES['lampiran']['name'])&&!empty($_FILES['lampiran']['name'])){
        if($this->upload->do_upload('lampiran')){
          $upload_data = $this->upload->data();
          $fileName = $upload_data['file_name'];
          $lampiran = $fileName;
        }else{
          $this->session->set_flashdata(array('info' => 'Gagal upload lampiran', 'color_info' => 'danger'));
          redirect('ticket/view?id='.$id_ticket);
        }
      }

      $data_ticket = array(
        'id' => generateRandomString(15),
        'id_ticket' => $id_ticket,
        'username' => $username,
        'komentar' => $komentar,
        'lampiran' => $lampiran
      );
      if (strtolower($this->session_user['hakAkses']) == 'mahasiswa'){
      $data_update = array(
        'status' => "2"
      );}
      elseif (strtolower($this->session_user['hakAkses']) == 'staff administrasi'){
      $data_update = array(
        'status' => "3"
      );}
      $kirim = $this->model_ticket->insertBalasan($data_ticket);
      $update = $this->model_ticket->updateTicket($id_ticket, $data_update);
      if(!($kirim&&$update)){
        $this->session->set_flashdata(array('info' => 'Gagal membalas pesan', 'color_info' => 'danger'));
      }
    }

    if(isset($_GET['id'])){
      $id_ticket = htmlspecialchars($this->input->get('id'));

      $ticket = $this->model_ticket->getTicket($id_ticket);

      if($ticket){
        $detail_ticket = $this->model_ticket->getDetailTicket($id_ticket);
        $user_ticket = $this->model_ticket->getUserTicket($id_ticket);
        $myAdmin         = $this->session_user;
        $myAdmin['label']   = "View Ticket";
        $myAdmin['data_ticket'] = $ticket;
        $myAdmin['user_ticket'] = $user_ticket;
        $myAdmin['detail_ticket'] = $detail_ticket;
        $myAdmin['title']   = $id_ticket;
        $myAdmin['plugins'] = array(
            'datepicker'
        );
        if (strtolower($this->session_user['hakAkses']) == 'mahasiswa'){
        $this->load->view('mahasiswa/templates/header', $myAdmin);
        $this->load->view('mahasiswa/pages/viewTicket');
        $this->load->view('mahasiswa/templates/footer');
        }
        elseif (strtolower($this->session_user['hakAkses']) == 'staff administrasi'){
        $this->load->view('staff_admin/templates/header', $myAdmin);
        $this->load->view('staff_admin/pages/viewTicket');
        $this->load->view('staff_admin/templates/footer');
        }
      }else{
        redirect('ticket/status');
      }
    }else{
      redirect('ticket/status');
    }
  }

  public function getSubKategori(){ 
    $postData = $this->input->post();
    
    // get data 
    $data = $this->model_ticket->getSubKategori($postData);
    echo json_encode($data); 
  }

  public function getKategori(){ 
    $postData = $this->input->post();
    
    // get data 
    $data = $this->model_ticket->getKategoriFromId($postData);
    echo json_encode($data); 
  }

  public function pindahticketTeknis(){
    function generateRandomString($n) { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
}
    $ths=$this->session_user;
    $username = $ths['username'];
    $id_ticket = htmlspecialchars($this->input->get('id'));
    $data_ticket = array(
        'id' => generateRandomString(15),
        'id_ticket' => $id_ticket,
        'username' => $username,
        'komentar' => "Ticket Support Kami Pindahkan ke Pihak Tim Teknis",
        'lampiran' => null
      );
    $data_update = array(
        'tujuan_ticket' => "1"
      );
    $ticket = $this->model_ticket->updateTicket($id_ticket, $data_update);
    $kirim = $this->model_ticket->insertBalasan($data_ticket);
    if(!($ticket&&$kirim)){
    $this->session->set_flashdata(array('info' => 'Gagal memindah ticket', 'color_info' => 'danger'));
  }
    redirect('ticket/view?id='.$id_ticket);
}

public function pindahticketKalab(){
    function generateRandomString($n) { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
}
    $ths=$this->session_user;
    $username = $ths['username'];
    $id_ticket = htmlspecialchars($this->input->get('id'));
    $data_ticket = array(
        'id' => generateRandomString(15),
        'id_ticket' => $id_ticket,
        'username' => $username,
        'komentar' => "Ticket Support Kami Pindahkan ke Pihak Kalab",
        'lampiran' => null
      );
    $data_update = array(
        'tujuan_ticket' => "3"
      );
    $ticket = $this->model_ticket->updateTicket($id_ticket, $data_update);
    $kirim = $this->model_ticket->insertBalasan($data_ticket);
    if(!($ticket&&$kirim)){
    $this->session->set_flashdata(array('info' => 'Gagal memindah ticket', 'color_info' => 'danger'));
  }
    redirect('ticket/view?id='.$id_ticket);
}

public function ticketSolved(){
    $ths=$this->session_user;
    $username = $ths['username'];
    $date = date('Y-m-d H:i:s');
    $id_ticket = htmlspecialchars($this->input->get('id'));
    $data_update = array(
        'status' => "4",
        'solver' => $username,
        'waktu_solve' => $date
      );
    $ticket = $this->model_ticket->updateTicket($id_ticket, $data_update);
     if(!$ticket){
    $this->session->set_flashdata(array('info' => 'Gagal mengubah status', 'color_info' => 'danger'));
  }
    redirect('ticket/view?id='.$id_ticket);
}

public function ticketClosed(){
  $ths=$this->session_user;
    $username = $ths['username'];
    $date = date('Y-m-d H:i:s');
    $id_ticket = htmlspecialchars($this->input->get('id'));
    $data_update = array(
        'status' => "5",
        'solver' => $username,
        'waktu_solve' => $date
      );
    $ticket = $this->model_ticket->updateTicket($id_ticket, $data_update);
    if(!$ticket){
    $this->session->set_flashdata(array('info' => 'Gagal mengubah status', 'color_info' => 'danger'));
  }
    redirect('ticket/view?id='.$id_ticket);
}
}

