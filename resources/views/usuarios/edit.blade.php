@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1><i class="fas fa-user-edit"></i> Editar Usuario</h1>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('usuarios.update', $usuario->id_usuario) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                           id="nombre" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="correo" class="form-label">Correo Electrónico <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('correo') is-invalid @enderror" 
                           id="correo" name="correo" value="{{ old('correo', $usuario->correo) }}" required>
                    @error('correo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="contraseña" class="form-label">Nueva Contraseña</label>
                    <input type="password" class="form-control @error('contraseña') is-invalid @enderror" 
                           id="contraseña" name="contraseña">
                    <small class="text-muted">Dejar en blanco si no deseas cambiar la contraseña. Mínimo 6 caracteres.</small>
                    @error('contraseña')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="contraseña_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                    <input type="password" class="form-control" id="contraseña_confirmation" 
                           name="contraseña_confirmation">
                </div>

                <div class="mb-3">
                    <label for="rol" class="form-label">Rol <span class="text-danger">*</span></label>
                    <select class="form-select @error('rol') is-invalid @enderror" id="rol" name="rol" required>
                        <option value="">Seleccione un rol</option>
                        <option value="Admin" {{ old('rol', $usuario->rol) == 'Admin' ? 'selected' : '' }}>Admin</option>
                        <option value="Gerente" {{ old('rol', $usuario->rol) == 'Gerente' ? 'selected' : '' }}>Gerente</option>
                        <option value="Desarrollador" {{ old('rol', $usuario->rol) == 'Desarrollador' ? 'selected' : '' }}>Desarrollador</option>
                    </select>
                    @error('rol')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Actualizar Usuario
                    </button>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
