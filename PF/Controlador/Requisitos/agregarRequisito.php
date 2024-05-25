<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nuevoRequisito'])) {
    $nuevoRequisito = $_POST['nuevoRequisito'];
    if (!empty($nuevoRequisito)) {
        // Agregar el nuevo requisito al arreglo en la sesión
        if (!isset($_SESSION['requisitos'])) {
            $_SESSION['requisitos'] = array();
        }
        $_SESSION['requisitos'][] = $nuevoRequisito;
    }
}
?>
