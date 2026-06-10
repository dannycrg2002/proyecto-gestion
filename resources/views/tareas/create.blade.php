@extends('layouts.app')
@section('title', 'Nueva Tarea')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-plus-circle"></i> Nueva Tarea</h2>
    <a href="{{ route('tareas.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
</div>

<div class="card">
    <div class="card-body">

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('tareas.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Proyecto <span class="text-danger">*</span></label>
                <select name="id_proyecto"
                        class="form-select @error('id_proyecto') is-invalid @enderror" required>
                    <option value="">— Seleccione un proyecto —</option>
                    @foreach($proyectos as $p)
                        <option value="{{ $p->id_proyecto }}"
                            {{ old('id_proyecto') == $p->id_proyecto ? 'selected' : '' }}>
                            {{ $p->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('id_proyecto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Descripción <span class="text-danger">*</span></label>
                <textarea name="descripcion" rows="3"
                          class="form-control @error('descripcion') is-invalid @enderror"
                          required>{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Responsable <span class="text-danger">*</span></label>
                <input type="text" name="responsable"
                       class="form-control @error('responsable') is-invalid @enderror"
                       value="{{ old('responsable') }}"
                       placeholder="Nombre del responsable" required>
                @error('responsable')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Fecha Límite <span class="text-danger">*</span></label>
                    <input type="date" name="fecha_limite"
                           class="form-control @error('fecha_limite') is-invalid @enderror"
                           value="{{ old('fecha_limite') }}" required>
                    @error('fecha_limite')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Estado <span class="text-danger">*</span></label>
                    <select name="estado"
                            class="form-select @error('estado') is-invalid @enderror" required>
                        @foreach(['Pendiente','En progreso','Finalizado'] as $e)
                            <option value="{{ $e }}"
                                {{ old('estado','Pendiente') === $e ? 'selected' : '' }}>
                                {{ $e }}
                            </option>
                        @endforeach
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Guardar Tarea
                </button>
                <a href="{{ route('tareas.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
