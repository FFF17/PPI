
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
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Surat Tugas</label>
                            <select class="form-control select" onchange="pilihProv()" id="id_surat_tugas" data-style="btn btn-link" name="provinsi" required>
                                <option value="">ALL </option>
                                <?php foreach ($data_surat_tugas->result() as $tmp) : ?>
                                    <option value="<?php echo $tmp->id ?>"><?php echo $tmp->no_surat_tugas ?> - <?php echo $tmp->nama ?> - <?php echo $tmp->nama_pasangan ?></option>
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
    function btnSave() {
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo site_url() ?>/sr/save_sk",
            data: {
                id_surat_tugas : $("#id_surat_tugas").val(),
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