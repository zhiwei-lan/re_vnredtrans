<script>
    $.ajaxSetup({
        headers: {
        '<?= config('Security')->headerName ?>': 
        $('meta[name="<?= csrf_token() ?>"]').attr('content')}
    });
    // token auto update
    $(document).ajaxComplete(function (e, xhr) {
        const token = xhr.getResponseHeader('x-csrf-token');
        if (token) {
            console.log(token);
            $('meta[name="<?= csrf_token() ?>"]').attr('content', token);
            $('input[name="<?= csrf_token() ?>"]').val(token);
            $.ajaxSetup({
            headers: {
            '<?= config('Security')->headerName ?>': token
            }});
        }
    });
</script>