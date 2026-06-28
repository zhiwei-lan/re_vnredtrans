
<link href="/assets/lib/haocms/frontend/css/popup.css" rel="stylesheet">
<script>

    $.ajax({
        url: '/api/popups',
        type: 'Get',
        dataType: 'json',
        success: function(res){
            if (res.code !== 200 || !res.data.length) return;
            for (const popup of res.data) {
                if (popup.show_once == '1') {
                    const seen = localStorage.getItem('popup_seen_' + popup.id);
                    if (seen) continue;
                }
                showPopup(popup);
            }
        }
    });

    function preloadImage(src) {
        return new Promise((resolve, reject) => {
            const img = new Image();
            img.onload = () => resolve(src);
            img.onerror = reject;
            img.src = src;
        });
    }

    function showPopup(popup) {

        const imageSrc = popup.media_data
            ? '/' + popup.media_data.split('###')[0]
            : null;

        if (imageSrc) {
            preloadImage(imageSrc).then(() => {
                renderPopup(popup, imageSrc);
            }).catch(() => {
                renderPopup(popup, null);
            });
        } else {
            renderPopup(popup, null);
        }
    }
    function renderPopup(popup, imageSrc) {
        document.body.insertAdjacentHTML('beforeend', `
            <div class="popupmodal ${popup.location}"
                style="
                    width:${popup.width}px;
                    height:${parseInt(popup.height) + 105}px;
                    margin-left:${popup.offset_left}px;
                    margin-top:${popup.offset_top}px;
                ">
                <div class="content">
                    <div class="header">
                        <h5 class="title">${popup.title}</h5>
                        <button type="button" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="body">
                        ${imageSrc ? `<a href="${popup.link}" target="${popup.open_new == 1 ? '_blank' : '_self'}"><img src="${imageSrc}" style="max-width:100%;max-height:100%;"></a>` : ''}
                    </div>

                    <div class="footer">
                        <button type="button"><?= lang('HaoCMS.global.dont_show_again') ?></button>
                    </div>
                </div>
            </div>
        `);

        bindPopupEvent(popup);
    }

    function bindPopupEvent(popup) {

        const $popup = $('.popupmodal').last();

        $popup.find('.header .close').on('click', function () {
            $popup.remove();
        });

        $popup.find('.footer button').on('click', function () {
            localStorage.setItem('popup_seen_' + popup.id, 'true');
            $popup.remove();
        });
    }
</script>

