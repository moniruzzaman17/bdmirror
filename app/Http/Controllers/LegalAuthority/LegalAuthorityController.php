<?php

namespace App\Http\Controllers\LegalAuthority;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Authority;

class LegalAuthorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authorities = Authority::with('division','district','upazila')->get();
        // dd($authorities);
        return view('legalauthority.legalauthority',compact('authorities'));
    }
}
