<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800" id="judul">Buat Ticket Support</h1>
    <div class="row">
        <div class="col-md-1">
    </div>
        <div class="col-md-9">
            <div class="card shadow mb-4">
                <div class="card-body" style="font-size: 17px">
            <!-- Message -->
            <?php
                $info = $this->session->flashdata('info');
                $color_info = $this->session->flashdata('color_info');
                if(!empty($info)&&!empty($color_info)){
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
            <!-- /col-lg-12 -->
                <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-12 control-label">Kategori Ticket</label>
                        <div class="col-md-12">
                            <select name="kategori" id="kategori" class="form-control" data-validation="required" autofocus required>
                                <option value="">-- Pilih --</option>
                                <?php foreach($data_kategori as $kategori){ ?>
                                    <option value="<?= $kategori->id ?>"><?= $kategori->nama_kategori_ticket ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12 control-label">Sub Kategori Ticket</label>
                        <div class="col-md-12">
                            <select name="sub_kategori" id="sub_kategori" class="form-control" data-validation="required" required>
                                <option value="">-- Pilih --</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12 control-label">Urgensi</label>
                        <div class="col-md-12">
                            <select name="urgensi" id="urgensi" class="form-control" data-validation="required" required>
                                <option value="">-- Pilih --</option>
                                <option value="1">Tinggi</option>
                                <option value="2">Sedang</option>
                                <option value="3">Rendah</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12 control-label">Judul Ticket</label>
                        <div class="col-md-12">
                            <input class="form-control" name="judul_ticket" type="text" data-sanitize="trim" data-validation="required length" data-validation-length="1-255" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12 control-label">Detail Kendala</label>
                        <div class="col-md-12">
                            <textarea rows="5" cols="30" class="form-control" name="detail_kendala" data-validation="required" style="resize: vertical;" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12 control-label">Lampiran<br> <span style="font-size: 10pt">Ekstensi file lampiran yang bisa anda upload bebas(dapat berupa .jpg, .pdf, dsb) sesuai kebutuhan. Maksimal ukuran file sebesar 2MB. Apabila terdapat lebih dari satu file maka kompres menjadi satu file dengan ekstensi .rar atau .zip</span></label>
                        <div class="col-md-12">
                            <input type="file" class="form-control" name="lampiran" data-validation="size required" data-validation-min-size="1kb" data-validation-max-size="2M" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12 control-label">Tujuan Ticket</label>
                        <div class="col-md-12">
                            <select name="tujuan_ticket" id="tujuan_ticket" class="form-control" data-validation="required" required>
                                <option value="">-- Pilih --</option>
                                <option value="1">Bagian Teknis</option>
                                <option value="2">Bagian Administrasi</option>
                                <!-- <option value="3">Kepala Laboratorium (Bidang Umum)</option> -->
                                <!-- <option value="4">Koordinator PI</option>-->
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-9">
                            <button class="btn btn-primary" type="submit" name="tambah">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#kategori').change(function(){
            var kategori = $(this).val();

            // AJAX request
            $.ajax({
                url: '<?= base_url('ticket/getSubKategori'); ?>',
                method: 'post',
                data: {kategori: kategori},
                dataType: 'json',
                success: function(response){
                    // Remove options 
                    $('#sub_kategori').find('option').not(':first').remove();

                    // Add options
                    $.each(response,function(index,data){
                        $('#sub_kategori').append('<option value="'+data['id']+'">'+data['sub_kategori']+'</option>');
                    });
                }
            });
        });
    });
</script>
