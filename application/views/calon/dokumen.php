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
                                    <th width="5">#</th>
                                    <th width="35%">Nama</th>
                                    <th width="20">Sebagai</th>
                                    <?php
                                    $query = $this->db->query("select * from tb_document order by tb_document.id");
                                    foreach ($query->result() as $tmp) :
                                    ?>
                                        <th width="10%"><?php echo $tmp->dokumen_name; ?></th>
                                    <?php endforeach ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                foreach ($calon->result() as $tmp) : $i++ ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $tmp->nama; ?></td>
                                        <td><?php echo @$tingkat[$tmp->mencalonkan]; ?></td>
                                        <?php
                                        $query = $this->db->query("SELECT
                                                                        tb_document.id id_document,
                                                                        tb_calon_document.id_calon,
                                                                        tb_calon_document.tgl_kirim,
                                                                        tb_calon_document.kirim_by
                                                                    FROM
                                                                        tb_document
                                                                        LEFT JOIN tb_calon_document ON tb_document.id = tb_calon_document.id_document 
                                                                        AND id_calon = '" . $tmp->id . "' 
                                                                    ORDER BY
                                                                        tb_document.id");
                                        foreach ($query->result() as $tmp2) :
                                        ?>
                                            <th id="status-<?php echo $tmp->id ?>-<?php echo $tmp2->id_document ?>">
                                                <div class="card pl-2 pr-2">
                                                    <?php if ($tmp2->id_calon != "") : ?>
                                                        <input type="text" disabled class="form-control" value="<?= $tmp2->tgl_kirim; ?>">
                                                        <input type="text" disabled class="form-control" value="<?= $tmp2->kirim_by; ?>">

                                                        <a onclick="uncek_dokumen(<?php echo $tmp2->id_document ?>,<?php echo $tmp2->id_calon ?>)" class="btn btn-success btn-fab btn-sm btn-round"><i class="fa fa-check"></i></a>
                                                    <?php else : ?>
                                                        <input type="date" name="tgl_kirim<?= $tmp->id . $tmp2->id_document; ?>" id="tgl_kirim<?= $tmp->id . $tmp2->id_document; ?>" class="form-control">
                                                        <input type="text" name="kirim_by<?= $tmp->id . $tmp2->id_document; ?>" id="kirim_by<?= $tmp->id . $tmp2->id_document; ?>" class="form-control" placeholder="Pengirim">

                                                        <a onclick="cek_dokumen(<?php echo $tmp2->id_document ?>,<?php echo $tmp->id ?>)" class="btn btn-danger btn-fab btn-sm btn-round"></a>
                                                        </i>
                                                    <?php endif; ?>
                                                </div>
                                            </th>
                                        <?php endforeach ?>
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
            url: "<?php echo base_url() ?>index.php/calon/kabupaten_pemilihan",
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
            url: "<?php echo base_url() ?>calon/dokumen",
            data: {
                provinsi: $("#provinsi").val(),
                kabupaten: $("#kabupaten").val(),
            }
        }).done(function(msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }

    function cek_dokumen(id_dokumen, id_calon) {
        if ($('#tgl_kirim' + id_calon + id_dokumen).val() == "") {
            swal("Silahkan pilih tanggal kirim");
        } else if ($('#kirim_by' + id_calon + id_dokumen).val() == "") {
            swal("Silahkan isi nama pengirim");
        } else {
            var tgl_kirim = $('#tgl_kirim' + id_calon + id_dokumen).val();
            var kirim_by = $('#kirim_by' + id_calon + id_dokumen).val();
            processStart();
            $.ajax({
                method: "POST",
                url: "<?php echo site_url() ?>/calon/cek_document",
                data: {
                    id_dokumen: id_dokumen,
                    id_calon: id_calon,
                    tgl_kirim: tgl_kirim,
                    kirim_by: kirim_by
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
                        message: "Info, <b>Document Checked</b>"
                    }, {
                        type: 'info',
                        timer: 1000,
                        placement: {
                            from: "top",
                            align: "right"
                        }
                    });
                    $("#status-" + id_calon + "-" + id_dokumen).html(`
                    <div class="card pl-2 pr-2">
                        <input type="text" disabled class="form-control" value="` + tgl_kirim + `">
                        <input type="text" disabled class="form-control" value="` + kirim_by + `">

                        <a onclick="uncek_dokumen('` + id_dokumen + `','` + id_calon + `')" class="btn btn-success btn-fab btn-sm btn-round"><i class="fa fa-check"></i></a>
                    </div>
                    `);
                }
            });
        }
    }

    function uncek_dokumen(id_dokumen, id_calon) {
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo site_url() ?>/calon/uncek_document",
            data: {
                id_dokumen: id_dokumen,
                id_calon: id_calon
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
                    message: "Info, <b>Document UnChecked</b>"
                }, {
                    type: 'info',
                    timer: 1000,
                    placement: {
                        from: "top",
                        align: "right"
                    }
                });
                $("#status-" + id_calon + "-" + id_dokumen).html(`
                <div class="card pl-2 pr-2">
                    <input type="date" name="tgl_kirim` + id_calon + id_dokumen + `" id="tgl_kirim` + id_calon + id_dokumen + `" class="form-control">
                    <input type="text" name="kirim_by` + id_calon + id_dokumen + `" id="kirim_by` + id_calon + id_dokumen + `" class="form-control" placeholder="Pengirim">

                    <a onclick="cek_dokumen('` + id_dokumen + `','` + id_calon + `')" class="btn btn-danger btn-fab btn-sm btn-round"></a>
                    </i>
                </div>
                `);
            }
        });
    }
</script>