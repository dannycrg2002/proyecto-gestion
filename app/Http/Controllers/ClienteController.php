<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

/**
 * Controlador de Clientes
 * Gestiona el CRUD de clientes del sistema
 */
class ClienteController extends Controller
{
    // Listar todos los clientes
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('clientes.create');
    }

    // Guardar nuevo cliente validando email único
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:Clientes',
            'telefono' => 'required|string|max:20',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente.');
    }

    // Mostrar detalle de cliente con sus proyectos
    public function show($id)
    {
        $cliente = Cliente::with('proyectos')->findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    // Actualizar cliente (validar email único excepto el actual)
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:Clientes,correo,' . $id . ',id_cliente',
            'telefono' => 'required|string|max:20',
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente.');
    }

    // Eliminar cliente (también elimina sus proyectos por cascada)
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado exitosamente.');
    }
}
