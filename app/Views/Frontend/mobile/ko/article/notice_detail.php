<?= $this->extend('Frontend/default/layout/index') ?>
<?= $this->section('page_title') ?>
<?= esc($data['title']??'') ?>
<?= $this->endSection() ?>
<?= $this->section('meta') ?>
<?php
	$meta = [];
	if (!empty($data['meta_description'])) {
		$meta['description'] = $data['meta_description'];
	}
	if (!empty($data['meta_keywords'])) {
		$meta['keywords'] = $data['meta_keywords'];
	}
	$firstThumb = $data['thumbnail'][0] ?? null;
	if (!empty($data['thumbnail'])) {
		$meta['og_image'] = base_url($firstThumb['path']);
	}
	if ($meta) {
		echo json_encode($meta, JSON_UNESCAPED_UNICODE);
	}
?>
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

	<!-- main-product start -->
	<div class="portfolio">
		<div class="container">
			<div class="bd">
					<!-- Push section css -->
					<?= $this->section('css') ?>
					<link href="/assets/lib/quill/quill.snow.css" rel="stylesheet" />
					<link href="/assets/lib/quill/quill-emoji.css" rel="stylesheet">
					<?= $this->endSection() ?>

					<div class="article-detail">
								
					
					<!-- aricle hedaer -->
					<div class="detail-header">
						<div class="title"><?= esc($data['title']??'') ?></div>
					</div>
					<!-- aricle contents -->
					<article class="ql-editor">
						<?= $data['content_html']??'' ?>
					</article>
					<!-- files -->
					<?php if(!empty($data['file'])):?>
					<div class="detail-filelist">
						<ul>
							<?php foreach ($data['file'] as $file): ?>
							<li>
								<i class="fa fa-file"></i>
								<span class="file-name"><?= $file['original_name'] ?></span>
								<a href="<?= route_to('download', $file['id']) ?>"><i class="fa fa-download"></i>Donwload</a>
							</li>
							<?php endforeach ?>
						</ul>
					</div>
					<?php endif; ?>

					
					</div>
				
				<div class="clearfix"></div>

			</div>
		</div>
	</div>
	<!-- main-product end -->	
</div>
<!-- subpage end -->
<?= $this->endSection() ?>	


					
				
