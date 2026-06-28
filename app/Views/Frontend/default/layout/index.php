<?php
	$site = service('site')->getSiteInfo();
	$locale = service('lang')->getLocale();
	$defaultMeta = [
		'description' => $site->meta_description,
		'keywords'    => $site->meta_keywords,
		'og_image'    => $locale.'_default_og_image.jpg',
	];
	$pageTitle = trim($this->renderSection('page_title', true));
	$meta      = $this->renderSection('meta', true);
	$meta      = $meta ? json_decode($meta, true) : [];
	$meta = array_merge($defaultMeta, $meta);
	$title = $pageTitle
		? esc($pageTitle) . ' - ' . esc($site->site_name)
		: esc($site->site_name);
?>
<!DOCTYPE html>
<html lang="<?= esc($locale) ?>">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="<?= csrf_token() ?>" content="<?= csrf_hash() ?>">
    	<title><?= $title ?></title>
		<!-- Basic Meta -->
		<meta name="description" content="<?= esc($meta['description']) ?>">
		<meta name="keywords" content="<?= esc($meta['keywords']) ?>">
		<!-- Open Graph -->
		<meta property="og:type" content="website">
		<meta property="og:title" content="<?= $title ?>">
		<meta property="og:description" content="<?= esc($meta['description']) ?>">
		<meta property="og:image" content="/<?= esc($meta['og_image']) ?>">
		<meta property="og:url" content="<?= service('uri')?>">
		<!-- Twitter Card -->
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:title" content="<?= $title ?>">
		<meta name="twitter:description" content="<?= esc($meta['description']) ?>">
		<meta name="twitter:image" content="/<?= esc($meta['og_image']) ?>">
		<meta name="twitter:url" content="<?= service('uri')?>">
		<!-- favicon -->
		<link rel="shortcut icon" href="/favicon.ico">

        <!-- font pretendard -->
		<link href="/assets/fonts/Pretendard-1.3.9/web/static/pretendard.css" rel="stylesheet">
        <!-- bootstrap3 -->
		<link href="/assets/lib/bootstrap-3.4.1-dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- OwlCarousel2 -->
		<link href="/assets/lib/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css" rel="stylesheet">
		<link rel="stylesheet" href="/assets/lib/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">
		<!-- bootsnav -->
        <link rel="stylesheet" href="/assets/lib/bootsnav/bootsnav.css">
        <!-- animate css -->
		<link rel="stylesheet" href="/assets/lib/animate.css-master/animate.min.css">
		<!-- Render section css -->
  		<?= $this->renderSection('css') ?>
        <!-- customer style -->
		<link href="/assets/css/style.css" rel="stylesheet">
	</head>
	<body class="vietnam">
		<!-- Header -->
        <?= $this->include('Frontend/default/layout/header') ?>

        <!-- Content -->
		<?= $this->renderSection('content') ?>

        <!-- Footer -->
        <?= $this->include('Frontend/default/layout/footer') ?>
        
		
		<!-- jquery -->
		<script src="/assets/lib/jquery@3.4.1/dist/jquery.min.js"></script>
		<?= $this->include('Frontend/default/load/ajax') ?>
        <!-- bootstrap3 -->
		<script src="/assets/lib/bootstrap-3.4.1-dist/js/bootstrap.min.js"></script>
		 <!-- bootsnav -->
		<script src="/assets/lib/bootsnav/bootsnav.js"></script>
        <!-- mousewheel -->
		<script src="/assets/lib/jquery-mousewheel-master/jquery.mousewheel.js"></script>
        <!-- carousel -->
		<script src="/assets/lib/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
		<!-- popup -->
		<?= $this->include('Frontend/default/load/popup') ?>
		<!-- sweetalert -->
		<?= $this->include('Frontend/default/load/message_alert') ?>
		<!-- scrolla -->
		<script src="/assets/lib/jquery-scrolla-master/src/scrolla.jquery.js"></script>
		<!-- Render section js -->
  		<?= $this->renderSection('js') ?>
        <!-- init script -->
		<script src="/assets/js/init-script.js"></script>
		<script src="/assets/lib/jquery-easing/jquery.easing.1.3.js"></script>
		<script src="/assets/lib/swiper/swiper-bundle.min.js"></script>
		<script src="/assets/lib/waypoints-master/lib/jquery.waypoints.min.js"></script>
		<script src="/assets/lib/countUp.js-master/jquery.countup.min.js"></script>
		<script src="/assets/js/bootstrap.min.js"></script>
		<!-- sweetalert -->
		<script src="/assets/lib/sweetalert-master/sweetalert.min.js"></script>
		<!-- form validate -->
		<script src="/assets/lib/jquery-validation-1.17.0/jquery.validate.min.js"></script>
		<script src="/assets/lib/hao-template/form/validation-config.js"></script>
		<script src="/assets/lib/jquery-scrolla-master/src/scrolla.jquery.js"></script>
		<script src="/assets/js/haodesign-script.js"></script>
		<script src="/assets/js/jquery.redirect.js"></script>
		
	</body>
</html>
