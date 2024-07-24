<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pendaftaran Studi Lapangan</title>

</head>
<style>
    #judul{
        margin-left: 20px
    }
    label{
        padding-top: 20px
    }
    .text-sm{
        font-size: 10px;
    }
</style>
<body>
    <h1 class="h3 mb-4 text-gray-800" id="judul">Form Pengajuan Surat Izin Studi Lapangan</h1>
    <?php
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
                <div class="card-body" style="font-size: 17px">
                    Peserta Studi Lapangan<br><br>
                    <table style="border-collapse: collapse; width:100%; " class="table-bordered">
                        <tr style="text-align: center">
                            <td><b>NIM</b></td>
                            <td><b>Nama</b></td>
                            <td><b>Program Studi</b></td>
                        </tr>
                        <?php
                        foreach ($daftar_anggota as $row) { ?>
                            <tr>
                                <td><?php echo $row['nama'] ?></td>
                                <td><?php echo $row['prodi'] ?></td>
                                <td><?php echo $row['jenjang'] ?></td>
                        </tr>
                        <?php   
                            }
                        ?>

                        <?php
                         function tambahPeserta($peserta)
                         {  $con=new mysqli("localhost","root","","db_master");
                            $nim = $_POST['nim'];
                            $sql="SELECT COUNT(*) AS jml FROM user WHERE username='$nim' AND kat_no_induk='4'";
                            $result=$con->query($sql);
                             //$nim = $this->input->post('nim');
                             //$query=$this->db->query("SELECT COUNT(*) AS jml FROM user WHERE username='$nim' AND kat_no_induk='4' ");
                             foreach ($result as $row){
                                 if ($row['jml']==1) {
                                    //  array_push($peserta[0], 'nim');
                                    array_push($peserta, array(
                                        "0" =>$nim, 
                                        "1" => "nama", 
                                        "2" => "A",
                                        "3" => "b"
                                    ));
                                    echo "<div class='alert-info'>NIM Terdaftar!<div>";
                                    $x=1;
                                    foreach (array_slice($peserta, count($row)) as $row) {?>
                                        <tr>
                                        <td><center><?php $x=$x+1; echo $x  ?></center></td>
                                        <td><?php echo $row['0'] ?></td>
                                        <td><?php echo $row['1'] ?></td>
                                        <td><?php echo $row['2']." ".$row['3'] ?></td>
                                    </tr>
                                    <?php   echo ""; 
                                        }
                                    ?>
                                <?php
                                 } 
                                 else {
                                    echo "<script>alert('NIM SALAH')</script>";
                                    $x=1;
                                    foreach (array_slice($peserta, count($row)) as $row) {?>
                                        <tr>
                                        <td><center><?php $x=$x+1; echo $x  ?></center></td>
                                        <td><?php echo $row['0'] ?></td>
                                        <td><?php echo $row['1'] ?></td>
                                        <td><?php echo $row['2']." ".$row['3'] ?></td>
                                    </tr>
                                    <?php   echo ""; 
                                        }
                                    ?>
                                    <?php
                                 }
                             }
                         }

                         if(isset($_POST['tambah'])){
                                tambahPeserta($peserta);
                            } 

                        ?>
                        
                    </table>
                    <form action="<? echo base_url('admin/penelitian/tambahP') ?>" method="post">
                    <div class="alert-info" id="tambah" style="padding:20px">
                       <div class="row">
                       <input name="nim" id="nim" type="text" placeholder="Masukkan NIM" class="form-control" style="width:40%; margin-left:20px" required>
                      <button class="btn btn-info btn-sm" id="tambah" name="tambah">Tambah Peserta</button>
                       </div>
                    </div></form>
                    

                    <br>
                    <input type="submit" value="Konfirmasi" class="btn btn-primary">
               
                </div>
                </div>
            </div>
    
            <div class="col-md-3">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
          </div>
          <div class="card-body">
           Cetak di kertas ukuran A4 <br>
           Satu surat izin utk satu kelompok
           Surat izin studi .s.....
          </div>
        </div>
      </div>
        </div>

</body>
</html>