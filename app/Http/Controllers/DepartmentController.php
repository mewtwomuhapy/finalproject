<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{

    public function index(){
        //หน้าโชว์ที่ละ5
        $Department=Department::paginate(5);
        $trashDepartment = Department::onlyTrashed()->paginate(2);
        return view('admin.department.index',compact('Department','trashDepartment'));
    }


      public function store(Request $request){
        //ตรวจสอบข้อมูล
        $request->validate([
            'department_name'=>'required|unique:departments|max:255'
        ],
    
        ['department_name.required'=>"กรุณาป้อนชื่อแผนกด้วยครับ",
        'department_name.max'=> "ห้ามป้อนเกิน 255 ตัวอักษร",
        'department_name.unique'=> "ห้ามป้อนชื่อแผนกซ้ำ"
        ]
    
    );

    //บันทึกข้อมูล
        $Department = new Department;
        $Department->department_name = $request ->department_name;
        $Department->user_id = Auth::user()->id;
        $Department->save();
        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }

    //แก้ไข

    public function edit($id){
        $Department = Department::find($id);
        return view('admin.department.edit',compact('Department'));
    }

    public function update(Request $request , $id){
     //ตรวจสอบข้อมูล
     $request->validate([
        'department_name'=>'required|unique:departments|max:255'
    ],

    ['department_name.required'=>"กรุณาป้อนชื่อแผนกด้วยครับ",
    'department_name.max'=> "ห้ามป้อนเกิน 255 ตัวอักษร",
    'department_name.unique'=> "ห้ามป้อนชื่อแผนกซ้ำ"
    ]

);

$update = Department::find($id)->update([
    'department_name'=>$request->department_name,
    'user_id'=>Auth::user()->id
    
    
]);

return redirect()->route('department')->with('success',"อัพเดดข้อมูลเรียบร้อย");

    }


    public function softdelete($id){
       $delete =  Department::find($id) ->delete();
       return redirect()->route('department')->with('success',"ลบข้อมูลเรียบร้อย");
    }

    public function restore($id){
       $restore= Department::withTrashed()->find($id)->restore();
       return redirect()->route('department')->with('success',"กู้คืนข้อมูลเรียบร้อย");
        
    }


    public function delete($id){
        $delete = Department::onlyTrashed()->find($id)->forcedelete();
        return redirect()->route('department')->with('success',"ลบข้อมูลถาวรเรียบร้อย");
    }
    

}
