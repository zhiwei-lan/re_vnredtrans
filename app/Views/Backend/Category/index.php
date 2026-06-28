<!-- Include -->
<?= $this->include('Backend/load/nestable') ?>
<?= $this->include('Backend/load/select2') ?>
<?= $this->include('Backend/load/iconpicker') ?>
<!-- Extend from layout index -->
<?= $this->extend('Backend/layout/index') ?>

<!-- Section content -->
<?= $this->section('content') ?>
    <?= $this->include('Backend/Category/update') ?>
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
                        <h5><?= lang('Haoadmin.category.add') ?></h5>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= route_to('admin.category.create') ?>" method="post" class="form-horizontal">
                        <?= csrf_field() ?>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"><?= lang('Haoadmin.category.fields.parent') ?></label>
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
                            <label for="inputName" class="col-sm-2 col-form-label"><?= lang('Haoadmin.category.fields.name') ?></label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                    </div>
                                    <input type="text" name="title" class="form-control <?= session('error.title') ? 'is-invalid' : '' ?>" value="<?= old('title') ?>" placeholder="<?= lang('Haoadmin.category.fields.name') ?>" autocomplete="off">
                                    <?php if (session('error.title')) { ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.title') ?></h6>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label"><?= lang('Haoadmin.category.fields.subject') ?></label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-terminal"></i></span>
                                    </div>
                                    <input type="text" name="subject" class="form-control <?= session('error.subject') ? 'is-invalid' : '' ?>" value="<?= old('subject') ?>" placeholder="<?= lang('Haoadmin.category.fields.subject') ?>" autocomplete="off">
                                    <?php if (session('error.subject')) { ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.subject') ?></h6>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label"><?= lang('Haoadmin.category.fields.description') ?></label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-brush"></i></span>
                                    </div>
                                    <input type="text" name="description" class="form-control <?= session('error.description') ? 'is-invalid' : '' ?>" value="<?= old('description') ?>" placeholder="<?= lang('Haoadmin.category.fields.description') ?>" autocomplete="off">
                                    <?php if (session('error.description')) { ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.description') ?></h6>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"><?= lang('Haoadmin.category.fields.icon') ?></label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fab fa-font-awesome-flag"></i></span>
                                    </div>
                                    <input type="text" name="icon" class="icon-picker form-control <?= session('error.icon') ? 'is-invalid' : '' ?>" value="<?= old('icon') ?>" placeholder="<?= lang('Haoadmin.category.fields.icon') ?>" autocomplete="off">
                                    <?php if (session('error.icon')) { ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.icon') ?></h6>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label"><?= lang('Haoadmin.category.fields.is_hot') ?></label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="is_hot" name="is_hot">
                                        <label class="custom-control-label" for="is_hot"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label"><?= lang('Haoadmin.category.fields.is_main') ?></label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="is_main" name="is_main">
                                        <label class="custom-control-label" for="is_main"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label"><?=lang('Haoadmin.global.use_fields')?></label>
                            <div class="col-sm-10">
                                <button type="button" class="btn btn-sm btn-info" id="btn-field-config" data-toggle="modal" data-target="#modal-field-config">
                                    <i class="fas fa-cog"></i> <?= lang('Haoadmin.global.field_config') ?? 'Configure' ?>
                                </button>
                                <div id="fields-display" style="margin-top: 10px;"></div>
                                <input type="hidden" id="use_fields_json" name="use_fields" value="{}">
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

<!-- Field Configuration Modal -->
<div class="modal fade" id="modal-field-config" tabindex="-1" role="dialog" aria-labelledby="fieldConfigLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fieldConfigLabel"><?= lang('Haoadmin.global.field_config') ?? 'Field Configuration' ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="field-config-container"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><?= lang('Haoadmin.global.close') ?></button>
                <button type="button" class="btn btn-primary btn-sm" id="btn-save-field-config"><?= lang('Haoadmin.global.save') ?></button>
            </div>
        </div>
    </div>
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
        $.get("<?= route_to('admin.category.manage') ?>", function(response) {
            $('.dd').nestable({
                maxDepth: 10,
                json: response.data,
                contentCallback: (item) => {
                    return `<i class="${item.icon}"></i>&nbsp;<strong>${item.title}</strong>&nbsp;&nbsp;<span class="badge">ID:${item.id}</span>&nbsp;&nbsp;&nbsp;&nbsp;${item.active==='0'?'<span class="badge bg-danger"><?= lang('Haoadmin.menu.fields.non_active') ?></span>':''}
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
            url: `<?= route_to('admin.category.sort') ?>`,
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
            url: `<?= route_to('admin.category.manage') ?>/${$(this).attr('data-id')}/edit`,
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
            editForm.find('input[name="icon"]').val(response.data.icon);
            editForm.find('input[name="title"]').val(response.data.title);
            editForm.find('input[name="subject"]').val(response.data.subject);
            editForm.find('input[name="description"]').val(response.data.description);
            editForm.find('input[name="is_hot"]').prop('checked',response.data.is_hot>0?true:false);
            editForm.find('input[name="is_main"]').prop('checked',response.data.is_main>0?true:false);
            
            // Handle use_fields JSON
            const useFieldsData = response.data.use_fields;
            currentMode = 'edit'; // Set mode to edit before updating
            if (typeof useFieldsData === 'string') {
                try {
                    const parsed = JSON.parse(useFieldsData);
                    editForm.find('#use_fields_json_edit').val(JSON.stringify(parsed));
                    currentFieldConfig = parsed;
                    updateFieldDisplay();
                } catch (e) {
                    editForm.find('#use_fields_json_edit').val('{}');
                    currentFieldConfig = {};
                    updateFieldDisplay();
                }
            } else if (typeof useFieldsData === 'object' && useFieldsData !== null) {
                editForm.find('#use_fields_json_edit').val(JSON.stringify(useFieldsData));
                currentFieldConfig = useFieldsData;
                updateFieldDisplay();
            } else {
                editForm.find('#use_fields_json_edit').val('{}');
                currentFieldConfig = {};
                updateFieldDisplay();
            }

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
                'trans_type': 'category',
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
        const transType = 'category';
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
        $('select[name=parent_id]').val($(this).attr('data-id')).change();
        // Reset field configuration for new record
        currentMode = 'create'; // Set mode to create
        currentFieldConfig = {};
        $('#use_fields_json').val('{}');
        $('#fields-display').html('<span class="text-muted">No fields selected</span>');
    });

    $(document).on('click', '#btn-update', function(e) {
        $('.invalid-feedback').remove();
        var editForm = $('#form-edit');

        $.ajax({
            url: `<?= route_to('admin.category.manage') ?>/${ $('#menu_id').val() }/update`,
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
                    url: `<?= route_to('admin.category.manage') ?>/${$(this).attr('data-id')}/delete`,
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

    // Field Configuration
    const fieldsDefinition = {
        'title': { label: '<?= lang('Haoadmin.global.title') ?>', types: ['text', 'textarea'], hasConfig: false },
        'subject': { label: '<?= lang('Haoadmin.global.subject') ?>', types: ['text', 'textarea'], hasConfig: false },
        'description': { label: '<?= lang('Haoadmin.global.description') ?>', types: ['text', 'textarea'], hasConfig: false },
        'file': { label: '<?= lang('Haoadmin.global.file') ?>', types: ['file'], hasConfig: false },
        'thumbnail': { label: '<?= lang('Haoadmin.global.thumbnail') ?>', types: ['image'], hasConfig: true, configFields: ['width', 'height'] },
        'gallery': { label: '<?= lang('Haoadmin.global.gallery') ?>', types: ['file'], hasConfig: true, configFields: ['width', 'height'] },
        'content': { label: '<?= lang('Haoadmin.global.content') ?>', types: ['editor','text', 'textarea'], hasConfig: false },
        'meta_title': { label: '<?= lang('Haoadmin.global.meta_title') ?>', types: ['text', 'textarea'], hasConfig: false },
        'meta_keywords': { label: '<?= lang('Haoadmin.global.meta_keywords') ?>', types: ['text', 'textarea'], hasConfig: false },
        'meta_description': { label: '<?= lang('Haoadmin.global.meta_description') ?>', types: ['text', 'textarea'], hasConfig: false }
    };

    let currentFieldConfig = {};
    let currentMode = 'create'; // 'create' or 'edit'

    function initFieldConfig() {
        const jsonField = currentMode === 'create' ? '#use_fields_json' : '#use_fields_json_edit';
        const jsonValue = $(jsonField).val();
        try {
            currentFieldConfig = jsonValue && jsonValue !== '{}' ? JSON.parse(jsonValue) : {};
        } catch (e) {
            currentFieldConfig = {};
        }
    }

    function renderFieldConfigModal() {
        let html = '<div class="row">';
        const fields = ['title','subject','description','file','thumbnail','gallery','content','meta_title','meta_keywords','meta_description'];
        
        fields.forEach(field => {
            const fieldDef = fieldsDefinition[field];
            const config = currentFieldConfig[field] || { enabled: false, required: false, type: fieldDef.types[0] };
            const configId = `field-${field}`;
            
            html += `<div class="col-md-6 mb-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="form-check mb-2">
                            <input class="form-check-input field-enabled" type="checkbox" 
                                   id="${configId}-enabled" data-field="${field}"
                                   ${config.enabled ? 'checked' : ''}>
                            <label class="form-check-label" for="${configId}-enabled">
                                <strong>${fieldDef.label}</strong>
                            </label>
                        </div>
                        <div class="field-config-options" style="display: ${config.enabled ? 'block' : 'none'}; margin-left: 20px;">
                            <div class="form-check mb-2">
                                <input class="form-check-input field-required" type="checkbox" 
                                       id="${configId}-required" data-field="${field}"
                                       ${config.required ? 'checked' : ''}>
                                <label class="form-check-label" for="${configId}-required">
                                    <?= lang('Haoadmin.global.required') ?? 'Required' ?>
                                </label>
                            </div>
                        </div>`;
            
            if (fieldDef.types.length > 1) {
                html += `<div class="form-group mb-2">
                    <label for="${configId}-type" class="small"><?= lang('Haoadmin.global.field_type') ?? 'Field Type' ?></label>
                    <select class="form-control form-control-sm field-type" id="${configId}-type" data-field="${field}">`;
                fieldDef.types.forEach(type => {
                    html += `<option value="${type}" ${config.type === type ? 'selected' : ''}>${type}</option>`;
                });
                html += `</select></div>`;
            }
            
            // Add thumbnail-specific config
            if (fieldDef.hasConfig && (field === 'thumbnail' || field === 'gallery')) {
                html += `<div class="thumbnail-config">
                    <div class="form-group mb-2">
                        <label for="${configId}-width" class="small">Width (px)</label>
                        <input type="number" class="form-control form-control-sm field-width" 
                               id="${configId}-width" data-field="${field}"
                               value="${config.width || ''}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="${configId}-height" class="small">Height (px)</label>
                        <input type="number" class="form-control form-control-sm field-height" 
                               id="${configId}-height" data-field="${field}"
                               value="${config.height || ''}">
                    </div>
                </div>`;
            }
            
            html += `</div></div></div>`;
        });
        
        html += '</div>';
        $('#field-config-container').html(html);
        
        // Bind events
        $('.field-enabled').on('change', function() {
            const field = $(this).data('field');
            const enabled = $(this).prop('checked');
            $(this).closest('.card-body').find('.field-config-options').toggle(enabled);
        });

        $('.field-required, .field-type, .field-width, .field-height').on('change', function() {
            saveFieldConfigToObject();
        });
    }

    function saveFieldConfigToObject() {
        currentFieldConfig = {};
        const fields = ['title','subject','description','thumbnail','gallery','file','content','meta_title','meta_keywords','meta_description'];
        
        fields.forEach(field => {
            const configId = `field-${field}`;
            const enabled = $(`#${configId}-enabled`).prop('checked');
            
            if (enabled) {
                currentFieldConfig[field] = {
                    enabled: true,
                    required: $(`#${configId}-required`).prop('checked') || false,
                    type: $(`#${configId}-type`).val() || fieldsDefinition[field].types[0]
                };
                
                // Add thumbnail-specific fields
                if (field === 'thumbnail' || field === 'gallery') {
                    const width = $(`#${configId}-width`).val();
                    const height = $(`#${configId}-height`).val();
                    if (width) currentFieldConfig[field].width = parseInt(width);
                    if (height) currentFieldConfig[field].height = parseInt(height);
                }
            }
        });
    }

    function updateFieldDisplay() {
        const displayId = currentMode === 'create' ? '#fields-display' : '#fields-display-edit';
        const jsonId = currentMode === 'create' ? '#use_fields_json' : '#use_fields_json_edit';
        
        let displayHtml = '';
        for (let field in currentFieldConfig) {
            if (currentFieldConfig[field].enabled) {
                const label = fieldsDefinition[field].label;
                const badges = [];
                if (currentFieldConfig[field].required) {
                    badges.push('<span class="badge badge-danger">Required</span>');
                }
                if (currentFieldConfig[field].type) {
                    badges.push(`<span class="badge badge-info">${currentFieldConfig[field].type}</span>`);
                }
                if ((field === 'thumbnail' || field === 'gallery') && currentFieldConfig[field].width && currentFieldConfig[field].height) {
                    badges.push(`<span class="badge badge-secondary">${currentFieldConfig[field].width}×${currentFieldConfig[field].height}</span>`);
                }
                displayHtml += `<div class="mb-2"><strong>${label}</strong> ${badges.join(' ')}</div>`;
            }
        }
        
        $(displayId).html(displayHtml || '<span class="text-muted">No fields selected</span>');
        $(jsonId).val(JSON.stringify(currentFieldConfig));
    }

    $('#btn-field-config, #btn-field-config-edit').on('click', function() {
        currentMode = $(this).attr('id') === 'btn-field-config' ? 'create' : 'edit';
        initFieldConfig();
        renderFieldConfigModal();
    });

    $('#btn-save-field-config').on('click', function() {
        saveFieldConfigToObject();
        updateFieldDisplay();
        $('#modal-field-config').modal('hide');
    });

    $('#modal-field-config').on('show.bs.modal', function() {
        initFieldConfig();
        renderFieldConfigModal();
    });

    $('#modal-edit').on('hidden.bs.modal', function() {
        $(this).find('#form-edit').reset();
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').removeClass('invalid-feedback');
    });
})
</script>
<?= $this->endSection() ?>
