<?php

namespace Tests\Feature\Http\Controller\Contact;

use App\Models\Contact;
use Tests\TestCase;

abstract class ContactFeatureTestUtil {

    public static function assertContact(Contact $contactA, Contact $contactB) {
        TestCase::assertEquals($contactA->id, $contactB->id);
        TestCase::assertEquals($contactA->name, $contactB->name);
        TestCase::assertEquals($contactA->email, $contactB->email);
        TestCase::assertEquals($contactA->phone, $contactB->phone);
    }

}
