<?php
// app/Http/Controllers/ContactController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.contact',[
            'title' => 'Liên hệ'
        ]);
    }

    public function submit(Request $request)
    {
        // Handle form submission logic here
        $validatedData = $request->validate([
            'email' => 'required|email',
            'msg' => 'required',
        ]);
        $email = $validatedData['email'];
        $message = $validatedData['msg'];
        // You can use $request->input('field_name') to access form data
        // Send emails, store data, etc.
        // Redirect back to the contact page with a success message

        return redirect()->route('contact')->with('success', 'Message sent successfully!');

    }
}

