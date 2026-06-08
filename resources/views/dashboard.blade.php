@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1><i class="fas fa-chart-line"></i> Dashboard</h1>
            <p class="text-muted">Bienvenido, {{ Auth::user()->nombre }}</p>
        </div>
    </div>

    @if(Auth::user()->rol === 'Admin')
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="fas fa-shield-alt"></i> Panel de Administración</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-users-cog fa-3x text-danger mb-3"></i>
                                    <h5>Gestión de Usuarios</h5>
                                    <p class="text-muted">Total: {{ App\Models\User::count() }} usuarios</p>
                                    <a href="{{ route('usuarios.index') }}" class="btn btn-danger btn-sm">
                                        <i class="fas fa-cog"></i> Gestionar
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-user-shield fa-3x text-warning mb-3"></i>
                                    <h5>Administradores</h5>
                                    <p class="text-muted">Total: {{ App\Models\User::where('rol', 'Admin')->count() }}</p>
                                    <a href="{{ route('usuarios.create') }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-plus"></i> Nuevo Usuario
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-chart-bar fa-3x text-info mb-3"></i>
                                    <h5>Estadísticas</h5>
                                    <p class="text-muted">
                                        Gerentes: {{ App\Models\User::where('rol', 'Gerente')->count() }} | 
                                        Devs: {{ App\Models\User::where('rol', 'Desarrollador')->count() }}
                                    </p>
                                    <a href="{{ route('usuarios.index') }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Ver Todos
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection
