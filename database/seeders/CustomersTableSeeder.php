<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            'first_name'    => 'Janko',
            'surname'       => 'Mrkvička',
            'contact_email' => 'janko@mrkvicka.sk',
            'phone'         => '+420 999 999 999',
            'is_company'    => 0,
        ]);
    }
}
