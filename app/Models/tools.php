<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\orders;

class tools extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'tool_name',
        
    ];

    public function user(){
        return $this->hasOne(user::class,'id','user_id');
    }
   
    public function orders(){
        return $this->hasMany(orders::class,'tools_id','id');
    }

}
