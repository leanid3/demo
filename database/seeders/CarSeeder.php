<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = [
            [
                'name' => 'Toyota',
                'model' => 'Camry',
                'description' => 'Седан бизнес-класса'
            ],
            [
                'name' => 'Honda',
                'model' => 'Accord',
                'description' => 'Комфортный семейный автомобиль'
            ]
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}
