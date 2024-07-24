<?php
/**
 * Created by PhpStorm.
 * User: Syarif
 * Date: 7/25/2019
 * Time: 11:28 PM
 */

class Dinas_model extends CI_Model
{
    public function history_dinas($noInduk)
    {
        $this->db->select('*');
        $this->db->from('penelitian');
        $this->db->where('kategori', 'Dinas');
        $this->db->where('nim', $noInduk);
        $this->db->order_by('ID', 'DESC');
        $query = $this->db->get()->result();
        $data = array();
        foreach ($query as $key) {
            $instansi = $this->getInstansi($key->ID);
            array_push($data, array(
                'dinas' => $key,
                'instansi' => $instansi
            ));
        }
        return $data;
    }

    public function getInstansi($list_id)
    {
        $this->db->select('*');
        $this->db->from('tujuan_dinas');
        $this->db->where('id', $list_id);
        return $this->db->get()->result();
    }


    public function save($data, $instansi)
    {
        if ($this->db->insert('penelitian', $data)) {
            $id = $this->getId($data);
            $arrTujuan = array();
            for ($i = 0; $i < count($instansi['sekolah']); $i++) {
                array_push($arrTujuan, array(
                    'id' => $id,
                    'Nama_sekolah' => $instansi['sekolah'][$i],
                    'alamat' => $instansi['alamat'][$i]
                ));
            }
            foreach ($arrTujuan as $key) {
                if (!($this->db->insert('tujuan_dinas', $key))) {
                    return false;
                }
            }
            $log = array('crud_detail' => 'Create');
            $this->db->insert('log_penelitian', $log);
            return $id;
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