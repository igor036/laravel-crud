<?php

namespace App\Http\Controllers;

use App\Events\AddContactProcessed;
use App\Events\DeleteContactProcessed;
use App\Events\SendEmailProcessed;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Collection;

class ContactController extends Controller {

    protected const CONTACT_NOT_FOUND_MESSAGE = 'Unauthorized action.';
    protected const ERROR_WHEN_TRY_DELETE_CONTACT_MESSAGE = 'Unexpected error when try delete a contact.';
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
        /** @var contact Contact */
        $contact = $this->getContact($id);
        return view('contact.show', $this->getContactBody($contact));
    }

    public function create() {
        return view('contact.form', $this->getContactBody(new Contact));
    }

    public function store(Request $request) {

        $request->validate(ContactController::CONTACT_VALIDATION_RULES);

        /** @var Contact contact */
        $contact = Contact::create($request->all());
        event(new AddContactProcessed($contact));
        return Redirect::to('/contact');
    }

    public function edit($id) {
        /** @var contact Contact */
        $contact = $this->getContact($id);
        return view('contact.form', $this->getContactBody($contact));
    }

    public function update($id, Request $request) {
        $request->validate(ContactController::CONTACT_VALIDATION_RULES);
        $this->getContact($id)->update($request->all());
        return Redirect::to('/contact');
    }

    public function destroy($id) {

        $contact = $this->getContact($id);
        if ($contact->delete()) {
            event(new DeleteContactProcessed($contact));
            return Redirect::to('/contact');
        }

        abort(Response::HTTP_INTERNAL_SERVER_ERROR, ContactController::ERROR_WHEN_TRY_DELETE_CONTACT_MESSAGE);
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
