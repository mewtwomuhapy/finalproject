<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           สวัสดี, {{Auth::user()->name}}
        </h2>
    </x-slot>

    <div class="py-12">
   <div class="container">
   <div class="row">
<div class="col-md-12">
    @if(session("success"))
    <div class="alert alert-success">{{session('success')}}</div>
    @endif
    <div class="card">
        <div class="card-header">รายระเอียดที่ช่างซ่อมแจ้ง</div>
   <table class="table table-striped table-hover">
  <thead>
    <tr>
    <th scope="col">ลำดับ</th>
      <th scope="col">อุปกรณ์</th>
      <th scope="col">ดูรายระเอียด</th>
      <th scope="col">ภาพประกอบ</th>
    </tr>
  </thead>
  <tbody class="table-group-divider" >
  @php($i=1)
  @foreach($orders4 as $row)
    <tr>
        <!--ลูปroderเริ่มจากไอเทมแรก-->
      <th>{{$i++}}</th>
      <td>{{$row->tools->tools_name}}</td>
      <td>ปัญหา: {{$row->description}}<br>ห้อง: {{$row->rooms}}<br>ชั้น: {{$row->floors}}<br>อาคาร: {{$row->Building->buildings_name}}<br>ผู้แจ้ง: {{$row->user->name}}<br>วันเวลาที่แจ้งซ่อม: {{$row->created_at}}<br>สถานะ: {{$row->p_sys->p_sys_name}}<br>ความเห็นช่าง: {{$row->descriptionfull}}</td>
      <td>
        <img src="{{ url('storage/app/public/images/'.$row->photo) }}" width= '300' height='300' class="img img-responsive" />
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

  </div>
   </div>

    </div>


</x-app-layout>
