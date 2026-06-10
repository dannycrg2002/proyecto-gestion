<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function index(Request $request)
    {
        $buscar      = $request->buscar;
        $estado      = $request->estado;
        $id_proyecto = $request->id_proyecto;

        $tareas = Tarea::with('proyecto')
            ->when($buscar, function ($q) use ($buscar) {
                $q->where('descripcion', 'LIKE', "%$buscar%")
                  ->orWhere('responsable', 'LIKE', "%$buscar%");
            })
            ->when($estado, function ($q) use ($estado) {
                $q->where('estado', $estado);
            })
            ->when($id_proyecto, function ($q) use ($id_proyecto) {
                $q->where('id_proyecto', $id_proyecto);
            })
            ->orderBy('fecha_limite', 'asc')
            ->get();

        $proyectos = Proyecto::orderBy('nombre')->get();

        return view('tareas.index', compact('tareas', 'proyectos', 'buscar', 'estado', 'id_proyecto'));
    }

    public function create()
    {
        $proyectos = Proyecto::orderBy('nombre')->get();
        return view('tareas.create', compact('proyectos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_proyecto'  => 'required|exists:proyectos,id_proyecto',
            'descripcion'  => 'required|string',
            'responsable'  => 'required|string|max:255',
            'fecha_limite' => 'required|date',
            'estado'       => 'required|in:Pendiente,En progreso,Finalizado',
        ]);

        Tarea::create($request->all());

        return redirect()->route('tareas.index')
                         ->with('success', 'Tarea registrada correctamente.');
    }

    public function edit($id)
    {
        $tarea     = Tarea::findOrFail($id);
        $proyectos = Proyecto::orderBy('nombre')->get();
        return view('tareas.edit', compact('tarea', 'proyectos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_proyecto'  => 'required|exists:proyectos,id_proyecto',
            'descripcion'  => 'required|string',
            'responsable'  => 'required|string|max:255',
            'fecha_limite' => 'required|date',
            'estado'       => 'required|in:Pendiente,En progreso,Finalizado',
        ]);

        $tarea = Tarea::findOrFail($id);
        $tarea->update($request->all());

        return redirect()->route('tareas.index')
                         ->with('success', 'Tarea actualizada correctamente.');
    }

    public function destroy($id)
    {
        Tarea::findOrFail($id)->delete();
        return redirect()->route('tareas.index')
                         ->with('success', 'Tarea eliminada correctamente.');
    }
}
