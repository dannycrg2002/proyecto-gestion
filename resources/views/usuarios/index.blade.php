@extends('layouts.app')

@section('title', 'Gestión de Usuarios')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1><i class="fas fa-users-cog"></i> Gestión de Usuarios</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Usuario
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if($usuarios->count() > 0)
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Fecha Registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->nombre }}</td>
                                <td>{{ $usuario->correo }}</td>
                                <td>
                                    @if($usuario->rol == 'Admin')
                                        <span class="badge bg-danger">Admin</span>
                                    @elseif($usuario->rol == 'Gerente')
                                        <span class="badge bg-warning">Gerente</span>
                                    @else
                                        <span class="badge bg-info">Desarrollador</span>
                                    @endif
                                </td>
                                <td>{{ $usuario->created_at ? $usuario->created_at->format('d/m/Y') : 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('usuarios.show', $usuario->id_usuario) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('usuarios.edit', $usuario->id_usuario) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($usuario->id_usuario != auth()->user()->id_usuario)
                                        <form action="{{ route('usuarios.destroy', $usuario->id_usuario) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Confirmas que deseas eliminar este usuario?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> No hay usuarios registrados.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
