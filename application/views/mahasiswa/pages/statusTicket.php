<script src="<?php echo base_url('assets/datatables/DataTables-1.10.18/js/jquery.dataTables.min.js') ?>"></script>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div id="buttonContainer" style="padding-bottom: 20px">

                <!-- BUTTON TAMBAH DATA -->
                <a href="<?= base_url('ticket/openTicket') ?>"
                   class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                    <span class="text">Buat Ticket</span>
                </a>
            </div>
            <!-- Message -->
                <?php
                function tgl($tanggal)
                {
                    $pecahkan = explode('-', $tanggal);
                    $pec= explode(' ', $pecahkan[2]);
                    return $pec[0] . '-' . $pecahkan[1] . '-' . $pecahkan[0].' '.$pec[1];
                }
                ?>

                <div class="table-responsive">
                <table class="table table-hover" id="dataTicket" width="100%" cellspacing="0">
                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nomor Ticket</th>
                                            <th>Kategori</th>
                                            <th>Judul</th>
                                            <th>Waktu Input</th>
                                            <th>Status</th>
                                            <th>Operasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            $showStatus = "";
                                            foreach($data_ticket as $row){
                                                if($row->status_ticket=="1"){
                                                    $showStatus = "<span class=\"badge badge-primary\">Open</span>";
                                                }elseif($row->status_ticket=="2"){
                                                    $showStatus = "<span class=\"badge badge-info\">Reply by Member</span>";
                                                }elseif($row->status_ticket=="3"){
                                                    $showStatus = "<span class=\"badge badge-warning\">Reply by Petugas</span>";
                                                }elseif($row->status_ticket=="4"){
                                                    $showStatus = "<span class=\"badge badge-success\">Solved</span>";
                                                }elseif($row->status_ticket=="5"){
                                                    $showStatus = "<span class=\"badge badge-default\">Closed</span>";
                                                }
                                        ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $row->id_ticket; ?></td>
                                            <td><?= $row->nama_kategori_ticket; ?></td>
                                            <td><?= $row->judul_ticket; ?></td>
                                            <td><?= tgl($row->tgl_input); ?></td>
                                            <td><?= $showStatus; ?></td>
                                            <td><a href="<?php echo base_url('ticket/view?id='.$row->id_ticket) ?>" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a></td>
                                        </tr>
                                        <?php
                                                $no++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
<script>
    $(document).ready(function(){
        $('#dataTicket').DataTable();
    });
</script>