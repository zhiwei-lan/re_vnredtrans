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
                        <a href="<?= $parent_cate_id?route_to('admin.article.managelist',$parent_cate_id) :route_to('admin.article.manage') ?>" class="btn btn-sm btn-block btn-secondary"><i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="<?= $data?route_to('admin.article.update',$data['id']):route_to('admin.article.create'); ?>" method="post" class="form-horizontal">
                    <div class="row">
                        <div class="col-md-9">
                            <?= csrf_field() ?>
                            <input type="text" name="upload_token" id="upload_token" class="hidden-input" >
                            <?php if(!empty($fields['title'])) { ?>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.global.title')?></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input <?= $fields['title']['required'] ? 'required' : '' ?> type="text" name="title" class="form-control <?= session('error.title') ? 'is-invalid' : '' ?>" value="<?= !empty($data['title'])?$data['title']:old('title') ?>" placeholder="<?=lang('Haoadmin.global.title')?>" autocomplete="off">
                                        <?php if (session('error.title')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.title') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if(!empty($fields['subject'])) { ?>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.global.subject')?></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input <?= $fields['subject']['required'] ? 'required' : '' ?> type="text" name="subject" class="form-control <?= session('error.subject') ? 'is-invalid' : '' ?>" value="<?= !empty($data['subject'])?$data['subject']:old('subject') ?>" placeholder="<?=lang('Haoadmin.global.subject')?>" autocomplete="off">
                                        <?php if (session('error.subject')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.subject') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if(!empty($fields['description'])) { ?>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.global.description')?></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input <?= $fields['description']['required'] ? 'required' : '' ?> type="text" name="description" class="form-control <?= session('error.description') ? 'is-invalid' : '' ?>" value="<?= !empty($data['description'])?$data['description']:old('description') ?>" placeholder="<?=lang('Haoadmin.global.description')?>" autocomplete="off">
                                        <?php if (session('error.description')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.description') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if(!empty($fields['thumbnail'])) { ?>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.global.thumbnail')?></label>
                                <div class="col-sm-10">
                                    <div class="upload-image-group">
                                        <input type="text" data-image-id="crop1" name="thumbnail_image_ids" value="<?= implode(', ', $media['thumbnail_image_ids']??[]); ?>" class="hidden-input" >
                                        <ul class="image-list" data-image-list="crop1">
                                            <?php foreach ($media['thumbnails']??[] as $thumbnail) { ?>
                                                <li data-id="<?= $thumbnail['id']; ?> ">
                                                    <span class="fas fa-times-circle"></span>
                                                    <div class="image" style="background-image:url(<?= base_url($thumbnail['path']) ?>)"></div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                        <div data-cropimage='crop1' data-width="<?= $fields['thumbnail']['width']??500 ?>" data-height="<?= $fields['thumbnail']['height']??500 ?>" class="upload-image-btn">+</div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if(!empty($fields['gallery'])) { ?>                  
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.global.gallery')?></label>
                                <div class="col-sm-10">
                                    <div class="upload-image-group">
                                        <input type="text" data-image-id="crop2" name="gallery_image_ids"  value="<?= implode(', ', $media['gallery_image_ids']??[]); ?>" class="hidden-input" >
                                        <ul class="image-list" data-image-list="crop2">
                                            <?php foreach ($media['galleries']??[] as $gallery) { ?>
                                                <li data-id="<?= $gallery['id']; ?> ">
                                                    <span class="fas fa-times-circle"></span>
                                                    <div class="image" style="background-image:url(<?= base_url($gallery['path']) ?>)"></div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                        <div data-cropimage='crop2' data-width="<?= $fields['gallery']['width']??500 ?>" data-height="<?= $fields['gallery']['height']??500 ?>" class="upload-image-btn">+</div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if(!empty($fields['file'])) { ?> 
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.global.file')?></label>
                                <div class="col-sm-10">
                                    <div class="upload-file-group">
                                        <input type="text" data-file-id="file1" name="file_ids"  value="<?= implode(', ', $media['file_ids']??[]); ?>" class="hidden-input" >
                                        <ul class="file-list" data-file-list="file1">
                                            <?php foreach ($media['files']??[] as $file) { ?>
                                                <li data-id="<?= $file['id']; ?> "><i class="fas fa-file"></i><span><?= $file['original_name']; ?></span><i class="fas fa-times-circle"></i></li></li>
                                            <?php } ?>
                                        </ul>
                                        <div data-file-upload='file1' class="upload-file-btn"><i class="fas fa-upload"></i><?=lang('Haoadmin.global.selectfile')?></div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if(!empty($fields['content'])) { ?> 
                            <div class="form-group row <?= session('error.content_delta') ? 'is-invalid' : '' ?>">
                                <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.global.content')?></label>
                                <div class="col-sm-10" style="padding-bottom:100px;">
                                    <editor>
                                        <textarea datatype="delta" name="content_delta" class="hidden-input"><?= !empty($data['content_delta'])?$data['content_delta']:old('content_delta') ?></textarea>
                                        <textarea datatype="html" name="content_html" class="hidden-input"><?= !empty($data['content_html'])?$data['content_html']:old('content_html') ?></textarea>
                                        <div id="toolbar-container1" class="toolbar-container">
                                            <?= $this->include('Backend/load/editor_toolbar_element') ?>
                                        </div>
                                        <div id="editor-container1" class="editor-container"></div>
                                    </editor>
                                    <?php if (session('error.content_delta')) { ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.content_delta') ?></h6>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-3 right-bar">
                            <div class="form-group row">
                                <label for="inputSkills" class="col-sm-3 col-form-label"><?= lang('Haoadmin.global.active') ?></label>
                                <div class="col-sm-9">
                                    <select class="form-control select" name="active" style="width: 100%;">
                                        <option <?= (!empty($data) && (int)($data['active'] ?? 0) === 1) ? 'selected' : '' ?> value="1"><?= lang('Haoadmin.global.active') ?></option>
                                        <option <?= (!empty($data) && (int)($data['active'] ?? 0) === 0) ? 'selected' : '' ?> value="0"><?= lang('Haoadmin.global.non_active') ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?= lang('Haoadmin.global.language') ?></label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="language" name="lang" style="width: 100%;">
                                        <?php foreach (config('App')->supportedLocales as $locale): ?>
                                        <option <?= (!empty($data) && ($data['lang'] ?? config('App')->defaultLocale) === $locale) ? 'selected' : '' ?> value="<?= $locale ?>"><?= $locale ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row  <?= session('error.category_id') ? 'is-invalid' : '' ?>">
                                <label class="col-sm-3 col-form-label"><?= lang('Haoadmin.global.category') ?></label>
                                <div class="col-sm-9">
                                    <div class="jstree-default-dark" id="categoryTree"></div>
                                    <input type="hidden" name="category_id" id="category_id">
                                    <?php if (session('error.category_id')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.category_id') ?></h6>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            
                            <?php if(!empty($fields['meta_title'])) { ?> 
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 col-form-label"><?=lang('Haoadmin.global.meta_title')?></label>
                                <div class="col-sm-9">
                                    <div class="input-group"> 
                                        <textarea class="form-control" name="meta_title" class="form-control <?= session('error.meta_title') ? 'is-invalid' : '' ?>" placeholder="" autocomplete="off" rows="2"><?= !empty($data['meta_title'])?$data['meta_title']:old('meta_title') ?></textarea>
                                        <?php if (session('error.meta_title')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.meta_title') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if(!empty($fields['meta_keywords'])) { ?>  
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 col-form-label"><?=lang('Haoadmin.global.meta_keywords')?></label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <textarea class="form-control" name="meta_keywords" class="form-control <?= session('error.meta_keywords') ? 'is-invalid' : '' ?>"  placeholder="" autocomplete="off" rows="2"><?= !empty($data['meta_keywords'])?$data['meta_keywords']:old('meta_keywords') ?></textarea>
                                        <?php if (session('error.meta_keywords')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.meta_keywords') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if(!empty($fields['meta_description'])) { ?>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 col-form-label"><?=lang('Haoadmin.global.meta_description')?></label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <textarea class="form-control" name="meta_description" class="form-control <?= session('error.meta_description') ? 'is-invalid' : '' ?>" placeholder="" autocomplete="off" rows="2"><?= !empty($data['meta_description'])?$data['meta_description']:old('meta_description') ?></textarea>
                                        <?php if (session('error.meta_description')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.meta_description') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>

                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 col-form-label"><?=lang('Haoadmin.global.sequence')?></label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" name="sequence" class="form-control <?= session('error.sequence') ? 'is-invalid' : '' ?>" value="<?= !empty($data['sequence'])?$data['sequence']:old('sequence') ?>" placeholder="" autocomplete="off">
                                        <?php if (session('error.sequence')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.sequence') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-3 col-form-label"><?= lang('Haoadmin.global.is_main') ?></label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" <?= $data['is_main']??0 == 1 ? 'checked' :'' ?> id="is_main" name="is_main">
                                            <label class="custom-control-label" for="is_main"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-3 col-form-label"><?= lang('Haoadmin.global.is_fixed') ?></label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" <?= $data['is_fixed']??0 == 1 ? 'checked' :'' ?>  id="is_fixed" name="is_fixed">
                                            <label class="custom-control-label" for="is_fixed"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <div class="text-center">
                                            <!-- <button type="submit" class="btn btn-block btn-dark">
                                                <i class="fas fa-magic"></i> &nbsp;&nbsp;AI SEO
                                            </button> -->
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

    function buildTree(list) {
        const map = {};
        const tree = [];

        list.forEach(item => {
            map[item.id] = {
                id: item.id.toString(),   
                text: item.title,
                children: []
            };
        });

        list.forEach(item => {
            if (item.parent_id == <?= $parent_cate_id ? $parent_cate_id:0?>) {
                tree.push(map[item.id]);
            } else if (map[item.parent_id]) {
                map[item.parent_id].children.push(map[item.id]);
            }
        });

        return tree;
    }
    $('#categoryTree').jstree({
        core: {
            data: buildTree(<?= json_encode($categories, JSON_UNESCAPED_UNICODE) ?>)
        }
    }).on("select_node.jstree", function (e, data) {
        $('#category_id').val(data.node.id);
    });
    //初始化分类选择器
    $('#categoryTree').on('ready.jstree', function() {
        console.log(<?= $data['category_id']??0 ?>);
        var tree = $(this).jstree(true);
        tree.select_node(['<?= $data['category_id']??0 ?>']);
    });

    <?php if (!empty($data['id'])): ?>
    $(document).on('change', '#language', function(e) {
        window.location.href = '<?= route_to('admin.article.edit', $data['id']) ?>?<?= $parent_cate_id?'category_id='.$parent_cate_id.'&':''?>lang='+e.target.value;
    });
    <?php endif; ?>
</script>
<?= $this->endSection() ?>