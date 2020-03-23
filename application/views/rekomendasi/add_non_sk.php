
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-icon card-header-primary">
                <div class="card-icon">
                    <i class="material-icons">library_books</i>
                </div>
                <h4 class="card-title">
                    ADD SURAT REKOMENDASI
                </h4>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">PROVINSI</label>
                            <select class="form-control select" onchange="pilihProv()" id="provinsi" data-style="btn btn-link" name="provinsi" required>
                                <option value="">ALL </option>
                                <?php foreach ($prov->result() as $tmp) : ?>
                                    <option <?php echo ($tmp->geo_prov_id == $provinsi) ? 'selected' : '' ?> value="<?php echo $tmp->geo_prov_id ?>"><?php echo $tmp->geo_prov_nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">KABUPATEN / KOTA</label>
                            <select class="form-control select" data-style="btn btn-link" id="kabupaten" name="kabupaten_kota">
                                <?= count($kab->result()) <= 1 ? '' : '<option value="">ALL </option>'; ?>
                                <?php foreach ($kab->result() as $tmp) : ?>
                                    <option <?php echo ($tmp->geo_kab_id == $kabupaten) ? 'selected' : '' ?> value="<?php echo $tmp->geo_kab_id ?>"><?php echo $tmp->geo_kab_nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="button" onclick="doSerach()" class="btn btn-primary float-right" value="search">&nbsp;
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Calon</label>
                            <select class="form-control select"  id="id_calon" data-style="btn btn-link" name="provinsi" required>
                                <option value="">ALL </option>
                                <?php foreach ($calon->result() as $tmp) : ?>
                                    <option value="<?php echo $tmp->id ?>"><?php echo $tmp->nama ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Pasangan</label>
                            <select class="form-control select" id="id_pasangan" data-style="btn btn-link" name="provinsi" required>
                                <option value="">ALL </option>
                                <?php foreach ($pasangan->result() as $tmp) : ?>
                                    <option value="<?php echo $tmp->id ?>"><?php echo $tmp->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">No Batch</label>
                            <input type="text" id="no_batch" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">No Surat Keputusan</label>
                            <input type="text" id="no_rekomendasi" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tanggal Rekomenadasi</label>
                            <input type="text" id="tanggal_rekomendasi" class="form-control"/>
                        </div>
                    </div>                    
                    <div class="col-md-12 text-right">
                        <button type="button" onclick="btnSave()" class="btn btn-success btn-round"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $(".select").select2();        
        $("#tanggal_rekomendasi").datetimepicker({
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
    function pilihProv() {
        $.ajax({
            method: "POST",
            url: "<?php echo site_url() ?>/calon/kabupaten_pemilihan",
            data: {
                provinsi: $("#provinsi").val()
            }
        }).done(function(msg) {
            $("#kabupaten").html(msg);
        });
    }

    function doSerach() {
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo site_url() ?>/sr/add_non_sk",
            data: {
                tanggal_rekomendasi: $("#tanggal_rekomendasi").val(),
                provinsi: $("#provinsi").val(),
                kabupaten: $("#kabupaten").val() == 0 ? '' : $("#kabupaten").val(),
            }
        }).done(function(msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }
    function btnSave() {
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo site_url() ?>/sr/save_non_sk",
            data: {
                id_calon : $("#id_calon").val(),
                id_pasangan : $("#id_pasangan").val(),
                no_batch : $("#no_batch").val(),
                no_rekomendasi : $("#no_rekomendasi").val(),
                tanggal_rekomendasi : $("#tanggal_rekomendasi").val()
            }
        }).done(function(msg) {
            processDone();
            if (msg == true || msg == 1 || msg == '1') {
                goMenu('Surat Rekomendasi','sr')
            } else {
                swal('Surat Rekomendasi gagal dibuat');
            }
        });
    }
</script>