<?php

namespace App\Http\Controllers;
use App\Models\p_sys;
use App\Models\tools;
use App\Models\Building;
use App\Models\orders;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class ordersController extends Controller
{

    public function index(){


        //$orders=orders::paginate(5);
        $tools=tools::with('orders')->get();
        $orders=orders::with('Building')->get();
        $Building=Building::with('orders')->get();
        $p_sys=p_sys::with('orders')->get();
        $orders=orders::all();
        $orders=orders::orderBy('id','desc')->paginate(5);


        return view('user.order.index',compact('orders','Building','tools','p_sys'));


    }
    

    public function store(Request $request){
        //ตรวจสอบข้อมูล

    //บันทึกข้อมูล
        $orders = new orders;
        $orders->user_id = Auth::user()->id;
        $orders->tools_id = $request ->tools_id;
        $orders->building_id = $request ->building_id;
        $orders->floors =$request -> floors;
        $orders->rooms =$request -> rooms;
        $orders->description = $request ->description;
        $orders->p_sys_id = $request ->p_sys_id;
        $orders->descriptionfull = $request ->descriptionfull;

        if($request->file('photo')){
            $file= $request->file('photo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('storage/app/public/images'), $filename);
            $orders['photo']= $filename;
            }
         

        $orders->save();
        return redirect()->route('ordertrack');
    }


    public function create()
    {
        
        $tools = tools::all();
        $Building = Building::all();
        $p_sys = p_sys::all();
       return view('user.order.form', compact('tools','Building','p_sys'));

      
    }


    public function ordertrack() 
    {
        $userid =Auth::user()->id;
        $orders2 = orders::orderBy('id','desc')->select("*")->where([
            ["user_id","=", "$userid"]
        ])
        ->get(); 

        return view('user.order.ordertrack',compact('orders2'));
    }
    

    public function detail($id){
        $ordersid = orders::find($id);
        $orders4 = orders::select("*")->where([
            ["id","=","$id"]
        ])
        ->get();
        return view('user.order.detail',compact('orders4'));
    }


    

}
