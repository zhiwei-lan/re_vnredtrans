<div class="article-filter">
<div class="navi">
    <?php if($categories):?>
        <div class="navi">
            <ul>
            <li><a  href="<?= $active_menus['url']??'' ?>" role="button">ALL</a></li>
            <?php foreach ($categories as $category): ?>
                <li class="<?= $category['active']?'active':''?>"><a href="?cate=<?= $category['id'] ?>" role="button"><?= $category['lang_title']??$category['title'] ?></a></li>
            <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>
</div>

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
        </form>
    </div>
</div>