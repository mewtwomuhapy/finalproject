<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\ordersController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\prosController;
use App\Http\Controllers\p_sysController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\assignController;
use App\Http\Controllers\techController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function(){


    


    Route::group(['middleware'=>['auth:sanctum']],function() {
        Route::get('/dashboard', function () {
            //มาจากModel user
            $users=User::all();
            return view('dashboard',compact('users'));
        })->name('dashboard');

        Route::get('register-step2',[\App\Http\Controllers\DropdownController::class,'create'])->name(name:'register-step2.create');
        Route::post('register-step2',[\App\Http\Controllers\DropdownController::class,'store'])->name(name:'register-step2.post');

        
    
    

    });

Route::get('/admin/users/index',[userController::class,'index'])->name('usersmanage');
Route::get('/admin/users/delete/{id}',[userController::class,'delete']);






    //จัดการแผนก
Route::get('/department/all',[DepartmentController::class,'index'])->name('department');
Route::post('/department/all',[DepartmentController::class,'store'])->name('adddepartment');
Route::get('/department/edit/{id}',[DepartmentController::class,'edit']);
Route::post('/department/update/{id}',[DepartmentController::class,'update']);
Route::get('/department/softdelete/{id}',[DepartmentController::class,'softdelete']);
Route::get('/department/restore/{id}',[DepartmentController::class,'restore']);
Route::get('/department/delete/{id}',[DepartmentController::class,'delete']);







//จัดการอุปกรณ์

Route::get('/tools/all',[ToolsController::class,'index'])->name('tools');

Route::post('/tools/all',[ToolsController::class,'store'])->name('addtools');

Route::get('/tools/edit/{id}',[ToolsController::class,'edit']);

Route::post('/tools/update/{id}',[ToolsController::class,'update']);

Route::get('/tools/softdelete/{id}',[ToolsController::class,'softdelete']);

Route::get('/tools/restore/{id}',[ToolsController::class,'restore']);

Route::get('/tools/delete/{id}',[ToolsController::class,'delete']);




//จัดการตำแหน่ง

Route::get('/pros/all',[prosController::class,'index'])->name('pros');

Route::post('/pros/all',[prosController::class,'store'])->name('addpros');

Route::get('/pros/edit/{id}',[prosController::class,'edit']);

Route::post('/pros/update/{id}',[prosController::class,'update']);

Route::get('/pros/softdelete/{id}',[prosController::class,'softdelete']);

Route::get('/pros/restore/{id}',[prosController::class,'restore']);

Route::get('/pros/delete/{id}',[prosController::class,'delete']);





//จัดการกระบวนการ

Route::get('/p_sys/all',[p_sysController::class,'index'])->name('p_sys');

Route::post('/p_sys/all',[p_sysController::class,'store'])->name('addp_sys');

Route::get('/p_sys/edit/{id}',[p_sysController::class,'edit']);

Route::post('/p_sys/update/{id}',[p_sysController::class,'update']);

Route::get('/p_sys/softdelete/{id}',[p_sysController::class,'softdelete']);

Route::get('/p_sys/restore/{id}',[p_sysController::class,'restore']);

Route::get('/p_sys/delete/{id}',[p_sysController::class,'delete']);


//จัดการอาคาร

Route::get('/building/all',[BuildingController::class,'index'])->name('building');

Route::post('/building/all',[BuildingController::class,'store'])->name('addbuilding');

Route::get('/building/edit/{id}',[BuildingController::class,'edit']);

Route::post('/building/update/{id}',[BuildingController::class,'update']);

Route::get('/building/softdelete/{id}',[BuildingController::class,'softdelete']);

Route::get('/building/restore/{id}',[BuildingController::class,'restore']);

Route::get('/building/delete/{id}',[BuildingController::class,'delete']);




//user order
Route::get('/order/all',[ordersController::class,'index'])->name('orders');
Route::post('/order/form',[ordersController::class,'store'])->name('addorders');
Route::get('order/form',[ordersController::class,'create'])->name('createorders');
Route::get('/order/ordertrack',[ordersController::class,'ordertrack'])->name('ordertrack');
Route::get('/order/detail/{id}',[ordersController::class,'detail']);
//manager assign
Route::get('/assign/all',[assignController::class,'index'])->name('assigns');
Route::get('/assign/p1',[assignController::class,'index3'])->name('p1');
Route::get('/assign/p2',[assignController::class,'index4'])->name('p2');
Route::get('/assign/p3',[assignController::class,'index5'])->name('p3');
Route::get('/assign/edit/{id}',[assignController::class,'edit']);
Route::post('/assign/update/{id}',[assignController::class,'update']);
Route::get('/assign/assign/{id}',[assignController::class,'edit2']);
Route::post('/assign/update2/{id}',[assignController::class,'update2']);
Route::get('/assign/summary',[assignController::class,'index2'])->name('summary');
Route::get('/assign/search/',[assignController::class,'search'])->name('search');

Route::get('/assign/chart1',[assignController::class,'chart2'])->name('chart1');
Route::get('/assign/chart2',[assignController::class,'chart3'])->name('chart2');
Route::get('/assign/chart3',[assignController::class,'chart4'])->name('chart3');






//tech techwork
Route::get('/techwork/all',[techController::class,'index'])->name('techwork');
Route::get('/techwork/track',[techController::class,'techtrack'])->name('techtrack');
});






