<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sponsorship;

class SponsorshipSeeder extends Seeder
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
                'name' => 'Regular',
                'description' => 'Una sponsorizzazione che metterà in bella vista i tuoi appartamenti per 24 ore!',
                'price' => 2.99,
                'duration' => 24,
            ],
            [
                'name' => 'Special-guest',
                'description' => 'Una sponsorizzazione che metterà in bella vista i tuoi appartamenti per 72 ore!',
                'price' => 5.99,
                'duration' => 72,
            ],
            [
                'name' => 'VIP',
                'description' => 'Una sponsorizzazione che metterà in bella vista i tuoi appartamenti per 144 ore!',
                'price' => 9.99,
                'duration' => 144,
            ]
        ];

        foreach ($sponsorships as $key => $sponsorship) {
            $newSponsorship = new Sponsorship();
            $newSponsorship->name = $sponsorship['name'];
            $newSponsorship->description = $sponsorship['description'];
            $newSponsorship->price = $sponsorship['price'];
            $newSponsorship->duration = $sponsorship['duration'];
            $newSponsorship->save();
        }
    }
}
