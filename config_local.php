<?php
// Configuración local para Windows/XAMPP. Puedes cambiarla mediante variables de entorno.
function cursos_db(string $schema = 'proyecta_elearning')
{
    $names = [
        'proyecta_elearning' => getenv('CURSOS_DB_MAIN') ?: 'proyecta_elearning',
        'proyecta_educatec_rysoft' => getenv('CURSOS_DB_API') ?: 'proyecta_educatec_rysoft',
        'proyecta_educatec_dr' => getenv('CURSOS_DB_DR') ?: 'proyecta_educatec_dr',
        'proyecta_educatec' => getenv('CURSOS_DB_MAIN') ?: 'proyecta_elearning',
    ];
    if (!isset($names[$schema])) {
        throw new InvalidArgumentException('Base de datos no configurada.');
    }
    $con = mysqli_connect(
        getenv('CURSOS_DB_HOST') ?: '127.0.0.1',
        getenv('CURSOS_DB_USER') ?: 'root',
        getenv('CURSOS_DB_PASSWORD') ?: '',
        $names[$schema],
        (int)(getenv('CURSOS_DB_PORT') ?: 3306)
    );
    if (!$con) {
        throw new RuntimeException('No se pudo conectar a la base de datos local. Revisa la guía de Windows y la configuración MySQL.');
    }
    mysqli_set_charset($con, 'utf8mb4');
    return $con;
}
