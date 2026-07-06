# Gestión de Teléfonos

Sistema web para la administración y control de asignación de dispositivos móviles a empleados de una organización.

## Descripción del Sistema

La aplicación permite gestionar el inventario de dispositivos telefónicos y asignarlos a los empleados, llevando un registro histórico de todas las asignaciones. Está construida con **Laravel 12** y **Livewire 3**, con una interfaz moderna usando **Tailwind CSS**.

### Funcionalidades Principales

- **Gestión de Empleados**: CRUD completo con búsqueda y paginación.
- **Gestión de Departamentos**: Organización de empleados por departamentos.
- **Gestión de Dispositivos**: CRUD completo con campos como marca, modelo, número de serie, IMEI, estado y fecha de compra.
- **Sistema de Asignaciones**: Asignar dispositivos a empleados y registrar devoluciones, con validación para evitar dobles asignaciones.
- **Historial de Asignaciones**: Visualización del historial completo por empleado y por dispositivo.
- **Dashboard**: Estadísticas resumidas (total de empleados, dispositivos, asignaciones activas).
- **Autenticación**: Sistema de login con Laravel Breeze y roles (admin/usuario).
- **API REST**: Endpoints protegidos con tokens Sanctum para consultar datos.

## Tecnologías

| Tecnología | Versión |
|------------|---------|
| PHP | ^8.2 |
| Laravel | ^12.0 |
| Livewire | ^3.6 |
| Tailwind CSS | ^3.x |
| MySQL | - |
| Laravel Sanctum | ^4.3 |

## Requisitos

- PHP >= 8.2
- Composer
- Node.js y npm
- MySQL

## Instalación

1. **Clonar el repositorio**

```bash
git clone https://github.com/serg2336/gestion-telefonos.git
cd gestion-telefonos
```

2. **Instalar dependencias de PHP**

```bash
composer install
```

3. **Configurar variables de entorno**

```bash
cp .env.example .env
php artisan key:generate
```

Editar el archivo `.env` y configurar la conexión a la base de datos:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion-telefonos
DB_USERNAME=root
DB_PASSWORD=
```

4. **Instalar dependencias de Node.js y compilar assets**

```bash
npm install
npm run build
```

5. **Ejecutar migraciones**

```bash
php artisan migrate
```

6. **Iniciar el servidor**

```bash
php artisan serve
```

La aplicación estará disponible en `http://localhost:8000`.

## Estructura de la Base de Datos

### Tablas Principales

| Tabla | Descripción |
|-------|-------------|
| `users` | Usuarios del sistema (admin/usuario) |
| `empleados` | Empleados de la organización |
| `departamentos` | Departamentos de la organización |
| `dispositivos` | Dispositivos telefónicos (con soft deletes) |
| `asignaciones` | Registro de asignaciones de dispositivos a empleados |

### Diagrama de Relaciones

```
departamentos ──< empleados ──< asignaciones >── dispositivos
                    ↑                               │
                    └────── historial ──────────────┘
```

- Un **Departamento** tiene muchos **Empleados**
- Un **Empleado** tiene muchas **Asignaciones**
- Un **Dispositivo** tiene muchas **Asignaciones** (historial)
- Una **Asignación** pertenece a un Empleado y a un Dispositivo
- Los **Dispositivos** usan eliminación lógica (soft deletes)

### Campos Clave

**dispositivos**: `marca`, `modelo`, `numero_serie` (único), `imei` (único), `estado` (disponible, asignado, mantenimiento, baja), `fecha_compra`

**asignaciones**: `dispositivo_id`, `empleado_id`, `fecha_asignacion`, `fecha_devolucion`, `estado` (activo, devuelto)

## Rutas del Sistema

### Web (autenticadas)

| Ruta | Descripción |
|------|-------------|
| `/dashboard` | Dashboard con estadísticas |
| `/empleados` | Listado de empleados |
| `/empleados/create` | Crear empleado |
| `/empleados/{id}/edit` | Editar empleado |
| `/empleados/{id}` | Ver detalle e historial del empleado |
| `/dispositivos` | Listado de dispositivos |
| `/dispositivos/create` | Crear dispositivo |
| `/dispositivos/{id}/edit` | Editar dispositivo |
| `/dispositivos/{id}` | Ver detalle e historial del dispositivo |
| `/asignaciones` | Listado de asignaciones |
| `/asignaciones/create` | Nueva asignación |

### API (protegidas con Sanctum)

| Método | Ruta | Descripción |
|--------|------|-------------|
| GET | `/api/empleados` | Listar empleados |
| GET | `/api/empleados/{id}` | Ver empleado |
| GET | `/api/dispositivos` | Listar dispositivos |
| GET | `/api/dispositivos/{id}` | Ver dispositivo |
| GET | `/api/asignaciones` | Listar asignaciones |
| GET | `/api/asignaciones/{id}` | Ver asignación |
| GET | `/api/user` | Usuario autenticado |

Para usar la API, generar un token desde Tinker:

```bash
php artisan tinker
>>> $user = App\Models\User::first();
>>> $token = $user->createToken('api-token')->plainTextToken;
>>> echo $token;
```

Luego usar el token en el header:

```
Authorization: Bearer {token}
```
