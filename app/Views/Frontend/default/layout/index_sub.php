<?php
	$site = service('site')->getSiteInfo();
	$locale = service('lang')->getLocale();
	$defaultMeta = [
		'description' => $site->meta_description,
		'keywords'    => $site->meta_keywords,
		'og_image'    => $locale.'_default_og_image.jpg',
	];
	$pageTitle = trim($this->renderSection('page_title', true));
	$meta      = $this->renderSection('meta', true);
	$meta      = $meta ? json_decode($meta, true) : [];
	$meta = array_merge($defaultMeta, $meta);
	$title = $pageTitle
		? esc($pageTitle) . ' - ' . esc($site->site_name)
		: esc($site->site_name);
?>
<!DOCTYPE html>
<html lang="<?= esc($locale) ?>">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="<?= csrf_token() ?>" content="<?= csrf_hash() ?>">
    	<title><?= $title ?></title>
		<!-- Basic Meta -->
		<meta name="description" content="<?= esc($meta['description']) ?>">
		<meta name="keywords" content="<?= esc($meta['keywords']) ?>">
		<!-- Open Graph -->
		<meta property="og:type" content="website">
		<meta property="og:title" content="<?= $title ?>">
		<meta property="og:description" content="<?= esc($meta['description']) ?>">
		<meta property="og:image" content="/<?= esc($meta['og_image']) ?>">
		<meta property="og:url" content="<?= service('uri')?>">
		<!-- Twitter Card -->
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:title" content="<?= $title ?>">
		<meta name="twitter:description" content="<?= esc($meta['description']) ?>">
		<meta name="twitter:image" content="/<?= esc($meta['og_image']) ?>">
		<meta name="twitter:url" content="<?= service('uri')?>">
		<!-- favicon -->
		<link rel="shortcut icon" href="/favicon.ico">

        <!-- font pretendard -->
		<link href="/assets/fonts/Pretendard-1.3.9/web/static/pretendard.css" rel="stylesheet">
        <!-- bootstrap3 -->
		<link href="/assets/lib/bootstrap-3.4.1-dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- OwlCarousel2 -->
		<link href="/assets/lib/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css" rel="stylesheet">
		<link rel="stylesheet" href="/assets/lib/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">
		<!-- bootsnav -->
        <link rel="stylesheet" href="/assets/lib/bootsnav/bootsnav.css">
        <!-- animate css -->
		<link rel="stylesheet" href="/assets/lib/animate.css-master/animate.min.css">
		<!-- Render section css -->
  		<?= $this->renderSection('css') ?>
        <!-- customer style -->
		<link href="/assets/css/style.css" rel="stylesheet">
	</head>
	<body>
		<!-- Header -->
        <?= $this->include('Frontend/default/layout/header') ?>

        <!-- Content -->
		<?= $this->renderSection('content') ?>

        <!-- Footer -->
        <?= $this->include('Frontend/default/layout/footer') ?>
        
		
		<!-- jquery -->
		<script src="/assets/lib/jquery@3.4.1/dist/jquery.min.js"></script>
		<?= $this->include('Frontend/default/load/ajax') ?>
        <!-- bootstrap3 -->
		<script src="/assets/lib/bootstrap-3.4.1-dist/js/bootstrap.min.js"></script>
		 <!-- bootsnav -->
		<script src="/assets/lib/bootsnav/bootsnav.js"></script>
        <!-- mousewheel -->
		<script src="/assets/lib/jquery-mousewheel-master/jquery.mousewheel.js"></script>
        <!-- carousel -->
		<script src="/assets/lib/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
		<!-- popup -->
		<?= $this->include('Frontend/default/load/popup') ?>
		<!-- sweetalert -->
		<?= $this->include('Frontend/default/load/message_alert') ?>
		<!-- scrolla -->
		<script src="/assets/lib/jquery-scrolla-master/src/scrolla.jquery.js"></script>
		<!-- Render section js -->
  		<?= $this->renderSection('js') ?>
        <!-- init script -->
		<script src="/assets/js/init-script.js"></script>
		<script src="/assets/lib/jquery-easing/jquery.easing.1.3.js"></script>
		<script src="/assets/lib/swiper/swiper-bundle.min.js"></script>
		<script src="/assets/lib/waypoints-master/lib/jquery.waypoints.min.js"></script>
		<script src="/assets/lib/countUp.js-master/jquery.countup.min.js"></script>
		<script src="/assets/js/bootstrap.min.js"></script>
		<!-- sweetalert -->
		<script src="/assets/lib/sweetalert-master/sweetalert.min.js"></script>
		<!-- form validate -->
		<script src="/assets/lib/jquery-validation-1.17.0/jquery.validate.min.js"></script>
		<script src="/assets/lib/hao-template/form/validation-config.js"></script>
		<script src="/assets/lib/jquery-scrolla-master/src/scrolla.jquery.js"></script>
		<script src="/assets/js/haodesign-script.js"></script>
		<script src="/assets/js/jquery.redirect.js"></script>
		<script type="text/javascript">
	    $(function () {
	        $("#login").validate({
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
						url : "<?= site_url('phone/login');?>", 
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
									window.location.href = '/';
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
			$("#register-login").validate({
				rules: {
					user_name:{
						required: true,
					},
					user_phone:{
						required: true,
					},
					user_phone_code:{
						required: true,
					},
					user_pwd:{
						required: true,
						minlength:8
					},
					user_confirm_pwd:{
						required: true,
					},
				},
				messages: {
					user_name: {
						required: "이름 입력해 주세요."
					},
					user_phone: {
						required: "휴대폰 번호 입력해 주세요."
					},
					user_phone_code:{
						required: "인증번호 입력해 주세요.",
					},
					user_pwd: {
						required: "비밀번호 입력해 주세요.",
						minlength: "영문, 숫자 조합 8자리 이상."
					},
					user_confirm_pwd:{
						required: "비밀번호 확인 입력해 주세요.",
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
						url : "<?= site_url('phone/register');?>", 
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
									title: 'Success',
									button: "OK",
									closeOnClickOutside: false,
								}).then(function(){
									window.location.href = '/';
								});
							} else if(result.code === 201) {
								swal({
									icon: "error",
									title: result.msg,
									button: "OK",
									closeOnClickOutside: false,
								}).then(function(){
									//window.location.reload();
								});
							}else if(result.code === 202) {
								let msg = '';
							    $.each(result.msg, function(key, value){
							        msg += value + "\n";
							    });
								swal({
									icon: "error",
									title: msg,
									button: "OK",
									closeOnClickOutside: false,
								}).then(function(){
									window.location.href="/ko/phone/login";
								});
							}
						}
					});
				},
				invalidHandler: function(form, validator) {  
					return false;
			    }
			});
			$("#form-pwd").validate({
				rules: {
					user_phone:{
						required: true,
					},
					user_phone_code:{
						required: true,
					},
					user_pwd:{
						required: true,
						minlength:8
					},
					user_confirm_pwd:{
						required: true,
					},
				},
				messages: {
					user_phone: {
						required: "휴대폰 번호 또는 이메일 주소를 입력해 주세요."
					},
					user_phone_code:{
						required: "인증번호 입력해 주세요.",
					},
					user_pwd: {
						required: "비밀번호 입력해 주세요.",
						minlength: "영문, 숫자 조합 8자리 이상."
					},
					user_confirm_pwd:{
						required: "비밀번호 확인 입력해 주세요.",
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
						url : "<?= site_url('phone/find');?>", 
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
									window.location.href = '/ko/phone/login';
								});
							} else if(result.code === 202) {
								let msg = '';
							    $.each(result.msg, function(key, value){
							        msg += value + "\n";
							    });
								swal({
									icon: "error",
									title: msg,
									button: "OK",
									closeOnClickOutside: false,
								}).then(function(){
									//window.location.reload();
								});
							}else{
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
			$('#sendcode').click(function(){
				if($(this).hasClass('disabled')) return false
				let phone = $('input[name=user_phone]').val()
				let type = $('input[name=type]').val()
				if(phone){
					$.ajax({
						url : '<?= site_url('login/sendCode');?>', 
						type : "post",
						dataType : "json",
						data: {phone: phone,type: type},
						success : function(result) {
							console.log(result);
							if(result.code === 200) {
								swal({
									icon: "success",
									title: "인증보호 발송되었습니다.",
									button: "OK",
									closeOnClickOutside: false,
								})
								setCodeTimeout()
							} else if(result.code === 203) {
								swal({
				                    icon: "error",
				                    title: result.msg,
				                    button: "확인",
				                    closeOnClickOutside: true,
				                }).then(function() {
				                	$('#user_phone').val('');
				                });
							} else{
								swal({
									icon: "error",
									title: "인증보호 발송실패",
									button: "확인",
									closeOnClickOutside: false,
								})
							}
						},
						error:function(e){
							swal({
								icon: "error",
								title: "인증보호 발송실패",
								button: "확인",
								closeOnClickOutside: false,
							})
						}
					});
				}else{
					swal({
						icon: "error",
						title: "전화번호 입력하십시오",
						button: "확인",
						closeOnClickOutside: false,
					})
				}
				return false
			});
			var setCodeTimeout = function(){
				$('#sendcode').addClass('disabled')
				var timeOutSecond = parseInt($('#sendcode').attr('data-timeout')) //time out second
				for(let i=1;i<=timeOutSecond;i++){
					setTimeout(() => {
						if(i<timeOutSecond){
							$('#sendcode').text(timeOutSecond-i+'s')
						}else{
							$('#sendcode').text('인증번호 받기')
							$('#sendcode').removeClass('disabled')
						}
					}, 1000*i);
				}
			}
			$("#user_info").validate({
				rules: {
					user_name:{
						required: true,
					},
					user_phone:{
						required: true,
					},
				},
				messages: {
					user_name: {
						required: "이름 입력해 주세요."
					},
					user_phone: {
						required: "휴대폰 번호 입력해 주세요."
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
						url : "<?php echo site_url('login/updateUserInfo');?>", 
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
									window.location.reload();
								});
							} else if(result.code === 202) {
								swal({
									icon: "error",
									title: result.msg,
									button: "OK",
									closeOnClickOutside: false,
								}).then(function(){
									//window.location.reload();
								});
							}else if(result.code === 201) {
								swal({
									icon: "error",
									title: result.msg,
									button: "OK",
									closeOnClickOutside: false,
								}).then(function(){
									window.location.href="/ko/phone/login";
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
	</body>
</html>
