<?php
include '../../ConexionBD/conexion.php';
include '../../../alertas.php';

$id = $_REQUEST['id'];
$historiasUsuario = "DELETE FROM hu WHERE numeroHU = '$id'";
$resultado = $conexion->query($historiasUsuario);

if ($resultado) {
    session_start();
    $_SESSION['exitoDelete'] = 'HU eliminada de manera exitosa';
    Header("Location: ../../Vista/backlog.php");
} else {
    echo "error";
}
