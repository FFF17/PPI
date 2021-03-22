<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-icon card-header-primary">
                <div class="card-icon">
                    <i class="material-icons">list</i>
                </div>
                <h4 class="card-title">
                    Master Data Tagihan
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
                                    <th>Tingkat</th>
                                    <th>Provinsi</th>
                                    <th>Kabupaten</th>
                                    <th>Nama</th>
                                    <th>Nominal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0; foreach($data->result() as $tmp) : $i++?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <td><?php echo $tmp->tingkat?></td>
                                        <td><?php echo $tmp->geo_prov_nama;?></td>
                                        <td><?php echo $tmp->geo_kab_nama;?></td>
                                        <td><?php echo $tmp->nama;?></td>
                                        <td><?php echo @"Rp " . number_format($tmp->nominal,2,',','.');?></td>
                                        <td class="text-center tetx-white">
                                            <a onclick="getEdit('<?php echo $tmp->id?>','<?php echo $tmp->id_user?>')" class="btn btn-primary btn-sm btn-round btn-fab btn-fab-mini"><i class="fa fa-pencil-alt text-white"></i><a>
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
<div class="modal fade" id="modal-add" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-add-title">Tambah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" id="form-add" onsubmit="doAdd();return false;">
                
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input id="input-nama" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Start Pembayaran</label>
                        <input id="input-start" type="date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">End Pembayaran</label>
                        <input id="input-end" type="date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nominal</label>
                        <input id="input-nominal" type="number" class="form-control" required>
                    </div>        
                </div>
            </div>
            <input type="submit" id="btn-add-submit" style="display:none">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button"  class="btn btn-primary" onclick="$('#btn-add-submit').click()">Save</button>
      </div>
    </div>
  </div>
</div>
<script>
    var s_user_id;
    var s_id;    
    var menuName = "master data";
    $(function(){
        $(".table").DataTable();
    });
    function getEdit(id,user_id){
        s_user_id = user_id;
        s_id= id;
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>kebenduman/master_detail",
            data: {
                id: id,
                user_id: user_id
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
            var data = eval("("+msg+")");
            $("#input-nama").val(data.nama);
            $("#input-start").val(data.start_pembayaran);
            $("#input-end").val(data.end_pembayaran);
            $("#input-nominal").val(data.nominal);
            $('#modal-add').modal("show");
            //$(".select").select2();
        });
    }
    function doAdd(){        
        $('#modal-add').modal("hide");
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>kebenduman/master_add",
            data:{
                id:s_id,
                user_id:s_user_id,
                nama: $("#input-nama").val(),
                start_pembayaran : $("#input-start").val(),
                end_pembayaran : $("#input-end").val(),
                nominal : $("#input-nominal").val(),
            }
        }).done(function (msg) {
            processDone();
            $.notify({
                icon: "add_alert",
                message: "Info, <b>"+menuName+" berhasil di simpan</b>"
            }, {
                type: 'success',
                timer: 4000,
                placement: {
                    from: "top",
                    align: "right"
                }
            });
            setTimeout(() => {                
                goMenu('Master Data','kebenduman/master');
            }, 1000);
        });
    }
</script>