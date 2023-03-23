<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;
use Illuminate\Support\Str;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = config('apartment_db');
        

        foreach ($apartments as $key=>$apartment) {
            $newApt = new Apartment();
            $newApt->id = $apartment['id'];
            $newApt->title = $apartment['title'];
            $newApt->slug = Str::slug($newApt->title, '-');
            $newApt->n_room = $apartment['n_room'];
            $newApt->n_bed = $apartment['n_bed'];
            $newApt->n_bathroom = $apartment['n_bathroom'];
            $newApt->mq = $apartment['mq'];
            $newApt->image = $apartment['image'];
            $newApt->latitude = $apartment['latitude'];
            $newApt->longitude = $apartment['longitude'];

            $newApt->save();
        }
        
    }
}