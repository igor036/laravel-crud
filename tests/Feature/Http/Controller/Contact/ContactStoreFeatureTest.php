<?php

namespace Tests\Feature\Http\Controller\Contact;

use App\Http\Controllers\ContactController;
use App\Models\Contact;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactStoreFeatureTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_should_create_new_contact_with_success()
    {
        $contact      = ContactFeatureTestUtil::mokeContactInstance(false);
        $response     = $this->post('contact', $contact->getAttributes());
        $queryContact = Contact::where('email', $contact->email)->first();
        $message      = $response->getSession()->get('message');

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertNotNull($queryContact);
        $this->assertEquals(ContactController::CONTACT_CREATED_WITH_SUCCESS, $message);
        ContactFeatureTestUtil::assertContact($contact, $queryContact);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_return_a_invalid_name_message()
    {
        $contact  = ContactFeatureTestUtil::mokeContactInstanceWithInvalidName();
        $response = $this->post('contact', $contact->getAttributes());
        $response->assertSessionHasErrors(['name']);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_return_a_invalid_email_message()
    {
        $contact  = ContactFeatureTestUtil::mokeContactInstanceWithInvalidEmail();
        $response = $this->post('contact', $contact->getAttributes());
        $response->assertSessionHasErrors(['email']);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_return_a_invalid_phone_message()
    {
        $contact  = ContactFeatureTestUtil::mokeContactInstanceWithInvalidPhone();
        $response = $this->post('contact', $contact->getAttributes());
        $response->assertSessionHasErrors(['phone']);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_return_a_invalid_message_for_all_properties()
    {
        $contact  = new Contact();
        $response = $this->post('contact', $contact->getAttributes());
        $response->assertSessionHasErrors(['email', 'name', 'phone']);
    }
}
