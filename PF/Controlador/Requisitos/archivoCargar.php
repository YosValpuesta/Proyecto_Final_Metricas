<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['requisitosArchivo'])) {
    $file = $_FILES['requisitosArchivo']['tmp_name'];
    if (file_exists($file)) {
        $fileContent = file_get_contents($file);
        // Suponiendo que cada requisito está en una nueva línea
        $requisitos = explode(PHP_EOL, $fileContent); 
        // Guardar los requisitos en una variable de sesión
        $_SESSION['requisitos'] = $requisitos;
        header("Location: ../../Vista/Requisitos.php");
        exit;
    } else {
        echo "Error al cargar el archivo.";
    }
}
