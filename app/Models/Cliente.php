<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'correo',
        'telefono'
    ];

    protected $casts = [
        'fecha_registro' => 'datetime'
    ];

    // public function proyectos()
    // {
    //     return $this->hasMany(Proyecto::class, 'id_cliente');
    // }

public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'id_cliente', 'id_cliente');
    }

}