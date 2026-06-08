@extends('layouts.app')

@section('title', 'Registrarse')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top: 50px;">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-user-plus"></i> Registrarse</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register.submit') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                                   id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                            @error('nombre')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control @error('correo') is-invalid @enderror" 
                                   id="correo" name="correo" value="{{ old('correo') }}" required>
                            @error('correo')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <select class="form-control @error('rol') is-invalid @enderror" id="rol" name="rol" required>
                                <option value="">Selecciona un rol</option>
                                <option value="Desarrollador" {{ old('rol') == 'Desarrollador' ? 'selected' : '' }}>Desarrollador</option>
                                <option value="Gerente" {{ old('rol') == 'Gerente' ? 'selected' : '' }}>Gerente</option>
                                <option value="Admin" {{ old('rol') == 'Admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('rol')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="contraseña" class="form-label">Contraseña</label>
                            <input type="password" class="form-control @error('contraseña') is-invalid @enderror" 
                                   id="contraseña" name="contraseña" required>
                            @error('contraseña')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="contraseña_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="contraseña_confirmation" 
                                   name="contraseña_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Registrarse</button>
                    </form>

                    <div class="mt-3 text-center">
                        <p>¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
