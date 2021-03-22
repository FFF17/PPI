<a class="btn btn-primary" onclick="back()">Back</a>
<div class="card">
    <div class="card-body">
    <form method="POST" action="<?php echo base_url()?>event/update" class="form" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $data->id?>"/>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" value="<?php echo $data->tanggal?>" required/>
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Waktu</label>
                            <input type="time"  value="<?php echo $data->jam?>" class="form-control" name="jam" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Kegiatan</label>
                            <input type="text" class="form-control" name="nama" value="<?php echo $data->nama?>" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan"  value="<?php echo $data->keterangan?>" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Lokasi</label>
                            <input type="text" class="form-control" name="tempat"  value="<?php echo $data->tempat?>" required/>
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
