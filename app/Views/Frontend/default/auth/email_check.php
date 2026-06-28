<div class="login">
    <div class="login-area">
        <?php if (session('error')) : ?>
            <div class="alert alert-danger"><?= session('error') ?></div>
        <?php endif ?>
        <p><?= lang('Auth.emailActivateBody') ?></p>
        <form action="<?= url_to('auth-action-verify') ?>" method="post" id="form-login">
            <?= csrf_field() ?>
            <!-- Code -->
            <div class="item">
                <input type="text" class="form-control" id="floatingTokenInput" name="token" placeholder="000000" inputmode="numeric"
                    pattern="[0-9]*" autocomplete="one-time-code" value="<?= old('token') ?>" required>
            </div>
            <div class="item">
                <button type="submit" class="btn"><?= lang('Auth.send') ?></button>
            </div>
        </form>
    </div>                 
</div>