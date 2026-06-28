<?= $this->include('Backend/load/select2') ?>
<?= $this->include('Backend/load/datatables') ?>
<!-- Extend from layout index -->
<?= $this->extend('Backend/layout/index') ?>

<!-- Section content -->
<?= $this->section('content') ?>
<!-- SELECT2 EXAMPLE -->
<div class="card card-default">
    <div class="card-header">
        <div class="card-tools">
            <div class="btn-group">
                <a href="<?= route_to('admin.slide.new') ?>" class="btn btn-sm btn-block btn-primary"><i class="fa fa-plus"></i>
                    <?= lang('Haoadmin.slide.add') ?>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="table-article" class="table table-striped table-hover va-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?= lang('Haoadmin.global.language') ?></th>
                                <th><?= lang('Haoadmin.slide.fields.code') ?></th>
                                <th><?= lang('Haoadmin.slide.fields.active') ?></th>
                                <th><?= lang('Haoadmin.slide.fields.created_at') ?></th>
                                <th><?= lang('Haoadmin.global.action') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.card -->
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    var tableUser = $('#table-article').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        order: [[1, 'asc']],

        ajax: {
            url: '<?= route_to('admin.slide.manage') ?>',
            method: 'GET'
        },
        columnDefs: [{
            orderable: false,
            targets: [2,3]
        }],
        columns: [{
                'data': null
            },
            {
                'data': 'lang'
            },
            {
                'data': 'code'
            },
            {
                'data': function(data) {
                    return `<span class="badge ${data.active == 1 ? 'bg-success' : 'bg-danger'}">${data.active == 1 ? '<?= lang('Haoadmin.slide.fields.active') ?>' : '<?= lang('Haoadmin.slide.fields.non_active') ?>'}</span>`
                }
            },
            {
                'data': 'created_at',
                'render': function(data) {
                    return moment(data).fromNow()
                }
            },
            {
                "data": function(data) {
                    return `<td class="text-right py-0 align-middle">
                            <div class="btn-group btn-group-sm">
                                <a href="<?= route_to('admin.slide.manage') ?>/${data.id}/edit" class="btn btn-primary btn-edit"><i class="fas fa-pencil-alt"></i></a>
                                <button class="btn btn-danger btn-delete" data-id="${data.id}"><i class="fas fa-trash"></i></button>
                            </div>
                            </td>`
                }
            }
        ]
    });

    tableUser.on('draw.dt', function() {
        var PageInfo = $('#table-article').DataTable().page.info();
        tableUser.column(0, {
            page: 'current'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });

    $(document).on('click', '.btn-delete', function(e) {
        Swal.fire({
                title: '<?= lang('Haoadmin.global.sweet.title') ?>',
                text: "<?= lang('Haoadmin.global.sweet.text') ?>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<?= lang('Haoadmin.global.sweet.confirm_delete') ?>'
            })
            .then((result) => {
                if (result.value) {
                    $.ajax({
                        url: `<?= route_to('admin.slide.manage') ?>/${$(this).attr('data-id')}/delete`,
                        method: 'POST',
                    }).done((data, textStatus, jqXHR) => {
                        Toast.fire({
                            icon: 'success',
                            title: jqXHR.statusText,
                        });
                        tableUser.ajax.reload();
                    }).fail((error) => {
                        Toast.fire({
                            icon: 'error',
                            title: error.responseJSON.messages.error,
                        });
                    })
                }
            })
    });

    tableUser.on('order.dt search.dt', () => {
        tableUser.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
</script>
<?= $this->endSection() ?>