# Portam-API

Portam-API es una API desarrollada con Laravel que ofrece funcionalidades para la aplicación web de repartos locales portam.

# Instalación
## Requisitos
- php
- docker
> **Warning**<br>
Si el sistema operativo es Windows, es necesario utilizar WSL

1. Clona el repositorio desde GitHub:
```bash
git clone https://github.com/dapoves/portam-api.git
```

2. Instala las dependencias del proyecto:
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

> **Note**<br>
Es recomendable añadir el siguiente alias para no tener que poner './vendor/bin/sail' para cada comando
```bash
alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
```
3. Levantar la API
```bash
sail up -d
```

4. Realizar las migraciones de las tablas:

```bash
sail artisan migrate
```


5. Generar datos de prueba (recomendado):
```bash
sail artisan db:seed
```

6. Generar enlace simbolico para las imagenes de storage:
```bash
sail artisan storage:link
```
