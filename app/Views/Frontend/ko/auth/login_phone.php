<?= $this->extend('Frontend/default/layout/index_sub') ?>
<?= $this->section('content') ?>
<div class="subpage login">
        <div class="login-cont">
            <div class="logo">
                <img src="/assets/images/login_03.png">
            </div>
            <div class="title">로그인</div>
            <form id="login">
                <?= csrf_field() ?>
                <div class="form-group">
                    <input type="text" name="user_id" id="user_id" placeholder="전화번호">
                </div>
                <div class="form-group">
                    <input type="password" name="user_pwd" id="user_pwd" placeholder="비밀번호">
                </div>
                <div class="form-group">
                    <div class="item">
                        <label>
                            <input type="checkbox"> 아이디 저장
                        </label>
                    </div>
                    <div class="item text-right">
                        <a href="/ko/login/findpwd">비밀번호 찾기</a>
                    </div>
                </div>
                <div class="btn-group">
                    <button class="submit" type="submit">확인</button>
                    <a href="/ko/login/register" class="rbtn">회원가입</a>
                </div>
            </form>
        </div>
        <video class="myVideo" loop="" muted="" data-autoplay="" autoplay="" id="vod_bg" src="https://haoc.co.kr/resource/home/video/video.mp4">
            <source src="/assets/images/video.mp4" type="video/mp4">
        </video>
    </div>
    <style type="text/css">
    .form-group {
	    margin-bottom: 25px;
	}
    .form-control-feedback {
	    display: none;
	}
	.help-block {
	    position: absolute;
	    bottom: -30px;
	    left: 20px;
	}
    </style>
<?= $this->endSection() ?>
