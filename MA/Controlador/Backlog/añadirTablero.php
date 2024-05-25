<?php
include '../../ConexionBD/conexion.php';
session_start();

// Verificar si se ha enviado el número de HU
if (isset($_GET['numeroHU'])) {
    $numeroHU = $_GET['numeroHU'];

    $consulta = $conexion->query("SELECT COUNT(*) as existe FROM hu_tablero WHERE numeroHU = '$numeroHU'") or die($conexion->error);
    $resultadoConsulta = mysqli_fetch_assoc($consulta);

    // Verificar si la HU ya existe en el tablero
    if ($resultadoConsulta['existe'] > 0) {
        $_SESSION['error'] = 'La HU ya está agregada';
        header("Location: ../../Vista/backlog.php");
        exit();
    } else {
        //Obtener la cantidad actual de elementos en estado "Por Hacer"
        $cantidadPorHacer = $conexion->query("SELECT COUNT(*) AS total FROM hu_tablero WHERE estado = 'Por Hacer'")->fetch_assoc()['total'];

        //Obtengo WIP LIMITE
        $resultado = $conexion->query("SELECT valorPorHacer FROM metricawip") or die($conexion->error);
        $valorPorHacer = mysqli_fetch_array($resultado);
        $PorHacerWIP = $valorPorHacer['valorPorHacer'];

        // Verificar si se ha superado el límite de "Por Hacer" al agregar una nueva HU
        if ($cantidadPorHacer >= $PorHacerWIP) {
            $_SESSION['error'] = 'Se ha alcanzado el límite de elementos en estado "Por Hacer". No se puede agregar más HUs.';
            header("Location: ../../Vista/kanban.php");
            exit();
        }

        $estadoHU = 'Por Hacer';
        $fechaIni = '2024-05-11';

        $conexion->query("INSERT INTO hu_tablero (numeroHU, estado, fechaAgregada) VALUES ('$numeroHU', '$estadoHU', '$fechaIni')") or die($conexion->error);
        header("Location: ../../Vista/kanban.php");
    }
}
