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
<div class="card">
  <div class="card-header">แบบฟอร์มแก้ไขข้อมูล</div>
  <div class="card-body">
    <form action="{{url('/pros/update/'.$pros->id)}}" method="post">
    <!--ใช้ป้องกันการแฮคเข้าฐานข้อมูลผ่านการกรอกแบบฟอม รูปแบบ ป้อนscriptเข้ามา-->
        @csrf
        <div class="form-group">
        <label for="pros_name">ชื่อตำแหน่ง</label>
        <input type="text" class="form-control" name="pros_name" value="{{$pros->pros_name}}"> 
        </div>
        @error('pros_name')
        <div class="my-2">
        <span class="text-danger my-2">{{$message}}</span>
        </div>

        @enderror
        <br>
        <input type="submit" value="อัพเดด" class='btn btn-primary'>
    </form>
  </div>
    </div>
</div>

      
  </div>
   </div>
    </div>
</x-app-layout>