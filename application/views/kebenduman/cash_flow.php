<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-icon card-header-primary">
                <div class="card-icon">
                    <i class="material-icons">list</i>
                </div>
                <h4 class="card-title">
                    Daftar Transaksi <?php echo $wilayah;?>
                </h4>
            </div>
            <div class="card-body ">
                <div class="row">   
                    <div class="col-md-12">
                        <input type="button" class="btn btn-primary btn-round" value="Uang Masuk" onclick="addCredit()" />
                        <input type="button" class="btn btn-primary btn-round" value="Uang Keluar" onclick="addDebit()" />
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>                    
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                    <th>Deskripsi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0; foreach($data->result() as $tmp) : $i++?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <td><?php echo $tmp->tanggal_transaksi?></td>
                                        <td><?php echo ($tmp->cr=='debit')?@number_format($tmp->nominal,2,',','.'):'';?></td>
                                        <td><?php echo ($tmp->cr=='credit')?@number_format($tmp->nominal,2,',','.'):''?></td>
                                        <td><?php echo $tmp->deskripsi;?></td>
                                        <td class="text-center tetx-white">
                                            <a onclick="getEdit('<?php echo $tmp->id?>')" class="btn btn-primary btn-sm btn-round btn-fab btn-fab-mini"><i class="fa fa-pencil-alt text-white"></i><a>
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
                        <label for="exampleInputEmail1">Type</label>
                        <select class="form-control select" data-style="btn btn-link" name="kabupaten" id="input-cr">
                            <option>debit</option>
                            <option>credit</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal</label>
                        <input id="input-tanggal_pembayaran" type="date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nominal</label>
                        <input id="input-nominal" type="number" class="form-control" required>
                    </div>       
                    <div class="form-group">
                        <label for="exampleInputEmail1">Note</label>
                        <input id="input-keterangan" type="text" class="form-control" required>
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
    var menuName = "iuran";
    var statusText = ["Pending","Sukses","Gagal"];
    function addCredit(){        
        s_id = "0";
        $("#input-cr").val("credit").change();
        $('#modal-add').modal("show");
    }
    function addDebit(){        
        s_id = "0";
        $("#input-cr").val("debit").change();
        $('#modal-add').modal("show");
    }
    $(function(){
        $(".table").DataTable();
        $('.select select').css('width', '100%');
        $(".select").select2();
        $('.select2').css('width', '100%');
        $('.select2').css('margin-bottom', '10px');
        $('.form-control[readonly]').css('background-color', '#FFFFFF');
    });
    
    function doAdd(){        
        $('#modal-add').modal("hide");
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>kebenduman/add_cash_flow",
            data:{
                id:s_id,
                cr: $("#input-cr").val(),
                tanggal_transaksi : $("#input-tanggal_pembayaran").val(),
                deskripsi : $("#input-deskripsi").val(),
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
                goMenu('Input Iuran','kebenduman/iuran');
            }, 1000);
        });
    }
</script>