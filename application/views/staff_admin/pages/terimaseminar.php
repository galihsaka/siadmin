<style>
.btn-icon-split{
	margin: 1px 0px 1px 0px;
	padding:0px;
}
.ikon{
	width:31px
}
.teks{
	width:79.5px;
	text-align:left
}
</style>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div id="buttonContainer" style="padding-bottom: 20px">
                    <div class="btn btn-primary btn-icon-split" style="">
                    <span class="icon text-white-50" style="">
                    <i class="fas fa-calendar-alt"></i>
                </span>
                    <span class="text select-text status" style="padding:0;"></span>
                </div>
            </div>

            <!--
                Data Mahasiswa Yang Mengumpulkan Laporan Skripsi
            -->

            <div class="table-responsive">
                <table class="table table-hover table-sm" id="dataTerimaSeminar" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Prodi</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal Diterima</th>
                        <th>Nilai</th>
                        <th>Opsi</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tbody>
                    <?php
                    function tgl_indo($tanggal, $withday=true)
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

                if($withday){
                    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
                } else {
                    return $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
                }

            } 					
                        foreach ($data as $row) { 
						if($row->status=="Diterima"){
							$color = "#2ecc71";
						}else{
							$color = "#f39c12";
						}
                        ?>
                        <tr>
                            <td><?php echo $row->nim?></td>
                            <td><?php echo $row->nama?></td>
                            <td><?php echo $row->prodi?></td>
                            <td><?php echo $row->judul?></td>
                            <td><?php echo $row->kategori?></td>
                            <td style="color:<?php echo $color?>;font-weight:bold;"><?php echo $row->status?></td>
                            <td><?php if($row->tgl_validasi=="0000-00-00"){
                                echo "Belum Diterima";
                                }
                                else{
                                    echo tgl_indo($row->tgl_validasi);
                                } ?></td>
                            <td><a href="" class="btn btn-info btn-sm" data-toggle="modal"
                                   data-target="#ceknilai<?php echo $row->ID ?>">Lihat Nilai</a>
                                <div id="ceknilai<?php echo $row->ID ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><b>Nilai <?php echo $row->nama . " / " . $row->nim ?></b>
                                                </h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <table style="border-collapse: collapse; padding:0px"
                                                       class="table table-sm table-borderless">
                                                    <tr>
                                                        <td>Nilai Pembimbing 1</td>
                                                        <td>
                                                            <?php echo $row->nilaip1 ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nilai Pembimbing 2</td>
                                                        <td>
                                                            <?php echo $row->nilaip2 ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div></td>
                            <td>
                                <!--TOMBOL VALIDASI-->
								<div class="" style="display:block">
                                <?php
                                if ($row->status=="Diproses") {?>
								<a href='' class='btn btn-primary btn-icon-split btn-sm' data-toggle='modal' data-target="#edit_data<?php echo $row->ID?>">
								<span class="icon text-white-50 ikon">
								<i class='fas fa-edit' ></i>
								</span>
								<span class="text teks">Terima
								</span>
								</a>
                                     
								<?php
                                 }else{?>
									 <a href='' class='btn btn-secondary btn-icon-split btn-sm'  data-toggle='modal' data-target="#batal_data<?php echo $row->ID?>">
								<span class="icon text-white-50 ikon">
								<i class='fas fa-edit' ></i>
								</span>
								<span class="text teks" >Batalkan
								</span>
								</a>
								<?php
								 }
                                ?>
                                <!-- End Tombol Validasi -->
                                <!--TOMBOL NILAI-->

                                    <!--<a href='' class='btn btn-success btn-icon-split btn-sm' data-toggle='modal'
                                            data-target="#nilai<?php echo $row->ID ?>">
											<span class="icon text-white-50ikon">
                                        <i class='fas fa-plus'></i>
										</span>
										<span class="text teks">
										Input Nilai
										</span>
                                    </a>-->
                                    <!-- End Tombol Nilai -->

                                <!--TOMBOL HAPUS-->
                                               
                                <a href='' class='btn btn-danger btn-icon-split btn-sm'  data-toggle='modal' data-target="#hapus_data<?php echo $row->ID ?>" >
                                    <span class="icon text-white-50 ikon">
                                        <i class='fas fa-trash'></i></span>
                                  <span class="text teks">Hapus
								  </span>
                                </a>               
                                <!-- End Tombol Hapus -->
								</div>

                                <!-- MODAL VALIDASI -->
                                <div class="modal fade" id="edit_data<?php echo $row->ID; ?>" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><b>Validasi Pengumpulan Laporan <?php echo $row->kategori?></b></h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>
                                </div>
           
                                <div class="modal-body">
                                <?php echo form_open('admin/serahterima/update/'.$row->ID.'/'.$row->kategori)?>
                                <table style="border-collapse: collapse; padding:0px" class="table table-sm table-borderless">
                                    <tr><td>NIM</td><td><?php echo $row->nim?></td></tr>
                                    <tr><td>Nama</td><td><?php echo $row->nama?></td></tr>
                                    <tr><td>Prodi</td><td><?php echo $row->prodi?></td></tr>
                                    <tr><td>Judul</td><td><?php echo $row->judul?></td></tr>
                                    <tr>
                                                       <td>Nilai Pembimbing 1</td>
                                                       <td><input type="text" name="nila1" required class="form-control"></td>
                                                   </tr>
                                                   <tr>
                                                       <td>Nilai Pembimbing 2</td>
                                                       <td><input type="text" name="nila2" required class="form-control"></td>
                                                   </tr>
                                </table>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" value="Validasi" class="form-control btn btn-success">
                                </div>
                            </div>
                        </div>
                        </form>
                        </div>
                        <!--AKHIR MODAL VALIDASI-->  
						<!-- MODAL BATALKAN VALIDASI -->
                                <div class="modal fade" id="batal_data<?php echo $row->ID; ?>" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><b>Batalkan Validasi Pengumpulan Laporan <?php echo $row->kategori?></b></h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>
                                </div>
           
                                <div class="modal-body">
                                <?php echo form_open('admin/serahterima/cancelupdate/'.$row->ID.'/'.$row->kategori)?>
                                <table style="border-collapse: collapse; padding:0px" class="table table-sm table-borderless">
                                    <tr><td>NIM</td><td><?php echo $row->nim?></td></tr>
                                    <tr><td>Nama</td><td><?php echo $row->nama?></td></tr>
                                    <tr><td>Prodi</td><td><?php echo $row->prodi?></td></tr>
                                    <tr><td>Judul</td><td><?php echo $row->judul?></td></tr>
                                </table>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" value="Batalkan Validasi" class="form-control btn btn-warning">
                                </div>
                            </div>
                        </div>
                        </form>
                        </div>
                        <!--AKHIR MODAL BATALKAN VALIDASI-->

                        <!-- MODAL HAPUS -->
                                <div class="modal fade" id="hapus_data<?php echo $row->ID; ?>" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><b>Hapus Data Laporan <?php echo $row->kategori?></b></h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>
                                </div>
           
                                <div class="modal-body">
                                <?php echo form_open('admin/serahterima/hapus/'.$row->ID.'/'.$row->kategori)?>
                                <table style="border-collapse: collapse; padding:0px" class="table table-sm table-borderless">
                                    <tr><td>NIM</td><td><?php echo $row->nim?></td></tr>
                                    <tr><td>Nama</td><td><?php echo $row->nama?></td></tr>
                                    <tr><td>Prodi</td><td><?php echo $row->prodi?></td></tr>
                                    <tr><td>Judul</td><td><?php echo $row->judul?></td></tr>
                                </table>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" value="Hapus" class="form-control btn btn-danger">
                                </div>
                            </div>
                        </div>
                        </form>
                        </div>
                        <!--AKHIR MODAL VALIDASI-->
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
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
