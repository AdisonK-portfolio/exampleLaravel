<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Company;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    public function definition(): array {

        return [
            //
        ];
    }

    public function addAddresses(){
        $addresses = collect();
        foreach(Company::all() as $c){
            $addresses->push(Address::make([
                'address1' => $this->faker->streetAddress(),
                'address2' => $this->faker->secondaryAddress(),
                'city' => $this->faker->city(),
                'state' => $this->faker->state(),
                'zip' => $this->faker->postcode(),
                'addressable_type' => Company::class,
                'addressable_id' => $c->id,
            ]));
        }

        Address::insert($addresses->toArray());

        // reset the collection of addresses
        $addresses = collect();

        foreach(Contact::all() as $c){
            $addresses->push(Address::make([
                'address1' => $this->faker->streetAddress(),
                'address2' => $this->faker->secondaryAddress(),
                'city' => $this->faker->city(),
                'state' => $this->faker->state(),
                'zip' => $this->faker->postcode(),
                'addressable_type' => Contact::class,
                'addressable_id' => $c->id,
            ]));
        }

        // Since there are a lot of records, adding them in chunks
        foreach($addresses->chunk(1000) as $chunk){
            Address::insert($chunk->toArray());
        }
    }
}
