<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $guarded = [];
    use SoftDeletes;
    protected $appends=['max_num'];

    //item
    public function getMaxNumAttribute(){
        return $this->hasMany(Item::class,'id','item_id')->select('number','now_price')->first();
    }
}
