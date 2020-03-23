<a class="btn btn-primary" onclick="back()">Back</a>
<div class="card">
    <div class="card-body">
    <form method="POST" action="<?php echo base_url()?>index.php/sk/save" class="form" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleFormControlInput1">TINGKAT</label>
                    <select class="form-control select" onchange="pilihTingkat()" id="tingkat"  data-style="btn btn-link" name="tingkat" required>
                        <option value="">-- Pilih --</option>
                        <option value="tpd">TPD</option>
                        <option value="tpc">TPC</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">PROVINSI</label>
                    <select class="form-control select" onchange="pilihProv()" id="provinsi"  data-style="btn btn-link" name="provinsi" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach($prov->result() as $tmp) :?>
                        <option value="<?php echo $tmp->geo_prov_id?>"><?php echo $tmp->geo_prov_nama?></option>
                        <?php endforeach; ?>
                    </select>                    
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">KABUPATEN</label>                    
                    <select class="form-control select" data-style="btn btn-link"  id="kabupaten"   name="kabupaten_kota">
                    </select>
                </div>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <label for="exampleFormControlInput1">NOMOR SK</label>
                    <input type="input" class="form-control" name="no_sk"/>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group form-file-upload form-file-multiple">
                    <input accept="application/pdf" type="file" class="inputFileHidden" name="file" id="file_upload" onchange="$('#info_file').val($(this).val().split(/(\\|\/)/g).pop())" required>
                    <div class="input-group">
                        <input type="text" id="info_file" class="form-control inputFileVisible" onclick="$('#file_upload').click()" placeholder="SK">
                        <span class="input-group-btn">
                            <button type="button" onclick="$('#file_upload').click()" class="btn btn-fab btn-round btn-primary">
                                <i class="material-icons">attach_file</i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>            
            <div class="col-md-3">
                <div class="form-group">
                    <img width="150" height="150" id="imgPreview" src="<?php echo base_url()?>assets/img/user.png"/>
                    <br/>
                    <input type="file" id="foto" name="foto" style="display:none"/>
                    <a class="btn btn-primay btn-round" onclick="$('#foto').click()">Upload</a>
                </div>
            </div>
            <div class="col-md-9">&nbsp;</div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlInput1">KETUA</label>
                    <input type="input" class="form-control" name="ketua" required/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlInput1">NO TELPON</label>
                    <input type="input" class="form-control" name="ketua_hp" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlInput1">EMAIL</label>
                    <input type="email" class="form-control" name="ketua_email" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlInput1">SEKRETARIS</label>
                    <input type="input" class="form-control" name="seketaris" required/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlInput1">NO TELPON</label>
                    <input type="input" class="form-control" name="seketaris_hp" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlInput1">EMAIL</label>
                    <input type="email" class="form-control" name="seketaris_email"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlInput1">BENDAHARA</label>
                    <input type="input" class="form-control" name="bendahara"  required/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlInput1">NO TELPON</label>
                    <input type="input" class="form-control" name="bendahara_hp"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlInput1">EMAIL</label>
                    <input type="email" class="form-control" name="bendahara_email"/>
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-round float-right">Save</button>
            </div>
        <div>
    </form>
    </div>
</div>
</div>
<script>
$(function(){
    $(".select").select2();
    $("#provinsi").select2().next().hide();
    $("#kabupaten").select2().next().hide();
    $("#foto").change(function() {
        readURL(this);
    });
})

function pilihProv(){
    $.ajax({
        method: "POST",
        url: "<?php echo base_url()?>index.php/register/kabupaten_pemilihan",
        data: { provinsi: $("#provinsi").val() }
    }).done(function (msg) {
        $("#kabupaten").html(msg);
    });
}
function pilihTingkat(){
    if($("#tingkat").val() =="tpd"){
        $("#provinsi").select2().next().show();
        $("#kabupaten").select2().next().hide();
        $("#kabupaten").val("");
    }else if($("#tingkat").val() =="tpc"){
        $("#provinsi").select2().next().show();
        $("#kabupaten").select2().next().show();
    }
}
function back(){
    processStart();
    $.ajax({
        method: "POST",
        url: "<?php echo base_url()?>sk"
    }).done(function (msg) {
        processDone();
        $("#page-content").html(msg)
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
