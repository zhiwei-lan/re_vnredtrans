<div class="subpage-hd ">
    <div class="container">
        <ul>
            <?php foreach ($menus as $menu): ?>
                <?php if($menu['id'] == $active_menus['parent_id']):?>
                    <?php foreach ($menu['children'] as $item): ?>
                        <li>
                            <a href="<?= esc($item['url']) ?>"><?= esc($item['lang_title']??$item['title']) ?></a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>