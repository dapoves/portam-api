# Portam-API

Portam-API es una API desarrollada con Laravel que ofrece funcionalidades para una aplicación web de repartos locales. Esta API proporciona una interfaz robusta para gestionar los diferentes aspectos relacionados con los repartos, facilitando la integración con la aplicación web y permitiendo una experiencia fluida para los usuarios finales.

## Características

- **Gestión de Repartidores:** Administra la información de los repartidores, incluyendo su perfil, estado y disponibilidad.
- **Seguimiento de Pedidos:** Permite el seguimiento en tiempo real de los pedidos en curso, ofreciendo información detallada sobre su estado y ubicación.
- **Gestión de Órdenes:** Facilita la gestión de órdenes de entrega, desde la creación hasta la finalización, permitiendo realizar acciones como asignar repartidores y actualizar el estado del pedido.
- **Autenticación y Autorización:** Ofrece un sistema robusto de autenticación y autorización para garantizar la seguridad de la API y proteger los datos sensibles.

## Instalación

1. Clona el repositorio desde GitHub:

```bash
git clone https://github.com/tu_usuario/portam-api.git
```

2. Instala las dependencias del proyecto utilizando Composer:

```bash
cd portam-api
composer install
```

3. Copia el archivo de configuración `.env.example` y configura las variables de entorno:

```bash
cp .env.example .env
```

4. Genera una nueva clave de aplicación:

```bash
php artisan key:generate
```

5. Configura tu base de datos en el archivo `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base_de_datos
DB_USERNAME=tu_usuario_de_base_de_datos
DB_PASSWORD=tu_contraseña_de_base_de_datos
```

6. Ejecuta las migraciones para crear las tablas de la base de datos:

```bash
php artisan migrate
```

7. ¡Listo para empezar! Puedes iniciar el servidor de desarrollo con el siguiente comando:

```bash
php artisan serve
```

## Recursos para la creación de la API

Para la creación de esta api se ha utilizado principalmente la documentación de laravel 

## Licencia

Este proyecto está bajo la licencia MIT. Consulta el archivo [LICENSE](LICENSE) para más detalles.

---

¡Gracias por utilizar Portam-API! Esperamos que esta API sea útil para tu aplicación de repartos locales. Si tienes alguna pregunta o problema, no dudes en ponerte en contacto con nosotros.
