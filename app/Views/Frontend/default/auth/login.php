<div class="subpage login">
        <div class="login-cont">
            <div class="logo">
                <img src="/assets/images/login_03.png">
            </div>
            <div class="title">로그인</div>
            <style type="text/css">
            #login .form-control-feedback, #login .help-block {
                display: none!important;
            }
            </style>
            <form id="login">
                <div class="form-group">
                    <input type="text" name="user_id" id="user_id" placeholder="전화번호" autocomplete="off">
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
                        <a href="/<?= service('lang')->getLocale()?>/login/findpwd">비밀번호 찾기</a>
                    </div>
                </div>
                <div class="btn-group">
                    <button class="submit">확인</button>
                    <a href="/<?= service('lang')->getLocale()?>/login/register" class="rbtn">회원가입</a>
                </div>
            </form>
            <div class="snslogin">
                <div class="hd">SNS 계정으로 로그인</div>
                <div class="bd">
                    <div class="item">
                        <a href="/oauth/naver"><img src="/assets/images/login_07.png"></a>
                    </div>
                    <div class="item">
                        <a href="/oauth/kakao"><img src="/assets/images/login_09.png"></a>
                    </div>
                    <div class="item">
                        <img src="/assets/images/login_11.png">
                    </div>
                </div>
            </div>
        </div>
        <video class="myVideo" loop="" muted="" data-autoplay="" autoplay="" id="vod_bg" src="https://haoc.co.kr/resource/home/video/video.mp4">
            <source src="/assets/images/video.mp4" type="video/mp4">
        </video>
    </div>
