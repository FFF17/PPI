<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-icon card-header-primary">
                <h4 class="card-title">
                    Iuran Anggota
                </h4>
            </div>
            <div class="card-body ">
                <div class="row">   
                    <div class="col-md-12">
                        <div id = "websiteViewsChart" class="ct-chart" style="height:300px"></div>
                        <?php foreach($labels as $key => $value):?>
                        <span class="badge badge-pill badge-info"><?php echo $key.". ".$value;?></span>
                        <?php endforeach?>
                        <br/>
                        <span class="badge badge-pill badge-info">DPRDI</span>
                        <span class="badge badge-pill badge-danger">DPRDII</span>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <div class="col-lg-3 col-md-3">
        <div class="card card-stats" style="padding:20px">
            <div class="card-header card-header-icon card-header-primary">
                <p class="card-category">
                Total Tagihan
                </p>
                <h3 class="card-title"><?php echo @"Rp " . number_format($total_ditagih,2,',','.');?>  </h3>     
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3">
        <div class="card card-stats" style="padding:20px">
            <div class="card-header card-header-icon card-header-primary">
                <p class="card-category">
                    Total Dibayar
                </p>
                <h3 class="card-title"><?php echo @"Rp " . number_format($total_dibayar,2,',','.');?>   </h3>     
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3">
        <div class="card card-stats" style="padding:20px">
            <div class="card-header card-header-icon card-header-primary">
                <p class="card-category">
                    Tagihan DPRDI
                </p>
                <h3 class="card-title"><?php echo @"Rp " . number_format($total_dibayar,2,',','.');?>   </h3>     
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3">
        <div class="card card-stats" style="padding:20px">
            <div class="card-header card-header-icon card-header-primary">
                <p class="card-category">
                    Tagihan DPRDII
                </p>
                <h3 class="card-title"><?php echo @"Rp " . number_format($total_dibayar,2,',','.')?>   </h3>     
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    var dataWebsiteViewsChart = {
        labels: <?php echo json_encode($data_prov)?>,
        series: [
          <?php echo json_encode($data1)?>,
          <?php echo json_encode($data2)?>,
        ]
      };
      var optionsWebsiteViewsChart = {
        axisX: {
          showGrid: false
        },
        fontSize:9,
        low: 0,
        high: 1000,
        chartPadding: {
          top: 0,
          right: 5,
          bottom: 0,
          left: 0
        }
      };
      var responsiveOptions = [
        ['screen and (max-width: 640px)', {
          seriesBarDistance: 5,
          axisX: {
            labelInterpolationFnc: function(value) {
              return value[0];
            }
          }
        }]
      ];
      var websiteViewsChart = Chartist.Bar('#websiteViewsChart', dataWebsiteViewsChart, optionsWebsiteViewsChart, responsiveOptions);      
        seq2 = 0;
      websiteViewsChart.on('draw', function(data) {
      if (data.type === 'bar') {
          //alert("test");
        seq2++;
        data.element.animate({
          opacity: {
            begin: seq2 * delays2,
            dur: durations2,
            from: 0,
            to: 1,
            easing: 'ease'
          }
        });
      }
    });
});
</script>