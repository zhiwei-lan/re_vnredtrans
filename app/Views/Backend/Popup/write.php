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
                        <a href="<?= route_to('admin.popup.manage') ?>" class="btn btn-sm btn-block btn-secondary"><i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="<?= $data?route_to('admin.popup.update',$data['id']):route_to('admin.popup.create'); ?>" method="post" class="form-horizontal">
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
                                <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.popup.fields.title')?></label>
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
                                <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.popup.fields.start_at')?></label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="date" name="start_at" class="form-control <?= session('error.start_at') ? 'is-invalid' : '' ?>" value="<?= !empty($data['start_at'])?$data['start_at']:old('start_at') ?>" placeholder="<?=lang('Haoadmin.popup.fields.start_at')?>" autocomplete="off">
                                        <?php if (session('error.start_at')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.start_at') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.popup.fields.end_at')?></label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="date" name="end_at" class="form-control <?= session('error.end_at') ? 'is-invalid' : '' ?>" value="<?= !empty($data['end_at'])?$data['end_at']:old('end_at') ?>" placeholder="<?=lang('Haoadmin.popup.fields.end_at')?>" autocomplete="off">
                                        <?php if (session('error.end_at')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.end_at') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.popup.fields.location')?></label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" name="location" class="hidden-input" value="<?= !empty($data['location'])?$data['location']:old('location') ?>" placeholder="<?=lang('Haoadmin.popup.fields.location')?>" autocomplete="off">
                                        <div class="location-help">
                                            <div data-location="top-left" class="top-left"></div>
                                            <div data-location="top-center" class="top-center"></div>
                                            <div data-location="top-right" class="top-right"></div>
                                            <div data-location="center-left" class="center-left"></div>
                                            <div data-location="center-center" class="center-center"></div>
                                            <div data-location="center-right" class="center-right"></div>
                                            <div data-location="bottom-left" class="bottom-left"></div>
                                            <div data-location="bottom-center" class="bottom-center"></div>
                                            <div data-location="bottom-right" class="bottom-right"></div>
                                        </div>
                                        <?php if (session('error.location')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.location') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.popup.fields.offset_left')?></label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="number" name="offset_left" class="form-control <?= session('error.offset_left') ? 'is-invalid' : '' ?>" value="<?= !empty($data['offset_left'])?$data['offset_left']:old('offset_left') ?>" placeholder="<?=lang('Haoadmin.popup.fields.offset_left')?>" autocomplete="off">
                                        <?php if (session('error.offset_left')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.offset_left') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.popup.fields.offset_top')?></label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="number" name="offset_top" class="form-control <?= session('error.offset_top') ? 'is-invalid' : '' ?>" value="<?= !empty($data['offset_top'])?$data['offset_top']:old('offset_top') ?>" placeholder="<?=lang('Haoadmin.popup.fields.offset_top')?>" autocomplete="off">
                                        <?php if (session('error.offset_top')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.offset_top') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.popup.fields.height')?></label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="number" name="height" class="form-control <?= session('error.height') ? 'is-invalid' : '' ?>" value="<?= !empty($data['height'])?$data['height']:500 ?>" placeholder="<?=lang('Haoadmin.popup.fields.height')?>" autocomplete="off">
                                        <?php if (session('error.height')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.height') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.popup.fields.width')?></label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="number" name="width" class="form-control <?= session('error.width') ? 'is-invalid' : '' ?>" value="<?= !empty($data['width'])?$data['width']:500 ?>" placeholder="<?=lang('Haoadmin.popup.fields.width')?>" autocomplete="off">
                                        <?php if (session('error.width')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.width') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.global.thumbnail')?></label>
                                <div class="col-sm-5">
                                    <div class="upload-image-group lg single">
                                        <input type="text" data-image-id="crop1" name="thumbnail_image_ids" value="<?= implode(', ', $media['thumbnail_image_ids']??[]); ?>" class="hidden-input" >
                                        <ul class="image-list" data-image-list="crop1">
                                            <?php foreach ($media['thumbnails']??[] as $thumbnail) { ?>
                                                <li data-id="<?= $thumbnail['id']; ?> ">
                                                    <span class="fas fa-times-circle"></span>
                                                    <div class="image" style="background-image:url(<?= base_url($thumbnail['path']) ?>)"></div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                        <div data-cropimage='crop1' data-width="500" data-height="500" class="upload-image-btn">+</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.popup.fields.link')?></label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" name="link" class="form-control <?= session('error.link') ? 'is-invalid' : '' ?>" value="<?= !empty($data['link'])?$data['link']:'' ?>" placeholder="<?=lang('Haoadmin.popup.fields.link')?>" autocomplete="off">
                                        <?php if (session('error.link')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.link') ?></h6>
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