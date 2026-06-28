<?= $this->extend('Frontend/default/layout/index_sub') ?>
<?= $this->section('content') ?>

<div class="subpage login">
        <div class="login-cont">
            <div class="logo">
                <img src="/assets/images/login_03.png">
            </div>
            <div class="title">비밀번호 찾기</div>
            <style type="text/css">
            #form-pwd .form-control-feedback, #form-pwd .help-block {
                display: none!important;
            }
            </style>
            <form id="form-pwd">
                <?= csrf_field() ?>
                <input type="hidden" name="type" id="type" value="findPwd">
                <div class="form-group">
                    <input type="text" name="user_phone" id="find_user_phone" maxlength="11" placeholder="전화번호" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" name="user_phone_code" id="user_phone_code" placeholder="인증번호 받기">
                    <div id="sendcode" data-timeout="300">인증번호 받기</div>
                </div>
                <div class="form-group">
                    <input type="password" name="user_pwd" id="user_pwd" placeholder="비밀번호">
                </div>
                <div class="form-group">
                    <input type="password" name="user_confirm_pwd" id="user_confirm_pwd" placeholder="비밀번호 확인">
                </div>
                <div class="btn-group">
                    <button class="submit">확인</button>
                </div>
            </form>
        </div>

        <video class="myVideo" loop="" muted="" data-autoplay="" autoplay="" id="vod_bg" src="https://haoc.co.kr/resource/home/video/video.mp4">
            <source src="/assets/images/video.mp4" type="video/mp4">
        </video>
    </div>

<?= $this->endSection() ?>
