<?php

namespace Tests\Feature\Http\Controllers\Contact;

use App\Http\Controllers\ContactController;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ContractUpdateFeatureTest extends TestCase
{
    use RefreshDatabase;


    /**
     * @test
     * @return void
     */
    public function it_should_return_404_when_try_update_a_nonexistent_contact()
    {

        $contact = ContactFeatureTestUtil::mokeContactInstance(false);
        $contact->id = 0;
        $response = $this->put('contact/'.$contact->id, $contact->getAttributes());
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_update_a_contact_with_success()
    {

        $contact = ContactFeatureTestUtil::mokeContactInstance(true);
        $contact->name = 'Igor Joaquim';

        $response     = $this->put('contact/'.$contact->id, $contact->getAttributes());
        $message      = $response->getSession()->get('message');
        $queryContact = Contact::find($contact->id);

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertNotNull($queryContact);
        $this->assertEquals(ContactController::CONTACT_UPDATED_WITH_SUCCESS, $message);
        ContactFeatureTestUtil::assertContact($contact, $queryContact);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_return_a_invalid_name_message()
    {
        $contact = ContactFeatureTestUtil::mokeContactInstance(true);
        $contact->name = '';

        $response = $this->put('contact/'.$contact->id, $contact->getAttributes());
        $response->assertSessionHasErrors(['name']);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_return_a_invalid_email_message()
    {
        $contact = ContactFeatureTestUtil::mokeContactInstance(true);
        $contact->email = '';

        $response = $this->put('contact/'.$contact->id, $contact->getAttributes());
        $response->assertSessionHasErrors(['email']);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_return_a_invalid_phone_message()
    {
        $contact = ContactFeatureTestUtil::mokeContactInstance(true);
        $contact->phone = '';

        $response = $this->put('contact/'.$contact->id, $contact->getAttributes());
        $response->assertSessionHasErrors(['phone']);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_return_a_invalid_message_for_all_properties()
    {
        $contact = ContactFeatureTestUtil::mokeContactInstance(true);
        $contact->name = '';
        $contact->email = '';
        $contact->phone = '';

        $response = $this->put('contact/'.$contact->id, $contact->getAttributes());
        $response->assertSessionHasErrors(['email', 'name', 'phone']);
    }
}
