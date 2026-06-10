<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reporte de Clientes — TecnoSoluciones S.A.</title>
<style>
  @page { size: A4; margin: 15mm; }
  @media print {
    .no-print { display: none !important; }
    body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    tr { page-break-inside: avoid; }
  }
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: 'Segoe UI', Arial, sans-serif; font-size: 12px; color: #2c3e50; background: #fff; }

  .no-print {
    position: fixed; top: 12px; right: 12px;
    background: #27ae60; color: #fff; border: none;
    padding: 10px 18px; border-radius: 6px; cursor: pointer;
    font-size: 14px; font-weight: bold; z-index: 999;
    box-shadow: 0 2px 8px rgba(0,0,0,0.25);
  }
  .no-print:hover { background: #229954; }

  .enc {
    background: #27ae60; color: #fff;
    padding: 18px 22px; border-radius: 8px; margin-bottom: 16px;
    display: flex; justify-content: space-between; align-items: flex-start;
  }
  .enc .empresa { font-size: 20px; font-weight: bold; }
  .enc .sub     { font-size: 12px; opacity: 0.8; margin-top: 4px; }
  .enc .meta    { text-align: right; font-size: 11px; opacity: 0.8; line-height: 1.8; }

  .kpis { display: grid; grid-template-columns: repeat(3,1fr); gap: 10px; margin-bottom: 16px; }
  .kpi  { border: 1px solid #ddd; border-radius: 6px; padding: 10px; text-align: center; background: #f8f9fa; }
  .kpi .n { font-size: 24px; font-weight: bold; color: #27ae60; }
  .kpi .l { font-size: 10px; color: #888; margin-top: 2px; }

  .sec-title {
    background: #27ae60; color: #fff;
    padding: 7px 12px; font-size: 13px; font-weight: bold;
    border-radius: 4px; margin-bottom: 10px;
  }

  table { width: 100%; border-collapse: collapse; font-size: 11px; }
  thead th { background: #27ae60; color: #fff; padding: 7px 8px; text-align: left; }
  tbody tr:nth-child(even) { background: #eafaf1; }
  tbody td { padding: 7px 8px; border-bottom: 1px solid #ddd; }

  .pie { margin-top: 20px; border-top: 2px solid #27ae60; padding-top: 10px;
         font-size: 10px; color: #888; display: flex; justify-content: space-between; }
</style>
</head>
<body>

<button class="no-print" onclick="window.print()">🖨️ Imprimir / Guardar PDF</button>

<div class="enc">
    <div>
        <div class="empresa">TecnoSoluciones S.A.</div>
        <div class="sub">Reporte General de Clientes</div>
        <div class="sub">Sistema de Gestión de Proyectos</div>
    </div>
    <div class="meta">
        Fecha: {{ $fecha }}<br>
        Total clientes: {{ $clientes->count() }}<br>
        Generado por: Sistema Web
    </div>
</div>

@php
    $totalProy  = $clientes->sum('proyectos_count');
    $totalComp  = $clientes->sum(fn($c) => $c->proyectos->where('estado','Completado')->count());
    $totalCurso = $clientes->sum(fn($c) => $c->proyectos->where('estado','En curso')->count());
@endphp

<div class="kpis">
    <div class="kpi"><div class="n">{{ $clientes->count() }}</div><div class="l">Total Clientes</div></div>
    <div class="kpi"><div class="n">{{ $totalProy }}</div><div class="l">Proyectos Asignados</div></div>
    <div class="kpi"><div class="n">{{ $totalComp }}</div><div class="l">Proyectos Completados</div></div>
</div>

<div class="sec-title">👥 Listado de Clientes</div>
<table>
    <thead>
        <tr>
            <th>#</th><th>Nombre</th><th>Correo</th><th>Teléfono</th>
            <th>Proyectos</th><th>En Curso</th><th>Completados</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clientes as $c)
        <tr>
            <td>{{ $c->id_cliente }}</td>
            <td><strong>{{ $c->nombre }}</strong></td>
            <td>{{ $c->correo }}</td>
            <td>{{ $c->telefono }}</td>
            <td style="text-align:center">{{ $c->proyectos_count }}</td>
            <td style="text-align:center">{{ $c->proyectos->where('estado','En curso')->count() }}</td>
            <td style="text-align:center">{{ $c->proyectos->where('estado','Completado')->count() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="pie">
    <span>TecnoSoluciones S.A. — Sistema de Gestión de Proyectos</span>
    <span>Generado el {{ $fecha }} — Documento confidencial</span>
</div>
</body>
</html>
