<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-icon card-header-primary">
                <div class="card-icon">
                    <i class="material-icons">library_books</i>
                </div>
                <h4 class="card-title">
                    SURVEY
                </h4>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-12">
                        <a type="button" onclick="add()" class="btn btn-success float-left text-white"><i class="fa fa-plus"></i> Add</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Provinsi</th>
                                    <th>Kabupaten kota</th>
                                    <th>Nama Surveyor</th>
                                    <th>Tanggal Survey</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                foreach ($data->result() as $tmp) : $i++ ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $tmp->geo_prov_nama; ?></td>
                                        <td><?php echo $tmp->geo_kab_nama; ?></td>
                                        <td><?php echo $tmp->nama_surveyor; ?></td>
                                        <td><?php echo $tmp->survey_date; ?></td>
                                        <td class="text-center tetx-white">
                                            <a onclick="view('<?php echo $tmp->id ?>')" class="btn btn-info btn-sm btn-round btn-fab btn-fab-mini"><i class="fa fa-eye text-white"></i><a>
                                                    <a onclick="edit('<?php echo $tmp->id ?>')" class="btn btn-warning btn-sm btn-round btn-fab btn-fab-mini"><i class="fa fa-edit text-white"></i><a>
                                                            <a onclick="hapus('<?php echo $tmp->id ?>')" class="btn btn-danger btn-sm btn-round btn-fab btn-fab-mini"><i class="fa fa-trash text-white"></i><a>
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

    function add() {
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>calon/form_survey",
            data: {}
        }).done(function(msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }

    function edit(id) {
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>calon/edit_survey",
            data: {
                id_survey: id
            }
        }).done(function(msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }

    function view(id) {
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>calon/view_survey",
            data: {
                id_survey: id
            }
        }).done(function(msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }

    function hapus(id) {
        Swal.fire({
            title: 'Hapus data',
            text: "Apakah anda yakin akan meghapus Survey?",
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
                    url: "<?php echo base_url() ?>calon/delete_survey",
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
                            message: "Info, <b>Survey Deleted</b>"
                        }, {
                            type: 'info',
                            timer: 1000,
                            placement: {
                                from: "top",
                                align: "right"
                            }
                        });
                        goMenu('Survey', 'calon/survey');
                    }
                });
            }
        });
    }
</script>