<?php

namespace Tests\Feature\Http\Controller\Contact;

use App\Models\Contact;
use Tests\TestCase;

use Database\Factories\ContactFactory;

abstract class ContactFeatureTestUtil {

    public static function assertContact(Contact $contactA, Contact $contactB) {
        TestCase::assertEquals($contactA->id, $contactB->id);
        TestCase::assertEquals($contactA->name, $contactB->name);
        TestCase::assertEquals($contactA->email, $contactB->email);
        TestCase::assertEquals($contactA->phone, $contactB->phone);
    }

    public static function mokeContactInstance() {
        return app(ContactFactory::class)->make();
    }

    public static function mokeContactList(int $count) {
        $factory = app(ContactFactory::class);
        for ($i = 0; $i < $count; $i++) {
            $factory->make()->save();
        }
    }
}
