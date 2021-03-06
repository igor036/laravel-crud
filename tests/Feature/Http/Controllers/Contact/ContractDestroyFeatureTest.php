<?php

namespace Tests\Feature\Http\Controllers\Contact;

use Tests\TestCase;

use App\Models\Contact;
use App\Http\Controllers\ContactController;

use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractDestroyFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_should_return_404_when_try_delete_a_nonexistent_contact()
    {
        $response = $this->delete('contact/0');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_delete_a_existent_contact()
    {
        $contact  = ContactFeatureTestUtil::mokeContactInstance(true);
        $response = $this->delete('contact/'.$contact->id);
        $message  = $response->getSession()->get('message');
        $contact  = Contact::find($contact->id);

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertNull($contact);
        $this->assertEquals(ContactController::CONTACT_DELETED_WITH_SUCCESS, $message);

    }
}
