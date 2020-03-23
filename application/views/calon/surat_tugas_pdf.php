<?php
if (date('m', strtotime($calon->start_date)) == '01') {
    $bulan = 'Januari';
} else if (date('m', strtotime($calon->start_date)) == '02') {
    $bulan = 'Februari';
} else if (date('m', strtotime($calon->start_date)) == '03') {
    $bulan = 'Maret';
} else if (date('m', strtotime($calon->start_date)) == '04') {
    $bulan = 'April';
} else if (date('m', strtotime($calon->start_date)) == '05') {
    $bulan = 'Mei';
} else if (date('m', strtotime($calon->start_date)) == '06') {
    $bulan = 'Juni';
} else if (date('m', strtotime($calon->start_date)) == '07') {
    $bulan = 'Juli';
} else if (date('m', strtotime($calon->start_date)) == '08') {
    $bulan = 'Agustus';
} else if (date('m', strtotime($calon->start_date)) == '09') {
    $bulan = 'September';
} else if (date('m', strtotime($calon->start_date)) == '10') {
    $bulan = 'OKtober';
} else if (date('m', strtotime($calon->start_date)) == '11') {
    $bulan = 'November';
} else if (date('m', strtotime($calon->start_date)) == '12') {
    $bulan = 'Desember';
}

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
?>
<page backtop="32mm" backbottom="20mm" backleft="20mm" backright="20mm">
    <table style="width:100%">
        <thead>
            <tr>
                <th style="padding-bottom:3px;border-bottom:0px;font-size:16px;text-align:center;font-weight:bold;width:100%">
                <div style="padding-bottom:3px;border-bottom:1px;">SURAT TUGAS</div>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <!-- <td style="padding-top:3px;text-align:center;font-size:14px;">NO: <?= $calon->no_surat_tugas; ?>/TPP/DPP-HANURA/II/2020</td> -->
                <td style="padding-top:3px;text-align:center;font-size:14px;">NO: <?= $calon->no_surat_tugas; ?>/TPP/DPP-HANURA/<?= $romawi[date('n', strtotime($calon->start_date))]; ?>/<?= date('Y', strtotime($calon->start_date)); ?></td>
            </tr>
            <tr>
                <td style="padding-top:23px;text-align:justify;font-size:13.5px;">Tim Pilkada Pusat DPP Partai Hanura dengan ini menyetujui untuk memberikan penugasan kepada : </td>
            </tr>
        </tbody>
    </table>

    <table style="width:100%">
        <thead>
            <tr>
                <th style="padding-top:20px;text-align:justify;font-size:13.5px;width:24%;">Nama</th>
                <th style="padding-top:20px;text-align:justify;font-size:13px;">: <?= $calon->nama; ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table>

    <table style="width:100%">
        <thead>
            <tr>
                <th style="padding-top:10px;line-height:18px;text-align:justify;font-size:13.4px;width:100%;font-weight:normal;">
                    Sebagai Calon <?= $calon->sebagai; ?> <?= ucwords(strtolower($calon->prov_kota_kab_nama)); ?> dari Partai Hanura untuk melaksanakan instruksi sebagai berikut:
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table>

    <?php
    $alias = ['@calon', '@sebagai', '@jabatan_pasangan', '@nama_kota_kabupaten', '@kota_kabupaten', '@masa_berlaku',';'];
    $alias_value = [$calon->nama, $calon->sebagai, $calon->berpasangan,  ucwords(strtolower($calon->prov_kota_kab_nama)), $calon->prov_kota_kab . ' ' . ucwords(strtolower($calon->prov_kota_kab_nama)), $calon->masa_berlaku == '12' ? '12 (Dua Belas)' : '30 (Tiga Puluh)',''];
    ?>

    <ol style="padding-left:-18px;padding-top:5px;padding-right:12px;line-height:20px;font-weight:normal;text-align:justify;font-size:13.4px;">
        <?php
        $redaksi = explode(';', $calon->redaksi);
        for ($i = 0; $i < (count($redaksi) - 1); $i++) : ?>
            <li style="padding-bottom:5px"><?= str_replace($alias, $alias_value, $redaksi[$i]) ?></li>
        <?php endfor; ?>
    </ol>

    <table style="width:100%">
        <thead>
            <tr>
                <th style="padding-top:5px;line-height:18px;text-align:justify;font-size:13.4px;width:100%;font-weight:normal;">
                    Pelaksanaan penugasan dari TPP Partai Hanura sebagai syarat untuk dikeluarkannya rekomendasi pasangan Calon <?= $calon->berpasangan; ?> pada PILKADA Serentak Tahun 2020.
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table>

    <table style="width:100%">
        <thead>
            <tr>
                <th style="padding-top:18px;line-height:18px;text-align:justify;font-size:13.4px;width:100%;font-weight:normal;">
                    Apabila yang bersangkutan tidak mendapatkan koalisi partai pendukung sampai dengan batas waktu tanggal diterbitkannya Surat Tugas ini, maka Partai Hanura berhak untuk melakukan evaluasi terhadap yang bersangkutan.
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table>

    <table style="width:100%">
        <thead>
            <tr>
                <th style="padding-top:18px;line-height:18px;text-align:justify;font-size:13.4px;width:100%;font-weight:normal;">
                    Demikian surat ini dibuat, untuk dapat dipergunakan sebagaimana mestinya.
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table>

    <table style="width:100%;padding-bottom:10px">
        <thead>
            <tr>
                <th style="width:380px;padding-top:13px;line-height:18px;text-align:justify;font-size:13.4px;font-weight:normal;">
                </th>
                <th style="padding-top:13px;line-height:18px;text-align:justify;font-size:13.4px;width:100%;font-weight:normal;">
                    Jakarta, <?= date('d', strtotime($calon->start_date)) . ' ' . $bulan . ' ' . date('Y', strtotime($calon->start_date)); ?>
                </th>
            </tr>
            <tr>
                <th style="width:380px;padding-top:13px;line-height:18px;text-align:justify;font-size:13.4px;">
                     
                </th>
                <th style="padding-top:13px;line-height:18px;text-align:justify;font-size:13.4px;width:100%;">
                    TIM PILKADA PUSAT<br/>DPP PARTAI HANURA
                </th>
            </tr>
            <tr>
                <th style="width:380px;padding-top:80px;line-height:18px;text-align:justify;font-size:13.4px;">
                    Dr. FERDINAND NAINGGOLAN<br/>KETUA
                </th>
                <th style="padding-top:80px;line-height:18px;text-align:justify;font-size:13.4px;width:100%;">
                    <?= strtoupper($calon->sekertaris); ?><br/>SEKRETARIS
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table>

    <div style="padding-top:5px;">Tembusan:</div>
    <ol style="padding-left:-18;font-style:italic;font-size:12px;padding-top:-10px;">
        <li style="padding-bottom:5px;">Ketua Umum DPP PARTAI HANURA</li>
        <li style="padding-bottom:5px;">Ketua DPD <?= $calon->geo_prov_nama?></li>
        <li style="padding-bottom:5px;">Ketua DPC <?= $calon->geo_kab_nama?></li>
        <li>ARSIP</li>
    </ol>
</page>