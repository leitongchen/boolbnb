<?php

use App\Sponsorship;
use Illuminate\Database\Seeder;

class SponsorshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsorships = [
            [
                'name' =>'24 ore',
                'price' => '2.99',
                'promo_hours' => 24
            ],
            [
                'name' =>'72 ore',
                'price' => '5.99',
                'promo_hours' => 72
            ],
            [
                'name' =>'144 ore',
                'price' => '9.99',
                'promo_hours' => 144
            ],
        ];

        foreach ($sponsorships as $sponsorship) {
            $newSponsorship = new Sponsorship();

            $newSponsorship->name = $sponsorship['name'];
            $newSponsorship->price = $sponsorship['price'];
            $newSponsorship->promo_hours = $sponsorship['promo_hours'];
            $newSponsorship->save();
        }


    }
}
