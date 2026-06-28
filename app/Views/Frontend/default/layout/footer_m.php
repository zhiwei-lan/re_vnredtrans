<?php
    $site = service('site')->getSiteInfo();
?>
<footer>
    <div class="hd">
        <div class="container">
            <div class="copyright">Copyright © 2025Redtrans. All rights reserved.</div>
            <div class="documents">
                <a href="/ko/pages/documents01">이용약관</a>
				<a href="/ko/pages/documents02">개인정보처리방침</a>
				<a href="/ko/pages/documents03">이메일무단수집거부</a>
				<a href="/ko/pages/documents04">민원위임동의</a>
            </div>
        </div>
    </div>
    <div class="bd">
        <div class="logo">
        	<a href="/"><img src="/assets/images/vn_logo.png" style="width: 172px;height:40px;"></a>
        </div>
        <div class="info">
            <div class="company">
                <h4>COMPANY</h4>
                <p>상호  <?php echo $site->company_name?>     대표이사  <?php echo $site->company_ceo?></p>
                <p>사업자등록번호  <?php echo $site->company_number?></p>
                <p>통신판매업신고번호  <?php echo $site->company_sales_number?></p>
                <p>서울본사  <?php echo $site->company_address?></p>
                <p>대구지사  <?php echo $site->company_address1?></p>
                <p>중국법인  <?php echo $site->company_address2?></p>
                <p>베트남법인  <?php echo $site->company_address3?></p>
                <p>E-mail  <?php echo $site->company_base_email?></p>
            </div>
        </div>
    </div>
</footer>