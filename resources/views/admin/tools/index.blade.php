<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           สวัสดี, {{Auth::user()->name}}
        </h2>
    </x-slot>

    <div class="py-12">
   <div class="container">
   <div class="row">
<div class="col-md-8">
    @if(session("success"))
    <div class="alert alert-success">{{session('success')}}</div>
    @endif
    <div class="card">
        <div class="card-header">ตารางข้อมูลอุปกรณ์</div>
   <table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">ลำดับ</th>
      <th scope="col">ชื่ออุปกรณ์</th>
      <th scope="col">เวลาที่เพิ่มเข้าระบบครั้งแรก</th>
      <th scope="col">แก้ไข</th>
      <th scope="col">ลบข้อมูล</th>
    </tr>
  </thead>
  <tbody class="table-group-divider" >
    @foreach($tools as $row )
    <tr>
        <!--ลูปDepartmentเริ่มจากไอเทมแรก-->
      <th>{{$tools->firstItem()+$loop->index}}</th>
      <td>{{$row->tools_name}}</td>
      <td>{{$row->created_at->diffForhumans()}}</td>
      <td> <a href="{{url('/tools/edit/'.$row->id)}}"class="btn btn-primary">แก้ไข</td>
      <td> <a href="{{url('/tools/softdelete/'.$row->id)}}"class="btn btn-warning">ลบข้อมูล</td>
    </tr>
    @endforeach
  </tbody>
</table>
<!--detail page -->
{{$tools->links()}}
    </div>
@if(count($trashtools)>0)
<div class="card my-2">
        <div class="card-header">ถังขยะ</div>
        <table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">ลำดับ</th>
      <th scope="col">ชื่ออุปกรณ์</th>
      <th scope="col">เวลาที่เพิ่มเข้าระบบครั้งแรก</th>
      <th scope="col">กู้คืนข้อมูล</th>
      <th scope="col">ลบข้อมูลถาวร</th>
    </tr>
  </thead>
  <tbody class="table-group-divider" >
    @foreach($trashtools as $row )
    <tr>
        <!--ลูปDepartmentเริ่มจากไอเทมแรก-->
      <th>{{$trashtools->firstItem()+$loop->index}}</th>
      <td>{{$row->tools_name}}</td>
      <td>{{$row->created_at->diffForhumans()}}</td>
      <td> <a href="{{url('/tools/restore/'.$row->id)}}"class="btn btn-primary">กู้คืนข้อมูล</td>
      <td> <a href="{{url('/tools/delete/'.$row->id)}}"class="btn btn-danger">ลบข้อมูลถาวร</td>
    </tr>
    @endforeach
  </tbody>
</table>
{{$trashtools->links()}}
    </div>
    @endif 
</div>
<div class="col-md-4">
    <div class="card">
  <div class="card-header">แบบฟอร์ม</div>
  <div class="card-body">
    <form action="{{route('addtools')}}" method="post">
    <!--ใช้ป้องกันการแฮคเข้าฐานข้อมูลผ่านการกรอกแบบฟอม รูปแบบ ป้อนscriptเข้ามา-->
        @csrf
        <div class="form-group">
        <label for="tools_name">ชื่ออุปกรณ์</label>
        <input type="text" class="form-control" name="tools_name"> 
        </div>
        @error('tools_name')
        <div class="my-2">
        <span class="text-danger my-2">{{$message}}</span>
        </div>

        @enderror
        <br>
        <input type="submit" value="บันทึก" class='btn btn-primary'>
    </form>
  </div>
   </div>
    </div>
</x-app-layout>