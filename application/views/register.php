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
  <!-- Navbar -->
  <header class="navbar navbar-expand navbar-dark bg-primary flex-column flex-md-row bd-navbar">
    <!-- Navbar -->
    <div class="navbar-nav-scroll ml-md-auto ">
      <ul class="navbar-nav bd-navbar-nav flex-row">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url()?>login"> <i class="material-icons">account_circle</i> LOGIN </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url()?>dashboard"> <i class="material-icons">dashboard</i> DASHBOARD </a>
        </li>
        <li class="nav-item">
            &nbsp;
        </li>
      </ul>
    </div>
</header>
  <div class="wrapper wrapper-full-page">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-lg-8 ml-auto mr-auto">
            <h3 class="text-center"></h3>
            <div class="card">
              <div class="card-body">
                <form method="POST" action="<?php echo base_url()?>register/save" onsubmit="$('btn-submit').attr('disabled','true')" class="form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12" style="background:#EE9B21">
                            <h3 class="text-center"><b>PENDAFTARAN ADMINISTRASI <br/> CALON KEPALA DAERAH PADA PILKADA 2020</b></h3>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">MENCALONKAN SEBAGAI</label>
                                <select name="mencalonkan" class="form-control selectpicker" data-style="btn btn-link">
                                    <option value="">-- Pilih --</option>
                                    <option value="bupati">Calon Bupati</option>
                                    <option value="wakil_bupati">Calon Wakil Bupati</option>
                                    <option value="walikota">Calon Walikota</option>
                                    <option value="wakil_walikota">Calon Wakil Walikota</option>
                                    <option value="gubernur">Calon Gubernur</option>
                                    <option value="wakil_gubernur">Calon Wakil Gubernur</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">PROVINSI</label>
                                <select class="form-control selectpicker" onchange="pilihProv()" id="provinsi"  data-style="btn btn-link" name="provinsi" required>
                                    <option value="">-- Pilih --</option>
                                    <?php foreach($prov->result() as $tmp) :?>
                                    <option value="<?php echo $tmp->geo_prov_id?>"><?php echo $tmp->geo_prov_nama?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">KABUPATEN / KOTA</label>
                                <select class="form-control selectpicker" data-style="btn btn-link"  id="kabupaten"   name="kabupaten_kota">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 float-right">
                            <div class="form-group">
                                <img width="150" height="150" id="imgPreview" src="<?php echo base_url()?>assets/img/user.png"/>
                                <br/>
                                <input type="file" id="foto" name="foto" style="display:none"/>
                                <a class="btn btn-primay btn-round" onclick="$('#foto').click()">Upload</a>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">NAMA CALON</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">TEMPAT LAHIR</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="tempat_lahir" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">TANGGAL LAHIR</label>
                                <input type="text" class="form-control datepicker" id="exampleFormControlInput1" name="tanggal_lahir" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">NOMOR NIK</label>
                                <input type="number" class="form-control" id="exampleFormControlInput1" name="nomor_nik" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">NOMOR KTA</label>
                                <input type="number" class="form-control" id="exampleFormControlInput1" name="nomor_kta">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">JENIS KELAMIN</label>
                                <select name="jenis_kelamin" class="form-control selectpicker" data-style="btn btn-link" required>
                                    <option value="L">Laki - Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">AGAMA</label>
                                <select name="agama" class="form-control selectpicker" data-style="btn btn-link" required>
                                    <option value="islam">Islam</option>
                                    <option value="kristen">Kristen</option>
                                    <option value="katholik">Katholik</option>
                                    <option value="hindu">Hindu</option>
                                    <option value="budha">Budha</option>
                                    <option value="khonghucu">Khong Hu Cu</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">ALAMAT</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="alamat" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">NO TELPON</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="telp" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">EMAIL</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">FACEBOOK</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="sm_fb">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">TWITTER</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="sm_twitter">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">INSTAGRAM</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="sm_instagram">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">STATUS KAWIN</label>
                                <select name="status_perkawinan" class="form-control selectpicker" data-style="btn btn-link" required>
                                    <option value="kawin">Kawin</option>
                                    <option value="lajang">Belum Kawin</option>
                                    <option value="duda">Duda</option>
                                    <option value="janda">Janda</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">NAMA ISTRI/SUAMI</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="nama_istri">
                            </div>
                        </div>
                        <div class="col-md-12">
                        <div id="accordion" role="tablist">
                        <div class="card card-collapse">
                            <div class="card-header" role="tab" id="headingOne">
                            <h5 class="mb-0">
                                <a data-toggle="collapse" href="#collaps1" aria-expanded="false" aria-controls="collaps1">
                                RIWAYAT PENDIDIKAN
                                <i class="material-icons">keyboard_arrow_down</i>
                                </a>
                            </h5>
                            </div>
                            <div id="collaps1" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">ALAMAT</div>
                                    <div class="col-md-3">YEAR</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">1. SD</div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="SD_ALAMAT"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="SD_YEAR"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">2. SMP</div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="SMP_ALAMAT"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="SMP_YEAR"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">3. SMA</div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="SMA_ALAMAT"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="SMA_YEAR"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">4. SARJANA</div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="S1_ALAMAT"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="S1_YEAR"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">5. PASCA SARJANA</div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="S2_ALAMAT" /></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="S2_YEAR"/></div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="card card-collapse">
                            <div class="card-header" role="tab" id="headingTwo">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collaps2" aria-expanded="false" aria-controls="collaps2">
                                KURSUS / DIKLAT
                                <i class="material-icons">keyboard_arrow_down</i>
                                </a>
                            </h5>
                            </div>
                            <div id="collaps2" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">JENIS PELATIHAN</div>
                                    <div class="col-md-6">INSTANSI</div>
                                    <div class="col-md-3">TAHUN</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="jp_jenis_pelatihan1"/></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="jp_instansi1"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="jp_tahun1"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="jp_jenis_pelatihan2"/></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="jp_instansi2"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="jp_tahun2"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="jp_jenis_pelatihan3"/></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="jp_instansi3"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="jp_tahun3"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="jp_jenis_pelatihan4"/></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="jp_instansi4"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="jp_tahun4"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="jp_jenis_pelatihan5"/></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="jp_instansi5"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="jp_tahun5"/></div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="card card-collapse">
                            <div class="card-header" role="tab" id="headingThree">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collaps3" aria-expanded="false" aria-controls="collaps3">
                                RIWAYAT ORGANISASI
                                <i class="material-icons">keyboard_arrow_down</i>
                                </a>
                            </h5>
                            </div>
                            <div id="collaps3" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">NAMA ORGANISASI</div>
                                    <div class="col-md-6">ALAMAT</div>
                                    <div class="col-md-3">JABATAN</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="o_organisasi1"/></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="o_alamat1"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="o_jabatan1"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="o_organisasi2"/></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="o_alamat2"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="o_jabatan2"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="o_organisasi3"/></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="o_alamat3"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="o_jabatan3"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="o_organisasi4"/></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="o_alamat4"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="o_jabatan4"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="o_organisasi5"/></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="o_alamat5"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="o_jabatan5"/></div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="card card-collapse">
                            <div class="card-header" role="tab" id="headingThree">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collaps4" aria-expanded="false" aria-controls="collaps4">
                                RIWAYAT PEKERJAAN
                                <i class="material-icons">keyboard_arrow_down</i>
                                </a>
                            </h5>
                            </div>
                            <div id="collaps4" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">INSTANSI</div>
                                    <div class="col-md-6">ALAMAT</div>
                                    <div class="col-md-3">JABATAN</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="p_instansi1"/></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="p_alamat1"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="p_jabatan1"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="p_instansi2"/></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="p_alamat2"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="p_jabatan2"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="p_instansi3"/></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="p_alamat3"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="p_jabatan3"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="p_instansi4"/></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="p_alamat4"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="p_jabatan4"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="p_instansi5"/></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="p_alamat5"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="p_jabatan5"/></div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="card card-collapse">
                            <div class="card-header" role="tab" id="headingThree">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collaps5" aria-expanded="false" aria-controls="collaps5">
                                TANDA PENGHARGAAN
                                <i class="material-icons">keyboard_arrow_down</i>
                                </a>
                            </h5>
                            </div>
                            <div id="collaps5" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">PENGHARGAAN</div>
                                    <div class="col-md-6">INSTANSI</div>
                                    <div class="col-md-3">TAHUN</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="pe_penghargaan1"/></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="pe_instansi1"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="pe_tahun1"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="pe_penghargaan2"/></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="pe_instansi2"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="pe_tahun2"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="pe_penghargaan3"/></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="pe_instansi3"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="pe_tahun3"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="pe_penghargaan4"/></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="pe_instansi4"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="pe_tahun4"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="pe_penghargaan5"/></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="pe_instansi5"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="pe_tahun5"/></div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="card card-collapse">
                            <div class="card-header" role="tab" id="headingThree">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collaps6" aria-expanded="false" aria-controls="collaps6">
                                AKTVITAS SOSIAL KEMASYARAKATAN
                                <i class="material-icons">keyboard_arrow_down</i>
                                </a>
                            </h5>
                            </div>
                            <div id="collaps6" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">KEGIATAN</div>
                                    <div class="col-md-6">LOKASI</div>
                                    <div class="col-md-3">TAHUN</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="k_kegiatan1"/></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="k_lokasi1"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="k_tahun1"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="k_kegiatan2"/></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="k_lokasi2"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="k_tahun2"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="k_kegiatan3"/></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="k_lokasi3"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="k_tahun3"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="k_kegiatan4"/></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="k_lokasi4"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="k_tahun4"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="k_kegiatan5"/></div>
                                    <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="k_lokasi5"/></div>
                                    <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="k_tahun5"/></div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <input type="submit" class="btn btn-primary" value="DAFTAR"/>
                            </div>
                        </div>
                    </div>
                </form>
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
    $(document).ready(function() {
        $('.datepicker').datetimepicker({
            format: 'YYYY-MM-DD',
            viewMode: 'years',
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
        });
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }

        }

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
    $("#foto").change(function() {
        readURL(this);
    })
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
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imgPreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
  </script>
  <script>
    $(document).ready(function() {
      md.checkFullPageBackgroundImage();
    });
  </script>
</body>

</html>
