<!-- Edit Modal -->
<div class="modal fade" id="modal-update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= lang('Haoadmin.navigation.edit') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit" class="form-horizontal">
                    <input type="hidden" id="menu_id">
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
                                    <input type="text" name="title" class="form-control <?= session('error.title') ? 'is-invalid' : '' ?>" value="<?= old('title') ?>" placeholder="<?= lang('Haoadmin.navigation.fields.place_title') ?>" autocomplete="off">
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
                                        <input type="checkbox" class="custom-control-input" id="open_new" name="open_new">
                                        <label class="custom-control-label" for="open_new"></label>
                                    </div>
                                </div>
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
