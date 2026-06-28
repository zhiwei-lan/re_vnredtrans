<?= $this->extend('Frontend/default/layout/index_m') ?>
<?= $this->section('page_title') ?>
<?= esc($active_menus['lang_title']??$active_menus['title']) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="subpage sub1">
        <div class="top-banner container">
            <div class="title">번역 비용</div>
        </div>

        <div class="item-5">
            <div class="hd">안내사항</div>
            <div class="bd">
                <div class="txt1">
                    가격 및 언어 안내 
                </div>
                <div class="txt2 text-left">
                    레드트랜스는 번역이 필요한 용도에 따라 품질을 <br>
                    최적화하여 합리적인 가격으로 서비스합니다.<br>
                    <span>번역 원문의 용도, 분야 및 분량, 언어의 특수성과 작업의 난이도, </span><br>
                    <span>납품 방식에 따라</span>  정해진 기준에서번역 단가를 책정합니다. 
                </div>
                <div class="img">
                    <img src="/assets/images/m/sub1_2_001.png">
                </div>
            </div>
        </div>


        <div class="item-1 container">
            <div class="hd">
                <div class="title">진행 절차</div>
            </div>
            <div class="press">
                <div class="item active">
                    <div class="dot"></div>
                    <div class="text">
                        <div class="num">01</div>
                        <div class="txt">사용 목적</div>
                    </div>
                </div>
                <div class="item">
                    <div class="dot"></div>
                    <div class="text">
                        <div class="num">02</div>
                        <div class="txt">대내용, 대외용</div>
                    </div>
                </div>
                <div class="item">
                    <div class="dot"></div>
                    <div class="text">
                        <div class="num">03</div>
                        <div class="txt">일반용, 비즈니스용</div>
                    </div>
                </div>
                <div class="item">
                    <div class="dot"></div>
                    <div class="text">
                        <div class="num">04</div>
                        <div class="txt">전문 분야, 특수 분야</div>
                    </div>
                </div>
                <div class="item">
                    <div class="dot"></div>
                    <div class="text">
                        <div class="num">05</div>
                        <div class="txt">의역 난이도</div>
                    </div>
                </div>
                <div class="item">
                    <div class="dot"></div>
                    <div class="text">
                        <div class="num">06</div>
                        <div class="txt">일반납품, 긴급납품</div>
                    </div>
                </div>
                <div class="item">
                    <div class="dot"></div>
                    <div class="text">
                        <div class="num">07</div>
                        <div class="txt">합리적 번역단가 책정</div>
                    </div>
                </div>
            </div>
            <div class="description">
                <h4>구비서류</h4>
                <p>
                    1. 6개월 이상 남은 여권 스캔본 (개인정보면)<br>
                    2. 여권용 사진 파일 (안경 착용, 악세서리 착용 금지)<br>
                    3. 입국 예정일/입국 공항명/출국 공항명
                </p>
            </div>
        </div>
        

        <div class="item-7">
            <div class="trans-list">
                <div class="hd">페이지별 단가</div>
                <div class="bd">
                    <table>
                        <thead>
                            <tr>
                                <td>언어</td>
                                <td>외국 ⇆ 한국</td>
                                <td>산출 기준</td>
                            </tr>
                        </thead>
                        <tbody class="space"></tbody>
                        <tbody>
                            <tr>
                                <td>영어</td>
                                <td>20,000원</td>
                                <td>1페이지(영한 200단어 /한영 500자)</td>
                            </tr>
                            <tr>
                                <td>영어</td>
                                <td>20,000원</td>
                                <td>1페이지(영한 200단어 /한영 500자)</td>
                            </tr>
                            <tr>
                                <td>중국어</td>
                                <td>20,000원</td>
                                <td>1페이지(한중 / 중한 500자 기준)</td>
                            </tr>
                            <tr>
                                <td>일본어</td>
                                <td>20,000원</td>
                                <td>1페이지(한일 / 일한 500자)</td>
                            </tr>
                            <tr>
                                <td>베트남어</td>
                                <td>30,000원</td>
                                <td>1페이지(한베 / 베한 200단어)</td>
                            </tr>
                            <tr>
                                <td>러시아어</td>
                                <td>30,000원</td>
                                <td>1페이지(한러 / 러한 200단어)</td>
                            </tr>
                            <tr>
                                <td>우즈벡어</td>
                                <td>35,000원</td>
                                <td>1페이지(한우즈벡 / 우즈벡한 200단어)</td>
                            </tr>
                            <tr>
                                <td>인니어</td>
                                <td>40,000원</td>
                                <td>1페이지(한인니 / 인니한 200단어)</td>
                            </tr>
                            <tr>
                                <td>말레이어</td>
                                <td>40,000원</td>
                                <td>1페이지(한말레이 / 말레이한 200단어)</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
                <div class="description">
                    ※ 기타 외국어-—>외국어 번역의 경우, 별도 문의 요망  <br>※ 부가세 별도
                </div>
            </div>
        </div>
        <div class="item-7">
            <div class="trans-list">
                <div class="hd">번역할증요율</div>
                <div class="bd">
                    <table>
                        <tbody>
                            <tr>
                                <td width="220">일반번역</td>
                                <td>기본 문서, 편지, PR문서 비상업 문서 등</td>
                            </tr>
                            <tr>
                                <td>비즈니스 번역(일반)</td>
                                <td>레포트, 이력서, 자기소개서, 논문(학사), <br>
                                    문과계통 일반논문, 계약서, 업무 메일</td>
                            </tr>
                            <tr>
                                <td>비즈니스 번역(전문)</td>
                                <td>회의록, 전문 메뉴얼, 기술 메뉴얼, <br>
                                    학술지, 전문분야 논문 등</td>
                            </tr>
                            <tr>
                                <td>특수 번역</td>
                                <td>수필, 시집, 법률, 의학, 이과계통 논문, 
                                    게임, 영상 등</td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <table>
                        <tbody>
                            <tr>
                                <td width="220">일반번역</td>
                                <td>100%</td>
                            </tr>
                            <tr>
                                <td>비즈니스 번역(일반)</td>
                                <td>130%</td>
                            </tr>
                            <tr>
                                <td>비즈니스 번역(전문)</td>
                                <td>150%</td>
                            </tr>
                            <tr>
                                <td>특수 번역</td>
                                <td>200%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

       
        
        <div class="item-4">
            <div class="order-price">
                <div class="bd">
                    <a href="/ko/pages/vn_translation1_1" class="submit">문의하기</a>
                </div>
            </div>
        </div>
        
    </div>

<?= $this->endSection() ?>	


					
				
