<div class="row">
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
                                    <th>Tanggal</th>
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
                                        <td><?php echo $tmp->tanggal_pembayaran;?></td>
                                        <td><?php echo @"Rp " . number_format($tmp->nominal,2,',','.');?></td>
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
                        <label for="exampleInputEmail1">Provinsi</label>
                        <select class="form-control select" data-style="btn btn-link" name="provinsi" id="input-provinsi" onchange="changeProvinsi()">
                        <option value='' disabled selected>Pilih Provinsi</option>
                        <?php foreach($prov->result() as $tmp):?>
                        <option value="<?php echo $tmp->geo_prov_id;?>"><?php echo $tmp->geo_prov_nama;?></option>
                        <?php endforeach?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kabupaten</label>
                        <select class="form-control select" data-style="btn btn-link" name="kabupaten" id="input-kabupaten" onchange="changeKabupaten()">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <select class="form-control select" data-style="btn btn-link" name="kabupaten" id="input-nama" onchange="getKekurangan()">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kekurangan</label>
                        <input id="input-tagihan" type="number" class="form-control" required>
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

<div class="modal fade" id="modal-view" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-add-title">View</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" id="form-add" onsubmit="doAdd();return false;">                
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Provinsi</label>                        
                        <input id="view-provinsi" type="text" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kabupaten</label>
                        <input id="view-kabupaten" type="text" class="form-control" readonly>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input id="view-nama" type="text" class="form-control" readonly>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal</label>
                        <input id="view-tanggal_pembayaran" type="text" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nominal</label>
                        <input id="view-nominal" type="text" class="form-control" readonly>
                    </div>       
                    <div class="form-group">
                        <label for="exampleInputEmail1">Note</label>
                        <input id="view-keterangan" type="text" class="form-control" readonly>
                    </div> 
                </div>                    
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal Rekonsiliasi</label>
                        <input id="view-tanggal_rekonsiliasi" type="text" class="form-control" readonly>
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputEmail1">Status</label>
                        <input id="view-status" type="text" class="form-control" readonly>
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputEmail1">Note</label>
                        <input id="view-keterangan2" type="text" class="form-control" readonly>
                    </div> 
                </div>
            </div>
            <input type="submit" id="btn-add-submit" style="display:none">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
    var s_user_id;
    var s_id;    
    var menuName = "iuran";
    var statusText = ["Pending","Sukses","Gagal"];
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
        $('.form-control[readonly]').css('background-color', '#FFFFFF');
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
            $("#view-provinsi").val(data.geo_prov_nama);
            $("#view-kabupaten").val(data.geo_kab_nama);
            $("#view-nama").val(data.nama);
            $("#view-tanggal_pembayaran").val(data.tanggal_pembayaran);
            $("#view-nominal").val(data.nominal);
            $("#view-status").val(statusText[data.status]);
            $("#view-keterangan").val(data.keterangan);
            $("#view-tanggal_rekonsiliasi").val(data.tanggal_rekonsiliasi);
            $("#view-keterangan2").val(data.keterangan2);
            $('#modal-view').modal("show");
            //$(".select").select2();
        });
    }
    function doAdd(){        
        $('#modal-add').modal("hide");
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>kebenduman/iuran_add",
            data:{
                id:s_id,
                user_id: $("#input-nama").val(),
                tanggal_pembayaran : $("#input-tanggal_pembayaran").val(),
                keterangan : $("#input-keterangan").val(),
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