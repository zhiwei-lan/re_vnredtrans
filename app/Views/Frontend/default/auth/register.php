<div class="register">
    <div class="login-area">
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
        <form action="/register" method="post" id="form-login">
            <?= csrf_field() ?>

            <!-- Email -->

            <div class="item">
            <input type="email" class="form-control" id="floatingEmailInput" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
            </div>

            <!-- Username -->
            <div class="item">
                <input type="text" class="form-control" id="floatingUsernameInput" name="username" inputmode="text" autocomplete="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>" required>
            </div>

            <!-- Password -->
            <div class="item">
                <input type="password" class="form-control" id="floatingPasswordInput" name="password" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.password') ?>" required>
            </div>

            <!-- Password (Again) -->
            <div class="item">
                <input type="password" class="form-control" id="floatingPasswordConfirmInput" name="password_confirm" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.passwordConfirm') ?>" required>
            </div>
            <div class="item check">
                <input type="checkbox" name="agreements" required>
                <div class="documents">서비스 <a href="/stipulation">이용약관</a> 및 <a href="/privacy">개인정보처리방침</a>에 동의</div>
            </div>
            <div class="item text-center">
                <button type="submit" class="btn"><?= lang('Auth.register') ?></button>
            </div>

            <p class="text-center help"><?= lang('Auth.haveAccount') ?> <a href="/<?= service('lang')->getLocale()?>/login/email"><?= lang('Auth.login') ?></a></p>

        </form>
    </div>                 
</div>