<?php
/**
 * Created by PhpStorm.
 * User: Syarif
 * Date: 8/1/2019
 * Time: 10:38 AM
 */

class Report_model extends CI_Model
{
    //Menghitung tabel data hari ini
    public function countSuratMasukByDay()
    {
        $datenow = date("Y-m-d 00:00:00", strtotime("today"));
        $dateafter = date("Y-m-d 00:00:00", strtotime("tomorrow"));
        $this->db->where('time >=', $datenow);
        $this->db->where('time <', $dateafter);
        $this->db->from('log_surat_masuk');
        return $this->db->count_all_results();
    }

    public function countStudiLapanganByDay()
    {
        $datenow = date("Y-m-d 00:00:00", strtotime("today"));
        $dateafter = date("Y-m-d 00:00:00", strtotime("tomorrow"));
        $this->db->where('time >=', $datenow);
        $this->db->where('time <', $dateafter);
        $this->db->from('log_studi_lapangan');
        return $this->db->count_all_results();
    }

    public function countPenelitianByDay()
    {
        $datenow = date("Y-m-d 00:00:00", strtotime("today"));
        $dateafter = date("Y-m-d 00:00:00", strtotime("tomorrow"));
        $this->db->where('time >=', $datenow);
        $this->db->where('time <', $dateafter);
        $this->db->from('log_penelitian');
        return $this->db->count_all_results();
    }

    //Menghitung tabel data log keseluruhan
    public function countSuratMasuk()
    {
        $this->db->from('log_surat_masuk');
        return $this->db->count_all_results();
    }

    public function countStudiLapangan()
    {
        $this->db->from('log_studi_lapangan');
        return $this->db->count_all_results();
    }

    public function countPenelitian()
    {
        $this->db->from('log_penelitian');
        return $this->db->count_all_results();
    }

    public function getSuratMasuk()
    {
        $this->db->select('*');
        $this->db->from('log_surat_masuk');
        return $this->db->get()->result();
    }

    public function getStudiLapangan()
    {
        $this->db->select('*');
        $this->db->from('log_studi_lapangan');
        return $this->db->get()->result();
    }

    public function getPenelitian()
    {
        $this->db->select('*');
        $this->db->from('log_penelitian');
        return $this->db->get()->result();
    }
}