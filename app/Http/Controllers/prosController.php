<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\pros;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class prosController extends Controller
{
    public function index(){
        //หน้าโชว์ที่ละ5
        $pros=pros::paginate(5);
        $trashpros = pros::onlyTrashed()->paginate(2);
        return view('admin.pros.index',compact('pros','trashpros'));
    }


      public function store(Request $request){
        //ตรวจสอบข้อมูล
        $request->validate([
            'pros_name'=>'required|unique:pros|max:255'
        ],
    
        ['pros_name.required'=>"กรุณาป้อนชื่อตำแหน่งด้วยครับ",
        'pros.max'=> "ห้ามป้อนเกิน 255 ตัวอักษร",
        'pros_name.unique'=> "ห้ามป้อนชื่อแผนกซ้ำ"
        ]
    
    );

    //บันทึกข้อมูล
        $pros = new pros;
        $pros->pros_name = $request ->pros_name;
        $pros->user_id = Auth::user()->id;
        $pros->save();
        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }

    //แก้ไข

    public function edit($id){
        $pros = pros::find($id);
        return view('admin.pros.edit',compact('pros'));
    }

    public function update(Request $request , $id){
     //ตรวจสอบข้อมูล
     $request->validate([
        'pros_name'=>'required|unique:pros|max:255'
    ],

    ['pros_name.required'=>"กรุณาป้อนชื่อแผนกด้วยครับ",
    'pros_name.max'=> "ห้ามป้อนเกิน 255 ตัวอักษร",
    'pros.unique'=> "ห้ามป้อนชื่อแผนกซ้ำ"
    ]

);

$update = pros::find($id)->update([
    'pros_name'=>$request->pros_name,
    'user_id'=>Auth::user()->id
    
    
]);

return redirect()->route('pros')->with('success',"อัพเดดข้อมูลเรียบร้อย");

    }


    public function softdelete($id){
       $delete =  pros::find($id) ->delete();
       return redirect()->route('pros')->with('success',"ลบข้อมูลเรียบร้อย");
    }

    public function restore($id){
       $restore= pros::withTrashed()->find($id)->restore();
       return redirect()->route('pros')->with('success',"กู้คืนข้อมูลเรียบร้อย");
        
    }


    public function delete($id){
        $delete = pros::onlyTrashed()->find($id)->forcedelete();
        return redirect()->route('pros')->with('success',"ลบข้อมูลถาวรเรียบร้อย");
    }

   




    
}


