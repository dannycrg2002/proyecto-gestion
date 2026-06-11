<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo de Cliente
 * Representa a los clientes que contratan proyectos
 */
class Cliente extends Model
{
    // Configuración de tabla
    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';
    public $timestamps = false;

    // Campos asignables masivamente
    protected $fillable = [
        'nombre',
        'correo',
        'telefono'
    ];

    // Convertir campos a tipos específicos
    protected $casts = [
        'fecha_registro' => 'datetime'
    ];

    /**
     * Relación: Un cliente puede tener muchos proyectos
     */
    public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'id_cliente', 'id_cliente');
    }
}
