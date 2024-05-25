<?php
// Inicia la sesión si aún no está iniciada
session_start();

// Limpiar todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Eliminar la cookie que contiene el valor de PFA
if (isset($_COOKIE['pfa'])) {
    setcookie('pfa', '', time() - 3600, '/'); // Establece una fecha de expiración en el pasado para eliminar la cookie
}

// Envía una respuesta JSON indicando que la sesión y la cookie se han borrado exitosamente
header('Content-Type: application/json');
echo json_encode(['status' => 'success', 'message' => 'Sesión y cookie de PFA borradas exitosamente']);
?>


