<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-icon card-header-primary">
                <div class="card-icon">
                    <i class="material-icons">account_circle</i>
                </div>
                <h4 class="card-title">
                    EVENT
                </h4>
            </div>
            <div class="card-body ">
                <div class="row">   
                    <div class="col-md-12">
                        <input type="button" class="btn btn-primary btn-round" value="Add" onclick="add()" />
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>                    
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Kegiatan</th>
                                    <th>Tempat</th>
                                    <th>Waktu</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0; foreach($data->result() as $tmp) : $i++?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <td><?php echo $tmp->tanggal?></td>
                                        <td><?php echo $tmp->nama;?></td>
                                        <td><?php echo $tmp->tempat;?></td>
                                        <td><?php echo $tmp->jam;?></td>
                                        <td class="text-center tetx-white">
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
        $(".select").select2();
        $(".table").DataTable();
    });

    function add(){
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>event/add"
        }).done(function (msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }
    function edit(id){
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>event/edit",
            data: { 
                id: id
            }
        }).done(function (msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }
    function detail(id){        
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>event/detail",
            data: { 
                id: id,
                provinsi: $("#provinsi").val(),
                kabupaten: $("#kabupaten").val(),
            }
        }).done(function (msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }
    function hapus(id){
        Swal.fire({
            title: 'Hapus data',
            text: "Apakah anda yakin akan meghapus kegiatan?",
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
                    url: "<?php echo base_url()?>event/delete",
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
                            message: "Info, <b>User Deleted</b>"
                        }, {
                            type: 'info',
                            timer: 1000,
                            placement: {
                                from: "top",
                                align: "right"
                            }
                        });
                        goMenu('Kegaitan', 'event');
                    }
                });
            }
        });
    }
</script>