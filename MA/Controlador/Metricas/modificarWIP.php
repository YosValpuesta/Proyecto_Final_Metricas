<?php
include '../../ConexionBD/conexion.php';

$valorPorHacer = $_POST['valorPorHacer'];
$valorHaciendo = $_POST['valorHaciendo'];

$conexion->query("UPDATE metricawip SET valorPorHacer = '$valorPorHacer', valorHaciendo = '$valorHaciendo' WHERE idWIP = '1'") or die($conexion->error);

if ($conexion) {
    Header("Location: ../../Vista/WIP.php");
} else {
    echo "error";
}
