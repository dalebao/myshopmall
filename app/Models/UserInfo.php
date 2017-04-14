<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserInfo extends Model
{
    protected $guarded=[];
    protected $table='user_info';
    use SoftDeletes;
}
