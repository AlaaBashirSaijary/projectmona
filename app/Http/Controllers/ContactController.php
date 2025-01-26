<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReceived;
use App\Http\Requests\ContactRequest;


class ContactController extends Controller
{

    public function store(ContactRequest $request)
    {
        $validated = $request->validated();

        $contact = Contact::create($validated);

            // إرسال بريد إلكتروني
        Mail::to($contact->email)->send(new ContactReceived($contact));

          // الاستجابة
        return response()->json(['message' => 'تم إرسال الطلب بنجاح!'], 201);
    }
}
