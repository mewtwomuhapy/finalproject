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
    <div class="py-12">
   <div class="container">
   <div class="row">
   <table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">ลำดับ</th>
      <th scope="col">ชื่อ</th>
      <th scope="col">อีเมล</th>
      <th scope="col">เริ่มใช้งานระบบ</th>
      <th scope="col">ตำแหน่ง</th>
      <th scope="col">แผนก</th>
      <th scope="col">สถานะในระบบ</th>
      <th scope="col">ลบข้อมูล</th>
    </tr>
  </thead>
  <tbody class="table-group-divider" >
    @php($i=1)
    @foreach($user as $row)
    <tr>
      <th>{{$i++}}</th>
      <td>{{$row->name}}</td>
      <td>{{$row->email}}</td>
      <td>{{$row->created_at->diffForhumans()}}</td>
      <td>{{$row->pros->pros_name}}</td>
      <td>{{$row->Department->department_name}}</td>
      <td>{{$row->Role->name}}</td>
      <td><a href = 'delete/{{ $row->id }}'class="btn btn-danger">Delete</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
{{$user->links()}}
  </div>
   </div>
    </div>
</x-app-layout>