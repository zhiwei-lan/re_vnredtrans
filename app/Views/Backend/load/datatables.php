<!-- Push section css -->
<?= $this->section('css') ?>
<link rel="stylesheet" href="/assets/lib/datatables/dataTables.bootstrap4.min.css">
<?= $this->endSection() ?>

<!-- Push section js -->
<?= $this->section('js') ?>
<script src="/assets/lib/moment@2.24.0/moment-with-locales.min.js"></script>
<script src="/assets/lib/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/lib/datatables/dataTables.bootstrap4.min.js"></script>
<script>
    moment.locale('<?= config('App')->defaultLocale ?>');
</script>
<script>
    $.extend( true, $.fn.dataTable.defaults, {
        language: {
            url: "/assets/lib/datatables/<?= config('Haoadmin')->i18n ?>.json"
        }
    });
</script>
<?= $this->endSection() ?>