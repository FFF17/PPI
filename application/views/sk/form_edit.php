<a class="btn btn-primary" onclick="back()">Back</a>
<div class="card">
    <div class="card-body">
    <form method="POST" action="<?php echo base_url()?>index.php/sk/update" class="form" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id" value="<?php echo $data->id?>"/>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">PROVINSI</label>
                    <select class="form-control select" onchange="pilihProv()" id="provinsi"  data-style="btn btn-link" name="provinsi" required readonly>
                        <?php foreach($prov->result() as $tmp) :?>
                        <?php if($tmp->geo_prov_id == $data->geo_prov_id):?>
                        <option <?php echo ($tmp->geo_prov_id == $data->geo_prov_id)?"selected":""?> value="<?php echo $tmp->geo_prov_id?>"><?php echo $tmp->geo_prov_nama?></option>
                        <?php endif?>
                        <?php endforeach; ?>
                    </select>                    
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">KABUPATEN</label>                    
                    <select class="form-control select" data-style="btn btn-link"  id="kabupaten"   name="kabupaten_kota" required readonly>
                        <?php foreach($kab->result() as $tmp) :?>
                            <?php if($tmp->geo_kab_id == $data->geo_kab_id) :?>
                                <option <?php echo ($tmp->geo_kab_id == $data->geo_kab_id)?"selected":""?> value="<?php echo $tmp->geo_kab_id?>"><?php echo $tmp->geo_kab_nama?></option>
                            <?php endif;?>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <label for="exampleFormControlInput1">NOMOR SK</label>
                    <input type="input" class="form-control" name="no_sk" value="<?php echo $data->no_sk?>"/>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group form-file-upload form-file-multiple">
                    <input accept="application/pdf" type="file" class="inputFileHidden" name="file" id="file_upload" onchange="$('#info_file').val($(this).val().split(/(\\|\/)/g).pop())">
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
                    <img width="150" height="150" id="imgPreview" src="<?php echo ($data->foto)?base_url().'foto/'.$data->foto:base_url().'assets/img/user.png'?>"/>
                    <br/>
                    <input type="file" id="foto" name="foto" style="display:none"/>
                    <a class="btn btn-primay btn-round" onclick="$('#foto').click()">Upload</a>
                </div>
            </div>
            <div class="col-md-9">&nbsp;</div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlInput1">KETUA</label>
                    <input type="input" class="form-control" name="ketua" value = "<?php echo $data->ketua?>" required/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlInput1">NO TELPON</label>
                    <input type="input" class="form-control" name="ketua_hp" value = "<?php echo $data->ketua_hp?>"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlInput1">EMAIL</label>
                    <input type="email" class="form-control" name="ketua_email" value = "<?php echo $data->ketua_email?>"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlInput1">SEKRETARIS</label>
                    <input type="input" class="form-control" name="seketaris" value="<?php echo $data->seketaris?>" required/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlInput1">NO TELPON</label>
                    <input type="input" class="form-control" name="seketaris_hp" value="<?php echo $data->seketaris_hp?>"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlInput1">EMAIL</label>
                    <input type="email" class="form-control" name="seketaris_email" value="<?php echo $data->seketaris_email?>"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlInput1">BENDAHARA</label>
                    <input type="input" class="form-control" name="bendahara" value="<?php echo $data->bendahara?>" required/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlInput1">NO TELPON</label>
                    <input type="input" class="form-control" name="bendahara_hp" value="<?php echo $data->bendahara_hp?>"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlInput1">EMAIL</label>
                    <input type="email" class="form-control" name="bendahara_email" value="<?php echo $data->bendahara_email?>"/>
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
