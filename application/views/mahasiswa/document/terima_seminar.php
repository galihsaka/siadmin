<html>
	<head>
		<title>Izin Penelitian</title>
		<style type="text/css">
			@page {margin :0px;}
			td, th{
				vertical-align: top;
			}
	</style>
	</head>
	<?php
        	$nm="Galih Saka Diantama";
            $prdi="S1 Pendidikan Teknik Informatika";
            $jrs="Teknik Elektro";
            $jdl="Perbedaan kemampuan pemecahan masalah mata pelajaran piranti sesor aktuator dengan penerapan model pembelajaran problem posing dan probing prompting pada siswa kelas xi teknik otomasi industri smk negeri 1 singisari";
            $ni="170533628506";
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
                if(substr($pecahkan[2], 0, 1)==0){
                        $pecahkan[2]=substr($pecahkan[2], 1);
                    }
                return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
            }
        	$tgl=tgl_indo(date("Y-m-d"));
        	?>
	<body style="margin-top:2.54cm;margin-right: 3.17cm;margin-left: 3.17cm;margin-bottom: 2.54cm; font-size: 12pt; line-height: 1.5">
        <div align="center" style="font-size: 14pt; line-height: 1"><b>TANDA TERIMA PENYERAHAN REVISI LAPORAN</b><br>
        <b>SEMINAR PROPOSAL SKRIPSI</b></div><br>
        Telah terima laporan Revisi Seminar Proposal Skripsi sebanyak 1 (satu) eksemplar dari :
        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?php echo "$nm" ?></td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>:</td>
                <td><?php echo "$ni" ?></td>
            </tr>
            <tr>
                <td>Program Studi/Kelas</td>
                <td>:</td>
                <td><?php echo "$prdi" ?></td>
            </tr>
            <tr>
                <td>Jurusan</td>
                <td>:</td>
                <td><?php echo "$jrs" ?></td>
            </tr>
            <tr>
                <td>Judul Laporan</td>
                <td>:</td>
                <td><?php echo "$jdl" ?></td>
            </tr>
        </table><br><br>
        Tanda terima ini dibuat untuk dipergunakan sebagaimana mestinya. Atas perhatian semua pihak yang berkepentingan diucapkan terima kasih.
        <br><br>
        <table style="line-height: 1">
            <tr>
                <td style="white-space: nowrap;overflow: hidden; width: 150px">&nbsp;<br>Penerima</td>
                <td style="white-space: nowrap;overflow: hidden;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td style="white-space: nowrap;overflow: hidden; width: 150px">Malang,.................................<br>Mahasiswa</td>
            </tr>
            <tr><td height="36pt"></td><td></td><td></td></tr>
            <tr>
                <td style="white-space: nowrap;overflow: hidden;"><hr style='border: solid black 1px; width: 100%'></td>
                <td style="white-space: nowrap;overflow: hidden;"></td>
                <td style="white-space: nowrap;overflow: hidden;"><hr align="right" style='border: solid black 1px; width: 80%'></td>
            </tr>
        </table>
        <br><br>
        <hr style='border: solid black 1px; width: 100%'>
        <br>
        <div align="center" style="font-size: 14pt; line-height: 1"><b>TANDA TERIMA PENYERAHAN REVISI LAPORAN</b><br>
        <b>SEMINAR PROPOSAL SKRIPSI</b></div><br>
        Telah terima laporan Revisi Seminar Proposal Skripsi sebanyak 1 (satu) eksemplar dari :
        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?php echo "$nm" ?></td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>:</td>
                <td><?php echo "$ni" ?></td>
            </tr>
            <tr>
                <td>Program Studi/Kelas</td>
                <td>:</td>
                <td><?php echo "$prdi" ?></td>
            </tr>
            <tr>
                <td>Jurusan</td>
                <td>:</td>
                <td><?php echo "$jrs" ?></td>
            </tr>
            <tr>
                <td>Judul Laporan</td>
                <td>:</td>
                <td><?php echo "$jdl" ?></td>
            </tr>
        </table><br><br>
        Tanda terima ini dibuat untuk dipergunakan sebagaimana mestinya. Atas perhatian semua pihak yang berkepentingan diucapkan terima kasih.
        <br><br>
        <table style="line-height: 1">
            <tr>
                <td style="white-space: nowrap;overflow: hidden; width: 150px">&nbsp;<br>Penerima</td>
                <td style="white-space: nowrap;overflow: hidden;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td style="white-space: nowrap;overflow: hidden;">Malang,.................................<br>Mahasiswa</td>
            </tr>
            <tr><td height="36pt"></td><td></td><td></td></tr>
            <tr>
                <td style="white-space: nowrap;overflow: hidden;"><hr style='border: solid black 1px; width: 100%'></td>
                <td style="white-space: nowrap;overflow: hidden;"></td>
                <td style="white-space: nowrap;overflow: hidden;"><hr align="right" style='border: solid black 1px; width: 80%'></td>
            </tr>
        </table>
	</body>
</html>