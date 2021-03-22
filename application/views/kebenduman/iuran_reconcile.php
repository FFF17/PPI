<?php
$status[0] = "Pending";
$status[1] = "Sukses";
$status[2] = "Gagal";
?><div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-icon card-header-primary">
                <div class="card-icon">
                    <i class="material-icons">list</i>
                </div>
                <h4 class="card-title">
                    Daftar Iuran
                </h4>
            </div>
            <div class="card-body ">
                <div class="row">   
                    <div class="col-md-12">
                        <table class="table">
                            <thead>                    
                                <tr>
                                    <th>#</th>
                                    <th>Tingkat</th>
                                    <th>Provinsi</th>
                                    <th>Kabupaten</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Nominal</th>
                                    <th>Rekonsiliasi</th>
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
                                        <td><?php echo $tmp->tanggal_pembayaran;?></td>
                                        <td><?php echo @"Rp " . number_format($tmp->nominal,2,',','.');?></td>
                                        <td><?php echo @$status[$tmp->status];?></td>
                                        <td class="text-center tetx-white">        
                                            <?php if($tmp->status=="0"):?>                                    
                                            <a onclick="getEdit('<?php echo $tmp->id?>')" class="btn btn-primary btn-sm btn-round btn-fab btn-fab-mini"><i class="fa fa-pencil-alt text-white"></i><a>
                                            <?php endif;?>
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
                        <input id="input-nama" type="text" class="form-control" readonly>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal</label>
                        <input id="input-tanggal_pembayaran" type="date" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nominal</label>
                        <input id="input-nominal" type="number" class="form-control" readonly>
                    </div>       
                    <div class="form-group">
                        <label for="exampleInputEmail1">Note</label>
                        <input id="input-keterangan" type="text" class="form-control" readonly>
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputEmail1">Status</label>
                        <select  class="form-control select" data-style="btn btn-link" name="kabupaten" id="input-status">
                            <option value="1">Sukses</option>
                            <option value="2">Gagal</option>
                        </select>
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputEmail1">Note</label>
                        <input id="input-keterangan2" type="text" class="form-control" required>
                    </div> 
                </div>
            </div>
            <input type="submit" id="btn-add-submit" style="display:none">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button"  class="btn btn-primary" onclick="$('#btn-add-submit').click()">Reconcile</button>
      </div>
    </div>
  </div>
</div>
<script>
    var s_user_id;
    var s_id;    
    var menuName = "rekonsiliasi";
    function add(){        
        s_id = "0";
        $('#modal-add').modal("show");
    }
    $(function(){
        $(".table").DataTable();
        $('.select select').css('width', '100%');
        $(".select").select2();
        $('.select2').css('width', '100%');
        $('.select2').css('margin-bottom', '10px');
    });
    function getEdit(id){
        s_id= id;
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>kebenduman/pembayaran_detail",
            data: {
                id: id,
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
            $("#input-tanggal_pembayaran").val(data.tanggal_pembayaran);
            $("#input-nominal").val(data.nominal);
            $("#input-status").val(data.status);
            $("#input-keterangan").val(data.keterangan);
            $('#modal-add').modal("show");
            //$(".select").select2();
        });
    }
    function doAdd(){        
        $('#modal-add').modal("hide");
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>kebenduman/iuran_reconsile_save",
            data:{
                id:s_id,
                keterangan : $("#input-keterangan2").val(),
                status : $("#input-status").val(),
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
                goMenu('Rekonsiliasi','kebenduman/iuran_reconcile')
            }, 1000);
        });
    }
    function changeProvinsi(){
        $.ajax({
            method: "POST",
            data:{
                geo_prov_id:$("#input-provinsi").val()
            },
            url: "<?php echo site_url()?>/kebenduman/get_kabupaten"
        }).done(function (msg) {
            $("#input-kabupaten").html(msg);
        });
    }
    function changeKabupaten(){
        $.ajax({
            method: "POST",
            data:{
                geo_prov_id:$("#input-provinsi").val(),
                geo_kab_id:$("#input-kabupaten").val(),
            },
            url: "<?php echo site_url()?>/kebenduman/get_bio"
        }).done(function (msg) {
            $("#input-nama").html(msg);
        });
    }
    function getKekurangan(){
        $.ajax({
            method: "POST",
            data:{
                bio_id:$("#input-nama").val(),
            },
            url: "<?php echo site_url()?>/kebenduman/get_tagihan"
        }).done(function (msg) {
            var data = eval('('+msg+')');
            $("#input-tagihan").val(data.tagihan);
        });
    }
</script>