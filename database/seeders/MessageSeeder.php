<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;
use Faker\Generator as Faker;


class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i<20; $i++) {
            $newMes = new Message();
            $newMes->name = $faker->word();;
            $newMes->surname = $faker->word();;
            $newMes->email = $faker->email();;
            $newMes->description = $faker->sentence();

            $newMes->save();
        }
    }
}