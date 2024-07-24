<!-- Begin Page Content -->
<style>
textarea{
	border:none;
	background-color:transparent;
	color:#858796;
	width:auto;
	resize:none;
	overflow:hidden;
	
}
</style>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <!--Kumpulan Button-->
            <div id="buttonContainer" style="padding-bottom: 20px">
                <!-- BUTTON FILTER -->
                <div class="btn btn-primary btn-icon-split" style="">
                                <span class="icon text-white-50" style="">
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                    <span class="text select-text bulan" style="padding:0;"></span>
                </div>
                <!-- BUTTON FILTER -->
                <div class="btn btn-primary btn-icon-split" style="">
                                <span class="icon text-white-50" style="">
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                    <span class="text select-text tahun" style="padding:0;"></span>
                </div>
            </div>
            <!--End Kumpulan Button-->
            <?php
            function tgl_indo($tanggal, $withday = true)
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

                if ($withday) {
                    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
                } else {
                    return $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
                }

            }

            ?>

            <!--
                Data surat masuk
            -->

            <div class="table-responsive">
                <table class="table table-hover" id="dataObservasi" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Prodi</th>
                        <th>Judul</th>
                        <th>Tujuan</th>
                        <th>Alamat Instansi</th>
                        <th>Tanggal Pelaksanaan</th>
                        <th style="display: none">Bulan Mulai</th>
                        <th style="display: none">Tahun Mulai</th>
                        <th>Opsi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($query as $row) {
                        $tgl_mulai = $row->tgl_mulai;
                        $tanggal_mulai = tgl_indo($tgl_mulai);
                        $tgl_berakhir = $row->tgl_berakhir;
                        $tanggal_berakhir = tgl_indo($tgl_berakhir);
                        $kategori = $this->my_encrypt->custom_encode($row->kategori);
                        $id = $this->my_encrypt->custom_encode($row->ID);
						
						if($tanggal_mulai==$tanggal_berakhir){
							$tgl_pelaksanaan=$tanggal_mulai;
						}else{
							$tgl_pelaksanaan = $tanggal_mulai . " s.d " . $tanggal_berakhir;
						}
                        ?>
                        <tr>
                            <td>
							<textarea style="width:120px"  readonly onclick="copy(this.id)" id="<?php echo $row->nim ?>"><?php echo $row->nim ?></textarea>
							</td>
                            <td>
							<textarea style="width:120px" rows="6" readonly onclick="copy(this.id)" id="<?php echo $row->nama ?>"><?php echo $row->nama ?></textarea>
							</td>
                            <td>
								<textarea style="width:120px" rows="6" readonly onclick="copy(this.id)" id="<?php echo $row->prodi ?>"><?php echo $row->prodi ?></textarea>
							</td>
                            <td><textarea rows="6"  readonly onclick="copy(this.id)" id="<?php echo $row->judul ?>"><?php echo $row->judul ?></textarea>
							</td>
                            <td><textarea rows="6" readonly onclick="copy(this.id)" id="<?php echo $row->penerima_surat ?>"><?php echo $row->penerima_surat ?></textarea></td>
                            <td><textarea readonly onclick="copy(this.id)" id="<?php echo $row->alamat_instansi ?>"><?php echo $row->alamat_instansi ?></textarea></td>
                            <td><textarea  readonly onclick="copy(this.id)" id="<?php echo $tgl_pelaksanaan ?>"><?php echo $tgl_pelaksanaan?></textarea>
							</td>
                            <td style="display:none"><?php echo tgl_indo($tgl_mulai, false) ?></td>
                            <td style="display: none"><?php echo date('Y', strtotime($row->tgl_mulai)) ?> </td>
                            <td>
                                <!--TOMBOL HAPUS-->

                                <a href='' class='btn btn-danger btn-icon-split btn-sm'
                                   style='margin-top:5px; margin-bottom: 5px;' data-toggle='modal'
                                   data-target="#hapus_data<?php echo ($row->ID * (-1)) - 514482753; ?>">
                                    <span class='icon text-white-50'>
                                        <i class='fas fa-trash'></i>
                                    </span>
									<span class="text">Hapus
									</span>
                                </a>
                                <!-- End Tombol Hapus -->

                                <!-- MODAL HAPUS DATA -->
                                <div class="modal fade" id="hapus_data<?php echo ($row->ID * (-1)) - 514482753; ?>"
                                     tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><b>Hapus Data
                                                        Penelitian?</b></h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">

                                                <?php echo form_open('admin/penelitian/hapus_izinpenelitian/' . $id . '/' . $kategori) ?>
                                                <div>
                                                    <table style="border-collapse: collapse; padding:0px"
                                                           class="table-sm">
                                                        <tr>
                                                            <td>Nama / NIM</td>
                                                            <td><?php echo $row->nama ?> / <?php echo $row->nim ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Prodi</td>
                                                            <td><?php echo $row->prodi ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="vertical-align: top">Judul</td>
                                                            <td><?php echo $row->judul ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="vertical-align: top">Tujuan</td>
                                                            <td>
                                                                <b><?php echo $row->penerima_surat ?></b><br><?php echo $row->alamat_instansi ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="vertical-align: top">Waktu Penelitian</td>
                                                            <td><?php echo $tanggal_mulai . " s.d " . $tanggal_berakhir ?></td>
                                                        </tr>
                                                    </table>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" value="Hapus" class="form-control btn btn-danger">
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <!--AKHIR MODAL HAPUS DATA-->
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<script>
	function copy(nim) {
		var copyText = document.getElementById(nim);
		copyText.select();
		document.execCommand("copy");
		alert("Teks Berhasil Disalin : \n" + copyText.value);
	} 
</script>



