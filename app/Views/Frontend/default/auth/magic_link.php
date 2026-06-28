<div class="login">
    <div class="logo">
        <img src="/assets/images/logo-login.png">
    </div>     
    <div class="login-area">
        <!-- <h5 class="card-title mb-5"><?= lang('Auth.useMagicLink') ?></h5> -->

        <p><b><?= lang('Auth.checkYourEmail') ?></b></p>

        <p><?= lang('Auth.magicLinkDetails', [setting('Auth.magicLinkLifetime') / 60]) ?></p>

    </div>                 
</div>