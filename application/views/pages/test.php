<table class="table-borderless text-gray-800" width="100%" style="border-collapse: collapse">
                   <tr>
                       <td>
                           <label for="matakuliah">Matakuliah </label>
                           <input type="text" class="form-control" name="matkul" required value="">
                       </td>
                   </tr>
                   <tr>
                       <td>
                           <label for="">Judul Studi Lapangan <br><span class="text-sm">Contoh: Wawancara Mengenai Kurikulum SMK</span></label>
                           <input type="text" name="" id="" class="form-control" required>
                       </td>
                   </tr>
                   <tr>
                       <td>
                           <label for="">Instansi Tujuan <br><span class="text-sm">Contoh: SMKN 2 Malang</span></label>
                           <input type="text" name="" id="" class="form-control" required>
                       </td>
                   </tr>
                   <tr>
                       <td>
                           <label for="">Nama Pihak Instansi Tujuan/Penerima Surat <br> <span class="text-sm">Contoh: Kepala SMKN 2 Malang</span>
                           </label>
                           <input type="text" class="form-control" required>
                       </td>
                   </tr>
                   <tr>
                       <td>
                           <label for="">Alamat Pihak Instansi Tujuan/Penerima Surat <br> <span class="text-sm">Contoh: Jalan Bondowoso No. 18, Klojen, Malang </span></label>
                           <input type="text" class="form-control" required>
                       </td>
                   </tr>
                   <tr>
                       <td>
                           <?php
                           $date = date_create(date('Y-m-d'));
                           date_add($date, date_interval_create_from_date_string("7 days"));

                           ?>
                           <label for="">Tanggal Studi Lapangan Dimulai <br><span class="text-sm">Tanggal Pelaksanaan Studi Lapangan berjarak 1 minggu setelah form permohonan diajukan ke Administrasi Jurusan</span></label>
                           <input type="text" value="<?php echo tgl_indo(date_format($date, "Y-m-d")); ?>"
                                  class="form-control" readonly>
                       </td>
                   </tr>
                   <tr>
                       <td>
                           <label for="">Tanggal Studi Lapangan Diakhiri</label>
                           <script>
                               $('.datepicker').datepicker({
                                   startDate: '+7d'
                               });
                           </script>

                           <div class="input-group date" data-provide="datepicker">
                               <input type="text" class="form-control datepicker" required
                                      placeholder="Format mm/dd/yyyy">
                               <div class="input-group-addon">
                                   <span class="glyphicon glyphicon-th"></span>
                               </div>
                           </div>
                       </td>
                   </tr>
               </table>
               <hr>
               Peserta Studi Lapangan<br><br>
               <?php
               $this->db->db_select('db_master');
               $query = $this->db->query("select * from prodi where kode_prodi=$user_sess[kode_prodi]");
               foreach ($query->result() as $row) {
                   $prodi = $row->nama_prodi;
               }
               $query = $this->db->query("select * from jenjang where id_jenjang=$user_sess[jenjang]");
               foreach ($query->result() as $row) {
                   $jenjang = $row->nama_jenjang;
               }

               $peserta = array(
                   array("$user_sess[username]", "$user_sess[nama_lengkap]", $jenjang, $prodi)
               );
               ?>
               <table style="border-collapse: collapse; width:100%; " class="table-bordered">
                   <tr>
                       <td>
                           <center><b>No.</b></center>
                       </td>
                       <td>
                           <center><b>NIM</b></center>
                       </td>
                       <td>
                           <center><b>Nama</b></center>
                       </td>
                       <td>
                           <center><b>Program Studi</b></center>
                       </td>
                   </tr>
                   <tr>
                       <td>
                           <center>1</center>
                       </td>
                       <td><?php echo $peserta[0][0] ?></td>
                       <td><?php echo $peserta[0][1] ?></td>
                       <td><?php echo $peserta[0][2] . " " . $peserta[0][3] ?></td>
                   </tr>
               </table>

               <script>
                   $('#tambah').on('click', function () {
                       var kobar = $('#nim').val();
                       $.ajax({
                           type: "POST",
                           url: "tambahpeserta",
                           dataType: "JSON",
                           data: {kobar: kobar, nabar: nabar, harga: harga},
                           success: function (data) {
                               $('[name="kobar"]').val("");
                               $('[name="nabar"]').val("");
                               $('[name="harga"]').val("");
                               $('#ModalaAdd').modal('hide');
                               tampil_data_barang();
                           }
                       });
                       return false;
                   });
               </script>
               <form action="" method="post">
                   <div class="alert-info" id="tambah" style="padding:20px">
                       <div class="row">
                           <input name="nim" id="nim" type="text" placeholder="Masukkan NIM" class="form-control"
                                  style="width:40%; margin-left:20px" required>
                           <button class="btn btn-info btn-sm" id="tambah">Tambah Peserta</button>
                       </div>
                   </div>
               </form>


               <br>
               <input type="submit" value="Konfirmasi" class="btn btn-primary">
