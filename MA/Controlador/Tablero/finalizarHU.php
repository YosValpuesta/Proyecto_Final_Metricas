<?php
include '../../ConexionBD/conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['numeroHU'])) {
    $numeroHU = $_POST['numeroHU'];
    $estado = 'Terminada';
    $fechaTerminada = '2024-05-13';

    $conexion->query("UPDATE hu_tablero SET estado = '$estado', fechaTerminada = '$fechaTerminada' WHERE numeroHU = '$numeroHU'") or die($conexion->error);

    // Devolver una respuesta JSON indicando el éxito de la actualización
    echo json_encode(['success' => true]);
} else {
    // Si no se reciben datos adecuados, devolver un error
    echo json_encode(['success' => false, 'message' => 'Datos incorrectos']);
}
