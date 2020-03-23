<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
    <!-- CSS Files -->
    <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
</head>
<body>
    <form id="form1" runat="server">
        <div>
        </div>
    </form>
    <script src="<?php echo base_url();?>assets/js/core/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/core/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/core/bootstrap-material-design.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Google Maps Plugin    -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Chartist JS -->
    <script src="<?php echo base_url();?>assets/js/plugins/chartist.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="<?php echo base_url();?>assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?php echo base_url();?>assets/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>
    <!-- Sharrre libray -->
    <script src="<?php echo base_url();?>assets/demo/jquery.sharrre.js"></script>
    <!--  Plugin for Sweet Alert -->
    <script src="<?php echo base_url();?>assets/js/plugins/sweetalert2.js"></script>
    <script>
        $(function () {
            Swal.fire(
              'Registrasi Berhasil',
              'Terimakasih data anda akan di verifikasi oleh TPC terkait',
              'success'
            ).then((result) => {
                if (result.value) {
                    location.href = "http://hanura2020.com/registrasi/";
                }
            })
        });
    </script>
</body>
</html>
