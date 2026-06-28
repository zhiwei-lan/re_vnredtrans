<?php
    $site = service('site')->getSiteInfo();
?>
<footer>
		<div class="hd">
			<div class="container row-flex">
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
			<div class="container">
				<div class="row-flex">
					<div class="logo">
						<a href="/"><img src="/assets/images/vn_logo.png" style="width: 172px;height:40px;"></a>
						<div class="family-site">
							<div class="button">FAMILY SITE<i></i></div>
							<ul>
								<li><a href="https://www.winchina.co.kr" target="_blank">윈차이나</a></li>
							</ul>
						</div>
					</div>
					<div class="info row-flex">
						<div class="company">
							<h4>COMPANY</h4>
							<p>상호  <?php echo $site->company_name?>     대표이사  <?php echo $site->company_ceo?></p>
							<p>사업자등록번호  <?php echo $site->company_number?>  통신판매업신고번호  <?php echo $site->company_sales_number?>     </p>
							<p><?php echo $site->company_address?></p>
							<p><?php echo $site->company_address1?></p>
							<p><?php echo $site->company_address2?></p>
							<p><?php echo $site->company_address3?></p>
							<p>E-mail  <?php echo $site->company_base_email?></p>
						</div>
						<div class="contact row-flex">
							<div class="item">
								<div class="label">서울본사</div>
								<div class="num"><?php echo $site->company_phone?></div>
								<div class="email"><?php echo $site->company_email?></div>
							</div>
							<div class="item">
								<div class="label">대구지사</div>
								<div class="num"><?php echo $site->company_phone1?></div>
								<div class="email"><?php echo $site->company_email1?></div>
							</div>
							<div class="item">
								<div class="label">중국 법인</div>
								<div class="num"><?php echo $site->company_phone2?></div>
								<div class="email"><?php echo $site->company_email2?></div>
							</div>
							<div class="item">
								<div class="label">베트남 법인</div>
								<div class="num"><?php echo $site->company_phone3?></div>
								<div class="email"><?php echo $site->company_email3?></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
