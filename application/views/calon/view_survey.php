<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon card-header-info">
                <div class="card-icon">
                    <i class="material-icons">timeline</i>
                </div>
                <h4 class="card-title">Chart </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <input type="button" onclick="back()" class="btn btn-primary" value="Back">&nbsp;
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div id="colouredBarsChart" style="height: 500px"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header card-header-icon card-header-info">
                <div class="card-icon">
                    <i class="material-icons">library_books</i>
                </div>
                <h4 class="card-title">
                    Data Survey Calon
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table border">
                            <thead style="background-color:#EE9B21">
                                <tr>
                                    <th>Nama</th>
                                    <th class="text-center" width="10%">Survey</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($calon->result() as $tmp) : ?>
                                    <tr>
                                        <td><?php echo $tmp->nama_calon; ?></td>
                                        <td class="text-center"><?php echo $tmp->survey != '' ? $tmp->survey : 0; ?></td>
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
<script>
    $(document).ready(function() {
        $('.table').dataTable({
            "ordering": false,
            "pageLength": 50
        });

        var dataCalon = [];
        var dataSurvey = [];
        var dataMark = [];
        var counter = 0;

        <?php foreach ($calon->result() as $data) : ?>
            dataCalon.push("<?= $data->nama_calon; ?>");
            dataSurvey.push(<?= $data->survey != '' ? $data->survey : 0; ?>);
            dataMark.push({
                value: <?= $data->survey != '' ? $data->survey : 0; ?>,
                xAxis: counter++,
                yAxis: <?= $data->survey != '' ? $data->survey : 0; ?>
            });
        <?php endforeach; ?>

        var dom = document.getElementById("colouredBarsChart");
        var myChart = echarts.init(dom);
        var app = {};

        option = null;
        option = {
            title: {
                text: '<?= $calon->result()[0]->nama_surveyor; ?>',
                subtext: '<?= date('d-m-Y', strtotime($calon->result()[0]->survey_date)); ?>'
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: ['Survey']
            },
            toolbox: {
                show: true,
                feature: {
                    magicType: {
                        type: ['line', 'bar'],
                        title: {
                            line: 'Line',
                            bar: 'Bar'
                        }
                    },
                    restore: {
                        title: 'Refresh'
                    },
                    saveAsImage: {
                        title: 'Save'
                    }
                }
            },
            grid: [{
                bottom: 100
            }],
            xAxis: {
                type: 'category',
                data: dataCalon,
                axisLabel: {
                    margin: 30
                }
            },
            yAxis: {
                type: 'value',
                axisLabel: {
                    formatter: '{value}'
                }
            },
            dataZoom: [{
                type: 'inside',
                start: 25,
                end: 50
            }, {
                start: 0,
                end: 10,
                handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
                handleSize: '80%',
                handleStyle: {
                    color: '#fff',
                    shadowBlur: 3,
                    shadowColor: 'rgba(0, 0, 0, 0.6)',
                    shadowOffsetX: 2,
                    shadowOffsetY: 2
                }
            }],
            series: [{
                name: 'Survey',
                type: 'bar',
                data: dataSurvey,
                itemStyle: {
                    color: '#26c6da'
                },
                markPoint: {
                    data: dataMark,
                    label: {
                        fontSize: 14,
                        fontWeight: 'bold'
                    }
                }
            }]
        };
        if (option && typeof option === "object") {
            myChart.setOption(option, true);
        }
    })
</script>
<script>
    function back() {
        processStart();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>calon/survey",
            data: {}
        }).done(function(msg) {
            processDone();
            $("#page-content").html(msg)
        });
    }
</script>