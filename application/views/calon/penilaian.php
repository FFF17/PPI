<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-icon card-header-primary">
                <div class="card-icon">
                    <i class="material-icons">library_books</i>
                </div>
                <h4 class="card-title">
                    PENDAFTAR
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
                                <option value="">ALL </option>
                                <?php foreach ($kab->result() as $tmp) : ?>
                                    <option <?php echo ($tmp->geo_kab_id == $kabupaten) ? 'selected' : '' ?> value="<?php echo $tmp->geo_kab_id ?>"><?php echo $tmp->geo_kab_nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="button" onclick="doSerach()" class="btn btn-primary float-left" value="search">&nbsp;
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Sebagai</th>
                                    <th>Provinsi</th>
                                    <th>Kabupaten kota</th>
                                    <th>Nama</th>
                                    <th>Nilai</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                foreach ($calon->result() as $tmp) : $i++ ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo @$tingkat[$tmp->mencalonkan]; ?></td>
                                        <td><?php echo $tmp->geo_prov_nama; ?></td>
                                        <td><?php echo $tmp->geo_kab_nama; ?></td>
                                        <td><?php echo $tmp->nama; ?></td>
                                        <td><?php echo $tmp->nilai; ?></td>
                                        <td class="text-center text-white">
                                            <a onclick="penilaian('<?php echo $tmp->id ?>')" class="btn btn-primary btn-sm btn-round btn-fab btn-fab-mini"><i class="fa fa-pencil-alt text-white"></i><a>

                                                    <?php if ($tmp->file_individu && $tmp->file_pasangan) : ?>
                                                        <button class="btn btn-default btn-sm btn-round btn-fab btn-fab-mini" onclick="printFile('<?= $tmp->file_individu ?>', '<?= $tmp->file_pasangan ?>')"><i class="fa fa-print"></i></button>
                                                    <?php elseif ($tmp->file_individu) : ?>
                                                        <a href="<?= base_url('file/' . $tmp->file_individu); ?>" class="btn btn-default btn-sm btn-round btn-fab btn-fab-mini" target="_blank"><i class="fa fa-print"></i></a>
                                                    <?php elseif ($tmp->file_pasangan) : ?>
                                                        <a href="<?= base_url('file/' . $tmp->file_pasangan); ?>" class="btn btn-default btn-sm btn-round btn-fab btn-fab-mini" target="_blank"><i class="fa fa-print"></i></a>
                                                    <?php endif; ?>

                                                    <?php if (isset($tmp->nilai)) : ?>
                                                        <a onclick="delete_penilaian('<?php echo $tmp->id ?>')" class="btn btn-danger btn-sm btn-round btn-fab btn-fab-mini"><i class="fa fa-trash text-white"></i><a>
                                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <!-- Modal -->
                        <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">File Surat Tugas</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <a id="file_individu" target="blank" class="btn btn-primary">Individu</a>
                                        <a id="file_pasangan" target="blank" class="btn btn-primary">Pasangan</a>
                                    </div>
                                    <div class="modal-footer">
                                    </div>
                                </div>
                            </div>
                        </div>

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

    function printFile(fileIndividu, filePasangan) {
        $('#printModal').modal('show');
        $('#file_individu').attr('href', 'file/' + fileIndividu);
        $('#file_pasangan').attr('href', 'file/' + filePasangan);
    }

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
            url: "<?php echo base_url() ?>calon/penilaian",
            data: {
                provinsi: $("#provinsi").val(),
                kabupaten: $("#kabupaten").val(),
            }
        }).done(function(msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }

    function penilaian(id) {
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>calon/form_penilaian",
            data: {
                id: id,
                provinsi: $("#provinsi").val(),
                kabupaten: $("#kabupaten").val(),
            }
        }).done(function(msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }

    function delete_penilaian(id) {
        Swal.fire({
            title: 'Hapus data',
            text: "Apakah anda yakin akan meghapus penilaian?",
            type: 'error',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus'
        }).then((result) => {
            if (result.value) {
                processStart();
                $.ajax({
                    method: "POST",
                    url: "<?php echo base_url() ?>calon/delete_penilaian",
                    data: {
                        id: id
                    },
                    statusCode: {
                        404: function() {
                            processDone();
                            showError("404 Page not found");
                        },
                        500: function() {
                            processDone();
                            showError("500 Please contact IT Support");
                        }
                    },
                }).done(function(msg) {
                    processDone();
                    if (msg != "") {
                        $.notify({
                            icon: "add_alert",
                            message: "Warning, <b>" + msg + "</b>"
                        }, {
                            type: 'danger',
                            timer: 4000,
                            placement: {
                                from: "top",
                                align: "right"
                            }
                        });
                    } else {
                        $.notify({
                            icon: "add_alert",
                            message: "Info, <b>Penilaian Deleted</b>"
                        }, {
                            type: 'info',
                            timer: 1000,
                            placement: {
                                from: "top",
                                align: "right"
                            }
                        });
                        goMenu('Penilaian', 'calon/penilaian');
                    }
                });
            }
        });
    }
</script>