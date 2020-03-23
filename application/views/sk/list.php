<div class="row">

    <div class="col-lg-6 col-md-6">
        <div class="card">
            <div class="card-header card-header-icon card-header-primary">
                <div class="card-icon" style="background:#EE9B21">
                <h2>TPD</h2>
                </div>
                <div class="card-title" style="text-align:right">
                    <h1><b><?php echo $total_sk_tpd?> / <?php echo $total_tpd?></b></h1>
                </div>
            </div>
            <div class="card-body">
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="card">
            <div class="card-header card-header-icon card-header-primary">
                <div class="card-icon" style="background:#EE9B21">
                <h2>TPC</h2>
                </div>
                <div class="card-title" style="text-align:right">
                    <h1><b><?php echo $total_sk_tpc?> / <?php echo $total_tpc?></b></h1>
                </div>
            </div>
            <div class="card-body">
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-icon card-header-primary">
                <div class="card-icon">
                    <i class="material-icons">library_books</i>
                </div>
                <h4 class="card-title">
                    SK
                </h4>
            </div>
            <div class="card-body ">
                <div class="row">   
                    <div class="co-md-12"><a class="btn btn-primary" onclick="add()">add</a></div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Provinsi</th>
                                    <th>Kabupaten</th>
                                    <th>NO SK</th>
                                    <th>Ketua</th>
                                    <th>Sekretaris</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0; foreach($data->result() as $tmp) : $i++?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <td><?php echo $tmp->geo_prov_nama?></td>
                                        <td><?php echo $tmp->geo_kab_nama;?></td>
                                        <td><?php echo $tmp->no_sk;?></td>
                                        <td><?php echo strtoupper($tmp->ketua)?></td>
                                        <td><?php echo strtoupper($tmp->seketaris)?></td>
                                        <td class="text-center tetx-white">
                                            <?php if($tmp->dokumen!=""):?>
                                            <a href="<?php base_url()?>file/<?php echo $tmp->dokumen?>" class="btn btn-default btn-sm btn-round btn-fab btn-fab-mini"><i class="fa fa-file-pdf text-white"></i><a>                                           
                                            <?php endif;?>
                                            <a onclick="edit('<?php echo $tmp->id?>')" class="btn btn-primary btn-sm btn-round btn-fab btn-fab-mini"><i class="fa fa-pencil-alt text-white"></i><a>
                                            <a onclick="hapus('<?php echo $tmp->id?>')" class="btn btn-danger btn-sm btn-round btn-fab btn-fab-mini"><i class="fa fa-trash text-white"></i><a>
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
    $(function(){
        $(".table").DataTable();
    });
    function add(){
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>sk/add"
        }).done(function (msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }
    function edit(id){
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>sk/edit",
            data: { 
                id: id
            }
        }).done(function (msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }
    function hapus(id){
        Swal.fire({
            title: 'Hapus data',
            text: "Apakah anda yakin akan meghapus SK?",
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
                    url: "<?php echo base_url()?>sk/delete",
                    data: {
                        id: id
                    },
                    statusCode: {
                        404: function () {
                            processDone();
                            showError("404 Page not found");
                        },
                        500: function () {
                            processDone();
                            showError("500 Please contact IT Support");
                        }
                    },
                }).done(function (msg) {
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
                            message: "Info, <b>SK Deleted</b>"
                        }, {
                            type: 'info',
                            timer: 1000,
                            placement: {
                                from: "top",
                                align: "right"
                            }
                        });
                        goMenu('SK', 'sk');
                    }
                });
            }
        });
    }
</script>