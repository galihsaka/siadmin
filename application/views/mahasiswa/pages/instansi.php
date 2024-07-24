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
    // MENGATUR FLASHDATA
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
            <div id="buttonContainer" style="padding-bottom: 20px">

                <!-- BUTTON TAMBAH DATA -->
                <a href="<?= base_url('mhs/penelitian_instansi/daftar') ?>"
                   class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                    <span class="text">Ajukan Penelitian</span>
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
                if (substr($pecahkan[2], 0, 1) == 0) {
                    $pecahkan[2] = substr($pecahkan[2], 1);
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
                        <th>Judul Skripsi</th>
                        <th>Nama Instansi</th>
                        <th>Tujuan</th>
                        <th>Alamat Instansi</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Tanggal Penelitian</th>
                        <th>Opsi</th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php
                    foreach ($data as $row) {
                        $mulai = $row->tgl_mulai;
                        $tanggal_mulai = tgl_indo($mulai); //UBAH FORMAT tanggal mulai
                        $akhir = $row->tgl_berakhir;
                        $tanggal_akhir = tgl_indo($akhir); //UBAH FORMAT tanggal_akhir
                        $id = $row->ID;
                        $row_enc = $this->my_encrypt->custom_encode(json_encode($row));
                        
                        ?>
                        <tr>
                            <td><?php echo $row->judul ?></td>
                            <td><?php echo $row->nama_instansi ?></td>
                            <td><?php echo $row->penerima_surat ?></td>
                            <td><?php echo $row->alamat_instansi ?></td>
                            <td><?php echo tgl_indo($row->tgl_buat) ?></td>
                            <td><?php 
							if($tanggal_mulai!==$tanggal_akhir){
								echo $tanggal_mulai.' - '.$tanggal_akhir;
							}else{
								echo $tanggal_mulai;
							}
							?></td>
                            <td>
                                <!-- TOMBOL CETAK -->
                                <a href="<?php if($stat=='Berhasil'){echo base_url('mhs/penelitian_instansi/printdoc/' . $row_enc.'/'.$stat);} ?>" <?php if($stat=="Berhasil"){echo " target='_blank'" ;}?><?php if($stat=='Gagal'){$url="mhs/penelitian_instansi/printdoc/" . $row_enc."/".$stat; echo " data-toggle='modal' data-target='#printinstansi$id'";
                                }?>
                                   class='btn btn-primary btn-icon-split btn-sm'>
                                                                    <span class='icon text-white-50'>
                                                                        <i class='fas fa-print'></i>
                                                                    </span>
                                    <span class='text'>Cetak</span>
                                </a>
                                <div class="modal fade" id="printinstansi<?=$id?>" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><b>Pilih Pembimbing 1</b></h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <?php echo form_open($url) ?>
                                                <table style="border-collapse: collapse; padding:0px"
                                                       class="table table-sm table-borderless">
                                                    <tr>
                                                        <td colspan="2"><div class="alert alert-primary">Pilih dosen pembimbing 1</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pembimbing 1</td>
                                                        <td>
                                                            <select name='pem1' id='pem1' class='form-control'><?php
                                        $this->db_master = $this->load->database('db_master', TRUE);
                                        $query = $this->db_master->query("SELECT * FROM `user` WHERE level='11' OR level='8'");
                                        foreach($query->result() as $data){
                                        echo "<option value='".$data->nama_lengkap."'>".$data->nama_lengkap."</option>";
                                        }?>
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
