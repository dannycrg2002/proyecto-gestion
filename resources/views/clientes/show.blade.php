@extends('layouts.app')

@section('title', 'Detalles del Cliente')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1><i class="fas fa-user"></i> {{ $cliente->nombre }}</h1>
        </div>
        <div class="col-md-6 text-end">
            
            <a href="{{ route('clientes.edit', $cliente->id_cliente) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Información del Cliente</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Correo:</strong>
                        <p>{{ $cliente->correo }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Teléfono:</strong>
                        <p>{{ $cliente->telefono }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Fecha de Registro:</strong>
                        <p>{{ $cliente->fecha_registro->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-light">
                    <div class="row">
                        <div class="col-md-10">
                            <h5 class="mb-0">Proyectos Asociados</h5>
                        </div>
                        <div class="col-md-2 text-end">
                            <a href="{{ route('proyectos.create') }}" class="btn btn-sm btn-success">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if($cliente->proyectos->count() > 0)
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                    <!-- <th>Acciones</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cliente->proyectos as $proyecto)
                                    <tr>
                                        <td>{{ $proyecto->nombre }}</td>
                                        <td>
                                            @if($proyecto->estado == 'En curso')
                                                <span class="badge bg-primary">En curso</span>
                                            @elseif($proyecto->estado == 'Completado')
                                                <span class="badge bg-success">Completado</span>
                                            @else
                                                <span class="badge bg-danger">Cancelado</span>
                                            @endif
                                        </td>
                                        <td>
                                            <!-- <a href="{{ route('proyectos.show', $proyecto->id_proyecto) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a> -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">No hay proyectos asociados a este cliente.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
