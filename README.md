# Plataforma de cursos

Aplicación web desarrollada en PHP y MySQL para gestionar cursos, programas, membresías, alumnos, docentes y certificados.

## Estructura principal

- `admin/`: panel administrativo, vistas, modelos y acciones.
- `_modelo/`: consultas utilizadas por el sitio público.
- `_vista/`: componentes y pantallas del sitio público.
- `_controller/`: controladores de verificación.
- `_conexion/` y `config_local.php`: conexión centralizada a MySQL.
- `assets/`: estilos, scripts e imágenes públicas.
- `BD/`: esquemas de base de datos sin registros personales.

## Ejecución en Windows

Consulta [README_WINDOWS.md](README_WINDOWS.md) para instalar el proyecto con VS Code y XAMPP.

## Seguridad

Esta versión pública no contiene credenciales, registros de alumnos, certificados generados, fotografías de usuarios ni imágenes de medios de pago. Esos recursos deben mantenerse fuera de Git y configurarse solamente en el entorno privado de ejecución.

Las funciones de pago y correo requieren variables de entorno. Usa `.env.example` únicamente como referencia y no publiques valores reales.

## Ramas

- `main`: base estable y revisada.
- `desarrollo`: integración de los cambios antes de enviarlos a `main`.

Las modificaciones deben realizarse en una rama creada desde `desarrollo` y entregarse mediante un Pull Request hacia `desarrollo`.
