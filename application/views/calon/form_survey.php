
<form method="POST" action="<?php echo base_url()?>calon/save_survey" class="form" enctype="multipart/form-data">
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">PROVINSI</label>
                            <select class="form-control select" onchange="pilihProv()" id="provinsi"  data-style="btn btn-link" name="provinsi" required>
                                <option value="">ALL </option>
                                <?php foreach($prov->result() as $tmp) :?>
                                <option <?php echo ($tmp->geo_prov_id == $provinsi)?'selected':''?> value="<?php echo $tmp->geo_prov_id?>"><?php echo $tmp->geo_prov_nama?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">KABUPATEN / KOTA</label>
                            <select class="form-control select" data-style="btn btn-link"  id="kabupaten"   name="kabupaten_kota">
                                <option value="0">ALL </option>
                                <?php foreach($kab->result() as $tmp) :?>
                                <option <?php echo ($tmp->geo_kab_id == $kabupaten)?'selected':''?> value="<?php echo $tmp->geo_kab_id?>"><?php echo $tmp->geo_kab_nama?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-bottom:20px">
                        <input type="button" onclick="doSearch()" class="btn btn-primary float-left" value="search">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Surveyor</label>
                            <input type="input" class="form-control" name="nama_surveyor" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tanggal Survey</label>
                            <input type="input" class="form-control" name="survey_date" id="survey_date"/>
                        </div>
                    </div>
                    <br/>
                    <br/>
                    <div class="col-md-12" style="margin-top:20px">
                        <h4>Calon Terdaftar</h4>
                    </div>
                    <?php foreach($calon->result() as $tmp):?>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama</label>
                                <input type="hidden" class="form-control" name="id[]" value="<?php echo $tmp->id?>"/>
                                <input type="input" class="form-control" name="nama[]" value="<?php echo $tmp->nama?>"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Survey</label>
                                <input type="number" class="form-control" name="survey[]" value="" step=".01"/>
                            </div>
                        </div>
                    <?php endforeach?>
                    <div class="col-md-12" style="margin-top:20px">
                        <h4>Calon Lainnya</h4>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id[]"/>
                            <label for="exampleFormControlInput1">Nama</label>
                            <input type="input" class="form-control" name="nama[]"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Survey</label>
                            <input type="number" class="form-control" name="survey[]" value="" step=".01"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama</label>
                            <input type="hidden" class="form-control" name="id[]"/>
                            <input type="input" class="form-control" name="nama[]"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Survey</label>
                            <input type="number" class="form-control" name="survey[]" value="" step=".01"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama</label>
                            <input type="hidden" class="form-control" name="id[]"/>
                            <input type="input" class="form-control" name="nama[]"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Survey</label>
                            <input type="number" class="form-control" name="survey[]" value="" step=".01"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama</label>
                            <input type="hidden" class="form-control" name="id[]"/>
                            <input type="input" class="form-control" name="nama[]"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Survey</label>
                            <input type="number" class="form-control" name="survey[]" value="" step=".01"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama</label>
                            <input type="hidden" class="form-control" name="id[]"/>
                            <input type="input" class="form-control" name="nama[]"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Survey</label>
                            <input type="input" class="form-control" name="survey[]" value="" step=".01"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama</label>
                            <input type="hidden" class="form-control" name="id[]"/>
                            <input type="input" class="form-control" name="nama[]"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Survey</label>
                            <input type="number" class="form-control" name="survey[]" value="" step=".01"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama</label>
                            <input type="hidden" class="form-control" name="id[]"/>
                            <input type="input" class="form-control" name="nama[]"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Survey</label>
                            <input type="number" class="form-control" name="survey[]" value="" step=".01"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama</label>
                            <input type="hidden" class="form-control" name="id[]"/>
                            <input type="input" class="form-control" name="nama[]"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Survey</label>
                            <input type="number" class="form-control" name="survey[]" value="" step=".01"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input class="btn btn-primary float-right" type="submit" value="Save"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div>
</form>
<script src="<?php echo base_url()?>/assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
<script>
    $(function(){
        $(".select").select2();
        $("#survey_date").datetimepicker({
            format: 'YYYY-MM-DD',
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
        });
    });
    function pilihProv(){
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>calon/kabupaten_pemilihan",
            data: { provinsi: $("#provinsi").val() }
        }).done(function (msg) {
            $("#kabupaten").html(msg);
        });
    }
    function doSearch(){
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>calon/form_survey",
            data: {
                provinsi: $("#provinsi").val(),
                kabupaten: $("#kabupaten").val(),
            }
        }).done(function (msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }
</script>