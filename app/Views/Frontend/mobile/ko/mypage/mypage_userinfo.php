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
                            <a class="item active" href="/ko/mypage/userinfo">
                                <div class="name">계정 정보</div>
                                <i></i>
                            </a>
                            <a class="item" href="/ko/contact/contact_us">
                                <div class="name">문의하기</div>
                                <i></i>
                            </a>
                        </div>
                    </div>
                    <div class="catename">계정 정보</div>
                <div class="user-info">
                    <div class="avatar">
                        <img src="/assets/images/avatar.png">
                    </div>
                    <div class="bass-info">
                        <div class="hd">
                            <div class="name"><?php echo $singleUser['nickname']?></div>
                            <div class="btn"><a href="/ko/login/logout">로그아웃</a></div>
                            <div class="btn"><a >탈퇴하기</a></div>
                        </div>
                        <div class="email"><?php echo $singleUser['phone']?></div>
                    </div>
                </div>
                <div class="detail-info">
                    <form id="user_info">
                        <input type="hidden" name="user_index" id="user_index" value="<?php echo $singleUser['id']?>">
                        <div class="info">
                            <div class="form-group">
                                <label>이름</label>
                                <input type="text" name="user_name" id="user_name" value="<?php echo $singleUser['nickname']?>">
                            </div>
                            <div class="form-group">
                                <label>연락처</label>
                                <input type="text" name="user_phone" id="user_phone" value="<?php echo $singleUser['phone']?>">
                            </div>
                        </div>
                        <div class="btn">
                            <button class="submit">저장하기</button>
                        </div>
                    </form>
                </div>
    
                </div>
    
            </div>
        </div>
<?= $this->endSection() ?>
