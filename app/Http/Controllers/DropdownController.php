<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Department;
use App\Models\pros;

use Illuminate\Http\Request;

class DropdownController extends Controller
{
    public function create()
    {
        $pros = pros::all();
        $Department = Department::all();
       return view('auth.register-step2', compact('Department','pros'));

      

    }

    public function store(Request $request)
    {
         auth()->user()->update([
       'depart_id' => $request->depart_id,
       'pros_id' => $request->pros_id,



         ]);

         return redirect()->route('dashboard');
         

    }



    
}
