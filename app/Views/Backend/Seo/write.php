
<!-- Extend from layout index -->
<?= $this->extend('Backend/layout/index') ?>
<!-- Section content -->
<?= $this->section('content') ?>
<?= $this->include('Backend/load/image_uploader') ?>
<div class="row">
    <div class="col-md-12">
        <form action="<?= route_to('admin.seo.update') ?>" method="post" class="form-horizontal" id="config-form">
        <?= csrf_field() ?>
        <input name="lang" class="hidden-input" value="<?= $lang ?>">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="float-left">
                    <div class="btn-group">
                        사이트 기본정보
                    </div>
                </div>
                <div class="float-right">
                    <div class="row">
                        <label for="inputSkills" class="col-form-label"><?= lang('Haoadmin.global.language') ?></label>
                        <div class="col-sm-8">
                            <select class="form-control" id="language" name="lang" style="width: 100px;">
                            <?php foreach (config('App')->supportedLocales as $locale): ?>
                            <option <?= ($locale == $lang ) ? 'selected' : '' ?> value="<?= $locale ?>"><?= $locale ?></option>
                            <?php endforeach; ?>
                        </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" name="upload_token" id="upload_token" class="hidden-input" >
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.config.fields.site_name')?></label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <input type="text" name="site_name" class="form-control <?= session('error.site_name') ? 'is-invalid' : '' ?>" value="<?= $data->site_name??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.site_name')?>" autocomplete="off">
                                        <?php if (session('error.site_name')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.site_name') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.company_name')?></label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="text" name="company_name" class="form-control <?= session('error.company_name') ? 'is-invalid' : '' ?>" value="<?= $data->company_name??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.company_name')?>" autocomplete="off">
                                                <?php if (session('error.company_name')) { ?>
                                                <div class="invalid-feedback">
                                                    <h6><?= session('error.company_name') ?></h6>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.company_name_en')?></label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="text" name="company_name_en" class="form-control <?= session('error.company_name_en') ? 'is-invalid' : '' ?>" value="<?= $data->company_name_en??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.company_name_en')?>" autocomplete="off">
                                                <?php if (session('error.company_name_en')) { ?>
                                                <div class="invalid-feedback">
                                                    <h6><?= session('error.company_name_en') ?></h6>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.company_address')?></label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="text" name="company_address" class="form-control <?= session('error.company_address') ? 'is-invalid' : '' ?>" value="<?= $data->company_address??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.company_address')?>" autocomplete="off">
                                                <?php if (session('error.company_address')) { ?>
                                                <div class="invalid-feedback">
                                                    <h6><?= session('error.company_address') ?></h6>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.company_address1')?></label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="text" name="company_address1" class="form-control <?= session('error.company_address1') ? 'is-invalid' : '' ?>" value="<?= $data->company_address1??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.company_address1')?>" autocomplete="off">
                                                <?php if (session('error.company_address1')) { ?>
                                                <div class="invalid-feedback">
                                                    <h6><?= session('error.company_address1') ?></h6>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.company_address2')?></label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="text" name="company_address2" class="form-control <?= session('error.company_address2') ? 'is-invalid' : '' ?>" value="<?= $data->company_address2??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.company_address2')?>" autocomplete="off">
                                                <?php if (session('error.company_address2')) { ?>
                                                <div class="invalid-feedback">
                                                    <h6><?= session('error.company_address2') ?></h6>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.company_address3')?></label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="text" name="company_address3" class="form-control <?= session('error.company_address3') ? 'is-invalid' : '' ?>" value="<?= $data->company_address3??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.company_address3')?>" autocomplete="off">
                                                <?php if (session('error.company_address3')) { ?>
                                                <div class="invalid-feedback">
                                                    <h6><?= session('error.company_address3') ?></h6>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.company_ceo')?></label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="text" name="company_ceo" class="form-control <?= session('error.company_ceo') ? 'is-invalid' : '' ?>" value="<?= $data->company_ceo??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.company_ceo')?>" autocomplete="off">
                                                <?php if (session('error.company_ceo')) { ?>
                                                <div class="invalid-feedback">
                                                    <h6><?= session('error.company_ceo') ?></h6>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.company_phone')?></label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="text" name="company_phone" class="form-control <?= session('error.company_phone') ? 'is-invalid' : '' ?>" value="<?= $data->company_phone??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.company_phone')?>" autocomplete="off">
                                                <?php if (session('error.company_phone')) { ?>
                                                <div class="invalid-feedback">
                                                    <h6><?= session('error.company_phone') ?></h6>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.company_email')?></label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="text" name="company_email" class="form-control <?= session('error.company_email') ? 'is-invalid' : '' ?>" value="<?= $data->company_email??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.company_email')?>" autocomplete="off">
                                                <?php if (session('error.company_email')) { ?>
                                                <div class="invalid-feedback">
                                                    <h6><?= session('error.company_email') ?></h6>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.company_phone1')?></label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="text" name="company_phone1" class="form-control <?= session('error.company_phone1') ? 'is-invalid' : '' ?>" value="<?= $data->company_phone1??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.company_phone1')?>" autocomplete="off">
                                                <?php if (session('error.company_phone1')) { ?>
                                                <div class="invalid-feedback">
                                                    <h6><?= session('error.company_phone1') ?></h6>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.company_email1')?></label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="text" name="company_email1" class="form-control <?= session('error.company_email1') ? 'is-invalid' : '' ?>" value="<?= $data->company_email1??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.company_email1')?>" autocomplete="off">
                                                <?php if (session('error.company_email1')) { ?>
                                                <div class="invalid-feedback">
                                                    <h6><?= session('error.company_email1') ?></h6>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.company_phone2')?></label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="text" name="company_phone2" class="form-control <?= session('error.company_phone2') ? 'is-invalid' : '' ?>" value="<?= $data->company_phone2??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.company_phone2')?>" autocomplete="off">
                                                <?php if (session('error.company_phone2')) { ?>
                                                <div class="invalid-feedback">
                                                    <h6><?= session('error.company_phone2') ?></h6>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.company_email2')?></label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="text" name="company_email2" class="form-control <?= session('error.company_email2') ? 'is-invalid' : '' ?>" value="<?= $data->company_email2??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.company_email2')?>" autocomplete="off">
                                                <?php if (session('error.company_email2')) { ?>
                                                <div class="invalid-feedback">
                                                    <h6><?= session('error.company_email2') ?></h6>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.company_phone3')?></label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="text" name="company_phone3" class="form-control <?= session('error.company_phone3') ? 'is-invalid' : '' ?>" value="<?= $data->company_phone3??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.company_phone3')?>" autocomplete="off">
                                                <?php if (session('error.company_phone3')) { ?>
                                                <div class="invalid-feedback">
                                                    <h6><?= session('error.company_phone3') ?></h6>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.company_email3')?></label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="text" name="company_email3" class="form-control <?= session('error.company_email3') ? 'is-invalid' : '' ?>" value="<?= $data->company_email3??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.company_email3')?>" autocomplete="off">
                                                <?php if (session('error.company_email3')) { ?>
                                                <div class="invalid-feedback">
                                                    <h6><?= session('error.company_email3') ?></h6>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.config.fields.company_base_email')?></label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <input type="text" name="company_base_email" class="form-control <?= session('error.company_base_email') ? 'is-invalid' : '' ?>" value="<?= $data->company_base_email??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.company_base_email')?>" autocomplete="off">
                                        <?php if (session('error.company_base_email')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.company_base_email') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.company_number')?></label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="text" name="company_number" class="form-control <?= session('error.company_number') ? 'is-invalid' : '' ?>" value="<?= $data->company_number??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.company_number')?>" autocomplete="off">
                                                <?php if (session('error.company_number')) { ?>
                                                <div class="invalid-feedback">
                                                    <h6><?= session('error.company_number') ?></h6>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.company_sales_number')?></label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="text" name="company_sales_number" class="form-control <?= session('error.company_sales_number') ? 'is-invalid' : '' ?>" value="<?= $data->company_sales_number??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.company_sales_number')?>" autocomplete="off">
                                                <?php if (session('error.company_sales_number')) { ?>
                                                <div class="invalid-feedback">
                                                    <h6><?= session('error.company_sales_number') ?></h6>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
            <div class="card card-outline card-info">
                <div class="card-header">
                    <div class="float-left">
                        <div class="btn-group">
                            SEO 정보
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.config.fields.og_image')?></label>
                        <div class="col-sm-11">
                            <div class="upload-image-group single">
                                <input type="text" data-image-id="og_image" name="og_image"  value="" class="hidden-input" >
                                <ul class="image-list" data-image-list="og_image">
                                    <li data-id="og_image">
                                        <span class="fas fa-times-circle"></span>
                                        <div class="image" style="background-image:url(/<?= service('lang')->getLocale()?>_default_og_image.jpg)"></div>
                                    </li>
                                </ul>
                                <div data-cropimage='og_image' data-type="image/jpeg" data-width="488" data-height="255" class="upload-image-btn">+</div>
                            </div>
                            <span class="help-block">
                                <i class="fas fa-exclamation-triangle text-danger"></i>&nbsp;<?= lang('Haoadmin.config.fields.warning_jpg') ?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.config.fields.meta_keywords')?></label>
                        <div class="col-sm-11">
                            <div class="input-group">
                                <textarea class="form-control" name="meta_keywords" class="form-control <?= session('error.meta_keywords') ? 'is-invalid' : '' ?>" placeholder="<?=lang('Haoadmin.config.fields.meta_keywords')?>" autocomplete="off" rows="2"><?= $data->meta_keywords??'' ?></textarea>
                                <?php if (session('error.meta_keywords')) { ?>
                                <div class="invalid-feedback">
                                    <h6><?= session('error.meta_keywords') ?></h6>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.config.fields.meta_description')?></label>
                        <div class="col-sm-11">
                            <div class="input-group">
                                <textarea class="form-control" name="meta_description" class="form-control <?= session('error.meta_description') ? 'is-invalid' : '' ?>" placeholder="<?=lang('Haoadmin.config.fields.meta_description')?>" autocomplete="off" rows="2"><?= $data->meta_description??'' ?></textarea>
                                <?php if (session('error.meta_description')) { ?>
                                <div class="invalid-feedback">
                                    <h6><?= session('error.meta_description') ?></h6>
                                </div>
                                <?php } ?>
                            </div>
                            <span class="help-block">
                                <i class="fas fa-exclamation-triangle text-info"></i>&nbsp;<?= lang('Haoadmin.config.fields.warning_meta_description') ?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.config.fields.meta_tags')?></label>
                        <div class="col-sm-11">
                            <div class="input-group">
                                <textarea class="form-control" name="meta_tags" class="form-control <?= session('error.meta_tags') ? 'is-invalid' : '' ?>" placeholder="<?=lang('Haoadmin.config.fields.meta_tags')?>" autocomplete="off" rows="4"><?= $data->meta_tags??'' ?></textarea>
                                <?php if (session('error.meta_tags')) { ?>
                                <div class="invalid-feedback">
                                    <h6><?= session('error.meta_tags') ?></h6>
                                </div>
                                <?php } ?>
                            </div>
                            <span class="help-block">
                                <i class="fas fa-exclamation-triangle text-danger"></i>&nbsp;<?= lang('Haoadmin.config.fields.warning_metatags') ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-outline card-info">
                <div class="card-header">
                    <div class="float-left">
                        <div class="btn-group">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="text-center">
                                <button type="submit" class="btn btn-block btn-primary">
                                    <?= lang('Haoadmin.global.save')?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
$(document).on('change', '#language', function(e) {
    window.location.href = '<?= route_to('admin.seo.edit')?>?lang='+e.target.value;
});
</script>
<?= $this->endSection() ?>

