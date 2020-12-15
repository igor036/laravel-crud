<?php

namespace Tests\Feature\Http\Controllers\Contact;

use App\Http\Controllers\ContactController;
use Tests\TestCase;

use Illuminate\Http\Response;
use Illuminate\Testing\TestResponse;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactIndexFeatureTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_should_render_index_without_contacts() {

        $response   = $this->get('contact');
        $pagination = $response->viewData('pagination');

        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals(0, $pagination->count());
    }

    /**
     * @test
     * @return void
     */
    public function it_should_render_index_with_only_one_page() {
        ContactFeatureTestUtil::mokeContactList(10, true);
        $response = $this->get('contact');
        $this->assertIndexPaginationResponse($response, 1, 1);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_render_index_on_two_pages() {
        ContactFeatureTestUtil::mokeContactList(20, true);

        $response = $this->get('contact');
        $this->assertIndexPaginationResponse($response, 2, 1);

        $response = $this->get('contact?contacts_page=2');
        $this->assertIndexPaginationResponse($response, 2, 2);
    }

    private function assertIndexPaginationResponse(TestResponse $response, int $expectedLastPage, int $expectedCurrentPage) {
        $pagination = $response->viewData('pagination');
        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals($expectedLastPage, $pagination->lastPage());
        $this->assertEquals($expectedCurrentPage, $pagination->currentPage());
        $this->assertEquals(ContactController::CONTACTS_PER_PAGE, $pagination->perPage());
    }
}
