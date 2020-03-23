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
                    SURAT TUGAS
                </h4>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">JENIS SURAT TUGAS</label>
                            <select class="form-control select" id="jenis_surat_tugas" data-style="btn btn-link" name="jenis_surat_tugas" required>
                                <option value="">ALL </option>
                                <option <?= $jenis == 'individu' ? 'selected' : ''; ?> value="individu">INDIVIDU</option>
                                <option <?= $jenis == 'pasangan' ? 'selected' : ''; ?> value="pasangan">PASANGAN</option>
                            </select>
                        </div>
                    </div>
                </div>
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
                        <a type="button" onclick="add()" class="btn btn-success float-left text-white"><i class="fa fa-plus"></i> Add</a>
                    </div>
                    <div class="col-md-6">
                        <input type="button" onclick="doSerach()" class="btn btn-primary float-right" value="search">&nbsp;
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Provinsi</th>
                                    <th>Kabupaten kota</th>
                                    <th>No. Surat</th>
                                    <th>Nama</th>
                                    <th class="text-center">Pasangan</th>
                                    <th>Sebagai</th>
                                    <th width="15%">Exp. Date</th>
                                    <th>Print</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                foreach ($calon->result() as $tmp) : $i++ ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $tmp->geo_prov_nama; ?></td>
                                        <td><?php echo $tmp->geo_kab_nama; ?></td>
                                        <td>
                                            <?= $noSurat = $tmp->no_surat_tugas . '/TPP/DPP-HANURA/' . $romawi[date('n', strtotime($tmp->start_date))] . '/' . date('Y', strtotime($tmp->start_date)); ?>
                                        </td>
                                        <td><?php echo $tmp->nama; ?></td>
                                        <td class="text-center"><?= $tmp->nama_pasangan != '' ? $tmp->nama_pasangan : '-'; ?></td>
                                        <td><?php echo @$tingkat[$tmp->mencalonkan]; ?></td>
                                        <td><?= date('d-m-Y', strtotime('+' . $tmp->masa_berlaku . ' days', strtotime($tmp->start_date))); ?></td>
                                        <td class="text-center tetx-white">
                                            <a href="<?= base_url(); ?>calon/surat_tugas_create_pdf/<?php echo $tmp->id ?>/<?php echo $tmp->jenis_surat_tugas ?><?= $tmp->jenis_surat_tugas == 'pasangan' ? '/' . $tmp->id_pasangan : '' ?>" class="btn btn-info btn-sm btn-round btn-fab btn-fab-mini" target="blank"><i class="fa fa-print text-white"></i><a>
                                                    <a onclick="edit('<?php echo $tmp->id ?>')" class="btn btn-warning btn-sm btn-round btn-fab btn-fab-mini"><i class="fa fa-edit text-white"></i><a>
                                        </td>
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
    });

    function pilihProv() {
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>calon/kabupaten_pemilihan",
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
            url: "<?php echo base_url() ?>calon/surat_tugas",
            data: {
                jenis: $("#jenis_surat_tugas").val(),
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
            url: "<?php echo base_url() ?>calon/add_surat_tugas",
            data: {
                jenis: $("#jenis_surat_tugas").val(),
                provinsi: $("#provinsi").val(),
                kabupaten: $("#kabupaten").val() == 0 ? '' : $("#kabupaten").val(),
            }
        }).done(function(msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }

    function edit(id) {
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>calon/edit_surat_tugas",
            data: {
                id: id
            }
        }).done(function(msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }
</script>