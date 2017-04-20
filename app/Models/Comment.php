<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    protected $guarded = [];
    use SoftDeletes;
    protected $table='comment';
    public function user(){
        return $this->hasMany(User::class,'id','user_id');
    }
}
