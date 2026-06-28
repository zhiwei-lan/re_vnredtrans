<!-- Push section css -->
<?= $this->section('css') ?>
<link href="/assets/lib/quill/quill.snow.css" rel="stylesheet" />
<link href="/assets/lib/quill/quill-emoji.css" rel="stylesheet">
<?= $this->endSection() ?>

<!-- Push section js -->
<?= $this->section('js') ?>
<script src="/assets/lib/quill/quill.js"></script>
<script src="/assets/lib/quill/quill-emoji.js"></script>
<script>
    $(()=>{
    const quills = {};
    document.querySelectorAll('editor').forEach((el)=>{
        const field = el.dataset.field;
        quills[field] = new Quill(el.querySelector('.editor-container'), {
            theme: 'snow',
            modules: {
                toolbar: el.querySelector('.toolbar-container'),
                history: {
                delay: 1000,     // 合并操作时间（ms）
                maxStack: 100,   // 最大历史记录
                userOnly: true   // 只记录用户操作（推荐）
                }
            }
        });
        
        //初始化内容
        const editorContents = el.querySelector('textarea[datatype=delta]').value;
        if(editorContents){
            quills[field].setContents(JSON.parse(editorContents));
        }
        //撤销重做
        el.querySelector('.toolbar-container .ql-undo').addEventListener('click', () => {
            quills[field].history.undo();
        });
        el.querySelector('.toolbar-container .ql-redo').addEventListener('click', () => {
            quills[field].history.redo();
        });
        //监听修改
        quills[field].on('text-change', (delta, oldDelta, source) => {
            //更新delta
            el.querySelector('textarea[datatype=delta]').value = JSON.stringify(quills[field].getContents());
            //更新html
            el.querySelector('textarea[datatype=html]').value = quills[field].getSemanticHTML();
        });
        // 监听图片按钮
        quills[field].getModule('toolbar').addHandler('image', function() {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.click();
            input.onchange = () => {
                const file = input.files[0];
                if (/^image\//.test(file.type)) {
                    uploadImage(file).then(url => {
                        var range = quills[field].getSelection();
                        quills[field].insertEmbed(range.index, 'image', url);
                    });
                }
            };
        });
    })
    

    // 图片上传处理
    function uploadImage(file) {
        return new Promise(function(resolve, reject) {
            const formData = new FormData();
            formData.append('image', file);
            const tokenInput = document.getElementById('upload_token');
            if (tokenInput && tokenInput.value) {
                formData.append('upload_token', tokenInput.value);
            }
            $.ajax({
                url: '<?= route_to("admin.media.create") ?>',
                type: 'POST',
                data: formData,
                contentType: false, processData: false,
                success: function(res) {
                    if (res.status === 'success') {
                        if (tokenInput && !tokenInput.value && res.upload_token) {
                            tokenInput.value = res.upload_token;
                        }
                        resolve('/'+res.path + '?id=' + res.media_id);
                        Swal.fire({ icon: 'success', title: '업로드 성공' });
                    } else {
                        reject(res.message);
                        Swal.fire({ icon: 'error', title: '업로드 실패', text: res.message });
                    }
                },
                error: function(err) {
                    reject(err);
                    Swal.fire({ icon: 'error', title: '서버 에러', text: err.responseText });
                }
            });
        });
    }

    
    
    })
</script>
<?= $this->endSection() ?>