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
    <form method="POST" action="" onsubmit="save(); return false" class="form" enctype="multipart/form-data">
                      
                             
                    <div class="row">
                      <label class="col-sm-2 col-form-label">NIK KTP</label>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <input type="number"   class="form-control" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==16) return false;" name="nomor_nik" value="<?php echo $data->nomor_ktp?>" id="nomor_nik"  maxlength="16" required autofocus class="form-control">
                           
                          <span class="bmd-help"></span>
                        </div>
                      </div>
                    </div>
             
                         <input type="hidden" class="form-control" value="<?php echo $data->nomor_anggota?>" name="nomor_anggota" id="nomor_anggota" readonly="" />
                       

                 <div class="row">
                      <label class="col-sm-2 col-form-label">Nama Depan</label>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <input  type="text" class="form-control" name="nma_dpn" value="<?php echo $datas[0]?>" id="nma_dpn"   required autofocus>
                           
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
                          <input  type="text" class="form-control" value="<?php echo $data->tempat_lahir?>" name="tempat_lahir" id="tempat_lahir" required autofocus>
                           
                          <span class="bmd-help"></span>
                        </div>
                      </div>
                   
                      <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                      <div class="col-sm-4">
                        <div class="form-group">
                        <input id="tanggal_lahir" type="date" value="<?php echo $data->tanggal_lahir?>"  min="1960-01-01" max="2001-12-31"class="form-control" name="tanggal_lahir" id="tanggal_lahir"  required autofocus>
                        
                        <span class="bmd-help"></span>
                        </div>
                      </div>
                    </div>
                  
                       <div class="row">
                      <label class="col-sm-2 col-form-label">Provinsi</label>
                      <div class="col-sm-4">
                         <div class="form-group">
                            <select required="" name="provinsi" id="provinsi" class="select form-control" onchange="changeProvinsi()">
                                <option value="">--SELECT--</option>
                                <?php
                                foreach($prov->result() as $prov){
                                    ?>
                                    <option value="<?php echo $prov->kode ?>" 
                                        <?php echo ($prov->provinsi == $data->provinsi)?"selected":"" ?>
                                        >
                                        <?php echo $prov->provinsi ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        </div>
                    
                     <label class="col-sm-2 col-form-label">Kota.Kabupaten</label>
                      <div class="col-sm-4">
                        <div class="form-group">

                           <select required="" class="form-control select" data-style="btn btn-link" name="kabupaten" id="kabupaten" onchange="changeKabupaten()">
                            </select>
                             </div>
                        </div>
                    </div>
                    <div class="row">
                    <label class="col-sm-2 col-form-label">Kecamatan</label>
                      <div class="col-sm-4">
                        <div class="form-group">
                            <select required class="form-control select" data-style="btn btn-link" name="kecamatan" id="kecamatan" onchange="changeKecamatan()">
                            </select>
                             </div>
                        </div>
                    <label class="col-sm-2 col-form-label">Kelurahan</label>
                      <div class="col-sm-4">
                        <div class="form-group">

                             <select required="" class="form-control select" data-style="btn btn-link" name="kelurahan" id="kelurahan" >
                            </select>
                             </div>
                        </div>
                    </div>
                     <div class="row">
                      <label class="col-sm-2 col-form-label">Alamat</label>
                      <div class="col-sm-10">
                        <div class="form-group">
                          <input name="alamat" id="alamat" value="<?php echo $data->alamat?>" type="text" class="form-control" required autofocus>
                            
                          <span class="bmd-help"></span>
                        </div>
                      </div>
                        
                    </div>
                      <div class="row">
                        <label class="col-sm-2 col-form-label">RT</label>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <input name="rt" id="rt" value="<?php echo $data->rt?>" type="text" class="form-control" required autofocus>
                              
                            <span class="bmd-help"></span>
                          </div>
                        </div>
                     
                        <label class="col-sm-2 col-form-label">RW</label>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <input name="rw" id="rw" value="<?php echo $data->rw?>" type="text" class="form-control" required autofocus>
                              
                            <span class="bmd-help"></span>
                          </div>
                        </div>
                      </div>
                    <div class="row">
                      <label class="col-sm-2 col-form-label label-checkbox">Status</label>
                        <div class="col-sm-4">
                            <div class="form-group">
                         <select name="status_perkawinan" id="status_perkawinan" class="select form-control">
                                <option value="">--SELECT--</option>
                                <option value="lajang" <?php echo ($data->status_perkawinan == "lajang")?"selected":""?>>Lajang</option>
                                <option value="kawin" <?php echo ($data->status_perkawinan == "kawin")?"selected":""?>>Kawin</option>
                                <option value="duda" <?php echo ($data->status_perkawinan == "duda")?"selected":""?>>Duda</option>
                                <option value="janda" <?php echo ($data->status_perkawinan == "janda")?"selected":""?>>Janda</option>
                            </select>
                        </div>
                    </div>
                     <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                     <div class="col-sm-4">
                         <div class="form-group">
                            <select class="form-control select" data-style="btn btn-link" name="jenis_kelamin" id="jenis_kelamin">
                               <option value="">--SELECT--</option>
                                <option value="L" <?php echo ($data->jenis_kelamin == "L")?"selected":""?>>Laki-Laki</option>
                                <option value="P" <?php echo ($data->jenis_kelamin == "P")?"selected":""?>>Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>
              
                    <div class="row">
                      <label class="col-sm-2 col-form-label">Telepon</label>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <input type="number"  maxlength="15" value="<?php echo $data->nomor_telpn?>" class="form-control" name="nomor_telpn" id="nomor_telpn"  required autofocus>
                          <span class="bmd-help"></span>
                        </div>
                      </div>
                      <label class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <input id="email" type="email" class="form-control" value="<?php echo $data->email?>" name="email" id="email" required>
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
                  <button type="submit" class="btn btn-fill btn-primary">Submit</button>
                </div>   
                      </div>
                    </div>
                  </form>
                </div>
     
   <script>
var k_prov = '<?php echo $data->K_PROV ?>';
var k_kab  = '<?php echo $data->K_KAB ?>';
var k_kec   = '<?php echo $data->K_KEC ?>';
var k_kel = '<?php echo $data->K_KEL ?>';
if(k_prov == null  &&  k_kab== null && k_kec== null && k_kel== null ){

}
$(function(){
    $(".select").select2();
    setTimeout(function(){
        changeProvinsi();
    }, 500)
    /*$(".select").select2();
    $("#div-provinsi").hide();
    $("#div-kabupaten").hide();
    $("#foto").change(function() {
        readURL(this);
    });
    */
})
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
function save(){
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
            rt:$("#rt").val(),
            rw:$("#rw").val(),
            status_perkawinan:$("#status_perkawinan").val(),
            ktp_file_name : $("#ktp-file").val(),
            nomor_telpn : $("#nomor_telpn").val(),
            email : $("#email").val(),
            previx: $("#provinsi").val()+"."+$("#kabupaten").val()+"."+$("#kecamatan").val()+"."+$("#kelurahan").val()
        },
        url: "<?php echo site_url()?>/anggota/save"
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
</script>
