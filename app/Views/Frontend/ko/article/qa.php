        <div class="qna container">
            <?php foreach($articles as $article):?>
            <div class="item">
                <div class="hd">
                    <div class="title">
                        <div class="q">Q.</div>
                        <div class="txt"><?= $article['title']??$article['default_title']?></div>
                    </div>
                    <div class="close"></div>
                </div>
                <div class="bd">
                    <div class="a">A.</div>
                    <div class="txt">
                        <?= $article['content'] ?>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
            
        </div>

<?php if(empty($articles)):?>
    <p style="padding:50px 0;" class="text-info text-center"><?= lang('HaoCMS.global.no_more_data') ?></p>
<?php endif; ?>
    
<div class="clearfix"></div>
<?= $pager->links() ?>