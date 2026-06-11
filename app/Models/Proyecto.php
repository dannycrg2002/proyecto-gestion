<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo de Proyecto
 * Gestiona los proyectos asignados a clientes
 * Estados: En Progreso, Completado, Pausado, Cancelado
 */
class Proyecto extends Model
{
    // Configuración de tabla
    protected $table      = 'proyectos';
    protected $primaryKey = 'id_proyecto';
    public    $timestamps = false;

    // Campos asignables masivamente
    protected $fillable = [
        'id_cliente',
        'nombre',
        'descripcion',
        'estado',
        'fecha_inicio',
        'fecha_fin',
    ];

    /**
     * Relación: Un proyecto pertenece a un cliente
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    /**
     * Relación: Un proyecto puede tener muchas tareas
     */
    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'id_proyecto', 'id_proyecto');
    }
}
