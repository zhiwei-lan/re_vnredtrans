<!-- Include -->
<?= $this->include('Backend/load/jstree') ?>
<!-- Extend from layout index -->
<?= $this->extend('Backend/layout/index') ?>

<!-- Section content -->
<?= $this->section('content') ?>
<?= $this->include('Backend/load/image_uploader') ?>
<?= $this->include('Backend/load/file_uploader') ?>
<?= $this->include('Backend/load/editor') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="float-left">
                    <div class="btn-group">
                        <a href="<?= route_to('admin.family_site.manage') ?>" class="btn btn-sm btn-block btn-secondary"><i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="<?= $data?route_to('admin.family_site.update',$data['id']):route_to('admin.family_site.create'); ?>" method="post" class="form-horizontal">
                    <div class="row">
                        <div class="col-md-9">
                            <?= csrf_field() ?>
                            <input type="text" name="upload_token" id="upload_token" class="hidden-input" >
                            
                            <div class="form-group row">
                                <label for="inputSkills" class="col-sm-1 col-form-label"><?= lang('Haoadmin.article.fields.active') ?></label>
                                <div class="col-sm-4">
                                    <select class="form-control select" name="active" style="width: 100%;">
                                        <option <?= (!empty($data) && (int)($data['active'] ?? 0) === 1) ? 'selected' : '' ?> value="1"><?= lang('Haoadmin.article.fields.active') ?></option>
                                <option <?= (!empty($data) && (int)($data['active'] ?? 0) === 0) ? 'selected' : '' ?> value="0"><?= lang('Haoadmin.article.fields.non_active') ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-1 col-form-label"><?= lang('Haoadmin.global.language') ?></label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="lang" style="width: 100%;">
                                        <?php foreach (config('App')->supportedLocales as $locale): ?>
                                        <option <?= (!empty($form) && ($form['lang'] ?? config('App')->defaultLocale) === $locale) ? 'selected' : '' ?> value="<?= $locale ?>"><?= $locale ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.family_site.fields.title')?></label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" name="title" class="form-control <?= session('error.title') ? 'is-invalid' : '' ?>" value="<?= !empty($data['title'])?$data['title']:old('title') ?>" placeholder="<?=lang('Haoadmin.article.fields.title')?>" autocomplete="off">
                                        <?php if (session('error.title')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.title') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.family_site.fields.url')?></label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" name="url" class="form-control <?= session('error.url') ? 'is-invalid' : '' ?>" value="<?= !empty($data['url'])?$data['url']:'' ?>" placeholder="<?=lang('Haoadmin.family_site.fields.url')?>" autocomplete="off">
                                        <?php if (session('error.url')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.url') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputSkills" class="col-sm-1 col-form-label"><?= lang('Haoadmin.global.open_new') ?></label>
                                <div class="col-sm-4">
                                    <select class="form-control select" name="open_new" style="width: 100%;">
                                        <option <?= (!empty($data) && (int)($data['open_new'] ?? 0) === 1) ? 'selected' : '' ?> value="1"><?= lang('Haoadmin.article.fields.active') ?></option>
                                        <option <?= (!empty($data) && (int)($data['open_new'] ?? 0) === 0) ? 'selected' : '' ?> value="0"><?= lang('Haoadmin.article.fields.non_active') ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-5">
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
    </div>
</div>
<?= $this->endSection() ?>



<?= $this->section('js') ?>
<script>
    
    $(document).ready(function(){

        $('div.location-help div').each(function(){
            if($(this).attr('data-location') === $('input[name=location]').val()){
                $(this).addClass('active');
            }
        });
        $('.upload-image-btn').attr('data-width', $('input[name=width]').val());
        $('.upload-image-btn').attr('data-height', $('input[name=height]').val());
        $('input[name=width]').on('change', function(){
            let width = $(this).val();
            $('.upload-image-btn').attr('data-width', width);
        });

        $('input[name=height]').on('change', function(){
            let height = $(this).val();
            $('.upload-image-btn').attr('data-height', height);
        });

        $('.location-help div').on('click', function(){
            $('.location-help div').removeClass('active');
            $(this).addClass('active');
            $('input[name=location]').val($(this).attr('data-location'));
        });
    });
</script>
<?= $this->endSection() ?>