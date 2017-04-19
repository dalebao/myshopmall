<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $guarded = [];
    use SoftDeletes;
    protected $appends=['max_num'];

    //item
    public function getMaxNumAttribute(){
        return $this->hasMany(Item::class,'id','item_id')->select('name','number','now_price')->first();
    }

    public function Item(){
        return $this->hasMany(Item::class,'id','item_id');
    }

    //user
    public function user(){
        return $this->hasMany(User::class,'id','user_id');
    }
    //address
    public function address(){
        return $this->hasMany(Address::class,'user_id','user_id');
    }

}
