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
                        <?php if ($this->session->role != "user" && $this->session->role != "tpp" && $this->session->role != "sk") : ?>
                            <a type="button" onclick="approve_all()" class="btn btn-success float-left text-white"><i class="fa fa-check text-white"></i> Approve All</a>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <?php if ($this->session->role != "user" && $this->session->role != "tpp" && $this->session->role != "sk") : ?>
                                        <th>#</th>
                                    <?php endif ?>
                                    <th>Sebagai</th>
                                    <th>Provinsi</th>
                                    <th>Kabupaten kota</th>
                                    <th>Nama</th>
                                    <th>Telepon</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                foreach ($calon->result() as $tmp) : $i++ ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <?php if ($this->session->role != "user" && $this->session->role != "tpp" && $this->session->role != "sk") : ?>

                                            <td>
                                                <?php if ($tmp->status == 0) : ?>
                                                    <input type="checkbox" name="ck_id" id="ck_<?php echo $tmp->id ?>" value="<?php echo $tmp->id ?>" />
                                                <?php endif; ?>
                                            </td>
                                        <?php endif ?>
                                        <td><?php echo @$tingkat[$tmp->mencalonkan]; ?></td>
                                        <td><?php echo $tmp->geo_prov_nama; ?></td>
                                        <td><?php echo $tmp->geo_kab_nama; ?></td>
                                        <td><?php echo $tmp->nama; ?></td>
                                        <td><?php echo $tmp->telp; ?></td>
                                        <td><?php echo $tmp->email; ?></td>
                                        <td class="text-center tetx-white">
                                            <a onclick="detail('<?php echo $tmp->id ?>')" class="btn btn-info btn-sm btn-round btn-fab btn-fab-mini"><i class="fa fa-eye text-white"></i><a>

                                                    <?php if ($tmp->file_individu && $tmp->file_pasangan) : ?>
                                                        <button class="btn btn-default btn-sm btn-round btn-fab btn-fab-mini" onclick="printFile('<?= $tmp->file_individu ?>', '<?= $tmp->file_pasangan ?>')"><i class="fa fa-print"></i></button>
                                                    <?php elseif ($tmp->file_individu) : ?>
                                                        <a href="<?= base_url('file/' . $tmp->file_individu); ?>" class="btn btn-default btn-sm btn-round btn-fab btn-fab-mini" target="_blank"><i class="fa fa-print"></i></a>
                                                    <?php elseif ($tmp->file_pasangan) : ?>
                                                        <a href="<?= base_url('file/' . $tmp->file_pasangan); ?>" class="btn btn-default btn-sm btn-round btn-fab btn-fab-mini" target="_blank"><i class="fa fa-print"></i></a>
                                                    <?php endif; ?>

                                                    <?php if ($this->session->role == "user" || $this->session->role == "admin") : ?>
                                                        <a onclick="edit('<?php echo $tmp->id ?>')" class="btn btn-primary btn-sm btn-round btn-fab btn-fab-mini"><i class="fa fa-edit text-white"></i><a>
                                                            <?php endif; ?>

                                                            <?php if ($this->session->role != "user" && $this->session->role != "tpp" && $this->session->role != "sk") : ?>
                                                                <a onclick="hapus('<?php echo $tmp->id ?>')" class="btn btn-danger btn-sm btn-round btn-fab btn-fab-mini"><i class="fa fa-trash text-white"></i><a>
                                                                        <?php if ($tmp->status == 0) : ?>
                                                                            <a id="btn_approve_<?php echo $tmp->id ?>" onclick="approve('<?php echo $tmp->id ?>')" class="btn btn-success btn-sm btn-round btn-fab btn-fab-mini"><i class="fa fa-check text-white"></i><a>
                                                                                <?php endif; ?>
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
            url: "<?php echo base_url() ?>index.php/register/kabupaten",
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

    function detail(id) {
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>calon/detail",
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

    function edit(id) {
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>calon/edit",
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

    function hapus(id) {
        Swal.fire({
            title: 'Hapus data',
            text: "Apakah anda yakin akan meghapus calon?",
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
                    url: "<?php echo base_url() ?>calon/delete",
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
                            message: "Info, <b>Calon Deleted</b>"
                        }, {
                            type: 'info',
                            timer: 1000,
                            placement: {
                                from: "top",
                                align: "right"
                            }
                        });
                        goMenu('LIST PENDAFTARAN CALON KEPALAH DAERAH', 'calon/pendaftar')
                    }
                });
            }
        });
    }

    function approve_all() {
        var output = $.map($('input[name="ck_id"]:checked'), function(n, i) {
            return n.value;
        }).join(',');
        if (output != "") {
            Swal.fire({
                title: 'Approve All Calon',
                text: "Apakah anda yakin akan mengapprove all calon?",
                type: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Approve'
            }).then((result) => {
                if (result.value) {
                    processStart();
                    $.ajax({
                        method: "POST",
                        url: "<?php echo site_url() ?>/calon/approve_all",
                        data: {
                            id: output
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
                                message: "Info, <b>Calon Approved</b>"
                            }, {
                                type: 'info',
                                timer: 1000,
                                placement: {
                                    from: "top",
                                    align: "right"
                                }
                            });
                            var tmp = output.split(",");
                            for (var i = 0; i < tmp.length; i++) {
                                $("#btn_approve_" + tmp[i]).hide();
                                $("#ck_" + tmp[i]).hide();
                            }
                        }
                    });
                }
            });
        }
    }

    function approve(id) {
        Swal.fire({
            title: 'Approve calon',
            text: "Apakah anda yakin akan mengapprove calon?",
            type: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Approve'
        }).then((result) => {
            if (result.value) {
                processStart();
                $.ajax({
                    method: "POST",
                    url: "<?php echo site_url() ?>/calon/approve",
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
                            message: "Info, <b>Calon Approved</b>"
                        }, {
                            type: 'info',
                            timer: 1000,
                            placement: {
                                from: "top",
                                align: "right"
                            }
                        });
                        $("#btn_approve_" + id).hide();
                        $("#ck_" + id).hide();
                    }
                });
            }
        });
    }
</script>