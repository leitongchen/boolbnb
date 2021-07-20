<?php

use App\Apartment;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //Apartment::truncate();

        for ($i=0; $i<20; $i++) {
            $newApartment = new Apartment();

            $newApartment->user_id = '1';
            $newApartment->title = $faker->text(150);
            $newApartment->address_street = $faker->streetName();
            $newApartment->street_number = $faker->buildingNumber();
            $newApartment->city = $faker->city();
            $newApartment->zip_code = $faker->postcode();
            $newApartment->province = $faker->state();
            $newApartment->nation = $faker->country();
            $newApartment->latitude = $faker->latitude();
            $newApartment->longitude = $faker->longitude();
            $newApartment->rooms_number = rand(1, 13);
            $newApartment->beds_number = rand(1, 13);
            $newApartment->bathrooms_number = rand(1, 13);
            $newApartment->floor_area = $faker->randomFloat(2, 30, 1000);
            $newApartment->img_url = $faker->imageUrl(640, $faker->numberBetween(300, 800), 'city', true);
            $newApartment->visible = rand(0, 1);

            $newApartment->save();
       }
    }
}
