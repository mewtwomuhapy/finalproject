@section('content')
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
   <div class="card-body">
   <form action="{{route('addorders')}}" method="post" enctype="multipart/form-data">
       @csrf

       <div class="mt-4">
                <x-jet-label for="tools_id" value="{{ __('ระบุอุปกรณ์:') }}" />
                <select name="tools_id" x-model="tools_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    @foreach($tools as $tools)
                <option value="{{$tools->id}}">{{ $tools->tools_name}}</option>
                @endforeach
                </select>
            </div>

            <div class="mt-4">
                <x-jet-label for="building_id" value="{{ __('ระบุตึก:') }}" />
                <select name="building_id" x-model="building_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    @foreach($Building as $Building)
                <option value="{{$Building->id}}">{{ $Building->buildings_name}}</option>
                @endforeach
                </select>
            </div>

            
       <div class="mt-4">
                <x-jet-label for="p_sys_id" value="{{ __('ระบุขั้นตอนกระบวนการที่อยู่:') }}" />
                <select name="p_sys_id" x-model="p_sys_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    @foreach($p_sys as $p_sys)
                <option value="{{$p_sys->id}}">{{ $p_sys->p_sys_name}}</option>
                @endforeach
                </select>
            </div>

    </div>
    <div class="form-group">
          <label for="floors">ชั้น</label>
          <input type="text" id="floors" name="floors" class="form-control" required="">
        </div>
        <div class="form-group">
          <label for="rooms">ห้อง</label>
          <textarea name="rooms" class="form-control" required=""></textarea>
        </div>
        <div class="form-group">
          <label for="description">ปัญหา</label>
          <textarea name="description" class="form-control" required=""></textarea>
        </div>
        <div class="form-group">
          <label for="descriptionfull">รายระเอียด</label>
          <textarea name="descriptionfull" class="form-control" ></textarea>
        </div>
        <div class="form-group">
        <label for="photo">เพิ่มรูปภาพ</label>
          <input class="form-control" type="file" required name="photo"></br>
        </div>


        <button type="submit" class="btn btn-primary" >Submit</button>
      </form>
    </div>
</x-app-layout>
