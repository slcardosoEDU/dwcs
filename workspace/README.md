# Entorno de desarrollo

Entorno Docker para las prácticas de **Desarrollo Web en Entorno Servidor** (PHP 8.4 + Apache, MariaDB y phpMyAdmin). El código PHP se edita en el host y se sirve dentro del contenedor.

## Estructura

```text
workspace/
├── docker-compose.yml      # Orquestación de los servicios
├── .env                    # Variables de MariaDB y puerto de phpMyAdmin
├── .vscode/
│   └── launch.json         # Depuración con Xdebug (puerto 9003)
├── docker/
│   ├── Dockerfile          # Imagen PHP 8.4 + Apache + Xdebug + Composer
│   ├── apache/vhost.conf   # VirtualHost (DocumentRoot /var/www/html)
│   └── php/conf.d/
│       └── xdebug.ini      # Xdebug en modo debug hacia el host
└── src/                    # Código de la aplicación (montar en el contenedor)
    └── index.php
```

| Servicio     | Contenedor     | Función                                      | Acceso                         |
|--------------|----------------|----------------------------------------------|--------------------------------|
| `web`        | `php-apache`   | Apache + PHP 8.4, Xdebug y Composer          | http://localhost               |
| `db`         | `db`           | MariaDB 11.8 (volumen persistente)           | puerto interno 3306            |
| `phpmyadmin` | `phpmyadmin`   | Administración web de la base de datos       | http://localhost:8000          |

El directorio [src](src) se monta en `/var/www/html`. Cualquier cambio en los ficheros se refleja al recargar el navegador, sin reconstruir la imagen.

La imagen instala `pdo_mysql` y `mysqli`, habilita `mod_rewrite` y copia Composer 2. Xdebug se conecta al host mediante `host.docker.internal:9003`.

Credenciales y nombre de la base de datos están en [.env](.env). El puerto de phpMyAdmin es `PMA_PORT` (por defecto `8000`).

## Requisitos

- [Docker y docker-compose](https://www.docker.com/products/docker-desktop/)
- [Visual Studio Code](https://code.visualstudio.com/)
- Extensión **PHP Debug** (`xdebug.php-debug`)

Abre la carpeta `workspace` como raíz del proyecto en VS Code para que coincidan las rutas de depuración.

## Cómo lanzarlo

Desde `workspace`:

```bash
docker compose up -d --build
```

La primera vez construye la imagen. Arranques posteriores pueden omitir `--build` si no has cambiado [docker/Dockerfile](docker/Dockerfile) ni la configuración de PHP/Apache.

Comprueba que los tres contenedores están en marcha:

```bash
docker compose ps
```

- Aplicación: http://localhost (desde [src/index.php](src/index.php))
- phpMyAdmin: http://localhost:8000 (servidor `db`)

Parar los servicios (el volumen de MariaDB se conserva):

```bash
docker compose down
Ctrl+C #si se ejecuta en primer plano.
```

Ver logs de Apache/PHP:

```bash
docker compose logs -f web
```

Entrar en el contenedor web:

```bash
docker compose exec web bash
```

## Depurar con Visual Studio Code

Xdebug ya está activo (`xdebug.start_with_request=yes`) y [`.vscode/launch.json`](.vscode/launch.json) escucha en el puerto **9003**, con el mapeo:

```text
/var/www/html  →  ${workspaceFolder}/src
```

Pasos:

1. Coloca un punto de interrupción en un fichero de `src/` (por ejemplo en `index.php`).
2. Abre **Ejecutar y depurar** (`Ctrl+Shift+D`) y elige **Listen for Xdebug**.
3. Pulsa **Iniciar depuración** (`F5`). El estado debe quedar en *escuchando*.
4. Recarga http://localhost (o la ruta del script). La ejecución se detendrá en el breakpoint.

Si no entra en el depurador:

- Confirma que el contenedor `php-apache` está en ejecución.
- La carpeta abierta en VS Code debe ser `workspace` (no el repositorio padre), para que `${workspaceFolder}/src` sea correcto.
- En Windows, `extra_hosts: host.docker.internal:host-gateway` en [docker-compose.yml](docker-compose.yml) permite que Xdebug alcance el IDE.

Para comprobar Xdebug, abre http://localhost y busca la sección **xdebug** en `phpinfo()`.

## Instalar dependencias con Composer

Composer está instalado **dentro del contenedor** `web`. No hace falta Composer en el host.

El `WORKDIR` de la imagen es `/var/www/html`, que es el volumen `src/`. Los comandos se ejecutan contra el código del proyecto.

Crear `composer.json` (si aún no existe) e instalar un paquete:

```bash
docker compose exec web composer init
docker compose exec web composer require monolog/monolog
```

Instalar lo declarado en `composer.json` / `composer.lock` (por ejemplo tras clonar el repo):

```bash
docker compose exec web composer install
```

Actualizar dependencias:

```bash
docker compose exec web composer update
```

`vendor/` se genera en `src/vendor`. Está en [`.gitignore`](.gitignore): cada entorno debe ejecutar `composer install`. En PHP, carga el autoload con:

```php
require __DIR__ . '/vendor/autoload.php';
```

Si Composer no encuentra el proyecto, indica el directorio de trabajo de forma explícita:

```bash
docker compose exec web composer install --working-dir=/var/www/html
```
