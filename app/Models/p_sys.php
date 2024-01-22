<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\orders;


class p_sys extends Model
{
    use SoftDeletes;
    

    /**ใส่ให้inputเข้าไปได้ในฟอม */
    protected $fillable = [
        'user_id',
        'p_sys_name',
        'p_sys_id',
        
    ];

    public function user(){
        return $this->hasOne(user::class,'id','user_id');
    }

    public function orders(){
        return $this->hasMany(orders::class,'p_sys_id','id');
    }
}
