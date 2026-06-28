<?= $this->extend('Frontend/default/layout/index_m') ?>
<?= $this->section('content') ?>
<!-- main slider start -->
<?= $this->include('Frontend/default/load/swiper') ?>
<?= view('Frontend/default/swiper/swiper_home_m', [
    'slides' => $main_top_banner['items']??[],
    'config' => $main_top_banner['config']??[],
]) ?>

        <div class="item-12 container">
            <div class="group">
                <a href="/ko/pages/vn_company" class="item">
                    <div class="icon">
                        <img src="/assets/images/vitenam_07.png">
                    </div>
                    <div class="txt">베트남<br>회사 설립</div>
                </a>
                <a href="/ko/pages/cosmetics" class="item">
                    <div class="icon">
                        <img src="/assets/images/vitenam_09.png">
                    </div>
                    <div class="txt">베트남<br>화장품 위생허가</div>
                </a>
                <a href="/ko/pages/vn_trademark" class="item">
                    <div class="icon">
                        <img src="/assets/images/vitenam_15.png">
                    </div>
                    <div class="txt">베트남<br>상표등록 대리</div>
                </a>
                <a href="https://partner.redtrans.co.kr/kr/sub2_9/34" class="item">
                    <div class="icon">
                        <img src="/assets/images/vitenam_17.png">
                    </div>
                    <div class="txt">베트남<br>공증 및 영사인증</div>
                </a>
                <a href="#" class="item">
                    <div class="icon">
                        <img src="/assets/images/vitenam_18.png">
                    </div>
                    <div class="txt">베트남<br>통역</div>
                </a>
            </div>
        </div>
        <div class="item-13 container">
            <video id="bannervideo2" playsinline="" muted="" poster="" loop="" autoplay="" controls width="100%">
                <source src="/assets/images/video20241114.mp4" type="video/mp4">
             </video>
            
        </div>
    
        <div class="item-14 container">
            <div class="hd">여러 기업들과<br>신뢰를 쌓았어요</div>
            <div class="bd">
                <div class="item">
                    <div class="logo"><img src="/assets/images/vietnam_clints_14.png"></div>
                    <div class="bg"><img src="/assets/images/vietnam_clints_03.png"></div>
                </div>
                <div class="item">
                    <div class="logo"><img src="/assets/images/vietnam_clints_15.png"></div>
                    <div class="bg"><img src="/assets/images/vietnam_clints_04.png"></div>
                </div>
                <div class="item">
                    <div class="logo"><img src="/assets/images/vietnam_clints_16.png"></div>
                    <div class="bg"><img src="/assets/images/vietnam_clints_05.png"></div>
                </div>
                <div class="item">
                    <div class="logo"><img src="/assets/images/vietnam_clints_17.png"></div>
                    <div class="bg"><img src="/assets/images/vietnam_clints_06.png"></div>
                </div>
                <div class="item">
                    <div class="logo"><img src="/assets/images/vietnam_clints_18.png"></div>
                    <div class="bg"><img src="/assets/images/vietnam_clints_07.png"></div>
                </div>
                <div class="item">
                    <div class="logo"><img src="/assets/images/vietnam_clints_19.png"></div>
                    <div class="bg"><img src="/assets/images/vietnam_clints_09.png"></div>
                </div>
                <div class="item">
                    <div class="logo"><img src="/assets/images/vietnam_clints_20.png"></div>
                    <div class="bg"><img src="/assets/images/vietnam_clints_10.png"></div>
                </div>
                <div class="item">
                    <div class="logo"><img src="/assets/images/vietnam_clints_21.png"></div>
                    <div class="bg"><img src="/assets/images/vietnam_clints_11.png"></div>
                </div>
                <div class="item">
                    <div class="logo"><img src="/assets/images/vietnam_clints_22.png"></div>
                    <div class="bg"><img src="/assets/images/vietnam_clints_12.png"></div>
                </div>
                <div class="item">
                    <div class="logo"><img src="/assets/images/vietnam_clints_23.png"></div>
                    <div class="bg"><img src="/assets/images/vietnam_clints_13.png"></div>
                </div>
            </div>
        </div>
    
        <div class="item-15 container">
            <div class="hd">베스트 리뷰러들만 모았다! <br>고객 인터뷰</div>
            <div class="bd">
                <div class="bottom_con loop_banner">
                    <ul>
                        <?php foreach($customer_list['articles_list'] as $customer):?>
                        <li class="item">
                            <div class="avatar">
                                <a href="/ko/article/<?= $customer['category_id'] ?>/review"><img src="<?= base_url($customer['thumbnail']??'assets/lib/haocms/frontend/images/default_images.png')?>"></a>
                            </div>
                            <div class="title"><?php echo $customer['default_subject']?></div>
                            <div class="name"><?php echo $customer['default_title']?></div>
                            <div class="description">
                                <?php echo $customer['default_description']?>
                            </div>
                        </li>
                        <?php endforeach;?>
                    </ul>
                    
                    <ul>
                        <?php foreach($customer_list['articles_list'] as $customer):?>
                        <li class="item">
                            <div class="avatar">
                                <a href="/ko/article/<?= $customer['category_id'] ?>/review"><img src="<?= base_url($customer['thumbnail']??'assets/lib/haocms/frontend/images/default_images.png')?>"></a>
                            </div>
                            <div class="title"><?php echo $customer['default_subject']?></div>
                            <div class="name"><?php echo $customer['default_title']?></div>
                            <div class="description">
                                <?php echo $customer['default_description']?>
                            </div>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
        </div>
    
        
        <div class="main-item10">
            <div class="container">
                <div class="brands">
                    <div class="title">REDTRANS PARTNER<br>레드트랜스와 함께한 고객사</div>
                    <div class="brand-group">
                        <div class="owl-carousel owl-theme owl-loaded">
                            <div class="owl-stage-outer">
                                <div class="owl-stage">
                                    <div class="owl-item">
                                        <img src="/assets/images/redtrans_main_138.png">
                                    </div>
                                    <div class="owl-item">
                                        <img src="/assets/images/redtrans_main_140.png">
                                    </div>
                                    <div class="owl-item">
                                        <img src="/assets/images/redtrans_main_142.png">
                                    </div>
                                    <div class="owl-item">
                                        <img src="/assets/images/redtrans_main_144.png">
                                    </div>
                                    <div class="owl-item">
                                        <img src="/assets/images/redtrans_main_138.png">
                                    </div>
                                    <div class="owl-item">
                                        <img src="/assets/images/redtrans_main_140.png">
                                    </div>
                                    <div class="owl-item">
                                        <img src="/assets/images/redtrans_main_142.png">
                                    </div>
                                    <div class="owl-item">
                                        <img src="/assets/images/redtrans_main_144.png">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pdf">
                    <div class="btn"><a ><img src="/assets/images/m/btn_03.png"></a></div>
                    <div class="btn"><a ><img src="/assets/images/m/btn_06.png"></a></div>
                    <img src="/assets/images/redtrans_main_130.png" style="width: 400px;">
                </div>
            </div>
        </div>
<?= $this->endSection() ?>	
<?= $this->section('js') ?>
<script>
	$(document).ready(function () {
        var swiper = new Swiper('.main-item3 .swiper', {
            slidesPerView: 'auto',
            spaceBetween: 30,
            loop: false,
            freeMode: true,
            freeModeMomentum: false,
            freeModeSticky: true,
        });

    });
</script>
<?= $this->endSection() ?>	
				
