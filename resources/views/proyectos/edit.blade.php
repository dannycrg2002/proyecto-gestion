<!DOCTYPE html>
<html>
<head>
    <title>Editar Proyecto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 30px;
        }

        .formulario {
            background: white;
            width: 500px;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.2);
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 12px;
        }

        input, select, textarea {
            width: 100%;
            padding: 9px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button, a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 14px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .volver {
            background: #374151;
        }

        .error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h1>Editar Proyecto</h1>

<div class="formulario">

    @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('proyectos.update', $proyecto->id_proyecto) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Cliente:</label>
        <select name="id_cliente" required>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id_cliente }}" 
                    {{ $proyecto->id_cliente == $cliente->id_cliente ? 'selected' : '' }}>
                    {{ $cliente->nombre }}
                </option>
            @endforeach
        </select>

        <label>Nombre del proyecto:</label>
        <input type="text" name="nombre" value="{{ $proyecto->nombre }}" required>

        <label>Descripción:</label>
        <textarea name="descripcion" rows="4">{{ $proyecto->descripcion }}</textarea>

        <label>Estado:</label>
        <select name="estado" required>
            <option value="En curso" {{ $proyecto->estado == 'En curso' ? 'selected' : '' }}>En curso</option>
            <option value="Completado" {{ $proyecto->estado == 'Completado' ? 'selected' : '' }}>Completado</option>
            <option value="Cancelado" {{ $proyecto->estado == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
        </select>

        <label>Fecha de inicio:</label>
        <input type="date" name="fecha_inicio" value="{{ $proyecto->fecha_inicio }}">

        <label>Fecha de fin:</label>
        <input type="date" name="fecha_fin" value="{{ $proyecto->fecha_fin }}">

        <button type="submit">Actualizar proyecto</button>
        <a href="{{ route('proyectos.index') }}" class="volver">Cancelar</a>
    </form>

</div>

</body>
</html>