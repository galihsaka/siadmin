<!-- Page level plugins -->
<script src="<?php echo base_url('assets/chart.js/Chart.min.js')?>"></script>
<script src="<?php echo base_url('js/demo/chart-pie-demo.js') ?>"></script>

<script type="text/javascript">
    $(document).ready(function () {

        //Live Update function
        function render_view() {
            $.getJSON(
                "<?=base_url('pengelola/report/log_update')?>",
                function (result) {

                    $("#countSuratMasuk").text(result.surat_masuk);
                    $("#countStudiLapangan").text(result.studi_lapangan);
                    $("#countPenelitian").text(result.penelitian);
                }
            );
        }

        //Initial
        $.getJSON(
            "<?=base_url('pengelola/report/log_update')?>",
            function (result) {
                $("#countSuratMasuk").text(result.surat_masuk);
                $("#countStudiLapangan").text(result.studi_lapangan);
                $("#countPenelitian").text(result.penelitian);
            }
        );

        $.getJSON(
            "<?=base_url('pengelola/report/countDataLog')?>",
            function (result) {
                renderChart("myDataLogChart", result);
            }
        );


        // Trigger Live Update
        setInterval(function () {
            render_view();
        }, 30000);
    });
</script>