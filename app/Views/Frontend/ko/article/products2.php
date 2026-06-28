<?= $this->extend('Frontend/default/layout/index') ?>
<?= $this->section('page_title') ?>
<?= esc($active_menus['lang_title']??$active_menus['title']) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="wrap-content subpage">
    
<!-- subpagetopbg start -->
<div class="subpagetopbg products">
	<div class="container">
		<div class="title"><?= esc($active_menus['lang_title']??$active_menus['title']) ?></div>
		<div class="subject"><?= esc($active_menus['lang_subject']??$active_menus['subject']) ?></div>
	</div>
</div>
<!-- subpagetopbg end -->
<div class="container"><?= view('Frontend/ko/load/breadcrumb') ?></div>
<!-- subpage start -->
<div class="subpage">
	<!-- subpage-hd start -->
	<?= view('Frontend/ko/load/subpage_hd') ?>
	<!-- subpage-hd start -->
	<div class="container products">
		<div class="hd">
			<h4><?= esc($active_menus['lang_title']??$active_menus['title']) ?></h4>
			<p>농업회사법인㈜네이처포스의 OEM을 통해 제조한 제품</p>
		</div>
		<div class="bd row">
			<?php 
			$articles = $articles_list['article']??[];
			$pager = $articles_list['pager']??null;
			?>
			<div class="list">
			<?php foreach ($articles as $article): ?>
				<div class="col-md-4 col-xs-6">
					<a class="item" href="/<?= service('lang')->getLocale() ?>/article/<?= $active_menus['id'] ?>/detail/<?= $article['slug'] ?>/<?= $article['id'] ?>">
						<div class="thumb" style="background-image: url('<?= base_url($article['thumbnail']??'assets/lib/haocms/frontend/images/default_images.png') ?>');"></div>
						<div class="title"><?= esc($article['title'])??esc($article['default_title']) ?></div>
					</a>
				</div>
			<?php endforeach ?>
			<?php if(empty($article)):?>
				<p style="padding:50px 0;" class="text-info text-center">no more data...</p>
			<?php endif; ?>
			<div class="clearfix"></div>
			<div class="products_detail_pager">
				<img src="/assets/images/CM-상세-1-768x1459.jpg" class="img-responsive center-block">
				<img src="/assets/images/CM-상세-2-768x1159.jpg" class="img-responsive center-block">
				<img src="/assets/images/CM-상세-3-768x1159.jpg" class="img-responsive center-block">
				<img src="/assets/images/CM-상세-4-768x1324.jpg" class="img-responsive center-block">
				<img src="/assets/images/CM-상세-5-768x381.jpg" class="img-responsive center-block">
				<img src="/assets/images/CM-상세-6-1-768x1992.jpg" class="img-responsive center-block">
				<img src="/assets/images/CM-상세-7-768x1745.jpg" class="img-responsive center-block">


				<img src="/assets/images/WINTO-상세-1-768x1459.jpg" class="img-responsive center-block">
				<img src="/assets/images/WINTO-상세-2-768x1174.jpg" class="img-responsive center-block">
				<img src="/assets/images/WINTO-상세-3-768x1138.jpg" class="img-responsive center-block">
				<img src="/assets/images/WINTO-상세-4-768x1604.jpg" class="img-responsive center-block">
				<img src="/assets/images/WINTO-상세-5-768x1152.jpg" class="img-responsive center-block">
				<img src="/assets/images/WINTO-상세-6-768x2700.jpg" class="img-responsive center-block">

				<img src="/assets/images/사포닌1136-상세-1-768x1528.jpg" class="img-responsive center-block">
				<img src="/assets/images/사포닌1136-상세-2-768x2204.jpg" class="img-responsive center-block">
				<img src="/assets/images/사포닌1136-상세-3-768x1362.jpg" class="img-responsive center-block">
				<img src="/assets/images/사포닌1136-상세-4-768x1185.jpg" class="img-responsive center-block">
				<img src="/assets/images/사포닌1136-상세-5-768x888.jpg" class="img-responsive center-block">
				<img src="/assets/images/사포닌1136-상세-6-768x2050.jpg" class="img-responsive center-block">

				<img src="/assets/images/코디나인-상세-1-768x1459.jpg" class="img-responsive center-block">
				<img src="/assets/images/코디나인-상세-2-768x2416.jpg" class="img-responsive center-block">
				<img src="/assets/images/코디나인-상세-3-768x1454.jpg" class="img-responsive center-block">
				<img src="/assets/images/코디나인-상세-4-768x1017.jpg" class="img-responsive center-block">
				<img src="/assets/images/코디나인-상세-5-768x1152.jpg" class="img-responsive center-block">
				<img src="/assets/images/코디나인-상세-6-768x1719.jpg" class="img-responsive center-block">
			</div>
			</div>
		</div>
	</div>
	
	
</div>
<!-- subpage end -->
</div>
<?= $this->endSection() ?>	


					
				
