<?php
/**
 * Created by PhpStorm.
 * User: Syarif
 * Date: 01-Jul-19
 * Time: 8:54 AM
 */
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>

    <!-- MENAMPILKAN TABEL SURAT AMSUK DALAM DATA-TABLE -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div id="buttonContainer" style="padding-bottom: 20px">

                <!-- BUTTON TAMBAH DATA -->
                <a href="<?= base_url('observasi/studilapangan/daftarstudilapangan') ?>"
                   class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                    <span class="text">Ajukan Studi Lapangan</span>
                </a>
            </div>
            <!-- FUNCTION UNTUK MENGUBAH FORMAT TANGGL MENJADI FORMAT INDONESIA -->
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

            ?>

            <!--
                Data surat masuk
            -->

            <div class="table-responsive">
                <table class="table table-hover" id="dataLapangan" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Matakuliah</th>
                        <th>Judul Studi Lapangan</th>
                        <th>Instansi Tujuan</th>
                        <th>Alamat Instansi</th>
                        <th>Kepada</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Tanggal Pelaksanaan</th>
                        <th>Opsi</th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php
                    foreach ($data as $row) {

                        $mulai = $row['instansi']->tanggal_mulai;
                        $tanggal_mulai = tgl_indo($mulai); //UBAH FORMAT tanggal mulai
                        $ajukan = $row['instansi']->tgl_buat;
                        $tanggal_ajukan = tgl_indo($ajukan); //UBAH FORMAT tanggal mulai
                        $akhir = $row['instansi']->tanggal_akhir;
                        $tanggal_akhir = tgl_indo($akhir); //UBAH FORMAT tanggal_akhir
                        $id_studi = $row['instansi']->id;
                        $encodeData = $this->my_encrypt->custom_encode(json_encode($row));
                        ?>

                        <tr>
                            <td><?php echo $row['instansi']->mata_kuliah?></td>
                            <td><?php echo $row['instansi']->judul ?></td>
                            <td><?php echo $row['instansi']->instansi_tujuan ?></td>
                            <td><?php echo $row['instansi']->alamat_instansi ?></td>
                            <td><?php echo $row['instansi']->kepada ?></td>
                            <td><?php echo $tanggal_ajukan ?></td>
                            <td>
								<?php
									if($tanggal_mulai==$tanggal_akhir){
										echo $tanggal_mulai;
									}else{
										echo $tanggal_mulai." - ".$tanggal_akhir;
									}
								?>
							</td>
                            <td>
                                <!-- TOMBOL CEK ANGGOTA -->
                                <a href="" class="btn btn-info btn-icon-split btn-sm"
                                   style="margin-top:5px; margin-bottom: 5px;"
                                   data-toggle="modal" data-target="#cekAnggota<?= $id_studi ?>">
                                    <span class='icon text-white-50'>
                                        <i class='fas fa-table'></i>
                                    </span>
                                    <span class='text'>Cek Anggota</span>
                                </a>
                                <!-- TOMBOL CETAK -->
                                <a href="" data-toggle='modal' data-target="#print<?= $id_studi ?>" 
                                   class='btn btn-primary btn-icon-split btn-sm'>
                                            <span class='icon text-white-50'>
                                                <i class='fas fa-print'></i>
                                            </span>
                                    <span class='text'>Cetak&nbsp;&nbsp;</span>
                                </a>
                                 <!-- MODAL CETAK -->
                                <div class="modal fade" id="print<?= $id_studi ?>" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><b>Pilih Penandatangan</b></h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <?php echo form_open('observasi/studilapangan/printdoc/'.$encodeData) ?>
                                                <table style="border-collapse: collapse; padding:0px"
                                                       class="table table-sm table-borderless">
                                                    <tr>
                                                        <td colspan="2"><div class="alert alert-primary">Pada Surat Studi Lapangan harus terdapat tanda tangan asli dari Ketua Jurusan, namun anda dapat meminta tanda tangan Sekretaris Jurusan apabila Ketua Jurusan berhalangan</div></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Penandatangan</td>
                                                        <td>
                                                            <select name="vlds">
                                                                <option value="kajur">Ketua Jurusan</option>
                                                                <option value="sekjur">Sekretaris Jurusan</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" value="Cetak" formtarget="_blank" 
                                                       class="form-control btn btn-primary">
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <!-- MODAL EDIT SURAT -->
                                <div class="modal fade" id="cekAnggota<?= $id_studi; ?>" tabindex="-1"
                                     role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><b>Anggota Studi
                                                        Lapangan</b></h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <table>
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>NIM</th>
                                                        <th>Nama</th>
                                                        <th>Prodi</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php
                                                    $i = 1;
                                                    foreach ($row['anggota'] as $key) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $i ?></td>
                                                            <td><?= $key->nim ?></td>
                                                            <td><?= $key->nama ?></td>
                                                            <td><?= $key->prodi ?></td>
                                                        </tr>
                                                        <?php
                                                        $i++;
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
    <!-- /.container-fluid -->

