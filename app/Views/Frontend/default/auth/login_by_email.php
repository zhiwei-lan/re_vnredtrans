<div class="subpage login">
        <div class="login-cont">
            <div class="logo">
                <img src="/assets/images/login_03.png">
            </div>
            <div class="title">로그인</div>
            <form id="login" action="/login/email" method="post">
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
    <script type="text/javascript">
    $(function () {
        $( "#login").validate({
            rules: {
                user_id:{
                    required: true,
                },
                user_pwd:{
                    required: true,
                },
            },
            messages: {
                user_id: {
                    required: "휴대폰 번호 입력해 주세요."
                },
                user_pwd: {
                    required: "영문 숫자 조합 8자리 이상 입니다.",
                },
            },
            errorElement: "em",
            errorPlacement: function ( error, element ) {
                errorPlacementCustom( error, element);
            },
            success: function ( label, element ) {
                successCustom(label, element);
            },
            highlight: function ( element, errorClass, validClass ) {
                highlightCustom( element, errorClass, validClass);
            },
            unhighlight: function ( element, errorClass, validClass ) {
                unhighlightCustom(element, errorClass, validClass);
            },
            submitHandler: function(form) {
                var $form    = $(form),
                    formData = new FormData(),
                    params   = $form.serializeArray();
                $.each(params, function(i, val) {
                    formData.append(val.name, val.value);
                });
                $.ajax({
                    url : "<?php echo site_url('kr/doLogin');?>", 
                    type : "post",
                    dataType : "html",
                    data: formData,
                    contentType: false,
                    processData: false,
                    
                    success : function(result) {
                        var result = JSON.parse(result);
                        if(result.code === 200) {
                            swal({
                                icon: "success",
                                title: "Success",
                                button: "OK",
                                closeOnClickOutside: false,
                            }).then(function(){
                                window.location.href = '<?php echo site_url();?>';
                            });
                        } else if(result.code === 202){
                            swal({
                                icon: "error",
                                title: result.msg,
                                button: "OK",
                                closeOnClickOutside: false,
                            }).then(function(){
                                //window.location.reload();
                            });
                        } else if(result.code === 203){
                            swal({
                                icon: "error",
                                title: result.msg,
                                button: "OK",
                                closeOnClickOutside: false,
                            }).then(function(){
                                //window.location.reload();
                            });
                        }
                    }
                });
            },
            invalidHandler: function(form, validator) {  
                return false;
            }
        });
    });
    </script>
