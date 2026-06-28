
<!-- Extend from layout index -->
<?= $this->extend('Backend/layout/index') ?>

<!-- Section content -->
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="float-left">
                    <div class="btn-group">
                        <a href="<?= route_to('admin.form.manage') ?>" class="btn btn-sm btn-block btn-secondary"><i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
                <div class="float-right">
                    <?php if(!empty($form)): ?>
                        <div class="row">
                            <label for="inputSkills" class="col-form-label"><?= lang('Haoadmin.form.fields.version') ?></label>
                            <div class="col-sm-8">
                                <select class="form-control select" id="changeversion" style="width: 240px;" onchange="window.location.href=this.value;">
                                    <?php foreach($form['version_list'] as $version): ?>
                                    <option <?= $version['id'] === $form['id'] ? 'selected' : '' ?> value="<?= route_to('admin.form.manage') ?>/<?= $version['id'] ?>/edit">v_<?= $version['version'] ?>  (<?= $version['created_at'] ?>)</option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
                    

            <div class="card-body">
                <form action="<?= !empty($form)?route_to('admin.form.update',$form['id']):route_to('admin.form.create'); ?>" method="post" class="form-horizontal row" id="form-manage">
                    <?= csrf_field() ?>
                    <textarea name="fields" class="hidden-input"><?= !empty($form)?$form['fields']:'' ?></textarea>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="inputSkills" class="col-sm-2 col-form-label"><?= lang('Haoadmin.form.fields.active') ?></label>
                            <div class="col-sm-8">
                                <select class="form-control select" name="active" style="width: 100%;">
                                    <option <?= (!empty($form) && (int)($form['active'] ?? 0) === 1) ? 'selected' : '' ?> value="1"><?= lang('Haoadmin.form.fields.active') ?></option>
                                    <option <?= (!empty($form) && (int)($form['active'] ?? 0) === 0) ? 'selected' : '' ?> value="0"><?= lang('Haoadmin.form.fields.non_active') ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"><?= lang('Haoadmin.global.language') ?></label>
                            <div class="col-sm-8">
                                <select class="form-control" name="lang" style="width: 100%;">
                                    <?php foreach (config('App')->supportedLocales as $locale): ?>
                                    <option <?= (!empty($form) && ($form['lang'] ?? config('App')->defaultLocale) === $locale) ? 'selected' : '' ?> value="<?= $locale ?>"><?= $locale ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.form.fields.name')?></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" name="name" class="form-control <?= session('error.name') ? 'is-invalid' : '' ?>" value="<?= !empty($form['name'])?$form['name']:old('name') ?>" placeholder="" autocomplete="off">
                                    <?php if (session('error.name')) { ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.name') ?></h6>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.form.fields.code')?></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" name="code" class="form-control <?= session('error.code') ? 'is-invalid' : '' ?>" value="<?= !empty($form['code'])?$form['code']:old('code') ?>" <?= !empty($form['code'])?'disabled="disabled"':'' ?> placeholder="" autocomplete="off">
                                    <?php if (session('error.code')) { ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.code') ?></h6>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.form.fields.submit_email')?></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" name="submit_email" class="form-control <?= session('error.submit_email') ? 'is-invalid' : '' ?>" value="<?= !empty($form['submit_email'])?$form['submit_email']:old('submit_email') ?>" placeholder="" autocomplete="off">
                                    <?php if (session('error.submit_email')) { ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.submit_email') ?></h6>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.form.fields.success_message')?></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" name="success_message" class="form-control <?= session('error.success_message') ? 'is-invalid' : '' ?>" value="<?= !empty($form['success_message'])?$form['success_message']:old('success_message') ?>" placeholder="" autocomplete="off">
                                    <?php if (session('error.success_message')) { ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.success_message') ?></h6>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
        <div class="card card-outline card-info">
            <div class="card-header">
                <?=lang('Haoadmin.formfield.title')?>
            </div>
            <div class="card-body">
                <div class="col-md-8">
                    <div id="fb-editor"></div>
                </div>
            </div>
        </div>        
    </div>
</div>
<?= $this->endSection() ?>


<?= $this->section('js') ?>
<script src="/assets/lib/jqueryui/jquery-ui.min.js"></script>
<script src="/assets/lib/form-builder/form-builder.min.js"></script>
<script>
jQuery(function($) {
function parseLang(text) {
    const obj = {};
    text.split('/n').forEach(line => {
        line = line.trim();
        if (!line || line.startsWith('#')) return;

        const [key, ...rest] = line.split('=');
        obj[key.trim()] = rest.join('=').trim();
    });
    return obj;
}

fetch('/assets/lib/form-builder/ko-KR.lang')
.then(res => res.text())
.then(text => {
    var langData = parseLang(text);

    $(document.getElementById('fb-editor')).formBuilder({
        onSave: function(evt, formData) {
            window.sessionStorage.setItem('formData', JSON.stringify(formData));
            console.log(formData);
            $('#form-manage textarea[name=fields]').val(formData);
            $('#form-manage').submit();
        },
        i18n: {
            locale: 'ko-KR',
            override: {
            'ko-KR': langData
            }
        },
        controlOrder: [
            'text',
            'textarea'
        ],
        disableFields: [
            'autocomplete',
            'number',
            'date'
        ],
        defaultFields: <?= !empty($form)?$form['fields']:'[]' ?>
        // [
        //     {
        //         "type": "text",
        //         "required": true,
        //         "label": "회사명",
        //         "className": "form-control col-md-6",
        //         "name": "text-1767944759920-0",
        //         "access": false,
        //         "subtype": "text",
        //         "maxlength": 255
        //     },
        //     {
        //         "type": "text",
        //         "required": true,
        //         "label": "담당자",
        //         "className": "form-control col-md-6",
        //         "name": "text-1767944817848-0",
        //         "access": false,
        //         "subtype": "text",
        //         "maxlength": 100
        //     },
        //     {
        //         "type": "text",
        //         "subtype": "tel",
        //         "required": false,
        //         "label": "연락처",
        //         "className": "form-control col-md-6",
        //         "name": "text-1767944846015-0",
        //         "access": false
        //     },
        //     {
        //         "type": "text",
        //         "subtype": "email",
        //         "required": true,
        //         "label": "이메일",
        //         "className": "form-control col-md-6",
        //         "name": "text-1767944899914-0",
        //         "access": false
        //     },
        //     {
        //         "type": "select",
        //         "required": true,
        //         "label": "배송방법",
        //         "className": "form-control",
        //         "name": "select-1767946857319-0",
        //         "access": false,
        //         "multiple": false,
        //         "values": [
        //         {
        //             "label": "방문수령",
        //             "value": "방문수령",
        //             "selected": true
        //         },
        //         {
        //             "label": "튁",
        //             "value": "튁",
        //             "selected": false
        //         },
        //         {
        //             "label": "우편배송",
        //             "value": "우편배송",
        //             "selected": false
        //         }
        //         ]
        //     },
        //     {
        //         "type": "radio-group",
        //         "required": true,
        //         "label": "어떤 작업이 필요하신가요?",
        //         "inline": false,
        //         "name": "radio-group-1767946853368-0",
        //         "access": false,
        //         "other": false,
        //         "values": [
        //         {
        //             "label": "디자인 + 인쇄",
        //             "value": "디자인 + 인쇄",
        //             "selected": true
        //         },
        //         {
        //             "label": "디자인만",
        //             "value": "디자인만",
        //             "selected": false
        //         },
        //         {
        //             "label": "인쇄만",
        //             "value": "인쇄만",
        //             "selected": false
        //         }
        //         ]
        //     },
        //     {
        //         "type": "checkbox-group",
        //         "required": true,
        //         "label": "어떤 제작 서비스가 필요하신가요?",
        //         "toggle": false,
        //         "inline": false,
        //         "name": "checkbox-group-1767946849785-0",
        //         "access": false,
        //         "other": false,
        //         "values": [
        //         {
        //             "label": "AI모델",
        //             "value": "AI모델",
        //             "selected": false
        //         },
        //         {
        //             "label": "상세페이지",
        //             "value": "상세페이지",
        //             "selected": false
        //         },
        //         {
        //             "label": "사진촬영",
        //             "value": "사진촬영",
        //             "selected": false
        //         },
        //         {
        //             "label": "영상제작",
        //             "value": "영상제작",
        //             "selected": false
        //         },
        //         {
        //             "label": "360도촬영",
        //             "value": "360도촬영",
        //             "selected": false
        //         },
        //         {
        //             "label": "자동화촬영",
        //             "value": "자동화촬영",
        //             "selected": false
        //         }
        //         ]
        //     },
        //     {
        //         "type": "textarea",
        //         "required": false,
        //         "label": "기타 문의 및 요구사항",
        //         "className": "form-control col-md-12",
        //         "name": "textarea-1767944986861-0",
        //         "access": false,
        //         "subtype": "textarea",
        //         "rows": 5
        //     },
        //     {
        //         "type": "file",
        //         "required": false,
        //         "label": "첨부파일&nbsp;",
        //         "className": "form-control",
        //         "name": "file-1767945128042-0",
        //         "access": false,
        //         "multiple": true
        //     },
        //     {
        //         "type": "checkbox-group",
        //         "required": true,
        //         "label": "&nbsp;",
        //         "toggle": false,
        //         "inline": false,
        //         "name": "checkbox-group-1767945159159-0",
        //         "access": false,
        //         "other": false,
        //         "values": [
        //         {
        //             "label": "<a href=/"/user_privacy/" target=/"_blank/">개인정보취급방침</a>에 동의합니다.",
        //             "value": "1",
        //             "selected": true
        //         }
        //         ]
        //     },
        //     {
        //         "type": "button",
        //         "subtype": "submit",
        //         "label": "무의하기",
        //         "className": "btn-default btn",
        //         "name": "button-1767945430968-0",
        //         "access": false,
        //         "style": "default"
        //     }
        //     ]
    });
});
});
</script>
<?= $this->endSection() ?>


