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
<!-- Push section css -->
<?= $this->section('css') ?>
<link href="/assets/lib/quill/quill.snow.css" rel="stylesheet" />
<link href="/assets/lib/quill/quill-emoji.css" rel="stylesheet">
<?= $this->endSection() ?>



<div class="container article-detail">
			
<!-- article thumbnails -->
<?php if(!empty($data['thumbnail'])):?>
<h4>thumbnails:</h4>
<div class="detail-thumbnail">
	<div class="row">
		<?php foreach ($data['thumbnail'] as $thumbnail): ?>
		<div class="col-xs-6 col-md-3">
			<a class="thumbnail">
				<img src="<?= base_url($thumbnail['path']) ?>">
			</a>
		</div>
		<?php endforeach ?>
	</div>
</div>
<?php endif; ?>

<!-- article gallery -->
<?php if(!empty($data['gallery'])):?>
<h4>gallery:</h4>
<div class="detail-thumbnail">
	<div class="row">
		<?php foreach ($data['gallery'] as $gallery): ?>
		<div class="col-xs-6 col-md-3">
			<a class="thumbnail">
				<img src="<?= base_url($gallery['path']) ?>">
			</a>
		</div>
		<?php endforeach ?>
	</div>
</div>
<?php endif; ?>
<!-- aricle hedaer -->
<div class="detail-header">
	<div class="title"><?= esc($data['title']??'') ?></div>
	<div class="btn-group" role="group" aria-label="...">
		<button class="btn btn-default">category:<?= esc($data['category']??$data['default_category']) ?></button>
		<button class="btn btn-default">author：<?= esc($data['author']??'') ?></button>
		<button class="btn btn-default">date：<?= $data['created_at']??'' ?></button>
		<button class="btn btn-default">view:<?= $data['view_count']??0 ?></button>
	</div>
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

<?php if(!empty($data['prev_article'])||!empty($data['next_article'])):?>
<nav class="detail-navigation">
	<ul>
		<?php if(!empty($data['prev_article'])):?>
		<li class="prev">
			<span><i class="fa fa-arrow-up"></i><?= lang('HaoCMS.global.prev_article') ?></span>
			<a href="/<?= service('lang')->getLocale() ?>/article/<?= $active_menus['id'] ?>/detail/<?= $data['prev_article']['slug'] ?>/<?= $data['prev_article']['id'] ?>"><?= esc($data['prev_article']['title'] ??$data['prev_article']['default_title'] )?></a>
		</li>
		<?php endif; ?>
		<?php if(!empty($data['next_article'])):?>
		<li class="next">
			<span><i class="fa fa-arrow-down"></i><?= lang('HaoCMS.global.next_article') ?></span>
			<a href="/<?= service('lang')->getLocale() ?>/article/<?= $active_menus['id'] ?>/detail/<?= $data['next_article']['slug'] ?>/<?= $data['next_article']['id'] ?>"><?= esc($data['next_article']['title']??$data['next_article']['default_title']) ?></a>
		</li>
		<?php endif; ?>
	</ul>
</nav>
<?php endif; ?>

<div class="col-sm-12 text-center">
	<a href="/<?= service('lang')->getLocale() ?>/<?= esc($active_menus['url']??'') ?>" class="btn btn-default"><?= lang('HaoCMS.global.list') ?></a>
</div>
</div>


					
				
