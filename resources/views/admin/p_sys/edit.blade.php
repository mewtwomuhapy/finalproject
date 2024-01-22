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
  <div class="card-header">แบบฟอร์มแก้ไขกระบวนการ</div>
  <div class="card-body">
    <form action="{{url('/p_sys/update/'.$p_sys->id)}}" method="post">
    <!--ใช้ป้องกันการแฮคเข้าฐานข้อมูลผ่านการกรอกแบบฟอม รูปแบบ ป้อนscriptเข้ามา-->
        @csrf
        <div class="form-group">
        <label for="p_sys_name">ชื่อกระบวนการ</label>
        <input type="text" class="form-control" name="p_sys_name" value="{{$p_sys->p_sys_name}}"> 
        </div>
        @error('p_sys_name')
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