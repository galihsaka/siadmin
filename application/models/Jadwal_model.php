<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_model extends CI_Model {

    private $db_sisinta;
    private $db_master;
    public function __construct()
    {
        parent::__construct();
        $this->db_master = $this->load->database('db_master', TRUE);
        $this->db_sisinta = $this->load->database('db_sisinta', TRUE);
    }

    public function lihatjadwal(){
        $query = $this->db->get('penjadwalan'); 
		return $query->result();
    }

    public function getHari($date){
        $query = $this->db->query("SELECT DAYNAME('$date') AS tgl"); 
		return $query->result();
    }

    public function insertSertem($dta){
            $prod =  $dta->nama_jenjang . ' ' . $dta->nama_prodi . ' ' . $dta->offering;
            if($dta->kategori=="Sidang Skripsi"){
                $kateg="Skripsi";
            }
            elseif ($dta->kategori=="Sidang TA") {
                $kateg="TA";
            }
            else{
                $kateg=$dta->kategori;
            }
        $this->db->query("INSERT INTO terima_skripsi (nim, nama, prodi, tgl_ujian, kategori, judul) VALUES ('$dta->nim', '$dta->nama_lengkap', '$prod', '$dta->tanggal', '$kateg', '$dta->judul')");
    }

    public function deleteSertem($nim, $dttgl){
        $this->db->query("DELETE FROM terima_skripsi where nim='$nim' AND tgl_ujian='$dttgl'");
    }

	public function update($id,$val){
		$data = array(
            'kontak' => $this->input->post('kontak'),
            'tanggal' => $this->input->post('tanggal'),
            'jam' => $this->input->post('jam'),
            'ruang' => $this->input->post('gedung').'.'.$this->input->post('ruang'),
			'status_jadwal'=>$val
        );
		$this->db->where('id', $id);
        $this->db->update('penjadwalan', $data);
	}
	public function hapus($id){
		$this->db->where('id', $id);
		$this->db->delete('penjadwalan');
	}

	public function getNip($nama){
        $query = $this->db_master->query("SELECT nomor_induk FROM user WHERE nama_lengkap = '$nama'");
        return $query->result();
    }
}

/* End of file Terima_model.php */

