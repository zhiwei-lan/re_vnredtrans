<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <?php foreach ($breadcrumb as $index => $item): ?>
            <?php if ($index === array_key_last($breadcrumb)): ?>
                <li class="breadcrumb-item active" aria-current="page">
                    <?= empty(esc($item['lang_title']))?esc($item['title']):esc($item['lang_title']) ?>
                </li>
            <?php else: ?>

                <li class="breadcrumb-item">
                    <a <?= !empty($item['url'])?'href="/'.service('lang')->getLocale().esc($item['url']).'"':'' ?>>
                        <?= empty(esc($item['lang_title']))?esc($item['title']):esc($item['lang_title']) ?>
                    </a>
                </li>
            <?php endif ?>
        <?php endforeach ?>
    </ol>
</nav>