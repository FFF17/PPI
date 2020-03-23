<!--
 =========================================================
 Material Dashboard PRO - v2.1.0
 =========================================================

 Product Page: https://www.creative-tim.com/product/material-dashboard-pro
 Copyright 2019 Creative Tim (https://www.creative-tim.com)

 Coded by Creative Tim

 =========================================================

 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url()?>/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?php echo base_url()?>/assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
  PENDAFTARAN ADMINISTRASI CALON KEPALA DAERAH PADA PILKADA 2020
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="<?php echo base_url()?>/assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?php echo base_url()?>/assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="off-canvas-sidebar" style="background:url('http://hanura2020.com/registrasi/wp-content/uploads/2019/11/IMG_0421.jpg') no-repeat fixed center;">
<header class="navbar navbar-expand navbar-dark bg-primary flex-column flex-md-row bd-navbar">
    <!-- Navbar -->
    <div class="navbar-nav-scroll ml-md-auto ">
      <ul class="navbar-nav bd-navbar-nav flex-row">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url()?>index.php/register"> <i class="material-icons">account_circle</i> REGISTER </a>
        </li>
        <li class="nav-item">
            &nbsp;
        </li>
      </ul>
    </div>
</header>
  <div class="wrapper wrapper-full-page">
        <div class="container">
            <div clas="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">            
                        <div class="card-body">
                            <div class="form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">PROVINSI</label>
                                            <select class="form-control selectpicker" onchange="pilihProv()" id="provinsi"  data-style="btn btn-link" name="provinsi" required>
                                                <option value="">ALL </option>
                                                <?php foreach($prov->result() as $tmp) :?> 
                                                <option value="<?php echo $tmp->geo_prov_id?>"><?php echo $tmp->geo_prov_nama?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">KABUPATEN / KOTA</label>
                                            <select class="form-control selectpicker" data-style="btn btn-link"  id="kabupaten"   name="kabupaten_kota">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="button" onclick="doSerach()" class="btn btn-primary float-left" value="search">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">            
                        <div class="card-body">
                            <table class="table">
                                <thead>                    
                                    <tr>
                                        <th>#</th>
                                        <th>Sebagai</th>
                                        <th>Provinsi</th>
                                        <th>Kabupaten kota</th>
                                        <th>Nama</th>
                                    </tr>
                                </thead>
                                <tbody id="data_calon">                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
  <!--   Core JS Files   -->
  <script src="<?php echo base_url()?>/assets/js/core/jquery.min.js"></script>
  <script src="<?php echo base_url()?>/assets/js/core/popper.min.js"></script>
  <script src="<?php echo base_url()?>/assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="<?php echo base_url()?>/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="<?php echo base_url()?>/assets/js/plugins/moment.min.js"></script>
  <script src="<?php echo base_url()?>/assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <script src="<?php echo base_url()?>/assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <script src="<?php echo base_url()?>/assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="<?php echo base_url()?>/assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?php echo base_url()?>/assets/js/material-dashboard.js?v=2.1.0" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="<?php echo base_url()?>/assets/js/plugins/bootstrap-selectpicker.js"></script>
  <script>
    $(function(){
        doSerach();
    });
    function pilihProv(){
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>index.php/register/kabupaten_pemilihan",
            data: { provinsi: $("#provinsi").val() }
        }).done(function (msg) {
            $("#kabupaten").html(msg);
            $("#kabupaten").selectpicker('refresh');
        });
    }
    function doSerach(){
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>index.php/dashboard/dataCalon",
            data: { 
                provinsi: $("#provinsi").val(),
                kabupaten: $("#kabupaten").val(),
            }
        }).done(function (msg) {
            $("#data_calon").html(msg)
        });
    }
  </script>
</body>

</html>