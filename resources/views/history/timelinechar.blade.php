@extends('layout.app')
@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">當年圖表</h4>
                        <p class="category">天數</p>
                    </div>
                    <div class="content" style="height: auto;">
                          <div id="Timeline" style="height: auto;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
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