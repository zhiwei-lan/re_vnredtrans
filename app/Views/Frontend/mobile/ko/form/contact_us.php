<?= $this->extend('Frontend/default/layout/index') ?>
<?= $this->section('page_title') ?>
<?= esc($active_menus['lang_title']??$active_menus['title']) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="wrap-content subpage">
    
<!-- subpagetopbg start -->
<div class="subpagetopbg notice">
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
	<div class="container contactus">
		<div class="hd">
			<h3><?= esc($active_menus['lang_title']??$active_menus['title']) ?></h3>
			<p>제품 개발 및 제조 관련 문의는 아래를 통해 상담하실 수 있습니다.</p>
		</div>
		<div class="contact-us col-md-6 col-md-offset-3">
			<!-- form -->
			<?= view('Frontend/default/load/form', [
				'form_data' => $form['fields']??'',
				'max_file_size' => 5,
				'form_class' => 'contact-us-form'
			]) ?>
		</div>
	</div>
	
	
</div>
<!-- subpage end -->
</div>
<?= $this->endSection() ?>	


					
				
