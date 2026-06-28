<!DOCTYPE html>
<html lang="<?= config('App')->defaultLocale ?>">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="<?= csrf_token() ?>" content="<?= csrf_hash() ?>">
  <title><?= $title ?? '' ?> | <?= config('Haoadmin')->appName ?></title>
  
  <link rel="stylesheet" href="/assets/lib/bootstrap-4.6.2-dist/css/bootstrap.min.css" >
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/assets/lib/fontawesome-free-5.15.4-web/css/all.min.css">
  <!-- Sweetalert -->
  <link rel="stylesheet" href="/assets/lib/sweetalert2@9.7.2/dist/sweetalert2.min.css">
  <!-- Render section Haoadmin css -->
  <?= $this->renderSection('css') ?>
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/lib/admin-lte@3.0.4/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link  rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap">
  <!-- Customer style -->
  <link rel="stylesheet" href="/assets/lib/haocms/backend/style.css">

</head>

<body class="layout-fixed layout-navbar-fixed sidebar-mini <?= config('Haoadmin')->theme['footer']['fixed'] ? 'layout-footer-fixed' : '' ?> <?= config('Haoadmin')->theme['body-sm'] ? 'text-sm' : '' ?>">
  <div class="wrapper">

    <!-- Navbar -->
    <?= $this->include('Backend/layout/header') ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?= $this->include('Backend/layout/mainsidebar') ?>     
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <?= $this->include('Backend/layout/contentheader') ?>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <?= $this->renderSection('content') ?>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <!-- <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div> -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        <strong><a href="/haoadmin">Haoadmin</a></strong>
      </div>
      <!-- Default to the left -->
      <strong>&copy; <?= date('Y') ?> <a href="<?= config('Haoadmin')->theme['footer']['vendorlink'] ?>"><?= config('Haoadmin')->theme['footer']['vendorname']?></a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="/assets/lib/jquery@3.4.1/dist/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="/assets/lib/bootstrap-4.6.2-dist/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="/assets/lib/admin-lte@3.0.4/dist/js/adminlte.min.js"></script>
  <!-- Preload Scriptt -->
  <script>
  $('.sidebar-toggle').on('click',function(event){event.preventDefault();if(Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))){sessionStorage.setItem('sidebar-toggle-collapsed','')}else{sessionStorage.setItem('sidebar-toggle-collapsed','1')}});(function(){if(Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))){var body=document.getElementsByTagName('body')[0];body.className=body.className+' sidebar-collapse'}})()
  </script>
  <!-- Render section Haoadmin js -->
  <?= $this->renderSection('js') ?>

<script>
$(function() {

    // -------------------------------
    // 1️⃣ CSRF token 全局配置
    // -------------------------------
    $.ajaxSetup({
        headers: {
            '<?= config('Security')->headerName ?>':
                $('meta[name="<?= csrf_token() ?>"]').attr('content')
        }
    });

    // 每次 AJAX 请求完成后，刷新 CSRF token（如果后端返回了新的）
    $(document).ajaxComplete(function(e, xhr) {
        const token = xhr.getResponseHeader('x-csrf-token');
        if (token) {
            // 更新 meta 标签和隐藏 input
            $('meta[name="<?= csrf_token() ?>"]').attr('content', token);
            $('input[name="<?= csrf_token() ?>"]').val(token);

            // 更新 ajaxSetup
            $.ajaxSetup({
                headers: {
                    '<?= config('Security')->headerName ?>': token
                }
            });
        }
    });

    // -------------------------------
    // 2️⃣ 全局统一错误拦截
    // -------------------------------
    $(document).ajaxError(function(e, xhr) {

        if (xhr.status === 401) { // 未登录
            let loginUrl = xhr.responseJSON?.login || '/haoadmin/login';
            window.location.href = loginUrl;
        }

        if (xhr.status === 403) { // 无权限
            let msg = xhr.responseJSON?.error || '没有操作权限';
        }

        // 其他状态码可扩展处理
    });

});
</script>
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
</body>

</html>
