<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorsController extends Controller
{
    public function notfound()
    {
        return view('errors.notfound');
    }
    public function notpermission()
    {
        return view('errors.notpermission');
    }
}
