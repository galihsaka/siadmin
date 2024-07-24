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
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>

    <?php
    // MENGATUR SESSION SURAT MASUK
    if ($this->session->flashdata('success')) { ?>

        <div class="alert alert-success fade in alert-dismissible show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="font-size:20px">×</span>
            </button>
            <strong>Success!</strong> <?= $this->session->flashdata('success') ?>
        </div>
        <?php

    } elseif ($this->session->flashdata('fail')) { ?>
        <div class="alert alert-danger fade in alert-dismissible show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="font-size:20px">×</span>
            </button>
            <strong>Failed!</strong> <?= $this->session->flashdata('fail') ?>
        </div>
        <?php
    }

    ?>

    <!-- MENAMPILKAN TABEL SURAT AMSUK DALAM DATA-TABLE -->
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

            <!-- FUNCTION UNTUK MENGUBAH FORMAT TANGGL MENJADI FORMAT INDONESIA -->
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
                        <th style="display:none">Bulan Mulai</th>
                        <th style="display:none">Tahun Mulai</th>
                        <th>Opsi</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    foreach ($data as $row) {
                        $mulai = $row->tanggal_mulai;
                        $tanggal_mulai = tgl_indo($mulai); //UBAH FORMAT tanggal mulai
                        $akhir = $row->tanggal_akhir;
                        $tanggal_akhir = tgl_indo($akhir); //UBAH FORMAT tanggal_akhir
                        $id_studi = $row->id;
                        $id_enc = $this->my_encrypt->custom_encode($id_studi);
                        $nim_enc = $this->my_encrypt->custom_encode($row->nim);
						
						if($tanggal_mulai==$tanggal_akhir){
							$tanggal_pelaksanaan=  $tanggal_mulai;
						}else{
							$tanggal_pelaksanaan = $tanggal_mulai." s.d ".$tanggal_akhir;
						}
                        ?>
                        <tr>
                            <td><textarea readonly style="width:120px" onclick="copy(this.id)" id="<?php echo $row->nim ?>"><?php echo $row->nim ?></textarea></td>
                            <td><textarea readonly style="width:120px" onclick="copy(this.id)" id="<?php echo $row->nama ?>"><?php echo $row->nama ?></textarea></td>
                            <td><textarea readonly rows="6" style="width:120px" onclick="copy(this.id)" id="<?php echo $row->prodi ?>"><?php echo $row->prodi ?></textarea></td>
                            <td><textarea readonly rows="6" onclick="copy(this.id)" id="<?php echo $row->judul ?>"><?php echo $row->judul ?></textarea></td>
                            <td><textarea readonly rows="6" onclick="copy(this.id)" id="<?php echo $row->kepada ?>"><?php echo $row->kepada ?></textarea></td>
                            <td><textarea readonly rows="6" onclick="copy(this.id)" id="<?php echo $row->alamat_instansi ?>"><?php echo $row->alamat_instansi ?></textarea></td>
                            <td><textarea readonly rows="6" onclick="copy(this.id)" id="<?php echo $tanggal_pelaksanaan ?>"><?php echo $tanggal_pelaksanaan;?></textarea>	
							</td>
                            <td style="display:none"><?php echo tgl_indo($mulai, false) ?></td>
                            <td style="display: none"><?php echo date('Y', strtotime($row->tanggal_mulai)) ?> </td>
                            <td>
                                <!-- TOMBOL HAPUS -->
                                <a href="" data-target="#hapus_data<?php echo $id_studi . $row->nim ?>"
                                   data-toggle="modal" class='btn btn-danger btn-icon-split btn-sm'>
                                    <span class='icon text-white-50'>
                                        <i class='fas fa-trash'></i>
                                    </span>
                                    <span class="text">Hapus
                                    </span>
                                </a>
                                <!-- MODAL HAPUS DATA -->
                                <div class="modal fade" id="hapus_data<?php echo $id_studi . $row->nim ?>" tabindex="-1"
                                     role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><b>Hapus Data Studi
                                                        Lapangan?</b>

                                                </h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <?php echo form_open('admin/penelitian/hapus_studilapangan/' . $id_enc . '/' . $nim_enc) ?>
                                            <div class="modal-body">
                                                <table class="table table-sm">
                                                    <tr>
                                                        <td>Nama / NIM</td>
                                                        <td><?php echo $row->nama . " / " . $row->nim ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Judul</td>
                                                        <td><?php echo $row->judul ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tujuan</td>
                                                        <td>
                                                            <b><?php echo $row->kepada ?></b><br><?php echo $row->alamat_instansi ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tanggal Pelaksanaan</td>
                                                        <td><?php echo $tanggal_mulai ?>
                                                            s.d <?php echo $tanggal_akhir ?></td>
                                                    </tr>

                                                </table>

                                            </div>

                                            <div class="modal-footer">
                                                <input type="submit" value="Hapus" class="form-control btn btn-danger">
                                            </div>
                                            </form>
                                        </div>
                                    </div>

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


