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
		body{
			font-family: Times. Times Roman;
		}
    </style>
</head>
<body style="margin-top:2.54cm;margin-right: 3.17cm;margin-left: 3.17cm;margin-bottom: 2.54cm; font-family: Times, Times Roman, serif;">
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
	if($tgl_mulai!==$tgl_akhir){
		$tanggal = "$tgl_mul" . " s.d " . "$tgl_akh";
	}else{
		$tanggal = $tgl_mul;
	}
    
    ?>
    <p style="text-align:center; font-weight:bold; font-size:12pt">FORM PERMINTAAN <br>
      SURAT PENGANTAR <?php echo strtoupper($jenjang);?></p>
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
                <td>Tujuan</td>
                <td>:</td>
                <td><?php echo $tuju; ?></td>
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
            <tr >
                <th align="center">NO.</th>
                <th align="center">NAMA</th>
                <th align="center">NIM</th>
                <th align="center">PRODI</th>
            </tr>
            <tr>
                <td style="padding: 5px">1.</td>
                <td style="padding: 5px"><?php echo "$nama_mhs"; ?></td>
                <td style="padding: 5px"><?php echo "$nim"; ?></td>
                <td style="padding: 5px"><?php echo "$prodi"; ?></td>
            </tr>
        </table>
        <br>
        <div style="line-height: 1">Judul <?php echo "$jenjang"; ?>&nbsp;&nbsp;&nbsp;:<br>
        <div style="line-height: 1.5"><?php echo "$judul"; ?></div></div>
    </div>
    <br>
    <br><br>
    <div >
        <table style="border-collapse:collapse;">
            <tr >
                <td style="white-space: nowrap;overflow: hidden; width: 350px">Mengetahui,</td>
                <td style="white-space: nowrap;overflow: hidden"><?php echo "Malang, $tgl"; ?></td>
            </tr>
            <tr>
                <td style="white-space: nowrap;overflow: hidden;">Pembimbing I</td>
                <td style="white-space: nowrap;overflow: hidden">Mahasiswa Ybs.</td>
            </tr>
            <tr>
                <td height="48pt"></td>
                <td></td>
            </tr>
            <tr>
                <td style="white-space: nowrap;overflow: hidden;"><?php if($stat=='Berhasil'){echo $pem_1->nama_dosen;}elseif($stat=='Gagal') {echo $pem_1['nama_dosen'];} ?></td>
                <td style="white-space: nowrap;overflow: hidden"><?php echo "$nama_mhs"; ?></td>
            </tr>
            <tr>
                <td style="white-space: nowrap;overflow: hidden;">NIP. <?php if($stat=='Berhasil'){echo $pem_1->nip;}elseif($stat=='Gagal') {echo $pem_1['nip'];} ?></td>
                <td style="white-space: nowrap;overflow: hidden">NIM. <?php echo "$nim"; ?></td>
            </tr>
        </table>
        <br>
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
</body>
</html>