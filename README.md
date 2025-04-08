# RentMedia – Mini E-commerce de Medios Digitales

Plataforma full-stack desarrollada con **Laravel 10** y **Vue 3 + Vite + Tailwind**, que permite la reserva de espacios publicitarios digitales como espectaculares o medios similares.

## Funcionalidades

-   Búsqueda de medios disponibles filtrados por ubicación y fechas.
-   Visualización de detalles: imagen, tipo, ubicación y precio por día.
-   Reserva de medios a través de un calendario interactivo.
-   Simulación de pago.
-   Historial de reservas por usuario.
-   Panel de administrador: CRUD de medios, visualización de reservas y control de disponibilidad.

---

## Tecnologías

### Backend

-   Laravel 10
-   Laravel Sanctum (autenticación)
-   Laravel Queue / Jobs
-   Eloquent Models: `User`, `Media`, `Reservation`, `Period`
-   Controladores: `MediaController`, `ReservationController`, `ProfileController`
-   Web routes (`web.php`) y API estructurada
-   PHP >= 8.1
-   Composer

### Frontend

-   Vue 3 con Vite
-   Tailwind CSS
-   `@vuepic/vue-datepicker` para calendario
-   SPA protegida con middleware y rutas por roles

---

## Instrucciones para correr el proyecto

### Clonación y configuración

```bash
git clone https://github.com/GabrielaGA9/RentMedia.git
cd RentMedia
cp .env.example .env
```

### Backend (Laravel)

```bash
composer install
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan queue:work
php artisan serve
```

### Frontend (Vue 3)

```bash
cd frontend
npm install
npm run dev
```

---

## Base de Datos

-   El sistema no tiene agregados datos, para su prueba, se recomienda crear dos usuarios (admin/cliente), asi como agregar medios adicionales.

---

## Roles y autenticación

-   **Admin**: Puede acceder al panel de administración, gestionar medios y visualizar reservas.
-   **Cliente**: Puede buscar medios, reservar y ver su historial.
-   Sistema de login basado en Laravel Sanctum.
-   Middleware por rol.

---

## Decisiones técnicas

-   **Disponibilidad dinámica**: Se usa el modelo `Period` junto con validaciones en `ReservationController` para evitar problemas de fechas.
-   **Calculo del total**: Se multiplica el número de días por el precio por día configurado en el modelo `Media`.
-   **Jobs asincrónicos**: Se usa un `Job` para simular el procesamiento de pago con delay, el pago solo es visual, ya que por tiempo no se pudo agregar un proceso mas complejo.
-   **Carga de imágenes**: Implementado mediante `storage` con enlaces simbólicos para servirlas en frontend.
-   **Componentización Vue**: Separación clara de vistas por roles; se implementan composables para reutilización de lógica en frontend.

---

## Extras implementados

-   Subida y visualización de imágenes.
-   Validaciones dinámicas tanto en backend como en frontend.
-   Calendario interactivo para reservar fechas disponibles.
-   CRUD completo de medios en panel Admin.
-   Historial por usuario autenticado.

## Autor

Desarrollado por Gabriela Gallardo.
