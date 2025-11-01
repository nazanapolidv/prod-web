<h1 align="center">Hospital Polaco – Trabajo Práctico (Laravel + MySQL)</h1>

Proyecto web para la gestión básica de un hospital con registro e inicio de sesión de usuarios, sección "Mi Salud", y formulario de contacto que guarda en base de datos. Desarrollado con Laravel 12, PHP 8.2, MySQL (XAMPP), Vite y TailwindCSS.

## ✨ Funcionalidades
- Registro de usuarios.
- Inicio de sesión, cierre de sesión y rutas protegidas con middleware `auth`.
- Página "Mi Salud".
- Formulario de contacto (`/contacto`) que persiste en la tabla `contactos` y muestra mensaje de éxito.
- Estilos y assets gestionados con Vite.

## 🧰 Stack técnico
- Laravel 12 (PHP 8.2)
- MySQL (XAMPP)
- Vite + TailwindCSS
- Blade (vistas)

## 🚀 Puesta en marcha (Windows + XAMPP)
### 1) Prerrequisitos

- XAMPP (MySQL y PHP 8.2+ activos)
- Composer
- Node.js + npm

### 2) Clonar e instalar dependencias
```powershell
git clone <url-del-repo>
cd prod-web
composer install
npm install
```
### 3) Configurar entorno

Editá `.env` y asegurate de estos valores (adaptá usuario/clave si tu MySQL lo requiere):
```env
APP_URL=http://127.0.0.1:8001

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=prod_web
DB_USERNAME=root
DB_PASSWORD=
```
Generá la clave de la app (si no existe):

```powershell
php artisan key:generate
```

### 4) Base de datos
Creá la base si no existe (desde XAMPP phpMyAdmin o MySQL shell) y corré migraciones:

```powershell
php artisan migrate
```

Las tablas relevantes incluyen: `usuarios`, `pacientes`, `medicos`, `especialidads`, `estudios`, `turnos`, `contactos`, entre otras.
### 5) Levantar servidores de desarrollo

En una terminal:
```powershell
php artisan serve
```
En otra terminal:

```powershell
npm run dev
```
Abrí: http://127.0.0.1:8000

## 🧭 Rutas principales
- `GET /` Home
- `GET /register` Registro de usuarios (crea en `usuarios` y loguea; redirige a `/`)
- `GET /login`, `POST /logout` Autenticación
- `GET /mi-salud` (auth) Muestra saludo con el nombre del usuario
- `GET /mi-historial` (auth)
- `GET /contacto`, `POST /contacto` Formulario de contacto (guarda en `contactos`)

## 🔧 Tips y problemas comunes
- CSS/JS no cargan: verificá que `npm run dev` esté corriendo y que las vistas usen `@vite(...)`.
- Error de rutas cacheadas: `php artisan route:clear`.
- Cambios de .env no aplican: `php artisan config:clear`.
- Puerto de Vite ocupado: Vite elegirá otro puerto automáticamente (no afecta a `@vite`).
- Nombre de BD: evitá guiones (usar `prod_web`).