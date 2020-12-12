<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::query()->get();
        return view('contact.list', ['contacts' => $contacts]);
    }

    public function show($id) {
        return Contact::findOrFail($id);
    }

    public function create() {
        return view('contact.form', [
            'title' => 'New Contact',
            'contact' => new Contact
        ]);
    }

    public function store(Request $request) {
        Contact::create($request->all());
        return Redirect::to('/contact');
    }

    public function edit($id) {
        $contact = Contact::findOrFail($id);
        return view('contact.form', [
            'title' => 'Edit Contact',
            'contact' => $contact
        ]);
    }

    public function update($id, Request $request) {
        $contact = $request->all();
        Contact::findOrFail($id)->update($contact);
        return Redirect::to('/contact');
    }

    public function destroy($id) {
        Contact::findOrFail($id)->delete();
        return Redirect::to('/contact');
    }
}
