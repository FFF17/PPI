<?php $i=0; foreach($calon->result() as $tmp) : $i++?>
    <tr>
        <td><?php echo $i?></td>
        <td><?php echo @$tingkat[$tmp->mencalonkan];?></td>
        <td><?php echo $tmp->geo_prov_nama;?></td>
        <td><?php echo $tmp->geo_kab_nama;?></td>
        <td><?php echo $tmp->nama;?>
        <?php echo isset($tmp->id_surat_tugas)?"&nbsp;<a class='btn btn-success btn-sm btn-round btn-fab'><i class='text-white fa fa-file'></i></a>":"";?>
        </td>
    </tr>
<?php endforeach; ?>