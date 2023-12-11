<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index(){
        return view('Frontend.Pages.Home.Home');
    }
}
