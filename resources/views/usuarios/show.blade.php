@extends('layouts.app')

@section('title', 'Detalles del Usuario')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1><i class="fas fa-user"></i> {{ $usuario->nombre }}</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('usuarios.edit', $usuario->id_usuario) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-light">
            <h5 class="mb-0">Información del Usuario</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <strong>Nombre:</strong>
                        <p>{{ $usuario->nombre }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Correo Electrónico:</strong>
                        <p>{{ $usuario->correo }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <strong>Rol:</strong>
                        <p>
                            @if($usuario->rol == 'Admin')
                                <span class="badge bg-danger">Admin</span>
                            @elseif($usuario->rol == 'Gerente')
                                <span class="badge bg-warning">Gerente</span>
                            @else
                                <span class="badge bg-info">Desarrollador</span>
                            @endif
                        </p>
                    </div>
                    <div class="mb-3">
                        <strong>Estado:</strong>
                        <p>
                            @if($usuario->estado === 'inactivo')
                                <span class="badge bg-secondary fs-6"><i class="fas fa-ban"></i> Inactivo</span>
                            @else
                                <span class="badge bg-success fs-6"><i class="fas fa-check-circle"></i> Activo</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
