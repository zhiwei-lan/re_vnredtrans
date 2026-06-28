<!-- Edit Modal -->
<div class="modal fade" id="modal-update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= lang('Haoadmin.category.edit') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit" class="form-horizontal">
                    <input type="hidden" id="menu_id">
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
                                    <input type="text" name="title" class="form-control <?= session('error.title') ? 'is-invalid' : '' ?>" value="<?= old('title') ?>" placeholder="<?= lang('Haoadmin.category.fields.place_title') ?>" autocomplete="off">
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
                                        <input type="checkbox" class="custom-control-input" id="is_hot1" name="is_hot">
                                        <label class="custom-control-label" for="is_hot1"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label"><?= lang('Haoadmin.category.fields.is_main') ?></label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="is_main1" name="is_main">
                                        <label class="custom-control-label" for="is_main1"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label"><?=lang('Haoadmin.global.use_fields')?></label>
                            <div class="col-sm-10">
                                <button type="button" class="btn btn-sm btn-info" id="btn-field-config-edit" data-toggle="modal" data-target="#modal-field-config">
                                    <i class="fas fa-cog"></i> <?= lang('Haoadmin.global.field_config') ?? 'Configure' ?>
                                </button>
                                <div id="fields-display-edit" style="margin-top: 10px;"></div>
                                <input type="hidden" id="use_fields_json_edit" name="use_fields" value="{}">
                            </div>
                        </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><?= lang('Haoadmin.global.close') ?></button>
                <button type="button" class="btn btn-primary btn-sm" id="btn-update"><?= lang('Haoadmin.global.save') ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Field Configuration Modal for Edit -->
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
