<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tools;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ToolsController extends Controller
{

    public function index(){
        //หน้าโชว์ที่ละ5
        $tools=tools::paginate(5);
        $trashtools = tools::onlyTrashed()->paginate(2);
        return view('admin.tools.index',compact('tools','trashtools'));
    }


      public function store(Request $request){
        //ตรวจสอบข้อมูล
        $request->validate([
            'tools_name'=>'required|unique:tools|max:255'
        ],
    
        ['tools_name.required'=>"กรุณาป้อนชื่ออุปกรณ์ด้วยครับ",
        'tools_name.max'=> "ห้ามป้อนเกิน 255 ตัวอักษร",
        'tools_name.unique'=> "ห้ามป้อนชื่ออุปกรณ์ซ้ำ"
        ]
    
    );

    //บันทึกข้อมูล
        $tools = new tools;
        $tools->tools_name = $request ->tools_name;
        $tools->user_id = Auth::user()->id;
        $tools->save();
        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }

    //แก้ไข

    public function edit($id){
        $tools = tools::find($id);
        return view('admin.tools.edit',compact('tools'));
    }

    public function update(Request $request , $id){
     //ตรวจสอบข้อมูล
     $request->validate([
        'tools_name'=>'required|unique:tools|max:255'
    ],

    ['tools_name.required'=>"กรุณาป้อนชื่ออุปกรณ์ด้วยครับ",
    'tools_name.max'=> "ห้ามป้อนเกิน 255 ตัวอักษร",
    'tools_name.unique'=> "ห้ามป้อนชื่ออุปกรณ์ซ้ำ"
    ]

);

$update = tools::find($id)->update([
    'tools_name'=>$request->tools_name,
    'user_id'=>Auth::user()->id
    
    
]);

return redirect()->route('tools')->with('success',"อัพเดดข้อมูลเรียบร้อย");

    }


    public function softdelete($id){
       $delete =  tools::find($id) ->delete();
       return redirect()->route('tools')->with('success',"ลบข้อมูลเรียบร้อย");
    }

    public function restore($id){
       $restore= tools::withTrashed()->find($id)->restore();
       return redirect()->route('tools')->with('success',"กู้คืนข้อมูลเรียบร้อย");
        
    }


    public function delete($id){
        $delete = tools::onlyTrashed()->find($id)->forcedelete();
        return redirect()->route('tools')->with('success',"ลบข้อมูลถาวรเรียบร้อย");
    }
}
