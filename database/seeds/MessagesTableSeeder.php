<?php

use App\Message;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i<20; $i++) {

            $newMessage = new Message();

            $newMessage->sender_name = $faker->firstName();
            $newMessage->sender_surname = $faker->lastName();
            $newMessage->sender_mail = $faker->email();
            $newMessage->phone_number = $faker->phoneNumber();
            $newMessage->content = $faker->text(500);
            $newMessage->apartment_id = rand(1, 20);

            $newMessage->save();
        }
    }
}
