@extends('layouts.app')
@section('title', 'Reportes PDF')

@section('content')
<div class="mb-4">
    <h2><i class="fas fa-file-pdf text-danger"></i> Generación de Reportes</h2>
    <p class="text-muted">Selecciona el tipo de reporte que deseas generar.</p>
</div>

{{-- Estadísticas --}}
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-center border-primary">
            <div class="card-body">
                <h3 class="text-primary">{{ $stats['clientes'] }}</h3>
                <small class="text-muted">Clientes registrados</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center border-success">
            <div class="card-body">
                <h3 class="text-success">{{ $stats['proyectos'] }}</h3>
                <small class="text-muted">Proyectos totales</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center border-info">
            <div class="card-body">
                <h3 class="text-info">{{ $stats['en_curso'] }}</h3>
                <small class="text-muted">Proyectos en curso</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center border-warning">
            <div class="card-body">
                <h3 class="text-warning">{{ $stats['tareas'] }}</h3>
                <small class="text-muted">Tareas registradas</small>
            </div>
        </div>
    </div>
</div>

<div class="alert alert-info">
    <i class="fas fa-info-circle"></i>
    Los reportes se abren en una nueva pestaña. Usa
    <strong>Ctrl+P → Guardar como PDF</strong> para exportarlos.
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card border-top border-primary border-3 h-100">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">
                    <i class="fas fa-folder-open text-primary"></i> Reporte de Proyectos
                </h5>
                <p class="text-muted">
                    Reporte detallado de todos los proyectos con estado, cliente, fechas
                    y desglose completo de tareas asignadas.
                </p>
                <ul class="list-unstyled mb-3">
                    <li><i class="fas fa-check text-success"></i> Listado completo de proyectos</li>
                    <li><i class="fas fa-check text-success"></i> Cliente y fechas de cada proyecto</li>
                    <li><i class="fas fa-check text-success"></i> Conteo de tareas por estado</li>
                    <li><i class="fas fa-check text-success"></i> Detalle de tareas por proyecto</li>
                </ul>
                <div class="mt-auto">
                    <a href="{{ route('reportes.proyectos') }}" target="_blank"
                       class="btn btn-primary w-100">
                        <i class="fas fa-file-pdf"></i> Generar Reporte de Proyectos
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-top border-success border-3 h-100">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">
                    <i class="fas fa-users text-success"></i> Reporte de Clientes
                </h5>
                <p class="text-muted">
                    Reporte de todos los clientes registrados con datos de contacto
                    y resumen de proyectos asociados.
                </p>
                <ul class="list-unstyled mb-3">
                    <li><i class="fas fa-check text-success"></i> Datos de contacto completos</li>
                    <li><i class="fas fa-check text-success"></i> Total de proyectos por cliente</li>
                    <li><i class="fas fa-check text-success"></i> Proyectos en curso y completados</li>
                    <li><i class="fas fa-check text-success"></i> Fecha de registro del cliente</li>
                </ul>
                <div class="mt-auto">
                    <a href="{{ route('reportes.clientes') }}" target="_blank"
                       class="btn btn-success w-100">
                        <i class="fas fa-file-pdf"></i> Generar Reporte de Clientes
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
