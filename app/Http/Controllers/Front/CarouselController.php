<?php

namespace App\Http\Controllers\Front;

use App\Models\Carousel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarouselController extends Controller
{
    public function index()
    {
        return Carousel::all();

    }
}