<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['esfuerzo'])) {
        $_SESSION['esfuerzoTotal'] = $_POST['esfuerzo'];
    }
    if (isset($_POST['duracion'])) {
        $_SESSION['duracionTotal'] = $_POST['duracion'];
    }
    if (isset($_POST['personas'])) {
        $_SESSION['cantidadPersonas'] = $_POST['personas'];
    }
    if (isset($_POST['costo'])) {
        $_SESSION['costoEstimado'] = $_POST['costo'];
    }
}
?>
