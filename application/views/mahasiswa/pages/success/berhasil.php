<!--Prevent going back on every success page-->
<script type="text/javascript" >
    // $(document).ready(function() {
    //         window.history.pushState(null, "", window.location.href);
    //         window.onpopstate = function() {
    //             window.history.pushState(null, "", window.location.href);
    //         };
    // });
</script>
<!--Prevent going back on every success page end-->

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800" id="judul"><?php echo $title?></h1>
    <div class="row">
        <div class="col-md-9">
            <div class="card shadow mb-4">
                <div class="card-body">

                    <div style="text-align: center">Pendaftaran Berhasil</div>
                    <br>
                    <div style="text-align: center">
                        <a href="<?php echo base_url($url) ?>">
                            <button class="btn btn-primary btn-sm">Lihat Riwayat</button>
                        </a>
						
                        <a href="<?php if($title != 'Pendaftaran Studi Lapangan' && $stat=="Berhasil"){echo base_url($url2);}?>"<?php if($title != 'Pendaftaran Studi Lapangan' && $stat=="Berhasil"){echo " target='_blank'" ;}?> <?php if($title == "Pendaftaran Studi Lapangan"){echo "data-toggle='modal' data-target='#print'";}elseif ($title != 'Pendaftaran Studi Lapangan') {
                            if($stat=="Gagal"){
                            echo "data-toggle='modal' data-target='#printpem1'";
                        }
                        }?>
                           class='btn btn-info btn-icon-split btn-sm'>
                                    <span class='icon text-white-50'>
                                        <i class='fas fa-print'></i>
                                    </span>
                            <span class='text'>Cetak&nbsp;&nbsp;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
         <!-- MODAL CETAK -->
                                <div class="modal fade" id="print" tabindex="-1" role="dialog"
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
                                                <?php echo form_open($url2) ?>
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
                                <div class="modal fade" id="printpem1" tabindex="-1" role="dialog"
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
                                                <?php echo form_open($url2) ?>
                                                <table style="border-collapse: collapse; padding:0px"
                                                       class="table table-sm table-borderless">
                                                    <tr>
                                                        <td colspan="2"><div class="alert alert-primary">Pilih dosen pembimbing 1</div></td>
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

        <div class="col-md-9">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
                </div>
                <div class="card-body">
                    <?php
					
					if( $title == "Pendaftaran Studi Lapangan"){
						echo " $title
							<ol>
								<li>Mahasiswa mengisi form pengajuan studi lapangan dengan benar untuk dapat mengunduh file surat izin studi lapangan</li>
								<li>Mahasiswa mencetak surat izin pada kertas ukuran A4</li>
								<li>Mahasiswa menyerahkan surat izin kepada staff administrasi di gedung H5 lantai 2</li>
								<li>Mahasiswa meminta tanda tangan kepada Kepala Jurusan Teknik Elektro</li>
								<li>Studi Lapangan dapat dilaksanakan minimal 7 hari setelah surat izin studi lapangan diajukan ke staff administrasi</li>
							</ol>
						";
					} elseif( $title == "Pendaftaran Penelitian Jurusan") {
						echo " $title
							<ol>
								<li>Mahasiswa mengisi form pengajuan penelitian dengan benar untuk dapat mengunduh file surat izin penelitian</li>
								<li>Mahasiswa mencetak surat izin pada kertas ukuran A4</li>
								<li>Mahasiswa meminta tanda tangan kepada pembimbing satu</li>
								<li>Mahasiswa menyerahkan surat izin kepada staff administrasi di gedung H5 lantai 2</li>
								<li>Penelitian dapat dilaksanakan minimal 7 hari setelah surat izin penelitian diajukan ke staff administrasi</li>
							</ol>
						";
					}else {
						echo "$title
							<ol>
								<li>Mahasiswa mengisi form pengajuan penelitian dengan benar untuk dapat mengunduh file surat izin penelitian</li>
								<li>Mahasiswa mencetak surat izin pada kertas ukuran A4</li>
								<li>Mahasiswa meminta tanda tangan kepada Kaprodi dan pembimbing 1</li>
								<li>Mahasiswa menyerahkan surat izin kepada staff administrasi di gedung H5 lantai 2</li>
								<li>Penelitian dapat dilaksanakan minimal 7 hari setelah surat izin penelitian diajukan ke staff administrasi</li>
							</ol>
						";
					}
					
					?>
                </div>
            </div>
        </div>
    </div>

</div>