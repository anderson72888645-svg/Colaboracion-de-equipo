# Abrir y ejecutar en VS Code para Windows

Esta es una aplicación PHP con MySQL/MariaDB. VS Code sirve para editarla; para abrirla en el navegador necesitas un servidor PHP y MySQL. La configuración original de cPanel indicaba PHP 7.4. Se retiró ese handler para que Apache de XAMPP utilice su propio PHP; la ejecución en PHP 8 no está comprobada.

## Pasos

1. Instala VS Code y un entorno local con Apache, PHP y MySQL (por ejemplo, XAMPP). Activa **Apache** y **MySQL**.
2. Copia la carpeta `cursos-main` a `C:\xampp\htdocs\cursos-main` y abre esa carpeta en VS Code con **Archivo > Abrir carpeta**.
3. En `http://localhost/phpmyadmin/`, crea la base `proyecta_elearning` e importa `BD/proyecta_elearning.sql`. El archivo contiene únicamente la estructura, sin registros reales.
4. Para las funciones que usan el sistema educativo externo, crea también `proyecta_educatec_rysoft` e importa `BD/educatec_rysoft_250226_1140.sql`. Este archivo también contiene únicamente la estructura. La aplicación consulta además `proyecta_educatec_dr`, pero el proyecto recibido no incluye su esquema; esas funciones no quedarán completas sin ese recurso.
5. Entra en `http://localhost/cursos-main/` para ver el sitio y en `http://localhost/cursos-main/admin/` para el panel.

La conexión predeterminada en `config_local.php` es `127.0.0.1`, puerto `3306`, usuario `root` sin contraseña, como una instalación local típica de XAMPP. Si tu MySQL usa otros valores, modifica las opciones locales en ese archivo o define `CURSOS_DB_HOST`, `CURSOS_DB_PORT`, `CURSOS_DB_USER`, `CURSOS_DB_PASSWORD`, `CURSOS_DB_MAIN`, `CURSOS_DB_API` y `CURSOS_DB_DR` en el entorno de Apache. No publiques contraseñas en GitHub.

## Archivos y servicios adicionales

- `.vscode/settings.json` indica a VS Code dónde buscar `php.exe` si XAMPP está en `C:\xampp`. Ajusta la ruta si lo instalaste en otra ubicación. `.vscode/extensions.json` sugiere extensiones de PHP.
- El correo SMTP y la pasarela de pagos requieren credenciales propias. Las claves del servidor de origen se retiraron de esta copia. Configura `CURSOS_SMTP_USER`, `CURSOS_SMTP_PASSWORD`, `CURSOS_PAYMENT_USERNAME`, `CURSOS_PAYMENT_PASSWORD`, `CURSOS_PAYMENT_PUBLIC_KEY` y `CURSOS_PAYMENT_SHA_KEY` antes de probar envíos o pagos. No hagas pruebas de cobros reales.
- Se corrigió el nombre de la inclusión de `_vista/helpers_.php` en la integración de pagos.
- Se quitaron cuatro archivos PHP idénticos, escondidos entre CSS e imágenes, que ejecutaban código comprimido y no corresponden a la aplicación normal.
- Los archivos SQL pueden contener datos de ejemplo o personales. Revisa su contenido antes de publicarlos.

Esta copia fue revisada estáticamente. No se pudo iniciar Apache/MySQL ni hacer pruebas de navegador en este entorno, por lo que hay que comprobar el sitio localmente tras importar las bases de datos.
