<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ticket extends CI_Model{
  private $db_master;
  private $dbs;

    public function __construct()
    {
        parent::__construct();
        $this->db_master = $this->load->database('db_master', TRUE);
        $this->dbs = $this->load->database('db_master', TRUE);
    }

  function getTickets(){
    $ths=$this->session_user;
    $username = $ths['username'];
    $this->db_master->select('*, ticket.id AS id_ticket, ticket.status AS status_ticket');
    $this->db_master->join('kategori_ticket', 'kategori_ticket.id = ticket.id_kategori_ticket', 'left');
    $this->db_master->where(array('ticket.id_sistem' => "4", 'username' => $username));
    return $this->db_master->get('ticket')->result();
  }

  function getTicketsadm(){
    $ths=$this->session_user;
    $username = $ths['username'];
    $this->db_master->select('*, ticket.id AS id_ticket, ticket.status AS status_ticket');
    $this->db_master->join('kategori_ticket', 'kategori_ticket.id = ticket.id_kategori_ticket', 'left');
    $this->db_master->where(array('ticket.tujuan_ticket' => "2"));
    $this->db_master->order_by('ticket.status', 'ticket.tgl_input');
    return $this->db_master->get('ticket')->result();
  }

  function getTicket($id_ticket){
    $this->db_master->select('*, ticket.id AS id_ticket, ticket.status AS status_ticket');
    $this->db_master->join('kategori_ticket', 'kategori_ticket.id = ticket.id_kategori_ticket', 'left');
    $this->db_master->join('sub_kategori_ticket', 'sub_kategori_ticket.id = ticket.sub_kategori_ticket', 'left');
    $this->db_master->where(array('ticket.id' => $id_ticket));
    return $this->db_master->get('ticket')->row();
  }

  function getUserTicket($id_ticket){
    $this->db_master->select('*');
    $this->db_master->from('user');
    $this->db_master->join('ticket', 'user.username = ticket.username');
    $this->db_master->where(array('ticket.id' => $id_ticket));
    $data=$this->db_master->get()->row();
            $namaProdi = $this->getNamaProdi($data->kode_prodi);
            $jenjang = $this->getJenjang($data->jenjang);
            return array(
                'username' => $data->username,
                'nama_lengkap' => $data->nama_lengkap,
                'tahun_masuk' => $data->tahun_masuk,
                'jenjangProdi' => $jenjang . " " . $namaProdi,
                'no_hp' => $data->no_hp,
                'email' => $data->email,
                'offering' => $data->offering,
            );
  }

  function getDetailTicket($id_ticket){
    $this->db_master->select('*');
    $this->db_master->where(array('id_ticket' => $id_ticket));
    $this->db_master->join('user', 'user.username = detail_ticket.username', 'left');
    $this->db_master->order_by('tgl_input', 'desc');
    return $this->db_master->get('detail_ticket')->result();
  }

  function getKategori(){
    $response = array();
 
    $this->db_master->select('*');
    $this->db_master->where(array('id_sistem' => "4", 'status' => "1"));
    $q = $this->db_master->get('kategori_ticket');
    $response = $q->result();

    return $response;
  }

  function getSubKategori($postData){
    $response = array();
    $this->db_master->select('id, sub_kategori');
    $this->db_master->where('id_kategori', $postData['kategori']);
    $q = $this->db_master->get('sub_kategori_ticket');
    $response = $q->result();

    return $response;
  }

  function getKategoriFromId($postData){
    $response = array();
    $this->db_master->select('id, nama_kategori_ticket');
    $this->db_master->where('id_sistem', $postData['id_sistem']);
    $q = $this->db_master->get('kategori_ticket');
    $response = $q->result();

    return $response;
  }

  function insert($data){
    $this->db_master->insert('ticket', $data);
  }

  function insertBalasan($data){
    return $this->db_master->insert('detail_ticket', $data);
  }

  function updateTicket($id, $data){
    $this->db_master->where('id', $id);
    return $this->db_master->update('ticket', $data);
  }

  public function getNamaProdi($kodeProdi)
    {
        $this->dbs->select('*');
        $this->dbs->from('prodi');
        $this->dbs->where('kode_prodi', $kodeProdi);
        $data = $this->dbs->get()->row();
        if (isset($data)) {
            return $data->nama_prodi;
        }
    }

    public function getJenjang($kodeJenjang)
    {
        $this->dbs->select('*');
        $this->dbs->from('jenjang');
        $this->dbs->where('id_jenjang', $kodeJenjang);
        $data = $this->dbs->get()->row();
        if (isset($data)) {
            return $data->nama_jenjang;
        }
    }
}
