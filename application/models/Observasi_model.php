 <?php
/**
 * Created by PhpStorm.
 * User: Syarif
 * Date: 7/10/2019
 * Time: 9:31 PM
 *
 * Class ini digunakan untuk pendaftaran studi lapangan dan izin penelitian
 */

class Observasi_model extends CI_Model
{
    
    public function getLapanganByNim($noInduk)
    {
        $data  = array();
        $query = $this->db->query("SELECT sl.id, sl.nim_ketua, sl.mata_kuliah, 
        sl.prodi_kel, sl.alamat_instansi, sl.tanggal_mulai, 
        sl.tanggal_akhir, sl.instansi_tujuan, sl.kepada, 
        sl.judul, sl.tgl_buat FROM studi_lapangan sl 
        INNER JOIN anggota_studi ad 
        ON sl.id = ad.id 
        AND ad.nim = '$noInduk' GROUP BY sl.id DESC")->result();
        foreach ($query as $key) {
            $anggota = $this->getAnggotaById($key->id);
            array_push($data, array(
                'instansi' => $key,
                'anggota' => $anggota
            ));
        }
        return $data;
        
    }
    
    public function getLapanganAll()
    {
        # code...
        $query = $this->db->query("SELECT * FROM studi_lapangan sl INNER JOIN anggota_studi ad ON sl.id = ad.id ORDER BY sl.id")->result();
        return $query;
    }
    
    public function addLapangan($data, $dataAnggota)
    {
        if (!($this->db->insert('studi_lapangan', $data))) {
        } else {
            $groupID    = $this->getGroupID($data);
            $arrAnggota = array();
            for ($i = 0; $i < count($dataAnggota['nim']); $i++) {
                array_push($arrAnggota, array(
                    'id' => $groupID,
                    'nim' => $dataAnggota['nim'][$i],
                    'nama' => $dataAnggota['nama'][$i],
                    'prodi' => $dataAnggota['prodi'][$i]
                ));
            }
            
            foreach ($arrAnggota as $key) {
                if (!($this->db->insert('anggota_studi', $key))) {
                    return false;
                }
            }
            $log = array('crud_detail' => 'Create');
            $this->db->insert('log_studi_lapangan', $log);
            return true;
        }
    }
    
    private function getGroupID($data)
    {
        $this->db->select('id');
        $this->db->from('studi_lapangan');
        $this->db->where('mata_kuliah', $data['mata_kuliah']);
        $this->db->where('nim_ketua', $data['nim_ketua']);
        $this->db->where('kepada', $data['kepada']);
        $this->db->where('judul', $data['judul']);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->row();
        if (isset($query)) {
            return $query->id;
        } else {
            return 'noData';
        }
    }
    
    private function getAnggotaById($id)
    {
        $this->db->select('nim');
        $this->db->select('nama');
        $this->db->select('prodi');
        $this->db->from('anggota_studi');
        $this->db->where('id', $id);
        $data = $this->db->get()->result();
        return $data;
    }
    
    public function cetak($id)
    {
        $this->db->db_select("db_siadmin");
        $query = $this->db->query("SELECT * FROM studi_lapangan WHERE id='$id'");
        foreach ($query->result() as $row) {
            $data['id']     = $row->id;
            $data['judul']  = $row->judul;
            $data['yth']    = $row->kepada;
            $data['alamat'] = $row->alamat_instansi;
            $data['matkul'] = $row->mata_kuliah;
            $data['prodi']  = $row->prodi_kel;
            $data['tujuan'] = $row->instansi_tujuan;
            $data['mulai']  = $row->tanggal_mulai;
            $data['akhir']  = $row->tanggal_akhir;
        }
        
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "StudiLapangan.pdf";
        $this->pdf->load_view('mahasiswa/document/studi_lapangan', $data);
        
    }
    
	function hapus($id,$nim){
		$this->db->db_select("db_siadmin");
		$query = $this->db->query("DELETE FROM anggota_studi WHERE id='$id' AND nim='$nim' ");
		$cekanggota = $this->db->query("SELECT COUNT(*) as jml FROM anggota_studi WHERE id='$id'");
		foreach($cekanggota->result() as $row){
			if($row->jml==0){
				$this->db->query("DELETE FROM studi_lapangan WHERE id='$id' ");
			}
		}
	}
    
} 