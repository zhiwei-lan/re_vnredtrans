<div class="article-filter">
    <?php if($categories):?>
        <div class="btn-group article-categories">
            <a class="btn btn-default" href="<?= $active_menus['url']??'' ?>" role="button">All</a>
            <?php foreach ($categories as $category): ?>
                <a class="btn btn-default <?= $category['active']?'active':''?>" href="?cate=<?= $category['id'] ?>" role="button"><?= $category['lang_title']??$category['title'] ?></a>
            <?php endforeach ?>
        </div>
    <?php endif; ?>
    <div class="search">
        <form class="form-inline">
            <?php foreach ($categories as $category): ?>
                <?php if ($category['active']): ?>
                    <input type="hidden" name="cate" value="<?= $category['id'] ?>">
                <?php endif; ?>
            <?php endforeach ?>
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" name="keyword" placeholder="<?= lang('HaoCMS.global.placeholder.keyword') ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i><?= lang('HaoCMS.global.search') ?></button>
        </form>
    </div>
</div>