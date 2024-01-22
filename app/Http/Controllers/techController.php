<?php

namespace App\Http\Controllers;

use App\Models\p_sys;
use App\Models\tools;
use App\Models\Building;
use App\Models\orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;


class techController extends Controller
{
    public function index(){
          
        //$orders=orders::paginate(5);
        $tools=tools::with('orders')->get();
        $orders=orders::with('Building')->get();
        $Building=Building::with('orders')->get();
        $p_sys=p_sys::with('orders')->get();
        $orders=orders::all();
        $orders=orders::orderBy('id','desc')->paginate(5);
        $user1=User::with('user1')->get();
       
        

        return view('tech.techwork.index',compact('orders','Building','tools','p_sys','user1'));
    }


    public function techtrack() 
    {
        $userid =Auth::user()->name;
        $orders2 = orders::orderBy('id','desc')->select("*")->where([
            ["tech_name","=", "$userid"]
        ])
        ->get(); 
        $order2 =orders::paginate(5);

        return view('tech.techwork.track',compact('orders2'));
    }
}
//techwork รับงานจากห้วหน้า resources/view/tech