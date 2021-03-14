<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meta extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'mes', 'year', 'cantidad', 'producto_id',
    ];
    protected $hidden = [
        'updated_at', 'deleted_at'
    ];

    function producto()
    {
        return $this->belongsTo('App\Producto');
    }
}
