<?php

namespace Tests\Feature\Http\Controller\Contact;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

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
        $contact = ContactFeatureTestUtil::mokeContactInstance(true);
        $response = $this->delete('contact/'.$contact->id);
        $response->assertStatus(Response::HTTP_FOUND);
    }
}
