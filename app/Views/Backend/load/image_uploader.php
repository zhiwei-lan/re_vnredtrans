<?= $this->section('css') ?>
<link href="/assets/lib/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
<style>
    .img-container img {
        max-width: 100%;
        height: 500px;
        display: block;
    }
</style>
<?= $this->endSection() ?>

<!-- upload image Modal -->
<div class="modal fade" id="modal-upload-image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= lang('Haoadmin.global.imagecrop') ?></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <input type="file" id="imageInput" accept="image/*" style="display:none;">
                <div class="img-container">
                    <img id="preview">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= lang('Haoadmin.global.close') ?></button>
                <button type="button" id="btn-direct-upload" class="btn btn-success"><?= lang('Haoadmin.global.direct_upload') ?></button>
                <button type="button" id="btn-save" class="btn btn-primary"><?= lang('Haoadmin.global.crop_upload') ?></button>
            </div>
        </div>
    </div>
</div>

<?= $this->section('js') ?>
<script src="/assets/lib/Sortable-master/Sortable.min.js"></script>
<script src="/assets/lib/cropperjs/1.5.13/cropper.min.js"></script>
<script>
$(document).ready(function () {

    

    // 初始化 Sortable 拖拽排序
    document.querySelectorAll('.image-list').forEach((item,index)=>{
        new Sortable(item, {
            animation: 150,
            onChange: function(evt) {
                getSortedImageIds(evt.srcElement.getAttribute('data-image-list'))
            }
        });
    })

    // 更新imageid排序
    function getSortedImageIds(cropimage) {
        let ids = [];
        $('ul[data-image-list='+cropimage+'] li').each(function(){
            ids.push($(this).attr('data-id'));
        });
        $('input[data-image-id='+cropimage+']').val(ids)
    }

    function hasTransparency(canvas) {
        const ctx = canvas.getContext('2d');
        const { data } = ctx.getImageData(0, 0, canvas.width, canvas.height);

        // 每 4 个值是一个像素 (RGBA)
        for (let i = 3; i < data.length; i += 4) {
            if (data[i] < 255) {
                return true;
            }
        }
        return false;
    }

    let cropper = null;
    const img = document.getElementById('preview'); //图片预览DOM
    const imageInput = document.getElementById('imageInput'); //文件选择器
    const croppedPreview = document.getElementById('croppedPreview'); //裁切器预览
    const saveBtn = document.getElementById('btn-save');//上传按钮
    let cropimage = null;
    let cropWidth = 100;
    let cropHeight = 100;
    let mimeType = null;
    // 允许的文件类型
    let allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

    if (!imageInput || !saveBtn) {
        console.error("cant find imageInput or saveBtn element，please check HTML ID is allrealy has");
        return;
    }
    
    //上传成功更新dom&token
    function uplpadComplateChangeDom(data) {
        let imghtml = `
            <li data-id="${data.media_id}">
                <span class="fas fa-times-circle"></span>
                <div class="image" style="background-image:url(<?= base_url() ?>/${data.path})"></div>
            </li>
        `;
        $('ul[data-image-list=' + cropimage + ']').append(imghtml);

        $('#upload_token').val(data.upload_token);
        getSortedImageIds(cropimage);
        $('#modal-upload-image').modal('hide');
    }

    // 直接上传原图
    const directUploadBtn = document.getElementById('btn-direct-upload');
    directUploadBtn.addEventListener('click', () => {
        const file = imageInput.files[0]; // 当前选择的文件
        if (!file) return;

        const mime = file.type;
        const filename = file.name;

        // 文件类型校验
        if (allowedTypes.length && !allowedTypes.includes(mime)) {
            Toast.fire({ icon: 'error', title: '지원되지 않는 파일 형식입니다.' });
            return;
        }

        let formData = new FormData();
        formData.append('image', file, filename);
        formData.append('<?= csrf_token() ?>', $('meta[name="<?= csrf_token() ?>"]').attr('content'));
        if ($('#upload_token').val()) {
            formData.append('upload_token', $('#upload_token').val());
        }

        $.ajax({
            url: `<?= route_to('admin.media.create') ?>`,
            method: 'POST',
            dataType: 'JSON',
            data: formData,
            processData: false,
            contentType: false
        }).done((data, textStatus, jqXHR) => {
            Toast.fire({ icon: 'success', title: jqXHR.statusText });

            //更新DOM&token
            uplpadComplateChangeDom(data);

            //上传成功回调钩子 方便扩展其他操作
            if (typeof image_uploader_uploaded_callback === 'function') {
                image_uploader_uploaded_callback(data);
            }
        }).fail((error) => {
            Toast.fire({
                icon: 'error',
                title: error.responseJSON.messages.error,
            });
        });
    });

    //点击上传按钮
    $(document).on('click', '.upload-image-btn', function () {
        imageInput.value = ''; 
        imageInput.click();
        cropimage = $(this).attr('data-cropimage'); //裁切ID 用于多组件区分
        cropWidth = $(this).attr('data-width'); //裁切宽度
        cropHeight = $(this).attr('data-height'); //裁切高度
        //允许文件类型
        const allowedTypesAttr = $(this).attr('data-type');
        if(allowedTypesAttr){
            allowedTypes = allowedTypesAttr.split(',').map(t => t.trim());
        }
    });

    // 监听文件载入
    imageInput.addEventListener('change', e => {
        const file = e.target.files[0];
        if (!file) return;
        // 获取 MIME 类型
        mimeType = file.type;

        // 文件类型过滤
        if (allowedTypes.length && !allowedTypes.includes(mimeType)) {
            Toast.fire({ icon: 'error', title: '지원되지 않는 파일 형식입니다. 허용된 형식: ' + allowedTypes.join(', ')});
            e.target.value = ''; 
            return;
        }

        $('#modal-upload-image').modal('show');

        setTimeout(() => {
            const reader = new FileReader();
            reader.onload = ev => {
                if (cropper) cropper.destroy();
                img.src = ev.target.result;
                img.style.display = 'block';
                img.onload = function() {
                    cropper = new Cropper(img, {
                        aspectRatio: cropWidth / cropHeight,
                        viewMode: 1
                    });
                };
            };
            reader.readAsDataURL(file);
        }, 300);
    });

    //移除图片
     $(document).on('click', '.image-list li span', function () {
        let cropimage = $(this).parents('ul').attr('data-image-list');
        $(this).parent().remove();
        //更新图片id数组
        getSortedImageIds(cropimage);
    });

    saveBtn.addEventListener('click', () => {
        if (!cropper) return;

        const canvas = cropper.getCroppedCanvas({
            
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high',
            width: cropWidth,
            height: cropHeight,
            fillColor: 'transparent', 
        });

        if (!canvas) return;

        let transparent = false;

        // 如果不是 JPG 才判断透明像素
        if (mimeType !== 'image/jpeg' && mimeType !== 'image/jpg') {
            transparent = hasTransparency(canvas);
        }

        const mime = transparent ? 'image/png' : 'image/jpeg';
        const filename = transparent ? 'cropped_image.png' : 'cropped_image.jpg';

        canvas.toBlob(function (blob) {
            let formData = new FormData();
            formData.append('image', blob, filename);

            formData.append('<?= csrf_token() ?>', $('meta[name="<?= csrf_token() ?>"]').attr('content'));
            if ($('#upload_token').val()) {
                formData.append('upload_token', $('#upload_token').val());
            }

            $.ajax({
                url: `<?= route_to('admin.media.create') ?>`,
                method: 'POST',
                dataType: 'JSON',
                data: formData,
                processData: false,
                contentType: false
            }).done((data, textStatus, jqXHR) => {
                Toast.fire({ icon: 'success', title: jqXHR.statusText });

                //更新DOM&token
                uplpadComplateChangeDom(data);

                //上传成功回调钩子 方便扩展其他操作
                if (typeof image_uploader_uploaded_callback === 'function') {
                    image_uploader_uploaded_callback(data);
                }
            }).fail((error) => {
                Toast.fire({
                    icon: 'error',
                    title: error.responseJSON.messages.error,
                });
            });
        }, mime, transparent ? undefined : 0.9);
    });
});
</script>
<?= $this->endSection() ?>