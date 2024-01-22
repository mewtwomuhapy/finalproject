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


class assignController extends Controller
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
       
        

        return view('manager.assign.index',compact('orders','Building','tools','p_sys','user1'));


    }

    public function edit($id){
        
        $id;
        $user=User::Where('role_id',2)->get();
        $p_sys=p_sys::with('orders')->get();
        $orders = orders::find($id)->get();

        return view('manager.assign.edit',compact('orders','p_sys','id','user'));
    }

    public function update(Request $request , $id){
        $p_sys_id = $request->input('p_sys_id');
        $id = $request->input('id');
       $UpdateDetails = DB::update('update orders set p_sys_id = ? where id = ?',[$p_sys_id,$id]);
        if (is_null($UpdateDetails)) {
            return false;
        }
        return redirect()->route('assigns')->with('success',"อัพเดดข้อมูลเรียบร้อย");
     }



     public function edit2($id){
        
        $id;
        $user=User::Where('role_id',2)->get();
        $orders = orders::find($id)->get();

        return view('manager.assign.assign',compact('orders','id','user'));
    }

    public function update2(Request $request , $id){
        $tech_name =$request->input('tech_name');
        $id = $request->input('id');
       $UpdateDetails = DB::update('update orders set tech_name = ? where id = ?',[$tech_name,$id]);
        if (is_null($UpdateDetails)) {
            return false;
        }
        return redirect()->route('assigns')->with('success',"อัพเดดข้อมูลเรียบร้อย");
     }




     public function index2(Request $request){
        $orders=orders::all();
        $count1 = count($orders);
        $orders2 = orders::select("*")->where([
            ["p_sys_id","=", "1"]
        ])
        ->get(); 

        $orders3 = orders::select("*")->where([
            ["p_sys_id","=", "2"]
        ])
        ->get(); 


        $orders4 = orders::select("*")->where([
            ["p_sys_id","=", "3"]
        ])
        ->get(); 

        $x = $request->input('x');
        $e = $request->input('e');
        
         
        $result = DB::select(DB::raw("select count(p_sys_id) as order_pname,p_sys.p_sys_name from orders LEFT JOIN p_sys ON p_sys.id = orders.p_sys_id WHERE orders.updated_at = '$x' GROUP BY orders.p_sys_id;
        "));
        $data = "";
        foreach($result as $val){
            $data.="['".$val->p_sys_name."', ".$val->order_pname."],";
        }
        $chartData =$data;


        $result1 = DB::select(DB::raw("select count(tools_id) as order_toolsname,tools.tools_name from orders LEFT JOIN tools ON tools.id = orders.tools_id WHERE orders.updated_at = '$x' GROUP BY orders.tools_id;
        ;
        "));
        $data1 = "";
        foreach($result1 as $val1){
            $data1.="['".$val1->tools_name."', ".$val1->order_toolsname."],";
        }
        $chartData1 =$data1;

        $result2 = DB::select(DB::raw("select count(p_sys_id) as order_pname,p_sys.p_sys_name,orders.updated_at as years from orders LEFT JOIN p_sys ON p_sys.id = orders.p_sys_id WHERE orders.p_sys_id = '1' GROUP BY orders.updated_at;

        "));
        $data2 = "";
        foreach($result2 as $val2){
            $data2.="['".$val2->years."',".$val2->order_pname.",".$val2->p_sys_name."],";
        }
        $chartData2 =$data2;


        return view('manager.assign.summary',compact('orders','orders2','orders3','orders4','chartData','chartData1','chartData2','x'));
     }








     

     public function chart2(Request $request){
        $orders=orders::all();
        $count1 = count($orders);
        $orders2 = orders::select("*")->where([
            ["p_sys_id","=", "1"]
        ])
        ->get(); 

        $orders3 = orders::select("*")->where([
            ["p_sys_id","=", "2"]
        ])
        ->get(); 


        $orders4 = orders::select("*")->where([
            ["p_sys_id","=", "3"]
        ])
        ->get(); 

        $x = $request->input('x');
        $e = $request->input('e');
        
         
        $result = DB::select(DB::raw("select count(p_sys_id) as order_pname,p_sys.p_sys_name from orders LEFT JOIN p_sys ON p_sys.id = orders.p_sys_id WHERE orders.updated_at = '$x' GROUP BY orders.p_sys_id;
        "));
        $data = "";
        foreach($result as $val){
            $data.="['".$val->p_sys_name."', ".$val->order_pname."],";
        }
        $chartData =$data;


        $result1 = DB::select(DB::raw("select count(tools_id) as order_toolsname,tools.tools_name from orders LEFT JOIN tools ON tools.id = orders.tools_id WHERE orders.updated_at = '$x' GROUP BY orders.tools_id;
        ;
        "));
        $data1 = "";
        foreach($result1 as $val1){
            $data1.="['".$val1->tools_name."', ".$val1->order_toolsname."],";
        }
        $chartData1 =$data1;

        $result2 = DB::select(DB::raw("select count(p_sys_id) as order_pname,p_sys.p_sys_name,orders.updated_at as years from orders LEFT JOIN p_sys ON p_sys.id = orders.p_sys_id WHERE orders.p_sys_id = '1' GROUP BY orders.updated_at;
        "));
        $data2 = "";
        foreach($result2 as $val2){
            $data2.="['".$val2->years."',".$val2->order_pname."],";
        }
        $chartData2 =$data2;


        return view('manager.assign.chart1', compact('orders','orders','orders2','orders3','orders4','chartData','chartData1','chartData2','x'));

     }









     public function chart3(Request $request){
        $orders=orders::all();
        $count1 = count($orders);
        $orders2 = orders::select("*")->where([
            ["p_sys_id","=", "1"]
        ])
        ->get(); 

        $orders3 = orders::select("*")->where([
            ["p_sys_id","=", "2"]
        ])
        ->get(); 


        $orders4 = orders::select("*")->where([
            ["p_sys_id","=", "3"]
        ])
        ->get(); 

        $x = $request->input('x');
        $e = $request->input('e');
        
         
        $result = DB::select(DB::raw("select count(p_sys_id) as order_pname,p_sys.p_sys_name from orders LEFT JOIN p_sys ON p_sys.id = orders.p_sys_id WHERE orders.updated_at = '$x' GROUP BY orders.p_sys_id;
        "));
        $data = "";
        foreach($result as $val){
            $data.="['".$val->p_sys_name."', ".$val->order_pname."],";
        }
        $chartData =$data;


        $result1 = DB::select(DB::raw("select count(tools_id) as order_toolsname,tools.tools_name from orders LEFT JOIN tools ON tools.id = orders.tools_id WHERE orders.updated_at = '$x' GROUP BY orders.tools_id;
        ;
        "));
        $data1 = "";
        foreach($result1 as $val1){
            $data1.="['".$val1->tools_name."', ".$val1->order_toolsname."],";
        }
        $chartData1 =$data1;

        $result2 = DB::select(DB::raw("select count(p_sys_id) as order_pname,p_sys.p_sys_name,orders.updated_at as years from orders LEFT JOIN p_sys ON p_sys.id = orders.p_sys_id WHERE orders.p_sys_id = '2' GROUP BY orders.updated_at;
        "));
        $data2 = "";
        foreach($result2 as $val2){
            $data2.="['".$val2->years."',".$val2->order_pname."],";
        }
        $chartData2 =$data2;


        return view('manager.assign.chart2', compact('orders','orders','orders2','orders3','orders4','chartData','chartData1','chartData2','x'));

     }


     public function chart4(Request $request){
        $orders=orders::all();
        $count1 = count($orders);
        $orders2 = orders::select("*")->where([
            ["p_sys_id","=", "1"]
        ])
        ->get(); 

        $orders3 = orders::select("*")->where([
            ["p_sys_id","=", "2"]
        ])
        ->get(); 


        $orders4 = orders::select("*")->where([
            ["p_sys_id","=", "3"]
        ])
        ->get(); 

        $x = $request->input('x');
        $e = $request->input('e');
        
         
        $result = DB::select(DB::raw("select count(p_sys_id) as order_pname,p_sys.p_sys_name from orders LEFT JOIN p_sys ON p_sys.id = orders.p_sys_id WHERE orders.updated_at = '$x' GROUP BY orders.p_sys_id;
        "));
        $data = "";
        foreach($result as $val){
            $data.="['".$val->p_sys_name."', ".$val->order_pname."],";
        }
        $chartData =$data;


        $result1 = DB::select(DB::raw("select count(tools_id) as order_toolsname,tools.tools_name from orders LEFT JOIN tools ON tools.id = orders.tools_id WHERE orders.updated_at = '$x' GROUP BY orders.tools_id;
        ;
        "));
        $data1 = "";
        foreach($result1 as $val1){
            $data1.="['".$val1->tools_name."', ".$val1->order_toolsname."],";
        }
        $chartData1 =$data1;

        $result2 = DB::select(DB::raw("select count(p_sys_id) as order_pname,p_sys.p_sys_name,orders.updated_at as years from orders LEFT JOIN p_sys ON p_sys.id = orders.p_sys_id WHERE orders.p_sys_id = '3' GROUP BY orders.updated_at;
        "));
        $data2 = "";
        foreach($result2 as $val2){
            $data2.="['".$val2->years."',".$val2->order_pname."],";
        }
        $chartData2 =$data2;


        return view('manager.assign.chart3', compact('orders','orders','orders2','orders3','orders4','chartData','chartData1','chartData2','x'));

     }


     public function index3(){

        
        $p1 = orders::orderBy('id','desc')->select("*")->where([
            ["p_sys_id","=", "1"]
        ])
        ->get(); 

        return view('manager.assign.p1',compact('p1'));;


    }

    public function index4(){

        
        $p2 = orders::orderBy('id','desc')->select("*")->where([
            ["p_sys_id","=", "2"]
        ])
        ->get(); 

        return view('manager.assign.p2',compact('p2'));;


    }
    public function index5(){

        
        $p3 = orders::orderBy('id','desc')->select("*")->where([
            ["p_sys_id","=", "3"]
        ])
        ->get(); 

        return view('manager.assign.p3',compact('p3'));;


    }

    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
    
        // Search in the title and body columns from the posts table
        $posts = orders::query()
            ->where('created_at', 'LIKE', "%{$search}%")
            ->get();
    
        // Return the search view with the resluts compacted
        return view('manager.assign.search', compact('posts'));
    }
    
    public function chart1(){

        
        

        return view('manager.assign.chart1');


    }


     
}


//assign มอบหมายงาน resources/view/manager