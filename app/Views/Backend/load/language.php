<!-- language Modal -->
<div class="modal fade" id="modal-language" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Language</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-language" class="form-horizontal">
                    <input id="trans_id" name="trans_id" type="hidden">
                    <input id="trans_type" name="trans_type" type="hidden">
                    <input id="langid" name="id" type="hidden">

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('Haoadmin.global.language') ?></label>
                        <div class="col-sm-10">
                            <select class="form-control" id="language" name="lang" style="width: 100%;">
                                <?php foreach (config('App')->supportedLocales as $locale): ?>
                                <option <?= ($locale == config('App')->defaultLocale) ? 'selected' : '' ?> value="<?= $locale ?>"><?= $locale ?></option>
                                <?php endforeach; ?>
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
                    

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><?= lang('Haoadmin.global.close') ?></button>
                <button type="button" class="btn btn-primary btn-sm" id="btn-language-save"><?= lang('Haoadmin.global.save') ?></button>
            </div>
        </div>
    </div>
</div>

