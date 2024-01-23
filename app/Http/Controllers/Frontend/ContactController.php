<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show_contact(){
        return view('Frontend.Pages.Contact.Contact');
    }
}
