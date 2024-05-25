<?php
include '../../ConexionBD/conexion.php';
include '../../../alertas.php';

$nombreHU = $_POST['NombreHU'];
$ph = $_POST['PH'];
$responsableHU = $_POST['ResponsableHU'];
$sprint = $_POST['SprintHU'];

$conexion->query("INSERT INTO hu (Nombre, PH, Responsable, Sprint) VALUES ('$nombreHU', '$ph', '$responsableHU', '$sprint')") or die($conexion->error);

if ($conexion) {
    session_start();
    $_SESSION['exito'] = 'HU ingresada';
    Header("Location: ../../Vista/backlog.php");
} else {
    echo "error";
}
