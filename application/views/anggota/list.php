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
                    <button type="button" id="btnView" class="btn btn-primary" data-toggle="modal" data-target="#modalView" style="display:none"></button>
                    <div class="col-md-2">Provinsi</div>
                    <div class="col-md-3">                    
                        <select class="form-control select" data-style="btn btn-link" name="provinsi" id="provinsi" onchange="changeProvinsi()">
                            <?php foreach($prov->result() as $tmp):?>
                            <option  <?php echo ($tmp->kode == $provinsi)?"selected":""?> value="<?php echo $tmp->kode;?>"><?php echo $tmp->provinsi;?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                    <div class="col-md-2">Kabupaten</div>
                    <div class="col-md-3">                    
                        <select class="form-control select" data-style="btn btn-link" name="kabupaten" id="kabupaten">
                        <?php if(isset($kab)):?> 
                            <?php foreach($kab->result() as $tmp):?>
                            <option <?php echo ($tmp->kode == $kabupaten)?"selected":""?> value="<?php echo $tmp->kode;?>"><?php echo $tmp->kabupaten;?></option>
                            <?php endforeach?>
                        <?php endif;?>
                        </select>
                    </div>
                    <div class="col-md-2" style="text-align:right">
                        <button class="btn btn-primary" onclick="doSearch()">Search</button>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>                    
                                <tr>
                                    <th>#</th>
                                    <th>nomor anggota</th>
                                    <th>nama</th>
                                    <th>no telpn</th>
                                    <th>email</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0; foreach($data->result() as $tmp) : $i++?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <td><?php echo $tmp->nomor_anggota;?></td>
                                        <td><?php echo $tmp->nama?></td>
                                        <td><?php echo $tmp->nomor_telpn;?></td>
                                        <td><?php echo $tmp->email;?></td>
                                        <td class="text-center tetx-white">
                                            <?php if($tmp->foto_ktp !="/foto/"){?>
                                            <a onclick="view_image('<?php echo $tmp->foto_ktp?>')" class="btn btn-primary btn-sm btn-round btn-fab btn-fab-mini"><i class="fa fa-image text-white"></i><a>
                                            <?php }?>
                                            <a onclick="view('<?php echo $tmp->id?>')" class="btn btn-primary btn-sm btn-round btn-fab btn-fab-mini"><i class="fa fa-eye text-white"></i><a>
                                            <a onclick="set_jabatan('<?php echo $tmp->id?>')" class="btn btn-primary btn-sm btn-round btn-fab btn-fab-mini"><i class="fa fa-user text-white"></i><a>
                                            <a onclick="edit('<?php echo $tmp->id?>')" class="btn btn-success btn-sm btn-round btn-fab btn-fab-mini"><i class="fa fa-pencil-alt text-white"></i><a>
                                            <a onclick="openModalPrint(<?php echo $tmp->id ?>)" class="btn btn-info btn-sm btn-round btn-fab btn-fab-mini"><i class="fa fa-print text-white"></i><a>
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
<div class="modal fade" id="modal-print">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-2">
                <label class="text-dark">Pilih dokumen yang akan di print : </label>
                <br>
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" id="kta" value="kta">
                        KTA
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" id="ktp" value="ktp">
                        KTP
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>
                <input type="hidden" id="id-item">
                <br>
                <button class="btn btn-primary mt-2 ml-0" onclick="printDoc()">
                    PRINT
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modalView" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Foto KTP</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src"" id="image_view" style="width:100%"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
    $(function(){
        $(".select").select2();
        $(".table").DataTable();
    });    
    function doSearch(){    
        $.ajax({
            method: "POST",
            data:{
                provinsi:$("#provinsi").val(),
                kabupaten:$("#kabupaten").val(),
            },
            url: "<?php echo site_url()?>/anggota/list_data"
        }).done(function (msg) {
            $("#page-content").html(msg);
        });
    }
    function changeProvinsi(){
        $.ajax({
            method: "POST",
            data:{
                geo_prov_id:$("#provinsi").val()
            },
            url: "<?php echo site_url()?>/anggota/get_kabupaten"
        }).done(function (msg) {
            $("#kabupaten").html(msg);
        });
    }
    function view(id){
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>anggota/view",
            data: { 
                id: id
            }
        }).done(function (msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }
       function set_jabatan(id){
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>anggota/set_jabatan",
            data: { 
                id: id
            }
        }).done(function (msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }
    function edit(id){
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>anggota/edit",
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
            text: "Apakah anda yakin akan meghapus user?",
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
                    url: "<?php echo base_url()?>anggota/delete",
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
                        goMenu('Daftar Anggota','anggota/list_data')
                    }
                });
            }
        });
    }
    
    function view_image(foto_ktp){        
        $("#image_view").attr("src","<?php echo base_url()?>"+foto_ktp);
        $("#btnView").click();
    }

    function openModalPrint(id){
        $("#modal-print").modal();
        $("#id-item").val(id);
    }

    function printDoc(){
        var id = $("#id-item").val();
        var kta = $("#kta:checked").val();
        var ktp = $("#ktp:checked").val();
        var link = "?id="+id;

        if(kta == undefined && ktp == undefined){
            alert("Pilih salah satu dokumen yang akan dicetak");
        }else{
            if(kta != undefined){
                link += "&kta=YES";
            }

            if(ktp != undefined){
                link += "&ktp=YES";
            }

            var win = window.open("<?php echo base_url() ?>anggota/print_doc"+link, "_blank");
            win.focus();
            $("#modal-print").modal('hide');
        }
    }
</script>