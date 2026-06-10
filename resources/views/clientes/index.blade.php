@extends('layouts.app')

@section('title', 'Clientes')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1><i class="fas fa-users"></i> Gestión de Clientes</h1>
        </div>
        <div class="col-md-6 text-end">
            
            <a href="{{ route('clientes.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Cliente
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if($clientes->count() > 0)
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Fecha Registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->nombre }}</td>
                                <td>{{ $cliente->correo }}</td>
                                <td>{{ $cliente->telefono }}</td>
                                <td>{{ $cliente->fecha_registro->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('clientes.show', $cliente->id_cliente) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('clientes.edit', $cliente->id_cliente) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>


                                    <!-- <form action="{{ route('clientes.destroy', $cliente->id_cliente) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Confirmas que deseas eliminar este cliente?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form> -->
                                    
                                    <button type="button"
                                        class="btn btn-sm btn-danger"
                                        title="Eliminar cliente"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEliminar"
                                        data-id="{{ $cliente->id_cliente }}"
                                        data-nombre="{{ $cliente->nombre }}">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> No hay clientes registrados. 
                    <a href="{{ route('clientes.create') }}">Crear uno ahora</a>
                </div>
            @endif
        </div>
    </div>
</div>



{{-- Modal Eliminar --}}
<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-danger">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalEliminarLabel">
                    <i class="fas fa-exclamation-triangle"></i> Eliminar cliente
                </h5>
                <button type="button" class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body" id="modalEliminarBody">
                ¿Estás seguro de que deseas eliminar este cliente? Esta acción no se puede deshacer.
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary"
                        data-bs-dismiss="modal">
                    Cancelar
                </button>

                <form id="formEliminar" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Sí, eliminar
                    </button>
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
            `¿Estás seguro de que deseas eliminar a <strong>${nombre}</strong>? Esta acción <strong>no se puede deshacer</strong>.`;

        document.getElementById('formEliminar').action = `/clientes/${id}`;
    });
</script>
@endsection
