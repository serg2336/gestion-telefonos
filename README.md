# Sistema de Gestión de Dispositivos

Sistema web para la administración, control y asignación de dispositivos móviles a empleados de una organización, con roles de usuario y reporting histórico.

## Descripción del Sistema

La aplicación permite gestionar el inventario de dispositivos telefónicos y asignarlos a los empleados, llevando un registro histórico completo de todas las asignaciones. Está construida con **Laravel 12** y **Livewire 3**, con interfaz moderna en **Tailwind CSS** y gráficos con **Chart.js**.

### Funcionalidades Principales

- **Roles de usuario**: Admin (control total) y Usuario (solo su dispositivo).
- **Gestión de Empleados**: CRUD completo con búsqueda por nombre, identificación y departamento.
- **Gestión de Departamentos**: Organización de empleados por departamentos.
- **Gestión de Dispositivos**: CRUD completo con marca, modelo, serie, IMEI, estado y fecha de compra.
- **Sistema de Asignaciones**: Asignar dispositivos a empleados con 3 estados (activo, pendiente_devolver, devuelto). Validaciones que impiden dobles asignaciones, bloqueo por IMEI duplicado, y protección contra eliminación de registros con dependencias.
- **Historial de Asignaciones**: Visualización del historial completo por empleado (admin) y por dispositivo.
- **Mi Dispositivo**: Vista del usuario regular para ver su equipo actual e historial propio.
- **Dashboard dual**: Admin ve estadísticas globales, gráfico de asignaciones por mes y accesos rápidos. Usuario ve su dispositivo actual.
- **Búsqueda avanzada**: Búsqueda por nombre de empleado, marca/modelo de dispositivo e IMEI.
- **API REST**: Endpoints protegidos con tokens Sanctum.
- **Selección searchable**: Selectores con búsqueda en vivo mediante Alpine.js.
- **Confirmación visual**: Modales de confirmación con Alpine.js para acciones destructivas.
- **Validación en español**: Mensajes de error en español con atributos personalizados.

## Tecnologías

| Tecnología | Versión |
|------------|---------|
| PHP | ^8.2 |
| Laravel | ^12.0 |
| Livewire | ^3.6 |
| Tailwind CSS | ^3.x |
| Alpine.js | ^3.x |
| Chart.js | ^4.5 |
| MySQL | 8+ |
| Laravel Sanctum | ^4.3 |
| Vite | ^7.0 |

## Requisitos

- PHP >= 8.2 con extensiones: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML, ctype, json, mbstring, pdo_mysql
- Composer 2.x
- Node.js 18+ y npm
- MySQL 8.0+ (o MariaDB 10.3+)
- Git

## Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/serg2336/gestion-telefonos.git
cd gestion-telefonos
```

### 2. Instalar dependencias de PHP

```bash
composer install
```

### 3. Configurar variables de entorno

```bash
copy .env.example .env
php artisan key:generate
```

Editar el archivo `.env` y configurar la conexión a la base de datos:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion-telefonos
DB_USERNAME=root
DB_PASSWORD=
```

Configurar también el locale:

```ini
APP_LOCALE=es
APP_FALLBACK_LOCALE=es
APP_FAKER_LOCALE=es_MX
```

### 4. Instalar dependencias de Node.js y compilar assets

```bash
npm install
npm run build
```

### 5. Ejecutar migraciones y seeders

```bash
php artisan migrate:fresh --seed
```

### 6. Iniciar el servidor de desarrollo

```bash
php artisan serve
```

La aplicación estará disponible en `http://localhost:8000`.

### 7. (Opcional) Iniciar entorno completo de desarrollo

```bash
npm run dev    # Vite para recarga en caliente
```

O usar el comando integrado que levanta servidor, queue, logs y Vite:

```bash
composer run dev
```

## Usuarios Predefinidos (Seeders)

| Usuario | Email | Contraseña | Rol |
|---------|-------|------------|-----|
| Administrador | `admin@empresa.com` | `password` | admin |
| Usuario demo | `usuario@empresa.com` | `password` | usuario |
| Usuarios adicionales | `user.{id}@empresa.com` | `password` | usuario |

El usuario demo (`usuario@empresa.com`) está vinculado a un empleado que tiene un dispositivo activo y un historial de devolución previa para demostración.

## Estructura de la Base de Datos

### Tablas Principales

| Tabla | Descripción |
|-------|-------------|
| `users` | Usuarios del sistema con rol (admin/usuario) y empleado_id opcional |
| `empleados` | Empleados de la organización |
| `departamentos` | Departamentos de la organización |
| `dispositivos` | Dispositivos telefónicos (con soft deletes) |
| `asignaciones` | Registro de asignaciones de dispositivos a empleados |

### Diagrama de Relaciones

```
departamentos ──< empleados ──< asignaciones >── dispositivos
                    ↑          (historial)          │
                    │                               │
                    └── users ──────────────────────┘
                         (vinculación usuario-empleado)
```

- Un **Departamento** tiene muchos **Empleados**
- Un **Empleado** tiene muchas **Asignaciones**
- Un **Dispositivo** tiene muchas **Asignaciones** (historial)
- Una **Asignación** pertenece a un Empleado y a un Dispositivo
- Un **User** puede tener un Empleado vinculado (relación opcional)
- Los **Dispositivos** usan eliminación lógica (soft deletes)

### Campos Clave

**dispositivos**: `marca`, `modelo`, `numero_serie` (único), `imei` (único, nullable), `estado` (disponible, asignado, mantenimiento, baja, bloqueado), `fecha_compra`

**asignaciones**: `dispositivo_id`, `empleado_id`, `fecha_asignacion`, `fecha_devolucion` (nullable), `fecha_bloqueo` (nullable), `estado` (activo, devuelto, pendiente_devolver), `observaciones`

**empleados**: `primer_nombre`, `apellido`, `email` (único), `telefono`, `identificacion` (único), `departamento_id`

## Roles y Permisos

El sistema cuenta con dos roles gestionados por el middleware `CheckRole`:

| Rol | Acceso |
|-----|--------|
| **admin** | CRUD completo de Empleados, Dispositivos, Asignaciones, Departamentos; Gestión de Usuarios; Dashboard con estadísticas globales; Registro de nuevos usuarios |
| **usuario** | Dashboard personal con su dispositivo actual; Mi Dispositivo (detalle + historial propio); Edición de perfil |

Los usuarios sin empleado vinculado ven un mensaje informativo en el dashboard.

## Rutas del Sistema

### Web (autenticadas)

| Ruta | Descripción | Acceso |
|------|-------------|--------|
| `/dashboard` | Dashboard con estadísticas | Todos |
| `/mi-dispositivo` | Mi dispositivo e historial | Todos (rol usuario) |
| `/usuarios` | Gestión de usuarios del sistema | admin |
| `/admin/register-user` | Registrar nuevo usuario | admin |
| `/empleados` | Listado de empleados | admin |
| `/empleados/create` | Crear empleado | admin |
| `/empleados/{id}/edit` | Editar empleado | admin |
| `/empleados/{id}` | Ver detalle e historial del empleado | admin |
| `/dispositivos` | Listado de dispositivos | admin |
| `/dispositivos/create` | Crear dispositivo | admin |
| `/dispositivos/{id}/edit` | Editar dispositivo | admin |
| `/dispositivos/{id}` | Ver detalle e historial del dispositivo | admin |
| `/asignaciones` | Listado de asignaciones | admin |
| `/asignaciones/create` | Nueva asignación | admin |
| `/departamentos` | Listado de departamentos | admin |
| `/departamentos/create` | Crear departamento | admin |
| `/departamentos/{id}/edit` | Editar departamento | admin |

### API (protegidas con Sanctum)

| Método | Ruta | Descripción |
|--------|------|-------------|
| GET | `/api/empleados` | Listar empleados (paginado) |
| GET | `/api/empleados/{id}` | Ver empleado con asignaciones |
| GET | `/api/dispositivos` | Listar dispositivos (paginado) |
| GET | `/api/dispositivos/{id}` | Ver dispositivo con historial |
| GET | `/api/asignaciones` | Listar asignaciones (paginado) |
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

## Estados del Sistema

### Estados de Asignación

| Estado | Descripción |
|--------|-------------|
| `activo` | El empleado tiene el dispositivo en uso actualmente |
| `pendiente_devolver` | El dispositivo está marcado para devolución (ej. reportó falla) |
| `devuelto` | El dispositivo fue devuelto correctamente |

### Estados de Dispositivo

| Estado | Descripción |
|--------|-------------|
| `disponible` | Listo para asignar a un empleado |
| `asignado` | En posesión de un empleado |
| `mantenimiento` | En reparación o mantenimiento |
| `baja` | Dado de baja permanentemente |
| `bloqueado` | Bloqueado por IMEI reportado o medida administrativa |

## Pruebas

```bash
composer run test
```

O específicamente:

```bash
php artisan test
```

Los tests usan SQLite en memoria para no afectar la base de datos de desarrollo.

## Comandos Útiles

```bash
# Resetear base de datos con datos de prueba
php artisan migrate:fresh --seed

# Generar documentación técnica (Word)
php artisan doc:generate

# Entorno de desarrollo completo
composer run dev
```
