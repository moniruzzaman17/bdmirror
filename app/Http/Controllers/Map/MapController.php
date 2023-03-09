<?php

namespace App\Http\Controllers\Map;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MapController extends Controller
{
    // public function index()
    // {
    //     return view('map.index');
    // }
    
    public function index(Request $request)
    {
        return view('map.index');
    }
}
