<?php

namespace App\Http\Controllers\LegalAuthority;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LegalAuthorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('legalauthority.legalauthority');
    }
}
