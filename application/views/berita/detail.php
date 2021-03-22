<div class="row">
    <div class="col-md-12">
        <h3><?php echo $data->judul?></h3>
    </div>
    <div class="col-md-12">
        <img height="300" src="<?php echo base_url().$data->foto?>"/>
    </div>
    <div class="col-md-12">
        <sub><?php echo $data->created_date?></sub>
    </div>
    <br/>
    <br/>
    <div class="col-md-12">
        <p><?php echo $data->isi?></p>
    </div>
</div>