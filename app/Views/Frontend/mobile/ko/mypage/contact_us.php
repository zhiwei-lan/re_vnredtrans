<?= $this->extend('Frontend/default/layout/index_m') ?>
<?= $this->section('content') ?>
<div class="subpage mypage">
            <div class="container">
                <div class="cont">
                    <div class="hd">
                        <div class="page-name">MY PAGE</div>
                    </div>
                    <div class="page-menu">
                        <div class="user-info">
                            <div class="avatar">
                                <img src="/assets/images/avatar.png">
                            </div>
                            <div class="bass-info">
                                <div class="hd">
                                    <div class="name"><?php echo $singleUser['username']?></div>
                                    <div class="btn"><a href="/ko/login/logout">로그아웃</a></div>
                                </div>
                                <div class="email"><?php echo $singleUser['phone']?></div>
                            </div>
                        </div>
                        <div class="menu">
                            <a class="item" href="/ko/mypage/services">
                                <div class="name">내 서비스</div>
                                <i></i>
                            </a>
                            <a class="item" href="/ko/mypage/userinfo">
                                <div class="name">계정 정보</div>
                                <i></i>
                            </a>
                            <a class="item active" href="/ko/contact/contact_us">
                                <div class="name">문의하기</div>
                                <i></i>
                            </a>
                        </div>
                    </div>
                    <div class="contact">
                        <div class="hd">문의하기</div>
                        <?= view('Frontend/default/load/form', [
                            'form_data' => $form['fields']??'',
                            'form_code' => $form_code
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
<?= $this->endSection() ?>