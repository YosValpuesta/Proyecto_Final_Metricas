<?php
include '../../ConexionBD/conexion.php';

if (isset($_POST['numeroHU'])) {
    $numeroHU = $_POST['numeroHU'];
    // Consulta para eliminar la tarea del tablero y actualizar la fecha agregada a nulo
    $sql = "DELETE FROM hu_tablero WHERE numeroHU = '$numeroHU'";

    if ($conexion->query($sql) === TRUE) {
        $response = array("success" => true);
    } else {
        $response = array("success" => false);
    }

    // Enviar respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}
