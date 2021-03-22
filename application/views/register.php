  <!DOCTYPE html>
  <htmlng="en">
  <head>
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
  <style type="text/css">
    

    body{

        background-image: url("<?php echo base_url()?>assets/img/bg.png");

    }
  </style>
  </head>
  <body>
  <div class="col-md-8 ml-auto mr-auto
  " >
                <div class="card ">
                  <div class="card-header card-header-rose card-header-text">
                    <div class="card-text">
                      <h4 class="card-title">Daftar Anggota PPI</h4>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                    <div class="col-md-1 ml-auto mr-auto">
                      <img class="" src="<?php echo base_url()?>assets/img/PPI.png" width="100">
                        </div>
                      </div>
                      <br>
      <form method="POST" id="cform" action="" onsubmit="save(); return false" class="form" enctype="multipart/form-data">
                        
                      <div class="row">
                        <label class="col-sm-2 col-form-label">NIK KTP</label>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <input type="number"   class="form-control" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==16) return false;" name="nomor_nik" id="nomor_nik"  maxlength="16" required autofocus class="form-control">
                             
                            <span class="bmd-help"></span>
                          </div>
                        </div>
                      </div>
                 
                           <input type="hidden" class="form-control" name="nomor_anggota" id="nomor_anggota" readonly="" />
                             

                   <div class="row">
                        <label class="col-sm-2 col-form-label">Nama Depan</label>
                        <div class="col-sm-10">
                          <div class="form-group">
                            <input  type="text" class="form-control" name="nma_dpn" id="nma_dpn"   required autofocus>
                             
                            <span class="bmd-help"></span>
                          </div>
                        </div>
                      </div>
                       <div class="row">
                        <label class="col-sm-2 col-form-label">Nama Belakang</label>
                        <div class="col-sm-10">
                          <div class="form-group">
                            <input  type="text" class="form-control" name="nma_blkng" id="nma_blkng"    autofocus>
                              
                            <span class="bmd-help"></span>
                          </div>
                        </div>
                      </div>
                       <div class="row">
                        <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                        <div class="col-sm-10">
                          <div class="form-group">
                            <input  type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" required autofocus>
                             
                            <span class="bmd-help"></span>
                          </div>
                        </div>
                      </div>
                        <div class="row">
                        <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-6">
                          <div class="form-group">
                          <input id="tanggal_lahir" type="date"  min="1960-01-01" max="2001-12-31"class="form-control" name="tanggal_lahir" id="tanggal_lahir"  required autofocus>
                          
                          <span class="bmd-help"></span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                         <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                       <div class="col-sm-6">
                           <div class="form-group">
                              <select class="form-control select" data-style="btn btn-link" name="jenis_kelamin" id="jenis_kelamin">
                                  <option value="L">Laki - Laki</option>
                                  <option value="P">Perempuan</option>
                              </select>
                          </div>
                      </div>
                  </div>
                         <div class="row">
                        <label class="col-sm-2 col-form-label">Provinsi</label>
                        <div class="col-sm-10">
                           <div class="form-group">
                              <select class="form-control select" data-style="btn btn-link" name="provinsi" id="provinsi" onchange="changeProvinsi()">
                              <?php foreach($prov->result() as $tmp):?>
                              <option value="<?php echo $tmp->kode;?>"><?php echo $tmp->provinsi;?></option>
                              <?php endforeach?>
                              </select>
                          </div>
                          </div>
                      </div>
                       <div class="row">
                        <label class="col-sm-2 col-form-label">Kota.Kabupaten</label>
                        <div class="col-sm-10">
                          <div class="form-group">

                             <select class="form-control select" data-style="btn btn-link" name="kabupaten" id="kabupaten" onchange="changeKabupaten()">
                              </select>
                               </div>
                          </div>
                      </div>
                      <div class="row">
                        <label class="col-sm-2 col-form-label">Kecamatan</label>
                        <div class="col-sm-10">
                          <div class="form-group">
                              <select class="form-control select" data-style="btn btn-link" name="kecamatan" id="kecamatan" onchange="changeKecamatan()">
                              </select>
                               </div>
                          </div>
                      </div>
                      <div class="row">
                        <label class="col-sm-2 col-form-label">Kelurahan</label>
                        <div class="col-sm-10">
                          <div class="form-group">

                               <select class="form-control select" data-style="btn btn-link" name="kelurahan" id="kelurahan" >
                              </select>
                               </div>
                          </div>
                      </div>
                       <div class="row">
                        <label class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                          <div class="form-group">
                            <input name="alamat" id="alamat" type="text" class="form-control" required autofocus>
                              
                            <span class="bmd-help"></span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <label class="col-sm-2 col-form-label">RT</label>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <input name="rt" id="rt" type="text" class="form-control" required autofocus>
                              
                            <span class="bmd-help"></span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <label class="col-sm-2 col-form-label">RW</label>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <input name="rw" id="rw" type="text" class="form-control" required autofocus>
                              
                            <span class="bmd-help"></span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <label class="col-sm-2 col-form-label label-checkbox">Status</label>
                          <div class="col-sm-6">
                              <div class="form-group">
                              <select class="form-control select" data-style="btn btn-link" name="status_perkawinan" id="status_perkawinan">
                                   <option value="lajang">Lajang</option>
                                  <option value="kawin">kawin</option>
                                  <option value="duda">Duda</option>
                                  <option value="janda">Janda</option>
                                                              </select>
                          </div>
                      </div>
                  </div>
                      <div class="row">
                        <label class="col-sm-2 col-form-label">Telepon</label>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <input type="number"  maxlength="15" class="form-control" name="nomor_telpn" id="nomor_telpn"  required autofocus>
                            <span class="bmd-help"></span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <div class="form-group">
                            <input id="email" type="email" class="form-control" name="email" id="email" required>
                            <span class="bmd-help"></span>
                          </div>
                        </div>
                      </div>
                     <div class="row"> 
                    <label class="col-sm-2 col-form-label">Foto KTP</label>
                    <div class="col-sm-10">
                    <div class="form-group">
                      <div class="col-md-8 col-sm-2">
                      <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                  <div class="fileinput-new thumbnail img-raised">
                                      <img src="<?php echo base_url() ?>assets/img/image_placeholder.jpg" rel="nofollow" alt="Thumbnail" width="100%" height="180px">
                                  </div>
                                  <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                                  <div>
                                      <span class="btn btn-raised btn-round btn-default btn-file">
                                          <span class="fileinput-new">Pilih File</span>
                                          <span class="fileinput-exists">Ganti</span>
                                          <input type="file" id="input-ktp" name="foto_ktp" onchange="uploadKtp()" required="" />
                                      </span>
                                      <a href="javascript:;" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Hapus</a>
                                  </div>
                              </div>

                    </div> 
                    </div>
                       <input type="hidden" id="ktp-file" name="ktp_file">
                  </div>
                </div>
                <div class="card-footer ">
                    <a  href="{{ url()->previous() }}" type="submit" class="btn btn-danger">
                                      Kembali
                                  </a>
                    <button type="submit" class="btn btn-fill btn-rose">Save</button>
                  </div>   
                        </div>
                      </div>
                    </form>
                  </div>
                  </body>
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

         
       <script type="text/javascript">
     $(function(){
      $(".select").select2();
      $("#div-provinsi").hide();
      $("#div-kabupaten").hide();
      $("#foto").change(function() {
          readURL(this);
      });
  })
     function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e) {
              $('#imgPreview').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
      }
  }
     function save(e){
      processStart();
      var provinsi = $("#provinsi").val();
      var kabupaten = $("#kabupaten").val().replace($("#provinsi").val(),"");
      var kecamatan = $("#kecamatan").val().replace($("#kabupaten").val(),"");
      var kelurahan = $("#kelurahan").val().replace($("#kecamatan").val(),"");
      $.ajax({
          method: "POST",
          data:{
              nomor_ktp:$("#nomor_nik").val(),
              nomor_anggota : $("#nomor_anggota").val(),
              nma_dpn : $("#nma_dpn").val(),
              nma_blkng : $("#nma_blkng").val(),
              tempat_lahir:$("#tempat_lahir").val(),
              tanggal_lahir:$("#tanggal_lahir").val(),
              jenis_kelamin:$("#jenis_kelamin").val(),
              provinsi : $("#provinsi").val(),
              kabupaten : $("#kabupaten").val(),
              kecamatan : $("#kecamatan").val(),
              kelurahan : $("#kelurahan").val(),
              alamat:$("#alamat").val(),
              status_perkawinan:$("#status_perkawinan").val(),
              ktp_file_name : $("#ktp-file").val(),
              nomor_telpn : $("#nomor_telpn").val(),
              rt : $("#rt").val(),
              rw : $("#rw").val(),
              email : $("#email").val(),

              prefix: provinsi +"."+kabupaten+"."+kecamatan+"."+kelurahan
          },
          url: "<?php echo site_url()?>/register/save"
      }).done(function (msg) {
          processDone();
          if(msg==""){
              $.notify({
                              icon: "add_alert",
                              message: "success, <b>Berhasi Registrasi</b>"
                          }, {
                              type: 'success',
                              timer: 1000,
                              placement: {
                                  from: "top",
                                  align: "right"
                              }
                          });

  document.getElementById("cform").reset();
   jQuery('select[name="kabupaten"]').empty();
   jQuery('select[name="kecamatan"]').empty();
      jQuery('select[name="kelurahan"]').empty();
          }else{
              $.notify({
                  icon: "add_alert",
                  message: "Warning, <b>"+msg+"</b>"

              },{
                  type: 'danger',
                  timer: 4000,
                  placement: {
                      from: "top",
                      align: "right"
                  }
              });
          }
      });    
  }
  function changeProvinsi(){
      $.ajax({
          method: "POST",
          data:{
              geo_prov_id:$("#provinsi").val()
          },
          url: "<?php echo site_url()?>/register/get_kabupaten"
      }).done(function (msg) {
          $("#kabupaten").html(msg);

      });
       jQuery('select[name="kecamatan"]').empty();
      jQuery('select[name="kelurahan"]').empty();
  }
  function changeKabupaten(){
      $.ajax({
          method: "POST",
          data:{
              geo_kab_id:$("#kabupaten").val()
          },
          url: "<?php echo site_url()?>/register/get_kecamatan"
      }).done(function (msg) {
          $("#kecamatan").html(msg);
      });
      jQuery('select[name="kecamatan"]').empty();
      jQuery('select[name="kelurahan"]').empty();
  }
  function changeKecamatan(){
      $.ajax({
          method: "POST",
          data:{
              geo_kec_id:$("#kecamatan").val()
          },
          url: "<?php echo site_url()?>/register/get_kelurahan"
      }).done(function (msg) {
          $("#kelurahan").html(msg);
      });

      jQuery('select[name="kelurahan"]').empty();
  }
  function uploadKtp(){

      var input = document.getElementById("input-ktp");

      if(input.files[0] !== undefined){

          var fd = new FormData();

          fd.append("file", input.files[0]);

          $.ajax({
              type : "POST",
              url : "<?php echo base_url() ?>register/save_ktp_add",
              data : fd,
              enctype: "multipart/form-data",
              cache: false,
              contentType: false,
              processData: false,
              dataType : "json",
              success:function(resp){
                  if(resp.status == "success"){
                      $("#ktp-file").val(resp.data.fixed_file_name);
                  }else{
                      alert("Terjadi kesalahan saat mengupload file, Silahkan ulangi proses upload!");
                  }
              },
              error:function(e){
                  console.log(e);
              }
          })
      }

  }
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
