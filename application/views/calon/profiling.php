<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">PROVINSI</label>
                            <select class="form-control select" onchange="pilihProv()" id="provinsi" data-style="btn btn-link" name="provinsi" required>
                                <option value="">ALL </option>
                                <?php foreach ($prov->result() as $tmp) : ?>
                                    <option <?php echo ($tmp->geo_prov_id == $provinsi) ? 'selected' : '' ?> value="<?php echo $tmp->geo_prov_id ?>"><?php echo $tmp->geo_prov_nama . " (" . $tmp->diisi . "/" . $tmp->total . ") " ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">KABUPATEN / KOTA</label>
                            <select class="form-control select" data-style="btn btn-link" id="kabupaten" name="kabupaten_kota">
                                <option value="0">ALL </option>
                                <?php foreach ($kab->result() as $tmp) : ?>
                                    <option <?php echo ($tmp->geo_kab_id == $kabupaten) ? 'selected' : '' ?> value="<?php echo $tmp->geo_kab_id ?>"><?php echo $tmp->geo_kab_nama . " (" . $tmp->diisi . "/" . $tmp->total . ") " ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="button" onclick="doSerach()" class="btn btn-primary float-left" value="search">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="sel7" class="col-lg-3 mt-4">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">event_available</i>
                </div>
                <p class="card-category">Provinsi</p>
                <h2 class="card-title" id="total_kursi"><?php echo $data_dashboard_prov->provinsi ?></h2>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">assignment_turned_in</i>
                    <div id="total"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="sel2" class="col-lg-3 mt-4">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">event_available</i>
                </div>
                <p class="card-category">Calon Tingkat Provinsi</p>
                <h2 class="card-title" id="kursi_hanura"><?php echo $data_dashboard_prov->calon ?></h2>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">date_range</i>
                    <div id="kursi"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="sel1" class="col-lg-3 mt-4">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">event_available</i>
                </div>
                <p class="card-category">Kabupaten / Kota</p>
                <h2 class="card-title" id="syarat_kursi"><?php echo $data_dashboard->kabupaten_kota ?></h2>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">date_range</i>
                    <div id="syarat"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="sel2" class="col-lg-3 mt-4">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">event_available</i>
                </div>
                <p class="card-category">Calon Tingkat Kabupaten / Kota</p>
                <h2 class="card-title" id="kursi_hanura"><?php echo $data_dashboard->calon ?></h2>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">date_range</i>
                    <div id="kursi"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="sel7" class="col-lg-3 mt-4">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">event_available</i>
                </div>
                <p class="card-category">Total Kursi</p>
                <h2 class="card-title" id="total_kursi"><?php echo $total ?></h2>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">assignment_turned_in</i>
                    <div id="total"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="sel1" class="col-lg-3 mt-4">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">event_available</i>
                </div>
                <p class="card-category">Syarat Kursi</p>
                <h2 class="card-title" id="syarat_kursi"><?php echo $syarat ?></h2>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">date_range</i>
                    <div id="syarat"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="sel2" class="col-lg-3 mt-4">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">event_available</i>
                </div>
                <p class="card-category">Kursi Hanura</p>
                <h2 class="card-title" id="kursi_hanura"><?php echo $hanura ?></h2>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">date_range</i>
                    <div id="kursi"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="sel3" class="col-lg-3 mt-4">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">event_available</i>
                </div>
                <p class="card-category">Grade Kursi</p>
                <h2 class="card-title" id="grade_kursi"><?php echo strtoupper($grade) ?></h2>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">event_available</i>
                    <div id="grade"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id='' class='table table-striped table-hover table-bordered'>
                            <thead>
                                <tr>
                                    <td><?php echo ($kabupaten == "0" || $kabupaten == "") ? "GUBERNUR" : "BUPATI / WALIKOTA"; ?></td>
                                    <td>ASAL PARTAI</td>
                                    <td><?php echo ($kabupaten == "0" || $kabupaten == "") ? "WAKIL GUBERNUR" : "WAKIL BUPATI / WALIKOTA"; ?></td>
                                    </td>
                                    <td>ASAL PARTAI</td>
                                    <td>PARTAI PENDUKUNG</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($petahana->result() as $tmp) : ?>
                                    <tr>
                                        <td><?php echo $tmp->pimpinan ?></td>
                                        <td><?php echo $tmp->pimpinan_partai ?></td>
                                        <td><?php echo $tmp->wakil ?></td>
                                        <td><?php echo $tmp->wakil_partai ?></td>
                                        <td><?php echo $tmp->pendukung ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <?php if (count($calon->result()) > 0) : ?>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">NAMA CALON</label>
                                <select class="form-control select" onchange="doSerach()" data-style="btn btn-link" id="id_calon">
                                    <option value="">ALL </option>
                                    <?php foreach ($select_calon->result() as $tmp) : ?>
                                        <option <?= (count($calon->result()) == 1) && $tmp->nama == $calon->result()[0]->nama ? 'selected' : ''; ?> value="<?php echo $tmp->id ?>"><?php echo $tmp->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php endif; ?>
                        <table id='datatab' class='table table-borderless'>
                            <thead>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($calon->result() as $tmp) : ?>
                                    <tr>
                                        <td style="vertical-align: top;" class='w-30 text-center'>
                                            <img src='<?php echo base_url() . (($tmp->foto != "") ? 'foto/' . $tmp->foto : 'assets/img/user.png') ?>' width="150" height="150" class='rounded-circle circular--square circular--landscape circular--portrait grayscale mb-3'>
                                        </td>
                                        <td>
                                            <p class='mt-3'><?php echo $tmp->nama ?>
                                                <?php if ($tmp->file_individu || $tmp->file_pasangan) : ?>
                                                    <button class="btn btn-success btn-fab btn-sm btn-round"><i class="fa fa-check"></i></button>
                                                <?php endif; ?>
                                            </p>
                                            <p class='mt-3'><?php echo $tingkat[$tmp->mencalonkan] ?></p>
                                            <p class='mt-3'><?php echo date_diff(date_create($tmp->tanggal_lahir), date_create('now'))->y ?> Tahun</p>
                                            <p class='mt-3'><?php echo $tmp->pekerjaan ?></p>
                                            <p class='mt-3'><?php echo $tmp->organisasi ?></p>
                                            <p class='mt-3' style="white-space: pre-wrap"><?php echo $tmp->review ?><a class="btn btn-primary btn-round btn-sm btn-fab" onclick="review('<?php echo $tmp->id ?>',`<?php echo $tmp->review ?>`)"><i class="fa fa-pencil-alt"></i></a> </p>
                                            <p class='mt-3'>
                                                <a class="btn btn-primary btn-round btn-sm btn-fab" onclick="profile('<?php echo $tmp->id ?>')"><i class="fa fa-info text-white"></i></a>

                                                <?php if ($tmp->file_individu && $tmp->file_pasangan) : ?>
                                                    <button class="btn btn-default btn-sm btn-round btn-fab btn-fab-mini" onclick="printFile('<?= $tmp->file_individu ?>', '<?= $tmp->file_pasangan ?>')"><i class="fa fa-print"></i></button>
                                                <?php elseif ($tmp->file_individu) : ?>
                                                    <a href="<?= base_url('file/' . $tmp->file_individu); ?>" class="btn btn-default btn-sm btn-round btn-fab btn-fab-mini" target="_blank"><i class="fa fa-print"></i></a>
                                                <?php elseif ($tmp->file_pasangan) : ?>
                                                    <a href="<?= base_url('file/' . $tmp->file_pasangan); ?>" class="btn btn-default btn-sm btn-round btn-fab btn-fab-mini" target="_blank"><i class="fa fa-print"></i></a>
                                                <?php endif; ?>

                                            </p>
                                        </td>
                                        <td style="vertical-align: top;">
                                            <h6>Score</h6>
                                            <h1><?php echo isset($tmp->nilai) ? $tmp->nilai : "-" ?></h1>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <h6>Survey</h6>
                                            <table class="table table-striped table-hover table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td>Nama</td>
                                                        <td>Tanggal</td>
                                                        <td>Hasil</td>
                                                        <td>Peringkat</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $survey = $this->db->query("SELECT
                                                                                    nama_surveyor,
                                                                                    survey_date,
                                                                                    survey,
                                                                                    id_survey 
                                                                                FROM
                                                                                    tb_survey
                                                                                    INNER JOIN tb_calon_survey ON id_survey = tb_survey.id 
                                                                                WHERE
                                                                                    id_calon = '$tmp->id'");
                                                    foreach ($survey->result() as $tmp2) :
                                                        $rank = $this->db->query("SELECT
                                                                                    FIND_IN_SET( $tmp->id, ( SELECT GROUP_CONCAT( id_calon ORDER BY TRUNCATE ( survey, 3 ) DESC ) ) ) AS ranking
                                                                                FROM
                                                                                    tb_calon_survey 
                                                                                WHERE
                                                                                    id_survey = $tmp2->id_survey")->result();
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $tmp2->nama_surveyor ?></td>
                                                            <td><?php echo $tmp2->survey_date ?></td>
                                                            <td><?php echo $tmp2->survey ?></td>
                                                            <td><?= $rank[0]->ranking ?></td>
                                                        </tr>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <?php
                                                        $query = $this->db->query("select * from tb_document order by tb_document.id");
                                                        foreach ($query->result() as $tmp2) :
                                                        ?>
                                                            <th><?php echo $tmp2->dokumen_name; ?></th>
                                                        <?php endforeach ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = $this->db->query("select tb_document.id id_document,tb_calon_document.id_calon from tb_document left join tb_calon_document on tb_document.id = tb_calon_document.id_document and id_calon = '" . $tmp->id . "' order by tb_document.id");
                                                    foreach ($query->result() as $tmp2) :
                                                    ?>
                                                        <th id="status-<?php echo $tmp->id ?>-<?php echo $tmp2->id_document ?>"><?php if ($tmp2->id_calon != "") : ?>
                                                                <button class="btn btn-success btn-fab btn-sm btn-round"><i class="fa fa-check"></i></button>
                                                            <?php else : ?>
                                                                <button class="btn btn-danger btn-fab btn-sm btn-round"></button>
                                                                </i><?php endif; ?></th>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table id='datatab' class='table table-striped table-hover table-bordered' style='color: black;' width='100%'>
                            <thead>
                                <tr class='text-center'>
                                    <th rowspan='2'>NO</th>
                                    <th rowspan='2'>KECAMATAN </th>
                                    <th colspan='2' class='text-center'>PEMILIH TERDAFTAR</th>
                                    <th rowspan='2'>TOTAL</th>
                                    <th colspan='2' class='text-center'>STATUS</th>
                                </tr>
                                <tr class='text-center'>
                                    <th>L</th>
                                    <th>P</th>
                                    <th>KELURAHAN</th>
                                    <th>DESA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                foreach ($dpt->result() as $tmp) : $i++; ?>
                                    <tr>
                                        <td class='text-center'><?php echo $i ?></td>
                                        <td><?php echo $tmp->nama ?></td>
                                        <td class='text-center'><?php echo number_format($tmp->dptl) ?></td>
                                        <td class='text-center'><?php echo number_format($tmp->dptp) ?></td>
                                        <td class='text-center'><?php echo number_format($tmp->total) ?></td>
                                        <td class='text-center'><?php echo number_format($tmp->kelurahan) ?></td>
                                        <td class='text-center'><?php echo number_format($tmp->desa) ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <table id='datatab' class='table table-striped table-hover table-bordered' style='color: black;' width='100%'>
                            <thead>
                                <tr class='text-center'>
                                    <th>NO</th>
                                    <th>PARTAI </th>
                                    <th>TOTAL KURSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                foreach ($kursi->result() as $tmp) : $i++; ?>
                                    <tr>
                                        <td class='text-center'><?php echo $i ?></td>
                                        <td><?php echo $tmp->partai ?></td>
                                        <td class='text-center'><?php echo number_format($tmp->total_kursi) ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button id="btn-profile" type="button" class="btn btn-primary" style="display:none" data-toggle="modal" data-target="#modalprofile" />
</div>
<div class="modal" tabindex="1" role="dialog" id="modalprofile">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="profile-content" style="height:500px;overflow-y:auto">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">File Surat Tugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <a id="file_individu" target="blank" class="btn btn-primary">Individu</a>
                <a id="file_pasangan" target="blank" class="btn btn-primary">Pasangan</a>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $(".select").select2();
    });

    function printFile(fileIndividu, filePasangan) {
        $('#printModal').modal('show');
        $('#file_individu').attr('href', 'file/' + fileIndividu);
        $('#file_pasangan').attr('href', 'file/' + filePasangan);
    }

    function pilihProv() {
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>calon/kabupaten_pemilihan_plus",
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
            url: "<?php echo base_url() ?>calon/profiling",
            data: {
                provinsi: $("#provinsi").val(),
                kabupaten: $("#kabupaten").val(),
                id: $("#id_calon").val()
            }
        }).done(function(msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }
    async function review(id, value) {
        const {
            value: text
        } = await Swal.fire({
            input: 'textarea',
            inputPlaceholder: 'Catatan . . .',
            inputAttributes: {
                'aria-label': 'Catatan'
            },
            inputValue: value,
            showCancelButton: true
        })
        if (text) {
            $.ajax({
                method: "POST",
                url: "<?php echo base_url() ?>/calon/review",
                data: {
                    id: id,
                    review: text
                }
            }).done(function(msg) {
                doSerach();
            });
        }
    }

    function profile(id) {
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>calon/profile",
            data: {
                id: id
            }
        }).done(function(msg) {
            processDone();
            $("#profile-content").html(msg);
            $("#btn-profile").click();
        });
    }
</script>