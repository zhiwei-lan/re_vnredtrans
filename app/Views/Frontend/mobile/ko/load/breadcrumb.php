<div class="navi">
        <a href="/">Home</a><i>></i>
        <?php foreach ($breadcrumb as $index => $item): ?>
            <?php if ($index === array_key_last($breadcrumb)): ?>
                <a>
                    <?= empty(esc($item['lang_title']))?esc($item['title']):esc($item['lang_title']) ?>
                </a>
                <?php if ($index !== array_key_last($breadcrumb)): ?><i>></i><?php endif; ?>
            <?php else: ?>
                <a <?= !empty($item['url'])?'href="/'.service('lang')->getLocale().esc($item['url']).'"':'' ?>>
                    <?= empty(esc($item['lang_title']))?esc($item['title']):esc($item['lang_title']) ?>
                </a><?php if ($index !== array_key_last($breadcrumb)): ?><i>></i><?php endif; ?>
            <?php endif ?>
        <?php endforeach ?>
</div>

