<?php

namespace Tests\Feature\Http\Controllers\Contact;

use Tests\TestCase;

use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactIndexFeatureTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_should_render_index_without_contacts() {

        $response = $this->get('contact');
        $contacts = $response->viewData('contacts');

        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals(0, $contacts->count());
    }

    /**
     * @test
     * @return void
     */
    public function it_should_render_index_with_only_one_contact() {

        ContactFeatureTestUtil::mokeContactList(1, true);

        $response = $this->get('contact');
        $contacts = $response->viewData('contacts');

        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals(1, $contacts->count());

    }

    /**
     * @test
     * @return void
     */
    public function it_should_render_index_with_more_one_contacts() {

        ContactFeatureTestUtil::mokeContactList(10, true);

        $response = $this->get('contact');
        $contacts = $response->viewData('contacts');

        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals(10, $contacts->count());

    }
}
