<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

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
<input type="hidden" id="provinsi" value="<?php echo $data->provinsi; ?>" />
<input type="hidden" id="kabupaten" value="<?php echo $data->kabupaten_kota; ?>" />
<div class="card">
    <div class="card-body">
        <form method="POST" action="<?php echo base_url() ?>index.php/calon/update" class="form" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" name="id_calon" value="<?= $data->id; ?>">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">MENCALONKAN SEBAGAI EDIT</label>
                        <select name="mencalonkan" class="form-control select" data-style="btn btn-link">
                            <option <?= $data->mencalonkan == 'bupati' ? 'selected' : ''; ?> value="bupati">Calon Bupati</option>
                            <option <?= $data->mencalonkan == 'wakil_bupati' ? 'selected' : ''; ?> value="wakil_bupati">Calon Wakil Bupati</option>
                            <option <?= $data->mencalonkan == 'walikota' ? 'selected' : ''; ?> value="walikota">Calon Walikota</option>
                            <option <?= $data->mencalonkan == 'wakil_walikota' ? 'selected' : ''; ?> value="wakil_walikota">Calon Wakil Walikota</option>
                            <option <?= $data->mencalonkan == 'gubernur' ? 'selected' : ''; ?> value="gubernur">Calon Gubernur</option>
                            <option <?= $data->mencalonkan == 'wakil_gubernur' ? 'selected' : ''; ?> value="wakil_gubernur">Calon Wakil Gubernur</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">PROVINSI</label>
                        <select class="form-control select" onchange="pilihProv()" id="provinsi_select" data-style="btn btn-link" name="provinsi_select" required>
                            <option value="">ALL </option>
                            <?php foreach ($prov->result() as $tmp) : ?>
                                <option <?php echo ($tmp->geo_prov_id == $data->provinsi) ? 'selected' : '' ?> value="<?php echo $tmp->geo_prov_id ?>"><?php echo $tmp->geo_prov_nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">KABUPATEN / KOTA</label>
                        <select class="form-control select" data-style="btn btn-link" id="kabupaten_select" name="kabupaten_select">
                            <?= count($kab->result()) <= 1 ? '' : '<option value="">ALL </option>'; ?>
                            <?php foreach ($kab->result() as $tmp) : ?>
                                <option <?php echo ($tmp->geo_kab_id == $data->kabupaten_kota) ? 'selected' : '' ?> value="<?php echo $tmp->geo_kab_id ?>"><?php echo $tmp->geo_kab_nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                            <div class="fileinput-new thumbnail img-circle" style="max-width:150px; height:150px;">
                                <img src="<?php echo file_exists(FCPATH . 'foto/' . $data->foto) && $data->foto != '' ? base_url() . 'foto/' . $data->foto : base_url() . 'assets/img/user.png' ?>" alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail img-circle" style="max-width:150px; height:150px;"></div>
                            <div>
                                <span class="btn btn-round btn-default btn-file">
                                    <span class="fileinput-new" onclick="$('#foto').click()">Change</span>
                                    <span class="fileinput-exists" onclick="$('#foto').click()">Change</span>
                                    <input type="file" id="foto" name="foto" accept="image/png,image/jpeg,image/jpg" />
                                </span>
                                <br />
                                <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group pb-3">
                        <label for="exampleFormControlInput1">NAMA CALON</label>
                        <input class="form-control" type="text" name="nama_calon" id="nama_calon" value="<?php echo $data->nama; ?>">
                    </div>
                    <div class="form-group pb-3">
                        <label for="exampleFormControlInput1">TEMPAT LAHIR</label>
                        <input class="form-control" type="text" name="tempat_lahir" id="tempat_lahir" value="<?php echo $data->tempat_lahir; ?>">
                    </div>
                    <div class="form-group pb-3">
                        <label for="exampleFormControlInput1">TANGGAL LAHIR</label>
                        <input class="form-control" type="date" name="tgl_lahir" id="tgl_lahir" value="<?php echo $data->tanggal_lahir; ?>">
                    </div>
                    <br>
                </div>
                <div class="col-md-6">
                    <div class="form-group pb-3">
                        <label for="exampleFormControlInput1">NOMOR NIK</label>
                        <input class="form-control" type="number" name="no_nik" id="no_nik" value="<?php echo $data->nomor_nik; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group pb-3">
                        <label for="exampleFormControlInput1">NOMOR KTA</label>
                        <input class="form-control" type="number" name="no_kta" id="no_kta" value="<?php echo $data->nomor_kta; ?>">
                    </div>
                </div>
                <div class="col-md-6 pb-3">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">JENIS KELAMIN</label>
                        <select class="form-control select" id="jk" data-style="btn btn-link" name="jk">
                            <option <?= $data->jenis_kelamin == "L" ? 'selected' : ''; ?> value="L"><?= $jeni_kelamin["L"]; ?></option>
                            <option <?= $data->jenis_kelamin == "P" ? 'selected' : ''; ?> value="P"><?= $jeni_kelamin["P"]; ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 pb-3">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">AGAMA</label>
                        <select class="form-control select" id="agama" data-style="btn btn-link" name="agama">
                            <option <?= $data->agama == 'islam' ? 'selected' : ''; ?> value="islam"><?= $agama["islam"]; ?></option>
                            <option <?= $data->agama == 'kristen' ? 'selected' : ''; ?> value="kristen"><?= $agama["kristen"]; ?></option>
                            <option <?= $data->agama == 'katholik' ? 'selected' : ''; ?> value="katholik"><?= $agama["katholik"]; ?></option>
                            <option <?= $data->agama == 'hindu' ? 'selected' : ''; ?> value="hindu"><?= $agama["hindu"]; ?></option>
                            <option <?= $data->agama == 'budha' ? 'selected' : ''; ?> value="budha"><?= $agama["budha"]; ?></option>
                            <option <?= $data->agama == 'khonghucu' ? 'selected' : ''; ?> value="khonghucu"><?= $agama["khonghucu"]; ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group pb-3">
                        <label for="exampleFormControlInput1">ALAMAT</label>
                        <input class="form-control" type="text" name="alamat" id="alamat" value="<?php echo $data->alamat; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group pb-3">
                        <label for="exampleFormControlInput1">NO TELEPON</label>
                        <input class="form-control" type="text" name="telp" id="telp" value="<?php echo $data->telp; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group pb-3">
                        <label for="exampleFormControlInput1">EMAIL</label>
                        <input class="form-control" type="text" name="email" id="email" value="<?php echo $data->email; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group pb-3">
                        <label for="exampleFormControlInput1">FACEBOOK</label>
                        <input class="form-control" type="text" name="sm_fb" id="sm_fb" value="<?php echo $data->sm_fb; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group pb-3">
                        <label for="exampleFormControlInput1">TWITTER</label>
                        <input class="form-control" type="text" name="sm_twitter" id="sm_twitter" value="<?php echo $data->sm_twitter; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group pb-3">
                        <label for="exampleFormControlInput1">INSTAGRAM</label>
                        <input class="form-control" type="text" name="sm_instagram" id="sm_instagram" value="<?php echo $data->sm_instagram; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group pb-3">
                        <label for="exampleFormControlInput1">STATUS KAWIN</label>
                        <select class="form-control select" id="status_perkawinan" data-style="btn btn-link" name="status_perkawinan">
                            <option <?= $data->status_perkawinan == 'kawin' ? 'selected' : ''; ?> value="kawin"><?= $status_kawin["kawin"]; ?></option>
                            <option <?= $data->status_perkawinan == 'lajang' ? 'selected' : ''; ?> value="lajang"><?= $status_kawin["lajang"]; ?></option>
                            <option <?= $data->status_perkawinan == 'duda' ? 'selected' : ''; ?> value="duda"><?= $status_kawin["duda"]; ?></option>
                            <option <?= $data->status_perkawinan == 'janda' ? 'selected' : ''; ?> value="janda"><?= $status_kawin["janda"]; ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group pb-3">
                        <label for="exampleFormControlInput1">NAMA ISTRI/SUAMI</label>
                        <input class="form-control" type="text" name="nama_istri" id="nama_istri" value="<?php echo $data->nama_istri; ?>">
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="accordion" role="tablist">
                        <div class="card card-collapse">
                            <?php $pend = $pendidikan->result(); ?>
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
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">ALAMAT</div>
                                        <div class="col-md-3">TAHUN</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">1. SD</div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="SD_ALAMAT" value="<?= count($pend) > 0 ? $pend[0]->alamat : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="number" class="form-control" placeholder="" name="SD_TAHUN" value="<?= count($pend) > 0 & $pend[0]->tahun != '0000' ? $pend[0]->tahun : ''; ?>" /></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">2. SMP</div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="SMP_ALAMAT" value="<?= count($pend) > 1 ? $pend[1]->alamat : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="SMP_TAHUN" value="<?= count($pend) > 1 & $pend[1]->tahun != '0000' ? $pend[1]->tahun : ''; ?>" /></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">3. SMA</div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="SMA_ALAMAT" value="<?= count($pend) > 2 ? $pend[2]->alamat : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="SMA_TAHUN" value="<?= count($pend) > 2 & $pend[2]->tahun != '0000' ? $pend[2]->tahun : ''; ?>" /></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">4. SARJANA</div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="S1_ALAMAT" value="<?= count($pend) > 3 ? $pend[3]->alamat : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="S1_TAHUN" value="<?= count($pend) > 3 & $pend[3]->tahun != '0000' ? $pend[3]->tahun : ''; ?>" /></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">5. PASCA SARJANA</div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="S2_ALAMAT" value="<?= count($pend) > 4 ? $pend[4]->alamat : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="S2_TAHUN" value="<?= count($pend) > 4 & $pend[4]->tahun != '0000' ? $pend[4]->tahun : ''; ?>" /></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-collapse">
                            <?php $pelatihan = $diklat->result(); ?>
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
                                    <div class="row">
                                        <div class="col-md-3">JENIS PELATIHAN</div>
                                        <div class="col-md-6">INSTANSI</div>
                                        <div class="col-md-3">TAHUN</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="jp_jenis_pelatihan1" value="<?= count($pelatihan) > 0 ? $pelatihan[0]->jenis_pelatihan : ''; ?>" /></div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="jp_instansi1" value="<?= count($pelatihan) > 0 ? $pelatihan[0]->instansi : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="jp_tahun1" value="<?= count($pelatihan) > 0 && $pelatihan[0]->tahun != '0000' ? $pelatihan[0]->tahun : ''; ?>" /></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="jp_jenis_pelatihan2" value="<?= count($pelatihan) > 1 ? $pelatihan[1]->jenis_pelatihan : ''; ?>" /></div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="jp_instansi2" value="<?= count($pelatihan) > 1 ? $pelatihan[1]->instansi : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="jp_tahun2" value="<?= count($pelatihan) > 1 && $pelatihan[1]->tahun != '0000' ? $pelatihan[1]->tahun : ''; ?>" /></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="jp_jenis_pelatihan3" value="<?= count($pelatihan) > 2 ? $pelatihan[2]->jenis_pelatihan : ''; ?>" /></div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="jp_instansi3" value="<?= count($pelatihan) > 2 ? $pelatihan[2]->instansi : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="jp_tahun3" value="<?= count($pelatihan) > 2 && $pelatihan[2]->tahun != '0000' ? $pelatihan[2]->tahun : ''; ?>" /></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="jp_jenis_pelatihan4" value="<?= count($pelatihan) > 3 ? $pelatihan[3]->jenis_pelatihan : ''; ?>" /></div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="jp_instansi4" value="<?= count($pelatihan) > 3 ? $pelatihan[3]->instansi : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="jp_tahun4" value="<?= count($pelatihan) > 3 && $pelatihan[3]->tahun != '0000' ? $pelatihan[3]->tahun : ''; ?>" /></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="jp_jenis_pelatihan5" value="<?= count($pelatihan) > 4 ? $pelatihan[4]->jenis_pelatihan : ''; ?>" /></div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="jp_instansi5" value="<?= count($pelatihan) > 4 ? $pelatihan[4]->instansi : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="jp_tahun5" value="<?= count($pelatihan) > 4 && $pelatihan[4]->tahun != '0000' ? $pelatihan[4]->tahun : ''; ?>" /></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-collapse">
                            <?php $org = $organisasi->result(); ?>
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
                                    <div class="row">
                                        <div class="col-md-3">NAMA ORGANISASI</div>
                                        <div class="col-md-6">ALAMAT</div>
                                        <div class="col-md-3">JABATAN</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="o_organisasi1" value="<?= count($org) > 0 ? $org[0]->organisasi : ''; ?>" /></div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="o_alamat1" value="<?= count($org) > 0 ? $org[0]->alamat : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="o_jabatan1" value="<?= count($org) > 0 ? $org[0]->jabatan : ''; ?>" /></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="o_organisasi2" value="<?= count($org) > 1 ? $org[1]->organisasi : ''; ?>" /></div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="o_alamat2" value="<?= count($org) > 1 ? $org[1]->alamat : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="o_jabatan2" value="<?= count($org) > 1 ? $org[1]->jabatan : ''; ?>" /></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="o_organisasi3" value="<?= count($org) > 2 ? $org[2]->organisasi : ''; ?>" /></div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="o_alamat3" value="<?= count($org) > 2 ? $org[2]->alamat : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="o_jabatan3" value="<?= count($org) > 2 ? $org[2]->jabatan : ''; ?>" /></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="o_organisasi4" value="<?= count($org) > 3 ? $org[3]->organisasi : ''; ?>" /></div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="o_alamat4" value="<?= count($org) > 3 ? $org[3]->alamat : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="o_jabatan4" value="<?= count($org) > 3 ? $org[3]->jabatan : ''; ?>" /></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="o_organisasi5" value="<?= count($org) > 4 ? $org[4]->organisasi : ''; ?>" /></div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="o_alamat5" value="<?= count($org) > 4 ? $org[4]->alamat : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="o_jabatan5" value="<?= count($org) > 4 ? $org[4]->jabatan : ''; ?>" /></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-collapse">
                            <?php $kerja = $pekerjaan->result(); ?>
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
                                    <div class="row">
                                        <div class="col-md-3">INSTANSI</div>
                                        <div class="col-md-6">ALAMAT</div>
                                        <div class="col-md-3">JABATAN</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="p_instansi1" value="<?= count($kerja) > 0 ? $kerja[0]->instansi : ''; ?>" /></div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="p_alamat1" value="<?= count($kerja) > 0 ? $kerja[0]->alamat : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="p_jabatan1" value="<?= count($kerja) > 0 ? $kerja[0]->jabatan : ''; ?>" /></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="p_instansi2" value="<?= count($kerja) > 1 ? $kerja[1]->instansi : ''; ?>" /></div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="p_alamat2" value="<?= count($kerja) > 1 ? $kerja[1]->alamat : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="p_jabatan2" value="<?= count($kerja) > 1 ? $kerja[1]->jabatan : ''; ?>" /></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="p_instansi3" value="<?= count($kerja) > 2 ? $kerja[2]->instansi : ''; ?>" /></div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="p_alamat3" value="<?= count($kerja) > 2 ? $kerja[2]->alamat : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="p_jabatan3" value="<?= count($kerja) > 2 ? $kerja[2]->jabatan : ''; ?>" /></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="p_instansi4" value="<?= count($kerja) > 3 ? $kerja[3]->instansi : ''; ?>" /></div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="p_alamat4" value="<?= count($kerja) > 3 ? $kerja[3]->alamat : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="p_jabatan4" value="<?= count($kerja) > 3 ? $kerja[3]->jabatan : ''; ?>" /></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="p_instansi5" value="<?= count($kerja) > 4 ? $kerja[4]->instansi : ''; ?>" /></div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="p_alamat5" value="<?= count($kerja) > 4 ? $kerja[4]->alamat : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="p_jabatan5" value="<?= count($kerja) > 4 ? $kerja[4]->jabatan : ''; ?>" /></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-collapse">
                            <?php $hargaan = $penghargaan->result(); ?>
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
                                    <div class="row">
                                        <div class="col-md-3">PENGHARGAAN</div>
                                        <div class="col-md-6">INSTANSI</div>
                                        <div class="col-md-3">TAHUN</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="pe_penghargaan1" value="<?= count($hargaan) > 0 ? $hargaan[0]->penghargaan : ''; ?>" /></div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="pe_instansi1" value="<?= count($hargaan) > 0 ? $hargaan[0]->instansi : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="pe_tahun1" value="<?= count($hargaan) > 0 && $hargaan[0]->tahun != '0000' ? $hargaan[0]->tahun : ''; ?>" /></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="pe_penghargaan2" value="<?= count($hargaan) > 1 ? $hargaan[1]->penghargaan : ''; ?>" /></div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="pe_instansi2" value="<?= count($hargaan) > 1 ? $hargaan[1]->instansi : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="pe_tahun2" value="<?= count($hargaan) > 1 && $hargaan[1]->tahun != '0000' ? $hargaan[1]->tahun : ''; ?>" /></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="pe_penghargaan3" value="<?= count($hargaan) > 2 ? $hargaan[2]->penghargaan : ''; ?>" /></div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="pe_instansi3" value="<?= count($hargaan) > 2 ? $hargaan[2]->instansi : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="pe_tahun3" value="<?= count($hargaan) > 2 && $hargaan[2]->tahun != '0000' ? $hargaan[2]->tahun : ''; ?>" /></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="pe_penghargaan4" value="<?= count($hargaan) > 3 ? $hargaan[3]->penghargaan : ''; ?>" /></div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="pe_instansi4" value="<?= count($hargaan) > 3 ? $hargaan[3]->instansi : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="pe_tahun4" value="<?= count($hargaan) > 3 && $hargaan[3]->tahun != '0000' ? $hargaan[3]->tahun : ''; ?>" /></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="pe_penghargaan5" value="<?= count($hargaan) > 4 ? $hargaan[4]->penghargaan : ''; ?>" /></div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="pe_instansi5" value="<?= count($hargaan) > 4 ? $hargaan[4]->instansi : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="pe_tahun5" value="<?= count($hargaan) > 4 && $hargaan[4]->tahun != '0000' ? $hargaan[4]->tahun : ''; ?>" /></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-collapse">
                            <?php $sos = $sosial->result(); ?>
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
                                    <div class="row">
                                        <div class="col-md-3">KEGIATAN</div>
                                        <div class="col-md-6">LOKASI</div>
                                        <div class="col-md-3">TAHUN</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="k_kegiatan1" value="<?= count($sos) > 0 ? $sos[0]->kegiatan : ''; ?>" /></div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="k_lokasi1" value="<?= count($sos) > 0 ? $sos[0]->lokasi : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="k_tahun1" value="<?= count($sos) > 0 && $sos[0]->tahun != '0000' ? $sos[0]->tahun : ''; ?>" /></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="k_kegiatan2" value="<?= count($sos) > 1 ? $sos[1]->kegiatan : ''; ?>" /></div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="k_lokasi2" value="<?= count($sos) > 1 ? $sos[1]->lokasi : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="k_tahun2" value="<?= count($sos) > 1 && $sos[1]->tahun != '0000' ? $sos[1]->tahun : ''; ?>" /></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="k_kegiatan3" value="<?= count($sos) > 2 ? $sos[2]->kegiatan : ''; ?>" /></div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="k_lokasi3" value="<?= count($sos) > 2 ? $sos[2]->lokasi : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="k_tahun3" value="<?= count($sos) > 2 && $sos[2]->tahun != '0000' ? $sos[2]->tahun : ''; ?>" /></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="k_kegiatan3" value="<?= count($sos) > 4 ? $sos[4]->kegiatan : ''; ?>" /></div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="k_lokasi3" value="<?= count($sos) > 4 ? $sos[4]->lokasi : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="k_tahun3" value="<?= count($sos) > 4 && $sos[4]->tahun != '0000' ? $sos[4]->tahun : ''; ?>" /></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="k_kegiatan5" value="<?= count($sos) > 4 ? $sos[4]->kegiatan : ''; ?>" /></div>
                                        <div class="col-md-6"><input type="text" class="form-control" placeholder="" name="k_lokasi5" value="<?= count($sos) > 4 ? $sos[4]->lokasi : ''; ?>" /></div>
                                        <div class="col-md-3"><input type="text" class="form-control" placeholder="" name="k_tahun5" value="<?= count($sos) > 4 && $sos[4]->tahun != '0000' ? $sos[4]->tahun : ''; ?>" /></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center pt-3">
                <button class="btn btn-success btn-round" type="submit">SAVE</button>
            </div>
        </form>
    </div>
</div>
</div>
<script>
    $(function() {
        $(".select").select2();
    });

    function pilihProv() {
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>calon/kabupaten_pemilihan",
            data: {
                provinsi: $("#provinsi_select").val()
            }
        }).done(function(msg) {
            $("#kabupaten_select").html(msg);
        });
    }

    function back() {
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>calon/pendaftar",
            data: {
                provinsi: $("#provinsi").val(),
                kabupaten: $("#kabupaten").val(),
            }
        }).done(function(msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }
</script>
<script>
    $(document).ready(function() {
        // initialise Datetimepicker and Sliders
        md.initFormExtendedDatetimepickers();
        if ($('.slider').length != 0) {
            md.initSliders();
        }
    });
</script>