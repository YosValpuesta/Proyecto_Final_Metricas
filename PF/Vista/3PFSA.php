<?php
session_start();

$requisitos = isset($_SESSION['requisitosComplejidad']) ? $_SESSION['requisitosComplejidad'] : [];

$conteos = [
    'EI' => ['Baja' => 0, 'Media' => 0, 'Alta' => 0],
    'EO' => ['Baja' => 0, 'Media' => 0, 'Alta' => 0],
    'EQ' => ['Baja' => 0, 'Media' => 0, 'Alta' => 0],
    'ILF' => ['Baja' => 0, 'Media' => 0, 'Alta' => 0],
    'EIF' => ['Baja' => 0, 'Media' => 0, 'Alta' => 0]
];

foreach ($requisitos as $requisito) {
    $tipoFuncion = $requisito['tipoFuncion'];
    $complejidad = $requisito['complejidad'];
    if (isset($conteos[$tipoFuncion][$complejidad])) {
        $conteos[$tipoFuncion][$complejidad]++;
    }
}

// Guardar los conteos en la sesión
$_SESSION['conteos'] = $conteos;

// Obtener los conteos de la sesión
$conteos = isset($_SESSION['conteos']) ? $_SESSION['conteos'] : [
    'EI' => ['Baja' => 0, 'Media' => 0, 'Alta' => 0],
    'EO' => ['Baja' => 0, 'Media' => 0, 'Alta' => 0],
    'EQ' => ['Baja' => 0, 'Media' => 0, 'Alta' => 0],
    'ILF' => ['Baja' => 0, 'Media' => 0, 'Alta' => 0],
    'EIF' => ['Baja' => 0, 'Media' => 0, 'Alta' => 0]
];

$valoresMultiplicacion = [
    'EI' => ['Baja' => 3, 'Media' => 4, 'Alta' => 6],
    'EO' => ['Baja' => 4, 'Media' => 5, 'Alta' => 7],
    'EQ' => ['Baja' => 3, 'Media' => 4, 'Alta' => 6],
    'ILF' => ['Baja' => 7, 'Media' => 10, 'Alta' => 15],
    'EIF' => ['Baja' => 5, 'Media' => 7, 'Alta' => 10],
];

$totalGeneral = 0;
?>

<head>
    <meta charset="utf-8">
    <title>CorsolaCorp: PFS</title>
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../assets/css/general.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/PF/requisitos.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include 'Sidebar.html'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'navPrincipal.php' ?>
                <div class="container-fluid text-center">
                    <h1 class="my-2 text-gray-900 text-center">Puntos de función sin ajustar</h1>
                    <div class="container-fluid" id="tableRequisitos">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr class="text-center">
                                    <th scope="col" rowspan="2">Componente</th>
                                    <th scope="col" colspan="3">Complejidad</th>
                                    <th scope="col" rowspan="2">Total</th>
                                </tr>
                                <tr class="text-center">
                                    <th scope="col">Baja</th>
                                    <th scope="col">Media</th>
                                    <th scope="col">Alta</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php
                                $totalGeneral = 0;
                                foreach ($conteos as $tipoFuncion => $complejidades) {
                                    echo '<tr>';
                                    echo "<td>{$tipoFuncion}</td>";
                                    $totalFila = 0;
                                    foreach (['Baja', 'Media', 'Alta'] as $nivel) {
                                        $conteo = $complejidades[$nivel];
                                        $valor = $valoresMultiplicacion[$tipoFuncion][$nivel];
                                        $total = $conteo * $valor;
                                        $totalFila += $total;
                                        if ($conteo > 0) {
                                            echo "<td><span style='color: red; font-weight: bold;'>{$conteo}</span> x {$valor} = <span style='color: red; font-weight: bold;'>{$total}</span></td>";
                                        } else {
                                            echo "<td>{$conteo} x {$valor} = {$total}</td>";
                                        }
                                    }
                                    if ($totalFila > 0) {
                                        echo "<td style='color: red; font-weight: bold;'>{$totalFila}</td>";
                                    } else {
                                        echo "<td>{$totalFila}</td>";
                                    }
                                    $totalGeneral += $totalFila;
                                    echo '</tr>';
                                }
                                ?>
                                <tr>
                                    <td colspan="4" class="table-success">N° Total PFSA</td>
                                    <td class="table-success"><?php echo $totalGeneral; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <?php
                        $_SESSION['totalGeneral'] = $totalGeneral;
                        ?>
                    </div>
                    <div class="container my-2">
                        <div class="row">
                            <div class="col-12">
                                <a type="button" class="btn btn-primary btn-sm" href="4FactorAjuste.php">
                                    Calcular factor de ajuste
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'footer.html'; ?>
        </div>
    </div>
</body>