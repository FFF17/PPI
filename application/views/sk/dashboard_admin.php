<div class="row">
    <div class="col-lg-3 col-md-3">
        <div class="card">
            <div class="card-header card-header-icon card-header-primary">
                <div class="card-icon" style="background:#EE9B21">
                <h2>A</h2>
                </div>
                <div class="card-title" style="text-align:right">
                    <h4><b>GRADE A</b></h4>
                    <h1><b><?php echo $grade_a?></b></h1>
                </div>
            </div>
            <div class="card-body">
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3">
        <div class="card">
            <div class="card-header card-header-icon card-header-primary">
                <div class="card-icon" style="background:#EE9B21">
                <h2>B</h2>
                </div>
                <div class="card-title" style="text-align:right">
                    <h4><b>GRADE B</b></h4>
                    <h1><b><?php echo $grade_b?></b></h1>
                </div>
            </div>
            <div class="card-body">
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3">
        <div class="card">
            <div class="card-header card-header-icon card-header-primary">
                <div class="card-icon" style="background:#ff0000">
                <h2>C</h2>
                </div>
                <div class="card-title" style="text-align:right">
                    <h4><b>GRADE C</b></h4>
                    <h1><b><?php echo $grade_c?></b></h1>
                </div>
            </div>
            <div class="card-body">
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3">
        <div class="card">
            <div class="card-header card-header-icon card-header-primary">
                <div class="card-icon" style="background:#999999">
                <h2>D</h2>
                </div>
                <div class="card-title" style="text-align:right">
                    <h4><b>GRADE D</b></h4>
                    <h1><b><?php echo $grade_d?></b></h1>
                </div>
            </div>
            <div class="card-body">
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="card">
            <div class="card-header card-header-primary" style="background:#EE9B21">
                <h4 style="text-align:right">TOTAL PENDAFTAR</h4>
                <h1 class="card-title">
                    <center><?php echo $pendaftar?></center>
                </h1>
            </div>
            <div class="card-body">
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="card">
            <div class="card-header card-header-primary" style="background:#999999">
                <h4 style="text-align:right">TOTAL PESERTA KONVENSI</h4>
                <h1 class="card-title">
                    <center>0</center>
                </h1>
            </div>
            <div class="card-body">
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="card">
            <div class="card-header card-header-primary" style="background:#EE9B21">
                <h4 style="text-align:right">TOTAL FIT & PROPER</h4>
                <h1 class="card-title">
                    <center>0</center>
                </h1>
            </div>
            <div class="card-body">
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="card">
            <div class="card-header card-header-primary" style="background:#EE9B21">
                Daftar Nama Calon Pendaftar
            </div>
            <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Tlp</th>
                      <th>Tanggal Daftar</th>
                      <th></th>
                    </tr>
                    <thead>
                  <tbody>
                    <?php foreach($daftar_calon->result() as $tmp):?>
                    <tr>
                        <td><?php echo $tmp->nama; ?></td>
                        <td><?php echo $tmp->telp; ?></td>
                        <td><?php echo date("d-m-Y", strtotime($tmp->created_date)); ?></td>
                        <td><a onclick="detail('<?php echo $tmp->id?>')" class="btn btn-sm btn-fab btn-round btn-primary"><i class="fa fa-info text-white"></i></a></td>
                    </tr>
                    <?php endforeach;?>
                  </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="card">
            <div class="card-header card-header-primary" style="background:#EE9B21">
                Daftar Nama Peserta Konvensi / Fit & Proper
            </div>
            <div class="card-body">
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    $(".table").DataTable({
      "filter":false,
      "ordering":false,
      "info":false,
      "lengthChange":false,
      "pageLength": 5
    });
});
function detail(id){
    processStart();
    $.ajax({
        method: "POST",
        url: "<?php echo base_url()?>calon/detail",
        data: {
            id: id,
            provinsi: $("#provinsi").val(),
            kabupaten: $("#kabupaten").val(),
        }
    }).done(function (msg) {
        processDone();
        $("#page-content").html(msg)
    });
}
</script>
