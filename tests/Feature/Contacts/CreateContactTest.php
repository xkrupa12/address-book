<?php

namespace Tests\Feature\Contacts;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CreateContactTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * @test
     */
    public function stores_new_contact_on_valid_request()
    {
        $response = $this->post(route('contacts.create'), [
            'name' => 'John',
            'surname' => 'Doe',
        ]);

        $response->assertRedirect(route('contacts.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contacts', ['name' => 'John', 'surname' => 'Doe']);
    }

    /**
     * @test
     *
     * @dataProvider getInvalidPayload
     * @param array $payload
     */
    public function returns_error_if_required_parameters_are_missing(array $payload)
    {
        $response = $this->post(route('contacts.create'), $payload);
        $response->assertSessionHas('errors');
        $this->assertDatabaseMissing('contacts', $payload);
    }

    /**
     * @return array
     */
    public function getInvalidPayload(): array
    {
        return [
            [['name' => 'John']],
            [['surname' => 'Doe']],
        ];
    }
}
