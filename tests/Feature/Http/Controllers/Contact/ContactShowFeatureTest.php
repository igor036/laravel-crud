<?php

namespace Tests\Feature\Http\Controllers\Contact;

use Tests\TestCase;

use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactShowFeatureTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_should_return_404_for_inexistent_contact()
    {
        $response = $this->get('contact/show/1');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_return_a_contact_object()
    {
        $contact = ContactFeatureTestUtil::mokeContactInstance(true);
        $response = $this->get('contact/'.$contact->id);
        $response->assertStatus(Response::HTTP_OK);
        ContactFeatureTestUtil::assertContact($contact, $response->viewData('contact'));
    }
}
