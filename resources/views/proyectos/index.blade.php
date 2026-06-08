<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Proyectos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 30px;
        }

        h1 {
            color: #1f2937;
        }

        .btn {
            padding: 8px 12px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .editar {
            background: #f59e0b;
        }

        .eliminar {
            background: #dc2626;
        }

        .volver {
            background: #374151;
        }

        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #d1d5db;
            padding: 10px;
            text-align: center;
        }

        th {
            background: #1f2937;
            color: white;
        }

        input, select {
            padding: 8px;
            margin-right: 5px;
        }

        .mensaje {
            background: #dcfce7;
            color: #166534;
            padding: 10px;
            border-radius: 6px;
            margin-top: 15px;
        }

        .acciones {
            display: flex;
            justify-content: center;
            gap: 5px;
        }
    </style>
</head>
<body>

<h1>Gestión de Proyectos</h1>

<a href="{{ url('/') }}" class="btn volver">Volver</a>
<a href="{{ route('proyectos.create') }}" class="btn">Agregar proyecto</a>

@if(session('mensaje'))
    <div class="mensaje">{{ session('mensaje') }}</div>
@endif

<br><br>

<form method="GET" action="{{ route('proyectos.index') }}">
    <input type="text" name="buscar" placeholder="Buscar proyecto" value="{{ $buscar ?? '' }}">

    <select name="estado">
        <option value="">Todos los estados</option>
        <option value="En curso" {{ ($estado ?? '') == 'En curso' ? 'selected' : '' }}>En curso</option>
        <option value="Completado" {{ ($estado ?? '') == 'Completado' ? 'selected' : '' }}>Completado</option>
        <option value="Cancelado" {{ ($estado ?? '') == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
    </select>

    <button type="submit" class="btn">Buscar</button>
</form>

<table>
    <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Proyecto</th>
        <th>Descripción</th>
        <th>Estado</th>
        <th>Fecha inicio</th>
        <th>Fecha fin</th>
        <th>Acciones</th>
    </tr>

    @forelse($proyectos as $proyecto)
        <tr>
            <td>{{ $proyecto->id_proyecto }}</td>
            <td>{{ $proyecto->cliente->nombre ?? 'Sin cliente' }}</td>
            <td>{{ $proyecto->nombre }}</td>
            <td>{{ $proyecto->descripcion }}</td>
            <td>{{ $proyecto->estado }}</td>
            <td>{{ $proyecto->fecha_inicio }}</td>
            <td>{{ $proyecto->fecha_fin }}</td>
            <td>
                <div class="acciones">
                    <a href="{{ route('proyectos.edit', $proyecto->id_proyecto) }}" class="btn editar">Editar</a>

                    <form action="{{ route('proyectos.destroy', $proyecto->id_proyecto) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este proyecto?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn eliminar">Eliminar</button>
                    </form>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8">No hay proyectos registrados.</td>
        </tr>
    @endforelse
</table>

</body>
</html>