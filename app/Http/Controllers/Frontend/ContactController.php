<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ContactController extends Controller
{
    public function show_contact(){
        return view('Frontend.Pages.Contact.Contact');
    }
    public function send_data(Request $request){
        try {
            // Validate the request data
            $request->validate([
                'name' => 'required',
                'subject' => 'required',
                'email' => 'required|email|unique:contracts',
                'phone' => 'required',
                'comment' => 'required',
            ]);

            // Insert into the contracts table
            $object = new Contract();
            $object->name = $request->name;
            $object->subject = $request->subject;
            $object->email = $request->email;
            $object->phone_number = $request->phone;
            $object->comment = $request->comment;
            $object->status = 1;
    
            // Save the contact to the database
            $object->save();

            return response()->json(['success' => true, 'message' => 'Send Successful']);
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        }
    }
}
