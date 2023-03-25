<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            [
                'name' => 'Piscina (Servizio privato)',
                'class_icon' => 'fa-solid fa-person-swimming',
            ],
            [
                'name' => 'TV',
                'class_icon' => 'fa-solid fa-tv',
            ],
            [
                'name' => 'Aria condizionata',
                'class_icon' => 'fa-regular fa-snowflake',
            ],
            [
                'name' => 'Parcheggio gratuito nella proprietà',
                'class_icon' => 'fa-solid fa-car',
            ],
            [
                'name' => 'Riscaldamento',
                'class_icon' => 'fa-solid fa-temperature-arrow-up',
            ],
            [
                'name' => 'Wi-fi',
                'class_icon' => 'fa-solid fa-wifi',
            ],
        ];

        foreach ($services as $key => $service) {
            $newService = new Service();
            $newService->name = $service['name'];
            $newService->class_icon = $service['class_icon'];
            $newService->save();
        }
    }
}
