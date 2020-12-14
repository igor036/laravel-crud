<?php

namespace Tests\Feature\Http\Controller\Contact;

use App\Models\Contact;
use Tests\TestCase;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Factories\ContactFactory;

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
        $contact = app(ContactFactory::class)->make();
        $contact->save();

        $response = $this->get('contact/'.$contact->id);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertContact($contact, $response->viewData('contact'));
    }

    private function assertContact(Contact $contactA, Contact $contactB) {
        $this->assertEquals($contactA->id, $contactB->id);
        $this->assertEquals($contactA->name, $contactB->name);
        $this->assertEquals($contactA->email, $contactB->email);
        $this->assertEquals($contactA->phone, $contactB->phone);
    }
}
