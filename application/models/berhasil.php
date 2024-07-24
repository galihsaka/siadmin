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
		<?php echo $url2;?>
                    <div style="text-align: center">Pendaftaran Berhasil</div>
                    <br>
                    <div style="text-align: center">
                        <a href="<?php echo base_url($url) ?>">
                            <button class="btn btn-primary btn-sm">Lihat Riwayat</button>
                        </a>
						
                        <a href="<?php if($title != "Pendaftaran Studi Lapangan"){echo base_url($url2);}?>" <?php if($title == "Pendaftaran Studi Lapangan"){echo "data-toggle='modal' data-target='#print'";}?> 
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

        <div class="col-md-3">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
                </div>
                <div class="card-body">
                    <ol>
                        <li>Surat pengajuan penelitian dicetak di kertas ukuran A4</li>
                        <li>Surat pengajuan penelitian yang telah ditandatangani diserahkan ke administrasi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

</div>