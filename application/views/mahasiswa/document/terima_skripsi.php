<html>
	<head>
		<title>Izin Penelitian</title>
		<style type="text/css">
			@page {margin :0px;}
            table {
            page-break-inside: avoid;
        }
	</style>
	</head>
	<?php
        	$nm="Galih Saka Diantama";
            $prdi="S1 Pendidikan Teknik Informatika";
            $tgluji="19 Juli 2021";
            $jdl="Perbedaan kemampuan pemecahan masalah mata pelajaran piranti sesor aktuator dengan penerapan model pembelajaran problem posing dan probing prompting pada siswa kelas xi teknik otomasi industri smk negeri 1 singisari";
            $ni="170533628506";
            $kalab="Harits Ar Rosyid, S.T., M.T., Ph.D.";
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
        	$jml=1;
        	$sekolah=array();
        	$alamat=array();
        	for ($i=0; $i < $jml; $i++) { 
        		$sekolah[$i]="SMK Negeri 6 Malang";
        		$alamat[$i]="Jl. Ki Ageng Gribik No. 28, Kedungkandang, Kota Malang";
        	}
        	if($jml>1){
        		$tujuan="<b>Terlampir</b>";
        	}
        	else{
        		$tujuan=$sekolah[0];
        	}
        	?>
	<body style="margin-top:1.5cm;margin-right: 2cm;margin-left: 3cm;margin-bottom: 0cm; font-size: 10.5pt">
		<table style="width: 101%; margin-left: -50px;">
        <tr>
            <td style="width: 2.5cm"><img src="assets/logo.png" alt="" style="height:2.5cm; width: 2.5cm; padding-left: 10px"></td>
            <td style='vertical-align:top; font-size: 14pt; text-align: center; line-height: 1'>
                KEMENTERIAN RISET,TEKNOLOGI, DAN PENDIDIKAN TINGGI
                <br> UNIVERSITAS NEGERI MALANG (UM)
                <br> FAKULTAS TEKNIK
                <br>JURUSAN TEKNIK ELEKTRO <br>
                <b>LABORATORIUM JURUSAN TEKNIK ELEKTRO <br></b>
                <span style='font-size:12pt'> Jalan Semarang 5, Malang 65145 <br>
                    Telepon: (0341) 7044470, 573090<br>
                    Laman:www.elektro.um.ac.id <br>
                    </span>
            </td>
        </tr>
    </table>
        <hr style='border: solid black 1.5pt'>
        <div align="center"><b>BUKTI PENYERAHAN</b><br>
        <b>KARYA TUGAS AKHIR/SKRIPSI*)</b></div>
        <table style="vertical-align: top">
        	<tr>
        		<td style="width: 110px">Nama Mahasiswa</td>
        		<td style="width: 10px">:</td>
        		<td><?php echo "$nm" ?></td>
        	</tr>
        	<tr>
        		<td>Nomer Induk</td>
        		<td>:</td>
        		<td><?php echo "$ni" ?></td>
        	</tr>
        	<tr>
        		<td>Program Studi</td>
        		<td>:</td>
        		<td><?php echo "$prdi" ?></td>
        	</tr>
        	<tr>
        		<td>Tanggal Ujian</td>
        		<td>:</td>
        		<td><?php echo "$tgluji" ?></td>
        	</tr>
        	<tr>
        		<td>Judul Laporan</td>
        		<td>:</td>
        		<td><?php echo "$jdl" ?></td>
        	</tr>
            <br>
        </table>
        Sudah menyerahkan karya tugas akhir/skripsi yang meliputi :
        <table width="100%" cellpadding="0" cellspacing="0" border="1" style="margin-top: -15px">
            <tr>
                <th align="center">NO</th>
                <th align="center">KARYA SKRIPSI/TUGAS AKHIR</th>
                <th align="center">OPERASIONAL</th>
            </tr>
            <tr>
                <td align="center">1</td>
                <td style="padding-left: 2px">PRODUK (ALAT/WEB) <span style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                <td style="padding-left: 2px; padding-bottom: 10px;padding-top: 10px">Diterima Tanggal,........................................<br>Oleh Laboran <br><br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(...........................................)</td>
            </tr>
            <tr>
                <td align="center">2</td>
                <td style="padding-left: 2px">SURAT KETERANGAN BEBAS LAB <span style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                <td rowspan="10" style="padding-left: 2px">Diterima Tanggal,........................................<br>Oleh Staf Admin <br><br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(...........................................)</td>
            </tr>
            <tr>
                <td align="center">3</td>
                <td style="padding-left: 2px">CD SOFTCOPY MODUL/JOBSHEET/BAHAN AJAR <span style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
            </tr>
            <tr>
                <td align="center">4</td>
                <td style="padding-left: 2px">LAPORAN <span style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
            </tr>
            <tr>
                <td align="center">5</td>
                <td style="padding-left: 2px">CD LAPORAN <span style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
            </tr>
            <tr>
                <td align="center">6</td>
                <td style="padding-left: 2px">UPLOAD ARTIKEL <span style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
            </tr>
            <tr>
                <td align="center">7</td>
                <td style="padding-left: 2px">UPLOAD BERKAS COVER <span style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
            </tr>
            <tr>
                <td align="center">8</td>
                <td style="padding-left: 2px">UPLOAD LEMBAR PENGESAHAN <span style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
            </tr>
            <tr>
                <td align="center">9</td>
                <td style="padding-left: 2px">UPLOAD LEMBAR PERSETUJUAN <span style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
            </tr>
            <tr>
                <td align="center">10</td>
                <td style="padding-left: 2px">UPLOAD ABSTRAK <span style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
            </tr>
            <tr>
                <td align="center">11</td>
                <td style="padding-left: 2px">UPLOAD KARTU BIMBINGAN <span style="border:solid black 1px">&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
            </tr>
        </table>
        Demikian surat bukti ini untuk digunakan sebagaimana mestinya.<br><br>
        <table>
            <tr>
                <td style="white-space: nowrap;overflow: hidden;">Mengetahui,<br>Dosen Pembimbing I</td>
                <td style="white-space: nowrap;overflow: hidden;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td style="white-space: nowrap;overflow: hidden;">Mengetahui,<br>Dosen Pembimbing II</td>
            </tr>
            <tr><td height="27pt"></td><td></td><td></td></tr>
            <tr>
                <td style="white-space: nowrap;overflow: hidden;">(.........................................................)</td>
                <td style="white-space: nowrap;overflow: hidden;"></td>
                <td style="white-space: nowrap;overflow: hidden;">(.........................................................)</td>
            </tr><tr><td>&nbsp;</td><td></td><td></td></tr>
            <tr>
                <td style="white-space: nowrap;overflow: hidden;">Mengetahui,<br>Kepala Laboratorium,</td>
                <td style="white-space: nowrap;overflow: hidden;"></td>
                <td style="white-space: nowrap;overflow: hidden;">Malang,……………….......................<br>Yang menyerahkan,</td>
            </tr>
            <tr><td height="27pt"></td><td></td><td></td></tr>
            <tr>
                <td style="white-space: nowrap;overflow: hidden;">(<?php echo "$kalab";?>)</td>
                <td style="white-space: nowrap;overflow: hidden;"></td>
                <td style="white-space: nowrap;overflow: hidden;">(.........................................................)</td>
            </tr>
        </table><br>
        <div style="font-size: 9pt; margin-top: -15px">*) Coret salah satu yang tidak perlu<br>
NB : BUKTI INI UNTUK PENJAJAKAN KELULUSAN, TIDAK BOLEH HILANG<br>
Asli untuk mahasiswa, Fotocopi untuk sekretariat Jurusan</div>
	</body>
</html>