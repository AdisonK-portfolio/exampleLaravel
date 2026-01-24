<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Contact;
use Database\Factories\AddressFactory;
use Illuminate\Database\Seeder;
use Database\Factories\ContactFactory;
use Database\Factories\EmploymentFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        Company::factory(100)->create();

        // For 20,000 records, it's faster to do it the way I wrote it (with insert) than to use the factory definition
        // Contact::factory(30000)->create();

        info('making contacts');
        (new ContactFactory)->makeContacts();

        info('making employments');
        (new EmploymentFactory)->makeEmployments();

        (new AddressFactory)->addAddresses();
    }
}
