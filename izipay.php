<?php
$username = getenv('CURSOS_PAYMENT_USERNAME') ?: '';
//$password = getenv('CURSOS_PAYMENT_PASSWORD') ?: '';
$password = getenv('CURSOS_PAYMENT_PASSWORD') ?: '';




$amount = $_POST['amount'] * 100;
$email = $_POST['email'];


$data = array(
    "amount" => $amount,
    "currency" => "PEN",
    "orderId" => uniqid("MyOrderId"),
    "customer" => array(
        "email" => $email
    )
);



$url = "https://api.micuentaweb.pe/api-payment/V4/Charge/CreatePayment";

// Crear la cadena de usuario y contraseña separados por dos puntos
$credentials = $username . ':' . $password;

// Codificar las credenciales en base64
$base64Credentials = base64_encode($credentials);

// Encabezados de la solicitud
$headers = array(
    "Authorization: Basic " . $base64Credentials,
    "Content-Type: application/json"
);

// Configurar la solicitud cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Realizar la solicitud
$response = curl_exec($ch);

// Manejar la respuesta
if ($response === false) {
    echo "Error en la solicitud cURL: " . curl_error($ch);
}


// Cerrar la sesión cURL
curl_close($ch);
$responseData = json_decode($response, true);

if (isset($responseData["answer"]["formToken"])) {
    $formToken = $responseData["answer"]["formToken"];
    echo json_encode(array("formToken" => $formToken));
} else {
    echo "El campo 'formToken' no está presente en la respuesta JSON.";
}
