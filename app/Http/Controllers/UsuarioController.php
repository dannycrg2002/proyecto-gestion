<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Controlador de Usuarios
 * Gestiona el CRUD de usuarios del sistema (solo Admin)
 */
class UsuarioController extends Controller
{
    // Listar todos los usuarios ordenados por nombre
    public function index()
    {
        $usuarios = User::orderBy('nombre')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('usuarios.create');
    }

    // Guardar nuevo usuario con contraseña encriptada
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:Usuarios,correo',
            'contraseña' => 'required|min:6|confirmed',
            'rol' => 'required|in:Admin,Gerente,Desarrollador',
        ]);

        User::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'contraseña' => Hash::make($request->contraseña),
            'rol' => $request->rol,
            'estado' => 'activo',
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }

    // Mostrar detalle de un usuario específico
    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    // Actualizar usuario (contraseña opcional)
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:Usuarios,correo,' . $id . ',id_usuario',
            'rol' => 'required|in:Admin,Gerente,Desarrollador',
        ]);

        $usuario->nombre = $request->nombre;
        $usuario->correo = $request->correo;
        $usuario->rol = $request->rol;

        // Solo actualizar contraseña si se proporciona
        if ($request->filled('contraseña')) {
            $request->validate([
                'contraseña' => 'min:6|confirmed',
            ]);
            $usuario->contraseña = Hash::make($request->contraseña);
        }

        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    // Eliminar usuario (no puede eliminarse a sí mismo)
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);

        // Evitar que el admin se elimine a sí mismo
        if ($usuario->id_usuario == auth()->user()->id_usuario) {
            return redirect()->route('usuarios.index')->with('error', 'No puedes eliminar tu propio usuario.');
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }

    // Cambiar estado activo/inactivo del usuario
    public function toggleEstado($id)
    {
        $usuario = User::findOrFail($id);

        // No puede desactivarse a sí mismo
        if ($usuario->id_usuario == auth()->user()->id_usuario) {
            return redirect()->route('usuarios.index')->with('error', 'No puedes desactivar tu propio usuario.');
        }

        $usuario->estado = ($usuario->estado === 'activo') ? 'inactivo' : 'activo';
        $usuario->save();

        $mensaje = $usuario->estado === 'activo' ? 'Usuario activado exitosamente.' : 'Usuario desactivado exitosamente.';

        return redirect()->route('usuarios.index')->with('success', $mensaje);
    }
}
