<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Collection;


class ContactController extends Controller {

    protected const CONTACT_NOT_FOUND_MESSAGE = 'Unauthorized action.';
    protected const CONTACT_VALIDATION_RULES = [
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required'
    ];

    public function index() {
        $contacts = Contact::query()->get();
        return view('contact.list', $this->getContactsBody($contacts));
    }

    public function show($id) {
        $contact = $this->getContact($id);
        return view('contact.show', $this->getContactBody($contact));
    }

    public function create() {
        return view('contact.form', $this->getContactBody(new Contact));
    }

    public function store(Request $request) {
        $request->validate(ContactController::CONTACT_VALIDATION_RULES);
        Contact::create($request->all());
        return Redirect::to('/contact');
    }

    public function edit($id) {
        $contact = $this->getContact($id);
        return view('contact.form', $this->getContactBody($contact));
    }

    public function update($id, Request $request) {
        $request->validate(ContactController::CONTACT_VALIDATION_RULES);
        $this->getContact($id)->update($request->all());
        return Redirect::to('/contact');
    }

    public function destroy($id) {
        $this->getContact($id)->delete();
        return Redirect::to('/contact');
    }

    private function getContactBody(Contact $contact) {
        return  ['contact' => $contact];
    }

    private function getContactsBody(Collection $contacts) {
        return  ['contacts' => $contacts];
    }

    private function getContact(int $id) {
        $contact = Contact::find($id);
        if ($contact == NULL) {
            abort(Response::HTTP_NOT_FOUND, ContactController::CONTACT_NOT_FOUND_MESSAGE);
        }
        return $contact;
    }
}
