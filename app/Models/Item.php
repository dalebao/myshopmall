<?php

namespace App\Models;

use App\Repo\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use ModelTrait;
    protected $guarded = [];

}
