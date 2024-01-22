<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\pros;
use Illuminate\Support\Facades\DB;


class userController extends Controller
{
    public function index()

    {
        $user=User::with('Role','pros','Department')->get();
        $Role=Role::with('User')->get();
        $pros=pros::with('User')->get();
        $Department=Department::with('User')->get();
        $user=user::paginate(5);

        return view('admin.users.index',compact('user','Role','pros','Department'));
    }


    public function delete($id){
        DB::delete('delete from users where id = ?',[$id]);
        return redirect()->route('usersmanage')->with('success',"ลบข้อมูลถาวรเรียบร้อย");

    }
   
}
