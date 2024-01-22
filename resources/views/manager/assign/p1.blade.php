<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           สวัสดีหัวหน้า, {{Auth::user()->name}}
        </h2>
        <form action="{{ route('search') }}" method="GET">
    {{ csrf_field() }}
    <input type="date" class="form-control" name="search" pattern="\d{4}-\d{2}-\d{2}"  required/>
    <button type="submit" class="btn btn-default">
     <span class="glyphicon glyphicon-search"></span></button>
</form>
    </x-slot>
    

    <div class="py-12">
   <div class="container">
   <div class="row">
<div class="col-md-12">
    @if(session("success"))
    <div class="alert alert-success">{{session('success')}}</div>
    @endif
    <div class="card">
        <div class="card-header">รายการแจ้งซ่อมจากสมาชิก</div>
   <table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">ลำดับ</th>
      <th scope="col">ชื่อผู้แจ้งซ่อม</th>
      <th scope="col">อุปกรณ์</th>
      <th scope="col">ปัญหา</th>
      <th scope="col">เวลาที่แจ้ง</th>
      <th scope="col">สถานะ</th>
      <th scope="col">เปลี่ยนสถานะงาน</th>
      <th scope="col">ชื่อนายช่าง</th>
      <th scope="col">Assign</th>
    </tr>
  </thead>
  <tbody class="table-group-divider" >
    @php($i=1)
  @foreach($p1 as $row)
    <tr>
        <!--ลูปroderเริ่มจากไอเทมแรก-->
      <th>{{$i++}}</th>
      <td>{{$row->user->name}}</td>
      <td>{{$row->tools->tools_name}}</td>
      <td>{{$row->description}}</td>
      <td>{{$row->created_at}}</td>
      <td>{{$row->p_sys->p_sys_name}}</td>
      <td> <a href="{{url('/assign/edit/'.$row->id)}}"class="btn btn-primary">เปลี่ยนสถานะงาน</td>
      <td>{{$row->tech_name}}</td>
      <td> <a href="{{url('/assign/assign/'.$row->id)}}"class="btn btn-success">เลือกนายช่าง</td>
    </tr>
    @endforeach
  </tbody>
</table>


  </div>
   </div>

    </div>


</x-app-layout>