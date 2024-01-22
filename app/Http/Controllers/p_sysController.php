<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\p_sys;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class p_sysController extends Controller
{
    public function index(){
        //หน้าโชว์ที่ละ5
        $p_sys=p_sys::paginate(5);
        $trashp_sys = p_sys::onlyTrashed()->paginate(2);
        return view('admin.p_sys.index',compact('p_sys','trashp_sys'));
    }


      public function store(Request $request){
        //ตรวจสอบข้อมูล
        $request->validate([
            'p_sys_name'=>'required|unique:p_sys|max:255'
        ],
    
        ['p_sys_name.required'=>"กรุณาป้อนชื่อแผนกด้วยครับ",
        'p_sys.max'=> "ห้ามป้อนเกิน 255 ตัวอักษร",
        'p_sys_name.unique'=> "ห้ามป้อนชื่อแผนกซ้ำ"
        ]
    
    );

    //บันทึกข้อมูล
        $p_sys = new p_sys;
        $p_sys->p_sys_name = $request ->p_sys_name;
        $p_sys->user_id = Auth::user()->id;
        $p_sys->save();
        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }

    //แก้ไข

    public function edit($id){
        $p_sys = p_sys::find($id);
        return view('admin.p_sys.edit',compact('p_sys'));
    }

    public function update(Request $request , $id){
     //ตรวจสอบข้อมูล
     $request->validate([
        'p_sys_name'=>'required|unique:p_sys|max:255'
    ],

    ['p_sys_name.required'=>"กรุณาป้อนชื่อแผนกด้วยครับ",
    'p_sys_name.max'=> "ห้ามป้อนเกิน 255 ตัวอักษร",
    'p_sys.unique'=> "ห้ามป้อนชื่อแผนกซ้ำ"
    ]

);

$update = p_sys::find($id)->update([
    'p_sys_name'=>$request->p_sys_name,
    'user_id'=>Auth::user()->id
    
    
]);

return redirect()->route('p_sys')->with('success',"อัพเดดข้อมูลเรียบร้อย");

    }


    public function softdelete($id){
       $delete =  p_sys::find($id) ->delete();
       return redirect()->route('p_sys')->with('success',"ลบข้อมูลเรียบร้อย");
    }

    public function restore($id){
       $restore= p_sys::withTrashed()->find($id)->restore();
       return redirect()->route('p_sys')->with('success',"กู้คืนข้อมูลเรียบร้อย");
        
    }


    public function delete($id){
        $delete = p_sys::onlyTrashed()->find($id)->forcedelete();
        return redirect()->route('p_sys')->with('success',"ลบข้อมูลถาวรเรียบร้อย");
    }


}
