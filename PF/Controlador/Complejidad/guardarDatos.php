<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['index'])) {
    $index = $_POST['index'];
    $nombre = $_POST['nombre'];
    $tipoFuncion = $_POST['tipoFuncion'];
    $det = $_POST['det'];
    $ftr = $_POST['ftr'];
    $complejidad = $_POST['complejidad'];

    // Verificar si ya existe el índice en el arreglo
    if (isset($_SESSION['requisitosComplejidad'][$index])) {
        // Si el índice ya existe, actualizar los datos existentes en lugar de duplicarlos
        $_SESSION['requisitosComplejidad'][$index] = [
            'nombre' => $nombre,
            'tipoFuncion' => $tipoFuncion,
            'det' => $det,
            'ftr' => $ftr,
            'complejidad' => $complejidad
        ];
        echo json_encode(['status' => 'updated']);
    } else {
        // Si el índice no existe, agregar nuevos datos al arreglo
        $_SESSION['requisitosComplejidad'][$index] = [
            'nombre' => $nombre,
            'tipoFuncion' => $tipoFuncion,
            'det' => $det,
            'ftr' => $ftr,
            'complejidad' => $complejidad
        ];
        echo json_encode(['status' => 'success']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Solicitud incorrecta']);
}
?>
