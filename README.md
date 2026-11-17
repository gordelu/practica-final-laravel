# Proyecta · Plataforma de gestión de proyectos colaborativos

Práctica final del tema 3 (Laravel) de Desarrollo Web en Entorno Servidor.

Los usuarios pueden crear proyectos y añadir a otros usuarios como participantes, con un **rol** y las **horas** que han trabajado en cada proyecto.

## Funcionalidades

- **Autenticación** con Laravel Breeze: registro, login, perfil. Solo los usuarios logueados pueden ver y crear proyectos.
- **CRUD de proyectos**: título, descripción, fecha límite y estado (pendiente, en curso, completado).
- **Autorización**: solo el creador de un proyecto puede editarlo, borrarlo y gestionar su equipo (403 aunque se escriba la URL a mano).
- **Participantes (N:N)**: desde el detalle del proyecto, el creador añade usuarios con su rol y sus horas, los modifica o los quita. La tabla pivote `project_user` guarda `role` y `contribution_hours`.
- **Listado y ficha de usuarios** con los proyectos que han creado y en los que participan.
- **Landing page** para visitantes, panel con resumen y diseño propio con Tailwind CSS. Interfaz en español.

## Base de datos

| Tabla | Contenido |
|---|---|
| `users` | Usuarios (de Breeze) |
| `projects` | Proyectos. `user_id` = creador (relación 1:N con `users`) |
| `project_user` | Participantes (relación N:N), con `role` y `contribution_hours` |

## Puesta en marcha

Requisitos: Docker Desktop (en Windows, con WSL 2 y Ubuntu). Los comandos se ejecutan en la consola de Ubuntu, dentro de la carpeta del proyecto.

1. Si no existe el archivo `.env`, crearlo a partir del ejemplo:

   ```bash
   cp .env.example .env
   ```

2. Si no existe la carpeta `vendor/`, instalar las dependencias de PHP con un contenedor temporal:

   ```bash
   docker run --rm -u "$(id -u):$(id -g)" -v "$(pwd):/var/www/html" -w /var/www/html \
       laravelsail/php84-composer:latest composer install --ignore-platform-reqs
   ```

3. Arrancar los contenedores y preparar la aplicación:

   ```bash
   ./vendor/bin/sail up -d
   ./vendor/bin/sail artisan key:generate      # solo si APP_KEY está vacío en .env
   ./vendor/bin/sail artisan migrate
   ```

4. Si no existe la carpeta `public/build/`, compilar el CSS y el JavaScript:

   ```bash
   ./vendor/bin/sail npm install
   ./vendor/bin/sail npm run build
   ```

5. (Opcional) Cargar datos de prueba:

   ```bash
   ./vendor/bin/sail artisan db:seed
   ```

La aplicación queda en <http://localhost>.

### Usuarios de prueba (después de `db:seed`)

| Email | Contraseña |
|---|---|
| ana@example.com | password |
| luis@example.com | password |
| marta@example.com | password |
| carlos@example.com | password |

## Código propio

| Archivo | Qué hace |
|---|---|
| `database/migrations/*_create_projects_table.php` | Tabla de proyectos |
| `database/migrations/*_create_project_user_table.php` | Tabla pivote de participantes |
| `database/seeders/UserSeeder.php`, `ProjectSeeder.php` | Datos de prueba |
| `app/Models/Project.php`, `app/Models/User.php` | Modelos y relaciones (`owner`, `users`, `ownedProjects`, `projects`) |
| `app/Http/Controllers/ProjectController.php` | CRUD de proyectos |
| `app/Http/Controllers/ProjectUserController.php` | Añadir, modificar y quitar participantes |
| `app/Http/Controllers/UserController.php` | Listado y ficha de usuarios |
| `routes/web.php` | Rutas (todas las de la aplicación dentro del middleware `auth`) |
| `resources/views/projects/`, `resources/views/users/` | Vistas de proyectos y usuarios |
| `resources/views/components/avatar.blade.php`, `status-badge.blade.php` | Componentes propios |
| `resources/views/welcome.blade.php`, `dashboard.blade.php` | Landing page y panel |
| `lang/` | Traducciones al español |

El resto de controladores de autenticación, sus rutas (`routes/auth.php`) y sus vistas son de Laravel Breeze. En ellas solo se ha cambiado el aspecto.
