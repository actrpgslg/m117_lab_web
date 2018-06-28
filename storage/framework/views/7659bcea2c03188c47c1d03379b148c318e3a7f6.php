
<?php $__env->startSection('content'); ?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">當日圖表</h4>
                        <p class="category">24 小時</p>
                    </div>
                    <div class="content">
                        <div id="chart_div" style="width: 100%; height: auto;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">當月時間</h4>
                        <p class="category">天數</p>
                    </div>
                    <div class="content" style="height: auto;">
                          <div id="Timeline" style="height: auto;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">當前數據 6小時</h4>
                        <p class="category">數據</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                          <thead>
                            <th>日期</th>
                            <th>溫度</th>
                            <th>濕度</th>
                            <th>光線</th>
                            <th>噪音</th>
                            <th>空氣品質</th>
                          </thead>
                          <tbody>
                            <?php $__currentLoopData = $Nows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Now): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td><?php echo e($Now->Date); ?></td>
                              <td><?php echo e($Now->temp); ?></td>
                              <td><?php echo e($Now->hum); ?></td>
                              <td><?php echo e($Now->light); ?></td>
                              <td><?php echo e($Now->sound); ?></td>
                              <td><?php echo e($Now->air_quality); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </tbody>
                          
                        </table>
                    </div>
                </div>
            </div>
        </div>
        

    </div>
</div> 
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['小時', '亮度'],

      <?php $__currentLoopData = $dayrecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dayrecord): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      [ <?php echo e($dayrecord->Hour); ?> ,  <?php echo e($dayrecord->Light); ?> ],
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    ]);

    var options = {
      title: '亮度',
      hAxis: {title: '小時',  titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };

    var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
</script>
<script type="text/javascript">


    google.charts.load("current", {packages:["timeline"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {


      var container = document.getElementById('Timeline');
      var chart = new google.visualization.Timeline(container);
      var dataTable = new google.visualization.DataTable();
      dataTable.addColumn({ type: 'string', id: 'Day' });
      dataTable.addColumn({ type: 'string', id: 'Light' });
      dataTable.addColumn({ type: 'date', id: 'Start' });
      dataTable.addColumn({ type: 'date', id: 'End' });
      dataTable.addRows([
        [ '顏色', 'Dark', new Date(0,0,0,0,0,0), new Date(0,0,0,12,0,0)],
        [ '顏色', 'Light', new Date(0,0,0,12,0,0), new Date(0,0,0,24,0,0)],
        <?php $__currentLoopData = $monthRecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $monthRecord): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        [ '<?php echo e($monthRecord['Month']); ?>-<?php echo e($monthRecord['Day']); ?>-<?php echo e($monthRecord['Weekday']); ?>','<?php echo e($monthRecord['IF']); ?>',
        new Date(0,0,0,<?php echo e($monthRecord['HourStart']); ?>),
        new Date(0,0,0,<?php echo e($monthRecord['HourEnd']); ?>)],
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ]);

      var rowHeight = dataTable.getNumberOfRows() * 20;
      var chartHeight = rowHeight;

      var options = {
        titlePosition: 'none',
        width: '100%',
        height: chartHeight,
        chartArea: {
          height: rowHeight,
          width: '100%'
        },
        timeline: { showRowLabels: true },
        avoidOverlappingGridLines: true
      };

      chart.draw(dataTable, options);
    }

  </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>