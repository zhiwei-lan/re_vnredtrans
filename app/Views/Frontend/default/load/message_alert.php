<!-- Sweeat alert -->
  <script src="/assets/lib/sweetalert2@9.7.2/dist/sweetalert2.all.min.js"></script>
  <script>
  const Toast = Swal.mixin({
    toast: true,
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