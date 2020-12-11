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

    public function create_index() {
        return view('contact.form', ['title' => 'New Contact']);
    }

    public function create(Request $request) {
        Contact::create($request->all());
        return Redirect::to('/contact');
    }

    public function delete($id) {
        Contact::findOrFail($id)->delete();
        return Redirect::to('/contact');
    }
}
