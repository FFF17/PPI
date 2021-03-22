<!doctype html>
<html lang="en">

<head>
    <title>PPI</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- Material Kit CSS -->
    <link href="<?php echo base_url() ?>assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="<?php echo base_url() ?>assets/js/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body>
    <div class="wrapper ">
        <div class="sidebar" data-color="azure" data-background-color="black" data-image="http://hanura2020.com/registrasi/wp-content/uploads/2019/11/IMG_0421.jpg">
            <div class="logo">
                <a class="simple-text logo-mini">
                    <img src="<?php echo base_url() ?>assets/img/PPI.png" width="30px" />
                </a>
                <a class="simple-text logo-normal">
                    PPI
                </a>
            </div>
            <div class="sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <img src="<?php echo base_url() ?>assets/img/user.png">
                    </div>
                    <!-- Informasi User -->
                    <div class="user-info">
                        <a class="username">
                            <span><b><?php echo $this->session->name; ?></b>
                            </span>
                        </a>
                    </div>
                    <!-- End informasi User -->
                </div>
                <ul class="nav">
                    <li class="nav-item" name="menu" id="dashboard" onclick="selectMenu(this.id)" style="<?php echo isset($menu["dashboard"])?"":"display:none";?>">
                        <a class="nav-link" href="#0">
                            <i class="material-icons text-primary">dashboard</i>
                            <p>DASHBOARD</p>
                        </a>
                    </li>
                    <li class="nav-item" name="menu" id="anggota" style="<?php echo isset($menu["anggota"])?"":"display:none";?>">
                        <a class="nav-link" data-toggle="collapse" href="#menuCalon" aria-expanded="false">
                            <i class="material-icons text-info">folder</i>
                            <p>Anggota<b class="caret"></b></p>
                        </a>
                        <div class="collapse" id="menuCalon">
                            <ul class="nav">
                                <li class="nav-item" name="menu" id="anggota_new" onclick="selectMenu(this.id);goMenu('Anggota Baru','anggota/baru')" style="<?php echo isset($menu["anggota_new"])?"":"display:none";?>">
                                    <a class="nav-link" href="#">
                                        <span class="sidebar-mini"><i class="material-icons text-success">account_circle</i> </span>
                                        <span class="sidebar-normal">BARU</span>
                                    </a>
                                </li>
                                <li class="nav-item" name="menu" id="anggota_list" onclick="selectMenu(this.id);goMenu('Daftar Anggota','anggota/list_data')" style="<?php echo isset($menu["anggota_list"])?"":"display:none";?>">
                                    <a class="nav-link" href="#">
                                        <span class="sidebar-mini"><i class="material-icons text-success">account_circle</i> </span>
                                        <span class="sidebar-normal">LIST</span>
                                    </a>
                                </li>
                                <li class="nav-item" name="menu" id="anggota_jabatan" onclick="selectMenu(this.id);goMenu('Jabatan','anggota/jabatan')" style="<?php echo isset($menu["anggota_jabatan"])?"":"display:none";?>">
                                    <a class="nav-link" href="#">
                                        <span class="sidebar-mini"><i class="material-icons text-success">account_circle</i> </span>
                                        <span class="sidebar-normal">SET JABATAN</span>
                                    </a>
                                </li>
                                <li class="nav-item" name="menu" id="anggota_berita" onclick="selectMenu(this.id);goMenu('Daftar Berita','berita')" style="<?php echo isset($menu["anggota_berita"])?"":"display:none";?>">
                                    <a class="nav-link" href="#">
                                        <span class="sidebar-mini"><i class="material-icons text-success">account_circle</i> </span>
                                        <span class="sidebar-normal">BERITA DAERAH</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>                    
                    <li class="nav-item" name="menu" style="<?php echo ($menu["kebenduman"])?"":"display:none";?> id="kebenduman">
                        <a class="nav-link" data-toggle="collapse" href="#menuKebenduman" aria-expanded="false">
                            <i class="material-icons text-info">folder</i>
                            <p>Kebenduman<b class="caret"></b></p>
                        </a>
                        <div class="collapse" id="menuKebenduman">
                            <ul class="nav">
                                <li class="nav-item" name="menu" style="<?php echo isset($menu["kebenduman_dashboard"])?"":"display:none";?>" id="kebenduman_dashboard" onclick="selectMenu(this.id);goMenu('Input Iuran','kebenduman/dashboard')">
                                    <a class="nav-link" href="#">
                                        <span class="sidebar-mini"><i class="material-icons text-success">dashboard</i> </span>
                                        <span class="sidebar-normal">Dashboard</span>
                                    </a>
                                </li>
                                <li class="nav-item" name="menu" style="<?php echo isset($menu["kebenduman_iuran"])?"":"display:none";?>" id="kebenduman_iuran" onclick="selectMenu(this.id);goMenu('Input Iuran','kebenduman/iuran')">
                                    <a class="nav-link" href="#">
                                        <span class="sidebar-mini"><i class="material-icons text-success">playlist_add</i> </span>
                                        <span class="sidebar-normal">Iuran Anggota</span>
                                    </a>
                                </li>
                                <li class="nav-item" name="menu" style="<?php echo isset($menu["kebenduman_konfirmasi"])?"":"display:none";?>" id="kebenduman_konfirmasi" onclick="selectMenu(this.id);goMenu('Rekonsiliasi','kebenduman/iuran_reconcile')">
                                    <a class="nav-link" href="#">
                                        <span class="sidebar-mini"><i class="material-icons text-success">playlist_add_check</i> </span>
                                        <span class="sidebar-normal">Rekonsiliasi</span>
                                    </a>
                                </li>
                                <li class="nav-item" name="menu" style="<?php echo isset($menu["kebenduman_kas"])?"":"display:none";?>" id="kebenduman_kas" onclick="selectMenu(this.id);goMenu('Kas Organisasi','kebenduman/cash_flow')">
                                    <a class="nav-link" href="#">
                                        <span class="sidebar-mini"><i class="material-icons text-success">list</i> </span>
                                        <span class="sidebar-normal">Kas Organisasi</span>
                                    </a>
                                </li>
                                <li class="nav-item" name="menu" style="<?php echo isset($menu["kebenduman_master"])?"":"display:none";?>" id="kebenduman_master" onclick="selectMenu(this.id);goMenu('Master Data','kebenduman/master')">
                                    <a class="nav-link" href="#">
                                        <span class="sidebar-mini"><i class="material-icons text-success">list</i> </span>
                                        <span class="sidebar-normal">Jumlah Iuran</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item" name="menu" id="master" style="<?php echo isset($menu["master"])?"":"display:none";?>">
                        <a class="nav-link" data-toggle="collapse" href="#menuMaster" aria-expanded="false">
                            <i class="material-icons text-info">folder</i>
                            <p>Master Data<b class="caret"></b></p>
                        </a>
                        <div class="collapse" id="menuMaster">
                            <ul class="nav">
                                <li class="nav-item" name="menu" id="master_kegiatan" onclick="selectMenu(this.id);goMenu('Kegiatan','event')" style="<?php echo isset($menu["master_kegiatan"])?"":"display:none";?>">
                                    <a class="nav-link" href="#">
                                        <span class="sidebar-mini"><i class="material-icons text-success">account_circle</i> </span>
                                        <span class="sidebar-normal">Kegiatan</span>
                                    </a>
                                </li>
                                <li class="nav-item" name="menu" id="master_jabatan" onclick="selectMenu(this.id);goMenu('Jabatan','jabatan')" style="<?php echo isset($menu["master_jabatan"])?"":"display:none";?>">
                                    <a class="nav-link" href="#">
                                        <span class="sidebar-mini"><i class="material-icons text-success">account_circle</i> </span>
                                        <span class="sidebar-normal">Jabatan</span>
                                    </a>
                                </li>
                                <li class="nav-item" name="menu" id="master_gedung" onclick="selectMenu(this.id);goMenu('Kantor','lokasi')" style="<?php echo isset($menu["master_gedung"])?"":"display:none";?>">
                                    <a class="nav-link" href="#">
                                        <span class="sidebar-mini"><i class="material-icons text-success">account_circle</i> </span>
                                        <span class="sidebar-normal">Kantor</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item" name="menu" id="logout" onclick="selectMenu(this.id);logout()">
                        <a class="nav-link" href="#0">
                            <i class="material-icons text-danger">power_settings_new</i>
                            <p>LOGOUT</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-minimize">
                            <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                                <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                            </button>
                        </div>
                        <a class="navbar-brand" id="page-title"></a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="material-icons">notifications</i> Notifications
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="content">
                <div class="container-fluid" id="page-content">
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="copyright float-right">
                        &copy;
                        2019 Multisolusi
                    </div>
                    <!-- your footer here -->
                </div>
            </footer>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
       <script src="<?php echo base_url() ?>assets/js/core/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>

<!-- Plugin for the Perfect Scrollbar -->
<script src="<?php echo base_url() ?>assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>

<!-- Plugin for the momentJs  -->
<script src="<?php echo base_url() ?>assets/js/plugins/moment.min.js"></script>

<!--  Plugin for Sweet Alert -->
<script src="<?php echo base_url() ?>assets/js/plugins/sweetalert2.js"></script>

<!-- Forms Validations Plugin -->
<script src="<?php echo base_url() ?>assets/js/plugins/jquery.validate.min.js"></script>

<!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="<?php echo base_url() ?>assets/js/plugins/jquery.bootstrap-wizard.js"></script>

<!--    Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="<?php echo base_url() ?>assets/js/plugins/bootstrap-selectpicker.js"></script>

<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="<?php echo base_url() ?>assets/js/plugins/bootstrap-datetimepicker.min.js"></script>

<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
<script src="<?php echo base_url() ?>assets/js/plugins/jquery.dataTables.min.js"></script>
<!-- <script src="<?php echo base_url() ?>assets/js/plugins/Buttons-1.5.4/js/dataTables.buttons.js"></script> -->

<!--    Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="<?php echo base_url() ?>assets/js/plugins/bootstrap-tagsinput.js"></script>

<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="<?php echo base_url() ?>assets/js/plugins/jasny-bootstrap.min.js"></script>

<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="<?php echo base_url() ?>assets/js/plugins/fullcalendar.min.js"></script>

<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="<?php echo base_url() ?>assets/js/plugins/jquery-jvectormap.js"></script>

<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="<?php echo base_url() ?>assets/js/plugins/nouislider.min.js"></script>

<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

<!-- Library for adding dinamically elements -->
<script src="<?php echo base_url() ?>assets/js/plugins/arrive.min.js"></script>

<!--  Google Maps Plugin    -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->

<!-- Chartist JS -->
<script src="<?php echo base_url() ?>assets/js/plugins/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url() ?>assets/js/plugins/bootstrap-notify.js"></script>

<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="<?php echo base_url() ?>assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/select2/dist/js/select2.full.min.js"></script>

<script>
    $(function() {
        <?php if ($this->session->page != "") : ?>
            selectMenu("<?php echo $this->session->page ?>");
            goMenu('<?php echo $this->session->page_header ?>', '<?php echo str_replace("[slash]", "/", $this->session->page) ?>');
        <?php
            $this->session->set_userdata("page", "");
        else : ?>
            // goMenu('Dashboard', 'dashboard/admin');
        <?php endif; ?>
        <?php if ($this->session->msg != "") : ?>Swal.fire({
            html: $this - > session - > msg,
            allowOutsideClick: true,
        });
    <?php endif ?>
    });

    function processStart() {
        Swal.fire({
            html: 'Loading . . .',
            allowOutsideClick: false,
            onBeforeOpen: function() {
                Swal.showLoading()
            }
        });
    }

    function processDone() {
        Swal.close();
    }

    function goMenu(title, url) {
        processStart();
        $("#page-title").html(title);
        $.ajax({
            method: "GET",
            url: "<?php echo site_url() ?>/" + url + "?sid=" + Math.random()
        }).done(function(data) {
            processDone();
            $("#page-content").html(data);
            window.scrollTo(0, 0);
        });

    }

    function logout() {
        processStart();
        $.ajax({
            method: "GET",
            url: "main/logout"
        }).done(function(data) {
            processDone();
            location.reload();
        });
    }

    function selectMenu(id) {
        var tmp = id.split('_');
        $('li[name=menu]').removeClass('active');
        $('#' + id).addClass('active');
        $('#' + tmp[0]).addClass('active');
    }

    function showError(msg) {
        $.notify({
            icon: "add_alert",
            message: "Warning, <b>" + msg + "</b>"
        }, {
            type: 'danger',
            timer: 4000,
            placement: {
                from: "top",
                align: "right"
            }
        });
    }

    function showMessage(msg) {
        $.notify({
            icon: "add_alert",
            message: "Info, <b>" + msg + "</b>"
        }, {
            type: 'info',
            timer: 4000,
            placement: {
                from: "top",
                align: "right"
            }
        });
    }
</script>

</html>