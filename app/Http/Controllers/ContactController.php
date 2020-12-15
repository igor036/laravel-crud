<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Events\AddContactProcessed;
use App\Events\DeleteContactProcessed;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ContactController extends Controller {

    public const CONTACT_NOT_FOUND_MESSAGE = 'Contact not found.';
    public const CONTACT_DELETED_WITH_SUCCESS = 'Contact deleted with success!';
    public const CONTACT_CREATED_WITH_SUCCESS = 'Contact created with success!';
    public const CONTACT_UPDATED_WITH_SUCCESS = 'Contact updated with success!';
    public const ERROR_WHEN_TRY_DELETE_CONTACT_MESSAGE = 'Unexpected error when try delete a contact.';
    public const CONTACTS_PER_PAGE = 10;

    protected const CONTACT_VALIDATION_RULES = [
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required'
    ];

    public function index(Request $request) {
        $contacts_page = $request->input('contacts_page') ?? 1;
        $pagination    = Contact::query()->paginate(
            ContactController::CONTACTS_PER_PAGE,
            ['*'], 'contacts_page', $contacts_page
        );
        return view('contact.index', $this->getContactsBody($pagination));
    }

    public function show(int $id) {
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
        return $this->redirectToIndex(ContactController::CONTACT_CREATED_WITH_SUCCESS);
    }

    public function edit(int $id) {
        /** @var contact Contact */
        $contact = $this->getContact($id);
        return view('contact.form', $this->getContactBody($contact));
    }

    public function update(int $id, Request $request) {
        $request->validate(ContactController::CONTACT_VALIDATION_RULES);
        $this->getContact($id)->update($request->all());
        return $this->redirectToIndex(ContactController::CONTACT_UPDATED_WITH_SUCCESS);
    }

    public function destroy(int $id) {

        $contact = $this->getContact($id);
        if ($contact->delete()) {
            event(new DeleteContactProcessed($contact));
            return $this->redirectToIndex(ContactController::CONTACT_DELETED_WITH_SUCCESS);
        }

        abort(Response::HTTP_INTERNAL_SERVER_ERROR, ContactController::ERROR_WHEN_TRY_DELETE_CONTACT_MESSAGE);
    }

    private function redirectToIndex(string $message) {
        return redirect()
                ->route('contact.index')
                ->with('message', $message);
    }

    private function getContactBody(Contact $contact) {
        return  ['contact' => $contact];
    }

    private function getContactsBody(LengthAwarePaginator $pagination) {
        return  ['pagination' => $pagination];
    }

    private function getContact(int $id) {
        $contact = Contact::find($id);
        if ($contact == NULL) {
            abort(Response::HTTP_NOT_FOUND, ContactController::CONTACT_NOT_FOUND_MESSAGE);
        }
        return $contact;
    }
}
