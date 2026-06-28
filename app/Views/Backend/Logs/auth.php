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
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="table-userlogs" class="table table-striped table-hover va-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>IP</th>
                                <th>Email</th>
                                <th><?= lang('Haoadmin.global.user_agent') ?></th>
                                <th>type</th>
                                <th>status</th>
                                <th>date</th>
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
    var tableUser = $('#table-userlogs').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        order: [[1, 'asc']],

        ajax: {
            url: '<?= route_to('haoadmin/authlogs') ?>',
            method: 'GET'
        },
        columnDefs: [{
            orderable: false,
            targets: [0,3,5]
        }],
        columns: [{
                'data': null
            },
            {
                'data': 'ip_address'
            },
            {
                'data': 'identifier'
            },
            {
                'data': 'user_agent'
            },
            {
                'data': 'id_type'
            },
            {
                'data': 'success'
            },
            {
                'data': 'date',
                'render': function(data) {
                    return moment(data).fromNow()
                }
            }
        ]
    });

    tableUser.on('draw.dt', function() {
        var PageInfo = $('#table-userlogs').DataTable().page.info();
        tableUser.column(0, {
            page: 'current'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
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