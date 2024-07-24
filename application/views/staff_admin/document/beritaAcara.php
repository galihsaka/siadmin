<?php error_reporting(0); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BeritaAcara<?php echo "_".$nim."_".$tanggal_seminar.$bulan_seminar.$tahun_seminar?></title>
</head>
<style>
    table {
            page-break-inside: avoid;
        }
    #judul{
        text-align: center;
        font-size: 14pt;
        line-height: 1;
        font-weight: bold;
     
    }
    td{
        vertical-align: top;
    }
    @page {margin: 0px}
    body{
        margin: 1.5cm 2cm 2cm 3cm;
        font-family: Times, Times Roman, serif;
        font-size: 12pt;
    }
    #tabel{
        line-height: 2;
    }
    .ttd{
        margin-left: 280px;
        line-height:1;
    }
    #petugas{
        margin-left:30pt;
    }
    #jadwal{
        margin-left: 10pt;
    }

</style>
<body>
<?php
foreach ($nip_pembimbing1 as $row) {
     $nippem1=$row->nomor_induk;
 } 
function kopSurat(){
    echo "<table style='width: 101%; margin-left: -60px;'>
        <tr>
            <td style='width: 2.5cm'><img src='img/logo/Logo-UM-bw.png' alt='' style='height:2.5cm; width: 2.5cm; padding-left: 15px'></td>
            <td style='vertical-align:top; font-size: 14pt; text-align: center; line-height: 1'>
                KEMENTERIAN RISET,TEKNOLOGI, DAN PENDIDIKAN TINGGI
                <br> UNIVERSITAS NEGERI MALANG (UM)
                <br> FAKULTAS TEKNIK
                <br>
                <b>JURUSAN TEKNIK ELEKTRO <br></b>
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
<div style="font-family: 'Times Roman', Times, serif; font-size: 12pt">

<!--KOP SURAT-->
<?php kopSurat(); ?>

<!--JUDUL SURAT-->
<br>
<div style="margin-top: -20px; text-align: center"><b>BERITA ACARA UJIAN <?php echo strtoupper($jenisUjian) ?><br>
        PROGRAM STUDI <?php echo strtoupper($prodi) ?> <br>
        SEMESTER <?php echo strtoupper($semester) ?> <?php echo " $tahunAjaran" ?> <br> </b></div>
        <br>
<div style="line-height:1.5; text-align:justify; line-height: 1">Pada hari ini <?php echo " $hari_seminar Tanggal $tanggal_seminar  Bulan $bulan_seminar  Tahun $tahun_seminar, Pukul $jam bertempat di $ruang" ?>    Jurusan Teknik Elektro Fakultas Teknik Universitas Negeri Malang, telah diselenggarakan Ujian <?php echo $jenisUjian ?> Prodi <?php echo "$prodi"?> dengan judul : </div>
<p style="text-align: center"><b><?php echo $judul ?></b></p>

<table style="width:100%; margin-left: -2px">
    <tr>
        <td>atas nama <b><?php echo $nama ?></b></td>
        <td>NIM <b><?php echo "$nim" ?></b></td>
    </tr>
</table>
<div style="line-height: 1.5">
<div style="margin-bottom: 10px;">Dengan hasil sebagai berikut:</div>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="width: 90%; margin-bottom: 10px">
    <tr><td align="center" style="background-color: lightgray; width: 60%">Pembimbing/Penguji</td><td align="center" style="background-color: lightgray; width: 40%">Skor</td></tr>
    <tr><td>&nbsp;Penguji</td><td></td></tr>
    <tr><td>&nbsp;Pembimbing I</td><td></td></tr>
    <tr><td>&nbsp;Pembimbing II</td><td></td></tr>
    <tr><td align="center">Jumlah</td><td></td></tr>
    <tr><td align="center">Nilai Akhir (Rata-rata)</td><td></td></tr>
</table>
Sidang memutuskan mahasiswa tersebut dinyatakan:
<center><b>TIDAK LULUS/LULUS/LULUS DENGAN REVISI <sup>*)</sup></b></center>
<div style="margin-bottom: -5px">Yang bersangkutan diberi waktu revisi sampai dengan tanggal ......................................</div>(Daftar revisi terlampir)
<br>
<!--Data pembimbing 1 dan 2-->
<table style="border-collapse:collapse; width: 100%; margin-top: 10px">
    <tr>
        <td style="vertical-align:top; width: 120px">Penguji</td>
        <td style="vertical-align:top; width: 10px">:</td>
        <td style="vertical-align:top; width: 300px"><?php echo "$penguji"?></td>
        <td style="vertical-align:top">Tanda tangan ..............</td>
    </tr>
    <tr>
        <td style="vertical-align:top">Pembimbing 1</td>
        <td style="vertical-align:top">:</td>
        <td style="vertical-align:top"><?php echo "Ilham Ari Elbaith Zaeni, S.T., M.T., Ph.D."?></td>
        <td style="vertical-align:top">Tanda tangan ..............</td>
    </tr>
    <tr>
        <td style="vertical-align:top">Pembimbing 2</td>
        <td style="vertical-align:top">:</td>
        <td style="vertical-align:top"><?php echo "$pembimbing2"?></td>
        <td style="vertical-align:top">Tanda tangan ..............</td>
    </tr>
</table>
</div>
<br>
<!--Tanda Tangan koordinator skripsi dan pembimbing1 -->
Mengetahui
<table style="border-collapse: collapse">
    <tr>
        <td style="vertical-align:top; width: 310px">Koordinator Skripsi <br><br><br><br><br>	</td>
        <td style="vertical-align:top">Pembimbing 1 <br>Selaku Pimpinan Sidang</td>
    </tr>
    <tr>
        <td style="vertical-align:top"><?php echo "$kaprodi->nama_lengkap"?> </td>
        <td style="vertical-align:top"><?php echo "$pembimbing1"?></td>
    </tr>
    <tr>
        <td style="vertical-align:top">NIP. <?php echo "$kaprodi->nip"?> </td>
        <td style="vertical-align:top">NIP. <?php echo "$nippem1"?></td>
    </tr>
</table>
*) Coret yang tidak diperlukan
</div>
<span style="page-break-before:always"></span>
<div style="font-family: 'Times Roman', Times, serif; font-size: 12pt">

    <!--KOP-->
    <?php kopSurat() ?>
    <!--JUDUL FORM PENILAIAN-->
    <div style="text-align: center; margin-top: 10px"><b>FORM PENILAIAN UJIAN <?php echo strtoupper($jenisUjian) ?><br>
        PROGRAM STUDI <?php echo strtoupper($prodi) ?></b></div>
    <br>
    <br>

    <!--Identitas Mahasiswa-->
    <table style="border-collapse: collapse">
        <tr>
            <td style="height : 30px" width="100px">NAMA</td>
            <td width="20px">:</td>
            <td><b><?php echo $nama ?> </b></td>
        </tr>
        <tr>
            <td style="height : 30px">NIM</td>
            <td>:</td>
            <td><b><?php echo $nim ?> </b></td>
        </tr>
        <tr>
            <td style="vertical-align:top; height : 30px">JUDUL</td>
            <td style="vertical-align:top">:</td>
            <td style="vertical-align:top; text-align: justify"><b><?php echo $judul ?> </b></td>
        </tr>
    </table><br>

    <!--FORM PENILAIAN-->
    <table border="1" style="border-collapse: collapse; width:100%">
        <tr style="text-align: center">
            <td colspan="2" style="background-color: lightgray; vertical-align: middle;">Aspek yang Dinilai</td>
            <td style="width:100px; background-color: lightgray;vertical-align: middle;">Pembimbing *)</td>
            <td style="width:100px; background-color: lightgray;vertical-align: middle;">Penguji *)</td>
            <td colspan="3" style="background-color: lightgray;vertical-align: middle;">Keterangan</td>
        </tr>
        <tr>
            <td style="text-align: center; vertical-align: middle;">1</td>
            <td style="padding-left: 5px; width: 180px">Kualitas <?php echo $jenisUjian ?> sebagai Produk Tertulis</td>
            <td></td>
            <td></td>
            <td style="border-right: none;vertical-align: bottom;">&nbsp;Rentangan</td>
            <td colspan="2" style="border-left: none;vertical-align: bottom; padding-left: 20px">Nilai</td>
        </tr>
        <tr>
            <td rowspan="2" style="width:5px; text-align: center;vertical-align: middle;">2</td>
            <td rowspan="2" style="padding-left:5px">Kualitas Unjuk Kerja dalam Proses Ujian</td>
            <td rowspan="2"></td>
            <td rowspan="2"></td>
            <td style="border-right: none;">&nbsp;85 - 100</td>
            <td style="border-left: none; border-right: none; width: 10px">A</td>
            <td style="border-left: none">(4,0)</td>
        </tr>
        <tr>
            <td style="border-right: none">&nbsp;80 - 84</td>
            <td style="border-left: none; border-right: none">A-</td>
            <td style="border-left: none">(3.7)</td>
        </tr>
        <tr>
            <td rowspan="2" style="width:5px; text-align: center;vertical-align: middle;">3</td>
            <td rowspan="2" style="padding-left: 5px">Kualitas Unjuk Kerja dalam Proses Penulisan</td>
            <td rowspan="2"></td>
            <td rowspan="2" style="background-color: lightgray"></td>
            <td style="border-right: none">&nbsp;75 - 79</td>
            <td style="border-left: none; border-right: none">B+</td>
            <td style="border-left: none">(3,3)</td>
        </tr>
        <tr>
            <td style="border-right: none">&nbsp;70 - 74</td>
            <td style="border-left: none; border-right: none">B</td>
            <td style="border-left: none">(3,0)</td>
        </tr>
        <tr>
            <td colspan="2" rowspan="3" style="padding-left:5px;vertical-align: middle;">Jumlah</td>
            <td rowspan="3"></td>
            <td rowspan="3"></td>
            <td style="border-right: none">&nbsp;65 - 69</td>
            <td style="border-left: none; border-right: none">B-</td>
            <td style="border-left: none">(2,7)</td>
        </tr>
        <tr>
            <td style="border-right: none">&nbsp;60 - 64</td>
            <td style="border-left: none; border-right: none">C+</td>
            <td style="border-left: none">(2,3)</td>
        </tr>
        <tr>
            <td style="border-right: none">&nbsp;55 - 59</td>
            <td style="border-left: none; border-right: none">C</td>
            <td style="border-left: none">(2,0)</td>
        </tr>
        <tr>
            <td colspan="2" rowspan="3" style="padding-left:5px;vertical-align: middle;">Nilai  Akhir (rata-rata) **</td>
            <td rowspan="3"></td>
            <td rowspan="3"></td>
            <td style="border-right: none">&nbsp;40 - 54</td>
            <td style="border-left: none; border-right: none">D</td>
            <td style="border-left: none">1,0</td>
        </tr>
        <tr>
            <td style="border-right: none">&nbsp;00 - 40</td>
            <td style="border-left: none; border-right: none">E</td>
            <td style="border-left: none">(0)</td>
        </tr>
        <tr>
            <td colspan="3" style="background-color: lightgray">** Lulus Minimal = 55 (2,0)</td>
        </tr>
    </table>
    <br>
    *) Pembimbing atau penguji mengisikan skor (0 – 100) pada kolom yang sesuai. <br>
    <br>
    <br>
    <table class="ttd">
        <tr>
            <td>Malang, ...................................... <br><br></td>
        </tr>
        <tr>
            <td>Dosen Penguji/Pembimbing <br><br><br><br><br></td>
        </tr>
        <tr>
            <td>.....................................................</td>
        </tr>
    </table>
</div></div>
<div style="font-family: 'Times Roman', Times, serif; font-size: 12pt">
<span style="page-break-before: always"></span>

<!--
    KOP
-->
<?php kopSurat()?>
<!--
    NAMA NIM
-->
<p style="text-align: center"><b>LAMPIRAN BERITA ACARA UJIAN SKRIPSI</b></p>
<br>
<table>
    <tr>
        <td style="height : 30px" width="100px">NAMA</td>
        <td width="20px">:</td>
        <td><b><?php echo $nama?></b></td>
    </tr>
    <tr>
        <td style="height: 30px;">NIM</td>
        <td>:</td>
        <td><b><?php echo "$nim"?></b></td>
    </tr>
    <tr>
        <td style="height: 30px;">JUDUL</td>
        <td>:</td>
        <td><b><?php echo "$judul"?></b></td>
    </tr>
</table>
<br>
<b>Revisi</b><br><br>
<div style="line-height:2">
____________________________________________________________________________<br>
____________________________________________________________________________<br>
____________________________________________________________________________<br>
____________________________________________________________________________<br>
____________________________________________________________________________<br>
____________________________________________________________________________<br>
____________________________________________________________________________<br>
____________________________________________________________________________<br>
____________________________________________________________________________

</div>
<br><br>
<table class="ttd">
        <tr>
            <td>Malang, ...................................... <br><br></td>
        </tr>
        <tr>
            <td>Dosen Penguji/Pembimbing <br><br><br><br><br></td>
        </tr>
        <tr>
            <td>.....................................................</td>
        </tr>
    </table>


<!--
    Catatan
-->
</div>
</body>
</html>