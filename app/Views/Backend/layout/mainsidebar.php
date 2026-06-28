<aside class="main-sidebar <?= config('Haoadmin')->theme['sidebar']['border'] ? 'border-right' : ''?> sidebar-<?= config('Haoadmin')->theme['sidebar']['type'] ?>-<?= config('Haoadmin')->theme['sidebar']['links']['bg'] ?> elevation-<?= config('Haoadmin')->theme['sidebar']['shadow'] ?>">
    <a href="<?= route_to('/') ?>" class="brand-link <?= !empty(config('Haoadmin')->theme['sidebar']['brand']['bg']) ? 'bg-'.config('Haoadmin')->theme['sidebar']['brand']['bg'] : '' ?>">
        <img src="<?= base_url(config('Haoadmin')->theme['sidebar']['brand']['logo']['icon']) ?>" class="brand-image img-circle elevation-<?= config('Haoadmin')->theme['sidebar']['brand']['logo']['shadow'] ?>" style="opacity: .8">
        <span class="brand-text"><?= config('Haoadmin')->theme['sidebar']['brand']['logo']['text'] ?></span>
    </a>
    <div class="sidebar">
        <?php if (config('Haoadmin')->theme['sidebar']['user']['visible']) { ?>
        <div class="user-panel py-3 d-flex">
            <div class="image">
                <img src="/assets/lib/backend/avatar.jpg" class="img-circle elevation-<?= config('Haoadmin')->theme['sidebar']['user']['shadow'] ?>"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="<?= route_to('user-profile') ?>" class="d-block"><?= auth()->user()->username ?></a>
            </div>
        </div>
        <?php } ?>
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent <?= config('Haoadmin')->theme['sidebar']['compact'] ? 'nav-compact' : '' ?>" data-widget="treeview"
                role="menu" data-accordion="false">
                <?php foreach (menu() as $parent): ?>
                <li class="nav-item has-treeview <?= current_url() == base_url($parent['route']) ? 'menu-open' : '' ?>">
                    <a href="<?= base_url($parent['route']) ?>" class="nav-link <?= current_url() == base_url($parent['route']) ? 'active' : '' ?>">
                        <i class="nav-icon <?= $parent['icon'] ?>"></i>
                        <p>
                            <?= esc($parent['title']) ?>
                            <?php if ($parent['children']): ?>
                                <i class="right fas fa-angle-left"></i>
                            <?php endif ?>
                        </p>
                    </a>

                    <?php if ($parent['children']): ?>
                    <ul class="nav nav-treeview">
                        <?php foreach ($parent['children'] as $child): ?>
                        <li class="nav-item">
                            <a href="<?= base_url($child['route']) ?>" class="nav-link <?= current_url() == base_url($child['route']) ? 'active' : '' ?>">
                                <i class="nav-icon <?= $child['icon'] ?>"></i>
                                <p><?= esc($child['title']) ?></p>
                            </a>
                        </li>
                        <?php endforeach ?>
                    </ul>
                    <?php endif ?>
                </li>
                <?php endforeach ?>
            </ul>
        </nav>
    </div>
</aside>