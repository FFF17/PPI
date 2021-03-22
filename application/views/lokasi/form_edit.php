<a class="btn btn-primary" onclick="back()">Back</a>
<div class="card">
    <div class="card-body">
    <form method="POST" action="<?php echo base_url()?>lokasi/update" class="form" enctype="multipart/form-data">
        <input type="hidden" value="<?php echo $data->id?>" name="id"/>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama</label>
                            <input type="text" class="form-control" name="nama" value="<?php echo $data->nama?>" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="<?php echo $data->alamat?>" required/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Titik</label>
                            <div id="map" style="height:450px"></div>
                        </div>
                    </div>
                    <input type="hidden" id="geo_lat" name="geo_lat"  value="<?php echo $data->geo_lat?>"/>
                    <input type="hidden" id="geo_long" name="geo_long"  value="<?php echo $data->geo_long?>"/>
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
    marker = null;
})
var marker;
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
function initMap() {
    // The location of Uluru
    var uluru = {lat: -1.6024216765509336, lng: 119.794921875};
    var location = {lat: <?php echo $data->geo_lat?>, lng: <?php echo $data->geo_long?>};
    // The map, centered at Uluru
    var map = new google.maps.Map(
        document.getElementById('map'), {zoom: 5, center: uluru});
    // The marker, positioned at Uluru
    marker = new google.maps.Marker({
        position: location,
        map: map
    }); 
    map.addListener('click', function(e) {
        placeMarker(e.latLng, map);
    });
    function placeMarker(location) {
        $("#geo_lat").val(location.lat());
        $("#geo_long").val(location.lng());
        console.log(location.lat());
        if (marker == null)
        {
            marker = new google.maps.Marker({
                position: location,
                map: map
            }); 
        } else {   
            marker.setPosition(location); 
        }
    }
}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxeGtu0YWo5Os_0YPSe9oagQoYrjlCnUE&callback=initMap"></script>
