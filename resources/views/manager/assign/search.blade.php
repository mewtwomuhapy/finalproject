

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           สวัสดี, {{Auth::user()->name}}
        </h2>

        <form action="{{ route('search') }}" method="POST">
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
      <th scope="col">สถานะ</th>
      <th scope="col">เวลาที่แจ้ง</th>
      <!--Assign=มอบหมาย-->

      <th scope="col">ชื่อนายช่าง</th>
      @if (auth()->user()->role_id == 3)
      <th scope="col">Assign</th>

                    @endif
    </tr>
  </thead>
  <tbody class="table-group-divider" >
  @if($posts->isNotEmpty())
    @foreach ($posts as $post)
    @php($i=1)
    <tr>
        <!--ลูปroderเริ่มจากไอเทมแรก-->
      <th>{{$i++}}</th>
      <td>{{$post->user->name}}</td>
      <td>{{$post->tools->tools_name}}</td>
      <td>{{$post->description}}</td>
      <td>{{$post->p_sys->p_sys_name}}</td>
      <td>{{$post->created_at}}</td>
      <td>{{$post->tech_name}}</td>
      @if (auth()->user()->role_id == 3)
      <td> <a href="{{url('/assign/assign/'.$post->id)}}"class="btn btn-success">เลือกนายช่าง</td>

                    @endif
    </tr>
    @endforeach
  </tbody>
</table>
@else
<div>
        <h2>No posts found</h2>
    </div>
@endif



  </div>
   </div>

    </div>


</x-app-layout>
