<!DOCTYPE html>
<html lang="<?= config('App')->defaultLocale ?>">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= config('Haoadmin')->appName ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/assets/lib/bootstrap-4.6.2-dist/css/bootstrap.min.css" >
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/assets/lib/fontawesome-free-5.15.4-web/css/all.min.css">
    <!-- Sweetalert -->
    <link rel="stylesheet" href="/assets/lib/sweetalert2@9.7.2/dist/sweetalert2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/lib/admin-lte@3.0.4/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/assets/lib/haocms/backend/style.css">
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <?= $this->renderSection('content') ?>
    </div>
    <!-- /.login-box -->
  </body>
  <!-- Sweeat alert -->
  <script src="/assets/lib/sweetalert2@9.7.2/dist/sweetalert2.all.min.js"></script>
  <script>
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });

  <?php if (session('sweet-success')) { ?>
    Toast.fire({
      icon: 'success',
      title: '<?= session('sweet-success.') ?>'
    });
  <?php } ?>
  <?php if (session('sweet-warning')) { ?>
    Toast.fire({
      icon: 'warning',
      title: '<?= session('sweet-warning.') ?>'
    });
  <?php } ?>
  <?php if (session('sweet-error')) { ?>
    Toast.fire({
      icon: 'error',
      title: '<?= session('sweet-error.') ?>'
    });
  <?php } ?>
  </script>
</html>
