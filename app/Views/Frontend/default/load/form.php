
<form id="form-contact" >
	<?= csrf_field() ?>
    <input type="hidden" name="checkme" value="">
    <input type="hidden" name="quicktime" value="<?= time() ?>">
    <div class="bd">
        <div class="row">
            <div id="form-contact" class="form-render"></div>
        </div>
    </div>
</form>

<?= $this->section('js') ?>			

<script src="/assets/lib/form-builder/form-render.min.js"></script>
<script src="/assets/lib/jquery-validation-1.17.0/jquery.validate.min.js"></script>
<script src="/assets/lib/hao-template/form/validation-config.js"></script>
<script src="/assets/lib/jquery-validation-1.17.0/localization/messages_ko.js"></script>
<script>
	//form render
	$('.form-render').formRender({
		formData: <?= $form_data??'' ?>
	});
	$("#form-contact").validate({
        errorElement: "em",
        errorPlacement: function(error, element){
            errorPlacementCustom(error, element);
        },
        highlight: function(element){
            highlightCustom(element, 'is-invalid', '');
        },
        unhighlight: function(element){
            unhighlightCustom(element, 'is-invalid', '');
        },
        submitHandler: function(form){
            var $form = $(form);
            var formData = new FormData(form);
            $.ajax({
                url: '/sendform/<?= $form_code??'' ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function(){
                    Swal.showLoading()
                },
                success: function(res){
                    if(res.code === 200){
                        Swal.fire({
                            title: "Success!",
                            icon: "success",
                            draggable: true
                        });
                        $form[0].reset();
                        
                        $form.find('.is-invalid').removeClass('is-invalid');
                        $form.find('.invalid-feedback').remove();
                    } else if(res.code === 422){ 
                        Swal.fire({
                            title: res.message,
                            icon: "error",
                            draggable: true
                        });
                        $.each(res.errors, function(name, msg){
                            var $el = $form.find('[name="'+name+'"], [name="'+name+'[]"]').first();
                            if(!$el.length) return;

                            $el.addClass('is-invalid');
                            $el.parent().addClass('has-error has-feedback');
                            $('<em class="error help-block serve-error"></em>').text(msg).insertAfter($el);
                        });
                        
                        var firstErr = $form.find('.is-invalid').first();
                        if(firstErr.length){
                            $('html,body').animate({ scrollTop: firstErr.offset().top - 100 }, 300);
                        }
                    } else {
                        Swal.fire({
                            title: "Error!",
                            icon: "error",
                            draggable: true
                        });
                    }
                },
                error: function(){ 
                    Swal.fire({
                        title: "Error!",
                        icon: "error",
                        draggable: true
                    });
                }
            });
        },
        invalidHandler: function(form, validator){
            return false;
        }
    });
</script>
<?= $this->endSection() ?>