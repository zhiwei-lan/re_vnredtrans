<?= $this->extend('Frontend/default/layout/index_m') ?>
<?= $this->section('page_title') ?>
<?= esc($active_menus['lang_title']??$active_menus['title']) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="subpage sub1">
    <div class="top-banner container">
      <div class="title">스토리</div>
    </div>
    <div class="item-1 container">
      <div class="hd">
        <div class="item">
			<div class="label">문의전화</div>
			<div class="value">02-1600-1403</div>
		</div>
		<div class="item">
			<div class="label">문의메일</div>
			<div class="value">sales@redtrans.co.kr</div>
		</div>
      </div>
      	<div class="row col-md-12">
			<ul class="story_cate">
				<?php 
				    $active_menus = $active_menus;
					$categories = $articles_list['categories']??[];
					$active_cate = $articles_list['active_cate']??[];
				if($categories):?>
				<li><a href="<?= $active_menus['url']??'' ?>">전체</a></li>
				<?php foreach ($categories as $category): ?>
				<li><a class="<?= $category['active']?'active':''?><?= $active_cate && $active_cate['parent_id']==$category['id']?'active':''?>" href="?cate=<?= $category['id'] ?>"><?= $category['lang_title']??$category['title'] ?></a></li>
				<?php endforeach;?>

				<?php endif; ?>
			</ul>
		</div>
	    <div class="row">

			<?php 
				$articles = $articles_list['article']??[];
				$pager = $articles_list['pager']??null;
			?>
			<?php foreach ($articles as $s):?>
			<div class="col-md-4 col-xs-6 story_item">
				<a href="/<?= service('lang')->getLocale() ?>/article/<?= $active_menus['id'] ?>/detail/<?= $s['slug'] ?>/<?= $s['id'] ?>"><img src="<?= base_url($s['thumbnail']??'assets/lib/haocms/frontend/images/default_images.png')?>">
				<div class="cate"><?= esc($s['default_subject'])??esc($s['default_subject']) ?></div>
				<div class="title"><?= esc($s['title'])??esc($s['default_title']) ?></div></a>
			</div>
			<?php endforeach;?>
		</div>
		<div class="clearfix"></div>
	    <?= $pager->links() ?>
    </div>
</div>
<?= $this->endSection() ?>	


					
				
