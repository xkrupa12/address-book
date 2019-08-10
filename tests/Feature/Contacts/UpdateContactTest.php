<?php

namespace Tests\Feature\Contacts;

use App\Models\Contact;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UpdateContactTest extends  TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * @test
     */
    public function updates_contact_on_valid_request()
    {
        $id = factory(Contact::class)->create([
            'name' => 'John',
            'surname' => 'Doe',
        ])->getKey();

        $this->assertDatabaseHas('contacts', ['id' => $id, 'name' => 'John', 'surname' => 'Doe']);

        $response = $this->put(route('contacts.update', ['id' => $id]), [
            'name' => 'Jane',
            'surname' => 'Whatever',
        ]);

        $response->assertRedirect(route('contacts.edit', $id));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contacts', ['id' => $id, 'name' => 'Jane', 'surname' => 'Whatever']);
    }

    /**
     * @test
     */
    public function redirects_with_error_if_edited_contact_does_not_exist()
    {
        $response = $this->put(route('contacts.update', ['id' => 999]), [
            'name' => 'Jane',
            'surname' => 'Whatever',
        ]);

        $response->assertRedirect(route('contacts.index'));
        $response->assertSessionHas('error');
    }

    /**
     * @test
     *
     * @dataProvider getInvalidPayload
     * @param array $payload
     */
    public function returns_error_if_required_parameters_are_missing(array $payload)
    {
        $id = factory(Contact::class)->create([
            'name' => 'John',
            'surname' => 'Doe',
        ])->getKey();

        $response = $this->put(route('contacts.update', ['id' => $id]), $payload);

        $response->assertRedirect(route('contacts.edit', ['id' => $id]));
        $response->assertSessionHas('error');
    }

    /**
     * @return array
     */
    public function getInvalidPayload(): array
    {
        return [
            [['name' => 'Jane']],
            [['surname' => 'Whatever']],
        ];
    }
}
