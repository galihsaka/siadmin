<html>
	<head>
		<title>Penelitian_<?php echo $nim?>.pdf</title>
		<style type="text/css">	
			@page {margin :0px;}
			td{vertical-align: top;}
			table{
            page-break-inside: avoid;
        }
	</style>
	</head>
	<body style="margin-top:2cm;margin-right: 2cm;margin-left: 3cm;margin-bottom: 2cm; font-size: 13;font-family: 'Times New Roman', Times, serif;">
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
                if(substr($pecahkan[2], 0, 1)==0){
                                   $pecahkan[2]=substr($pecahkan[2], 1);
                               }
                return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
            }
        $tanggal=tgl_indo($tgl_buat);
		$tgl_mul=tgl_indo($tgl_mulai);
        $tgl_akh=tgl_indo($tgl_akhir);
		if($tgl_mulai!==$tgl_akhir){
			$waktu="$tgl_mul"." s.d "."$tgl_akh"; 
		}
		else{
			$waktu = $tgl_mul;
		}
        
		?>
		<div style="line-height: 1.5">Yth. Ketua Jurusan Teknik Elektro<br>
		Fakultas Teknik Universitas Negeri Malang<br>
		Jl. Semarang 5 Malang</div>
		<br><br>
		<div style="line-height: 1.5; text-align:justify">Dalam rangka menyelesaikan studi mahasiswa pada Program Studi <?php echo "$prodi"; ?> Jurusan Teknik Elektro Fakultas Teknik Universitas Negeri Malang, Kami mohon dengan hormat mahasiswa dibawah ini diberikan izin untuk melaksanakan penelitian di Jurusan Teknik Elektro Fakultas Teknik Universitas Negeri Malang.
		<br><br>Mahasiswa tersebut adalah : </div><br>
		<table border= "1" cellpadding="0" cellspacing="0" style="width: 100%">
			<tr>
				<td align="center">No</td>
				<td align="center">Nama / NIM</td>
				<td align="center">Judul <?php echo "$jenjang"; ?></td>
			</tr>
			<tr>
				<td style="padding: 5px">1.</td>
				<td style="padding: 5px"><?php echo "$nama_mhs / $nim"; ?></td>
				<td style="padding: 5px"><?php echo "$judul"; ?></td>
			</tr>
		</table>
		<br><br>
		Waktu: <?php echo "$waktu"; ?>
		<br><br>
		Atas perhatiannya kami ucapkan terimakasih.
		<br><br><br><br><br><br>
<table>
			<tr>
				<td style="white-space: nowrap;overflow: hidden;width: 300px">Mengetahui,</td>
				<td style="white-space: nowrap;overflow: hidden;padding-left: 10px">Malang, <?php echo "$tanggal"; ?></td>
			</tr>
			<tr>
				<td style="white-space: nowrap;overflow: hidden">Pembimbing I</td>
				<td style="white-space: nowrap;overflow: hidden;padding-left: 10px">Mahasiswa Ybs,</td>
			</tr>
			<tr><td height="48pt"></td><td></td></tr>
			<tr>
				<td style="white-space: nowrap;overflow: hidden"><?php if($stat=='Berhasil'){echo $pem_1->nama_dosen;}elseif($stat=='Gagal') {echo $pem_1['nama_dosen'];} ?></td>
				<td style="white-space: nowrap;overflow: hidden;padding-left: 10px"><?php echo "$nama_mhs"; ?></td>
			</tr>
			<tr>
				<td style="white-space: nowrap;overflow: hidden">NIP. <?php if($stat=='Berhasil'){echo $pem_1->nip;}elseif($stat=='Gagal') {echo $pem_1['nip'];} ?></td>
				<td style="white-space: nowrap;overflow: hidden;padding-left: 10px">NIM. <?php echo "$nim"; ?></td>
			</tr>
		</table>
	</body>
</html>