<input type="file" id="fileInput"  style="display:none;">
<?= $this->section('js') ?>
<script src="/assets/lib/Sortable-master/Sortable.min.js"></script>
<script>
$(document).ready(function () {
    // 初始化 Sortable
    document.querySelectorAll('.file-list').forEach((item,index)=>{
        new Sortable(item, {
            animation: 150,
            onChange: function(evt) {
                getSortedFileIds(evt.srcElement.getAttribute('data-file-list'))
            }
        });
    })

    // 更新fileid排序
    function getSortedFileIds(fileGroup) {
        let ids = [];
        $('ul[data-file-list='+fileGroup+'] li').each(function(){
            ids.push($(this).attr('data-id'));
        });
        $('input[data-file-id='+fileGroup+']').val(ids)
    }
    let fileGroup = null;

    const fileInput = document.getElementById('fileInput'); //文件选择器
    if (!fileInput) {
        console.error("cant find fileInput element，please check HTML ID is allrealy has");
        return;
    }
    //点击上传按钮
    $(document).on('click', '.upload-file-btn', function () {
        fileGroup = $(this).attr('data-file-upload'); //裁切ID 用于多组件区分
        fileInput.value = ''; 
        fileInput.click();
    });

    //监听文件载入
    fileInput.addEventListener('change', e => {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = ev => {
            let formData = new FormData();
            formData.append('file', file);
            //+csrf认证
            formData.append('<?= csrf_token() ?>', $('meta[name="<?= csrf_token() ?>"]').attr('content'));
            //+会话token
            if($('#upload_token').val()){
                formData.append('upload_token', $('#upload_token').val());
            }
            //上传文件
            $.ajax({
                url: `<?= route_to('admin.media.create') ?>`,
                method: 'POST',
                dataType: 'JSON',
                data: formData,
                processData: false,
                contentType: false
            }).done((data, textStatus, jqXHR) => {
                Toast.fire({
                    icon: 'success',
                    title: jqXHR.statusText
                });
                //添加文件dom
                let html =  '<li data-id="'+data.media_id+'">'
                    html += '<i class="fas fa-file"></i>'
                    html += '<span>'+data.original_name+'</span>'
                    html += '<i class="fas fa-times-circle"></i></li>'
                $('ul[data-file-list='+fileGroup+']').append(html);
                //更新会话token
                $('#upload_token').val(data.upload_token)
                //更新图片id数组
                getSortedFileIds(fileGroup);
            }).fail((error) => {
                Toast.fire({
                    icon: 'error',
                    title: error.responseJSON.messages.error,
                });
            })
        };
        reader.readAsDataURL(file);
    });

    //移除文件
     $(document).on('click', '.file-list li .fa-times-circle', function () {
        let files = $(this).parents('ul').attr('data-file-list');
        $(this).parent().remove();
        //更新文件id数组
        getSortedFileIds(fileGroup);
    });
});
</script>
<?= $this->endSection() ?>