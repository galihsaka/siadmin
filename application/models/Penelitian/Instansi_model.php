<?php
/**
 * Created by PhpStorm.
 * User: Syarif
 * Date: 7/29/2019
 * Time: 10:03 AM
 */

class Instansi_model extends CI_Model
{
    public function history_instansi($noInduk)
    {
        $this->db->select('*');
        $this->db->from('penelitian');
        $this->db->where('kategori', 'Instansi');
        $this->db->where('nim', $noInduk);
        $this->db->order_by('ID', 'DESC');
        $query = $this->db->get()->result();

        return $query;
    }

    public function save($data)
    {
        if ($this->db->insert('penelitian', $data)) {
            $log = array('crud_detail' => 'Create');
            $this->db->insert('log_penelitian', $log);
            return true;
        }
    }

    public function getId($data)
    {
        $this->db->select('ID');
        $this->db->from('penelitian');
        $this->db->where('nim', $data['nim']);
        $this->db->where('judul', $data['judul']);
        $this->db->where('kategori', $data['kategori']);
        $this->db->order_by('ID', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get()->row();
        if (isset($query)) {
            return $query->ID;
        } else {
            return 'noData';
        }
    }
}