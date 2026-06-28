<?= $this->extend('Frontend/default/layout/index_sub') ?>
<?= $this->section('content') ?>
<div class="subpage">
		<div class="top-banner container">
			<div class="title">법인 설립 FAQ</div>
		</div>

        <?= view('Frontend/ko/article/qa', [
            'articles' => $articles_list['article']??[],
            'pager'    => $articles_list['pager']??null,
        ]) ?>

	<div class="item-8 container">
            <div class="item">
                <div class="txt1">세부 상담이 필요하신가요?</div>
                <div class="txt2">
                    레드트랜스는 베트남 호치민에 현지 사무소를 운영하고 있습니다.<br>현지 상담 / 온라인 상담을 신청해보세요.<br>
                </div>
                <div class="txt3">
                    <a class="submit" href="#">문의하기<i></i></a>
                    <a class="submit black" href="/ko/pages/vn_company">서비스 소개<i></i></a>
                </div>
            </div>
            <div class="item">
                <img src="/assets/images/images/sub2_5_14.png">
            </div>
        </div>

	</div>
<?= $this->endSection() ?>	


					
				
