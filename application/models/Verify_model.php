<?php
/**
 * Created by PhpStorm.
 * User: Syarif
 * Date: 07-Jul-19
 * Time: 1:49 PM
 */

class Verify_model extends CI_Model
{
    private $dbs;

    public function __construct()
    {
        parent::__construct();
        $this->dbs = $this->load->database('db_master', TRUE);
    }

    public function verify($username, $password)
    {
        $this->dbs->select('*');
        $this->dbs->from('user');
        $this->dbs->where('username', $username);
        $this->dbs->where('pwd_hash', $password);
        $this->dbs->limit(1);
        $data = $this->dbs->get()->row();

        if (isset($data)) {
            $hak = $this->verifyHakAkses($data->username, $data->level);
            $namaProdi = $this->getNamaProdi($data->kode_prodi);
            $jenjang = $this->getJenjang($data->jenjang);
            return array(
                'username' => $data->username,
                'nama' => $data->nama_lengkap,
                'tahunMasuk' => $data->tahun_masuk,
                'kodeProdi' => $data->kode_prodi,
				'jenjang_'=>$jenjang,
                'jenjangProdi' => $jenjang . " " . $namaProdi,
                'noInduk' => $data->nomor_induk,
                'noHp' => $data->no_hp,
                'email' => $data->email,
                'off' => $data->offering,
                'kelamin' => $data->jenis_kelamin,
                'level' => $data->level,
                'aksesSiadmin' => $data->siadmin,
                'aktif' => $data->status,
                'kodeJenjang' => $data->jenjang,
                'hakAkses' => $hak
            );
        } else {
            return 'noData';
        }

    }

    public function verifyHakAkses($username, $level)
    {
        $this->dbs->select('level');
        $this->dbs->from('user');
        $this->dbs->where('username', $username);
        $this->dbs->where('level', $level);
        $this->dbs->limit(1);
        $data = $this->dbs->get()->row();
        if (isset($data)) {
            $this->dbs->select('nama_level');
            $this->dbs->from('level');
            $this->dbs->where('id_level', $data->level);
            $this->dbs->limit(1);
            return $this->dbs->get()->row()->nama_level;

        } else {
            //TODO: Error handling when query results is 0
        }
    }

    public function getMahasiswa($id)
    {

        $this->dbs->select('username, kat_no_induk, nomor_induk, nama_lengkap, tahun_masuk, jenjang, kode_prodi');
        $this->dbs->from('user');
        $this->dbs->join('kat_no_induk', 'user.kat_no_induk = kat_no_induk.id_kat_no_induk');
        $this->dbs->where('username', $id);
        $this->dbs->where('kat_no_induk.nama_kat_no_induk', 'NIM');
        $this->dbs->limit(1);
        $data = $this->dbs->get()->row();
        if (isset($data)) {
            $namaProdi = $this->getNamaProdi($data->kode_prodi);
            $jenjang = $this->getJenjang($data->jenjang);
            return array(
                'username' => $data->username,
                'nama' => $data->nama_lengkap,
                'tahun' => $data->tahun_masuk,
                'prodi' => $jenjang . " " . $namaProdi
            );
        } else {
            return 'noData';
        }

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

    //$levelOrg = tingkatan organisasi
    public function getMenjabat($levelOrg)
    {
        $this->dbs->select('nomor_induk, nama_lengkap');
        $this->dbs->from('user');
        $this->dbs->where('level', $levelOrg);
        $data = $this->dbs->get()->row();
        if (isset($data)) {
            return array(
                'nama_lengkap' => $data->nama_lengkap,
                'nomor_induk' => $data->nomor_induk
            );
        }
    }
}