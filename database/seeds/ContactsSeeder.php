<?php

use App\Models\Address;
use App\Models\Contact;
use App\Models\Email;
use App\Models\PhoneNumber;
use Illuminate\Database\Seeder;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Contact::class, 10)->create()
            ->each(function (Contact $contact) {

                factory(Address::class, random_int(1, 3))->create([
                    'contact_id' => $contact->getKey(),
                ]);

                factory(PhoneNumber::class, random_int(1, 3))->create([
                    'contact_id' => $contact->getKey(),
                ]);

                factory(Email::class, random_int(1, 3))->create([
                    'contact_id' => $contact->getKey(),
                ]);
            });
    }
}
