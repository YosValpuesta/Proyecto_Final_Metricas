<?php
$sprintSeleccionado = isset($_GET['sprint']) ? intval($_GET['sprint']) : 1;

$stmt = $conexion->prepare("
    SELECT hu.Sprint, hu_tablero.numeroHU, hu_tablero.fechaIniciada, hu_tablero.fechaTerminada
    FROM hu
    INNER JOIN hu_tablero
    ON hu.numeroHU = hu_tablero.numeroHU
    WHERE hu.Sprint = ? AND hu_tablero.Estado = 'Terminada'
");
$stmt->bind_param("i", $sprintSeleccionado);
$stmt->execute();
$resultado = $stmt->get_result();

$cycleTimes = array();
$totalCycleTime = 0;
$numHU = 0;

while ($hu = $resultado->fetch_assoc()) {
    $fechaIniciada = new DateTime($hu['fechaIniciada']);
    $fechaTerminada = new DateTime($hu['fechaTerminada']);

    $cycleTime = $fechaTerminada->diff($fechaIniciada)->days;

    $cycleTimes[$hu['numeroHU']] = $cycleTime;
    $totalCycleTime += $cycleTime;
    $numHU++;
}


// Calcula el Cycle Time promedio
$cycleTimePromedio = $numHU > 0 ? $totalCycleTime / $numHU : 0;

$recomendacionesCycleTime = array();

foreach ($cycleTimes as $numeroHU => $cycleTime) {
    if ($cycleTime > $cycleTimePromedio * 1.5) {
        $mensaje = "La historia de usuario HU $numeroHU tiene un Cycle Time significativamente más alto que el promedio. Revisa esta HU para identificar posibles cuellos de botella.";
        $recomendacionesCycleTime[] = array(
            'tipo' => 'alerta',
            'mensaje' => $mensaje
        );
    }
}

$tendencia = "estable";
if ($sprintSeleccionado > 1) {
    // Cycle Time promedio del sprint anterior y comparar
    $stmtAnterior = $conexion->prepare("
        SELECT AVG(DATEDIFF(hu_tablero.fechaTerminada, hu_tablero.fechaIniciada)) as cycleTimePromedioAnterior
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

    $cycleTimePromedioAnterior = $datosAnteriores['cycleTimePromedioAnterior'];

    if ($cycleTimePromedio > $cycleTimePromedioAnterior) {
        $tendencia = "creciente";
        $recomendacionesCycleTime[] = [
            'tipo' => 'alerta',
            'mensaje' => "El Cycle Time promedio está aumentando. Considera implementar mejoras para reducirlo."
        ];
    } elseif ($cycleTimePromedio < $cycleTimePromedioAnterior) {
        $tendencia = "decreciente";
        $recomendacionesCycleTime[] = [
            'tipo' => 'alerta',
            'mensaje' => "El Cycle Time promedio está disminuyendo. Mantén las buenas prácticas actuales."
        ];
    }
}
