<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Proyecto;
use App\Models\Tarea;

class ReporteController extends Controller
{
    public function index()
    {
        $stats = [
            'clientes'    => Cliente::count(),
            'proyectos'   => Proyecto::count(),
            'en_curso'    => Proyecto::where('estado', 'En curso')->count(),
            'completados' => Proyecto::where('estado', 'Completado')->count(),
            'tareas'      => Tarea::count(),
            'pendientes'  => Tarea::where('estado', 'Pendiente')->count(),
            'finalizadas' => Tarea::where('estado', 'Finalizado')->count(),
        ];

        return view('reportes.index', compact('stats'));
    }

    public function proyectos()
    {
        $proyectos = Proyecto::with(['cliente', 'tareas'])
                             ->orderBy('id_proyecto')
                             ->get();

        $resumen = [
            'en_curso'    => $proyectos->where('estado', 'En curso')->count(),
            'completados' => $proyectos->where('estado', 'Completado')->count(),
            'cancelados'  => $proyectos->where('estado', 'Cancelado')->count(),
            'total_tareas'=> $proyectos->sum(fn($p) => $p->tareas->count()),
        ];

        $fecha = now()->format('d/m/Y H:i');

        return view('reportes.proyectos_pdf', compact('proyectos', 'resumen', 'fecha'));
    }

    public function clientes()
    {
        $clientes = Cliente::withCount('proyectos')
                           ->with('proyectos')
                           ->orderBy('nombre')
                           ->get();

        $fecha = now()->format('d/m/Y H:i');

        return view('reportes.clientes_pdf', compact('clientes', 'fecha'));
    }
}
