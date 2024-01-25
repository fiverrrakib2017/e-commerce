<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class subscriberController extends Controller
{
    public function store(Request $request)
    {
        // Validate email 
        $request->validate([
            'email' => 'required|email|unique:subscribers',
        ]);

        // Create a new subscriber
        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->save();

        // You can also send a response if needed
        return response()->json(['success' => 'Subscription successful']);
    }
}
