<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Sistema de Gestión de Proyectos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar {
            background-color: #2c3e50 !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5em;
        }
        .sidebar {
            background-color: #34495e;
            min-height: 100vh;
            padding-top: 20px;
            position: relative;
        }
        .sidebar a {
            color: #34495e;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            border-left: 4px solid transparent;
            transition: all 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #2c3e50;
            border-left-color: #3498db;
            color: #fff;
        }
        .sidebar a.active {
            background-color: #3498db;
            border-left-color: #2980b9;
            color: #fff;
        }
        .main-content {
            padding: 30px;
        }
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
        }
        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }
        .alert {
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }
        footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            text-align: center;
            padding: 20px;
            margin-top: auto;
        }

        /* Botón para toggle del sidebar en móvil */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 70px;
            left: 10px;
            z-index: 1000;
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        /* Estilos responsive */
        @media (max-width: 768px) {
            .sidebar-toggle {
                display: block;
            }

            .sidebar {
                position: fixed;
                left: -100%;
                top: 56px;
                width: 250px;
                z-index: 999;
                transition: left 0.3s ease;
                min-height: calc(100vh - 56px);
            }

            .sidebar.show {
                left: 0;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 56px;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0,0,0,0.5);
                z-index: 998;
            }

            .sidebar-overlay.show {
                display: block;
            }

            .col-md-9 {
                width: 100%;
                padding: 0;
            }

            .main-content {
                padding: 15px;
            }
        }

        @media (min-width: 769px) {
            .sidebar {
                display: block !important;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="fas fa-project-diagram"></i> Gestión de Proyectos
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @if(Auth::check())
                        <li class="nav-item">
                            <span class="nav-link">{{ Auth::user()->nombre }} ({{ Auth::user()->rol }})</span>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">Salir</button>
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @if(Auth::check())
        <!-- Botón toggle para móvil -->
        <button class="sidebar-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i> Menú
        </button>

        <!-- Overlay para cerrar sidebar en móvil -->
        <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 sidebar" id="sidebar">
                    <div class="list-group">
                        <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action {{ Route::is('dashboard') ? 'active' : '' }}">
                            <i class="fas fa-chart-line"></i> Dashboard
                        </a>
                        <a href="{{ route('proyectos.index') }}" class="list-group-item list-group-item-action {{ Route::is('proyectos.*') ? 'active' : '' }}">
                            <i class="fas fa-tasks"></i> Proyectos
                        </a>

                        <a href="{{ route('clientes.index') }}" class="list-group-item list-group-item-action {{ Route::is('clientes.*') ? 'active' : '' }}">
                            <i class="fas fa-users"></i> Clientes
                        </a>
                        


                        <a href="{{ route('tareas.index') }}"
                        class="list-group-item list-group-item-action {{ Route::is('tareas.*') ? 'active' : '' }}">
                            <i class="fas fa-tasks me-2"></i> Tareas
                        </a>

                        
                        <a href="{{ route('reportes.index') }}"
                        class="list-group-item list-group-item-action {{ Route::is('reportes.*') ? 'active' : '' }}">
                            <i class="fas fa-file-pdf me-2 text-danger"></i> Reportes PDF
                        </a>




                        @if(Auth::user()->rol === 'Admin')
                            <a href="{{ route('usuarios.index') }}" class="list-group-item list-group-item-action {{ Route::is('usuarios.*') ? 'active' : '' }}">
                                <i class="fas fa-users-cog"></i> Usuarios
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="main-content">
                        @if($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($message = Session::get('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $message }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="main-content">
            @if($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    @endif

    <footer>
        <p>&copy; 2026 TecnoSoluciones S.A. - Sistema de Gestión de Proyectos</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            
            if (sidebar && overlay) {
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            }
        }

        // Cerrar sidebar al hacer clic en un enlace en móvil
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarLinks = document.querySelectorAll('.sidebar a');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        toggleSidebar();
                    }
                });
            });
        });
    </script>

    @yield('scripts')
</body>
</html>
