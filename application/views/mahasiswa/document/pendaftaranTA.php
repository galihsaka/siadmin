<!--
Function :

 public function loadpdf(Type $var = null)
    {
        # code...
        

    
        $this->load->library('pdf');
    
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Seminar_$nim.pdf";
        $this->pdf->load_view('pendaftaranSeminar');
    }-->

<!--
    DOKUMEN
    FORM PENDAFTARAN SIDANG
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Pendaftaran Peserta Seminar</title>
</head>
<style>
    #judul{
        text-align: center;
        font-size: 14;
        line-height: 1;
        font-weight: bold;
     
    }
    @page {margin: 0px}
    table{
        page-break-inside: avoid;
    }
    body{
        margin-top: 1.5cm;
        margin-right: 2cm;
        margin-left: 3cm;
        margin-bottom:2;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11;
    }
    #tabel{
        line-height: 2;
    }
    .ttd{
        margin-left: auto;
        line-height:1;
    }
    #petugas{
        margin-left:30;
    }
    /*tinggi baris*/
    .baris{ 
        height: 35px;
    }
    #jadwal{
        margin-left: 10;
    }

</style>
<body>
    <!--DATA DINAMIS-->   
    <?php 
    $penguji="Drs. Sujono, M.T.";
    $ipk="3.44";
    $semester       = "GASAL";
    $tahunAjaran    = "2017/2018";
    $nim            = "170533628510";
    $nama           = "Nanda Ika Vera Marlina";
    $prodi          = "S1 Teknik Elektro";
    $nomorhp        = "081234567890";
    $judul          = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. 
    ";
    $pembimbing1    = "Drs. Slamet Wibawanto, M.T.";
    $pembimbing2    = "Heru Wahyu Herwanto, S.T., M.Kom.";
    $koordinator    = "Ilham Ari Elbaith Zaeni, S.T., M.T., Ph.D.";
    $hari_seminar   = "Senin";
    $tanggal_seminar= "21";
    $bulan_seminar  = "Oktober";
    $tahun_seminar  = "2019";
    $jam            = "08.00";
    $ruang          = "G4.104";
    $nip_koordinator= "196806041997021001";
    $nip_pembimbing1= "198307267767389344";
    ?>  
<!-- array untuk menampilkan hari sekarang-->
<?php 
    $nama_hari  = array(1=>"Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu", "Minggu");
    $hari_ini   = $nama_hari[date("N")];?>
<!--untuk menampilkan tanggal dab tahun sekarang-->
<?php
    $tanggal_ini= date("d");
    $tahun_ini  = date("Y");
?>
<!--array untuk menampilkan bulan sekarang-->
<?php
    $nama_bulan = array(1=>"Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $bulan_ini  = $nama_bulan[date("n")];
?>

    <!--NAMA FORM-->
    <div id="judul">
        FORM PENDAFTARAN <br> UJIAN TUGAS AKHIR<br>
        <?php echo "PRODI ".strtoupper($prodi). "<br> SEMESTER $semester $tahunAjaran"; ?>
    </div>
    
    <!--Data Mahasiswa-->
    <div>
        <span style="font-size:10;"><u>Diisi oleh mahasiswa</u></span><br>
        <table id="tabel">
            <tr>
                <td>Nama/NIM</td>
                <td>:</td>
                <td> <?php echo "$nama / $nim "?> </td>
            </tr>
            <tr>
                <td>Prodi</td>
                <td>:</td>
                <td><?php echo "$prodi"; ?></td>
            </tr>
            <tr>
                <td>No. Telp/HP</td>
                <td>:</td>
                <td><?php echo "$nomorhp"; ?></td>
            </tr>
            <tr>
                <td>IPK</td>
                <td>:</td>
                <td><?php echo "$ipk"; ?></td>
            </tr>
            <tr>
                <td style="vertical-align:top">Judul Tugas Akhir</td>
                <td style="vertical-align:top">:</td>
                <td style="vertical-align:top; text-align: justify"><?php echo "$judul"; ?></td>
            </tr>
            <tr>
                <td>Pembimbing 1</td>
                <td>:</td>
                <td><?php echo "$pembimbing1"; ?></td>
            </tr>
            <tr>
                <td>Pembimbing 2</td>
                <td>:</td>
                <td><?php echo "$pembimbing2"; ?></td>
            </tr>
        </table>        
    </div>

    <!--TTD Mahasiswa-->
    <div>
        <table class="ttd">
            <tr>
                <td> Malang,.............................................. <br><br></td>
            </tr>
            <tr>
                <td>Mahasiswa ybs <br><br><br><br><br></td>
            </tr>
            <tr>
                <td><u><?php echo "$nama"; ?></u></td>
            </tr>
        </table>

    </div>

    <!--Garis pemisah-->
    <div>
        <br><br><br><br><br><br><br><br>
        <hr style="color:black; border-style: solid">
    </div>

    <!--Diisi oleh Petugas-->
    A. Diisi oleh Petugas
    
    <table id="petugas">

        <tr>
            <td class="baris">1.</td>
            <td>Foto Copy KRS</td>
            <td style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td> Ada
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>Tidak Ada</td>
        </tr><tr>
            <td class="baris">2.</td>
            <td>Lembar Persetujuan</td>
            <td style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td> Ada</td>
            <td style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>Tidak Ada</td>
        </tr><tr>
            <td class="baris">3.</td>
            <td>Lembar Kesediaan Hadir Diuji</td>
            <td style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td> Ada</td>
            <td style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>Tidak Ada</td>
        </tr><tr>
            <td class="baris">4.</td>
            <td>Berkas Tugas Akhir 3 Eksemplar</td>
            <td style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td> Ada</td>
            <td style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>Tidak Ada</td>
        </tr><tr>
            <td class="baris">5.</td>
            <td>FC KHS Semua Semester</td>
            <td style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td> Ada</td>
            <td style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>Tidak Ada</td>
        </tr><tr>
            <td class="baris">6.</td>
            <td>Draft Artikel</td>
            <td style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td> Ada</td>
            <td style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>Tidak Ada</td>
        </tr><tr>
            <td class="baris">7.</td>
            <td>FC Kartu Bimbingan minimal 8x bimbingan</td>
            <td style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td> Ada</td>
            <td style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>Tidak Ada</td>
        </tr><tr>
            <td class="baris">8.</td>
            <td>FC Pengajuan Judul Tugas Akhir</td>
            <td style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td> Ada</td>
            <td style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>Tidak Ada</td>
        </tr>
    </table>
    
    <!--Form koordinator skripsi-->
    <span style="page-break-before: always;">B. Diisi oleh Koordinator Tugas Akhir</span>
    <div id="jadwal"><br>
        <b>&nbsp;Jadwal Ujian</b>
        <table>
            <tr>
                <td class="baris">Hari/Tanggal</td>
                <td>:</td>
                <td>..............................................</td>
            </tr>
            <tr>
                <td class="baris">Waktu</td>
                <td>:</td>
                <td>..............................................</td>
            </tr>
            <tr>
                <td class="baris">Penguji</td>
                <td>:</td>
                <td>..............................................</td>
            </tr>
            <tr>
                <td class="baris">Ruang</td>
                <td>:</td>
                <td>..............................................</td>
            </tr>
        </table>
    </div>

    <!--Tanda tangan koordinator skripsi-->
    <div>
            <table class="ttd">
                <tr>
                    <td> Malang,.............................................. <br><br></td>
                </tr>
                <tr>
                    <td>Koordinator Tugas Akhir <br><br><br><br><br></td>
                </tr>
                <tr>
                    <td><u><?php echo "$koordinator"; ?></u></td>
                </tr>
            </table>
    
        </div>
<!-- FUNCTION KOP SURAT-->
<?php 
function kopSurat(){
    echo "<table style='width: 101%; margin-left: -50px;''>
        <tr>
            <td style='width: 2.5cm'><img src='assets/logo.png' alt='' style='height:2.5cm; width: 2.5cm; padding-left: 10px'></td>
            <td style='vertical-align:top; font-size: 14pt; text-align: center; line-height: 1'>
                KEMENTERIAN RISET,TEKNOLOGI, DAN PENDIDIKAN TINGGI
                <br> UNIVERSITAS NEGERI MALANG (UM)
                <br> FAKULTAS TEKNIK
                <br><b>JURUSAN TEKNIK ELEKTRO</b><br>
                <span style='font-size:12pt'> Jalan Semarang 5, Malang 65145 <br>
                    Telepon: (0341) 7044470, 573090<br>
                    Laman:www.elektro.um.ac.id <br>
                    </span>
            </td>
        </tr>
    </table>
        <hr style='border: solid black 1.5pt'>
        ";
}
?>

</body>
</html>



  




