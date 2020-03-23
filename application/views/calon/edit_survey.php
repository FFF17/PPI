<form method="POST" action="<?php echo base_url() ?>calon/update_survey" class="form" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-primary">
                    <div class="card-icon">
                        <i class="material-icons">library_books</i>
                    </div>
                    <h4 class="card-title">
                        EDIT SURVEY
                    </h4>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="button" onclick="back()" class="btn btn-primary" value="Back">&nbsp;
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama Surveyor</label>
                                <input type="hidden" class="form-control" name="id_survey" value="<?php echo $calon->result()[0]->id_survey; ?>" />
                                <input type="input" class="form-control" name="nama_surveyor" value="<?php echo $calon->result()[0]->nama_surveyor; ?>" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tanggal Survey</label>
                                <input type="input" class="form-control" name="survey_date" id="survey_date" required value="<?php echo $calon->result()[0]->survey_date; ?>" />
                            </div>
                        </div>
                        <br />
                        <br />
                        <div class="col-md-12" style="margin-top:20px">
                            <h4>Calon Terdaftar</h4>
                        </div>
                        <?php foreach ($calon->result() as $tmp) : ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Nama</label>
                                    <input type="hidden" class="form-control" name="id[]" value="<?php echo $tmp->id ?>" />
                                    <input type="input" class="form-control" name="nama[]" value="<?php echo $tmp->nama_calon ?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Survey</label>
                                    <input type="number" class="form-control" name="survey[]" value="<?php echo $tmp->survey ?>" step=".01"/>
                                </div>
                            </div>
                        <?php endforeach ?>
                        <div class="col-md-12" style="margin-top:20px">
                            <h4>Calon Lainnya</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="id_add[]" />
                                <label for="exampleFormControlInput1">Nama</label>
                                <input type="input" class="form-control" name="nama_add[]" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Survey</label>
                                <input type="number" class="form-control" name="survey_add[]" value="" step=".01"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama</label>
                                <input type="hidden" class="form-control" name="id_add[]" />
                                <input type="input" class="form-control" name="nama_add[]" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Survey</label>
                                <input type="number" class="form-control" name="survey_add[]" value="" step=".01"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama</label>
                                <input type="hidden" class="form-control" name="id_add[]" />
                                <input type="input" class="form-control" name="nama_add[]" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Survey</label>
                                <input type="number" class="form-control" name="survey_add[]" value="" step=".01"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama</label>
                                <input type="hidden" class="form-control" name="id_add[]" />
                                <input type="input" class="form-control" name="nama_add[]" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Survey</label>
                                <input type="number" class="form-control" name="survey_add[]" value="" step=".01"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama</label>
                                <input type="hidden" class="form-control" name="id_add[]" />
                                <input type="input" class="form-control" name="nama_add[]" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Survey</label>
                                <input type="input" class="form-control" name="survey_add[]" value="" step=".01"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama</label>
                                <input type="hidden" class="form-control" name="id_add[]" />
                                <input type="input" class="form-control" name="nama_add[]" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Survey</label>
                                <input type="number" class="form-control" name="survey_add[]" value="" step=".01"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama</label>
                                <input type="hidden" class="form-control" name="id_add[]" />
                                <input type="input" class="form-control" name="nama_add[]" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Survey</label>
                                <input type="number" class="form-control" name="survey_add[]" value="" step=".01"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama</label>
                                <input type="hidden" class="form-control" name="id_add[]" />
                                <input type="input" class="form-control" name="nama_add[]" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Survey</label>
                                <input type="number" class="form-control" name="survey_add[]" value="" step=".01"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <input class="btn btn-success float-right" type="submit" value="Update" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
</form>
<script src="<?php echo base_url() ?>/assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
<script>
    $(function() {
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

    function back() {
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>calon/survey",
            data: {}
        }).done(function(msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }
</script>