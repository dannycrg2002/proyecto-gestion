<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Modelo de Usuario
 * Gestiona los usuarios del sistema con roles: Admin, Gerente, Desarrollador
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Nombre de la tabla en la base de datos
    protected $table = 'Usuarios';

    // Clave primaria de la tabla
    protected $primaryKey = 'id_usuario';

    // Desactivar timestamps automáticos
    public $timestamps = false;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'correo',
        'contraseña',
        'rol',
        'estado',
    ];

    // Campos ocultos en serialización (JSON, arrays)
    protected $hidden = [
        'contraseña',
        'remember_token',
    ];

    // Convertir campos a tipos específicos
    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Especificar campo personalizado de contraseña para autenticación
    public function getAuthPassword()
    {
        return $this->contraseña;
    }
}
