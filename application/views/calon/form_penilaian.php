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
    <form method="POST" action="<?php echo base_url()?>index.php/calon/save_penilaian" class="form">
        <input type="hidden" value="<?php echo $data->id?>" name="id"/>
        <div class="row">
            <div class="col-md-12">
                <table id='datatab' class='table table-borderless'>
                    <thead>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class='w-30 text-center'>
                                <img src='<?php echo base_url().(($data->foto!="")?'foto/'.$data->foto:'assets/img/user.png')?>'width="150" height= "150" class='rounded-circle circular--square circular--landscape circular--portrait grayscale mb-3'>
                            </td>
                            <td>
                                <p class='mt-3'><b><?php echo $data->nama?></b></p>
                                <p class='mt-3'><?php echo $tingkat[$data->mencalonkan]?></p>
                                <p class='mt-3'><?php echo date_diff(date_create($data->tanggal_lahir), date_create('now'))->y ?> Tahun</p>
                                <p class='mt-3'><?php echo $data->pekerjaan?></p>
                                <p class='mt-3'><?php echo $data->organisasi?></p>
                                <p class='mt-3'><?php echo $data->review?></p>
                            </td>
                            <td valign="top">
                                <h6>Score</h6>
                                <h1><?php echo isset($data->nilai)?round($data->nilai,3):"-"?></h1>
                                <h6>Survey</h6>
                                <table class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <td>Nama</td>
                                            <td>Tanggal</td>
                                            <td>Hasil</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php 
                                    $survey = $this->db->query("select nama_surveyor,survey_date,survey from tb_survey inner join tb_calon_survey on id_survey = tb_survey.id where id_calon = '".$data->id."'");
                                    foreach($survey->result() as $tmp2) :
                                ?>
                                    <tr>
                                        <td><?php echo $tmp2->nama_surveyor?></td>
                                        <td><?php echo $tmp2->survey_date?></td>
                                        <td><?php echo $tmp2->survey?></td>
                                        </tr>
                                <?php endforeach?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <?php 
                                    $query = $this->db->query("select * from tb_document order by tb_document.id");
                                    foreach($query->result() as $tmp2):
                                    ?>
                                    <th><?php echo $tmp2->dokumen_name;?></th>
                                    <?php endforeach?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $query = $this->db->query("select tb_document.id id_document,tb_calon_document.id_calon from tb_document left join tb_calon_document on tb_document.id = tb_calon_document.id_document and id_calon = '".$data->id."' order by tb_document.id");
                                    foreach($query->result() as $tmp2):
                                    ?>
                                    <th id="status-<?php echo $data->id?>-<?php echo $tmp2->id_document?>"><?php if($tmp2->id_calon !=""):?>
                                        <a  class="btn btn-success btn-fab btn-sm btn-round"><i class="fa fa-check"></i></a>
                                    <?php else : ?>
                                        <a class="btn btn-danger btn-fab btn-sm btn-round"></a>
                                    </i><?php endif;?></th>
                                    <?php endforeach?>
                                </tbody>
                            </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <h5 class="mb-0">
                    PENILAIAN
                </h5>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Penilaian </th>
                            <th>Bobot</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($penilaian->result() as $tmp):?>
                        <tr>
                            <td><?php echo $tmp->item?></td>
                            <td><?php echo $tmp->bobot?></td>
                            <td>
                                <input type="hidden" name="penilaian_id[]" type="text" value="<?php echo $tmp->id?>"/>
                                <input name="nilai[]" type="number" max="100" value="<?php echo $tmp->nilai?>"/>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <input type="submit" class="btn btn-primary float-right" value="Save"/>
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
        url: "<?php echo base_url()?>calon/penilaian",
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
