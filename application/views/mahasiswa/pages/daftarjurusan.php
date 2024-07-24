<style>
    #judul {
        margin-left: 20px
    }

    label {
        padding-top: 20px
    }

    .text-sm {
        font-size: 11.5pt;
    }
</style>
<!--begin container-fluid-->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800" id="judul">Form Pengajuan Surat Izin Penelitian Ke Jurusan</h1>

    <div class="row">
        <div class="col-md-9">
            <div class="card shadow mb-4">
                <div class="card-body" style="font-size: 17px">
                    <?php
                    if ($stat == "Berhasil") {
                        $kelas = "style='display: none'";
                    } elseif ($stat == "Gagal") {
                        $peringatan = "Silahkan input judul secara manual";
                        $kelas = "class='alert alert-warning'";
                    }
                    ?>
                    <div <?php echo $kelas; ?>>
                        <?php echo $peringatan; ?>
                    </div>
                    <b>Peserta Penelitian</b>
                    <br>
                    <form action="<?= base_url('mhs/penelitian_jurusan/submit/') ?>" accept-charset="UTF-8"
                          method="post">
                        <table style="border-collapse: collapse; width:100%; " class="table table-sm">
                            <tr>
                                <td>NIM</td>
                                <td style="padding-left:30px">
                                    <?php echo $username ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td style="padding-left:30px">
                                    <?php echo $nama ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Program Studi</td>
                                <td style="padding-left:30px">
                                    <?php echo $jenjang . " " . $prodi ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Judul
                                    <?php echo $jenis; ?>
                                </td>
                                <td style="padding-left:30px">
                                    <?php echo $judul ?>
                                </td>
                            </tr>
                        </table>
                        <input type="hidden" value="<?php echo $jenjang . " " . $prodi ?>" name="prodi">
                        <input type="hidden" value="<?php echo $stat ?>" name="stat">
                        <?php if ($stat == "Berhasil") {
                        echo "<input type='hidden' value='".$judul."' name='judul'>";
                    }?>
                        <table class="table-borderless text-gray-800" width="100%" style="border-collapse: collapse">
                            <?php if ($stat == "Gagal") {
                            echo
                            "<tr>
                                <td>
                                    <label for='judul'>Judul<br><span class='text-sm'>Contoh Penulisan : Perbandingan Metode Naive Bayes dan k-Nearest Neighbor (k-NN) untuk Klasifikasi Penyakit Kanker Kronis</span>
                                    </label>
                                    <textarea class='form-control' name='judul' id='judul' style='margin-left: -2px;'></textarea>
                                    <div id='invalidJudul' class='invalid-feedback'>
                                        <?php echo form_error('judul') ?>
                                    </div>
                                </td>
                            </tr>";
                        }?>
                            <tr>
                                <td>
                                    <label for="tgl_buat">Tanggal Pengajuan Penelitian
                                        <br>
                                        <span class="text-sm">Tanggal pengajuan adalah tanggal form permohonan akan diajukan ke administrasi jurusan</span>
                                    </label>
                                    <input type="date" class="form-control" name="tgl_buat" id="tgl_buat"
                                           min="<?= date('Y-m-d') ?>">
                                    <div id="invalidDateCreate" class="invalid-feedback ">
                                        <?php echo form_error('tgl_buat') ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="tgl_mulai">Tanggal Penelitian Dimulai
                                        <br><span class="text-sm">Tanggal Pelaksanaan Penelitian berjarak minimal 1 minggu setelah form permohonan diajukan ke Administrasi Jurusan</span></label>
                                    <input type="date" class="form-control" name="tgl_mulai" id="tgl_mulai">
                                    <div id="invalidDateStart" class="invalid-feedback ">
                                        <?php echo form_error('tgl_mulai') ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="">Tanggal Penelitian Diakhiri</label>
                                    <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir">
                                    <div id="invalidDateEnd" class="invalid-feedback ">
                                        <?php echo form_error('tgl_akhir') ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <input type="submit" name="button" value="Konfirmasi"
                               class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
                </div>
                <div class="card-body">
                    <ol>
                        <li>Mahasiswa mengisi form pengajuan penelitian dengan benar untuk dapat mengunduh file surat
                            izin penelitian
                        </li>
                        <li>Mahasiswa mencetak surat izin pada kertas ukuran A4</li>
                        <li>Mahasiswa meminta tanda tangan kepada pembimbing satu</li>
                        <li>Mahasiswa menyerahkan surat izin kepada staff administrasi di gedung H5 lantai 2</li>
                        <li>Penelitian dapat dilaksanakan minimal 7 hari setelah surat izin penelitian diajukan ke staff
                            administrasi
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById("tgl_buat").onclick = function () {
        var date = new Date();
        var newdate = new Date(date);
        newdate.setDate(newdate.getDate());
        var dd = ("0" + newdate.getDate()).slice(-2);
        var mm = ("0" + (newdate.getMonth() + 1)).slice(-2);
        var y = newdate.getFullYear();
        var someFormattedDate = y + '-' + mm + '-' + dd;
        document.getElementById("tgl_buat").value = someFormattedDate;
        var buat = document.getElementById("tgl_buat").value;
        var date = new Date(buat);
        var newdate = new Date(date);
        newdate.setDate(newdate.getDate() + 7);
        var dd = ("0" + newdate.getDate()).slice(-2);
        var mm = ("0" + (newdate.getMonth() + 1)).slice(-2);
        var y = newdate.getFullYear();
        var someFormattedDate = y + '-' + mm + '-' + dd;
        document.getElementById('tgl_mulai').setAttribute("min", someFormattedDate);
    }
    document.getElementById("tgl_buat").onchange = function () {
        var buat = document.getElementById("tgl_buat").value;
        var date = new Date(buat);
        var newdate = new Date(date);
        newdate.setDate(newdate.getDate() + 7);
        var dd = ("0" + newdate.getDate()).slice(-2);
        var mm = ("0" + (newdate.getMonth() + 1)).slice(-2);
        var y = newdate.getFullYear();
        var someFormattedDate = y + '-' + mm + '-' + dd;
        document.getElementById('tgl_mulai').setAttribute("min", someFormattedDate);
    }
    document.getElementById("tgl_mulai").onchange = function () {
        var input = document.getElementById("tgl_akhir");
        input.setAttribute("min", this.value);
    }
    $(document).ready(function () {
        var validDateStart = 1;
        if ($("#invalidDateStart").children().text().length != 0) {
            $("#tgl_mulai").toggleClass("is-invalid");
            validDateStart = 0;
        }
        if (validDateStart == 0) {
            $("#tgl_mulai").one("focus", function () {
                $("#tgl_mulai").toggleClass("is-invalid");
                $("#invalidDateStart").empty();
                $("#tgl_mulai").val("");
                validDateStart = 1;
            });
        }
        var validDateEnd = 1;
        if ($("#invalidDateEnd").children().text().length != 0) {
            $("#tgl_akhir").toggleClass("is-invalid");
            validDateEnd = 0;
        }
        if (validDateEnd == 0) {
            $("#tgl_akhir").one("focus", function () {
                $("#tgl_akhir").toggleClass("is-invalid");
                $("#invalidDateEnd").empty();
                $("#tgl_akhir").val("");
                validDateEnd = 1;
            });
        }
        var validDateCreate = 1;
        if ($("#invalidDateCreate").children().text().length != 0) {
            $("#tgl_buat").toggleClass("is-invalid");
            validDateCreate = 0;
        }
        if (validDateCreate == 0) {
            $("#tgl_buat").one("focus", function () {
                $("#tgl_buat").toggleClass("is-invalid");
                $("#invalidDateCreate").empty();
                $("#tgl_buat").val("");
                validDateCreate = 1;
            });
        }
    });
</script>
<!--end container-fluid-->
<!--</html>-->