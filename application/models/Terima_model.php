<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Terima_model extends CI_Model
{

    public function dataterimaskripsi($nim = false)
    {
        if ($nim == false) {
            $query = $this->db->query('SELECT * FROM `terima_skripsi` WHERE kategori="Skripsi" OR kategori="TA" ORDER BY ID')->result();
            return $query;
        } else if ($nim != false) {
            $this->db->select('*');
            $this->db->from('terima_skripsi');
            $where = "nim=$nim AND kategori='Skripsi' OR kategori='TA'";
            $this->db->where($where);
            $this->db->order_by('ID');
            $this->db->limit(1);
            return $this->db->get()->row();
        }
    }

    public function dataterimaseminar()
    {
        $query = $this->db->query('SELECT * FROM `terima_skripsi` WHERE kategori="Semhas" OR kategori="Sempro" ORDER BY ID')->result();
        return $query;
    }

    public function updateupload($id, $upload_path){
        $this->db->set('upload_link', $upload_path);
        $this->db->where('ID', $id);
        $this->db->update('terima_skripsi');
    }

    public function updatebatal($id)
    {
        $this->db->query("UPDATE `terima_skripsi` SET `status` = 'Diproses' WHERE `terima_skripsi`.`ID` = $id;");
        $this->db->query("UPDATE `terima_skripsi` SET `konfirmasi_perpus` = 0 WHERE `terima_skripsi`.`ID` = $id;");
        $this->db->query("UPDATE `terima_skripsi` SET `tgl_validasi` = '0000-00-00' WHERE `terima_skripsi`.`ID` = $id;");
        $this->db->query("UPDATE `terima_skripsi` SET `nilaip1` = '0' WHERE `terima_skripsi`.`ID` = $id;");
        $this->db->query("UPDATE `terima_skripsi` SET `nilaip2` = '0' WHERE `terima_skripsi`.`ID` = $id;");
        $this->db->query("UPDATE `terima_skripsi` SET `nilaipenguji` = '0' WHERE `terima_skripsi`.`ID` = $id;");
    }

    public function updatevalid($id, $now)
    {
        $this->db->query("UPDATE `terima_skripsi` SET `status` = 'Diterima' WHERE `terima_skripsi`.`ID` = $id;");
        $this->db->query("UPDATE `terima_skripsi` SET `konfirmasi_perpus` = 1 WHERE `terima_skripsi`.`ID` = $id;");
        $this->db->query("UPDATE `terima_skripsi` SET `tgl_validasi` = '$now' WHERE `terima_skripsi`.`ID` = $id;");
    }

    public function nilai($nilaip1, $nilaip2, $nilap, $id)
    {
        $this->db->query("UPDATE `terima_skripsi` SET `nilaip1` = '$nilaip1' WHERE `terima_skripsi`.`ID` = $id;");
        $this->db->query("UPDATE `terima_skripsi` SET `nilaip2` = '$nilaip2' WHERE `terima_skripsi`.`ID` = $id;");
        $this->db->query("UPDATE `terima_skripsi` SET `nilaipenguji` = '$nilap' WHERE `terima_skripsi`.`ID` = $id;");
    }

    public function del($id)
    {
        $this->db->query("DELETE FROM `terima_skripsi` WHERE `terima_skripsi`.`ID` = $id;");
    }
}

/* End of file Terima_model.php */
