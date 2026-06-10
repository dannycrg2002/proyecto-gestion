-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-06-2026 a las 22:00:47
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestion_proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `correo`, `telefono`, `fecha_registro`) VALUES
(1, 'Comercial Andina SAC', 'contacto@andina.com', '999111111', '2026-06-07 03:17:42'),
(2, 'Innova Tech SAC', 'info@innovatech.com', '999111112', '2026-06-07 03:17:42'),
(3, 'Grupo Empresarial Perú', 'ventas@gep.com', '999111113', '2026-06-07 03:17:42'),
(4, 'Soluciones Globales', 'contacto@sglobal.com', '999111114', '2026-06-07 03:17:42'),
(5, 'Corporación Digital', 'admin@cordigital.com', '999111115', '2026-06-07 03:17:42'),
(6, 'Servicios Integrales SAC', 'info@sisac.com', '999111116', '2026-06-07 03:17:42'),
(7, 'Consultores Unidos', 'contacto@cunidos.com', '999111117', '2026-06-07 03:17:42'),
(8, 'Alfa Negocios', 'ventas@alfa.com', '999111118', '2026-06-07 03:17:42'),
(9, 'Beta Sistemas', 'soporte@beta.com', '999111119', '2026-06-07 03:17:42'),
(10, 'Omega Consulting', 'gerencia@omega.com', '999111120', '2026-06-07 03:17:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id_proyecto` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` enum('En curso','Completado','Cancelado') DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id_proyecto`, `id_cliente`, `nombre`, `descripcion`, `estado`, `fecha_inicio`, `fecha_fin`) VALUES
(1, 1, 'Sistema de Ventas', 'Desarrollo de sistema de ventas web', 'En curso', '2025-01-10', '2025-06-30'),
(2, 2, 'Portal Corporativo', 'Portal institucional para empresa', 'Completado', '2024-08-01', '2024-12-15'),
(3, 3, 'Sistema ERP', 'Implementación de ERP empresarial', 'En curso', '2025-02-01', '2025-11-30'),
(4, 4, 'App Inventario', 'Control de inventarios', 'Cancelado', '2025-01-15', '2025-05-30'),
(5, 5, 'CRM Empresarial', 'Gestión de clientes y ventas', 'En curso', '2025-03-01', '2025-10-31'),
(6, 6, 'Sistema Académico', 'Administración de alumnos', 'Completado', '2024-03-10', '2024-09-15'),
(7, 7, 'Mesa de Ayuda', 'Sistema de tickets de soporte', 'En curso', '2025-02-20', '2025-08-30'),
(8, 8, 'Control Logístico', 'Seguimiento de entregas', 'En curso', '2025-04-01', '2025-12-01'),
(9, 9, 'E-Commerce', 'Tienda virtual corporativa', 'Completado', '2024-05-01', '2024-11-01'),
(10, 10, 'Gestión Documental', 'Administración de documentos', 'En curso', '2025-01-05', '2025-09-30'),
(11, 8, 'Sistema de Gestión', 'Sistema de Gestión', 'Completado', '2026-06-10', '2026-06-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id_tarea` int(11) NOT NULL,
  `id_proyecto` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `responsable` varchar(255) DEFAULT NULL,
  `fecha_limite` date DEFAULT NULL,
  `estado` enum('Pendiente','En progreso','Finalizado') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id_tarea`, `id_proyecto`, `descripcion`, `responsable`, `fecha_limite`, `estado`) VALUES
(1, 1, 'Diseño de base de datos', 'Carlos Ramos', '2025-02-15', 'Finalizado'),
(2, 1, 'Desarrollo módulo clientes', 'Ana Torres', '2025-03-10', 'En progreso'),
(3, 2, 'Diseño interfaz web', 'Luis Mendoza', '2024-09-01', 'Finalizado'),
(4, 3, 'Implementación autenticación', 'María Flores', '2025-04-20', 'En progreso'),
(5, 4, 'Análisis de requerimientos', 'José Pérez', '2025-02-10', 'Finalizado'),
(6, 5, 'Desarrollo CRUD clientes', 'Lucía Castro', '2025-05-15', 'Pendiente'),
(7, 6, 'Pruebas funcionales', 'Pedro Silva', '2024-08-20', 'Finalizado'),
(8, 7, 'Implementación reportes PDF', 'Miguel Ruiz', '2025-06-30', 'Pendiente'),
(9, 8, 'Módulo seguimiento proyectos', 'Andrea León', '2025-07-15', 'En progreso'),
(10, 10, 'Configuración de seguridad', 'Diego Vargas', '2025-05-25', 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `contraseña` varchar(255) DEFAULT NULL,
  `rol` enum('Admin','Gerente','Desarrollador') DEFAULT NULL,
  `estado` enum('activo','inactivo','','') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `correo`, `contraseña`, `rol`, `estado`) VALUES
(1, 'Administrador General', 'admin@empresa.com', '$2y$10$x.5YB62MZvBSlUqRy7JdruJAuh1ZmfhCbeEyBBMSey5Xho3V7U.Wi', 'Admin', 'activo'),
(2, 'Gerente Comercial', 'gerente1@empresa.com', '$2y$10$mAINuVsYsRkSAlcTEn68ZuAvhvWxgJ7zAov7IdcpmsFKOwGDlB8KK', 'Gerente', 'activo'),
(3, 'Gerente Operaciones', 'gerente2@empresa.com', '$2y$10$zp29FEY7lmJraw/rzNo9G.TXdzHacWt0VETJ.eV60h.4aiwBjqm.G', 'Gerente', 'activo'),
(4, 'Carlos Ramos', 'carlos@empresa.com', '$2y$10$Vi7BWOhmcTm49GWvoVquVeHf/sbkrRBGh8tSqQJE1IuzlWI8GIMWW', 'Desarrollador', 'activo'),
(5, 'Ana Torres', 'ana@empresa.com', '$2y$10$W4..9Ih0y13AUueXySemlu4GR5qrlIMOwPIhOy1rMUl/9BDK26tqW', 'Desarrollador', 'activo'),
(6, 'Luis Mendoza', 'luis@empresa.com', '$2y$10$ibR3xM6JiHQapLt3W5NLzeWMqPLZJQZw.XoWULpvoBxGH6b2vQPNK', 'Desarrollador', 'inactivo'),
(7, 'María Flores', 'maria@empresa.com', '$2y$10$li1jvvFxN2ODyi678M/zIOC0HS3Hcto9Eg8BOtE.KaMh8ITh4dRri', 'Desarrollador', 'inactivo'),
(8, 'José Pérez', 'jose@empresa.com', '$2y$10$oMAUrm5wzSfCk3rcSPIh8.MSt8OcgQml3HXt5eOeaG9kxHYgsqWj2', 'Desarrollador', 'activo'),
(9, 'Lucía Castro', 'lucia@empresa.com', '$2y$10$Z24dCMzhDuc1q4onZVHVj.JaFthdOCWhrwkWqyaDIq35.rarBswd2', 'Desarrollador', 'activo'),
(10, 'Miguel Ruiz', 'miguel@empresa.com', '$2y$10$Igk12/nPzm3FYpdJT1YjguDbezCsOgwaZ0SZoIE8vEl2GL97FjKAy', 'Desarrollador', 'activo'),
(11, 'Administrador General', 'admin1@empresa.com', '$2y$10$B04mVIOxBMNSSCHhCU2/7uGNiGna/TFwGQVLu8I0784MBAN1hsEkS', 'Admin', 'activo'),
(12, 'Danny', 'danny@email.com', '$2y$10$8hEszLaR4z/o0nq2BsS26ep/B/MaI8crnsvKg8IfEYqHXPQ6WaA.a', 'Admin', 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id_proyecto`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id_tarea`),
  ADD KEY `id_proyecto` (`id_proyecto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id_tarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD CONSTRAINT `proyectos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id_proyecto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
