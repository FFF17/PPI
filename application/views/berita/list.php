<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-icon card-header-primary">
                <div class="card-icon">
                    <i class="material-icons">account_circle</i>
                </div>
                <h4 class="card-title">
                    Berita
                </h4>
            </div>
            <div class="card-body ">
                <div class="row">   
                    <button type="button" id="btnView" class="btn btn-primary" data-toggle="modal" data-target="#modalView" style="display:none"></button>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>                    
                                <tr>
                                    <th>#</th>
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                    <th>Pembuat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0; foreach($data->result() as $tmp) : $i++?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <td><?php echo $tmp->judul?></td>
                                        <td><?php echo $tmp->created_date;?></td>
                                        <td><?php echo $tmp->nama;?></td>
                                        <td class="text-center tetx-white">
                                            <a onclick="detail('<?php echo $tmp->id?>')" class="btn btn-primary btn-sm btn-round btn-fab btn-fab-mini"><i class="fa fa-eye text-white"></i><a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modalView" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Berita</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="view_berita">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
    $(function(){
        $(".table").DataTable();
    });
    function detail(id){        
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url()?>berita/detail",
            data: { 
                id: id,
            }
        }).done(function (msg) {
            processDone();
            $("#view_berita").html(msg)
            $("#btnView").click();
        });
    }
</script>