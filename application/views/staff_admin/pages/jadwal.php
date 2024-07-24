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
<!-- Begin Page Content -->
<style>
    .ui-timepicker-container {
        z-index: 99999 !important;
    }
	.btn-icon-split{
		margin: 1px 0px 1px 0px;
		text-align:left;
	}
	.ikon{
		width:32px;
	}
	.teks{
		width:93.41px;
	}
</style>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div id="buttonContainer" style="padding-bottom: 20px">
                <!-- BUTTON FILTER Bulan-->
                <div class="btn btn-primary btn-icon-split" style="">
                    <span class="icon text-white-50" style="">
                        <i class="fas fa-calendar-alt"></i>
                    </span>
                    <span class="text select-text bulan" style="padding:0;"></span>
                </div>
                <!-- BUTTON FILTER Tahun-->
                <div class="btn btn-primary btn-icon-split" style="">
                    <span class="icon text-white-50" style="">
                        <i class="fas fa-calendar-alt"></i>
                    </span>
                    <span class="text select-text tahun" style="padding:0;"></span>
                </div>
                <!-- BUTTON FILTER Status-->
                <div class="btn btn-primary btn-icon-split" style="">
                    <span class="icon text-white-50" style="">
                        <i class="fas fa-check-circle"></i>
                    </span>
                    <span class="text select-text status" style="padding:0;"></span>
                </div>
            </div>
            <div class="">
                <!--TABEL JADWAL-->
                <table class="table table-bordered table-hover table-sm" id="dataJadwal" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Kategori</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Prodi</th>
                        <th>Off</th>
                        <th>Pembimbing 1</th>
                        <th>Pembimbing 2</th>
                        <th>Penguji</th>
                        <th style="display:none">Judul</th>
                        <th>Judul</th>
                        <th>Kontak</th>
                        <th>Tanggal</th>
                        <th style="display:none;">Bulan</th>
                        <th style="display:none;">Tahun</th>
                        <th>Jam</th>
                        <th>Ruang</th>
                        <th>Status</th>
                        <th>Opsi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($data as $row) {
                        $data_encrypt = $this->my_encrypt->custom_encode(json_encode($row));
                        if ($row->status_jadwal == "Diterima") {
                            $color = "#2ecc71";
                        } else {
                            $color = "#f39c12";
                        }
                        ?>
                        <tr>
                            <td>
                                <?php echo $row->kategori ?>
                            </td>
                            <td>
                                <?php echo $row->nim ?>
                            </td>
                            <td>
                                <?php echo $row->nama_lengkap ?>
                            </td>
                            <td>
                                <?php echo $row->nama_jenjang . " " . $row->nama_prodi ?>
                            </td>
                            <td>
                                <?php echo $row->offering ?>
                            </td>
                            <td>
                                <?php echo $row->pembimbing1 ?>
                            </td>
                            <td>
                                <?php echo $row->pembimbing2 ?>
                            </td>
                            <td>
                                <?php echo $row->penguji ?>
                            </td>
                            <td style="display:none">
                                <?php echo $row->judul ?>
                            </td>
                            <td>
                                <a href="" class="btn btn-info btn-sm" data-toggle="modal"
                                   data-target="#judul<?php echo $row->id ?>">Lihat Judul</a>
                                <div id="judul<?php echo $row->id ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><b><?php echo $row->nama_lengkap . " / " . $row->nim ?></b>
                                                </h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    <?php echo $row->judul ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php echo $row->kontak ?>
                            </td>
                            <td>
                                <?php echo tgl_indo($row->tanggal) ?>
                            </td>
                            <td style="display:none">
                                <?php echo tgl_indo($row->tanggal, false) ?>
                            </td>
                            <td style="display:none">
                                <?php echo date('Y', strtotime($row->tanggal)) ?>
                            </td>
                            <td>
                                <?php echo date("H:i", strtotime($row->jam)) ?>
                            </td>
                            <td>
                                <?php echo $row->ruang ?>
                            </td>
                            <td style="font-weight:bolder; color:<?php echo $color ?>">
                                <?php echo $row->status_jadwal ?>
                            </td>
                            <td>
                                <!--BUTTON STATUS-->
                                <div class="">
                                    <?php
                                    if ($row->status_jadwal == "Diproses") {
                                        echo "<button class='btn btn-primary btn-icon-split btn-sm' data-toggle='modal' data-target='#setujui$row->id'><span class='icon text-white-50 ikon'><i class='fas fa-edit'></i></span><span class='text teks'>Setujui</span></button>";
                                    } else {
                                        echo "<button class='btn btn-secondary btn-icon-split btn-sm' data-toggle='modal' data-target='#batal$row->id' ><span class='icon text-white-50 ikon'><i class='fas fa-edit' ></i></span><span class='text teks'>Batalkan</span></button>";
                                    }
                                    ?>
                                    <!--BUTTON CEK JADWAL-->
                                    <button class="btn btn-info btn-icon-split btn-sm" data-toggle='modal'
                                            data-target='#cek<?php echo $row->id ?>'><span class='icon text-white-50 ikon'><i class="fas fa-exclamation"></i></span><span class='text teks'>Cek Jadwal</span>
                                    </button>
                                    <!--BUTTON HAPUS-->
                                    <button class="btn btn-danger btn-icon-split btn-sm" data-toggle='modal'
                                            data-target='#delete<?php echo $row->id ?>'><span class='icon text-white-50 ikon'><i class="fas fa-trash"></i></span><span class='text teks'>Hapus</span>
                                    </button>


                                    <?php if (($row->kategori == "Sidang TA" || $row->kategori == "Sidang Skripsi") && $row->status_jadwal == "Diterima") { ?>
                                        <button class="btn btn-primary btn-icon-split btn-sm"  data-toggle='modal' title='Cetak Berita Acara'
                                               data-target='#print<?php echo $row->id ?>'>
                                            <span class="icon text-white-50 ikon"><i class="fas fa-print"></i></span>
											<span class='text teks'>Berita Acara
											</span>
                                        </button>
                                    <?php } ?>
                                </div>
                                <!-- MODAL CETAK -->
                                <div class="modal fade" id="print<?php echo $row->id; ?>" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><b>Cetak Berita Acara</b>
                                                </h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <?php echo form_open('admin/penjadwalan/cetak/' . $data_encrypt) ?>
                                                <table style="border-collapse: collapse; padding:0px"
                                                       class="table table-sm table-borderless">
                                                    <tr>
                                                        <td>Semester</td>
                                                        <td>
                                                            <select name="sem">
                                                                <option value="GASAL">Gasal</option>
                                                                <option value="GENAP">Genap</option>
                                                                <option value="ANTARA">Antara</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tahun Ajaran</td>
                                                        <td>
                                                            <input type="text" required class="form-control"
                                                                   name="thnajar">
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

                                <!-- MODAL HAPUS -->
                                <div class="modal fade" id="delete<?php echo $row->id ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h5 class="modal-title">Hapus Jadwal <?php echo $row->kategori ?></h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <?php echo form_open('admin/penjadwalan/delete/' . $row->id) ?>
                                                <table align="left" border="0" cellspacing="0" cellpadding="0"
                                                       width="100%" class="table table-sm table-borderless">
                                                    <tr align="left" valign="top">
                                                        <td>Nama</td>
                                                        <td>
                                                            <?php echo $row->nama_lengkap ?>
                                                        </td>
                                                    </tr>
                                                    <tr align="left" valign="top">
                                                        <td>NIM</td>
                                                        <td>
                                                            <?php echo $row->nim ?>
                                                        </td>
                                                    </tr>
                                                    <tr align="left" valign="top">
                                                        <td>Prodi</td>
                                                        <td>
                                                            <?php echo $row->nama_jenjang . ' ' . $row->nama_prodi ?>
                                                        </td>
                                                    </tr>
                                                    <tr align="left" valign="top">
                                                        <td>Judul</td>
                                                        <td>
                                                            <?php echo $row->judul ?>
                                                        </td>
                                                    </tr>
                                                    <tr align="left" valign="top">
                                                        <td>Tanggal</td>
                                                        <td>
                                                            <?php echo tgl_indo($row->tanggal) ?>
                                                        </td>
                                                    </tr>
                                                    </tr>
                                                    <tr align="left" valign="top">
                                                        <td>Jam</td>
                                                        <td>
                                                            <?php echo date("H:i", strtotime($row->jam)) ?> WIB
                                                        </td>
                                                    </tr>
                                                    <tr align="left" valign="top">
                                                        <td>Ruang</td>
                                                        <td>
                                                            <?php echo $row->ruang ?>
                                                        </td>
                                                    </tr>
                                                </table>

                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <input type="submit" value="Hapus Jadwal"
                                                       class="btn btn-danger form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <!-- MODAL VALIDASI -->
                                <div class="modal fade" id="setujui<?php echo $row->id; ?>" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><b>Setujui
                                                        Jadwal <?php echo $row->kategori ?></b></h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <?php echo form_open('admin/penjadwalan/updatevalid/' . $data_encrypt) ?>
                                                <table style="border-collapse: collapse; padding:0px"
                                                       class="table table-sm table-borderless">
                                                    <tr>
                                                        <td>NIM</td>
                                                        <td>
                                                            <?php echo $row->nim ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama</td>
                                                        <td>
                                                            <?php echo $row->nama_lengkap ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Prodi/Offr</td>
                                                        <td>
                                                            <?php echo $row->nama_jenjang . ' ' . $row->nama_prodi . ' / ' . $row->offering ?>
                                                        </td>
                                                    </tr>
                                                    <tr data-toggle='tooltip' title='<?php echo $row->judul ?>'>
                                                        <td>Judul</td>
                                                        <td>
                                                            <?php echo substr($row->judul, 0, 50) . '....'; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kontak</td>
                                                        <td>
                                                            <input type="tel" name="kontak" class="form-control"
                                                                   value="<?php echo $row->kontak ?>" required
                                                                   name="kontak">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tanggal</td>
                                                        <td>
                                                            <input type="date" required class="form-control"
                                                                   value="<?php echo $row->tanggal ?>" name="tanggal">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jam</td>
                                                        <td>
                                                            <input type="text" class="form-control timeinput" required
                                                                   placeholder="Time"
                                                                   value="  <?php echo date(" H:i ", strtotime($row->jam)) ?>"
                                                                   name="jam">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ruang</td>
                                                        <td style="padding-left:15px">
                                                            <?php
                                                            $gedung = substr($row->ruang, 0, 2);
                                                            $ruang = substr($row->ruang, 3, 6);
                                                            ?>
                                                            <div class="row">
                                                                <select class="form-control" style="width:20%" required
                                                                        name="gedung">
                                                                    <option <?php if ($gedung == "G4") {
                                                                        echo "selected='selected'";
                                                                    } ?>>G4
                                                                    </option>
                                                                    <option <?php if ($gedung == "H5") {
                                                                        echo "selected='selected'";
                                                                    } ?>>H5
                                                                    </option>
                                                                </select>
                                                                <input type="text" name="ruang"
                                                                       value="<?php echo $ruang ?>" class="form-control"
                                                                       required style="width:30%" placeholder="ruang">
                                                            </div>
                                                        </td>
                                                    </tr>


                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" value="Setujui"
                                                       class="form-control btn btn-success">
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <!--AKHIR MODAL VALIDASI-->
                                <!-- MODAL BATAL VALIDASI -->
                                <div class="modal fade" id="batal<?php echo $row->id; ?>" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><b>Batalkan
                                                        Jadwal <?php echo $row->kategori ?></b></h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <?php echo form_open('admin/penjadwalan/updatebatal/' . $row->id . '/'. $row->nim . '/'. $row->tanggal) ?>
                                                <table style="border-collapse: collapse; padding:0px"
                                                       class="table table-sm table-borderless">
                                                    <tr>
                                                        <td>NIM</td>
                                                        <td>
                                                            <?php echo $row->nim ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama</td>
                                                        <td>
                                                            <?php echo $row->nama_lengkap ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Prodi/Offr</td>
                                                        <td>
                                                            <?php echo $row->nama_jenjang . ' ' . $row->nama_prodi . ' / ' . $row->offering ?>
                                                        </td>
                                                    </tr>
                                                    <tr data-toggle='tooltip' title='<?php echo $row->judul ?>'>
                                                        <td>Judul</td>
                                                        <td>
                                                            <?php echo substr($row->judul, 0, 50) . '....'; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kontak</td>
                                                        <td>
                                                            <input type="tel" name="kontak" class="form-control"
                                                                   value="<?php echo $row->kontak ?>" required
                                                                   name="kontak">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tanggal</td>
                                                        <td>
                                                            <input type="date" required class="form-control"
                                                                   value="<?php echo $row->tanggal ?>" name="tanggal">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jam</td>
                                                        <td>
                                                            <input type="text" class="form-control timeinput" required
                                                                   placeholder="Time"
                                                                   value="  <?php echo date(" H:i ", strtotime($row->jam)) ?>"
                                                                   name="jam">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ruang</td>
                                                        <td style="padding-left:15px">
                                                            <?php
                                                            $gedung = substr($row->ruang, 0, 2);
                                                            $ruang = substr($row->ruang, 3, 6);
                                                            ?>
                                                            <div class="row">
                                                                <select class="form-control" style="width:20%" required
                                                                        name="gedung">
                                                                    <option <?php if ($gedung == "G4") {
                                                                        echo "selected='selected'";
                                                                    } ?>>G4
                                                                    </option>
                                                                    <option <?php if ($gedung == "H5") {
                                                                        echo "selected='selected'";
                                                                    } ?>>H5
                                                                    </option>
                                                                </select>
                                                                <input type="text" name="ruang"
                                                                       value="<?php echo $ruang ?>" class="form-control"
                                                                       required style="width:30%" placeholder="ruang">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" value="Batalkan Jadwal"
                                                       class="form-control btn btn-warning">
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <!--AKHIR MODAL BATAL VALIDASI-->
                                <!-- MODAL CEK JADWAL -->
                                <div class="modal fade" id="cek<?php echo $row->id; ?>" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Cek Jadwal</h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <b>Jadwal Tanggal <?php echo tgl_indo($row->tanggal) ?> |
                                                    Ruang <?php echo $row->ruang ?>
                                                    | <?php echo date("H:i", strtotime($row->jam)) ?> WIB</b>
                                                <hr>
                                                <table class="table">
                                                    <tr>
                                                        <?php
                                                        $query = $this->db->query("SELECT * FROM penjadwalan WHERE tanggal='$row->tanggal' and ruang='$row->ruang' and status_jadwal='Diterima'  ORDER BY jam ASC");
                                                        $count = $query->num_rows();
                                                        if (!$count) {
                                                            echo "<div class='alert alert-info' style='text-align:center'>Tidak Ada Jadwal Sidang/Seminar</div>";
                                                        } else {
                                                            echo "<th>Nama</th>
                                                              <th>Jenis</th>
                                                              <th>Jam</th>
                                                              </tr>";
                                                        }
                                                        foreach ($query->result() as $row){
                                                        ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $row->nama_lengkap ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row->kategori ?>
                                                        </td>
                                                        <td>
                                                            <?php echo date("H:i", strtotime($row->jam)) ?> WIB
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </table>
                                                <hr>

                                                <hr>
                                            </div>
                                            <div class="modal-footer">
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <!--AKHIR MODAL CEK JADWAL-->
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <!--AKHIR TABEL JADWAL-->
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<script>
    function format() {
        // `d` is the original data object for the row
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
            '<tr>' +
            '<td>Full name:</td>' +

            '</tr>' +
            '<tr>' +
            '<td>Extension number:</td>' +
            '<td>' + d.extn + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Extra info:</td>' +
            '<td>And any further details here (images etc)...</td>' +
            '</tr>' +
            '</table>';
    }

    $(document).ready(function () {

        $("input.timeinput").timepicker({})
    });


</script>
<script src="<?= base_url('js/timepicker/jquery.timepicker.js') ?>"></script>