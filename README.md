# CafeLila CMS

Sitio web comercial + panel administrador (CMS) para CafeLila, marca premium de cafe gourmet en Costa Rica.

## Stack

- Laravel 11 / PHP 8.2+
- Blade + TailwindCSS + AlpineJS
- MySQL
- Laravel Breeze para autenticacion
- Laravel Storage para uploads

## Modulos incluidos

- Sitio publico (landing comercial):
	- Navbar sticky
	- Hero
	- Nosotros (historia, mision, vision, valores)
	- Productos dinamicos
	- Galeria
	- Ubicacion con Google Maps Embed
	- Contacto con envio de correo
	- FAQ acordeon
	- Footer con redes/contacto
	- Boton flotante de WhatsApp

- Panel Admin (`/admin`) protegido con `auth` + middleware `admin`:
	- Dashboard
	- CRUD Productos
	- CRUD FAQ (incluye orden)
	- CRUD Galeria
	- Bandeja de mensajes de contacto
	- Configuracion de sitio (key-value)

## Modelo de datos

- `products`
- `faqs`
- `galleries`
- `site_settings`
- `users.role` para control de acceso admin

## Instalacion

1. Dependencias:

```bash
composer install
npm install
```

2. Variables de entorno:

```bash
cp .env.example .env
php artisan key:generate
```

3. Configurar base de datos MySQL en `.env`.

4. Migrar y poblar:

```bash
php artisan migrate:fresh --seed
php artisan storage:link
```

5. Levantar entorno:

```bash
npm run dev
php artisan serve
```

## Acceso admin inicial

- URL: `http://127.0.0.1:8000/admin`
- Usuario: `admin@cafelila.cr`
- Contrasena: `password`

## Notas tecnicas

- Validaciones y sanitizacion con `FormRequest`.
- Rutas separadas en `routes/front.php` y `routes/admin.php`.
- Compresion basica de imagenes con GD + fallback seguro en `ImageUploadService`.
- SEO base: meta title, description y Open Graph desde `site_settings`.
