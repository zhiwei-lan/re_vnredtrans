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
<nav class="header navbar navbar-default bootsnav menu-center false fixed navbar-sticky">
      <div class="top-navi">
        <div class="container">
          <!-- <div class="slogan">본사이트는 정부 기관이 아닌 민간 사이트입니다. </div> -->
          <div class="group">
            <div class="login">
              <?php if(auth()->user()){?>

                <a href="/ko/mypage/userinfo">My Page</a>
                <a href="/ko/phone/logout">로그아웃</a>

              <?php }else{?>
                <a href="/ko/phone/login">로그인</a>
                <a href="/ko/phone/register">회원가입</a>
              <?php }?>

            </div>
            <div class="zoom-font" style="padding-left: 15px;">
              <div class="txt">글자크기</div>
              <div id="plus">+</div>
              <div id="minus">-</div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?= service('lang')->getLocale()===$config->defaultLocale ? '/' :'/'.service('lang')->getLocale() ?>"><img src="/assets/images/vn_logo.png" class="logo img-responsive" alt="" style="width: 172px;height:40px;"></a>
          </a> 
        </div>
        <!-- End Header Navigation -->
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-menu">
          <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeInUp">
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
        <!-- /.navbar-collapse -->
      </div>
    </nav>
    
    
  <!-- quickmenu start -->
  <div class="quickmenu">
    <div class="banner">
      <img src="/assets/images/quickmenu_03.png">
    </div>
    <div class="kakao">
      <img src="/assets/images/quickmenu_07.png">
    </div>
    <div class="chatbtn">
      <div class="icon">
        <img src="/assets/images/quickmenu_10.png">
      </div>
      <div class="cont">무엇을 찾으시나요?</div>
    </div>
    <div class="back2top">
      <img src="/assets/images/quickmenu_12.png">
    </div>
  </div>
  <!-- quickmenu end -->

