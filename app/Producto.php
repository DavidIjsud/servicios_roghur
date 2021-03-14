<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'nombre', 'descripcion', 'precio', 'stock', 'categoria_id',
    ];
    protected $hidden = [
        'updated_at', 'deleted_at'
    ];
}
