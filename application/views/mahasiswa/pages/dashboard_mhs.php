<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Mahasiswa -->
    <div class="row" id="Mahasiswa" style="">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Surat Izin Studi Lapangan</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="height: 10rem;" src="<?= base_url('img/undraw_team_spirit_hrr4.png') ?>" alt="">
                    </div>
                    <p style="text-align:justify">Surat izin studi lapangan merupakan syarat pengajuan studi lapangan dalam rangka pemenuhan tugas observasi pada matakuliah tertentu. Studi lapangan dapat dilakukan secara individu maupun berkelompok.</p>
                    <a rel="nofollow" href="<?php echo base_url('observasi/studilapangan/daftarstudilapangan') ?> ">
                        <button class="btn btn-primary form-control">Ajukan</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Surat Izin Penelitian Ke Jurusan</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="height: 10rem" src="<?= base_url('img/undraw_coming_home_52ir.png') ?>" alt="">
                    </div>
                    <p style="text-align:justify">
                        Surat izin penelitian ke jurusan merupakan syarat untuk mengajukan penelitian ke Jurusan Teknik Elektro Universitas Negeri Malang. Surat izin ini dikhususkan untuk penelitian skripsi dan tugas akhir.
                        <?php
                        if($cek==0){
                        echo "<div class='alert alert-warning'>Anda tidak memiliki data judul skripsi/TA yang terdaftar di SISINTA, silakan input judul secara manual</div>";
                        }
                        ?>
                    </p>
                    <a rel="nofollow" href="<?php echo base_url('mhs/penelitian_jurusan/daftar') ?> ">
                        <button class="btn btn-primary form-control">Ajukan</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Surat Izin Penelitian Ke Instansi</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="height: 10rem;" src="<?= base_url('img/undraw_house_searching_n8mp.png') ?>" alt="">
                    </div>
                    <p style="text-align:justify">
                        Surat izin penelitian ke instansi merupakan syarat pengajuan penelitian ke salah satu instansi atau sekolah tertentu. Surat izin ini dikhususkan untuk penelitian skripsi dan tugas akhir.
                        <?php
                        if($cek==0){
                        echo "<div class='alert alert-warning'>Anda tidak memiliki data judul skripsi/TA yang terdaftar di SISINTA, silakan input judul secara manual</div>";
                        }
                        ?>
                    </p>
                    <a rel="nofollow" href="<?php echo base_url('mhs/penelitian_instansi/daftar') ?> ">
                        <button class="btn btn-primary form-control">Ajukan</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Surat Izin Penelitian ke Dinas</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="height: 10rem" src="<?= base_url('img/undraw_best_place_r685.png') ?>" alt="">
                    </div>
                    <p style="text-align:justify">
                        Surat izin penelitian ke dinas merupakan syarat pengajuan penelitian ke dinas untuk melakukan penelitian ke satu atau lebih sekolah. Surat izin ini dikhususkan untuk penelitian skripsi dan tugas akhir.
                        <?php
                        if($cek==0){
                        echo "<div class='alert alert-warning'>Anda tidak memiliki data judul skripsi/TA yang terdaftar di SISINTA, silakan input judul secara manual</div>";
                        }
                        ?>
                    </p>
                    <a rel="nofollow" href="<?php echo base_url('mhs/penelitian_dinas/daftar') ?> ">
                        <button class="btn btn-primary form-control">Ajukan</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->