<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
	<style>
	.text-sm{
        font-size: 10px;
    }
	</style>
    <?php

    //TODO Program Studi berupa Option Input
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


        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }

    ?>

    <div class="row">
        <div class="col-md-9">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pendaftaran</h6>

                </div>
                <form action="<?= base_url('observasi/studilapangan/daftar/') ?>" accept-charset="UTF-8" method="post">
                    <!-- Form Body -->
                    <div class="card-body" style="font-size: 17px">
                        <div class="form-group">
                            <label for="matakuliah">Matakuliah </label>
                            <input type="text" id="valueMatkul" class="form-control " name="matkul" value="">
                            <div id="invalidMatkul" class="invalid-feedback">
                                <?php echo form_error('matkul') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Prodi">Program Studi Kelompok <br>
							<span class="text-sm">Contoh: S1 Pendidikan Teknik Informatika</span>
							</label> 
							
                            <input id="valueProdKel" type="text" class="form-control" name="prodi_kel" value="">
                            <div id="invalidProdKel" class="invalid-feedback">
                                <?php echo form_error('prodi_kel') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Judul">Judul Studi Lapangan <br>
                                <span class="text-sm" style="font-size: 80%">Contoh: Wawancara Mengenai Kurikulum SMK</span>
                            </label>
                            <input id="valueJudul" type="text" name="judul" class="form-control">
                            <div id="invalidJudul" class="invalid-feedback">
                                <?php echo form_error('judul') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Tujuan">Instansi Tujuan <br>
                                <span class="text-sm" style="font-size: 80%">Contoh: SMKN 2 Malang</span>
                            </label>
                            <input id="valueNamaIns" type="text" name="tujuan" class="form-control">
                            <div id="invalidNamaIns" class="invalid-feedback">
                                <?php echo form_error('tujuan') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Nama">Nama Pihak Instansi Tujuan/Penerima Surat <br>
                                <span class="text-sm" style="font-size: 80%">Contoh: Kepala SMKN 2 Malang</span>
                            </label>
                            <input id="valueTujuan" type="text" name="kepada" class="form-control">
                            <div id="invalidTujuan" class="invalid-feedback">
                                <?php echo form_error('kepada') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="Alamat">Alamat Pihak Instansi Tujuan/Penerima Surat <br>
                                <span class="text-sm" style="font-size: 80%">Contoh: Jalan Bondowoso No. 18, Klojen, Malang </span>
                            </label>
                            <input id="valueAlamat" type="text" name="alamat" class="form-control">
                            <div id="invalidAlamat" class="invalid-feedback">
                                <?php echo form_error('alamat') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php
                            $date = strtotime("+7 day");
                            ?>
                            <label for="tgl_buat">Tanggal Pengajuan Studi Lapangan
                                        <br>
                                        <span class="text-sm">Tanggal pengajuan adalah tanggal form permohonan akan diajukan ke administrasi jurusan</span>
                                        </label>
                                        <input type="date" class="form-control" name="tgl_buat" id="tgl_buat" min="<?= date('Y-m-d')?>">
                                        <div id="invalidDateCreate" class="invalid-feedback ">
                                            <?php echo form_error('tgl_buat') ?>
                                        </div>
                        </div>
                        <div class="form-group">
                            <?php
                            $date = strtotime("+7 day");
                            ?>
                            <label for="Tanggal Mulai">Tanggal Mulai</label>
                            <input id="valueDateStart" type="date" class="form-control " name="tgl_mulai"
                                   min="<?= date('Y-m-d', $date) ?>" >
                            <div id="invalidDateStart" class="invalid-feedback ">
                                <?php echo form_error('tgl_mulai') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Tanggal Akhir">Tanggal Akhir</label>
                            <input id="valueDateEnd" type="date" min="<?= date('Y-m-d', $date) ?>" name="tgl_akhir" class="form-control ">
                            <div id="invalidDateEnd" class="invalid-feedback ">
                                <?php echo form_error('tgl_akhir') ?>
                            </div>
                        </div>

                        <!-- Menambah Anggota -->
                        <div class="form-group">
                            <button style="margin-bottom:1rem;" class="btn btn-primary" type="button"
                                    data-toggle="collapse"
                                    data-target="#collapseTable" aria-expanded="false"
                                    aria-controls="collapseTable">
                                Tambah Anggota
                            </button>
                            <div class="collapse" id="collapseTable">
                                <div class="card">
                                    <div class="card-body" style="overflow: auto;">
                                        <table class="table table-bordered" style="">
                                            <thead>
                                            <tr>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Prodi</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody id="dataAnggota">
                                            <tr>
                                                <td class="nimUser"><?= $username ?></td>
                                                <td><?= $nama ?></td>
                                                <td><?= $jenjangProdi ?></td>
                                                <td></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <div class="form-row">
                                            <div class="col-md-3 mb-3" id="validationNim">
                                                <input class="form-control " id="valueNim" type="text"
                                                       value="">
                                                <div id="invalidNim" class="invalid-feedback">

                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <button id="addNim" class="btn btn-primary" type="button">Masukkan
                                                    Anggota
                                                    NIM
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div id="hiddenInputs">
                                <div class="form-group">
                                    <input type="hidden" name="nim[]" value="<?= $username ?>">
                                    <input type="hidden" name="nama[]" value="<?= $nama ?>">
                                    <input type="hidden" name="prodi[]" value="<?= $jenjangProdi ?>">
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End Form Body -->
                    <!-- Form Footer -->
                    <div class="card-footer" style="">
                        <div class="text-right">
                            <button class="btn btn-success" onclick="" style="padding: 8px 30px 8px 30px;" type="submit"> Daftar
                            </button>
                        </div>
                    </div>
                    <!-- End Form Footer -->
                </form>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
                </div>
                <div class="card-body">
                    <ol>
	<li>Mahasiswa mengisi form pengajuan studi lapangan dengan benar untuk dapat mengunduh file surat izin studi lapangan</li>
	<li>Mahasiswa mencetak surat izin pada kertas ukuran A4</li>
	<li>Mahasiswa menyerahkan surat izin kepada staff administrasi di gedung H5 lantai 2</li>
	<li>Mahasiswa meminta tanda tangan kepada Kepala Jurusan Teknik Elektro</li>
	<li>Studi Lapangan dapat dilaksanakan minimal 7 hari setelah surat izin studi lapangan diajukan ke staff administrasi</li>
</ol>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end of container fluid-->
<script type="text/javascript">
    $("form").keydown(function (e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            return false;
        }
    });
    document.getElementById("tgl_buat").onclick = function(){
        var date = new Date();
            var newdate = new Date(date);
            newdate.setDate(newdate.getDate());
            var dd = ("0" + newdate.getDate()).slice(-2);
            var mm = ("0" + (newdate.getMonth() + 1)).slice(-2);
            var y = newdate.getFullYear();
            var someFormattedDate = y + '-' + mm + '-' + dd;
        document.getElementById("tgl_buat").value=someFormattedDate;
    }
    document.getElementById("tgl_buat").onchange = function() {
        var buat = document.getElementById("tgl_buat").value;
        var date = new Date(buat);
        var newdate = new Date(date);
        newdate.setDate(newdate.getDate() + 7);
        var dd = ("0" + newdate.getDate()).slice(-2);
        var mm = ("0" + (newdate.getMonth() + 1)).slice(-2);
        var y = newdate.getFullYear();
        var someFormattedDate = y + '-' + mm + '-' + dd;
        document.getElementById('valueDateStart').setAttribute("min", someFormattedDate);
    }
    document.getElementById("valueDateStart").onchange = function() {
        var input = document.getElementById("valueDateEnd");
        input.setAttribute("min", this.value);
    }
    $(document).ready(function () {
        var listAnggota = [];
        var validNim = 1;
        listAnggota.push($(".nimUser").text());

        //Menambah anggota dan menampilkan ke dalam tabel
        $("#addNim").click(function () {
            var value = $("#valueNim").val();
            if (value.length > 0) {
                if (listAnggota.includes(value)) {
                    $("#valueNim").toggleClass("is-invalid");
                    $("#invalidNim").text("NIM telah terdaftar");

                    validNim = 0;
                } else {
                    //Mengambil data mahasiswa bedasarkan nim yang diinputkan menggunakan ajax
                    $.ajax({
                        url: "<?=base_url('observasi/studilapangan/nambahanggota/')?>" + value,
                        method: "POST"
                    }).done(function (data) {
                        var result = [$.parseJSON(data)];

                        if (result != "noData") {
                            $.each(result, function (key, value) {
                                //menginisialisasi html attribute untuk hasil yang diperoleh tertampil
                                var html = "<tr class='" + value.username + "'>" +
                                    "<td>" + value.username + "</td>" +
                                    "<td>" + value.nama + "</td>" +
                                    "<td>" + value.prodi + "</td>" +
                                    "<td><button value='" + value.username + "' class='deleteAnggota btn btn-danger btn-sm' type='button'><i class='fa fa-times'></i>&nbsp;Hapus</button></td>" +
                                    "</tr>";
                                var hiddenInput = "<div class='form-group " + value.username + "'>" +
                                    "<input type='hidden' name='nim[]' value='" + value.username + "'>" +
                                    "<input type='hidden' name='nama[]' value='" + value.nama + "'>" +
                                    "<input type='hidden' name='prodi[]' value='" + value.prodi + "'>" +
                                    "</div>";
                                $("#dataAnggota").append(html);
                                $("#hiddenInputs").append(hiddenInput);
                            });


                            listAnggota.push(value);
                            $("#valueNim").val("");

                        } else {
                            $("#valueNim").toggleClass("is-invalid");
                            $("#invalidNim").text("Inputan Anda salah");
                            validNim = 0;
                        }
                    });
                }
            }


        });
        //Clear Text
        $("#valueNim").click(function () {
            if (validNim == 0) {
                $("#valueNim").toggleClass("is-invalid");
                $("#invalidNim").empty();
                $("#valueNim").val("");
                validNim = 1;
            }
        })

        //Menghapus anggota dari tabel
        $("#dataAnggota").on("click", "button", function () {
            var id = $(this).val();
            $("." + id).remove();

            for (var i = 0; i < listAnggota.length; i++) {
                if (listAnggota[i] == id) {
                    listAnggota.splice(i, 1);
                    i--;
                }
            }
            if (listAnggota.length < 3) {
                $("#addNim").attr("disabled", false);
            }
        });

        //View Validation form errors


        //Matkul
        var validMatkul = 1;
        if ($("#invalidMatkul").children().text().length != 0) {
            $("#valueMatkul").toggleClass("is-invalid");
            validMatkul = 0;
        }
        if (validMatkul == 0) {
            $("#valueMatkul").one("focus", function () {
                $("#valueMatkul").toggleClass("is-invalid");
                $("#invalidNim").empty();
                $("#valueMatkul").val("");
                validMatkul = 1;
            });
        }
        //Prodi Kelompok
        var validProdKel = 1;
        if ($("#invalidProdKel").children().text().length != 0) {
            $("#valueProdKel").toggleClass("is-invalid");
            validProdKel = 0;
        }
        if (validProdKel == 0) {
            $("#valueProdKel").one("focus", function () {
                $("#valueProdKel").toggleClass("is-invalid");
                $("#invalidProdKel").empty();
                $("#valueProdKel").val("");
                validProdKel = 1;
            });
        }

        //Judul Studi Lapangan
        var validJudul = 1;
        if ($("#invalidJudul").children().text().length != 0) {
            $("#valueJudul").toggleClass("is-invalid");
            validJudul = 0;
        }
        if (validJudul == 0) {
            $("#valueJudul").one("focus", function () {
                $("#valueJudul").toggleClass("is-invalid");
                $("#invalidJudul").empty();
                $("#valueJudul").val("");
                validJudul = 1;
            });
        }

        //Tujuan instansi
        var validTujuan = 1;
        if ($("#invalidTujuan").children().text().length != 0) {
            $("#valueTujuan").toggleClass("is-invalid");
            validTujuan = 0;
        }
        if (validTujuan == 0) {
            $("#valueTujuan").one("focus", function () {
                $("#valueTujuan").toggleClass("is-invalid");
                $("#invalidTujuan").empty();
                $("#valueTujuan").val("");
                validTujuan = 1;
            });
        }

        //Nama Instansi
        var validNamaIns = 1;
        if ($("#invalidNamaIns").children().text().length != 0) {
            $("#valueNamaIns").toggleClass("is-invalid");
            validNamaIns = 0;
        }
        if (validNamaIns == 0) {
            $("#valueNamaIns").one("focus", function () {
                $("#valueNamaIns").toggleClass("is-invalid");
                $("#invalidNamaIns").empty();
                $("#valueNamaIns").val("");
                validNamaIns = 1;
            });
        }

        //Alamat Instansi
        var validAlamat = 1;
        if ($("#invalidAlamat").children().text().length != 0) {
            $("#valueAlamat").toggleClass("is-invalid");
            validAlamat = 0;
        }
        if (validAlamat == 0) {
            $("#valueAlamat").one("focus", function () {
                $("#valueAlamat").toggleClass("is-invalid");
                $("#invalidAlamat").empty();
                $("#valueAlamat").val("");
                validAlamat = 1;
            });
        }

        //Compare Date Validation
        var validDateStart = 1;
        if ($("#invalidDateStart").children().text().length != 0) {
            $("#valueDateStart").toggleClass("is-invalid");
            validDateStart = 0;
        }
        if (validDateStart == 0) {
            $("#valueDateStart").one("focus", function () {
                $("#valueDateStart").toggleClass("is-invalid");
                $("#invalidDateStart").empty();
                $("#valueDateStart").val("");
                validDateStart = 1;
            });
        }

        var validDateEnd = 1;
        if ($("#invalidDateEnd").children().text().length != 0) {
            $("#valueDateEnd").toggleClass("is-invalid");
            validDateEnd = 0;
        }
        if (validDateEnd == 0) {
            $("#valueDateEnd").one("focus", function () {
                $("#valueDateEnd").toggleClass("is-invalid");
                $("#invalidDateEnd").empty();
                $("#valueDateEnd").val("");
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
                validDateEnd = 1;
            });
        }

        $("#valueDateStart").change(function () {
            var dateVal = $(this).val();
            $("#valueDateEnd").attr('min', dateVal);
        })
        //
    });

</script>
