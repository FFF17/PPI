<a class="btn btn-primary" onclick="back()">Back</a>
<div class="card">
    <div class="card-body">
    <form method="POST" action="<?php echo base_url()?>users/save" class="form" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleFormControlInput1">ROLE</label>
                    <select class="form-control select" onchange="pilihRole()" id="role"  data-style="btn btn-link" name="role" required>
                        <option value="">-- Pilih --</option>
                        <option value="admin">ADMINISTRATOR</option>
                        <option value="tpp">Profiling</option>
                        <option value="tpd">TPD</option>
                        <option value="tpc">TPC</option>
                        <option value="user">USER</option>
                        <option value="sk">Surat Tugas</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6" id="div-provinsi">
                <div class="form-group">
                    <label for="exampleFormControlInput1">PROVINSI</label>
                    <select class="form-control select" onchange="pilihProv()" id="provinsi"  data-style="btn btn-link" name="provinsi">
                        <option value="">-- Pilih --</option>
                        <?php foreach($prov->result() as $tmp) :?>
                        <option value="<?php echo $tmp->geo_prov_id?>"><?php echo $tmp->geo_prov_nama?></option>
                        <?php endforeach; ?>
                    </select>                    
                </div>
            </div>
            <div class="col-md-6" id="div-kabupaten">
                <div class="form-group">
                    <label for="exampleFormControlInput1">KABUPATEN</label>                    
                    <select class="form-control select" data-style="btn btn-link"  id="kabupaten"   name="kabupaten">
                    </select>
                </div>
            </div>
            <div class="col-md-12">&nbsp</div>
            <div class="col-md-3">
                <div class="form-group">
                    <img width="150" height="150" id="imgPreview" src="<?php echo base_url()?>assets/img/user.png"/>
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
                            <input type="text" class="form-control" name="username" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">PASSWORD</label>
                            <input type="password" class="form-control" name="password" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">NAMA</label>
                            <input type="text" class="form-control" name="nama" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">JABATAN</label>
                            <input type="text" class="form-control" name="jabatan" required/>
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
