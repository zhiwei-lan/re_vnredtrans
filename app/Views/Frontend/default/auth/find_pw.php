<div class="login">
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
        <form action="<?= url_to('magic-link') ?>" method="post" id="form-login">
            <?= csrf_field() ?>

            <!-- Email -->
            <div class="item">
                <input type="email" class="form-control" id="floatingEmailInput" name="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>"
                    value="<?= old('email', auth()->user()->email ?? null) ?>" required>
            </div>

            <div class="item">
                <button type="submit" class="btn"><?= lang('Auth.send') ?></button>
            </div>

        </form>
        <p class="text-center help"><a href="<?= url_to('login') ?>"><?= lang('Auth.backToLogin') ?></a></p>
    </div>                 
</div>