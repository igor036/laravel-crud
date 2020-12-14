<?php

namespace Tests\Feature\Http\Controller\Contact;

use App\Models\Contact;
use Tests\TestCase;

use Database\Factories\ContactFactory;
use Illuminate\Support\Collection;

abstract class ContactFeatureTestUtil {

    public static function assertContact(Contact $contactA, Contact $contactB) {
        TestCase::assertEquals($contactA->name, $contactB->name);
        TestCase::assertEquals($contactA->email, $contactB->email);
        TestCase::assertEquals($contactA->phone, $contactB->phone);
    }

    public static function mokeContactInstanceWithInvalidName() {
        $contact = app(ContactFactory::class)->make();
        $contact->name = '';
        return $contact;
    }

    public static function mokeContactInstanceWithInvalidEmail() {
        $contact = app(ContactFactory::class)->make();
        $contact->email = '';
        return $contact;
    }

    public static function mokeContactInstanceWithInvalidPhone() {
        $contact = app(ContactFactory::class)->make();
        $contact->phone = '';
        return $contact;
    }

    public static function mokeContactInstance(bool $save) {
        $contact = app(ContactFactory::class)->make();
        if ($save) $contact->save();
        return $contact;
    }

    public static function mokeContactList(int $count, bool $save) {
        $factory = app(ContactFactory::class);
        $contacts = new Collection();
        for ($i = 0; $i < $count; $i++) {
            $contact = $factory->make();
            $contacts->add($contact);
            if ($save) $contact->save();
        }
        return $contacts;
    }
}
