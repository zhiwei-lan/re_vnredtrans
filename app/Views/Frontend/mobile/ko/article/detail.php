<?= $this->extend('Frontend/default/layout/index_m') ?>
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
      	<style type="text/css">
		.detail_title{
			font-size: 24px;
			font-weight: bold;
			color: #000;
			text-align: center;
			margin-bottom: 30px
		}
		.detail_title p{
			font-size: 18px;
			font-weight: bold;
			color: #000;
			text-align: center;
		}
		.detail_title span{
			font-size: 16px;
			font-weight: bold;
			color: #eaeaea;
			text-align: center;
		}
		.detail_info{
			text-align: left;
		}
		.story_list{
			margin: 50px 0px;
		}
		.story_list .detail_story_title{
			font-size: 24px;
			font-weight: bold;
			color: #000;
			text-align: left;
			padding-left: 15px;
			padding-bottom: 30px;
		}
		.story_list .btn_area{
			text-align: center;
			margin-top: 50px;
		}
		.story_list .btn-list{
			font-size: 18px;
			font-weight: bold;
			color: #eaeaea;
			background-color: #ee4c47;
			padding: 5px 30px;
			border-radius: 20px;
		}
		</style>
		<div class="row col-md-12">
			<div class="detail_title"><p><?= esc($data['subject']??'') ?></p><?= esc($data['title']??'') ?><br><span><?= $data['created_at']??'' ?></span></div>
			<div class="detail_info">
				<?= $data['content_html']??'' ?>
			</div>
		</div>
	    <div class="row col-md-12 story_list">
			<div class="detail_story_title">관련 콘텐츠</div>
			<?php foreach($data['articles_list'] as $s):?>
			<div class="col-md-4 col-xs-6 story_item">
				<a href="/<?= service('lang')->getLocale() ?>/article/<?= $active_menus['id'] ?>/detail/<?= $s['slug'] ?>/<?= $s['id'] ?>"><img src="<?= base_url($s['thumbnail']??'assets/lib/haocms/frontend/images/default_images.png')?>">
				<div class="cate"><?= esc($s['default_subject']);?></div>
				<div class="title"><?= esc($s['default_title']);?></div></a>
			</div>
			<?php endforeach;?>
			<div class="col-md-12 btn_area">
				<a class="btn btn-list" href="/ko/article/98/story">목록보기</a>
			</div>
		</div>
    </div>
</div>
<?= $this->endSection() ?>	


					
				
