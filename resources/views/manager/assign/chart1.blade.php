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
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['ข้อมูลแต่ละปีที่เหลือสถานะรอดำเนินการ','รอดำเนินการ'],
        <?php echo $chartData2;?>

        ]);

        var options = {
          chart: {
            title: 'ข้อมูลจำนวนรอดำเนินการแต่ละปี',
            subtitle: 'Years, ,p_sys_id_count,p_sys_name',
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