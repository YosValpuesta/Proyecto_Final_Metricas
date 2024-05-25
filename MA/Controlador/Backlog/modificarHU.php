<?php
include '../../ConexionBD/conexion.php';
include '../../../alertas.php';

$HU = $_GET['hu'];
$nombreHU = $_POST['NombreHU'];
$ph = $_POST['PH'];
$responsableHU = $_POST['ResponsableHU'];

$conexion->query("UPDATE hu SET Nombre = '$nombreHU', PH = '$ph', Responsable = '$responsableHU' WHERE numeroHU = '$HU'") or die($conexion->error);

if ($conexion) {
    session_start();
    $_SESSION['exitoUpdate'] = 'HU actualizada de manera exitosa';
    Header("Location: ../../Vista/backlog.php");
} else {
    echo "error";
}
