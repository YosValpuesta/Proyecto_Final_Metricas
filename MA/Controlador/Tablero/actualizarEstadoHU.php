<?php
include '../../ConexionBD/conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['numeroHU'])) {
    $numeroHU = $_POST['numeroHU'];
    $estado = 'En progreso';
    $fechaIniciada = '2024-05-12';

    // Obtener la cantidad actual de elementos en estado "En Progreso"
    $cantidadEnProgreso = $conexion->query("SELECT COUNT(*) AS total FROM hu_tablero WHERE estado = 'En progreso'")->fetch_assoc()['total'];

    // Obtener el límite de "En Progreso" desde la base de datos
    $resultado = $conexion->query("SELECT valorHaciendo FROM metricawip") or die($conexion->error);
    $valorHaciendo = mysqli_fetch_array($resultado);
    $HaciendoWIP = $valorHaciendo['valorHaciendo'];

    // Verificar si se ha superado el límite de "En Progreso" al mover una HU
    if ($cantidadEnProgreso >= $HaciendoWIP) {
        $mensajeError = 'Se ha alcanzado el límite de elementos en estado "En progreso". No se puede agregar más HUs.';
        $_SESSION['error'] = $mensajeError;
        echo json_encode(['success' => false, 'message' => $mensajeError]);
        exit();
    }

    // Actualizar el estado de la HU en la base de datos
    $conexion->query("UPDATE hu_tablero SET estado = '$estado', fechaIniciada = '$fechaIniciada' WHERE numeroHU = '$numeroHU'") or die($conexion->error);

    // Devolver una respuesta JSON indicando el éxito de la actualización
    echo json_encode(['success' => true]);
} else {
    // Si no se reciben datos adecuados, devolver un error
    $_SESSION['error'] = 'Datos incorrectos';
    echo json_encode(['success' => false, 'message' => $_SESSION['error']]);
}
