<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-icon card-header-success">
                <div class="card-icon">
                    <i class="material-icons">library_books</i>
                </div>
                <h4 class="card-title">
                    TAMBAH SURAT TUGAS
                </h4>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-12">
                        <input type="button" onclick="back()" class="btn btn-primary" value="Back">&nbsp;
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">JENIS SURAT TUGAS</label>
                            <select class="form-control select" onchange="pilihSuratTugas()" id="jenis_surat_tugas" data-style="btn btn-link" name="jenis_surat_tugas" required>
                                <option <?= $jenis == 'individu' ? 'selected' : ''; ?> value="individu">INDIVIDU</option>
                                <option <?= $jenis == 'pasangan' ? 'selected' : ''; ?> value="pasangan">PASANGAN</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 pt-3">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">NOMOR SURAT</label>
                            <input type="text" class="form-control" id="no_surat" name="no_surat" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">PROVINSI</label>
                            <select class="form-control select" onchange="pilihProv()" id="provinsi" data-style="btn btn-link" name="provinsi" required>
                                <option value="null">ALL </option>
                                <?php foreach ($prov->result() as $tmp) : ?>
                                    <option <?php echo ($tmp->geo_prov_id == $provinsi) ? 'selected' : '' ?> value="<?php echo $tmp->geo_prov_id ?>"><?php echo $tmp->geo_prov_nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">KABUPATEN / KOTA</label>
                            <select class="form-control select" onchange="pilihKab()" data-style="btn btn-link" id="kabupaten" name="kabupaten_kota">
                                <option value="0">ALL </option>
                                <?php foreach ($kab->result() as $tmp) : ?>
                                    <option <?php echo ($tmp->geo_kab_id == $kabupaten) ? 'selected' : '' ?> value="<?php echo $tmp->geo_kab_id ?>"><?php echo $tmp->geo_kab_nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">CALON</label>
                            <select class="form-control select" onchange="pilihCalon()" data-style="btn btn-link" id="calon" name="calon">
                                <option value="">PILIH CALON</option>
                                <?php foreach ($calon->result() as $tmp) : ?>
                                    <option value="<?php echo $tmp->id ?>"><?php echo $tmp->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <?php if ($jenis == 'pasangan') : ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">PASANGAN</label>
                                <select class="form-control select" onchange="pilihCalon()" data-style="btn btn-link" id="pasangan" name="pasangan">
                                    <option value="">PILIH PASANGAN</option>
                                    <?php foreach ($calon->result() as $tmp) : ?>
                                        <option value="<?php echo $tmp->id ?>"><?php echo $tmp->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">MASA BERLAKU</label>
                            <select class="form-control select" onchange="masaBerlaku()" id="masa_berlaku" data-style="btn btn-link" name="masa_berlaku" required>
                                <option value="12">12 (Dua Belas)</option>
                                <option value="30">30 (Tiga Puluh)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 pt-3">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">START DATE</label>
                            <input type="input" class="form-control" name="start_date" id="start_date" />
                        </div>
                    </div>
                    <div class="col-md-12 pt-5">
                        <div class="form-group">
                            <textarea class="form-control" name="redaksi" id="redaksi" rows="10"><?= $redaksi; ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 pt-5">
                        <h4>Gunakan alias dibawah ini untuk menampilkan data calon :</h4>
                        <div class="row">
                            <div class="col-md-3">
                                <b>;</b>
                            </div>
                            <div class="col-md-9">: Menutup baris / Mulai baris baru</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <b>@calon</b>
                            </div>
                            <div class="col-md-9" id="alias_calon">: Nama Calon</div>
                        </div>
                        <?php if ($jenis == 'pasangan') : ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <b>@pasangan</b>
                                </div>
                                <div class="col-md-9" id="alias_nama_pasangan">: Nama Pasangan</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <b>@jabatan_calon</b>
                                </div>
                                <div class="col-md-9" id="mencalonkan">: Jabatan Calon</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <b>@jabatan_wakil</b>
                                </div>
                                <div class="col-md-9" id="mencalonkan_wakil">: Jabatan Wakil</div>
                            </div>
                        <?php else : ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <b>@sebagai</b>
                                </div>
                                <div class="col-md-9" id="mencalonkan">: Mencalonkan sebagai</div>
                            </div>
                        <?php endif ?>
                        <div class="row">
                            <div class="col-md-3">
                                <b>@jabatan_pasangan</b>
                            </div>
                            <div class="col-md-9" id="jabatan_wakil">: Jabatan dan Wakil</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <b>@nama_kota_kabupaten</b>
                            </div>
                            <div class="col-md-9" id="kota_kabupaten_nama">: Nama Kota / Kabupaten</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <b>@kota_kabupaten</b>
                            </div>
                            <div class="col-md-9" id="kota_kabupaten">: (Kota / Kabupaten) + (Nama Kota / Kabupaten)</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <b>@masa_berlaku</b>
                            </div>
                            <div class="col-md-9" id="alias_masa_berlaku">: 12 (Dua Belas)</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <b>@sekertaris</b>
                            </div>
                            <div class="col-md-9">
                                : <input type="text" style="width:500px" id="sekertaris" name="sekertaris" value="<?= $sekertaris; ?>">
                            </div>
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
    pilihProv()
    $(function() {
        $(".select").select2();
        $(".table").DataTable();
        $("#start_date").datetimepicker({
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
        if ($('#jenis_surat_tugas').val() == 'pasangan' && $('#pasangan').val() > 0 && $('#no_surat').val() != '' && $('#start_date').val() != '' && $('#sekertaris').val() != '') {
            $.ajax({
                method: "POST",
                url: "<?php echo base_url() ?>calon/getSuratTugasByNomor",
                data: {
                    jenis: $("#jenis_surat_tugas").val(),
                    no_surat: $("#no_surat").val()
                }
            }).done(function(msg) {
                if (msg == 1) {
                    swal('Nomor surat ' + $("#no_surat").val() + ' sudah dipakai');
                } else {
                    saveData('surat_tugas_pasangan_pdf');
                }
            });
        } else if ($('#jenis_surat_tugas').val() == 'individu' && $('#calon').val() > 0 && $('#no_surat').val() != '' && $('#start_date').val() != '' && $('#sekertaris').val() != '') {
            $.ajax({
                method: "POST",
                url: "<?php echo base_url() ?>calon/getSuratTugasByNomor",
                data: {
                    jenis: $("#jenis_surat_tugas").val(),
                    no_surat: $("#no_surat").val()
                }
            }).done(function(msg) {
                if (msg == 1) {
                    swal('Nomor surat ' + $("#no_surat").val() + ' sudah dipakai');
                } else {
                    saveData('surat_tugas_pdf');
                }
            });
        } else {
            swal('Silahkan lengkapi data');
        }
    }

    function saveData(method) {
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>calon/" + method,
            data: {
                no_surat: $("#no_surat").val(),
                calon: $("#calon").val(),
                pasangan: $("#pasangan").val(),
                masa_berlaku: $("#masa_berlaku").val(),
                start_date: $("#start_date").val(),
                redaksi: $("#redaksi").val(),
                sekertaris: $("#sekertaris").val()
            }
        }).done(function(msg) {
            processDone();
            if (msg == true || msg == 1 || msg == '1') {
                back();
            } else {
                swal('Surat Tugas gagal dibuat');
            }
        });
    }

    function back() {
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>calon/surat_tugas",
            data: {
                jenis: $("#jenis_surat_tugas").val(),
                provinsi: $("#provinsi").val() > 0 ? $("#provinsi").val() : '',
                kabupaten: $("#kabupaten").val() > 0 ? $("#kabupaten").val() : ''
            }
        }).done(function(msg) {
            processDone();
            $("#page-content").html(msg)
            window.scrollTo(0, 0);
        });
    }

    function masaBerlaku() {
        if ($('#masa_berlaku').val() == '12') {
            $('#alias_masa_berlaku').html(': 12 (Dua Belas)');
        } else if ($('#masa_berlaku').val() == '30') {
            $('#alias_masa_berlaku').html(': 30 (Tiga Puluh)');
        }
    }

    function pilihSuratTugas() {
        processStart();
        $("#page-title").html('SURAT TUGAS');
        $.ajax({
            method: "POST",
            url: "<?php echo site_url() ?>/calon/add_surat_tugas",
            data: {
                jenis: $("#jenis_surat_tugas").val(),
                provinsi: $("#provinsi").val(),
                kabupaten: $("#kabupaten").val()
            }
        }).done(function(data) {
            processDone();
            $("#page-content").html(data);
            pilihKab();
        });
    }

    function pilihCalon() {
        var id_pasangan = 0;
        if ($('#jenis_surat_tugas').val() == 'pasangan' && $('#pasangan').val() > 0) {
            id_pasangan = $('#pasangan').val();
        } else {
            id_pasangan = 0;
        }
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>calon/calon_selected",
            dataType: 'json',
            data: {
                id: $('#calon').val(),
                jenis: $('#jenis_surat_tugas').val(),
                id_pasangan: id_pasangan
            }
        }).done(function(msg) {
            $('#alias_calon').html(': ' + msg.nama);
            $('#mencalonkan').html(': ' + msg.sebagai);
            $('#jabatan_wakil').html(': ' + msg.berpasangan);
            $('#kota_kabupaten_nama').html(': ' + msg.prov_kota_kab_nama);
            $('#kota_kabupaten').html(': ' + msg.prov_kota_kab + ' ' + msg.prov_kota_kab_nama);

            if ($('#jenis_surat_tugas').val() == 'pasangan' && $('#pasangan').val() > 0) {
                $('#alias_nama_pasangan').html(': ' + msg.nama_pasangan);
                $('#mencalonkan_wakil').html(': ' + msg.pasangan);
            }
        });
    }

    function pilihKab() {

        if ($('#jenis_surat_tugas').val() == 'pasangan') {
            $.ajax({
                method: "POST",
                url: "<?php echo base_url() ?>calon/calon_pasangan_jabatan",
                data: {
                    jenis: $('#jenis_surat_tugas').val(),
                    provinsi: $("#provinsi").val(),
                    kabupaten: $("#kabupaten").val()
                }
            }).done(function(msg) {
                $("#calon").html(msg);
            });

            $.ajax({
                method: "POST",
                url: "<?php echo base_url() ?>calon/calon_pasangan_wakil",
                data: {
                    jenis: $('#jenis_surat_tugas').val(),
                    provinsi: $("#provinsi").val(),
                    kabupaten: $("#kabupaten").val()
                }
            }).done(function(msg) {
                $("#pasangan").html(msg);
            });
        } else {
            $.ajax({
                method: "POST",
                url: "<?php echo base_url() ?>calon/calon_pemilihan",
                data: {
                    jenis: $('#jenis_surat_tugas').val(),
                    provinsi: $("#provinsi").val(),
                    kabupaten: $("#kabupaten").val()
                }
            }).done(function(msg) {
                $("#calon").html(msg);
            });
        }
    }

    function pilihProv() {
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>calon/kabupaten_pemilihan",
            data: {
                page: 'surat tugas',
                jenis: $('#jenis_surat_tugas').val(),
                provinsi: $("#provinsi").val(),
                kabupaten: $("#kabupaten").val()
            }
        }).done(function(msg) {
            $("#kabupaten").html(msg);
            pilihKab();
        });
    }

    function doSerach() {
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>calon/surat_tugas",
            data: {
                provinsi: $("#provinsi").val(),
                kabupaten: $("#kabupaten").val(),
            }
        }).done(function(msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }
</script>