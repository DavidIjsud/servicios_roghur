<?php

use App\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Producto::create([
          'nombre' => 'martillo',
          'descripcion' => 'descripcion',
          'precio' => 25.0,
          'stock' => 150,
          'categoria_id' => 1
        ]);
        Producto::create([
          'nombre' => 'alicate',
          'descripcion' => 'descripcion',
          'precio' => 45.0,
          'stock' => 90,
          'categoria_id' => 1
        ]);
        Producto::create([
          'nombre' => 'taladro',
          'descripcion' => 'descripcion',
          'precio' => 120.0,
          'stock' => 80,
          'categoria_id' => 2
        ]);
    }
}
