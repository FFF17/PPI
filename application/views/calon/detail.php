<?php
$jeni_kelamin["L"] = "Laki - Laki";
$jeni_kelamin["P"] = "Perempuan";


$status_kawin["kawin"] = "Kawin";
$status_kawin["lajang"] = "Belum Kawin";
$status_kawin["duda"] = "Duda";
$status_kawin["janda"] = "Janda";

$agama["islam"] = "Islam";
$agama["kristen"] = "Kristen";
$agama["katholik"] = "Katholik";
$agama["hindu"] = "Hindu";
$agama["budha"] = "Budha";
$agama["khonghucu"] = "Khong Hu Cu";
?>
<a class="btn btn-primary" onclick="back()">Back</a>
<input type="hidden" id="provinsi" value="<?php echo $provinsi;?>"/>
<input type="hidden" id="kabupaten" value="<?php echo $kabupaten;?>"/>
<div class="card">
    <div class="card-body">
    <form method="POST" action="<?php echo base_url()?>index.php/register/save" class="form">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleFormControlInput1">MENCALONKAN SEBAGAI</label>
                    <h3><?php echo @$tingkat[$data->mencalonkan]; ?></h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">PROVINSI</label>
                    <p><?php echo $data->geo_prov_nama; ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">KABUPATEN</label>
                    <p><?php echo $data->geo_kab_nama; ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <img src="<?php echo base_url().(($data->foto!="")?'foto/'.$data->foto:'assets/img/user.png')?>" width="150" height= "150"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">NAMA CALON</label>
                    <p><?php echo $data->nama; ?></p>
                    <label for="exampleFormControlInput1">TEMPAT LAHIR</label>
                    <p><?php echo $data->tempat_lahir; ?></p>
                    <label for="exampleFormControlInput1">TANGGAL LAHIR</label>
                    <p><?php echo $data->tanggal_lahir; ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">NOMOR NIK</label>
                    <p><?php echo $data->nomor_nik; ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">NOMOR KTA</label>
                    <p><?php echo $data->nomor_kta; ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">JENIS KELAMIN</label>
                    <p><?php echo @$jeni_kelamin[$data->jenis_kelamin]; ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">AGAMA</label>
                    <p><?php echo @$agama[$data->agama]; ?></p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleFormControlInput1">ALAMAT</label>
                    <p><?php echo $data->alamat; ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">NO TELPON</label>
                    <p><?php echo $data->telp; ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">EMAIL</label>
                    <p><?php echo $data->email; ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlInput1">FACEBOOK</label>
                    <p><?php echo $data->sm_fb; ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlInput1">TWITTER</label>
                    <p><?php echo $data->sm_twitter; ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlInput1">INSTAGRAM</label>
                    <p><?php echo $data->sm_instagram; ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">STATUS KAWIN</label>
                    <p><?php echo @$status_kawin[$data->status_perkawinan]; ?></p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleFormControlInput1">NAMA ISTRI/SUAMI</label>
                    <p><?php echo $data->nama_istri; ?></p>
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
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Tingkat </th>
                                <th>Alamat</th>
                                <th>Tahun</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($pendidikan->result() as $tmp):?>
                            <?php if($tmp->alamat !=""):?>
                            <tr>
                                <td><?php echo $tmp->tingkat?></td>
                                <td><?php echo $tmp->alamat?></td>
                                <td><?php echo $tmp->tahun?></td>
                            </tr>
                            <?php endif?>
                            <?php endforeach;?>
                        </tbody>
                    </table>
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
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>JENIS PELATIHAN </th>
                                <th>INSTANSI</th>
                                <th>Tahun</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($diklat->result() as $tmp):?>
                            <?php if($tmp->jenis_pelatihan !=""):?>
                            <tr>
                                <td><?php echo $tmp->jenis_pelatihan?></td>
                                <td><?php echo $tmp->instansi?></td>
                                <td><?php echo $tmp->tahun?></td>
                            </tr>
                            <?php endif?>
                            <?php endforeach;?>
                        </tbody>
                    </table>
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
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>NAMA ORGANISASI </th>
                                <th>ALAMAT</th>
                                <th>JABATAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($organisasi->result() as $tmp):?>
                            <?php if($tmp->organisasi !=""):?>
                            <tr>
                                <td><?php echo $tmp->organisasi?></td>
                                <td><?php echo $tmp->alamat?></td>
                                <td><?php echo $tmp->jabatan?></td>
                            </tr>
                            <?php endif?>
                            <?php endforeach;?>
                        </tbody>
                    </table>
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
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>INSTANSI </th>
                                <th>ALAMAT</th>
                                <th>JABATAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($pekerjaan->result() as $tmp):?>
                            <?php if($tmp->instansi !=""):?>
                            <tr>
                                <td><?php echo $tmp->instansi?></td>
                                <td><?php echo $tmp->alamat?></td>
                                <td><?php echo $tmp->jabatan?></td>
                            </tr>
                            <?php endif?>
                            <?php endforeach;?>
                        </tbody>
                    </table>
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
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>PENGHARGAAN </th>
                                <th>INSTANSI</th>
                                <th>TAHUN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($penghargaan->result() as $tmp):?>
                            <?php if($tmp->penghargaan !=""):?>
                            <tr>
                                <td><?php echo $tmp->penghargaan?></td>
                                <td><?php echo $tmp->instansi?></td>
                                <td><?php echo $tmp->tahun?></td>
                            </tr>
                            <?php endif?>
                            <?php endforeach;?>
                        </tbody>
                    </table>
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
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>KEGIATAN </th>
                                <th>LOKASI</th>
                                <th>TAHUN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($sosial->result() as $tmp):?>
                            <?php if($tmp->kegiatan !=""):?>
                            <tr>
                                <td><?php echo $tmp->kegiatan?></td>
                                <td><?php echo $tmp->lokasi?></td>
                                <td><?php echo $tmp->tahun?></td>
                            </tr>
                            <?php endif?>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
            </div>
            </div>
        </div>
    </form>
    </div>
</div>
</div>
<script>
function back(){
    processStart();
    $.ajax({
        method: "POST",
        url: "<?php echo base_url()?>calon/pendaftar",
        data: {
            provinsi: $("#provinsi").val(),
            kabupaten: $("#kabupaten").val(),
        }
    }).done(function (msg) {
        processDone();
        $("#page-content").html(msg)
    });
}
</script>
