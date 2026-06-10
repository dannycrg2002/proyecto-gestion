@extends('layouts.app')

@section('title', 'Gestión de Proyectos')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1><i class="fas fa-folder-open"></i> Gestión de Proyectos</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('proyectos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Proyecto
            </a>
        </div>
    </div>

    {{-- Filtro de búsqueda --}}
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('proyectos.index') }}" class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label for="buscar" class="form-label">Buscar proyecto</label>
                    <input type="text" class="form-control" id="buscar" name="buscar"
                           placeholder="Nombre del proyecto..." value="{{ $buscar ?? '' }}">
                </div>
                <div class="col-md-4">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-select" id="estado" name="estado">
                        <option value="">Todos los estados</option>
                        <option value="En curso"    {{ ($estado ?? '') == 'En curso'    ? 'selected' : '' }}>En curso</option>
                        <option value="Completado"  {{ ($estado ?? '') == 'Completado'  ? 'selected' : '' }}>Completado</option>
                        <option value="Cancelado"   {{ ($estado ?? '') == 'Cancelado'   ? 'selected' : '' }}>Cancelado</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if($proyectos->count() > 0)
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Cliente</th>
                            <th>Proyecto</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Fecha inicio</th>
                            <th>Fecha fin</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proyectos as $proyecto)
                            <tr>
                                <td>{{ $proyecto->cliente->nombre ?? 'Sin cliente' }}</td>
                                <td>{{ $proyecto->nombre }}</td>
                                <td>{{ $proyecto->descripcion }}</td>
                                <td>
                                    @if($proyecto->estado == 'En curso')
                                        <span class="badge bg-primary">En curso</span>
                                    @elseif($proyecto->estado == 'Completado')
                                        <span class="badge bg-success">Completado</span>
                                    @elseif($proyecto->estado == 'Cancelado')
                                        <span class="badge bg-danger">Cancelado</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $proyecto->estado }}</span>
                                    @endif
                                </td>
                                <td>{{ $proyecto->fecha_inicio ?? '—' }}</td>
                                <td>{{ $proyecto->fecha_fin ?? '—' }}</td>
                                <td>
                                    <a href="{{ route('proyectos.edit', $proyecto->id_proyecto) }}" class="btn btn-sm btn-warning" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" title="Eliminar"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEliminar"
                                        data-id="{{ $proyecto->id_proyecto }}"
                                        data-nombre="{{ $proyecto->nombre }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> No hay proyectos registrados.
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Modal: Eliminar Proyecto --}}
<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-danger">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalEliminarLabel">
                    <i class="fas fa-exclamation-triangle"></i> Eliminar proyecto
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body" id="modalEliminarBody">
                ¿Estás seguro de que deseas eliminar este proyecto? Esta acción no se puede deshacer.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="formEliminar" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const modalEliminar = document.getElementById('modalEliminar');
    modalEliminar.addEventListener('show.bs.modal', function (event) {
        const btn = event.relatedTarget;
        const id = btn.getAttribute('data-id');
        const nombre = btn.getAttribute('data-nombre');

        document.getElementById('modalEliminarBody').innerHTML =
            `¿Estás seguro de que deseas eliminar el proyecto <strong>${nombre}</strong>? Esta acción <strong>no se puede deshacer</strong>.`;
        document.getElementById('formEliminar').action = `/proyectos/${id}`;
    });
</script>
@endsection