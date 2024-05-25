<?php
session_start(); // Inicia la sesión si aún no está iniciada

// Verifica si se recibió un valor de PFA en la solicitud POST
if (isset($_POST['pfa'])) {
    // Obtén el valor de PFA de la solicitud POST
    $pfa = floatval($_POST['pfa']);

    // Guarda el valor de PFA en una variable de sesión
    $_SESSION['pfa'] = $pfa;

    // Redirecciona al usuario a estimaciones.php
    header('Location: ../Vista/5PFA.php');
    exit(); // Asegura que el script se detenga después de la redirección
} else {
    // Envía una respuesta al cliente indicando que no se recibió el valor de PFA en la solicitud
    http_response_code(400); // Código de respuesta HTTP 400 (Bad Request)
    echo json_encode(['error' => 'No se recibió el valor de PFA']);

    // Mensaje de depuración
    error_log('No se recibió el valor de PFA en la solicitud');
}
?>


