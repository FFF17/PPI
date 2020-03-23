<?php
$romawi[1] = "I";
$romawi[2] = "II";
$romawi[3] = "III";
$romawi[4] = "IV";
$romawi[5] = "V";
$romawi[6] = "VI";
$romawi[7] = "VII";
$romawi[8] = "VIII";
$romawi[9] = "IX";
$romawi[10] = "X";
$romawi[11] = "XI";
$romawi[12] = "XII";
?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-icon card-header-primary">
                <div class="card-icon">
                    <i class="material-icons">library_books</i>
                </div>
                <h4 class="card-title">
                    SURAT REKOMENDASI
                </h4>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">PROVINSI</label>
                            <select class="form-control select" onchange="pilihProv()" id="provinsi" data-style="btn btn-link" name="provinsi" required>
                                <option value="">ALL </option>
                                <?php foreach ($prov->result() as $tmp) : ?>
                                    <option <?php echo ($tmp->geo_prov_id == $provinsi) ? 'selected' : '' ?> value="<?php echo $tmp->geo_prov_id ?>"><?php echo $tmp->geo_prov_nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">KABUPATEN / KOTA</label>
                            <select class="form-control select" data-style="btn btn-link" id="kabupaten" name="kabupaten_kota">
                                <?= count($kab->result()) <= 1 ? '' : '<option value="">ALL </option>'; ?>
                                <?php foreach ($kab->result() as $tmp) : ?>
                                    <option <?php echo ($tmp->geo_kab_id == $kabupaten) ? 'selected' : '' ?> value="<?php echo $tmp->geo_kab_id ?>"><?php echo $tmp->geo_kab_nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">TANGGAL REKOMENDASI</label>
                            <input type="text" value="<?php echo $tanggal_rekomendasi?>" id="tanggal_rekomendasi" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <a type="button" onclick="add()" class="btn btn-success float-left text-white"><i class="fa fa-plus"></i> Add Surat Tugas</a>
                        <a type="button" onclick="add_tanpa_sk()" class="btn btn-success float-left text-white"><i class="fa fa-plus"></i> Add Tanpa Surat Tugas</a>
                        <input type="button" onclick="doSerach()" class="btn btn-primary float-right" value="search">&nbsp;
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Provinsi</th>
                                    <th>Kabupaten kota</th>
                                    <th>No. Batch</th>
                                    <th>No. SK</th>
                                    <th>Gubernur / Bupati / Wali Kota</th>
                                    <th>Wakil</th>
                                    <th width="15%">Tanggal Rekomendasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                foreach ($data->result() as $tmp) : $i++ ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo @$tmp->geo_prov_nama; ?></td>
                                        <td><?php echo @$tmp->geo_kab_nama; ?></td>
                                        <td>
                                            <?= $tmp->no_batch ?>
                                        </td>
                                        <td>
                                            <?= $tmp->no_rekomendasi ?>
                                        </td>
                                        <td><?php echo $tmp->nama_calon; ?></td>
                                        <td class="text-center"><?= $tmp->nama_pasangan != '' ? $tmp->nama_pasangan : '-'; ?></td>
                                        <td><?= date('d-m-Y', strtotime($tmp->tanggal_rekomendasi)); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $(".select").select2();
        $(".table").DataTable();
        $("#tanggal_rekomendasi").datetimepicker({
            format: 'YYYY-MM-DD',
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
        });
    });

    function pilihProv() {
        $.ajax({
            method: "POST",
            url: "<?php echo site_url() ?>/calon/kabupaten_pemilihan",
            data: {
                provinsi: $("#provinsi").val()
            }
        }).done(function(msg) {
            $("#kabupaten").html(msg);
        });
    }

    function doSerach() {
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo site_url() ?>/sr",
            data: {
                tanggal_rekomendasi: $("#tanggal_rekomendasi").val(),
                provinsi: $("#provinsi").val(),
                kabupaten: $("#kabupaten").val() == 0 ? '' : $("#kabupaten").val(),
            }
        }).done(function(msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }

    function add() {
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo site_url() ?>/sr/add_sk"
        }).done(function(msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }

    function add_tanpa_sk() {
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo site_url() ?>/sr/add_non_sk"
        }).done(function(msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }

    function edit(id) {
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo site_url() ?>/calon/edit_surat_tugas",
            data: {
                id: id
            }
        }).done(function(msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }
</script>