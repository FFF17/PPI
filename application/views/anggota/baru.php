<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-icon card-header-primary">
                <div class="card-icon">
                    <i class="material-icons">account_circle</i>
                </div>
                <h4 class="card-title">
                    ANGGOTA
                </h4>
            </div>
            <div class="card-body ">
                <div class="row">   
                    <div class="col-md-12">
                        <table class="table">
                            <thead>                    
                                <tr>
                                    <th>#</th>
                                    <th>nama</th>
                                    <th>no telpn</th>
                                    <th>tanggal registrasi</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0; foreach($data->result() as $tmp) : $i++?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <td><?php echo $tmp->nama?></td>
                                        <td><?php echo $tmp->nomor_telpn;?></td>
                                        <td><?php echo $tmp->register_date;?></td>
                                        <td class="text-center tetx-white">
                                            <a onclick="edit('<?php echo $tmp->id?>')" class="btn btn-primary btn-sm btn-round btn-fab btn-fab-mini"><i class="fa fa-pencil-alt text-white"></i><a>
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
    function edit(id){
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>anggota/input_detail",
            data: { 
                id: id
            }
        }).done(function (msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }
</script>