<?php

namespace Database\Seeders;

use App\Models\CustomerGroup;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CustomerGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        CustomerGroup::create([
            'title'       => 'Maloobchod',
            'description' => $faker->paragraph
        ]);

        CustomerGroup::create([
            'title'       => 'Zlava 5%',
            'description' => $faker->paragraph
        ]);

        CustomerGroup::create([
            'title'       => 'Zlava 10%',
            'description' => $faker->paragraph
        ]);

        CustomerGroup::create([
            'title'       => 'Zlava 15%',
            'description' => $faker->paragraph
        ]);

        CustomerGroup::create([
            'title'       => 'Zlava 20%',
            'description' => $faker->paragraph
        ]);
    }
}
