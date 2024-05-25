<?php
session_start();

// Verificar si se recibió un valor de VFA
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vfa'])) {
    // Obtener el valor de VFA enviado desde JavaScript
    $vfa = $_POST['vfa'];

    // Guardar el valor de VFA en la sesión
    $_SESSION['vfa'] = $vfa;

    // Enviar una respuesta JSON indicando éxito
    echo json_encode(['status' => 'success']);
} else {
    // Enviar una respuesta JSON indicando error
    echo json_encode(['status' => 'error', 'message' => 'No se recibió el valor de VFA']);
}
?>
