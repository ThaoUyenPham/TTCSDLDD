<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subjectmap;
use App\Models\Category;

class IntroduceController extends Controller
{
    public function index()
    {
        return view('clients.introduce.introduce');
    }
}
