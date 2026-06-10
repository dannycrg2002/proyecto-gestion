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
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                            <tr class="{{ $usuario->estado === 'inactivo' ? 'table-secondary text-muted' : '' }}">
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
                                <td>
                                    @if($usuario->estado === 'inactivo')
                                        <span class="badge bg-secondary"><i class="fas fa-ban"></i> Inactivo</span>
                                    @else
                                        <span class="badge bg-success"><i class="fas fa-check-circle"></i> Activo</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('usuarios.show', $usuario->id_usuario) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('usuarios.edit', $usuario->id_usuario) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($usuario->id_usuario != auth()->user()->id_usuario)
                                        {{-- Botón activar/desactivar --}}
                                        @if($usuario->estado === 'inactivo')
                                            <button type="button" class="btn btn-sm btn-success" title="Activar usuario"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalToggle"
                                                data-id="{{ $usuario->id_usuario }}"
                                                data-nombre="{{ $usuario->nombre }}"
                                                data-accion="activar">
                                                <i class="fas fa-toggle-off"></i>
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-secondary" title="Desactivar usuario"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalToggle"
                                                data-id="{{ $usuario->id_usuario }}"
                                                data-nombre="{{ $usuario->nombre }}"
                                                data-accion="desactivar">
                                                <i class="fas fa-toggle-on"></i>
                                            </button>
                                        @endif
                                        {{-- Botón eliminar --}}
                                        <button type="button" class="btn btn-sm btn-danger" title="Eliminar usuario"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEliminar"
                                            data-id="{{ $usuario->id_usuario }}"
                                            data-nombre="{{ $usuario->nombre }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
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

{{-- Modal: Activar / Desactivar --}}
<div class="modal fade" id="modalToggle" tabindex="-1" aria-labelledby="modalToggleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" id="modalToggleHeader">
                <h5 class="modal-title" id="modalToggleLabel">Confirmar acción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body" id="modalToggleBody">
                ¿Estás seguro de que deseas continuar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="formToggle" method="POST">
                    @csrf
                    <button type="submit" class="btn" id="btnConfirmarToggle">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal: Eliminar --}}
<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-danger">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalEliminarLabel"><i class="fas fa-exclamation-triangle"></i> Eliminar usuario</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body" id="modalEliminarBody">
                ¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.
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
    // Modal Activar/Desactivar
    const modalToggle = document.getElementById('modalToggle');
    modalToggle.addEventListener('show.bs.modal', function (event) {
        const btn = event.relatedTarget;
        const id = btn.getAttribute('data-id');
        const nombre = btn.getAttribute('data-nombre');
        const accion = btn.getAttribute('data-accion');

        const header = document.getElementById('modalToggleHeader');
        const body = document.getElementById('modalToggleBody');
        const btnConfirmar = document.getElementById('btnConfirmarToggle');
        const form = document.getElementById('formToggle');

        form.action = `/usuarios/${id}/toggle-estado`;

        if (accion === 'desactivar') {
            header.className = 'modal-header bg-warning';
            modalToggle.querySelector('.modal-title').innerHTML = '<i class="fas fa-toggle-on"></i> Desactivar usuario';
            body.innerHTML = `¿Estás seguro de que deseas <strong>desactivar</strong> a <strong>${nombre}</strong>? El usuario no podrá iniciar sesión.`;
            btnConfirmar.className = 'btn btn-warning';
            btnConfirmar.textContent = 'Sí, desactivar';
        } else {
            header.className = 'modal-header bg-success text-white';
            modalToggle.querySelector('.modal-title').innerHTML = '<i class="fas fa-toggle-off"></i> Activar usuario';
            body.innerHTML = `¿Deseas <strong>activar</strong> a <strong>${nombre}</strong>? El usuario podrá volver a iniciar sesión.`;
            btnConfirmar.className = 'btn btn-success';
            btnConfirmar.textContent = 'Sí, activar';
        }
    });

    // Modal Eliminar
    const modalEliminar = document.getElementById('modalEliminar');
    modalEliminar.addEventListener('show.bs.modal', function (event) {
        const btn = event.relatedTarget;
        const id = btn.getAttribute('data-id');
        const nombre = btn.getAttribute('data-nombre');

        document.getElementById('modalEliminarBody').innerHTML =
            `¿Estás seguro de que deseas eliminar a <strong>${nombre}</strong>? Esta acción <strong>no se puede deshacer</strong>.`;
        document.getElementById('formEliminar').action = `/usuarios/${id}`;
    });
</script>
@endsection
