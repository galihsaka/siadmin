<?php
/**
 * Created by PhpStorm.
 * User: Syarif
 * Date: 02-Jul-19
 * Time: 7:42 AM
 */

class Surat_model extends CI_Model {



    // Function untuk menampilkan data surat masuk berdasarkan tahun, default = tahun terima surat terakhir

    public function getByYear($year){
        $this->db->select('*');
        $this->db->from('surat_masuk');
        $this->db->where('YEAR(tgl_terima)', $year);
        $this->db->order_by('ID');

        return $this->db->get()->result();
    }

    // Untuk insert data ke db_siadmin tabel surat_masuk
    public function model_tambah($data)
    {
        $log = array('crud_detail' => 'Create');
        // Ubah format tanggal dari mm/dd/YYY menjadi YYYY-mm-dd
        $tgl_terima = date("Y-m-d",strtotime($data['tgl_terima']));
        $tgl_pembuatan = date("Y-m-d",strtotime($data['tgl_pembuatan']));
        $year_terima = date('Y', strtotime($data['tgl_terima']));

        //cek baris
        $count = $this->countResult($year_terima);
        $count = $count + 1;

        $dataInsert = array(
            'no_agenda' => $count,
            'no_surat' => $data['no_surat'],
            'asal' => $data['asal'],
            'perihal' => $data['perihal'],
            'kategori' => $data['kategori'],
            'tgl_pembuatan' => $tgl_pembuatan,
            'tgl_terima' => $tgl_terima
        );

        $this->db->insert('surat_masuk', $dataInsert);
        $this->db->insert('log_surat_masuk', $log);

        // return $tgl_terima; agar menampilkan data berdasarkan tahun tgl_terima yang diinputkan
        return $tgl_terima;

    }

    // Untuk insert data ke db_siadmin tabel surat_masuk
    public function model_tambah_kosong()
    {
        $log = array('crud_detail' => 'Create');
        // Ubah format tanggal dari mm/dd/YYY menjadi YYYY-mm-dd
        $tgl_terima = date("Y-m-d");
        $tgl_pembuatan = date("Y-m-d");
        $year_terima = date('Y', strtotime($tgl_terima));

        //cek baris
        $count = $this->countResult($year_terima);
        $count = $count + 1;

        $dataInsert = array(
            'no_agenda' => $count,
            'no_surat' => '',
            'asal' => '',
            'perihal' => '',
            'kategori' => 'Kosong',
            'tgl_pembuatan' => $tgl_pembuatan,
            'tgl_terima' => $tgl_terima
        );

        $this->db->insert('surat_masuk', $dataInsert);
        $this->db->insert('log_surat_masuk', $log);

        // return $tgl_terima; agar menampilkan data berdasarkan tahun tgl_terima yang diinputkan
        return $tgl_terima;

    }

    private function countResult($year){
        $this->db->where('YEAR(tgl_terima)', $year);
        $this->db->from('surat_masuk');
        return $this->db->count_all_results();
    }

    // Function untuk mengedit data pada tabel surat_masuk
    public function model_edit($id)
    {
        $log = array('crud_detail' => 'Update');
        // Simpan perubahan sementara di array
        $data = array(
            'tgl_terima' => $this->input->post('tgl_terima'),
            'tgl_pembuatan' => $this->input->post('tgl_pembuatan'),
            'no_surat' => $this->input->post('no_surat'),
            'perihal' => $this->input->post('perihal'),
            'asal' => $this->input->post('asal'),
            'kategori' => $this->input->post('kategori')
        );
        // Update data pada tabel surat_masuk
        $this->db->where('ID', $id);
        $this->db->update('surat_masuk', $data);
        $this->db->insert('log_surat_masuk', $log);
        return date("Y", strtotime($data['tgl_terima']));
    }

    public function printLog(){
        $log = array('crud_detail' => 'Print');
        $this->db->insert('log_surat_masuk', $log);
    }


}