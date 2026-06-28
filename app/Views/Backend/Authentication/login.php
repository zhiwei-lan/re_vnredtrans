<?= $this->extend('Backend/Authentication/index') ?>
<?= $this->section('content') ?>
<!-- /.login-logo -->
<div class="login">
      
      
    
    <div class="login-area">
    <h2>Sign In</h2>
    <?php if (session('error') !== null) : ?>
        <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
    <?php elseif (session('errors') !== null) : ?>
        <div class="alert alert-danger" role="alert">
            <?php if (is_array(session('errors'))) : ?>
                <?php foreach (session('errors') as $error) : ?>
                    <?= $error ?>
                    <br>
                <?php endforeach ?>
            <?php else : ?>
                <?= session('errors') ?>
            <?php endif ?>
        </div>
    <?php endif ?>
    <?php if (session('message') !== null) : ?>
    <div class="alert alert-success" role="alert"><?= session('message') ?></div>
    <?php endif ?>
        <form action="/haoadmin/login" method="post" id="form-login">
            <?= csrf_field() ?>
            <!-- Email -->
            <div class="item">
                <input type="email" class="form-control" id="floatingEmailInput" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" required>
            </div>
            <!-- Password -->
            <div class="item">
                <input type="password" class="form-control" id="floatingPasswordInput" name="password" inputmode="text" autocomplete="current-password" placeholder="<?= lang('Auth.password') ?>" required>
            </div>
            <!-- Remember me -->
            <?php if (setting('Auth.sessionConfig')['allowRemembering']): ?>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')): ?> checked<?php endif ?>>
                            <?= lang('Auth.rememberMe') ?>
                    </label>
                </div>
            <?php endif; ?>
            <div class="item text-center">
                <button type="submit" class="btn btn-default"><?= lang('Auth.login') ?></button>
            </div>
        </form>
        
    </div>                 
</div>
<?= $this->endSection() ?>
