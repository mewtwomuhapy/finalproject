<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;


class Department extends Model
{
    use HasFactory;
    use SoftDeletes;
    

    /**ใส่ให้inputเข้าไปได้ในฟอม */
    protected $fillable = [
        'user_id',
        'department_name',
        'depart_id',
        
    ];

    public function User(){
        return $this->hasMany(User::class,'id','depart_id');

    }
}
