<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Cliente;

class ProyectoController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        $estado = $request->estado;

        $proyectos = Proyecto::with('cliente')
            ->when($buscar, function ($query, $buscar) {
                $query->where('nombre', 'LIKE', "%$buscar%")
                      ->orWhere('descripcion', 'LIKE', "%$buscar%");
            })
            ->when($estado, function ($query, $estado) {
                $query->where('estado', $estado);
            })
            ->orderBy('id_proyecto', 'asc')
            ->get();

        return view('proyectos.index', compact('proyectos', 'buscar', 'estado'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nombre', 'asc')->get();
        return view('proyectos.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required',
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'estado' => 'required',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date'
        ]);

        Proyecto::create($request->all());

        return redirect()->route('proyectos.index')
                         ->with('mensaje', 'Proyecto registrado correctamente.');
    }

    public function edit($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $clientes = Cliente::orderBy('nombre', 'asc')->get();

        return view('proyectos.edit', compact('proyecto', 'clientes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_cliente' => 'required',
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'estado' => 'required',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date'
        ]);

        $proyecto = Proyecto::findOrFail($id);
        $proyecto->update($request->all());

        return redirect()->route('proyectos.index')
                         ->with('mensaje', 'Proyecto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->delete();

        return redirect()->route('proyectos.index')
                         ->with('mensaje', 'Proyecto eliminado correctamente.');
    }
}