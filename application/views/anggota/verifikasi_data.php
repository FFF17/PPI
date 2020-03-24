<a class="btn btn-primary" onclick="back()">Back</a>
<div class="card">
    <div class="card-body">
    <form method="POST" action="<?php echo base_url()?>users/save" class="form" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <img src="<?php echo base_url().$data->foto_ktp?>" height="250px"/>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">NAMA</label>
                            <input type="text" class="form-control" name="nama" required value="<?php echo $data->nama?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">NO TELPON</label>
                            <input type="text" class="form-control" name="no_telpn" id="no_telpn" required value="<?php echo $data->nomor_telpn?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">NOMOR NIK</label>
                            <input type="text" class="form-control" name="nomor_nik" id="nomor_nik" value="<?php echo $data->nomor_ktp?>" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <input type="button" class="btn btn-primary float-right" value = 'Check Data' onclick="check()"/>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" required />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" required />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Agama</label>
                            <select class="form-control select" data-style="btn btn-link" name="agama" id="agama">
                            <?php foreach($agama->result() as $tmp):?>
                                <option value="<?php echo $tmp->id?>"><?php echo $tmp->agama?></option>
                            <?php endforeach?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Jenis Kelamin</label>
                            <select class="form-control select" data-style="btn btn-link" name="jenis_kelamin" id="jenis_kelamin">
                                <option value="L">Laki - Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Status Perkawinan</label>
                            <select class="form-control select" data-style="btn btn-link" name="status_perkawinan" id="status_perkawinan">
                                <option value="lajang">Laki - Laki</option>
                                <option value="kawin">Perempuan</option>
                                <option value="duda">Duda</option>
                                <option value="janda">Janda</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Pasangan</label>
                            <input type="text" class="form-control" name="nama_pasangan" id="nama_pasangan"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Jumlah Anak</label>
                            <input type="text" class="form-control" name="jumlah_anak" id="jumlah_anak"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="alamat" required />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Provinsi</label>
                            <select class="form-control select" data-style="btn btn-link" name="provinsi" id="provinsi" onchange="changeProvinsi()">
                            <?php foreach($prov->result() as $tmp):?>
                            <option value="<?php echo $tmp->geo_prov_id;?>"><?php echo $tmp->geo_prov_nama;?></option>
                            <?php endforeach?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Kabupaten</label>
                            <select class="form-control select" data-style="btn btn-link" name="kabupaten" id="kabupaten" onchange="changeKabupaten()">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Kecamatan</label>
                            <select class="form-control select" data-style="btn btn-link" name="kecamatan" id="kecamatan" onchange="changeKecamatan()">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Kelurahan</label>
                            <select class="form-control select" data-style="btn btn-link" name="kelurahan" id="kelurahan" >
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Pendidikan</label>
                            <select class="form-control select" data-style="btn btn-link" name="pendidikan" id="pendidikan">
                            <?php foreach($pendidikan->result() as $tmp):?>
                                <option value="<?php echo $tmp->id?>"><?php echo $tmp->pendidikan?></option>
                            <?php endforeach?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Pekerjaan</label>
                            <select class="form-control select" data-style="btn btn-link" name="pekerjaan" id="pekerjaan">
                            <?php foreach($pekerjaan->result() as $tmp):?>
                                <option value="<?php echo $tmp->id?>"><?php echo $tmp->pekerjaan?></option>
                            <?php endforeach?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Organisasi</label>
                            <input type="text" class="form-control" name="organisasi" id="organisasi" />
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
function back(){
    processStart();
    $.ajax({
        method: "POST",
        url: "<?php echo site_url()?>/anggota/baru"
    }).done(function (msg) {
        processDone();
        $("#page-content").html(msg)
    });
}
function check(){
    processStart();
    $.ajax({
        method: "POST",
        data:{
            nik:$("#nomor_nik").val()
        },
        url: "<?php echo site_url()?>/anggota/check_nik"
    }).done(function (msg) {
        processDone();
        var data = eval('('+msg+')');
        $("#tempat_lahir").val(data.tmp_lhr);
        $("#tanggal_lahir").val(data.tgl_lhr);
        $("#alamat").val(data.alamat);
        $("#agama").val(data.agama);
        $("#agama").select2().trigger('change');
        if(data.jk == "Pria"){
            $("#jenis_kelamin").val("L");
        }else{            
            $("#jenis_kelamin").val("P");
        }
        $("#jenis_kelamin").select2().trigger('change');
        if(data.perkawinan == "1"){
            $("#status_perkawinan").val("lajang");
        }else if(data.perkawinan == "2"){
            $("#status_perkawinan").val("kawin");
        }else{
            if(data.jk == "Pria"){
                $("#status_perkawinan").val("duda");
            }else{            
                $("#status_perkawinan").val("janda");
            }
        }
        $("#status_perkawinan").select2().trigger('change');
        $("#pekerjaan").val(data.pekerjaan);
        $("#pekerjaan").select2().trigger('change');
        $("#pendidikan").val(data.pendidikan);
        $("#pendidikan").select2().trigger('change');
        $("#organisasi").val(data.organisasi1);
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
function changeKabupaten(){
    $.ajax({
        method: "POST",
        data:{
            geo_kab_id:$("#kabupaten").val()
        },
        url: "<?php echo site_url()?>/anggota/get_kecamatan"
    }).done(function (msg) {
        $("#kecamatan").html(msg);
    });
}
function changeKecamatan(){
    $.ajax({
        method: "POST",
        data:{
            geo_kec_id:$("#kecamatan").val()
        },
        url: "<?php echo site_url()?>/anggota/get_kelurahan"
    }).done(function (msg) {
        $("#kelurahan").html(msg);
    });
}
</script>
