<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    protected $guarded=[];
    protected $table='address';
    use SoftDeletes;

   public function user(){
       return $this->belongsTo('App\User');
   }
}
