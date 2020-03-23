<a class="btn btn-primary" onclick="back()">Back</a>
<div class="card">
    <div class="card-body">
    <form method="POST" action="<?php echo base_url()?>users/update" class="form" enctype="multipart/form-data">
        <input type="hidden" value="<?php echo $data->id?>" name="id"/>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleFormControlInput1">ROLE</label>
                    <select class="form-control select" onchange="pilihRole()" id="role"  data-style="btn btn-link" name="role" required>
                        <option value="" <?php echo ($data->role=="")?"selected":""?>>-- Pilih --</option>
                        <option value="admin" <?php echo ($data->role=="admin")?"selected":""?>>ADMINISTRATOR</option>
                        <option value="tpp" <?php echo ($data->role=="tpp")?"selected":""?>>Profiling</option>
                        <option value="tpd" <?php echo ($data->role=="tpd")?"selected":""?>>TPD</option>
                        <option value="tpc"<?php echo ($data->role=="tpc")?"selected":""?>>TPC</option>
                        <option value="user"<?php echo ($data->role=="user")?"selected":""?>>User</option>
                        <option value="sk"<?php echo ($data->role=="sk")?"selected":""?>>Surat Tugas</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6" id="div-provinsi">
                <div class="form-group">
                    <label for="exampleFormControlInput1">PROVINSI</label>
                    <select class="form-control select" onchange="pilihProv()" id="provinsi"  data-style="btn btn-link" name="provinsi">
                        <option value="">-- Pilih --</option>
                        <?php foreach($prov->result() as $tmp) :?>
                        <option <?php echo ($tmp->geo_prov_id == $data->provinsi)?"selected":""?> value="<?php echo $tmp->geo_prov_id?>"><?php echo $tmp->geo_prov_nama?></option>
                        <?php endforeach; ?>
                    </select>                    
                </div>
            </div>
            <div class="col-md-6" id="div-kabupaten">
                <div class="form-group">
                    <label for="exampleFormControlInput1">KABUPATEN</label>                    
                    <select class="form-control select" data-style="btn btn-link"  id="kabupaten"   name="kabupaten">
                        <option value="">-- Pilih --</option>
                        <?php foreach($kab->result() as $tmp) :?>
                        <option <?php echo ($tmp->geo_kab_id == $data->kabupaten)?"selected":""?> value="<?php echo $tmp->geo_kab_id?>"><?php echo $tmp->geo_kab_nama?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>   
            <div class="col-md-12">&nbsp</div>
            <div class="col-md-3">
                <div class="form-group">
                    <img width="150" height="150" id="imgPreview" src="<?php echo isset($data->foto)?base_url().'foto/'.$data->foto:base_url().'assets/img/user.png'?>"/>
                    <br/>
                    <input type="file" id="foto" name="foto" style="display:none"/>
                    <a class="btn btn-primay btn-round" onclick="$('#foto').click()">Upload</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">USERNAME</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $data->username?>" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">PASSWORD</label>
                            <input type="password" class="form-control" name="password"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">NAMA</label>
                            <input type="text" class="form-control" name="nama" value="<?php echo $data->nama?>" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">JABATAN</label>
                            <input type="text" class="form-control" name="jabatan" value="<?php echo $data->jabatan?>" required/>
                        </div>
                    </div>
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
    $("#div-provinsi").hide();
    $("#div-kabupaten").hide();
    $("#foto").change(function() {
        readURL(this);
    });
    pilihRole();
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
function pilihRole(){
    if($("#role").val() =="tpd"){
        $("#div-provinsi").show();
        $("#div-kabupaten").hide();
        $("#kabupaten").val("");
    }else if($("#role").val() =="tpc"){
        $("#div-provinsi").show();
        $("#div-kabupaten").show();
    }else{
        $("#div-provinsi").hide();
        $("#div-kabupaten").hide();
        $("#kabupaten").val("");
        $("#provinsi").val("");
    }
}
function back(){
    processStart();
    $.ajax({
        method: "POST",
        url: "<?php echo base_url()?>users"
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
