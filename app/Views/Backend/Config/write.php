
<!-- Extend from layout index -->
<?= $this->extend('Backend/layout/index') ?>
<!-- Section content -->
<?= $this->section('content') ?>
<?= $this->include('Backend/load/image_uploader') ?>
<div class="row">
    <div class="col-md-12">
        <form action="<?= route_to('admin.config.update') ?>" method="post" class="form-horizontal" id="config-form">
        <?= csrf_field() ?>
        <div class="card card-outline card-info">
            
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="float-left">
                    <div class="btn-group">
                        <?= lang('Haoadmin.config.fields.homepage_setting') ?>
                    </div>
                </div>
            </div>
            <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" name="upload_token" id="upload_token" class="hidden-input" >
                            
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.config.fields.favicon')?></label>
                                <div class="col-sm-5">
                                    <div class="upload-image-group single sm">
                                        <input type="text" data-image-id="favicon" name="favicon"  value="" class="hidden-input" >
                                        <ul class="image-list" data-image-list="favicon">
                                            <li data-id="favicon">
                                                <span class="fas fa-times-circle"></span>
                                                <div class="image" style="background-image:url(/favicon.ico)"></div>
                                            </li>
                                        </ul>
                                        <div data-cropimage='favicon'  data-type="image/png" data-width="32" data-height="32" class="upload-image-btn">+</div>
                                    </div>
                                    <span class="help-block">
                                        <i class="fas fa-exclamation-triangle text-danger"></i>&nbsp;<?= lang('Haoadmin.config.fields.warning_png') ?>
                                    </span>
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
                            <?= lang('Haoadmin.config.fields.file_upload') ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group row">
                                <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.config.fields.file_max_size')?></label>
                                <div class="col-sm-5">
                                    <select class="form-control select" name="file_max_size" style="width: 100%;">
                                        <option <?= (!empty($data->file_max_size) && $data->file_max_size  === '3') ? 'selected' : '' ?> value="3">3MB</option>
                                        <option <?= (!empty($data->file_max_size) && $data->file_max_size  === '5') ? 'selected' : '' ?> value="5">5MB</option>
                                        <option <?= (!empty($data->file_max_size) && $data->file_max_size  === '8') ? 'selected' : '' ?> value="8">8MB</option>
                                        <option <?= (!empty($data->file_max_size) && $data->file_max_size  === '10') ? 'selected' : '' ?> value="10">10MB</option>
                                    </select>
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
                            <?= lang('Haoadmin.config.fields.email_notification') ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-1 col-form-label"><?=lang('Haoadmin.config.fields.email_protocol')?></label>
                                <div class="col-sm-5">
                                    <select class="form-control select" name="email_protocol" style="width: 100%;">
                                        <option <?= (!empty($data->email_protocol) && $data->email_protocol ?? 'mail' === 'mail') ? 'selected' : '' ?> value="mail">mail</option>
                                        <option <?= (!empty($data->email_protocol) && $data->email_protocol ?? 'mail' === 'sendmail') ? 'selected' : '' ?> value="sendmail">sendmail</option>
                                        <option <?= (!empty($data->email_protocol) && $data->email_protocol ?? 'mail' === 'smtp') ? 'selected' : '' ?> value="smtp">smtp</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.email_from')?></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" name="email_from" class="form-control <?= session('error.email_from') ? 'is-invalid' : '' ?>" value="<?= $data->email_from??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.email_from')?>" autocomplete="off">
                                        <?php if (session('error.email_from')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.email_from') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.email_from_name')?></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" name="email_from_name" class="form-control <?= session('error.email_from_name') ? 'is-invalid' : '' ?>" value="<?= $data->email_from_name??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.email_from_name')?>" autocomplete="off">
                                        <?php if (session('error.email_from_name')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.email_from_name') ?></h6>
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
                                <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.email_smtp_host')?></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" name="email_smtp_host" class="form-control <?= session('error.email_smtp_host') ? 'is-invalid' : '' ?>" value="<?= $data->email_smtp_host??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.email_smtp_host')?>" autocomplete="off">
                                        <?php if (session('error.email_smtp_host')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.email_smtp_host') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.email_smtp_port')?></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" name="email_smtp_port" class="form-control <?= session('error.email_smtp_port') ? 'is-invalid' : '' ?>" value="<?= $data->email_smtp_port??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.email_smtp_port')?>" autocomplete="off">
                                        <?php if (session('error.email_smtp_port')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.email_smtp_port') ?></h6>
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
                                <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.email_smtp_user')?></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" name="email_smtp_user" class="form-control <?= session('error.email_smtp_user') ? 'is-invalid' : '' ?>" value="<?= $data->email_smtp_user??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.email_smtp_user')?>" autocomplete="off">
                                        <?php if (session('error.email_smtp_user')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.email_smtp_user') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.email_smtp_pass')?></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" name="email_smtp_pass" class="form-control <?= session('error.email_smtp_pass') ? 'is-invalid' : '' ?>" value="<?= $data->email_smtp_pass??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.email_smtp_pass')?>" autocomplete="off">
                                        <?php if (session('error.email_smtp_pass')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.email_smtp_pass') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="text-center">
                                <div class="btn btn-outline-primary" id="email_test_btn">
                                    <?= lang('Haoadmin.config.fields.email_send_test')?>
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
                            <?= lang('Haoadmin.config.fields.map') ?>
                        </div>
                    </div>
                    <div class="float-right">
                        <div class="btn-group">
                            <span class="badge">구글 개발자 센트: <a href="https://cloud.google.com/maps-platform" target="_blank">https://cloud.google.com/maps-platform</a></span>
                            <span class="badge">카카오 개발자 센트: <a href="http://apis.map.daum.net" target="_blank">http://apis.map.daum.net</a></span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.map_key_google')?></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" name="map_key_google" class="form-control <?= session('error.map_key_google') ? 'is-invalid' : '' ?>" value="<?= $data->map_key_google??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.map_key_google')?>" autocomplete="off">
                                        <?php if (session('error.map_key_google')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.map_key_google') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.map_key_daum')?></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" name="map_key_daum" class="form-control <?= session('error.map_key_daum') ? 'is-invalid' : '' ?>" value="<?= $data->map_key_daum??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.map_key_daum')?>" autocomplete="off">
                                        <?php if (session('error.map_key_daum')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.map_key_daum') ?></h6>
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
                                <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.map_loaction')?>1</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" name="map_loaction1" class="form-control <?= session('error.map_loaction1') ? 'is-invalid' : '' ?>" value="<?= $data->map_loaction1??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.map_loaction')?>" autocomplete="off">
                                        <?php if (session('error.map_loaction1')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.map_loaction1') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label"><?=lang('Haoadmin.config.fields.map_loaction')?>2</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" name="map_loaction2" class="form-control <?= session('error.map_loaction2') ? 'is-invalid' : '' ?>" value="<?= $data->map_loaction2??'' ?>" placeholder="<?=lang('Haoadmin.config.fields.map_loaction')?>" autocomplete="off">
                                        <?php if (session('error.map_loaction2')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.map_loaction2') ?></h6>
                                        </div>
                                        <?php } ?>
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
                            <?= lang('Haoadmin.config.fields.kakao_login') ?>
                        </div>
                    </div>
                    <div class="float-right">
                        <div class="btn-group">
                            <span class="badge">카카오 개발자 센트: <a href="https://developers.kakao.com" target="_blank">https://developers.kakao.com</a></span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">client id</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" name="login_kakao_client_id" class="form-control <?= session('error.login_kakao_client_id') ? 'is-invalid' : '' ?>" value="<?= $data->login_kakao_client_id??'' ?>" placeholder="" autocomplete="off">
                                        <?php if (session('error.login_kakao_client_id')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.login_kakao_client_id') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">client secret</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" name="login_kakao_client_secret" class="form-control <?= session('error.login_kakao_client_secret') ? 'is-invalid' : '' ?>" value="<?= $data->login_kakao_client_secret??'' ?>" placeholder="" autocomplete="off">
                                        <?php if (session('error.login_kakao_client_secret')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.login_kakao_client_secret') ?></h6>
                                        </div>
                                        <?php } ?>
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
                            <?= lang('Haoadmin.config.fields.naver_login') ?>
                        </div>
                    </div>
                    <div class="float-right">
                        <div class="btn-group">
                            <span class="badge">네이버 개발자 센트: <a href="https://developers.naver.com" target="_blank">https://developers.naver.com</a></span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">client id</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" name="login_naver_client_id" class="form-control <?= session('error.login_naver_client_id') ? 'is-invalid' : '' ?>" value="<?= $data->login_naver_client_id??'' ?>" placeholder="" autocomplete="off">
                                        <?php if (session('error.login_naver_client_id')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.login_naver_client_id') ?></h6>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">client secret</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" name="login_naver_client_secret" class="form-control <?= session('error.login_naver_client_secret') ? 'is-invalid' : '' ?>" value="<?= $data->login_naver_client_secret??'' ?>" placeholder="" autocomplete="off">
                                        <?php if (session('error.login_naver_client_secret')) { ?>
                                        <div class="invalid-feedback">
                                            <h6><?= session('error.login_naver_client_secret') ?></h6>
                                        </div>
                                        <?php } ?>
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
$(document).on('click', '#email_test_btn', function(e) {
Swal.fire({
        title: '테스트 결과 수신 이메일:',
        input: "text",
        inputAttributes: {
            autocapitalize: "off"
        },
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '보내기'
    })
    .then((res) => {
        if (res) {
            $.ajax({
                url: `<?= route_to('admin.config.testmail') ?>`,
                method: 'POST',
                data: {
                    'email_to': res.value,
                    'email_from': $('input[name=email_from').val(),
                    'email_from_name': $('input[name=email_from_name').val(),
                    'email_protocol': $('select[name=email_protocol').val(),
                    'email_smtp_host': $('input[name=email_smtp_host').val(),
                    'email_smtp_user': $('input[name=email_smtp_user').val(),
                    'email_smtp_pass': $('input[name=email_smtp_pass').val(),
                    'email_smtp_port': $('input[name=email_smtp_port').val(),
                }
            }).done((data, textStatus, jqXHR) => {
                Toast.fire({
                    icon: 'success',
                    title: jqXHR.statusText,
                });
            }).fail((error) => {
                Toast.fire({
                    icon: 'error',
                    title: error.responseJSON.messages.error,
                });
            })
        }
    })
});
</script>
<?= $this->endSection() ?>

