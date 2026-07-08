<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Style\Table;

class GenerateDocs extends Command
{
    protected $signature = 'doc:generate';
    protected $description = 'Genera la documentación técnica del sistema';

    public function handle()
    {
        $this->info('Generando documentación...');

        $phpWord = new PhpWord();

        $section = $phpWord->addSection([
            'marginTop' => 1440,
            'marginLeft' => 1440,
            'marginRight' => 1440,
            'marginBottom' => 1440,
        ]);

        $phpWord->addTitleStyle(1, ['size' => 24, 'bold' => true, 'color' => '1e3a5f'], ['spaceAfter' => 200]);
        $phpWord->addTitleStyle(2, ['size' => 18, 'bold' => true, 'color' => '2563eb'], ['spaceAfter' => 150]);
        $phpWord->addTitleStyle(3, ['size' => 14, 'bold' => true, 'color' => '374151'], ['spaceAfter' => 100]);
        $phpWord->addParagraphStyle('pNormal', ['spaceAfter' => 100, 'spaceBefore' => 50]);

        $section->addTitle('Sistema de Gestión de Dispositivos', 1);
        $section->addText('Documentación Técnica - Versión 1.0', ['size' => 12, 'italic' => true, 'color' => '6b7280'], 'pNormal');
        $section->addTextBreak(1);

        // 1. Introducción
        $section->addTitle('1. Introducción', 2);
        $section->addText(
            'El Sistema de Gestión de Dispositivos es una aplicación web diseñada para administrar el inventario de dispositivos móviles de una organización y controlar su asignación a los empleados. Proporciona un registro histórico completo de todas las asignaciones, permitiendo tanto la gestión administrativa como la consulta individual por parte de los usuarios.',
            ['size' => 11],
            'pNormal'
        );
        $section->addTextBreak(1);

        // 2. Arquitectura
        $section->addTitle('2. Arquitectura del Sistema', 2);
        $section->addText('El sistema sigue la arquitectura MVC (Modelo-Vista-Controlador) implementada por Laravel, con componentes Livewire para la interactividad del lado del servidor.', ['size' => 11], 'pNormal');
        $section->addTextBreak(1);

        $section->addTitle('Tecnologías Utilizadas', 3);
        $tableStyle = new Table();
        $tableStyle->setBorderSize(1);
        $tableStyle->setBorderColor('d1d5db');
        $tableStyle->setCellMargin(80);
        $phpWord->addTableStyle('techTable', $tableStyle);

        $techTable = $section->addTable('techTable');
        $techTable->addRow();
        $techTable->addCell(3000)->addText('Tecnología', ['bold' => true, 'size' => 10]);
        $techTable->addCell(5000)->addText('Versión', ['bold' => true, 'size' => 10]);
        $techTable->addRow();
        $techTable->addCell(3000)->addText('PHP', ['size' => 10]);
        $techTable->addCell(5000)->addText('^8.2', ['size' => 10]);
        $techTable->addRow();
        $techTable->addCell(3000)->addText('Laravel', ['size' => 10]);
        $techTable->addCell(5000)->addText('^12.0', ['size' => 10]);
        $techTable->addRow();
        $techTable->addCell(3000)->addText('Livewire', ['size' => 10]);
        $techTable->addCell(5000)->addText('^3.6', ['size' => 10]);
        $techTable->addRow();
        $techTable->addCell(3000)->addText('Tailwind CSS', ['size' => 10]);
        $techTable->addCell(5000)->addText('^3.x', ['size' => 10]);
        $techTable->addRow();
        $techTable->addCell(3000)->addText('Alpine.js', ['size' => 10]);
        $techTable->addCell(5000)->addText('^3.x', ['size' => 10]);
        $techTable->addRow();
        $techTable->addCell(3000)->addText('Chart.js', ['size' => 10]);
        $techTable->addCell(5000)->addText('^4.5', ['size' => 10]);
        $techTable->addRow();
        $techTable->addCell(3000)->addText('MySQL', ['size' => 10]);
        $techTable->addCell(5000)->addText('8+', ['size' => 10]);
        $techTable->addRow();
        $techTable->addCell(3000)->addText('Laravel Sanctum', ['size' => 10]);
        $techTable->addCell(5000)->addText('^4.3', ['size' => 10]);
        $techTable->addRow();
        $techTable->addCell(3000)->addText('Vite', ['size' => 10]);
        $techTable->addCell(5000)->addText('^7.0', ['size' => 10]);
        $section->addTextBreak(1);

        $section->addTitle('Estructura de Directorios', 3);
        $phpWord->addTableStyle('dirTable', $tableStyle);
        $dirTable = $section->addTable('dirTable');
        $dirTable->addRow();
        $dirTable->addCell(3000)->addText('Directorio', ['bold' => true, 'size' => 10]);
        $dirTable->addCell(5000)->addText('Propósito', ['bold' => true, 'size' => 10]);
        $dirs = [
            ['app/Livewire', 'Componentes Livewire con la lógica de cada vista'],
            ['app/Models', 'Modelos Eloquent con relaciones y scopes'],
            ['app/Http/Controllers/Api', 'Controladores de la API REST'],
            ['app/Http/Resources', 'Recursos JSON para la API'],
            ['app/Http/Middleware', 'Middleware de autenticación y roles'],
            ['database/migrations', 'Migraciones del esquema de base de datos'],
            ['database/seeders', 'Seeders con datos de prueba'],
            ['database/factories', 'Factories para generación de datos'],
            ['resources/views/livewire', 'Vistas Blade de los componentes Livewire'],
            ['routes', 'Definición de rutas web y API'],
            ['tests', 'Tests unitarios y de feature'],
        ];
        foreach ($dirs as $d) {
            $dirTable->addRow();
            $dirTable->addCell(3000)->addText($d[0], ['size' => 10]);
            $dirTable->addCell(5000)->addText($d[1], ['size' => 10]);
        }
        $section->addTextBreak(1);

        // 3. Modelo de Datos
        $section->addTitle('3. Modelo de Datos', 2);
        $section->addText('El sistema cuenta con 5 tablas principales que se relacionan entre sí:', ['size' => 11], 'pNormal');
        $section->addTextBreak(1);

        $section->addTitle('Diagrama de Relaciones', 3);
        $section->addText(
            'departamentos ──< empleados ──< asignaciones >── dispositivos',
            ['monospace' => true, 'size' => 10],
            'pNormal'
        );
        $section->addTextBreak(1);

        $section->addTitle('Descripción de Tablas', 3);

        $sections = [
            [
                'title' => 'users',
                'desc' => 'Almacena los usuarios del sistema con credenciales de acceso.',
                'cols' => [
                    ['id', 'BIGINT', 'Clave primaria'],
                    ['empleado_id', 'BIGINT (nullable)', 'FK a empleados, vincula usuario con empleado'],
                    ['name', 'VARCHAR(255)', 'Nombre del usuario'],
                    ['email', 'VARCHAR(255)', 'Email único para login'],
                    ['password', 'VARCHAR(255)', 'Contraseña hasheada'],
                    ['rol', 'ENUM', 'admin | usuario'],
                    ['remember_token', 'VARCHAR(100)', 'Token de sesión'],
                ],
            ],
            [
                'title' => 'empleados',
                'desc' => 'Registro de empleados de la organización.',
                'cols' => [
                    ['id', 'BIGINT', 'Clave primaria'],
                    ['departamento_id', 'BIGINT (nullable)', 'FK a departamentos'],
                    ['primer_nombre', 'VARCHAR(255)', 'Nombre del empleado'],
                    ['apellido', 'VARCHAR(255)', 'Apellido del empleado'],
                    ['email', 'VARCHAR(255)', 'Email corporativo (único)'],
                    ['telefono', 'VARCHAR(255) (nullable)', 'Teléfono de contacto'],
                    ['identificacion', 'VARCHAR(255)', 'Número de identificación (único)'],
                ],
            ],
            [
                'title' => 'departamentos',
                'desc' => 'Departamentos de la organización.',
                'cols' => [
                    ['id', 'BIGINT', 'Clave primaria'],
                    ['nombre', 'VARCHAR(255)', 'Nombre del departamento'],
                    ['descripcion', 'TEXT (nullable)', 'Descripción del departamento'],
                ],
            ],
            [
                'title' => 'dispositivos',
                'desc' => 'Inventario de dispositivos móviles. Usa soft deletes.',
                'cols' => [
                    ['id', 'BIGINT', 'Clave primaria'],
                    ['marca', 'VARCHAR(255)', 'Marca del dispositivo'],
                    ['modelo', 'VARCHAR(255)', 'Modelo del dispositivo'],
                    ['numero_serie', 'VARCHAR(255)', 'Número de serie (único)'],
                    ['imei', 'VARCHAR(255) (nullable)', 'IMEI del dispositivo (único)'],
                    ['estado', 'ENUM', 'disponible | asignado | mantenimiento | baja | bloqueado'],
                    ['fecha_compra', 'DATE (nullable)', 'Fecha de compra'],
                    ['deleted_at', 'TIMESTAMP (nullable)', 'Soft delete'],
                ],
            ],
            [
                'title' => 'asignaciones',
                'desc' => 'Registro de asignaciones y devoluciones de dispositivos.',
                'cols' => [
                    ['id', 'BIGINT', 'Clave primaria'],
                    ['dispositivo_id', 'BIGINT', 'FK a dispositivos'],
                    ['empleado_id', 'BIGINT', 'FK a empleados'],
                    ['fecha_asignacion', 'TIMESTAMP', 'Fecha de la asignación'],
                    ['fecha_devolucion', 'TIMESTAMP (nullable)', 'Fecha de devolución'],
                    ['fecha_bloqueo', 'TIMESTAMP (nullable)', 'Fecha de bloqueo del dispositivo'],
                    ['estado', 'ENUM', 'activo | devuelto | pendiente_devolver'],
                    ['observaciones', 'TEXT (nullable)', 'Notas sobre la asignación'],
                ],
            ],
        ];

        foreach ($sections as $sec) {
            $section->addTitle($sec['title'], 3);
            $section->addText($sec['desc'], ['size' => 11], 'pNormal');
            $colTable = $section->addTable('techTable');
            $colTable->addRow();
            $colTable->addCell(3000)->addText('Columna', ['bold' => true, 'size' => 10]);
            $colTable->addCell(2500)->addText('Tipo', ['bold' => true, 'size' => 10]);
            $colTable->addCell(4500)->addText('Descripción', ['bold' => true, 'size' => 10]);
            foreach ($sec['cols'] as $col) {
                $colTable->addRow();
                $colTable->addCell(3000)->addText($col[0], ['size' => 10]);
                $colTable->addCell(2500)->addText($col[1], ['size' => 10]);
                $colTable->addCell(4500)->addText($col[2], ['size' => 10]);
            }
            $section->addTextBreak(1);
        }

        // 4. Funcionalidades
        $section->addTitle('4. Funcionalidades del Sistema', 2);

        $features = [
            'Gestión de Empleados' => [
                'CRUD completo con formularios validados.',
                'Búsqueda por nombre, apellido e identificación.',
                'Vinculación a departamento.',
                'Visualización de historial de asignaciones del empleado.',
                'Protección contra eliminación si tiene asignaciones activas.',
            ],
            'Gestión de Dispositivos' => [
                'CRUD completo con marca, modelo, serie, IMEI, estado y fecha de compra.',
                'Número de serie e IMEI únicos.',
                'Estados: disponible, asignado, mantenimiento, baja, bloqueado.',
                'Eliminación lógica (soft deletes).',
                'Visualización de historial de asignaciones del dispositivo.',
                'Protección contra eliminación si tiene asignaciones activas.',
            ],
            'Gestión de Departamentos' => [
                'CRUD completo con nombre y descripción.',
                'Protección contra eliminación si tiene empleados asociados.',
            ],
            'Sistema de Asignaciones' => [
                'Asignar dispositivos disponibles a empleados.',
                'Selectores searchables con Alpine.js.',
                'Tres estados: activo, pendiente_devolver, devuelto.',
                'Validación: empleado no puede tener dos activos; IMEI único.',
                'Devolución y bloqueo de dispositivos desde el listado.',
                'Fecha de bloqueo para dispositivos bloqueados.',
            ],
            'Dashboard' => [
                'Admin: tarjetas con totales, accesos rápidos, gráfico de asignaciones por mes (Chart.js), últimas 5 asignaciones.',
                'Usuario regular: vista de su dispositivo activo con detalles.',
                'Mensaje informativo si no hay empleado vinculado o dispositivo asignado.',
            ],
            'Mi Dispositivo' => [
                'Vista del usuario regular con su dispositivo actual.',
                'Historial completo de asignaciones propias.',
                'Solo accesible para usuarios con empleado vinculado.',
            ],
            'Roles y Permisos' => [
                'Dos roles: admin (control total) y usuario (solo su información).',
                'Middleware CheckRole que protege rutas CRUD.',
                'Navegación condicional según el rol.',
                'Registro de usuarios solo por admin.',
            ],
            'Gestión de Usuarios' => [
                'Listado de usuarios del sistema.',
                'Cambio de rol en línea.',
                'Visualización del empleado vinculado.',
                'Enlace directo al historial de asignaciones del empleado.',
            ],
            'API REST' => [
                'Endpoints para empleados, dispositivos y asignaciones.',
                'Autenticación con tokens Sanctum.',
                'Paginación y datos relacionados.',
                'Respuestas formateadas con API Resources.',
            ],
        ];

        foreach ($features as $name => $items) {
            $section->addTitle($name, 3);
            foreach ($items as $item) {
                $section->addListItem($item, 0, null, 'pNormal');
            }
            $section->addTextBreak(1);
        }

        // 5. Instalación
        $section->addTitle('5. Guía de Instalación', 2);

        $section->addTitle('Requisitos Previos', 3);
        $requirements = [
            'PHP >= 8.2 con extensiones: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML, pdo_mysql',
            'Composer 2.x',
            'Node.js 18+ y npm',
            'MySQL 8.0+',
            'Git',
        ];
        foreach ($requirements as $req) {
            $section->addListItem($req, 0, null, 'pNormal');
        }
        $section->addTextBreak(1);

        $section->addTitle('Pasos de Instalación', 3);
        $steps = [
            'git clone https://github.com/serg2336/gestion-telefonos.git',
            'cd gestion-telefonos',
            'composer install',
            'copy .env.example .env',
            'php artisan key:generate',
            'Configurar DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD en .env',
            'npm install && npm run build',
            'php artisan migrate:fresh --seed',
            'php artisan serve',
        ];
        foreach ($steps as $i => $step) {
            $section->addText(($i + 1) . '. ' . $step, ['size' => 11, 'monospace' => true], 'pNormal');
        }
        $section->addTextBreak(1);

        $section->addTitle('Usuarios Predefinidos', 3);
        $phpWord->addTableStyle('usersTable', $tableStyle);
        $usersTable = $section->addTable('usersTable');
        $usersTable->addRow();
        $usersTable->addCell(2500)->addText('Usuario', ['bold' => true, 'size' => 10]);
        $usersTable->addCell(3500)->addText('Email', ['bold' => true, 'size' => 10]);
        $usersTable->addCell(2000)->addText('Contraseña', ['bold' => true, 'size' => 10]);
        $usersTable->addCell(1500)->addText('Rol', ['bold' => true, 'size' => 10]);
        $usersTable->addRow();
        $usersTable->addCell(2500)->addText('Administrador', ['size' => 10]);
        $usersTable->addCell(3500)->addText('admin@empresa.com', ['size' => 10]);
        $usersTable->addCell(2000)->addText('password', ['size' => 10]);
        $usersTable->addCell(1500)->addText('admin', ['size' => 10]);
        $usersTable->addRow();
        $usersTable->addCell(2500)->addText('Usuario Demo', ['size' => 10]);
        $usersTable->addCell(3500)->addText('usuario@empresa.com', ['size' => 10]);
        $usersTable->addCell(2000)->addText('password', ['size' => 10]);
        $usersTable->addCell(1500)->addText('usuario', ['size' => 10]);
        $section->addTextBreak(1);

        // 6. Rutas
        $section->addTitle('6. Rutas del Sistema', 2);

        $section->addTitle('Rutas Web', 3);
        $webRoutes = [
            ['/dashboard', 'Dashboard principal', 'Todos'],
            ['/mi-dispositivo', 'Mi dispositivo e historial', 'Todos'],
            ['/usuarios', 'Gestión de usuarios', 'admin'],
            ['/admin/register-user', 'Registrar nuevo usuario', 'admin'],
            ['/empleados', 'Listado de empleados', 'admin'],
            ['/empleados/create', 'Crear empleado', 'admin'],
            ['/empleados/{id}', 'Detalle e historial del empleado', 'admin'],
            ['/empleados/{id}/edit', 'Editar empleado', 'admin'],
            ['/dispositivos', 'Listado de dispositivos', 'admin'],
            ['/dispositivos/create', 'Crear dispositivo', 'admin'],
            ['/dispositivos/{id}', 'Detalle e historial del dispositivo', 'admin'],
            ['/dispositivos/{id}/edit', 'Editar dispositivo', 'admin'],
            ['/asignaciones', 'Listado de asignaciones', 'admin'],
            ['/asignaciones/create', 'Nueva asignación', 'admin'],
            ['/departamentos', 'Listado de departamentos', 'admin'],
            ['/departamentos/create', 'Crear departamento', 'admin'],
            ['/departamentos/{id}/edit', 'Editar departamento', 'admin'],
        ];
        $phpWord->addTableStyle('routesTable', $tableStyle);
        $routesTable = $section->addTable('routesTable');
        $routesTable->addRow();
        $routesTable->addCell(3500)->addText('Ruta', ['bold' => true, 'size' => 10]);
        $routesTable->addCell(4500)->addText('Descripción', ['bold' => true, 'size' => 10]);
        $routesTable->addCell(2000)->addText('Acceso', ['bold' => true, 'size' => 10]);
        foreach ($webRoutes as $r) {
            $routesTable->addRow();
            $routesTable->addCell(3500)->addText($r[0], ['size' => 10]);
            $routesTable->addCell(4500)->addText($r[1], ['size' => 10]);
            $routesTable->addCell(2000)->addText($r[2], ['size' => 10]);
        }
        $section->addTextBreak(1);

        $section->addTitle('API REST', 3);
        $section->addText('Endpoints protegidos con Laravel Sanctum. Requieren token de autenticación en el header Authorization: Bearer {token}.', ['size' => 11], 'pNormal');
        $apiRoutes = [
            ['GET', '/api/empleados', 'Listar empleados (paginado)'],
            ['GET', '/api/empleados/{id}', 'Ver empleado con asignaciones'],
            ['GET', '/api/dispositivos', 'Listar dispositivos (paginado)'],
            ['GET', '/api/dispositivos/{id}', 'Ver dispositivo con historial'],
            ['GET', '/api/asignaciones', 'Listar asignaciones (paginado)'],
            ['GET', '/api/asignaciones/{id}', 'Ver asignación'],
            ['GET', '/api/user', 'Usuario autenticado'],
        ];
        $apiTable = $section->addTable('techTable');
        $apiTable->addRow();
        $apiTable->addCell(1200)->addText('Método', ['bold' => true, 'size' => 10]);
        $apiTable->addCell(3500)->addText('Ruta', ['bold' => true, 'size' => 10]);
        $apiTable->addCell(5300)->addText('Descripción', ['bold' => true, 'size' => 10]);
        foreach ($apiRoutes as $r) {
            $apiTable->addRow();
            $apiTable->addCell(1200)->addText($r[0], ['size' => 10]);
            $apiTable->addCell(3500)->addText($r[1], ['size' => 10]);
            $apiTable->addCell(5300)->addText($r[2], ['size' => 10]);
        }
        $section->addTextBreak(1);

        // 7. Roles
        $section->addTitle('7. Roles y Permisos', 2);
        $section->addText(
            'El sistema implementa un control de acceso basado en roles mediante el middleware CheckRole. Cada usuario tiene un campo "rol" que determina qué funcionalidades puede ver y usar.',
            ['size' => 11],
            'pNormal'
        );
        $section->addTextBreak(1);

        $section->addTitle('Admin', 3);
        $adminPerms = [
            'CRUD completo de Empleados, Dispositivos, Asignaciones y Departamentos.',
            'Gestión de usuarios del sistema (cambio de roles).',
            'Registro de nuevos usuarios.',
            'Dashboard con estadísticas globales y gráficos.',
            'Visualización del historial de cualquier empleado o dispositivo.',
        ];
        foreach ($adminPerms as $p) {
            $section->addListItem($p, 0, null, 'pNormal');
        }
        $section->addTextBreak(1);

        $section->addTitle('Usuario Regular', 3);
        $userPerms = [
            'Dashboard personal con su dispositivo activo.',
            'Sección "Mi Dispositivo" con detalle e historial propio.',
            'Edición de su perfil.',
        ];
        foreach ($userPerms as $p) {
            $section->addListItem($p, 0, null, 'pNormal');
        }
        $section->addTextBreak(1);

        // 8. Pruebas
        $section->addTitle('8. Pruebas', 2);
        $section->addText('El proyecto incluye tests unitarios y de feature usando PHPUnit. Los tests utilizan SQLite en memoria para no afectar la base de datos de desarrollo.', ['size' => 11], 'pNormal');
        $section->addText('', [], 'pNormal');
        $section->addText('composer run test', ['monospace' => true, 'size' => 11], 'pNormal');
        $section->addText('', [], 'pNormal');
        $section->addText('O específicamente:', ['size' => 11], 'pNormal');
        $section->addText('php artisan test', ['monospace' => true, 'size' => 11], 'pNormal');
        $section->addTextBreak(1);

        // Guardar
        $filename = 'Documentacion_Sistema_Gestion_Dispositivos.docx';
        $path = storage_path('app/' . $filename);
        if (!is_dir(storage_path('app'))) {
            mkdir(storage_path('app'), 0755, true);
        }
        if (!is_dir(storage_path('app/tmp'))) {
            mkdir(storage_path('app/tmp'), 0755, true);
        }

        $objWriter = IOFactory::createWriter($phpWord);
        $objWriter->save($path);

        $this->info("Documentación generada: storage/app/{$filename}");
        $this->info("Copiando a la raíz del proyecto...");

        copy($path, getcwd() . '/' . $filename);

        $this->info("Documento copiado a: " . getcwd() . '/' . $filename);

        return Command::SUCCESS;
    }
}
