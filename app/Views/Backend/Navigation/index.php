<!-- Include -->
<?= $this->include('Backend/load/nestable') ?>
<?= $this->include('Backend/load/select2') ?>
<?= $this->include('Backend/load/iconpicker') ?>
<!-- Extend from layout index -->
<?= $this->extend('Backend/layout/index') ?>

<!-- Section content -->
<?= $this->section('content') ?>
    <?= $this->include('Backend/Navigation/update') ?>
    <?= $this->include('Backend/load/language') ?>
    <style>.fade.in{opacity: 1;}</style>
    <div class="row">
        <div class="col-lg-5">
            <div class="card card-primary card-outline">
                <div id="nestable-menu" class="card-header">
                    <div class="btn-group">
                        <button class="btn btn-info btn-sm tree-tools" data-action="expand" title="Expand">
                            <i class="fas fa-chevron-down"></i>&nbsp;<?= lang('Haoadmin.menu.expand') ?>
                        </button>
                        <button class="btn btn-info btn-sm tree-tools" data-action="collapse" title="Collapse">
                            <i class="fas fa-chevron-up"></i>&nbsp;<?= lang('Haoadmin.menu.collapse') ?>
                        </button>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-primary btn-sm save" data-action="save" title="Save"><i class="fa fa-save"></i><span class="hidden-xs">&nbsp;<?= lang('Haoadmin.menu.move') ?></span></button>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-warning btn-sm refresh" data-action="refresh" title="Refresh"><i class="fas fa-sync-alt"></i><span class="hidden-xs">&nbsp;<?= lang('Haoadmin.menu.refresh') ?></span></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="dd" id="menu"></div>
                </div>
            </div><!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-7">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <div class="float-left">
                        <h5><?= lang('Haoadmin.navigation.add') ?></h5>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= route_to('admin.navigation.create') ?>" method="post" class="form-horizontal">
                        <?= csrf_field() ?>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"><?= lang('Haoadmin.navigation.fields.parent') ?></label>
                            <div class="col-sm-10">
                               <select class="form-control parent" name="parent_id" style="width: 100%;">
                                    <option selected value="0">ROOT</option>
                                    <?php foreach ($menus as $menu) { ?>
                                        <option <?= ($menu['id'] == old('parent_id')) ? 'selected' : '' ?> value="<?= $menu['id'] ?>"><?= $menu['title'] ?></option>
                                    <?php } ?>
                                </select>
                                <?php if (session('error.parent_id')) { ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.parent_id') ?></h6>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"><?= lang('Haoadmin.menu.fields.active') ?></label>
                            <div class="col-sm-10">
                                <select class="form-control parent" name="active" style="width: 100%;">
                                    <option selected value="1"><?= lang('Haoadmin.menu.fields.active') ?></option>
                                    <option value="0"><?= lang('Haoadmin.menu.fields.non_active') ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label"><?= lang('Haoadmin.navigation.fields.name') ?></label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                    </div>
                                    <input type="text" name="title" class="form-control <?= session('error.title') ? 'is-invalid' : '' ?>" value="<?= old('title') ?>" placeholder="<?= lang('Haoadmin.navigation.fields.name') ?>" autocomplete="off">
                                    <?php if (session('error.title')) { ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.title') ?></h6>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label"><?= lang('Haoadmin.navigation.fields.subject') ?></label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-terminal"></i></span>
                                    </div>
                                    <input type="text" name="subject" class="form-control <?= session('error.subject') ? 'is-invalid' : '' ?>" value="<?= old('subject') ?>" placeholder="<?= lang('Haoadmin.navigation.fields.subject') ?>" autocomplete="off">
                                    <?php if (session('error.subject')) { ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.subject') ?></h6>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label"><?= lang('Haoadmin.navigation.fields.description') ?></label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-brush"></i></span>
                                    </div>
                                    <input type="text" name="description" class="form-control <?= session('error.description') ? 'is-invalid' : '' ?>" value="<?= old('description') ?>" placeholder="<?= lang('Haoadmin.navigation.fields.description') ?>" autocomplete="off">
                                    <?php if (session('error.description')) { ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.description') ?></h6>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label"><?= lang('Haoadmin.navigation.fields.url') ?></label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-link"></i></span>
                                    </div>
                                    <input type="text" name="url" class="form-control <?= session('error.url') ? 'is-invalid' : '' ?>" value="<?= old('url') ?>" placeholder="<?= lang('Haoadmin.navigation.fields.url') ?>" autocomplete="off">
                                    <?php if (session('error.url')) { ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.url') ?></h6>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        

                        <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label"><?= lang('Haoadmin.navigation.fields.open_new') ?></label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="open" name="open_new">
                                        <label class="custom-control-label" for="open"></label>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="float-right btn btn-sm btn-primary"><?= lang('Haoadmin.global.save') ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col-md-6 -->
    </div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
$(function () {
    $('.icon-picker').iconpicker({
        placement: 'bottomRight',
        hideOnSelect: true,
        inputSearch: true,
    });
    $('.parent').select2();

    menu();

    function menu() {
        $.get("<?= route_to('admin.navigation.manage') ?>", function(response) {
            $('.dd').nestable({
                maxDepth: 10,
                json: response.data,
                contentCallback: (item) => {
                    let link = item.url;
                    if (item.open_new == 1) {
                        link = link.replace(/^\/ko\//, '');
                    }
                    let href = item.open_new == 1 ? link : "<?= base_url() ?>" + link;
                    return `<i class="${item.icon}"></i>&nbsp;<strong>${item.title}</strong>&nbsp;&nbsp;&nbsp;<a href="${href}" class="dd-nodrag">${link}</a>&nbsp;&nbsp;${item.active==='0'?'<span class="badge bg-danger"><?= lang('Haoadmin.menu.fields.non_active') ?></span>':''}
                            
                    <span class="float-right dd-nodrag">
                                <button data-id="${item.id}" id="btn-creat" class="btn btn-success btn-xs"><span class="fa fa-fw fa-plus"></span></button>
                                <button data-id="${item.id}" id="btn-language" class="btn btn-default btn-xs"><span class="fas fa-globe"></span></button>
                                <button data-id="${item.id}" id="btn-edit" class="btn btn-primary btn-xs"><span class="fa fa-fw fa-pencil-alt"></span></button>
                                <button data-id="${item.id}" id="btn-delete" class="btn btn-danger btn-xs"><span class="fa fa-fw fa-trash"></span></button>
                            </span>`;
                }
            });
        });
    }

    $('.tree-tools').on('click', function(e) {
        var action = $(this).data('action');
        if (action === 'expand') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse') {
            $('.dd').nestable('collapseAll');
        }
    });

    $('.save').on('click', function (e) {
        e.preventDefault();
        var serialize = $('#menu').nestable('toArray');
        var btnSave = $(this);
        $(this).attr('disabled', true);
        $(this).html('<i class="fas fa-spinner fa-spin"></i>');
        console.log('save')
        $.ajax({
            url: `<?= route_to('admin.navigation.sort') ?>`,
            method: 'POST',
            dataType: 'JSON',
            data: JSON.stringify(serialize)
        }).done((data, textStatus, jqXHR) => {
            Toast.fire({
                icon: 'success',
                title: jqXHR.statusText
            });
            btnSave.attr('disabled', false);
            btnSave.html('<i class="fa fa-save"></i> ' + "<?= lang('Haoadmin.global.save') ?>");
            $('.dd').nestable('destroy');
            menu();
        }).fail((error) => {
            Toast.fire({
                icon: 'error',
                title: error.responseJSON.messages.error,
            });
            btnSave.attr('disabled', false);
            btnSave.html('<i class="fa fa-save"></i> ' + "<?= lang('Haoadmin.global.save') ?>");
        })
    });

    $('.refresh').on('click', function (e) {
        location.reload(true);
    });

    $(document).on('click', '#btn-edit', function(e) {
        e.preventDefault();
        $('.is-invalid').removeClass('is-invalid');

        $.ajax({
            url: `<?= route_to('admin.navigation.manage') ?>/${$(this).attr('data-id')}/edit`,
            method: 'GET',
            dataType: 'JSON',
            
        }).done((response) => {

            $('#active').select2();
            $('#parent_id').select2({
                data: response.menu
            });
            var editForm = $('#form-edit');
            var parent_id = response.data.parent_id == 0 ? 0 : response.data.parent_id;
            editForm.find('select[name="active"]').val(response.data.active).change();
            editForm.find('select[name="parent_id"]').val(parent_id).change();
            editForm.find('input[name="title"]').val(response.data.title);
            editForm.find('input[name="url"]').val(response.data.url);
            editForm.find('input[name="subject"]').val(response.data.subject);
            editForm.find('input[name="description"]').val(response.data.description);
            editForm.find('input[name="open_new"]').prop('checked',response.data.open_new>0?true:false);

            $("#menu_id").val(response.data.id);
            $('#modal-update').modal('show');

        }).fail((jqXHR, textStatus, errorThrown) => {
            Toast.fire({
                icon: 'error',
                title: jqXHR.responseJSON.messages.error,
            });
        })
    });

    $(document).on('change', '#language', function(e) {
        $.ajax({
            url: `<?= route_to('admin.language.manage') ?>`,
            method: 'GET',
            dataType: 'JSON',
            data:{
                'trans_id': $('#trans_id').val(),
                'trans_type': 'navigation',
                'lang': e.target.value
            }
            
        }).done((response) => {
            if(response.data==null){
                response.data={id:'',title:'',description:'',subject:''};
            }
            var editForm = $('#form-language');
            editForm.find('input[name="id"]').val(response.data.id);
            editForm.find('input[name="title"]').val(response.data.title);
            editForm.find('input[name="description"]').val(response.data.description);
            editForm.find('input[name="subject"]').val(response.data.subject);

        }).fail((jqXHR, textStatus, errorThrown) => {
            Toast.fire({
                icon: 'error',
                title: jqXHR.responseJSON.messages.error,
            });
        })
    });

    $(document).on('click', '#btn-language', function(e) {
        e.preventDefault();
        $('.is-invalid').removeClass('is-invalid');
        $('#trans_id').val($(this).attr('data-id'));
        const transType = 'navigation';
        $('#trans_type').val(transType);
        $.ajax({
            url: `<?= route_to('admin.language.manage') ?>`,
            method: 'GET',
            dataType: 'JSON',
            data:{
                'trans_id': $(this).attr('data-id'),
                'trans_type': transType,
                'lang': $('#language').val()
            }
            
        }).done((response) => {
            if(response.data==null){
                response.data={id:'',title:'',description:'',subject:''};
            }
            var editForm = $('#form-language');
            editForm.find('input[name="id"]').val(response.data.id);
            editForm.find('input[name="title"]').val(response.data.title);
            editForm.find('input[name="description"]').val(response.data.description);
            editForm.find('input[name="subject"]').val(response.data.subject);

            $("#modal-language").modal('show');
        }).fail((jqXHR, textStatus, errorThrown) => {
            Toast.fire({
                icon: 'error',
                title: jqXHR.responseJSON.messages.error,
            });
        })
    });
    
    $(document).on('click', '#btn-language-save', function(e) {
        $('.invalid-feedback').remove();
        var editForm = $('#form-language');

        $.ajax({
            url: `<?= route_to('admin.language.write') ?>`,
            method: 'POST',
            data: editForm.serialize()
            
        }).done((data, textStatus, jqXHR) => {
            Toast.fire({
                icon: 'success',
                title: jqXHR.statusText
            });

            $("#form-language").trigger("reset");
            $("#modal-language").modal('hide');

        }).fail((xhr, status, error) => {
            $.each(xhr.responseJSON.messages, (elem, messages) => {
                editForm.find('input[name="' + elem + '"]').addClass('is-invalid').after('<p class="invalid-feedback">' + messages + '</p>');
            });
        })
    });

    $(document).on('click', '#btn-creat', function(e) {
        e.preventDefault();
        $('.is-invalid').removeClass('is-invalid');
        $('select[name=parent_id]').val($(this).attr('data-id')).change()

    });

    $(document).on('click', '#btn-update', function(e) {
        $('.invalid-feedback').remove();
        var editForm = $('#form-edit');

        $.ajax({
            url: `<?= route_to('admin.navigation.manage') ?>/${ $('#menu_id').val() }/update`,
            method: 'POST',
            data: editForm.serialize()
            
        }).done((data, textStatus, jqXHR) => {
            Toast.fire({
                icon: 'success',
                title: jqXHR.statusText
            });

            $('.dd').nestable('destroy');
            menu();
            $("#form-edit").trigger("reset");
            $("#modal-update").modal('hide');

        }).fail((xhr, status, error) => {
            $.each(xhr.responseJSON.messages, (elem, messages) => {
                editForm.find('input[name="' + elem + '"]').addClass('is-invalid').after('<p class="invalid-feedback">' + messages + '</p>');
            });
        })
    });

    $(document).on('click', '#btn-delete', function(e) {
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
                    url: `<?= route_to('admin.navigation.manage') ?>/${$(this).attr('data-id')}/delete`,
                    method: 'POST',
                }).done((data, textStatus, jqXHR) => {
                    Toast.fire({
                        icon: 'success',
                        title: jqXHR.statusText,
                    });
                    $('.dd').nestable('destroy');
                    menu();
                }).fail((jqXHR, textStatus, errorThrown) => {
                    Toast.fire({
                        icon: 'error',
                        title: jqXHR.responseJSON.messages.error,
                    });
                })
            }
        })
    })

    $('#modal-edit').on('hidden.bs.modal', function() {
        $(this).find('#form-edit').reset();
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').removeClass('invalid-feedback');
    });
})
</script>
<?= $this->endSection() ?>
