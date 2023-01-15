<?php

namespace Database\Seeders;

use App\Models\Registrant;
use Illuminate\Database\Seeder;

class RegistrantDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Registrant::factory()->count(5000)->create();
    }
}
