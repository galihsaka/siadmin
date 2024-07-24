<html>
	<head>
		<title>Disposisi_<?php echo $no_agenda."_".$thn ?></title>
		<style type="text/css">
			@font-face {
			font-family: 'Disposisi';
			font-weight: normal;
			src: url("<?=base_url('assets/fonts/Maiandra GD Bold.ttf')?>");
			}
			@font-face {
			font-family: 'Disposisi-bold';
			font-weight: normal;
			src: url("<?=base_url('assets/fonts/Maiandra GD Regular.ttf')?>");
			}
		    @page {
                margin :0;
            }

    	</style>
	</head>
	<body style="margin-top:0.75cm;margin-left: 0.5cm;margin-bottom: 0.5cm; font-family: 'Disposisi'; ">
		<div style="text-align:center; font-size: 11pt; font-family: Disposisi-bold; line-height: 1;">
			UNIVERSITAS NEGERI MALANG <br>
			FAKULTAS TEKNIK - JURUSAN TEKNIK ELEKTRO <br>
			<u>LEMBAR DISPOSISI</u><br><br>
		</div>
		<table style="border-collapse: collapse; width: 100%; margin-right: 20px; border: 1px solid black; border-bottom: none">
			<tr>
				<td width="15%"  align="center" style="font-size: 9pt; border-right: 1px solid black;border-bottom: 1px solid black">Rahasia</td>
				<td width="4%"  style="border-right: 1px solid black; border-bottom: 1px solid black"></td>
				<td width="15%"   align="center" style="font-size: 9pt; border-right: 1px solid black; border-bottom: 1px solid black">Penting</td>
				<td width="4%" style="border-right: 1px solid black; border-bottom: 1px solid black"></td>
				<td width="15%"   align="center" style="font-size: 9pt; border-right: 1px solid black; border-bottom: 1px solid black">Rutin</td>
				<td width="4%"  style="border-right: 1px solid black; border-bottom: 1px solid black"></td>
				<td width="15%"   align="center" style="font-size: 9pt; border-right: 1px solid black; border-bottom: 1px solid black">Segera</td>
				<td width="4%"  style="border-right: 1px solid black; border-bottom: 1px solid black"></td>
				<td width="20%"  align="center" style="font-size: 9pt; border-right: 1px solid black; border-bottom: 1px solid black">Amat Segera</td>
				<td width="4%"  style="border-right: 1px solid black; border-bottom: 1px solid black"></td>
			</tr>
		</table>
		<table width="100%" cellpadding="0" cellspacing="0" style="border: 1px solid black; margin-right: 20px; border-top: none">
			<tr>
				<td height="30px" width="70px" style="font-size: 9pt; border-bottom: 1px solid black; ">&nbsp;Tgl. Terima</td>
				<td style="font-size: 9pt; border-bottom: 1px solid black">:</td>
				<td colspan="3" style="font-size: 9pt; border-bottom: 1px solid black"><?php echo "$tgl_terima"; ?></td>
				<td style="border-bottom: 1px solid black"></td>
				<td style="border-bottom: 1px solid black"></td>
				<td colspan="3" style="font-size: 9pt; border-bottom: 1px solid black;padding-left: 70px">Agenda No.:&nbsp;<?php echo "$no_agenda"; ?></td>
			</tr>
			<tr>
				<td height="30px" style="font-size: 9pt">&nbsp;No. Surat</td>
				<td style="font-size: 9pt">:</td>
				<td colspan="3" style="font-size: 9pt"><?php echo "$no"; ?></td>
				<td></td>
				<td></td>
				<td colspan="3" style="font-size: 9pt; padding-left: 70px"><?php echo "$tgl_buat"; ?></td>
			</tr>
			<tr style="font-size: 9pt;">
				<td height="30px" style=" vertical-align: top">&nbsp;Hal</td>
				<td style="vertical-align: top">:</td>
				<td colspan="8" ><?php echo "$hal"; ?></td>
			</tr>
			<tr style="font-size: 9pt;">
				<td height="30px">&nbsp;Asal</td>
				<td>:</td>
				<td colspan="8"><?php echo "$asal"; ?></td>
			</tr>
		</table>
		<table width="100%" style="font-size: 9pt;border-style: solid; border-color: black; border-width: 1px; border-collapse: collapse; margin-right: 20px; line-height: 10px; margin-top: 15px">
			<tr>
				<td colspan="4" style=" font-family: Disposisi-bold; line-height: 15px">&nbsp;Disposisi dari:</td>
			</tr>
			<tr >
				<td style=" border: 1px solid black; " width="190px">&nbsp;Ketua Jurusan TE</td>
				<td style=" border: 1px solid black"></td>
				<td style=" border: 1px solid black" width="175px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td style=" border: 1px solid black"></td>
			</tr>
			<tr>
				<td style=" border: 1px solid black" width="175px">&nbsp;Sekretaris Jurusan TE</td>
				<td></td>
				<td style=" border: 1px solid black" width="175px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td style=" border: 1px solid black"></td>
			</tr>
			<tr>
				<td style=" border: 1px solid black" width="175px">&nbsp;Kepala Lab. Jurusan TE</td>
				<td style=" border: 1px solid black"></td>
				<td style="border: 1px solid black" width="175px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td style=" border: 1px solid black"></td>
			</tr>
		</table>
		<table width="100%" style="border: 1px solid black; border-collapse: collapse; margin-top: 15px; margin-right: 20px; line-height: 10px; margin-bottom: 15px; font-size: 9pt">
			<tr><td colspan="6" style="font-family: Disposisi-bold; line-height: 15px; vertical-align: middle">&nbsp;Disposisi Kepada:</td></tr>
			<tr>
				<td style="border: 1px solid black" width="25px" align="center">No.</td>
				<td style="border: 1px solid black" width="165px" align="center">Nama</td>
				<td style="border: 1px solid black"></td>
				<td style="border: 1px solid black" width="25px" align="center">No.</td>
				<td style="border: 1px solid black" width="150px" align="center">Nama</td>
				<td style="border: 1px solid black"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black" width="20px" align="center">1.</td>
				<td style="border: 1px solid black" width="155px" align="center"></td>
				<td style="border: 1px solid black"></td>
				<td style="border: 1px solid black" width="20px" align="center">6.</td>
				<td style="border: 1px solid black" width="155px" align="center"></td>
				<td style=" border: 1px solid black"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black" width="20px" align="center">2.</td>
				<td style="border: 1px solid black" width="155px" align="center"></td>
				<td style="border: 1px solid black"></td>
				<td style="border: 1px solid black" width="20px" align="center">7.</td>
				<td style="border: 1px solid black" width="155px" align="center"></td>
				<td style="border: 1px solid black"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black" width="20px" align="center">3.</td>
				<td style="border: 1px solid black" width="155px" align="center"></td>
				<td style="border: 1px solid black"></td>
				<td style="border: 1px solid black" width="20px" align="center">8.</td>
				<td style="border: 1px solid black" width="155px" align="center"></td>
				<td style="border: 1px solid black"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black" width="20px" align="center">4.</td>
				<td style="border: 1px solid black" width="155px" align="center"></td>
				<td style="border: 1px solid black"></td>
				<td style="border: 1px solid black" width="20px" align="center">9.</td>
				<td style="border: 1px solid black" width="155px" align="center"></td>
				<td style="border: 1px solid black"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black" width="20px" align="center">5.</td>
				<td style="border: 1px solid black" width="155px" align="center"></td>
				<td style="border: 1px solid black"></td>
				<td style="border: 1px solid black" width="20px" align="center">10.</td>
				<td style="border: 1px solid black" width="155px" align="center"></td>
				<td style="border: 1px solid black"></td>
			</tr>
		</table>
		<table width="100%" style="border-collapse: collapse; border: 1px solid black; margin-right: 20px; line-height: 12px" \>
			<tr>
				<td style="font-size: 9pt; padding-left: 5px" width="175px">Diproses/ditindaklanjuti/dijawab</td>
				<td  style=" border: 1px solid black"></td>
				<td style="font-size: 9pt; padding-left: 5px" width="175px">Dipertimbangkan</td>
				<td  style=" border: 1px solid black"></td>
			</tr>
			<tr>
				<td style="font-size: 9pt; padding-left: 5px; border: 1px solid black" width="175px">Disiapkan jawaban/dijawab</td>
				<td  style=" border: 1px solid black"></td>
				<td style="font-size: 9pt; padding-left: 5px; border: 1px solid black" width="175px">Diketahui/dimonitor</td>
				<td  style=" border: 1px solid black"></td>
			</tr>
			<tr>
				<td style="font-size: 9pt; padding-left: 5px" width="175px">Dibuatkan surat penugasan/ijin</td>
				<td  style=" border: 1px solid black"></td>
				<td style="font-size: 9pt; padding-left: 5px" width="175px">Dicatat/diarsipkan</td>
				<td  style=" border: 1px solid black"></td>
			</tr>
			<tr>
				<td style="font-size: 9pt; padding-left: 5px; border: 1px solid black" width="175px">Tanda terima kasih/kirim</td>
				<td style=" border: 1px solid black"></td>
				<td style="font-size: 9pt; padding-left: 5px; border: 1px solid black" width="175px">Digandakan/difotocopy</td>
				<td style=" border: 1px solid black"></td>
			</tr>
			<tr>
				<td style="font-size: 9pt; padding-left: 5px" width="190px">Harap kami diberi pertimbangan</td>
				<td style=" border: 1px solid black"></td>
				<td style="font-size: 9pt; padding-left: 5px" width="175px">Bahan diedarkan kepada</td>
				<td  style=" border: 1px solid black"></td>
			</tr>
		</table>
		<table width="100%" cellpadding="0" cellspacing="0" style="border: 1px solid black; margin-top: 15px; margin-right: 20px">
			<tr>
				<td  align="center" style="font-size: 9pt">Catatan</td>
			</tr>
			<tr><td height="110px"></td></tr>
		</table>

	</body>

</html>