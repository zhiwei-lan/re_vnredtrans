<!-- Start Navigation -->
<?php
$config  = config('App', false);
$locales = $config->supportedLocales;
$defaultLocale = $config->defaultLocale;
$currentLocale = service('lang')->getLocale();

// 当前 URI 去掉语言前缀
$uri = uri_string();
$uri = preg_replace(
    '#^(' . implode('|', $locales) . ')(/|$)#',
    '',
    $uri
);
$uri = trim($uri, '/'); // 去掉首尾 /
$site = service('site')->getSiteInfo();
?>
<nav>
<div class="navi" id="navi">
    <button type="button" class="navbar-toggle">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <div class="logo">
        <a href="<?= service('lang')->getLocale()===$config->defaultLocale ? '/' :'/'.service('lang')->getLocale() ?>"><img src="/assets/images/vn_logo.png" style="width: 172px;height:40px;"></a>
    </div>
    <div class="login">
      <?php if(auth()->user()){?>
        <a href="/ko/mypage/userinfo">My Page</a>
        <a href="/ko/phone/logout">로그아웃</a>
      <?php }else{?>
        <a href="/ko/phone/login">로그인</a>
        <a href="/ko/phone/register">회원가입</a>
      <?php }?>
    </div>
</div>
    <div class="navibar">
        <ul>
          		<?php $count=0;foreach ($menus as $menu): $count++?>
                <?php 
                    if($menu['open_new']==1){
                        $url_menu = preg_replace('#^/ko/#', '', $menu['url']);
                    }else{
                        $url_menu = $menu['url'];
                    }
                ?>
                <li class="dropdown <?= $menu['is_active'] ? 'active' : '' ?>">
                    <a <?= $menu['url'] ? 'href="'.$url_menu . '"' : '' ?>
                    target="<?= $menu['open_new'] ? '_blank' : '' ?>">
                        <?=  esc($menu['lang_title'])??esc($menu['title']) ?>
                    </a>
                    <?php if (!empty($menu['children'])): ?>
                    <ul class="dropdown-menu">
                        <?php foreach ($menu['children'] as $child): ?>
                        <li class="<?= $child['is_current'] ? 'active' : '' ?>">
                            <a href="<?= $child['url'] ?>">
                                <?= esc($child['lang_title'])??esc($child['title']) ?>
                            </a>
                            <?php if (!empty($child['children'])): ?>
                            <ul class="dropdown-menu">
                                <?php foreach ($child['children'] as $childs): ?>
                                <li class="<?= $childs['is_current'] ? 'active' : '' ?>">
                                    <a href="<?= $childs['url'] ?>">
                                        <?= esc($childs['lang_title'])??esc($childs['title']) ?>
                                    </a>
                                </li>
                                <?php endforeach ?>
                            </ul>
                            <?php endif ?>
                        </li>
                        <?php endforeach ?>
                    </ul>
                    <?php endif ?>
                </li>
                <?php endforeach ?>
        </ul>
    </div>
</nav>