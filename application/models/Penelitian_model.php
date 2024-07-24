<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Penelitian_model extends CI_Model
{
    private $db_sisinta;
    private $db_master;

    public function __construct()
    {
        parent::__construct();

        $this->db_sisinta = $this->load->database('db_sisinta', TRUE);
        $this->db_master = $this->load->database('db_master', TRUE);
    }


    //DON'T DELETE
    public function cekSkripsi($user)
    {
        $query = $this->db_sisinta->query("SELECT COUNT(*) as statusjudul FROM `data_judul` WHERE nim=$user[username] AND (status_judul='DITERIMA' OR status_judul='REVISI')");
        foreach ($query->result() as $row) {
            return $row->statusjudul;
        }
    }

    //DON'T DELETE
    public function datapenelitian()
    {
        $query = $this->db->query('SELECT * FROM `penelitian` ORDER BY ID ')->result();
        return $query;
    }

    //DON'T DELETE
    public function delete($id, $kategori)
    {
        $this->db->where('ID', $id);
        $this->db->delete('penelitian');
        if ($kategori == "Dinas"){
            $this->db->where('id', $id);
            $this->db->delete('tujuan_dinas');
        }
    }

    public function addjurusan()
    {
        $session = $this->session->user_sess;
        $user = $session['username'];
        $nama = $session['nama'];
        $idjenjang = $session['kodeJenjang'];
        $idprodi = $session['kodeProdi'];
        $this->db->db_select('db_master');
        $query = $this->db->query("select * from prodi where kode_prodi=$idprodi");
        foreach ($query->result() as $row) {
            $prodi = $row->nama_prodi;
        }
        $query = $this->db->query("select * from jenjang where id_jenjang=$idjenjang");
        foreach ($query->result() as $row) {
            $jenjang = $row->nama_jenjang;
        }
        $query = $this->db->query("select * from user where level in(select id_level from level where nama_level like 'Koorprodi')");
        foreach ($query->result() as $row) {
            $nipkaprodi = $row->nomor_induk;
            $kaprodi = $row->nama_lengkap;
        }
        $this->db->db_select('db_sisinta');
        $query1 = $this->db->query("SELECT COUNT(*) AS jml FROM data_judul WHERE nim=$user");
        foreach ($query1->result() as $row) {
            if ($row->jml == 1) {
                $query2 = $this->db->query("select * from data_judul where nim=$user");
                foreach ($query2->result() as $row) {
                    $judul = $row->judul;

                }
            }
        }
        if ($jenjang == "S1") {
            $jenis = "data_judul";
        } elseif ($jenjang == "D3") {
            $jenis = "Tugas Akhir";
        }
        $programstudi = "$jenjang" . " $prodi";
        $tgl_mulai = $this->input->post('tgl_mulai');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $this->db->db_select('db_siadmin');
        $this->db->query("INSERT INTO `penelitian` (`nim`, `nama`, `prodi`, `judul`, `kategori`, `penerima_surat`, `nama_instansi`, `alamat_instansi`, `tgl_mulai`, `tgl_berakhir`) VALUES ( '$user', '$nama', '$programstudi', '$judul', 'Jurusan', 'Ketua Jurusan Teknik Elektro Universitas Negeri Malang', 'Jurusan Teknik Elektro Universitas Negeri Malang', 'Jl. Semarang 5 Malang', '$tgl_mulai', '$tgl_akhir'); ");

        $query = $this->db->query("SELECT * FROM `penelitian` WHERE nim='$user' AND kategori='Jurusan' ORDER BY ID DESC LIMIT 1 ");
        foreach ($query->result() as $row) {
            $id = $row->ID;
        }
        return $id;
    }

    public function printjurusan($id)
    {
        $this->db->select('db_siadmin');
        $query = $this->db->query("SELECT * FROM penelitian WHERE ID='$id' ");
        foreach ($query->result() as $row) {
            $data['nim'] = $row->nim;
            $data['tgl_akhir'] = $row->tgl_berakhir;
            $data['tgl_mulai'] = $row->tgl_mulai;
            $data['nama'] = $row->nama;
            $data['prodi'] = $row->prodi;
            $data['judul'] = $row->judul;
        }

        // AMBIL JENJANG
        $session = $this->session->user_sess;
        $idjenjang = $session['kodeJenjang'];
        $this->db->db_select('db_master');
        $query = $this->db->query("select * from jenjang where id_jenjang=$idjenjang");
        foreach ($query->result() as $row) {
            $jenjang = $row->nama_jenjang;
        }
        if ($jenjang == "S1") {
            $jenis = "Skripsi";
        } elseif ($jenjang == "D3") {
            $jenis = "Tugas Akhir";
        }
        $data['jenjang'] = $jenis;

        $this->db->db_select('db_sisinta');
        $query = $this->db->query("select * from kategori_judul where kategori_judul like '$jenis'");
        foreach ($query->result() as $row) {
            $level = $row->id_kategori_judul;
        }
        $query2 = $this->db->query("SELECT nama_dosen,nip FROM dosen_pembimbing WHERE nidn IN (SELECT data_judul.pembimbing_1 FROM data_judul WHERE nim='$data[nim]')");
        foreach ($query2->result() as $row) {
            $data['pem_1'] = $row->nama_dosen;
            $data['nip'] = $row->nip;
        }

        return $data;
    }

    public function addinstansi()
    {
        $session = $this->session->user_sess;
        $user = $session['username'];
        $nama = $session['nama'];
        $idjenjang = $session['kodeJenjang'];
        $idprodi = $session['kodeProdi'];
        $tgl_mulai = $this->input->post('tgl_mulai');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $instansi = $this->input->post('instansi');
        $alamat = $this->input->post('alamat');
        $pihak = $this->input->post('pihak');
        $this->db->db_select('db_master');
        $query = $this->db->query("select * from prodi where kode_prodi=$idprodi");
        foreach ($query->result() as $row) {
            $prodi = $row->nama_prodi;
        }
        $query = $this->db->query("select * from jenjang where id_jenjang=$idjenjang");
        foreach ($query->result() as $row) {
            $jenjang = $row->nama_jenjang;
        }

        $this->db->db_select('db_sisinta');
        $query1 = $this->db->query("SELECT COUNT(*) AS jml FROM data_judul WHERE nim=$user");
        foreach ($query1->result() as $row) {
            if ($row->jml == 1) {
                $query2 = $this->db->query("select * from data_judul where nim=$user");
                foreach ($query2->result() as $row) {
                    $judul = $row->judul;
                    $nip1 = $row->pembimbing_1;
                }
            }
        }
        $programstudi = "$jenjang" . " $prodi";
        $this->db->db_select('db_siadmin');
        $this->db->query("INSERT INTO penelitian(nim,nama,prodi,judul,kategori,penerima_surat,nama_instansi,alamat_instansi,tgl_mulai,tgl_berakhir) VALUES ('$user','$nama','$programstudi','$judul','Instansi','$pihak','$instansi','$alamat','$tgl_mulai','$tgl_akhir')");

        $query = $this->db->query("SELECT * FROM `penelitian` WHERE nim='$user' AND kategori='Instansi' ORDER BY ID DESC LIMIT 1 ");
        foreach ($query->result() as $row) {
            $id = $row->ID;
        }
        return $id;
    }

    public function printinstansi($id)
    {
        $query = $this->db->query("SELECT * FROM penelitian WHERE ID='$id'");
        foreach ($query->result() as $row) {
            $data['yth'] = $row->penerima_surat;
            $data['tgl_akhir'] = $row->tgl_berakhir;
            $data['alam'] = $row->alamat_instansi;
            $data['tgl_mulai'] = $row->tgl_mulai;
            $data['nama_mhs'] = $row->nama;
            $data['nim'] = $row->nim;
            $data['prodi'] = $row->prodi;
            $data['judul'] = $row->judul;
            $data['tuju'] = $row->nama_instansi;
            $data['id'] = $row->ID;
            $kategori = $row->kategori;
        }

        if ($kategori == "Dinas") {
            $query = $this->db->query("SELECT Nama_sekolah AS jml FROM tujuan_dinas WHERE id=$id");
            foreach ($query->result() as $row) {
                $data['tuju'] = $row->jml;
            }
        }

        $query = $this->db->query("SELECT COUNT(*) AS jml FROM tujuan_dinas WHERE id=$id");
        foreach ($query->result() as $row) {
            $data['juml'] = $row->jml;
        }

        $session = $this->session->user_sess;
        $idjenjang = $session['kodeJenjang'];
        $idprodi = $session['kodeProdi'];


        $query = $this->db_master->query("select * from jenjang where id_jenjang=$idjenjang");
        foreach ($query->result() as $row) {
            $jenjang = $row->nama_jenjang;
        }
        if ($jenjang == "S1") {
            $jenis = "Skripsi";
        } elseif ($jenjang == "D3") {
            $jenis = "Tugas Akhir";
        }
        $data['jenjang'] = $jenis;

        $query = $this->db_master->query("select * from user where level in(select id_level from level where nama_level like 'Koorprodi') and kode_prodi=$idprodi and jenjang=$idjenjang");
        foreach ($query->result() as $row) {
            $data['kaprodi'] = $row->nama_lengkap;
            $data['nip_prodi'] = $row->nomor_induk;
        }


        $query = $this->db_sisinta->query("select * from kategori_judul where kategori_judul like '$jenis'");
        foreach ($query->result() as $row) {
            $level = $row->id_kategori_judul;
        }
        $query2 = $this->db_sisinta->query("SELECT nama_dosen,nip FROM dosen_pembimbing WHERE nidn IN (SELECT data_judul.pembimbing_1 FROM data_judul WHERE nim='$data[nim]')");
        foreach ($query2->result() as $row) {
            $data['pem_1'] = $row->nama_dosen;
            $data['nip'] = $row->nip;
        }
        return $data;
    }

    public function tujuan_dinas($id)
    {
        $tujuan_dinas = array();
        $query = $this->db->query("SELECT * FROM tujuan_dinas WHERE id=$id");
        foreach ($query->result() as $row) {
            array_push($tujuan_dinas, array(
                'sekolah' => $row
            ));
        }
        return $tujuan_dinas;
    }

    //MY FUNCTION - DON'T DELETE
    public function getData($user)
    {
        $dataUser = $user;
        //Ambil Prodi
        $this->db_master->select('*');
        $this->db_master->from('prodi');
        $this->db_master->where('kode_prodi', $user['kodeProdi']);
        $this->db_master->limit(1);
        $dataUser['prodi'] = $this->db_master->get()->row()->nama_prodi;

        //Ambil Mhs Jenjang
        $this->db_master->select('*');
        $this->db_master->from('jenjang');
        $this->db_master->where('id_jenjang', $user['kodeJenjang']);
        $this->db_master->limit(1);
        $dataUser['jenjang'] = $this->db_master->get()->row()->nama_jenjang;


        $query1 = $this->db_sisinta->query("SELECT COUNT(*) AS jml FROM data_judul WHERE nim=$user[username] AND (status_judul='DITERIMA' OR status_judul='REVISI')");
        foreach ($query1->result() as $row) {
            if ($row->jml == 1) {
                $query2 = $this->db_sisinta->query("select judul from data_judul where nim=$user[username]");
                foreach ($query2->result() as $row) {
                    $dataUser['judul'] = $row->judul;
                }
                $dataUser['stat'] = "Berhasil";
            } else {
                $dataUser['judul'] = "Judul Tidak Tersedia";
                $dataUser['stat'] = "Gagal";
            }
        }
        $dataUser['username'] = $user['username'];
        $dataUser['nama'] = $user['nama'];
        if ($dataUser['jenjang'] == "S1") {
            $dataUser['jenis'] = "Skripsi";
        } elseif ($dataUser['jenjang'] == "D3") {
            $dataUser['jenis'] = "Tugas Akhir";
        }

        return $dataUser;
    }


    //MY FUNCTION - DON'T DELETE
    public function getDataKaprodi($jenjang, $prodi)
    {
        $this->db_master->select('user.nama_lengkap, kaprodi.nip');
        $this->db_master->from('user');
        $this->db_master->join('kaprodi', 'user.username = kaprodi.nip');
        $this->db_master->where('kaprodi.nama_jenjang', $jenjang);
        $this->db_master->where('kaprodi.nama_prodi', $prodi);
        return $this->db_master->get()->row();

    }

    public function getDataPembimbing1($nim_user)
    {
        $this->db_sisinta->select('dosen_pembimbing.nip, dosen_pembimbing.nama_dosen');
        $this->db_sisinta->from('dosen_pembimbing');
        $this->db_sisinta->join('data_judul', 'data_judul.pembimbing_1 = dosen_pembimbing.nip');
        $this->db_sisinta->where('data_judul.nim', $nim_user);
        $this->db_sisinta->limit(1);
        return $this->db_sisinta->get()->row();

    }

}
/* End of file Penelitian_model.php */