<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About_Section;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function show_about(){
        $data=About_Section::where(['status'=>1])->latest()->get();
        return view('Frontend.Pages.About.About',compact('data'));
    }
}
