<nav
    class="main-header navbar navbar-expand navbar-<?= config('Haoadmin')->theme['navbar']['bg'] ?> navbar-<?= config('Haoadmin')->theme['navbar']['type'] ?> <?= config('Haoadmin')->theme['navbar']['type'] ? '' : 'border-bottom-0' ?>">
    <ul class="nav navbar-nav">
        <li class="nav-item">
            <a class="nav-link sidebar-toggle" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Language Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-globe"></i>
                <span class="ml-2"><?= strtoupper(service('language')->getLocale()) ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <?php
                    $supportedLocales = config('App')->supportedLocales;
                    $currentLocale = service('language')->getLocale();
                    $localeNames = [
                        'ko' => '한국어',
                        'en' => 'English',
                        'cn' => '中文',
                        'vn' => 'Tiếng Việt'
                    ];
                ?>
                <?php foreach ($supportedLocales as $locale): ?>
                    <a class="dropdown-item <?= $locale === $currentLocale ? 'active' : '' ?>" 
                       href="?language=<?= $locale ?>">
                        <i class="fas fa-check <?= $locale === $currentLocale ? '' : 'invisible' ?>"></i>
                        <?= $localeNames[$locale] ?? strtoupper($locale) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </li>
        
        <!-- Messages Dropdown Menu -->
        <!-- Notifications Dropdown Menu -->
        <?php if (config('Haoadmin')->theme['navbar']['user']['visible']) { ?>
        <li class="nav-item">
            <a href="<?= route_to('admin/user/profile') ?>" class="nav-link d-flex align-items-center">
                <img src="/assets/lib/backend/avatar.jpg"
                    class="avatar-img img-circle bg-gray mr-2 elevation-<?= config('Haoadmin')->theme['navbar']['user']['shadow'] ?>"
                    alt="<?= auth()->user()->username ?>" height="32">
                <?= auth()->user()->username ?>
            </a>
        </li>
        <?php } ?>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-power-off"></i>
                <!-- <span class="badge badge-warning navbar-badge">15</span> -->
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="/assets/lib/backend/avatar.jpg" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"><?= auth()->user()->username ?></h3>

                        <p class="text-muted text-center"><?= auth()->user()->email ?></p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <span><?= lang('Haoadmin.user.fields.join') ?></span> 
                                <div class="float-right">
                                    <?= auth()->user()->created_at->toLocalizedString('MMM d, yyyy') ?>
                                </div>
                            </li>
                        </ul>

                        <a href="<?= route_to('logout') ?>" class="btn btn-primary btn-block"><b><?= lang('Haoadmin.global.logout') ?></b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </li>
    </ul>
</nav>