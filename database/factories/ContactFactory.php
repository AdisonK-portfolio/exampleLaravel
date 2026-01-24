<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{

    public function definition(): array{
        
        return [
            'firstName' => $this->faker->firstName(),
            'lastName' => $this->faker->lastName(),
            'email'=> $this->faker->email(),
            'DOB' => $this->faker->date(),
            // 'company_id' => rand(1,9),
            'madeBy_id' => rand(1,9),
        ];
    }

    /* This is faster than the factory's method of doing it */
    public function makeContacts(){
        
        $contacts = collect();
        $maxCompanyId = Company::max('id');
        for($i = 0; $i < 20000; $i++){
            $contacts->push(
                Contact::make([
                    'firstName' => $this->faker->firstName(),
                    'lastName' => $this->faker->lastName(),
                    'email'=> $this->faker->email(),
                    'DOB' => $this->faker->date(),
                    'primaryCompany_id' => rand(1, $maxCompanyId),
                    'madeBy_id' => rand(1,9),
                ])
            );
        }

        // Since there are a lot of records, adding them in chunks
        foreach($contacts->chunk(1000) as $chunk){
            Contact::insert($chunk->toArray());
        }
    }
}
