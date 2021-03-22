<a class="btn btn-primary" onclick="back()">Back</a>
<div class="card">
    <div class="card-body">
    <form method="POST" action="<?php echo base_url()?>jabatan/save" class="form" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tingkat</label>
                            <select class="form-control select" data-style="btn btn-link" name="tingkat" required>
                                <option>PIMNAS</option>
                                <option>PIMDA</option>
                                <option>PIMCAB</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Jabatan</label>
                            <input type="text" class="form-control" name="jabatan" required/>
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
    $(".select").select2();
})

function back(){
    processStart();
    $.ajax({
        method: "POST",
        url: "<?php echo base_url()?>jabatan"
    }).done(function (msg) {
        processDone();
        $("#page-content").html(msg)
    });
}
</script>
