<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-icon card-header-primary">
                <div class="card-icon">
                    <i class="material-icons">account_circle</i>
                </div>
                <h4 class="card-title">
                    JABATAN
                </h4>
            </div>
            <div class="card-body ">
                <div class="row">   
                    <button type="button" id="btnView" class="btn btn-primary" data-toggle="modal" data-target="#modalView" style="display:none"></button>
                    <div class="col-md-3">                    
                        <select class="form-control select" data-style="btn btn-link" name="tingkat" id="tingkat" onchange="changeProvinsi()">
                            <option disabled selected>Pilih Tingkat</option>
                            <option <?php echo ($tingkat=="PIMNAS")?"selected":""?> value="PIMNAS">PIMNAS</option>
                            <option <?php echo ($tingkat=="PIMDA")?"selected":""?> value="PIMDA">PIMDA</option>
                            <option <?php echo ($tingkat=="PIMCAB")?"selected":""?> value="PIMCAB">PIMCAB</option>
                        </select>
                    </div>
                    <div class="col-md-3">                    
                        <select class="form-control select" data-style="btn btn-link" name="provinsi" id="provinsi" onchange="changeProvinsi()">
                            <option disabled selected>Pilih Provinsi</option>
                            <?php foreach($prov->result() as $tmp):?>
                            <option  <?php echo ($tmp->kode == $provinsi)?"selected":""?> value="<?php echo $tmp->kode;?>"><?php echo $tmp->provinsi;?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                    <div class="col-md-3">                    
                        <select class="form-control select" data-style="btn btn-link" name="kabupaten" id="kabupaten">
                        <?php if(isset($kab)):?> 
                            <option disabled selected>Pilih Kabupaten</option>
                            <?php foreach($kab->result() as $tmp):?>
                            <option <?php echo ($tmp->kode == $kabupaten)?"selected":""?> value="<?php echo $tmp->kode;?>"><?php echo $tmp->kabupaten;?></option>
                            <?php endforeach?>
                        <?php endif;?>
                        </select>
                    </div>
                    <div class="col-md-3" style="text-align:right">
                        <button class="btn btn-primary" onclick="doSearch()">Search</button>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>                    
                                <tr>
                                    <th>#</th>
                                    <th>Tingkat</th>
                                    <th>Provinsi</th>
                                    <th>Kabupaten</th>
                                    <th>Jabatan</th>
                                    <th>Nama</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0; foreach($data->result() as $tmp) : $i++?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <td><?php echo $tmp->tingkat;?></td>
                                        <td><?php echo $tmp->provinsi?></td>
                                        <td><?php echo $tmp->kabupaten;?></td>
                                        <td><?php echo $tmp->jabatan;?></td>
                                        <td><?php echo $tmp->nama;?></td>
                                        <td class="text-center tetx-white">
                                            <a class="btn btn-primary btn-sm btn-round btn-fab btn-fab-mini"><i class="fa fa-search text-white"/></a>
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
<div class="modal" id="modalView" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Berita</h5>
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
                tingkat:$("#tingkat").val(),
            },
            url: "<?php echo site_url()?>/anggota/jabatan"
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
                        goMenu('Daftar Anggota','anggota/list')
                    }
                });
            }
        });
    }
    
    function view_image(foto){        
        $("#image_view").attr("src","<?php echo base_url()?>"+foto);
        $("#btnView").click();
    }
</script>