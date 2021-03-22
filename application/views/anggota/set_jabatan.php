<?php
$jenis_kelamin["L"] = "Laki - Laki";
$jenis_kelamin["P"] = "Perempuan";

$perkawinan["lajang"] = "Lajang";
$perkawinan["kawin"] = "Kawin";
$perkawinan["duda"] = "Duda";
$perkawinan["janda"] = "Janda";
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
                      <label class="col-sm-2 col-form-label">Nama</label>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <input  type="text" class="form-control" name="nama" value="<?php echo $data->nama?>" id="nama" readonly  required autofocus>
                           
                          <span class="bmd-help"></span>
                        </div>
                      </div>
                    </div>
                 <div class="row">
                      <label class="col-sm-2 col-form-label label-checkbox">Tingkat</label>
                        <div class="col-sm-4">
                            <div class="form-group">
                            <select class="form-control select" data-style="btn btn-link" name="tingkat" id="tingkat" onchange="changeJabatan()">
                           <option>Pilih Tingkat</option>
                           <option>PIMNAS</option>
                           <option>PIMDA</option>
                           <option>PIMCAB</option>
                            </select>
                        </div>
                    </div>
                  </div>

                    <div class="row" id="jab">
                      <label class="col-sm-2 col-form-label label-checkbox">Jabatan</label>
                        <div class="col-sm-4">
                            <div class="form-group" >
                            <select class="form-control select" data-style="btn btn-link" name="id_tingkat" id="jabatan">
                          
                            </select>
                        </div>
                    </div>
                  </div>
                <div class="row" id="prov">
                      <label class="col-sm-2 col-form-label">Provinsi</label>
                      <div class="col-sm-4">
                         <div class="form-group">
                            <select required="" class="form-control select" data-style="btn btn-link" name="provinsi" id="provinsi" onchange="changeProvinsi()">
                            <?php foreach($prov->result() as $tmp):?>
                            <option value="<?php echo $tmp->kode;?>"><?php echo $tmp->provinsi;?></option>
                            <?php endforeach?>
                            </select>
                        </div>
                        </div>
                    </div>
                    <div class="row" id="kab">
                    <label class="col-sm-2 col-form-label">Kota.Kabupaten</label>
                      <div class="col-sm-4">
                        <div class="form-group">

                           <select required class="form-control select" data-style="btn btn-link" name="kabupaten" id="kabupaten">
                            </select>
                             </div>
                        </div>
                      </div>
              <div class="card-footer ">
                 
                </div>   
                      </div>
                    </div>
                  </form>
                </div>
     
   <script>

$(function(){
    $(".select").select2();
    $('#prov').hide();        
    $('#kab').hide();        
  
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
           provinsi : $("#provinsi").val(),
            kabupaten : $("#kabupaten").val()
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
function changeJabatan(){
    $.ajax({
        method: "POST",
        data:{
            tingkat:$("#tingkat").val()
           
        },
        
        url: "<?php echo site_url()?>/anggota/get_jabatan"
    }).done(function (msg) {
       if ($("#tingkat").val() =='PIMDA') {
              $("#prov").show();
            }else if($('#tingkat').val() == 'PIMCAB'){
              $("#kab").show();
              $("#prov").show();


            }

        $("#jabatan").html(msg);

    });
    
}
function changeProvinsi(){
    $.ajax({
        method: "POST",
        data:{
            geo_prov_id:$("#provinsi").val()
        },
        url: "<?php echo site_url()?>/anggota/get_kabupaten"
    }).done(function (msg) {
        $("#kabupaten").html(msg);

    });
     
}
</script>
