<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Company;
use App\Models\Employment;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmploymentFactory extends Factory
{
    public function definition(): array{
        return [];
    }

    public function makeEmployments(){
        info('making employments');
        $lastCompanyId = Company::max('id');
        
        $employments = collect();
        foreach(Contact::all() as $c){
            $employments->push(Employment::make([
                'company_id' => $c->primaryCompany_id, //rand(1, $lastCompanyId),
                'contact_id' => $c->id,
                'startDate' => $this->faker->date(),
                'wage' => rand(18,100),
            ]));

            if($employments->count() > 1000){
                Employment::insert($employments->toArray());
                $employments = collect();
            }
        }
    }
}
