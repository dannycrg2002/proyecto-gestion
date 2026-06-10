@extends('layouts.app')
@section('title', 'Tareas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-tasks"></i> Gestión de Tareas</h2>
    <a href="{{ route('tareas.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nueva Tarea
    </a>
</div>

{{-- Filtros --}}
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('tareas.index') }}" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label fw-semibold">Buscar (descripción / responsable)</label>
                <input type="text" name="buscar" class="form-control"
                       value="{{ $buscar }}" placeholder="Escribe para filtrar...">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Estado</label>
                <select name="estado" class="form-select">
                    <option value="">— Todos —</option>
                    @foreach(['Pendiente','En progreso','Finalizado'] as $e)
                        <option value="{{ $e }}" {{ $estado === $e ? 'selected' : '' }}>{{ $e }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Proyecto</label>
                <select name="id_proyecto" class="form-select">
                    <option value="">— Todos —</option>
                    @foreach($proyectos as $p)
                        <option value="{{ $p->id_proyecto }}"
                            {{ $id_proyecto == $p->id_proyecto ? 'selected' : '' }}>
                            {{ $p->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-search"></i> Filtrar
                </button>
                <a href="{{ route('tareas.index') }}" class="btn btn-secondary w-100">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </form>
    </div>
</div>

{{-- Tabla --}}
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-list"></i> Lista de Tareas</span>
        <span class="badge bg-secondary">{{ $tareas->count() }} registro(s)</span>
    </div>
    <div class="card-body p-0">
        @if($tareas->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="fas fa-inbox fa-3x mb-3"></i>
                <p>No se encontraron tareas.</p>
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Proyecto</th>
                        <th>Descripción</th>
                        <th>Responsable</th>
                        <th>Fecha Límite</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tareas as $t)
                    @php
                        $badge = match($t->estado) {
                            'Pendiente'   => 'warning',
                            'En progreso' => 'info',
                            'Finalizado'  => 'success',
                            default       => 'secondary'
                        };
                    @endphp
                    <tr>
                        <td>{{ $t->id_tarea }}</td>
                        <td>{{ $t->proyecto->nombre ?? '—' }}</td>
                        <td>{{ \Str::limit($t->descripcion, 50) }}</td>
                        <td>{{ $t->responsable }}</td>
                        <td>{{ $t->fecha_limite }}</td>
                        <td><span class="badge bg-{{ $badge }}">{{ $t->estado }}</span></td>
                        <td>
                            <a href="{{ route('tareas.edit', $t->id_tarea) }}"
                               class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('tareas.destroy', $t->id_tarea) }}" method="POST"
                                  style="display:inline"
                                  onsubmit="return confirm('¿Eliminar esta tarea?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection
