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
<style>
    th,
    td {
        font-size: 15px;
        padding: 5px;
    }

    th {
        text-align: center;
    }
</style>
<page orientation="l" style="width:100%">
    <table border="1" cellspacing="0" cellpadding="3" style="width:100%">
        <thead>
            <tr>
                <th colspan="7" style="text-align:center">
                    <h3>SIMULASI PILKADA PROVINSI / KABUPATEN / KOTA
                        <?php foreach ($prov->result() as $tmp) : ?>
                            <?php if ($tmp->geo_prov_id == $provinsi) :  echo $tmp->geo_prov_nama;
                            endif; ?>
                        <?php endforeach; ?></h3>
                </th>
            </tr>
            <tr>
                <th rowspan="2" style="width:5%">NO</th>
                <th rowspan="2" style="width:20%">PROVINSI / KABUPATEN / KOTA</th>
                <th colspan="2">KOMPOSISI KURSI</th>
                <th colspan="3">PETAHANA</th>
            </tr>
            <tr>
                <th style="width:20%">PARTAI</th>
                <th style="width:10%">KURSI</th>
                <th style="width:25%">NAMA / JABATAN</th>
                <th style="width:15%">PARTAI</th>
                <th style="width:30%">CATATAN</th>
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
                        <td style="vertical-align:top"><?php echo $petahana->pimpinan . " <br/> ( " . (($kabupaten == "0") ? "GUBERNUR" : "BUPATI / WALIKOTA") . " )" ?></td>
                        <td style="vertical-align:top"><?php echo $petahana->pimpinan_partai ?></td>
                        <td style="vertical-align:top" rowspan="<?php echo $total + 1 ?>"><?php echo wordwrap((str_replace(',', ', ', $petahana->pendukung)), 30, "<br>\n") ?></td>
                    <?php endif ?>
                    <?php if ($i == "2") : ?>
                        <td style="vertical-align:top" rowspan="<?php echo $total ?>"><?php echo $petahana->wakil . " <br/> ( " . (($kabupaten == "0") ? "WAKIL GUBERNUR" : "WAKIL BUPATI / WALIKOTA") . " )" ?></td>
                        <td style="vertical-align:top" rowspan="<?php echo $total ?>"><?php echo $petahana->wakil_partai ?></td>
                    <?php endif ?>
                </tr>
            <?php endforeach ?>
            <tr>
                <?php if ($i == "1") : ?>
                    <td>JUMLAH</td>
                    <td><?php echo $jumlah_kursi ?></td>
                    <td colspan="2"></td>
                <?php endif ?>
                <?php if ($i >= "2") : ?>
                    <td>JUMLAH</td>
                    <td><?php echo $jumlah_kursi ?></td>
                <?php endif ?>
            </tr>
        </tbody>
    </table>
</page>
<page orientation="l">
    <table border="1" cellspacing="0" cellpadding="3" style="width:100%">
        <thead>
            <tr>
                <th colspan="2" style="width:35%">
                    <h3>B CALON YANG MENDAFTAR</h3>
                </th>
                <th style="width:15%">PARTAI PENGUSUNG</th>
                <th style="width:20%">RIWAYAT PEKERJAAN</th>
                <th style="width:20%">KETERANGAN</th>
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
                    <td><?php echo  wordwrap($tmp->pekerjaan, 30, "<br>\n"); ?> </td>
                    <td>
                        <?= nl2br(wordwrap($tmp->review, 30, "\n")); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</page>
<?php
$i = 0;
foreach ($calon->result() as $tmp) : $i++;
?>
    <page orientation="l">
        <?php if ($i == 1) : ?>
            <h3>C. PENILAIAN</h3>
        <?php endif; ?>
        <table border="1" cellspacing="0" cellpadding="3" style="width:100%">
            <thead>
                <tr>
                    <th style="width:5%">NO</th>
                    <th style="width:45%">CALON YANG DIUSUNG</th>
                    <th style="width:10%">NILAI</th>
                    <th style="width:10%">BOBOT</th>
                    <th style="width:10%">SCORE</th>
                </tr>
            </thead>
            <tbody>
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
        <h3>&nbsp;</h3>
    </page>
<?php endforeach; ?>

<page orientation="l">
    <h3>D. KESIMPULAN</h3>
    <table border="1" cellspacing="0" cellpadding="3" style="width:100%">
        <thead>
            <tr>
                <th style="width:5%">NO</th>
                <th style="width:65%">NAMA</th>
                <th style="width:10%">SCORE</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($kesimpulan_calon->result() as $tmp) : $i++;
            ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $tmp->nama ?></td>
                    <td><?php echo $tmp->skor ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h3>&nbsp;</h3>
</page>