<?php

use App\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Categoria::create([
        'nombre' => 'herramienta',
      ]);
      Categoria::create([
        'nombre' => 'electrico',
      ]);
    }
}
