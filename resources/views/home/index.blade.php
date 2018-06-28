@extends('layout.app')
@section('content')

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
                            @foreach ($Nows  as $Now)
                            <tr>
                              <td>{{$Now->Date}}</td>
                              <td>{{$Now->temp}}</td>
                              <td>{{$Now->hum}}</td>
                              <td>{{$Now->light}}</td>
                              <td>{{$Now->sound}}</td>
                              <td>{{$Now->air_quality}}</td>
                            </tr>
                            @endforeach
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

      @foreach ($dayrecords  as $dayrecord)
      [ {{$dayrecord->Hour}} ,  {{$dayrecord->Light}} ],
      @endforeach
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
        @foreach ($monthRecords  as $monthRecord)
        [ '{{$monthRecord['Month'] }}-{{$monthRecord['Day'] }}-{{$monthRecord['Weekday']}}','{{$monthRecord['IF'] }}',
        new Date(0,0,0,{{$monthRecord['HourStart'] }}),
        new Date(0,0,0,{{$monthRecord['HourEnd']}})],
        @endforeach
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

@endsection