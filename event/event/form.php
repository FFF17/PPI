<a class="btn btn-primary" onclick="back()">Back</a>
<div class="card">
    <div class="card-body">
    <form method="POST" action="<?php echo base_url()?>event/save" class="form" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" required/>
                        </div>
                    </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Waktu</label>
                            <input type="time" class="form-control" name="jam" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Kegiatan</label>
                            <input type="text" class="form-control" name="nama" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Lokasi</label>
                            <input type="text" class="form-control" name="tempat" required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-round float-right">Save</button>
            </div>
        <div>
    </form>
    </div>
</div>
</div>
<script>
$(function(){

})
function back(){
    processStart();
    $.ajax({
        method: "POST",
        url: "<?php echo base_url()?>event"
    }).done(function (msg) {
        processDone();
        $("#page-content").html(msg)
    });
}
</script>
