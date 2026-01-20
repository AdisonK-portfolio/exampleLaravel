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
        for($i = 0; $i < 30000; $i++){
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

            if($contacts->count() > 1000){
                Contact::insert($contacts->toArray());
                $contacts = collect();
            }
        }
    }
}
