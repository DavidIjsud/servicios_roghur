<?php

use App\Cliente;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Cliente::create([
        'ci' => '12123434',
        'nombre' => 'matias',
        'apellido' => 'flores',
      ]);
      Cliente::create([
        'ci' => '23234545',
        'nombre' => 'adriana',
        'apellido' => 'gutierrez',
      ]);
    }
}
