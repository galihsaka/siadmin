<?php
switch($data_ticket->id_sistem){
        case "1":
            $layanan = "Praktik Industri";
            break;
            case "2":
            $layanan = "Skripsi dan Tugas Akhir";
            break;
            case "3":
            $layanan = "Perpustakaan";
            break;
            case "4":
            $layanan = "Administrasi";
            break;
            case "5":
            $layanan = "Jaringan Internet";
            break;
            case "6":
            $layanan = "Lainnya";
            break;
        default:
            $kepada = "";
    }
    switch($data_ticket->tujuan_ticket){
        case "1":
            $kepada = "Bagian Teknis";
            break;
        case "2":
            $kepada = "Bagian Administrasi";
            break;
        case "3":
            $kepada = "Kepala Laboratorium (Bidang Umum)";
            break;
        case "4":
            $kepada = "Koordinator PI";
            break;
        default:
            $kepada = "";
    }

    switch($data_ticket->urgensi){
        case "1":
            $urgensi = "<span class=\"badge badge-danger\">Tinggi</span>";
            break;
        case "2":
            $urgensi = "<span class=\"badge badge-warning\">Sedang</span>";
            break;
        case "3":
            $urgensi = "<span class=\"badge badge-success\">Rendah</span>";
            break;
        default:
            $urgensi = "";
    }

    switch($data_ticket->status_ticket){
        case "1":
            $status = "<span class=\"badge badge-primary\">Open</span>";
            break;
        case "2":
            $status = "<span class=\"badge badge-info\">Reply by Member</span>";
            break;
        case "3":
            $status = "<span class=\"badge badge-warning\">Reply by Petugas</span>";
            break;
        case "4":
            $status = "<span class=\"badge badge-success\">Solved</span>";
            break;
        case "5":
            $status = "<span class=\"badge badge-default\">Closed (Solved)</span>";
            break;
        default:
            $status = "";
    }
?>

<!--main content start-->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Ticket Support #<?php echo $title ?></h1>
    <a href="<?= base_url('ticket/statusAdm'); ?>" class="btn btn-default"><div class="alert alert-primary"><i class="fa fa-arrow-left"></i> Kembali</div></a>
    <div class="row">
        <div class="col-md-12">
    <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary">Info Ticket Support</h4>
                </div>

        <div class="card-body">
            <!-- Message -->
            <?php
            function tgl($tanggal)
                {
                    $pecahkan = explode('-', $tanggal);
                    $pec= explode(' ', $pecahkan[2]);
                    return $pec[0] . '-' . $pecahkan[1] . '-' . $pecahkan[0].' '.$pec[1];
                }
                $info = $this->session->flashdata('info');
                $color_info = $this->session->flashdata('color_info');
            ?>
            <?php
if (!empty($info) && !empty($color_info)) {
                    echo "
                            <div class=\"row\">
                            <div class=\"col-md-3\"></div>
                            <div class=\"col-md-6\">
                            <div class=\"alert alert-$color_info\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                            </i><strong>$info</strong>
                            </div>
                            </div>
                            <div class=\"col-md-3\"></div>
                            </div>
                        ";
                }
                    ?>
        <div class="chat-room mt">
            <span class="fa fa-envelope" style="font-size: 180%"><strong><?= $data_ticket->judul_ticket; ?></strong></span>
            <p style="text-align: right">Waktu pengiriman: <strong><?= tgl($data_ticket->tgl_input); ?></strong></p>
            <hr>
          <aside class="right-side">
            <div class="row">
                <div style="width: 33%">
            <div class="invite-row">
              <h5 class="pull-left"><strong>Dari</strong></h5>
            </div>
            <ul class="chat-available-user">
              <li>Nama: <strong><?= $user_ticket['nama_lengkap']; ?></strong></li>
              <li>Nomor Induk: <strong><?= $user_ticket['username']; ?></strong></li>
              <li>Prodi: <?= $user_ticket['jenjangProdi']; ?> <?= $user_ticket['tahun_masuk']; ?> <?= $user_ticket['offering']; ?></li>
              <li>HP: <?= $user_ticket['no_hp']; ?></li>
              <li>Email: <?= $user_ticket['email']; ?></li>
            </ul>
          </div>
          <div style="width: 33%">
              <div class="invite-row">
              <h5 class="pull-left"><strong>Kepada</strong></h5>
            </div>
            <ul class="chat-available-user">
              <li><strong><?= $kepada; ?></strong></li>
              
            </ul>
          </div>
            <div style="width: 33%">
            <ul class="chat-available-user">
            <li>Nama Layanan: <strong><?= $layanan; ?></strong></li>
              <li>Kategori Ticket: <strong><?= $data_ticket->nama_kategori_ticket; ?></strong></li>
              <li>Sub Kategori Ticket: <strong><?= $data_ticket->sub_kategori; ?></strong></li>
              <li>Urgensi: <strong><?= $urgensi; ?></strong></li>
            </ul>
        </div>
        </div>

        Detail Kendala: <div class="alert alert-default" style="border-color: black"><?= $data_ticket->detail_kendala; ?></div>
        <div class="row">
            <div style="width: 50%">
            <div class="invite-row">
              <h5 class="pull-left"><strong>Lampiran</strong></h5>
            </div>
            <ul class="chat-available-user">
            File Lampiran
                <a href="http://elektro.um.ac.id/dashboard/file/ticket/lampiran/<?= $data_ticket->lampiran; ?>" target="_blank" class="btn btn-primary">Lihat</a><br />
                <p>Lampiran merupakan unggahan dari pengirim untuk mempermudah identifikasi kendala yang dihadapi</p>
        </ul>
    </div>
            <div style="width: 50%">
        <div class="invite-row">
              <h5 class="pull-left"><strong>Informasi Ticket Support</strong></h5>
            </div>
            <table>
            <tr>
                <td style="vertical-align: top; width: 50%">
            <strong>Status</strong>
        </td><td>
            <h3><strong><?= $status; ?></strong></h3>
             Ubah status 
              <a href="<?php echo base_url('ticket/ticketSolved?id='.$title) ?>" class="btn btn-success btn-sm">Solved</a>
              <a href="<?php echo base_url('ticket/ticketClosed?id='.$title) ?>" class="btn btn-light btn-sm">Closed</a></td>
          </tr>
          <tr>
              <td>&nbsp;</td>
          </tr>
          <tr>
              <td style="vertical-align: top"><strong>Pindahkan ke</strong></td>
              <td><a href="<?php echo base_url('ticket/pindahticketTeknis?id='.$title) ?>" class="btn btn-primary btn-sm">Teknis</a>
              <a href="<?php echo base_url('ticket/pindahticketKalab?id='.$title) ?>" class="btn btn-success btn-sm">Kalab</a></td>
          </tr>
          </table>
          </div>
        </div>   
            
            
          </aside>
        </div></div></div></div>    
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary">Riwayat Percakapan</h4>
                </div>
                <div class="card-body">
                    
                    <div style="float: right; text-align: right;"><a href="" class="btn btn-success" data-toggle="modal" data-target="#balas">Balas Percakapan</a></div><br>
                            <?php
                            foreach($detail_ticket AS $detail){
                                $warna = ($detail->username==$username) ? "bg-theme" : "bg-theme02";
                                $icon = ($detail->username==$username) ? "fa-comment" : "fa-comments";
                                $lampiran = ($detail->lampiran!="") ? "<a href='http://elektro.um.ac.id/dashboard/file/ticket/lampiran/".$detail->lampiran."' target='_blank' class='btn btn-primary'>Lihat</a>" : "";
                        ?>
                            <i class="fa <?= $icon; ?>"></i>
                              <h5><?= $detail->nama_lengkap; ?></h5>
                              <h6><?= tgl($detail->tgl_input); ?></h6>
                              <p><?= $detail->komentar; ?></p>
                              <?= $lampiran; ?>
                              <hr style="width: 100%;">
                        <?php
                            }
                        ?>
                      </div>
                </div>
            </div>
        </div>
    </div>
<!--main content end-->
<div class="modal fade" id="balas" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"><b>Balas Percakapan</b></h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="" role="form" class="form-horizontal" enctype="multipart/form-data">
                                                    <div class="form-group">
                        <label class="col-lg-12 control-label">Pesan*<br><span style="font-size: 10pt">*Wajib</span></label>
                        <div class="col-lg-11">
                            <textarea rows="10" cols="10" class="form-control" name="komentar" data-validation="required" style="resize: vertical;" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-12 control-label">Lampiran(Optional)<br><span style="font-size: 10pt">Ekstensi file lampiran yang bisa anda upload bebas(dapat berupa .jpg, .pdf, dsb) sesuai kebutuhan. Maksimal ukuran file sebesar 2MB. Apabila terdapat lebih dari satu file maka kompres menjadi satu file dengan ekstensi .rar atau .zip</span></label>
                        <div class="col-lg-11">
                            <input type="file" class="form-control" name="lampiran" data-validation="size" data-validation-min-size="1kb" data-validation-max-size="2M" />
                        </div>
                    </div>
                    
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="form-group">
                        <div class="col-lg-offset-1 col-lg-11">
                            <input type="hidden" name="id_ticket" value="<?= $data_ticket->id_ticket; ?>" required />
                            <?php
                            $ths=$this->session_user;
                            $usename = $ths['username'];
                             ?>
                            <input type="hidden" name="username" value="<?= $usename; ?>" required />
                            <button class="btn btn-primary" type="submit" name="kirim">Kirim</button>
                        </div>
                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>