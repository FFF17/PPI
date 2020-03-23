<?php
$romawi[1] = "I";
$romawi[2] = "II";
$romawi[3] = "III";
$romawi[4] = "IV";
$romawi[5] = "V";
$romawi[6] = "VI";
$romawi[7] = "VII";
$romawi[8] = "VIII";
$romawi[9] = "IX";
$romawi[10] = "X";
$romawi[11] = "XI";
$romawi[12] = "XII";
$romawi[13] = "XIII";
$romawi[14] = "XIV";
$romawi[15] = "XV";
$romawi[16] = "XVI";
$romawi[17] = "XVII";
$romawi[18] = "XVIII";
$romawi[19] = "XIX";
$romawi[20] = "XX";
$romawi[21] = "XXi";
$romawi[22] = "XXII";
$romawi[23] = "XXIII";
$romawi[24] = "XXIV";
$romawi[25] = "XXV";
$romawi[26] = "XXVI";
$romawi[27] = "XXVII";
$romawi[28] = "XXVIII";
$romawi[29] = "XXIX";
$romawi[30] = "XXX";
?>
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
                                    <option <?php echo ($tmp->geo_prov_id == $provinsi) ? 'selected' : '' ?> value="<?php echo $tmp->geo_prov_id ?>"><?php echo $tmp->geo_prov_nama ?></option>
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
                                    <option <?php echo ($tmp->geo_kab_id == $kabupaten) ? 'selected' : '' ?> value="<?php echo $tmp->geo_kab_id ?>"><?php echo $tmp->geo_kab_nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="button" onclick="doSerach()" class="btn btn-primary float-left" value="search">
                    </div>
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align:center">SIMULASI PILKADA PROVINSI / KABUPATEN / KOTA
                                        <?php foreach ($prov->result() as $tmp) : ?>
                                            <?php if ($tmp->geo_prov_id == $provinsi) :  echo $tmp->geo_prov_nama;
                                            endif; ?>
                                        <?php endforeach; ?>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2">NO</th>
                                    <th rowspan="2">PROVINSI / KABUPATEN / KOTA</th>
                                    <th colspan="2">KOMPOSISI KURSI</th>
                                    <th colspan="3">PETAHANA</th>
                                </tr>
                                <tr>
                                    <th>PARTAI</th>
                                    <th>KURSI</th>
                                    <th>NAMA / JABATAN</th>
                                    <th>PARTAI</th>
                                    <th>CATATAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="7">I
                                        <?php foreach ($kab->result() as $tmp) : ?>
                                            <?php if ($tmp->geo_kab_id == $kabupaten) :  echo $tmp->geo_kab_nama;
                                            endif; ?>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>
                                <?php $total = $kursi->num_rows();
                                $i = 0;
                                $jumlah_kursi = 0;
                                ?>
                                <?php foreach ($kursi->result() as $tmp) : $i++;
                                    $jumlah_kursi += $tmp->total_kursi ?>
                                    <tr>
                                        <?php if ($i == "1") : ?>
                                            <td rowspan="<?php echo $total + 1 ?>" style="vertical-align:top">A</td>
                                            <td rowspan="<?php echo $total + 1 ?>" style="vertical-align:top">KONDISI OBYEKTIF</td>
                                        <?php endif ?>
                                        <td><?php echo $tmp->partai ?></td>
                                        <td><?php echo $tmp->total_kursi ?></td>
                                        <?php if ($i == "1") : ?>
                                            <td style="vertical-align:top"><?php echo $petahana->pimpinan . "( " . (($kabupaten == "0") ? "GUBERNUR" : "BUPATI / WALIKOTA") . " )" ?></td>
                                            <td style="vertical-align:top"><?php echo $petahana->pimpinan_partai ?></td>
                                            <td style="vertical-align:top" rowspan="<?php echo $total + 1 ?>"><?php echo $petahana->pendukung ?></td>
                                        <?php endif ?>
                                        <?php if ($i == "2") : ?>
                                            <td style="vertical-align:top" rowspan="<?php echo $total ?>"><?php echo $petahana->wakil . "( " . (($kabupaten == "0") ? "WAKIL GUBERNUR" : "WAKIL BUPATI / WALIKOTA") . " )" ?></td>
                                            <td style="vertical-align:top" rowspan="<?php echo $total ?>"><?php echo $petahana->wakil_partai ?></td>
                                        <?php endif ?>
                                    </tr>
                                <?php endforeach ?>
                                <tr>
                                    <td>JUMLAH</td>
                                    <td><?php echo $jumlah_kursi ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>B</th>
                                    <th>CALON YANG MENDAFTAR</th>
                                    <th>PARTAI PENGUSUNG</th>
                                    <th>RIWAYAT PEKERJAAN</th>
                                    <th>KETERANGAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5">&nbsp;</td>
                                </tr>
                                <?php
                                $i = 0;
                                foreach ($calon->result() as $tmp) : $i++;
                                ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $tmp->nama ?></td>
                                        <td><?php ?></td>
                                        <td><?php echo $tmp->pekerjaan ?></td>
                                        <td style="white-space: pre-wrap"><?php echo $tmp->review ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <h3>C. PENILAIAN</h3>
                        <?php
                        $i = 0;
                        foreach ($calon->result() as $tmp) : $i++;
                        ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>CALON YANG DIUSUNG</th>
                                        <th>NILAI</th>
                                        <th>BOBOT</th>
                                        <th>SCORE</th>
                                    </tr>
                                </thead>

                                <body>
                                    <tr>
                                        <td><?php echo @$romawi[$i] ?></td>
                                        <td colspan="4"><?php echo $tmp->nama ?></td>
                                    </tr>
                                    <?php
                                    $query = $this->db->query("select tb_scoring.*,nilai,(tb_calon_scoring.nilai * (bobot/100)) score  from tb_scoring left join tb_calon_scoring on tb_scoring.id = tb_calon_scoring.id_scoring and id_calon = '$tmp->id'");
                                    $j = 0;
                                    $total_bobot = 0;
                                    $total_score = 0;
                                    foreach ($query->result() as $tmp2) : $j++;
                                        $total_bobot += $tmp2->bobot;
                                        $total_score += $tmp2->score;
                                    ?>
                                        <tr>
                                            <td><?php echo $j ?></td>
                                            <td><?php echo $tmp2->item ?></td>
                                            <td><?php echo $tmp2->nilai ?></td>
                                            <td><?php echo $tmp2->bobot ?> %</td>
                                            <td><?php echo $tmp2->score ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="3">
                                            TOTAL SCORE
                                        </td>
                                        <td><?php echo $total_bobot ?> %</td>
                                        <td><?php echo $total_score ?></td>
                                    </tr>
                                    </tbody>
                            </table>
                        <?php endforeach; ?>
                        <h3>D. KESIMPULAN</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">NO</th>
                                    <th>NAMA</th>
                                    <th width="10%">SCORE</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($kesimpulan_calon->result() as $tmp) : $i++;
                                ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td>
                                            <?php if ($tmp->file_individu && $tmp->file_pasangan) : ?>
                                                <a style="color: #EE9B21;cursor:pointer;" onclick="printFile('<?= $tmp->file_individu ?>', '<?= $tmp->file_pasangan ?>')"><?php echo $tmp->nama ?> <i class="fa fa-check"></i></a>
                                            <?php elseif ($tmp->file_individu) : ?>
                                                <a style="cursor:pointer;" href="<?= base_url('file/' . $tmp->file_individu); ?>" target="_blank"><?php echo $tmp->nama ?> <i class="fa fa-check"></i></a>
                                            <?php elseif ($tmp->file_pasangan) : ?>
                                                <a style="cursor:pointer;" href="<?= base_url('file/' . $tmp->file_pasangan); ?>" target="_blank"><?php echo $tmp->nama ?> <i class="fa fa-check"></i></a>
                                            <?php else : ?>
                                                <?php echo $tmp->nama ?>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $tmp->skor ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <a href="<?php echo base_url() . "report/print_pdf?provinsi=" . $provinsi . "&kabupaten=" . $kabupaten; ?>" class="btn btn-primary float-right">PRINT</a>
                    </div>
                </div>
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
            url: "<?php echo base_url() ?>calon/kabupaten_pemilihan",
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
            url: "<?php echo base_url() ?>report",
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