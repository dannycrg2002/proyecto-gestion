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
    <div class="row">
        <div class="col-md-3">
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

        <div class="col-md-3">
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

        <div class="col-md-3">
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
    @endif
    
    <!-- Cards de Proyectos y Clientes -->
    <div class="row {{ Auth::user()->rol === 'Admin' ? 'mt-4' : '' }}">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-folder-open fa-3x text-primary mb-3"></i>
                    <h5>Gestión de Proyectos</h5>
                    <p class="text-muted">Total: {{ App\Models\Proyecto::count() }} proyectos</p>
                    <a href="{{ route('proyectos.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-cog"></i> Gestionar
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-3x text-success mb-3"></i>
                    <h5>Gestión de Clientes</h5>
                    <p class="text-muted">
                        Total: {{ App\Models\Cliente::count() }} clientes
                    </p>
                    <a href="{{ route('clientes.index') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-cog"></i> Gestionar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards de Clientes -->
    <div class="row mt-4">
        <div class="col-md-12">
            <h4><i class="fas fa-users"></i> Información de Clientes</h4>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-address-book"></i> Total de Clientes</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="display-4 text-primary mb-0">{{ $totalClientes }}</h2>
                            <p class="text-muted">Clientes registrados</p>
                        </div>
                        <i class="fas fa-user-tie fa-4x text-primary opacity-25"></i>
                    </div>
                    <hr>
                    <a href="{{ route('clientes.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-list"></i> Ver todos los clientes
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-success">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-user-check"></i> Clientes con Proyectos</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="display-4 text-success mb-0">{{ $clientesConProyectos }}</h2>
                            <p class="text-muted">Clientes activos con proyectos</p>
                        </div>
                        <i class="fas fa-handshake fa-4x text-success opacity-25"></i>
                    </div>
                    <hr>
                    <div class="progress" style="height: 25px;">
                        <div class="progress-bar bg-success" role="progressbar" 
                             style="width: {{ $totalClientes > 0 ? ($clientesConProyectos / $totalClientes * 100) : 0 }}%">
                            {{ $totalClientes > 0 ? number_format(($clientesConProyectos / $totalClientes * 100), 1) : 0 }}%
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards de Proyectos -->
    <div class="row mt-4">
        <div class="col-md-12">
            <h4><i class="fas fa-folder-open"></i> Información de Proyectos</h4>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card border-info">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-tasks"></i> Proyectos por Estado</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tbody>
                            @foreach(['En Progreso', 'Completado', 'Pausado', 'Cancelado'] as $estado)
                            <tr>
                                <td>
                                    <i class="fas fa-circle 
                                        @if($estado === 'En Progreso') text-primary
                                        @elseif($estado === 'Completado') text-success
                                        @elseif($estado === 'Pausado') text-warning
                                        @else text-danger
                                        @endif
                                    "></i>
                                    {{ $estado }}
                                </td>
                                <td class="text-end">
                                    <span class="badge bg-secondary">
                                        {{ $proyectosPorEstado[$estado] ?? 0 }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <a href="{{ route('proyectos.index') }}" class="btn btn-info btn-sm">
                        <i class="fas fa-list"></i> Ver todos los proyectos
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-warning">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-exclamation-triangle"></i> Proyectos Próximos a Vencer</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="display-4 text-warning mb-0">{{ $proyectosProximosVencer }}</h2>
                            <p class="text-muted">Proyectos que vencen en 15 días</p>
                        </div>
                        <i class="fas fa-clock fa-4x text-warning opacity-25"></i>
                    </div>
                    <hr>
                    @if($proyectosProximosVencer > 0)
                        <div class="alert alert-warning mb-0" role="alert">
                            <i class="fas fa-info-circle"></i> Hay {{ $proyectosProximosVencer }} proyecto(s) que requieren atención
                        </div>
                    @else
                        <div class="alert alert-success mb-0" role="alert">
                            <i class="fas fa-check-circle"></i> No hay proyectos próximos a vencer
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    


</div>
@endsection
