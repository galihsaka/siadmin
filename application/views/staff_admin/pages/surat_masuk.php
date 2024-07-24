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
                    }  elseif ($this->session->flashdata('warning')) { ?>
                        <div class="alert alert-warning fade in alert-dismissible show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="font-size:20px">×</span>
                            </button>
                            <strong>Warning! </strong> <?= $this->session->flashdata('warning') ?>
                        </div>

                        <?php
                        $this->session->unset_userdata('warning');
                    }
                    ?>
                    <!-- MENAMPILKAN TABEL SURAT AMSUK DALAM DATA-TABLE -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div id="buttonContainer" style="padding-bottom: 20px">
                                <div id="btnContainerLeft" style="float:left; padding-bottom: 10px">
                                    <!-- BUTTON TAMBAH DATA -->
                                    <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#tambah_surat" style="margin-right:16px">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                        <span class="text">Tambah Data</span>
                                    </a>

                                    <!-- BUTTON DATEPICKER UNTUK MENAMPILKAN DATA-TABLE BERDASARKAN TAHUN YANG DIPILIH -->
                                    <a href="#" class="btn btn-primary btn-icon-split" style="margin-right:16px">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>
                                        <span class="text">
                                        <input class="browser-default" type="text" id="dateSuratMasuk" value="<?php echo $year; ?>"
                                            style="width:70px; height:100%; border: none; background-color: rgba(255, 255, 255, 0.603); text-align: center">
                                    </span>
                                    </a>

                                    <!-- BUTTON FILTER -->
                                    <div class="btn btn-primary btn-icon-split" style="margin-right:16px">
                                    <span class="icon text-white-50" style="">
                                        <i class="fas fa-clipboard-list"></i>
                                    </span>
                                        <span class="text select-text" style="padding:0;"></span>
                                    </div>
                                </div>
                                <div style="float:right; padding-bottom: 10px">
                                    <!-- BUTTON TAMBAH DATA KOSONG-->
                                    <a href="<?=base_url('/admin/suratmasuk/add_kosong')?>" class="btn btn-warning btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text">Tambah Agenda</span>
                                    </a>
                                </div>
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

                            <!--Data surat masuk-->
                            <div class="table-responsive">
                                <table class="table table-hover" id="dataSurat" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Nomor Agenda</th>
                                        <th>Nomor Surat</th>
                                        <th>Tanggal Terima</th>
                                        <th>Tanggal Pembuatan Surat</th>
                                        <th>Asal</th>
                                        <th>Perihal</th>
                                        <th>Keterangan</th>
                                        <th>Opsi</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    foreach ($data as $row) {
                                        $terima = $row->tgl_terima;
                                        $tanggal_terima = tgl_indo($terima); //UBAH FORMAT TGL TERIMA
                                        $pembuatan = $row->tgl_pembuatan;
                                        $tanggal_pembuatan = tgl_indo($pembuatan); //UBAH FORMAT TGL_PEMBUATAN
                                        $id_surat = $row->ID;
                                        $id_surat = $this->my_encrypt->custom_encode($id_surat);
                                        $data_encrypt = $this->my_encrypt->custom_encode(json_encode($row));
                                        ?>
                                        <tr>
                                            <td><?php echo $row->no_agenda ?></td>
                                            <td><?php echo $row->no_surat ?></td>
                                            <td><?php echo $tanggal_terima ?></td>
                                            <td><?php echo $tanggal_pembuatan ?></td>
                                            <td><?php echo $row->asal ?></td>
                                            <td><?php echo $row->perihal ?></td>
                                            <td><?php 
                                                    if ($row->kategori == 'Kosong') 
                                                    {
                                                        echo '';
                                                    } 
                                                    else {
                                                        echo $row->kategori;
                                                    }?>
                                            </td>
                                            <td>
                                                <!-- TOMBOL CETAK -->
                                                <a href="javascript: w=window.open('<?= base_url('/admin/suratmasuk/cetak/'.$data_encrypt) ?>'); w.print(); "
                                                   target="_blank" class='btn btn-primary btn-icon-split btn-sm'>
                                                    <span class='icon text-white-50'>
                                                        <i class='fas fa-print'></i>
                                                    </span>
                                                    <span class='text'>Cetak&nbsp;&nbsp;</span>
                                                </a>
                                                <!--TOMBOL EDIT-->

                                                <a href='' class='btn btn-info btn-icon-split btn-sm'
                                                   style='margin-top:5px; margin-bottom: 5px;' data-toggle='modal'
                                                   data-target="#edit_surat<?php echo ($row->ID*-1)-514482753; ?>">
                                                    <span class='icon text-white-50'>
                                                        <i class='fas fa-edit'></i>
                                                    </span>
                                                    <span class='text'>Edit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                </a>
                                                <!-- MODAL EDIT SURAT -->
                                                <div class="modal fade" id="edit_surat<?php echo ($row->ID*-1)-514482753; ?>" tabindex="-1"
                                                     role="dialog"
                                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel"><b>Ubah Surat Masuk</b>
                                                                </h5>
                                                                <button class="close" type="button" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <?php echo form_open('admin/suratmasuk/update/' . $id_surat) ?>

                                                                <div class="alert alert-info">
                                                                    Agenda no <?php echo $row->no_agenda ?>
                                                                </div>
                                                                <table>
                                                                    <tr>
                                                                        <div class="form-group">
                                                                            <td>Tanggal Terima</td>
                                                                            <td><input type="date" required="" name="tgl_terima"
                                                                                       id="tgl_terima" class="form-control"
                                                                                       value="<?php echo $row->tgl_terima ?>"></td>
                                                                        </div>
                                                                    </tr>
                                                                    <tr>
                                                                        <div class="form-group">
                                                                            <td>Tanggal Pembuatan Surat</td>
                                                                            <td><input type="date" required="" name="tgl_pembuatan"
                                                                                       id="tgl_pembuatan" class="form-control"
                                                                                       value="<?php echo $row->tgl_pembuatan ?>"></td>
                                                                        </div>
                                                                    </tr>
                                                                    <tr>
                                                                        <div class="form-group">
                                                                            <td>Nomor Surat</td>
                                                                            <td><input type="text" name="no_surat" id="no_surat"
                                                                                       class="form-control"
                                                                                       value="<?php echo $row->no_surat ?>"></td>
                                                                        </div>
                                                                    </tr>
                                                                    <tr>
                                                                        <div class="form-group">
                                                                            <td>Perihal</td>
                                                                            <td><textarea required="" name="perihal" id="perihal"
                                                                                          cols="30" rows="5"
                                                                                          class="form-control"><?php echo $row->perihal ?></textarea>
                                                                            </td>
                                                                        </div>
                                                                    </tr>
                                                                    <tr>
                                                                        <div class="form-group">
                                                                            <td>Asal</td>
                                                                            <td><input required="" type="text" name="asal" id="asal"
                                                                                       class="form-control"
                                                                                       value="<?php echo $row->asal ?>"></td>
                                                                        </div>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            Keterangan
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <select name="kategori" id="kategori"
                                                                                        class="form-control" required="">
                                                                                    <option value="Kosong">--Pilih--</option>
                                                                                    <option value="Kemahasiswaan" <?php if ($row->kategori == 'Kemahasiswaan') {
                                                                                        echo 'selected';
                                                                                    } ?>>Kemahasiswaan
                                                                                    </option>
                                                                                    <option value="Kepegawaian" <?php if ($row->kategori == 'Kepegawaian') {
                                                                                        echo 'selected';
                                                                                    } ?>>Kepegawaian
                                                                                    </option>
                                                                                    <option value="GPM/SPM" <?php if ($row->kategori == 'GPM/SPM') {
                                                                                        echo 'selected';
                                                                                    } ?>>GPM/SPM
                                                                                    </option>
                                                                                    <option value="Umum" <?php if ($row->kategori == 'Umum') {
                                                                                        echo 'selected';
                                                                                    } ?>>Umum
                                                                                    </option>
                                                                                    <option value="Lainnya" <?php if ($row->kategori == 'Lainnya') {
                                                                                        echo 'selected';
                                                                                    } ?>>Lainnya
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="submit" value="Ubah" class="form-control btn btn-primary">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--MODAL TAMBAH SURAT-->
                                    <div class="modal fade" id="tambah_surat" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"><b>Tambah Surat Masuk</b></h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php echo validation_errors(); ?>
                                                    <?php echo form_open('admin/suratmasuk/add', 'id="formTambah"') ?>
                                                    <table class="table table-hover">
                                                        <tr>
                                                            <div class="form-group">
                                                                <td>Tanggal Terima</td>
                                                                <td><input type="date" name="tgl_terima" id="tgl_terima" class="form-control"
                                                                           value="<?php echo date('Y-m-d'); ?>" required=""></td>
                                                            </div>
                                                        </tr>
                                                        <tr>
                                                            <div class="input-group date">
                                                                <td>Tanggal Pembuatan Surat</td>
                                                                <td><input type="date" name="tgl_pembuatan" id="tgl_pembuatan" class="form-control"></td>
                                                            </div>
                                                        </tr>
                                                        <tr>
                                                            <div class="form-group">
                                                                <td>Nomor Surat</td>
                                                                <td><input type="text" name="no_surat" id="no_surat" class="form-control"></td>
                                                            </div>
                                                        </tr>
                                                        <tr>
                                                            <div class="form-group">
                                                                <td>Perihal</td>
                                                                <td><textarea name="perihal" id="perihal" cols="30" rows="5"
                                                                              class="form-control"></textarea></td>
                                                            </div>
                                                        </tr>
                                                        <tr>
                                                            <div class="form-group">
                                                                <td>Asal</td>
                                                                <td><input type="text" name="asal" id="asal" class="form-control"></td>
                                                            </div>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                Keterangan
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <select name="kategori" id="kategori" class="form-control">
                                                                        <option value="Kosong">--Pilih--</option>
                                                                        <option value="Kemahasiswaan">Kemahasiswaan</option>
                                                                        <option value="Kepegawaian">Kepegawaian</option>
                                                                        <option value="GPM/SPM">GPM/SPM</option>
                                                                        <option value="Umum">Umum</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" value="Tambah" class="btn btn-primary form-control">
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                    <!--AKHIR MODAL TAMBAH SURAT-->
                </div>
 <!-- /.container-fluid -->


<!--<script src="--><?php //echo base_url('js/demo/datatables-demo.js') ?><!--"></script>-->