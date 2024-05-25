<?php
$sprintSeleccionado = isset($_GET['sprint']) ? intval($_GET['sprint']) : 1;

$stmt = $conexion->prepare("
    SELECT hu.Sprint, hu_tablero.numeroHU, hu_tablero.fechaAgregada, hu_tablero.fechaIniciada, hu_tablero.fechaTerminada
    FROM hu
    INNER JOIN hu_tablero
    ON hu.numeroHU = hu_tablero.numeroHU
    WHERE hu.Sprint = ? AND hu_tablero.Estado = 'Terminada'
");
$stmt->bind_param("i", $sprintSeleccionado);
$stmt->execute();
$resultado = $stmt->get_result();

$leadTimes = array();
$totalLeadTime = 0;
$numHU = 0;

while ($hu = $resultado->fetch_assoc()) {
    $fechaAgregada = new DateTime($hu['fechaAgregada']);
    $fechaIniciada = new DateTime($hu['fechaIniciada']);
    $fechaTerminada = new DateTime($hu['fechaTerminada']);

    $leadTime = $fechaTerminada->diff($fechaAgregada)->days;

    $leadTimes[$hu['numeroHU']] = $leadTime;
    $totalLeadTime += $leadTime;
    $numHU++;
}

$leadTimePromedio = $numHU > 0 ? $totalLeadTime / $numHU : 0;

// Generar recomendaciones
$recomendaciones = array();

foreach ($leadTimes as $numeroHU => $leadTime) {
    if ($leadTime > $leadTimePromedio * 1.5) {
        $mensaje = "La historia de usuario HU $numeroHU tiene un Lead Time significativamente más alto que el promedio. Revisa esta HU para identificar posibles cuellos de botella.";
        $recomendaciones[] = array(
            'tipo' => 'alerta',
            'mensaje' => $mensaje
        );
    }
}

$tendencia = "estable";
if ($sprintSeleccionado > 1) {
    // Lead Time promedio del sprint anterior y comparar
    $stmtAnterior = $conexion->prepare("
        SELECT AVG(DATEDIFF(hu_tablero.fechaTerminada, hu_tablero.fechaAgregada)) as leadTimePromedioAnterior
        FROM hu
        INNER JOIN hu_tablero
        ON hu.numeroHU = hu_tablero.numeroHU
        WHERE hu.Sprint = ? AND hu_tablero.Estado = 'Terminada'
    ");
    $sprintAnterior = $sprintSeleccionado - 1;
    $stmtAnterior->bind_param("i", $sprintAnterior);
    $stmtAnterior->execute();
    $resultadoAnterior = $stmtAnterior->get_result();
    $datosAnteriores = $resultadoAnterior->fetch_assoc();

    $leadTimePromedioAnterior = $datosAnteriores['leadTimePromedioAnterior'];

    if ($leadTimePromedio > $leadTimePromedioAnterior) {
        $tendencia = "creciente";
        $recomendaciones[] = [
            'tipo' => 'alerta',
            'mensaje' => "El Lead Time promedio está aumentando. Considera implementar mejoras para reducirlo."
        ];
    } elseif ($leadTimePromedio < $leadTimePromedioAnterior) {
        $tendencia = "decreciente";
        $recomendaciones[] = [
            'tipo' => 'alerta',
            'mensaje' => "El Lead Time promedio está disminuyendo. Mantén las buenas prácticas actuales."
        ];
    }
}
