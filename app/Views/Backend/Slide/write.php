<!-- Include -->
<?= $this->include('Backend/load/jstree') ?>


<!-- Extend from layout index -->
<?= $this->extend('Backend/layout/index') ?>

<!-- Section content -->
<?= $this->section('content') ?>
<?= $this->include('Backend/load/image_uploader') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="float-left">
                    <div class="btn-group">
                        <a href="<?= route_to('admin.slide.manage') ?>" class="btn btn-sm btn-block btn-secondary"><i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body slide-manage-write">
                <form action="<?= $data?route_to('admin.slide.update',$data['id']):route_to('admin.slide.create'); ?>" method="post" class="form-horizontal">
                    <div class="row">
                        <div class="col-md-9">
                            <?= csrf_field() ?>
                            <input type="text" name="upload_token" id="upload_token" class="hidden-input" >
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <div class="upload-image-group lg">
                                        <input type="text" data-image-id="crop1" name="gallery_image_ids"  value="<?= implode(', ', $media['gallery_image_ids']??[]); ?>" class="hidden-input" >
                                        <ul class="image-list" data-image-list="crop1">
                                            <?php foreach ($media['galleries']??[] as $gallery) { ?>
                                                <li data-id="<?= $gallery['id']; ?> ">
                                                    <span class="fas fa-times-circle"></span>
                                                    <div class="image" style="background-image:url(<?= base_url($gallery['path']) ?>)"></div>
                                                    <div class="image-info">
                                                        <div class="form-group row">
                                                            <label for="inputSkills" class="col-sm-1 col-form-label"><?= lang('Haoadmin.slide.fields.title') ?></label>
                                                            <div class="col-sm-11">
                                                                <input type="text" name="titles[<?= $gallery['id']; ?>]" class="form-control" placeholder="<?= lang('Haoadmin.slide.fields.title') ?>" value="<?= $gallery['title']??''; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputSkills" class="col-sm-1 col-form-label"><?= lang('Haoadmin.slide.fields.subject') ?></label>
                                                            <div class="col-sm-11">
                                                                <input type="text" name="subject[<?= $gallery['id']; ?>]" class="form-control" placeholder="<?= lang('Haoadmin.slide.fields.subject') ?>" value="<?= $gallery['subject']??''; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputSkills" class="col-sm-1 col-form-label"><?= lang('Haoadmin.slide.fields.description') ?></label>
                                                            <div class="col-sm-11">
                                                                <input type="text" name="description[<?= $gallery['id']; ?>]" class="form-control" placeholder="<?= lang('Haoadmin.slide.fields.description') ?>" value="<?= $gallery['description']??''; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputSkills" class="col-sm-1 col-form-label"><?= lang('Haoadmin.slide.fields.content') ?></label>
                                                            <div class="col-sm-11">
                                                                <input type="text" name="content[<?= $gallery['id']; ?>]" class="form-control" placeholder="<?= lang('Haoadmin.slide.fields.content') ?>" value="<?= $gallery['content']??''; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputSkills" class="col-sm-1 col-form-label"><?= lang('Haoadmin.slide.fields.video') ?></label>
                                                            <div class="col-sm-11">
                                                                <input type="text" name="video[<?= $gallery['id']; ?>]" class="form-control" placeholder="<?= lang('Haoadmin.slide.fields.video') ?>" value="<?= $gallery['video']??''; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputSkills" class="col-sm-1 col-form-label"><?= lang('Haoadmin.slide.fields.url') ?></label>
                                                            <div class="col-sm-11">
                                                                <input type="text" name="url[<?= $gallery['id']; ?>]" class="form-control" placeholder="<?= lang('Haoadmin.slide.fields.url') ?>" value="<?= $gallery['url']??''; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputSkills" class="col-sm-1 col-form-label"><?= lang('Haoadmin.slide.fields.open_new') ?></label>
                                                            <div class="col-sm-11">
                                                                <select class="form-control select" name="open_new[<?= $gallery['id']; ?>]" style="width: 100%;">
                                                                    <option <?= (!empty($data) && (int)($gallery['open_new'] ?? 0) === 1) ? 'selected' : '' ?> value="1"><?= lang('Haoadmin.slide.fields.active') ?></option>
                                                                    <option <?= (!empty($data) && (int)($gallery['open_new'] ?? 0) === 0) ? 'selected' : '' ?> value="0"><?= lang('Haoadmin.slide.fields.non_active') ?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <input type="text" name="image[<?= $gallery['id']; ?>]" class="hidden-input" value="<?= $gallery['path']??''; ?>">
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                        <div style="display: flex;gap:20px;">
                                        <div data-cropimage='crop1' data-width="1920" data-height="920" class="upload-image-btn">+(PC)</div>
                                        <div data-cropimage='crop1' data-width="750" data-height="650" class="upload-image-btn">+(Mobile)</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        
                        <div class="col-md-3 right-bar">
                            <div class="form-group row">
                                <label for="inputSkills" class="col-sm-4 col-form-label"><?= lang('Haoadmin.slide.fields.active') ?></label>
                                <div class="col-sm-8">
                                    <select class="form-control select" name="active" style="width: 100%;">
                                        <option <?= (!empty($data) && (int)($data['active'] ?? 0) === 1) ? 'selected' : '' ?> value="1"><?= lang('Haoadmin.slide.fields.active') ?></option>
                                        <option <?= (!empty($data) && (int)($data['active'] ?? 0) === 0) ? 'selected' : '' ?> value="0"><?= lang('Haoadmin.slide.fields.non_active') ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label"><?= lang('Haoadmin.global.language') ?></label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="language" name="lang" style="width: 100%;">
                                        <?php foreach (config('App')->supportedLocales as $locale): ?>
                                        <option <?= (!empty($data) && ($data['lang'] ?? config('App')->defaultLocale) === $locale) ? 'selected' : '' ?> value="<?= $locale ?>"><?= $locale ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputName" class="col-sm-4 col-form-label"><?=lang('Haoadmin.slide.fields.code')?></label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" name="code" class="form-control <?= session('error.code') ? 'is-invalid' : '' ?>" value="<?= !empty($data['code'])?$data['code']:old('code') ?>" <?= !empty($data['code'])?'disabled="disabled"':'' ?> placeholder="<?=lang('Haoadmin.slide.fields.code')?>" autocomplete="off">
                                        <?php if (session('error.code')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.code') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputSkills" class="col-sm-4 col-form-label"><?= lang('Haoadmin.slide.fields.autoplay') ?></label>
                                <div class="col-sm-8">
                                    <select class="form-control select" name="autoplay" style="width: 100%;">
                                        <option <?= (!empty($data) && (int)($data['autoplay'] ?? 0) === 1) ? 'selected' : '' ?> value="1"><?= lang('Haoadmin.slide.fields.active') ?></option>
                                        <option <?= (!empty($data) && (int)($data['autoplay'] ?? 0) === 0) ? 'selected' : '' ?> value="0"><?= lang('Haoadmin.slide.fields.non_active') ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputSkills" class="col-sm-4 col-form-label"><?= lang('Haoadmin.slide.fields.loop') ?></label>
                                <div class="col-sm-8">
                                    <select class="form-control select" name="loop" style="width: 100%;">
                                        <option <?= (!empty($data) && (int)($data['loop'] ?? 0) === 1) ? 'selected' : '' ?> value="1"><?= lang('Haoadmin.slide.fields.active') ?></option>
                                        <option <?= (!empty($data) && (int)($data['loop'] ?? 0) === 0) ? 'selected' : '' ?> value="0"><?= lang('Haoadmin.slide.fields.non_active') ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputSkills" class="col-sm-4 col-form-label"><?= lang('Haoadmin.slide.fields.pagination') ?></label>
                                <div class="col-sm-8">
                                    <select class="form-control select" name="pagination" style="width: 100%;">
                                        <option <?= (!empty($data) && (int)($data['pagination'] ?? 0) === 1) ? 'selected' : '' ?> value="1"><?= lang('Haoadmin.slide.fields.active') ?></option>
                                        <option <?= (!empty($data) && (int)($data['pagination'] ?? 0) === 0) ? 'selected' : '' ?> value="0"><?= lang('Haoadmin.slide.fields.non_active') ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputSkills" class="col-sm-4 col-form-label"><?= lang('Haoadmin.slide.fields.navigation') ?></label>
                                <div class="col-sm-8">
                                    <select class="form-control select" name="navigation" style="width: 100%;">
                                        <option <?= (!empty($data) && (int)($data['navigation'] ?? 0) === 1) ? 'selected' : '' ?> value="1"><?= lang('Haoadmin.slide.fields.active') ?></option>
                                        <option <?= (!empty($data) && (int)($data['navigation'] ?? 0) === 0) ? 'selected' : '' ?> value="0"><?= lang('Haoadmin.slide.fields.non_active') ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputSkills" class="col-sm-4 col-form-label"><?= lang('Haoadmin.slide.fields.scrollbar') ?></label>
                                <div class="col-sm-8">
                                    <select class="form-control select" name="scrollbar" style="width: 100%;">
                                        <option <?= (!empty($data) && (int)($data['scrollbar'] ?? 0) === 1) ? 'selected' : '' ?> value="1"><?= lang('Haoadmin.slide.fields.active') ?></option>
                                        <option <?= (!empty($data) && (int)($data['scrollbar'] ?? 0) === 0) ? 'selected' : '' ?> value="0"><?= lang('Haoadmin.slide.fields.non_active') ?></option>
                                    </select>
                                </div>
                            </div> 
                            
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-4 col-form-label"><?=lang('Haoadmin.slide.fields.delay')?></label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" name="delay" class="form-control <?= session('error.delay') ? 'is-invalid' : '' ?>" value="<?= !empty($data['delay'])?$data['delay']:3000 ?>"  placeholder="<?=lang('Haoadmin.slide.fields.delay')?>" autocomplete="off">
                                        <?php if (session('error.delay')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.delay') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-4 col-form-label"><?=lang('Haoadmin.slide.fields.speed')?></label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" name="speed" class="form-control <?= session('error.speed') ? 'is-invalid' : '' ?>" value="<?= !empty($data['speed'])?$data['speed']:500 ?>"  placeholder="<?=lang('Haoadmin.slide.fields.speed')?>" autocomplete="off">
                                        <?php if (session('error.speed')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.speed') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

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
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
image_uploader_uploaded_callback = function (data) {
    console.log('Image uploaded callback', data);

    let imghtml = `
    <div class="image-info">
        <input type="text" name="image[${data.media_id}]" class="hidden-input" value="${data.path}">

        <div class="form-group row">
            <label class="col-sm-1 col-form-label"><?= lang('Haoadmin.slide.fields.title') ?></label>
            <div class="col-sm-11">
                <input type="text"
                       name="titles[${data.media_id}]"
                       class="form-control"
                       placeholder="<?= lang('Haoadmin.slide.fields.title') ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-1 col-form-label"><?= lang('Haoadmin.slide.fields.subject') ?></label>
            <div class="col-sm-11">
                <input type="text"
                       name="subject[${data.media_id}]"
                       class="form-control"
                       placeholder="<?= lang('Haoadmin.slide.fields.subject') ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-1 col-form-label"><?= lang('Haoadmin.slide.fields.description') ?></label>
            <div class="col-sm-11">
                <input type="text"
                       name="description[${data.media_id}]"
                       class="form-control"
                       placeholder="<?= lang('Haoadmin.slide.fields.description') ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-1 col-form-label"><?= lang('Haoadmin.slide.fields.content') ?></label>
            <div class="col-sm-11">
                <input type="text"
                       name="content[${data.media_id}]"
                       class="form-control"
                       placeholder="<?= lang('Haoadmin.slide.fields.content') ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-1 col-form-label"><?= lang('Haoadmin.slide.fields.video') ?></label>
            <div class="col-sm-11">
                <input type="text"
                       name="video[${data.media_id}]"
                       class="form-control"
                       placeholder="<?= lang('Haoadmin.slide.fields.video') ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-1 col-form-label"><?= lang('Haoadmin.slide.fields.url') ?></label>
            <div class="col-sm-11">
                <input type="text"
                       name="url[${data.media_id}]"
                       class="form-control"
                       placeholder="<?= lang('Haoadmin.slide.fields.url') ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-1 col-form-label"><?= lang('Haoadmin.slide.fields.open_new') ?></label>
            <div class="col-sm-11">
                <select class="form-control"
                        name="open_new[${data.media_id}]">
                    <option value="1"><?= lang('Haoadmin.slide.fields.active') ?></option>
                    <option value="0" selected><?= lang('Haoadmin.slide.fields.non_active') ?></option>
                </select>
            </div>
        </div>

    </div>
    `;

    $('ul[data-image-list=crop1] li[data-id="' + data.media_id + '"]').append(imghtml);
}
</script>
<?= $this->endSection() ?>