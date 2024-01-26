<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class Front_subscriber_Controller extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'email' => 'required|email|unique:subscribers',
            ]);

            // Insert into the subscribers table
            $subscriber = Subscriber::create([
                'email' => $request->email,
                'status' => 1,
            ]);

            return response()->json(['success' => true, 'message' => 'Subscription successful']);
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        }
    }
}
