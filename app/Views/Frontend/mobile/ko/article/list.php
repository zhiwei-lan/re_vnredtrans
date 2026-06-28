<table class="notice-board col-sm-12" id="notice-board">
    <thead>
        <tr>
            <td class="number"><?= lang('HaoCMS.global.sequence') ?></td>
            <td class="title"><?= lang('HaoCMS.global.title') ?></td>
            <td class="author"><?= lang('HaoCMS.global.author') ?></td>
            <td class="creat_at"><?= lang('HaoCMS.global.created_at') ?></td>
            <td class="view"><?= lang('HaoCMS.global.view_count') ?></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($articles as $article): ?>
        <tr class="<?= $article['is_fixed']?'fixed':'' ?>">
            <td class="number"><?= $article['is_fixed']?'<span class="glyphicon glyphicon-arrow-up"></span>':$article['id'] ?></td>
            <td class="title"><a href="/<?= service('lang')->getLocale() ?>/article/<?= $active_menus['id'] ?>/detail/<?= $article['slug'] ?>/<?= $article['id'] ?>"><?= $article['title']??$article['default_title'] ?></a></td>
            <td class="author"><?= $article['author'] ?></td>
            <td class="creat_at"><?= date('Y-m-d', strtotime($article['created_at'])) ?></td>
            <td class="view"><?= $article['view_count'] ?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?php if(empty($article)):?>
    <p style="padding:50px 0;" class="text-info text-center"><?= lang('HaoCMS.global.no_more_data') ?></p>
<?php endif; ?>
    
<div class="clearfix"></div>
<?= $pager->links() ?>