<?= $this->extend('Frontend/default/layout/index_sub') ?>

<?= $this->section('content') ?>
<div class="subpage">
		<div class="top-banner container">
			<div class="title">REDTRANS REVIEW</div>
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
			<div class="bd">
				<div class="text">
					<div class="t1">REDTRANS REVIEW</div>
					<div class="t2">레드트랜스 리뷰</div>
					<div class="t3">
                        레드트랜스를 이용해주신 고객님들의 소중한 경험을 공유해주세요.<br>
좋았던 점, 아쉬웠던 점은 저희가 더 나은 서비스를 만드는 데 귀중한 자료가 됩니다.
                    </div>
				</div>
				<div class="img">
					<img src="/resource/home/ko/assets/images/faq.png">
				</div>
			</div>
		</div>
        
        <div class="review">
            <!-- start item-3 -->
            <div class="item-3 container">
                <div class="hd">
                    <div class="title">
                        베스트 리뷰러들만 모았다.<br>고객 인터뷰
                    </div>
                </div>
                <div class="bd">
                    <div class="owl-carousel owl-theme owl-loaded">
                        <div class="owl-stage-outer">
                            <div class="owl-stage" style="display: flex;align-items: flex-start;justify-content: flex-start;flex-flow: wrap;">
	                            <?php 
									$articles = $articles_list['article']??[];
									$pager = $articles_list['pager']??null;
								?>
							
                            	<?php foreach($articles as $s):?>
				                <div class="owl-item">
				                  <div class="item">
				                    <div class="avatar">
				                      <img src="<?= base_url($s['thumbnail']??'assets/lib/haocms/frontend/images/default_images.png')?>">
				                    </div>
				                    <div class="cate"><?= esc($s['default_subject'])??esc($s['default_subject']) ?></div>
				                    <div class="name"><?= esc($s['title'])??esc($s['default_title']) ?></div>
				                    <div class="description">
				                      <?php echo $s['default_description']?>
				                    </div>
				                  </div>
				                </div>
				                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end item-3 -->

            
        </div>
        
	</div>
<?= $this->endSection() ?>	


					
				
