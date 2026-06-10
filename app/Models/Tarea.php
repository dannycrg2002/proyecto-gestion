<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table      = 'tareas';
    protected $primaryKey = 'id_tarea';
    public    $timestamps = false;

    protected $fillable = [
        'id_proyecto',
        'descripcion',
        'responsable',
        'fecha_limite',
        'estado',
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'id_proyecto', 'id_proyecto');
    }
}
