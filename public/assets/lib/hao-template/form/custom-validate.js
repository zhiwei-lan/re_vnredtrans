$(function(){
		//Contact_Form
		$( "#form-template").validate({
			rules: {
				company: {
					required: true, 
					minlength: 2 
				},
				name: {
					required: true, 
					minlength: 2 
				},
				email: {
					required: true, 
					email: true
				},
				phone: {
					required: true,
					number:true,
					minlength: 5,
					maxlength: 15
				},
				content: {
					required: true,
				},
				file0: {
					maxsize: 5*1024*1024,
				},
				agree: {
					number:true,
				}
			},
			messages: {
				company: {
					required: "상호명을 입력하십시오.",
					minlength: "최소 2자 이상 입력하셔야 합니다"
				},
				name: {
					required: "이름을 입력하십시오.",
					minlength: "최소 2자 이상 입력하셔야 합니다"
				},
				email:  {
					required: "이메일를 입력하십시오.",
					email: "이메일 주소가 유효하지 않습니다."
				},
				phone: {
					required: "휴대폰 번호를 입력해 주세요.",
					number:"휴대폰 번호가 유효하지 않습니다.",
					minlength: "휴대폰 번호가 유효하지 않습니다.",
					maxlength: "휴대폰 번호가 유효하지 않습니다."
				},
				content: {
					required: "내용을 입력하십시오.",
				},
				file0: {
					maxsize: "파일용량이 최대 5MB 첨부 가능합니다.",
				},
				agree: "동의후 접수가능합니다."
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
						params   = $form.serializeArray(),
						files = $form.find('.upload-file');
				files.each(function(i){
					formData.append('file'+i, $(this)[0].files[0]);
				});
				$.each(params, function(i, val) {
					formData.append(val.name, val.value);
				});
				$.ajax({
					url : sendForm, 
					type : "post",
					dataType : "html",
					data: formData,
					contentType: false,
					processData: false,
					beforeSend: function(){  
						swal({
							icon: "success",
							className: "alertloading",
							button:false,
							closeOnClickOutside: false,
						});
					},
					success : function(result) {
						var result = JSON.parse(result);
						if(result.code === 200) {
							swal({
								icon: "success",
								title: "문의접수가 되었습니다.",
								button: "확인",
								closeOnClickOutside: false,
							}).then(function(){
								window.location.reload();
							});
						} else {
							swal({
								icon: "error",
								title: "ERROR",
								button: "확인",
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
})