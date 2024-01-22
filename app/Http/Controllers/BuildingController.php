<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BuildingController extends Controller
{

    public function index(){
        //หน้าโชว์ที่ละ5
        $Building=Building::paginate(5);
        $trashBuilding = Building::onlyTrashed()->paginate(2);
        return view('admin.building.index',compact('Building','trashBuilding'));
    }

    public function store(Request $request){
        //ตรวจสอบข้อมูล
        $request->validate([
            'buildings_name'=>'required|unique:buildings|max:255'
        ],
    
        ['buildings_name.required'=>"กรุณาป้อนชื่ออาคารด้วยครับ",
        'buildings_name.max'=> "ห้ามป้อนเกิน 255 ตัวอักษร",
        'buildings_name.unique'=> "ห้ามป้อนชื่ออาคารซ้ำ"
        ]
    
    );

    //บันทึกข้อมูล
        $Building = new Building;
        $Building->buildings_name = $request ->buildings_name;
        $Building->user_id = Auth::user()->id;
        $Building->save();
    return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }

    //แก้ไข

    public function edit($id){
        $Building = Building::find($id);
        return view('admin.building.edit',compact('Building'));
    }

    public function update(Request $request , $id){
        //ตรวจสอบข้อมูล
        $request->validate([
           'buildings_name'=>'required|unique:buildings|max:255'
       ],
   
       ['buildings_name.required'=>"กรุณาป้อนชื่ออาคารด้วยครับ",
       'buildings_name.max'=> "ห้ามป้อนเกิน 255 ตัวอักษร",
       'buildings_name.unique'=> "ห้ามป้อนชื่ออาคารซ้ำ"
       ]
   
   
   );
   
   $update = Building::find($id)->update([
       'buildings_name'=>$request->buildings_name,
       'user_id'=>Auth::user()->id
       
       
   ]);
   
   return redirect()->route('building')->with('success',"อัพเดดข้อมูลเรียบร้อย");
   
       }
       public function softdelete($id){
        $delete = Building::find($id) ->delete();
        return redirect()->route('building')->with('success',"ลบข้อมูลเรียบร้อย");
     }
 
     public function restore($id){
        $restore= Building::withTrashed()->find($id)->restore();
        return redirect()->route('building')->with('success',"กู้คืนข้อมูลเรียบร้อย");
         
     }
 
 
     public function delete($id){
         $delete = Building::onlyTrashed()->find($id)->forcedelete();
         return redirect()->route('building')->with('success',"ลบข้อมูลถาวรเรียบร้อย");
     }

}
