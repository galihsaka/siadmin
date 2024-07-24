<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<script>
    $(function () {
        $("#dateSuratMasuk").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
        $("#dateSuratMasuk").on("change", function () {
            var selected = $(this).val();
            window.location = '<?=base_url('admin/suratmasuk/') ?>'+selected;
        });
    })
</script>
