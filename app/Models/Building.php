<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\orders;

class Building extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**ใส่ให้inputเข้าไปได้ในฟอม */
    protected $fillable = [
        'user_id',
        'buildings_name',
        'building_id',
        
    ];

    public function user(){
        return $this->hasOne(user::class,'id','user_id');
    }

    public function orders(){
        return $this->hasMany(orders::class,'building_id','id');
    }
}
