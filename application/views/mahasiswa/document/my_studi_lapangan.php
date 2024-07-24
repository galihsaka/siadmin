<html>

<head>
    <title>StudiLapangan_<?php echo $anggota[0]->nim?></title>
    <style type="text/css">
        @page {
            margin: 0px;
        }

        td {
            font-size: 12pt;
        }

        table {
            page-break-inside: avoid;
        }
    </style>
</head>

<body style="margin: 1.5cm 2cm 2.5cm 3cm">
    <table style="width: 101%; margin-left: -50px;">
        <tr>
            <td style="width: 2.5cm"><img src="img/logo/Logo-UM-bw.png" alt="" style="height:2.5cm; width: 2.5cm; padding-left: 10px"></td>
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
    <table style="margin-top: -10px; line-height: 1; padding-top: 3px">
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
        $no_surat = "/UN32.5.5.3/LT/" . date('Y');
        $tgl_buat = tgl_indo($tgl_ajukan);
        if($mulai==$akhir){
            $waktu=tgl_indo($mulai);
        }
        else{
        $waktu = tgl_indo($mulai) . " s.d " . tgl_indo($akhir);
    }
        ?>
        <tr>
            <td>Nomor</td>
            <td style="padding-left:45px">:</td>
            <td width="200px" style="padding-left:70px">
                <?php echo "$no_surat" ?></td>
            <td width="225px" style="text-align: right;"><?php echo "$tgl_buat" ?></td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td style="padding-left:45px">:</td>
            <td>Permohonan Ijin Studi Lapangan</td>
            <td></td>
        </tr>
    </table>
    <br><br><div style="margin-left: 3px">Yth.
        <?php echo "$yth" ?></div>
    <table width="350px" style="margin-top: -3px">
        <tr>
            <td>
                <?php echo "$alamat" ?></td>
        </tr>
    </table>
    <br>
    <p style="font-size: 12pt">Dalam rangka melaksanakan tugas Mata Kuliah
        <?php echo "$matkul" ?> Program Studi
        <?php echo "$prodi" ?> Jurusan Teknik Elektro Fakultas Teknik Universitas Negeri Malang, kami mohon dengan hormat
        mahasiswa tersebut di bawah ini diberikan ijin untuk melaksanakan studi lapangan di
        <?php echo "$tujuan" ?>.
        <br>
        <br>Mahasiswa tersebut adalah :
    </p>
    <table border="1" cellpadding="0" cellspacing="0" style='width:100%'>
        <tr>
            <th align="center">No</th>
            <th align="center">Nama/NIM</th>
            <th align="center">Judul Studi Lapangan</th>
        </tr>
        <?php

        for ($i = 0; $i < $jml_anggota; $i++) {
            $nomr = $i + 1;
            ?>
            <tr>
                <td style="text-align:center">
                    <?php echo "$nomr" . "." ?>
                </td>
                <td style="padding-left:10px">
                    <?php echo $anggota[$i]->nama . " / " . $anggota[$i]->nim ?>
                </td>
                <?php
                if ($i + 1 == 1) {
                    echo "<td rowspan='$jml_anggota' style='text-align:center;padding:10px'>$judul</td>";
                }
                ?>
            </tr>
            <?php
        }
        ?>
    </table>
    <br>
    <div style="font-size: 12pt">Waktu:
        <?php echo "$waktu"; ?>
    </div>
    <div style="height: 12pt"></div>
    <div style="margin-top: -10px; font-size: 12pt">
        Atas perhatian dan kerjasama yang baik, kami sampaikan terima kasih.
    </div>
    <br>
    <br>
    <table>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td><?php echo $jabat; ?></td>
        </tr>
        <tr>
            <td height="48pt"></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?php echo $kajur['nama_lengkap']; ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>NIP.
                <?php echo $kajur['nomor_induk']; ?>
            </td>
        </tr>
    </table>
</body>

</html>