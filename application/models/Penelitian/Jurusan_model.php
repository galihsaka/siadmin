<?php
/**
 * Created by PhpStorm.
 * User: Syarif
 * Date: 7/29/2019
 * Time: 1:57 PM
 */

class Jurusan_model extends CI_Model
{


    public function history_jurusan($noInduk)
    {
        $query = $this->db->query("SELECT * FROM `penelitian` WHERE kategori='Jurusan' AND nim='$noInduk' ORDER BY `ID`  DESC ")->result();
        return $query;
    }

    public function save($data){
        if ($this->db->query("INSERT INTO `penelitian` (`nim`, `nama`, `prodi`, `judul`, `kategori`, `nama_instansi`, `penerima_surat`, `alamat_instansi`, `tgl_buat`, `tgl_mulai`, `tgl_berakhir`) VALUES ('$data[nim]', '$data[nama]', '$data[prodi]', '$data[judul]', '$data[kategori]', '$data[nama_instansi]', '$data[penerima_surat]', '$data[alamat_instansi]', '$data[tgl_buat]', '$data[tgl_mulai]', '$data[tgl_berakhir]')")){
            $log = array('crud_detail' => 'Create');
            $this->db->insert('log_penelitian', $log);
            return true;
        }
    }
}