# Sistema de Gestión de Proyectos - TecnoSoluciones S.A.

Este proyecto es una aplicación web desarrollada en **Laravel (PHP)** y **MySQL** para la empresa TecnoSoluciones S.A. El objetivo del sistema es optimizar la asignación de tareas, el control de proyectos y la gestión de clientes mediante un entorno web seguro y accesible.

---

## 🚀 Avance Actual (PARTE 1 Completada)

Actualmente, el proyecto cuenta con la arquitectura inicial MVC y las siguientes funcionalidades implementadas:

1. **Autenticación Segura (Login/Logout):**
   - El registro público está deshabilitado por seguridad.
   - Solo se puede acceder usando credenciales existentes en la base de datos.
2. **Dashboard de Bienvenida:**
   - Panel de control básico protegido por sesión.
3. **Gestión de Usuarios (Control de Roles):**
   - Módulo protegido por el middleware `CheckAdmin`.
   - Solo los usuarios con rol de **Admin** pueden ver, crear, editar o eliminar otros usuarios (Gerentes y Desarrolladores).
4. **Conexión a Base de Datos:**
   - Modelos adaptados para usar tablas con nombres personalizados en español (ej. tabla `Usuarios`, campos `id_usuario`, `correo`, `contraseña`).

---

## ⚙️ Instrucciones de Instalación para el Equipo

Para ejecutar este proyecto en tu entorno local (XAMPP/Laragon), sigue estos pasos al pie de la letra:

### 1. Clonar o Descargar el Proyecto
Clona este repositorio o descarga la carpeta del proyecto y colócala dentro de tu carpeta de servidor local (ej. `C:\xampp\htdocs\proyecto-gestion`).

### 2. Configurar la Base de Datos
1. Abre **phpMyAdmin** (o tu gestor de MySQL) y crea una base de datos llamada `gestion_proyecto`.
2. Importa el archivo SQL con las tablas y datos de prueba que hemos creado para el proyecto. (Asegúrate de que existan las tablas `Clientes`, `Proyectos`, `Tareas` y `Usuarios`).

### 3. Instalar Dependencias (Backend y Frontend)
Abre una terminal dentro de la carpeta del proyecto y ejecuta:
```bash
composer install
npm install
npm run build   # (o npm run dev, dependiendo de tu entorno local)
