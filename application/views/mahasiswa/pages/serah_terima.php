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
    } elseif ($this->session->flashdata('warning')) { ?>
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

    <div class="row">
        <div class="col-md-9">
            <div class="card shadow mb-4">
                <?php if(isset($data->ID)){ ?>
                <div class="card-body" style="font-size: 17px">
                    <div style="padding: 0px 0px 10px 0px; text-align: center">
                        <h4>Informasi Serah Terima Peserta</h4>
                    </div>
                    <br>
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
                                <?php echo $jenjangProdi ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Judul <?= $data->kategori ?></td>
                            <td style="padding-left:30px">
                                <?php echo $data->judul; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td style="padding-left:30px">
                                <?php
                                if (!(isset($data->upload_link))) {
                                    echo "<p>Anda masih belum mengupload berkas. Tekan tombol submit untuk upload berkas</p>";
                                } elseif (isset($data->upload_link)) {
                                    echo "Sedang Diproses";
                                } else {
                                    echo "Diterima";
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                    <?php
                    if (!(isset($data->upload_link))) {
                        ?>
                        <div style="padding-top=10px">
                            <button type="button" class="btn btn-success" style="padding: 8px 30px 8px 30px;"
                                    data-toggle="modal" data-target="#uploadModal"> Upload File
                            </button>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <!--MODAL UPLOAD-->
                <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModal"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="uploadModalLabel">Upload Berkas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url('mhs/upload-berkas/upload_files') ?>" method="post"
                                  enctype="multipart/form-data">
                                <div class="modal-body">
                                    <table class="table">
                                        <tr>
                                            <td>Artikel</td>
                                            <td>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="uploadArtikel"
                                                           name="fileuploads[]" required>
                                                    <label class="custom-file-label" for="uploadArtikel">Choose
                                                        file</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Berkas Cover</td>
                                            <td>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="uploadCover"
                                                           name="fileuploads[]" required>
                                                    <label class="custom-file-label" for="uploadCover">Choose
                                                        file</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lembar Pengesahan</td>
                                            <td>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="uploadPengesahan"
                                                           name="fileuploads[]" required>
                                                    <label class="custom-file-label" for="uploadPengesahan">Choose
                                                        file</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lembar Persetujuan</td>
                                            <td>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="uploadPersetujuan"
                                                           name="fileuploads[]" required>
                                                    <label class="custom-file-label" for="uploadPersetujuan">Choose
                                                        file</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Abstrak (File)</td>
                                            <td>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="uploadAbstrak"
                                                           name="fileuploads[]" required>
                                                    <label class="custom-file-label" for="uploadAbstrak">Choose
                                                        file</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kartu Bimbingan</td>
                                            <td>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="uploadKartu"
                                                           name="fileuploads[]" required>
                                                    <label class="custom-file-label" for="uploadKartu">Choose
                                                        file</label>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <input type="hidden" name="id" value="<?= $data->ID; ?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <?php
                } else {
                    echo "TIDAK MEMILIKI DATA SERAH TERIMA";
                }

                ?>
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
<!--end container-fluid-->
<script>
    $(document).ready(function () {
        $("#uploadArtikel").change(function () {
            if ($(this).val() == "") {
                $("input#uploadArtikel").next().html("Choose file");
            }
            else {
                var theSplit = $(this).val().split('\\');
                $("input#uploadArtikel").next().html(theSplit[theSplit.length - 1]);
            }
        });
        $("#uploadCover").change(function () {
            if ($(this).val() == "") {
                $("input#uploadCover").next().html("Choose file");
            }
            else {
                var theSplit = $(this).val().split('\\');
                $("input#uploadCover").next().html(theSplit[theSplit.length - 1]);
            }
        });
        $("#uploadPengesahan").change(function () {
            if ($(this).val() == "") {
                $("input#uploadPengesahan").next().html("Choose file");
            }
            else {
                var theSplit = $(this).val().split('\\');
                $("input#uploadPengesahan").next().html(theSplit[theSplit.length - 1]);
            }
        });
        $("#uploadPersetujuan").change(function () {
            if ($(this).val() == "") {
                $("input#uploadPersetujuan").next().html("Choose file");
            }
            else {
                var theSplit = $(this).val().split('\\');
                $("input#uploadPersetujuan").next().html(theSplit[theSplit.length - 1]);
            }
        });
        $("#uploadAbstrak").change(function () {
            if ($(this).val() == "") {
                $("input#uploadAbstrak").next().html("Choose file");
            }
            else {
                var theSplit = $(this).val().split('\\');
                $("input#uploadAbstrak").next().html(theSplit[theSplit.length - 1]);
            }
        });
        $("#uploadKartu").change(function () {
            if ($(this).val() == "") {
                $("input#uploadKartu").next().html("Choose file");
            }
            else {
                var theSplit = $(this).val().split('\\');
                $("input#uploadKartu").next().html(theSplit[theSplit.length - 1]);
            }
        });
    })
</script>