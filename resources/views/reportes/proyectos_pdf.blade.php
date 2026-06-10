<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reporte de Proyectos — TecnoSoluciones S.A.</title>
<style>
  @page { size: A4; margin: 15mm; }
  @media print {
    .no-print { display: none !important; }
    body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    tr { page-break-inside: avoid; }
    .bloque { page-break-inside: avoid; }
  }
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: 'Segoe UI', Arial, sans-serif; font-size: 12px; color: #2c3e50; background: #fff; }

  .no-print {
    position: fixed; top: 12px; right: 12px;
    background: #2c3e50; color: #fff; border: none;
    padding: 10px 18px; border-radius: 6px; cursor: pointer;
    font-size: 14px; font-weight: bold; z-index: 999;
    box-shadow: 0 2px 8px rgba(0,0,0,0.25);
  }
  .no-print:hover { background: #3498db; }

  .enc {
    background: #2c3e50; color: #fff;
    padding: 18px 22px; border-radius: 8px; margin-bottom: 16px;
    display: flex; justify-content: space-between; align-items: flex-start;
  }
  .enc .empresa { font-size: 20px; font-weight: bold; }
  .enc .sub     { font-size: 12px; opacity: 0.8; margin-top: 4px; }
  .enc .meta    { text-align: right; font-size: 11px; opacity: 0.8; line-height: 1.8; }

  .kpis { display: grid; grid-template-columns: repeat(4,1fr); gap: 10px; margin-bottom: 16px; }
  .kpi  { border: 1px solid #ddd; border-radius: 6px; padding: 10px; text-align: center; background: #f8f9fa; }
  .kpi .n { font-size: 24px; font-weight: bold; color: #2c3e50; }
  .kpi .l { font-size: 10px; color: #888; margin-top: 2px; }

  .sec-title {
    background: #3498db; color: #fff;
    padding: 7px 12px; font-size: 13px; font-weight: bold;
    border-radius: 4px; margin: 16px 0 10px;
  }

  table.resumen { width: 100%; border-collapse: collapse; font-size: 11px; margin-bottom: 16px; }
  table.resumen thead th { background: #2c3e50; color: #fff; padding: 7px 8px; text-align: left; }
  table.resumen tbody tr:nth-child(even) { background: #f0f4f8; }
  table.resumen tbody td { padding: 6px 8px; border-bottom: 1px solid #ddd; }

  .bloque { margin-bottom: 14px; border: 1px solid #ddd; border-radius: 6px; overflow: hidden; }
  .bloque-head {
    background: #ecf0f1; padding: 9px 14px;
    border-bottom: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center;
  }
  .bloque-head strong { font-size: 13px; color: #2c3e50; }
  .bloque-body { padding: 10px 14px; }
  .bloque-meta { font-size: 11px; color: #555; margin-bottom: 8px; line-height: 1.9; }

  table.tareas { width: 100%; border-collapse: collapse; font-size: 10px; }
  table.tareas thead th { background: #dfe6e9; color: #2c3e50; padding: 5px 6px; text-align: left; }
  table.tareas tbody td { padding: 4px 6px; border-bottom: 1px solid #eee; }

  .badge { display: inline-block; padding: 2px 8px; border-radius: 10px; font-size: 10px; font-weight: bold; }
  .b-encurso    { background: #d6eaf8; color: #1a5276; }
  .b-completado { background: #d5f5e3; color: #1e8449; }
  .b-cancelado  { background: #fadbd8; color: #922b21; }
  .b-pendiente  { background: #fef9e7; color: #9a7d0a; }
  .b-progreso   { background: #d6eaf8; color: #1a5276; }
  .b-finalizado { background: #d5f5e3; color: #1e8449; }

  .pie { margin-top: 20px; border-top: 2px solid #3498db; padding-top: 10px;
         font-size: 10px; color: #888; display: flex; justify-content: space-between; }
</style>
</head>
<body>

<button class="no-print" onclick="window.print()">🖨️ Imprimir / Guardar PDF</button>

<div class="enc">
    <div>
        <div class="empresa">TecnoSoluciones S.A.</div>
        <div class="sub">Reporte General de Proyectos</div>
        <div class="sub">Sistema de Gestión de Proyectos</div>
    </div>
    <div class="meta">
        Fecha: {{ $fecha }}<br>
        Total proyectos: {{ $proyectos->count() }}<br>
        Generado por: Sistema Web
    </div>
</div>

<div class="kpis">
    <div class="kpi"><div class="n">{{ $proyectos->count() }}</div><div class="l">Total Proyectos</div></div>
    <div class="kpi"><div class="n">{{ $resumen['en_curso'] }}</div><div class="l">En Curso</div></div>
    <div class="kpi"><div class="n">{{ $resumen['completados'] }}</div><div class="l">Completados</div></div>
    <div class="kpi"><div class="n">{{ $resumen['total_tareas'] }}</div><div class="l">Total Tareas</div></div>
</div>

<div class="sec-title">📊 Tabla Resumen de Proyectos</div>
<table class="resumen">
    <thead>
        <tr>
            <th>#</th><th>Proyecto</th><th>Cliente</th><th>Estado</th>
            <th>Inicio</th><th>Fin</th><th>Tareas</th><th>Final.</th><th>Pend.</th>
        </tr>
    </thead>
    <tbody>
        @foreach($proyectos as $p)
        @php
            $bc = match($p->estado) {
                'En curso'   => 'b-encurso',
                'Completado' => 'b-completado',
                'Cancelado'  => 'b-cancelado',
                default      => ''
            };
        @endphp
        <tr>
            <td>{{ $p->id_proyecto }}</td>
            <td><strong>{{ $p->nombre }}</strong></td>
            <td>{{ $p->cliente->nombre ?? '—' }}</td>
            <td><span class="badge {{ $bc }}">{{ $p->estado }}</span></td>
            <td>{{ $p->fecha_inicio }}</td>
            <td>{{ $p->fecha_fin }}</td>
            <td style="text-align:center">{{ $p->tareas->count() }}</td>
            <td style="text-align:center">{{ $p->tareas->where('estado','Finalizado')->count() }}</td>
            <td style="text-align:center">{{ $p->tareas->where('estado','Pendiente')->count() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="sec-title">📋 Detalle de Tareas por Proyecto</div>

@foreach($proyectos as $p)
@php
    $bc = match($p->estado) {
        'En curso'   => 'b-encurso',
        'Completado' => 'b-completado',
        'Cancelado'  => 'b-cancelado',
        default      => ''
    };
@endphp
<div class="bloque">
    <div class="bloque-head">
        <strong>{{ $p->nombre }}</strong>
        <span class="badge {{ $bc }}">{{ $p->estado }}</span>
    </div>
    <div class="bloque-body">
        <div class="bloque-meta">
            <strong>Cliente:</strong> {{ $p->cliente->nombre ?? '—' }} &nbsp;|&nbsp;
            <strong>Inicio:</strong> {{ $p->fecha_inicio }} &nbsp;|&nbsp;
            <strong>Fin:</strong> {{ $p->fecha_fin }} &nbsp;|&nbsp;
            <strong>Tareas:</strong> {{ $p->tareas->count() }}
            ({{ $p->tareas->where('estado','Finalizado')->count() }} finalizadas,
             {{ $p->tareas->where('estado','Pendiente')->count() }} pendientes)
        </div>
        @if($p->tareas->isEmpty())
            <em style="color:#999;font-size:11px;">Sin tareas registradas.</em>
        @else
        <table class="tareas">
            <thead>
                <tr><th>Descripción</th><th>Responsable</th><th>Fecha Límite</th><th>Estado</th></tr>
            </thead>
            <tbody>
                @foreach($p->tareas->sortBy('fecha_limite') as $t)
                @php
                    $bt = match($t->estado) {
                        'Pendiente'   => 'b-pendiente',
                        'En progreso' => 'b-progreso',
                        'Finalizado'  => 'b-finalizado',
                        default       => ''
                    };
                @endphp
                <tr>
                    <td>{{ $t->descripcion }}</td>
                    <td>{{ $t->responsable }}</td>
                    <td>{{ $t->fecha_limite }}</td>
                    <td><span class="badge {{ $bt }}">{{ $t->estado }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endforeach

<div class="pie">
    <span>TecnoSoluciones S.A. — Sistema de Gestión de Proyectos</span>
    <span>Generado el {{ $fecha }} — Documento confidencial</span>
</div>
</body>
</html>
