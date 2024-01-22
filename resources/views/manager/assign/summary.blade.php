<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           สวัสดีหัวหน้า, {{Auth::user()->name}}


        </h2>
    </x-slot>
    <div class="py-12">
   <div class="container">
   <div class="row">
<div class="col-md-12">
    @if(session("success"))
    <div class="alert alert-success">{{session('success')}}</div>
    @endif
    
    
    <a href="{{ route('assigns') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">งานทั้งหมด {{$count2 = count($orders)}}</a>

&nbsp;&nbsp;&nbsp;&nbsp;
<a href="{{ route('chart1') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">รอดำเนินการ {{$count2 = count($orders2)}}</a>
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="{{ route('chart2') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">ดำเนินการ {{$count2 = count($orders4)}}</a>
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="{{ route('chart3') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">ปิดงาน {{$count2 = count($orders3)}}</a>
  </div>
   </div>
    </div>

    
    <div class="py-12">
   <div class="container">
   <div class="row">
<div class="col-md-12">
<br>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['p_sys_name', 'p_sys_id_Count'],
       <?php echo $chartData;?>
        ]);

        var options = {
          title: 'สถานะงานในปี <?php echo $x;?>'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }


    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
   
  </body>
</div>
   </div>
    </div>


    <div class="py-12">
   <div class="container">
   <div class="row">
<div class="col-md-12">

  <html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          <?php echo $chartData1;?>
        ]);

        var options = {
          title: 'อุปกรณ์ที่เสียบ่อยในปี <?php echo $x;?>',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="donutchart" style="width: 900px; height: 500px;"></div>
  </body>
  
  <form>
  <div class="form-group">
          <label for="x">Year</label>
          <input type="number" id="x" name="x" class="form-control" value="<?php echo date('Y');?>" required="">
        </div>
        
    </form>


    <div class="py-12">
   <div class="container">
   <div class="row">
<div class="col-md-12">
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['ข้อมูลปี <?php echo $x;?>','ประเภทอุปกรณ์'],
        <?php echo $chartData1;?>

        ]);

        var options = {
          chart: {
            title: 'ข้อมูลจำนวนอุปกรณ์ที่เสียในปี <?php echo $x;?>',
            subtitle: 'Years, ,tools_id_count,tools_name_count',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body>
    <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
  </body>
</html>
</div>


</x-app-layout>