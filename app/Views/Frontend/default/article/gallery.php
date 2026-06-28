
<div class="row gallery">
    <?php foreach ($articles as $article): ?>
    <div class="col-sm-6 col-md-4">
        <div class="thum_area">
            <a href="/<?= service('lang')->getLocale() ?>/article/<?= $active_menus['id'] ?>/detail/<?= $article['slug'] ?>/<?= $article['id'] ?>">
                <div class="thumbnail-image" style="background-image: url('<?= base_url($article['thumbnail']??'assets/lib/haocms/frontend/images/default_images.png') ?>');"></div>
            </a>
        </div>
        <div class="cont_area">
            <div class="title"><?= esc($article['title'])??esc($article['default_title']) ?></div>
            <div class="more_info"><?= lang('HaoCMS.global.created_at') ?>:<?= esc($article['created_at']) ?></div>
            <div class="more_info"><?= lang('HaoCMS.global.author') ?>:<?= esc($article['author']) ?></div>
            <div class="more_info"><?= lang('HaoCMS.global.category') ?>:<?= esc($article['category']??$article['default_category']) ?></div>
            <div class="more_info"><?= lang('HaoCMS.global.view_count') ?>:<?= esc($article['view_count']) ?></div>
        </div>
    </div>
    <?php endforeach ?>
    <?php if(empty($article)):?>
        <p style="padding:50px 0;" class="text-info text-center">no more data...</p>
    <?php endif; ?>
    <div class="clearfix"></div>
    <?= $pager->links() ?>
</div>