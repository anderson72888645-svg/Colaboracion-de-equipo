<?php

/*ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/debug.log'); // Ruta del archivo de log en el mismo directorio
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

error_log("Iniciando script c_verificacion.php.");
*/
include_once '../_modelo/m_email.php';

include_once '../admin/model/conexionAPI.php';
header('Content-Type: application/json');

// Verificar si el email ya está registrado
if (isset($_GET['checkEmail'])) {
    //error_log("Parametro checkEmail recibido.");
    $email = $_GET['checkEmail'];
    //error_log("Email recibido: $email");

    //error_log("Conexión a la base de datos exitosa.");

    // Consulta para verificar si el email existe en la tabla cursos
    $query = "SELECT email_alum as existe FROM alumno WHERE email_alum = ?";
    $stmt = $con->prepare($query);
    //error_log("Consulta preparada: $query");
    $stmt->execute([$email]);
    //error_log("Consulta ejecutada con el email: $email");
    $stmt->bind_result($existe);
    $stmt->fetch();
    $result = ['existe' => $existe];
    //error_log("Resultado obtenido: " . json_encode($result));

    if ($result && isset($result['existe']) && $result['existe']) {
        // El email ya existe, está verificado
        //error_log("El email existe en la base de datos.");
        echo json_encode(['verificado' => true]);
        exit;
    } else {
        //error_log("El email existe en la base de datos.");
        // El email no existe, requiere verificación
        echo json_encode(['verificado' => false]);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //error_log("Solicitud POST recibida.");
    //error_log("Contenido completo de \$_POST: " . json_encode($_POST));
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    //error_log("Email recibido: $email");
    if ($email) {
        $codigo = sprintf("%06d", mt_rand(0, 999999)); // Genera código de 6 dígitos
        //error_log("Código de verificación generado: $codigo");
        session_start();
        $_SESSION['codigo_verificacion'] = $codigo;
        $_SESSION['codigo_tiempo'] = time();
        $_SESSION['email_verificacion'] = $email;

        if (enviarCodigoVerificacion($email, $codigo)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error al enviar el correo']);
        }
    }
}

// Endpoint para verificar código
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    session_start();
    $codigo_ingresado = isset($_GET['codigo']) ? $_GET['codigo'] : '';
    $tiempo_actual = time();

    if (!isset($_SESSION['codigo_verificacion']) || !isset($_SESSION['codigo_tiempo'])) {
        echo json_encode(['valid' => false, 'error' => 'No hay código pendiente']);
        exit;
    }

    if ($tiempo_actual - $_SESSION['codigo_tiempo'] > 600) { // 10 minutos
        echo json_encode(['valid' => false, 'error' => 'Código expirado']);
        exit;
    }

    if ($codigo_ingresado === $_SESSION['codigo_verificacion']) {
        $_SESSION['email_verificado'] = true;
        echo json_encode(['valid' => true]);
    } else {
        echo json_encode(['valid' => false, 'error' => 'Código inválido']);
    }
}
