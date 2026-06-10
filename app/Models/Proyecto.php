<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table      = 'proyectos';
    protected $primaryKey = 'id_proyecto';
    public    $timestamps = false;

    protected $fillable = [
        'id_cliente',
        'nombre',
        'descripcion',
        'estado',
        'fecha_inicio',
        'fecha_fin',
    ];

    // la relacion donde cada proyecto le pertenece a un cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'id_proyecto', 'id_proyecto');
    }
}
