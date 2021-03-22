<?php
$jenis_kelamin["L"] = "Laki - Laki";
$jenis_kelamin["P"] = "Perempuan";

$perkawinan["lajang"] = "Lajang";
$perkawinan["kawin"] = "Kawin";
$perkawinan["duda"] = "Duda";
$perkawinan["janda"] = "Janda";
 $nama = $data->nama;
        $datas = explode(" ",$nama);
?>
<a class="btn btn-primary" onclick="back()">Back</a>
              <div class="card ">

                <div class="card-header card-header-rose card-header-text">
                  <div class="card-text">
                    <h4 class="card-title">Daftar Anggota PPI</h4>
                  </div>
                </div>
                <div class="card-body ">
    <form method="POST" action="" onsubmit="Approval(); return false" class="form" enctype="multipart/form-data">
                      
               <div class="row">
                      <label class="col-sm-2 col-form-label">NIK KTP</label>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <input type="number"  readonly  class="form-control" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==16) return false;" name="nomor_nik" value="<?php echo $data->nomor_ktp?>" id="nomor_nik"  maxlength="16" required autofocus class="form-control">
                           
                          <span class="bmd-help"></span>
                        </div>
                      </div>
                    </div>
             
                         <input type="hidden" class="form-control" value="<?php echo $data->nomor_anggota?>" name="nomor_anggota" id="nomor_anggota" readonly="" />
                       

                 <div class="row">
                      <label class="col-sm-2 col-form-label">Nama Depan</label>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <input  type="text" class="form-control" name="nma_dpn" value="<?php echo $datas[0]?>" id="nma_dpn" readonly  required autofocus>
                           
                          <span class="bmd-help"></span>
                        </div>
                      </div>
                
                        <?php if($data->nma_blkng != ""){?>
                      <label class="col-sm-2 col-form-label">Nama Belakang</label>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <input  type="text" class="form-control" name="nma_blkng" id="nma_blkng" value="<?php echo $datas[1]?>" autofocus>
                            
                          <span class="bmd-help"></span>
                        </div>
                      </div>
                    <?php }?>
                        <label class="col-sm-2 col-form-label">Nama Belakang</label>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <input  type="text" class="form-control" name="nma_blkng" id="nma_blkng" value=""    autofocus>
                            
                          <span class="bmd-help"></span>
                        </div>
                      </div>
                      
                    </div>
                     <div class="row">
                      <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <input  type="text" class="form-control" value="<?php echo $data->tempat_lahir?>" name="tempat_lahir" readonly id="tempat_lahir" required autofocus>
                           
                          <span class="bmd-help"></span>
                        </div>
                      </div>
                   
                      <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                      <div class="col-sm-4">
                        <div class="form-group">
                        <input id="tanggal_lahir" type="date" value="<?php echo $data->tanggal_lahir?>"  min="1960-01-01" max="2001-12-31"class="form-control" readonly name="tanggal_lahir" id="tanggal_lahir"  required autofocus>
                        
                        <span class="bmd-help"></span>
                        </div>
                      </div>
                    </div>
                  
                       <div class="row">
                      <label class="col-sm-2 col-form-label">Provinsi</label>
                      <div class="col-sm-4">
                         <div class="form-group">
                           <input type="text" readonly class="form-control" value="<?php echo $data->provinsi?>"  name="provinsi">
                        </div>
                        </div>
                    
                     <label class="col-sm-2 col-form-label">Kota.Kabupaten</label>
                      <div class="col-sm-4">
                        <div class="form-group">

                            <input type="text" readonly class="form-control" value="<?php echo $data->kabupaten?>"  name="kabupaten">
                             </div>
                        </div>
                    </div>
                    <div class="row">
                    <label class="col-sm-2 col-form-label">Kecamatan</label>
                      <div class="col-sm-4">
                        <div class="form-group">
                            <input type="text" readonly class="form-control" value="<?php echo $data->kecamatan?>"  name="kecamatan">                             </div>
                        </div>
                    <label class="col-sm-2 col-form-label">Kelurahan</label>
                      <div class="col-sm-4">
                        <div class="form-group">

                             <input type="text" readonly class="form-control" value="<?php echo $data->kelurahan?>"  name="kelurahan">
                             </div>
                        </div>
                    </div>
                     <div class="row">
                      <label class="col-sm-2 col-form-label">Alamat</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input name="alamat" readonly id="alamat" value="<?php echo $data->alamat?>" type="text" class="form-control" required autofocus>
                            
                          <span class="bmd-help"></span>
                        </div>
                      </div>
                        
                    </div>
                      <div class="row">
                        <label class="col-sm-2 col-form-label">RT</label>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <input name="rt" readonly id="rt" value="<?php echo $data->rt?>" type="text" class="form-control" required autofocus>
                              
                            <span class="bmd-help"></span>
                          </div>
                        </div>
                     
                        <label class="col-sm-2 col-form-label">RW</label>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <input name="rw" readonly id="rw" value="<?php echo $data->rw?>" type="text" class="form-control" required autofocus>
                              
                            <span class="bmd-help"></span>
                          </div>
                        </div>
                      </div>
                    <div class="row">
                      <label class="col-sm-2 col-form-label label-checkbox">Status</label>
                        <div class="col-sm-4">
                            <div class="form-group">
                               <input type="text" readonly class="form-control" value="<?php echo $data->status_perkawinan?>"  name="status_perkawinan">

                        </div>
                    </div>
                     <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                     <div class="col-sm-4">
                         <div class="form-group">
                          <input type="text" readonly class="form-control" value="<?php echo $data->jenis_kelamin?>"  name="jenis_kelamin">
                        </div>
                    </div>
                </div>
              
                    <div class="row">
                      <label class="col-sm-2 col-form-label">Telepon      +62</label>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <input type="number"  maxlength="15" value="<?php echo $data->nomor_telpn?>" class="form-control" name="nomor_telpn" id="nomor_telpn" readonly  required autofocus>
                          <span class="bmd-help"></span>
                        </div>
                      </div>
                      <label class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <input id="email" readonly type="email" class="form-control" value="<?php echo $data->email?>" name="email" id="email" required>
                          <span class="bmd-help"></span>
                        </div>
                      </div>
                    </div>
                   <div class="row"> 
                  <label class="col-sm-2 col-form-label">Foto KTP</label>
                  <div class="col-sm-10">
                  <div class="form-group">
                    <div class="col-md-8 col-sm-2">
                    <?php if($data->foto_ktp !="/foto/" and $data->foto_ktp !=""){ ?>
                                <img src="<?php echo base_url().$data->foto_ktp; ?>" id="input-ktp" name="foto_ktp" height="200">
                            <?php }else{?>
                                <img src="<?php echo base_url()."foto/user.png"; ?>" height="200">
                            <?php } ?>

                  </div> 
                  </div>
                                       <input type="hidden" value="<?php echo $data->foto_ktp?>" id="ktp-file" name="ktp_file">

                </div>
              </div>
              <div class="card-footer ">
                 
                </div>   
                      </div>
                    </div>
                  </form>
                </div>
     
   <script>


function back(){
    processStart();
    $.ajax({
        method: "POST",
        url: "<?php echo site_url()?>/anggota/list_data"
    }).done(function (msg) {
        processDone();
        $("#page-content").html(msg)
    });
}
function Approval(){
    processStart();
    $.ajax({
        method: "POST",
        data:{
            id:'<?php echo $data->id?>',
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
            email : $("#email").val(),
            previx: $("#provinsi").val()+"."+$("#kabupaten").val()+"."+$("#kecamatan").val()+"."+$("#kelurahan").val()
        },
        url: "<?php echo site_url()?>/anggota/approval"
    }).done(function (msg) {     
        processDone();
        if(msg==""){
            goMenu('Daftar Anggota','anggota/list_data')
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
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#imgPreview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
function changeProvinsi(kab = null){

    if(kab == null){
        kab = k_kab
    }

    $.ajax({
        method: "POST",
        data:{
            geo_prov_id: $("#provinsi").val(),
            kab_selected : kab
        },
        url: "<?php echo site_url()?>/anggota/get_kabupaten"
    }).done(function (msg) {
        $("#kabupaten").html(msg);
        if(kab != null){
            setTimeout(function(){
                $("#kabupaten").val(kab).trigger("change");
            }, 500)
        }
    });
}
function changeKabupaten(kec = null){

    if(kec == null){
        kec = k_kec;
    }

    $.ajax({
        method: "POST",
        data:{
            geo_kab_id: $("#kabupaten").val(),
        },
        url: "<?php echo site_url()?>/anggota/get_kecamatan"
    }).done(function (msg) {
        $("#kecamatan").html(msg);
        if(kec != null){
            setTimeout(function(){
                $("#kecamatan").val(kec).trigger('change')
            }, 500)
        }
    });
}
function changeKecamatan(kel = null){

    if(kel == null){
        kel = k_kel
    }

    $.ajax({
        method: "POST",
        data:{
            geo_kec_id: $("#kecamatan").val()
        },
        url: "<?php echo site_url()?>/anggota/get_kelurahan"
    }).done(function (msg) {
        $("#kelurahan").html(msg);
        if(kel != null){
            setTimeout(function(){
                $("#kelurahan").val(kel).trigger('change')
            }, 500)
        }
    });
}
function uploadKtp(){

    var input = document.getElementById("input-ktp");

    if(input.files[0] !== undefined){

        var fd = new FormData();

        fd.append("file", input.files[0]);

        $.ajax({
            type : "POST",
            url : "<?php echo base_url() ?>anggota/save_ktp_add",
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
</script>
