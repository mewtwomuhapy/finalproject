<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Building;
use App\Models\p_sys;
use App\Models\tools;
use App\Models\User;

class orders extends Model
{
    use HasFactory;

 
   protected $fillable = [
       'user_id',
       'building_id',
       'tools_id',
       'p_sys_id',
       'floors',
       'rooms',
       'description',
       'descriptionfull', 
       'photo',
       'id',
   ];



   public function Building()
   {

       return $this->belongsTo(Building::class,'building_id');
   }

   public function p_sys()
   {

       return $this->belongsTo(p_sys::class,'p_sys_id');
   }

   public function tools()
   {

       return $this->belongsTo(tools::class,'tools_id');
   }

   public function user(){
    return $this->hasOne(User::class,'id','user_id');
    }


    public function user1(){
        return $this->belongsTo(User::class,'id','tech_name');
        }
    
}
