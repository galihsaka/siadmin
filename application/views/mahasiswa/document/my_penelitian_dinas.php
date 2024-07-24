<html>
<head>
    <title>Penelitian_<?php echo $nim . '.pdf' ?></title>
    <style type="text/css">
        @page {
            margin: 0px;
        }

        td, th {
            font-size: 12pt;
            vertical-align: top;
        }
        table{
            page-break-inside: avoid;
        }
    </style>
</head>
<?php
function tgl_indo($tanggal)
{
    $bulan = array(
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    if (substr($pecahkan[2], 0, 1) == 0) {
        $pecahkan[2] = substr($pecahkan[2], 1);
    }
    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

$tgl = tgl_indo($tgl_buat);
$tgl_mul = tgl_indo($tgl_mulai);
$tgl_akh = tgl_indo($tgl_akhir);
if($tgl_mul!==$tgl_akh){
	$tanggal = "$tgl_mul" . " s.d " . "$tgl_akh";
}else{
	$tanggal = $tgl_mul;
}

?>
<body style="margin-top:2.54cm;margin-right: 3.17cm;margin-left: 3.17cm;margin-bottom: 2.54cm; font-family: Times, Times Roman, serif;">
<font size="12pt">
    <center><b>FORM PERMINTAAN</b></center>
    <center><b>SURAT PENGANTAR <?php echo strtoupper($jenjang); ?></b></center>
</font><br>
<div style="line-height: 1.5">
    <table>
        <tr>
            <td width="210px" style="padding-right: -5px">Surat ijin ditujukan kepada Yth</td>
            <td width="10px">:</td>
            <td><?php echo "$yth"; ?></td>
        </tr>
        <tr>
            <td>Alamat yang dituju</td>
            <td>:</td>
            <td><?php echo "$alam"; ?></td>
        </tr>
        <tr>
            <td>Keperluan</td>
            <td>:</td>
            <td>Permohonan Izin Penelitian</td>
        </tr>
        <tr>
            <td><?php
            if (count($tuju) > 1) {
                    echo "<b>Tujuan (sekolah yg dituju)</b>";
                } else {
                    echo "Tujuan";
                }
            ?></td>
            <td>:</td>
            <td><?php
                if (count($tuju) > 1) {
                    echo "Terlampir";
                } else {
                    echo $tuju[0]->Nama_sekolah;
                }
                ?></td>
        </tr>
        <tr>
            <td>Pelaksanaan</td>
            <td>:</td>
            <td><?php echo "$tanggal"; ?></td>
        </tr>
        <tr>
            <td>Data Mahasiswa</td>
            <td>:</td>
        </tr>
    </table>
    <table border="1" cellpadding="0" cellspacing="0" style="width:100%">
        <tr>
            <th align="center">NO.</th>
            <th align="center">NAMA</th>
            <th align="center">NIM</th>
            <th align="center">PRODI</th>
        </tr>
        <tr>
            <td style="padding: 5">1.</td>
            <td style="padding: 5"><?php echo "$nama_mhs"; ?></td>
            <td style="padding: 5"><?php echo "$nim"; ?></td>
            <td style="padding: 5"><?php echo "$prodi"; ?></td>
        </tr>
    </table>
    <br>
    <div style="line-height: 1">Judul <?php echo "$jenjang"; ?>&nbsp;&nbsp;&nbsp;:<br>
        <div style="line-height: 1.5"><?php echo "$judul"; ?></div></div>
</div>
<br><br>
<div style="line-height: 1.5">
    <table>
        <tr>
            <td style="white-space: nowrap;overflow: hidden; width: 350px">Mengetahui,</td>
            <td style="white-space: nowrap;overflow: hidden;"><?php echo "Malang, $tgl"; ?></td>
        </tr>
        <tr>
            <td style="white-space: nowrap;overflow: hidden;">Pembimbing I</td>
            <td style="white-space: nowrap;overflow: hidden;">Mahasiswa Ybs.</td>
        </tr>
        <tr>
            <td height="48pt"></td>
            <td></td>
        </tr>
        <tr>
            <td style="white-space: nowrap;overflow: hidden;"><?php if($stat=='Berhasil'){echo $pem_1->nama_dosen;}elseif($stat=='Gagal') {echo $pem_1['nama_dosen'];} ?></td>
            <td style="white-space: nowrap;overflow: hidden;"><?php echo "$nama_mhs"; ?></td>
        </tr>
        <tr>
            <td style="white-space: nowrap;overflow: hidden;">NIP. <?php if($stat=='Berhasil'){echo $pem_1->nip;}elseif($stat=='Gagal') {echo $pem_1['nip'];} ?></td>
            <td style="white-space: nowrap;overflow: hidden">NIM. <?php echo "$nim"; ?></td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>Kaprodi <?php echo "$prodi"; ?></td>
        </tr>
        <tr>
            <td height="48pt"></td>
        </tr>
        <tr>
            <td></td>
            <td><?php echo "$kaprodi->nama_lengkap"; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>NIP. <?php echo "$kaprodi->nip"; ?></td>
        </tr>
    </table>
</div>
<?php
if (count($tuju) > 1) {
    $tahun = date("Y");
    echo "<div style='page-break-before: always;'>
		<table style='line-height:1.5;' >
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td colspan='3'>Lampiran Surat Ijin Penelitian</td>
			</tr>
			<tr>
				<td></td>
				<td>No Surat</td>
				<td style='padding-left: -10px'>:</td>
				<td style='padding-left: -50px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/UN32.5.1/LT/$tahun</td></tr>
					<tr><td></td><td>Tanggal<td style='padding-left: -10px'>:</td><td style='padding-left: -50px'>$tgl</td></tr>
            </table>
            <br><br>
            <table border= '1' cellpadding='0' cellspacing='0' style='width:100%'>
            <tr>
				<th align='center'>No.</th>
				<th align='center'>Nama Sekolah</th>
				<th align='center'>Alamat Sekolah</th>
			</tr>";
    $no = 0;
    foreach ($tuju as $row) {
        $no++;
        ?>
        <tr>
            <td style='text-align:center'><?php echo $no ?></td>
            <td style='padding-left:10px'><?php echo $row->Nama_sekolah ?></td>
            <td style='padding-left:10px'><?php echo $row->alamat ?></td>
        </tr>
        <?php
    }
    echo "</table>
	</div>";
}
?>
</body>
</html>