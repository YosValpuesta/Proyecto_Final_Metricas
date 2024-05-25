<?php
session_start();
include '../ConexionBD/conexion.php';

$querySprints = $conexion->query("SELECT * FROM tablero") or die($conexion->error);
$mostrarSprint = mysqli_fetch_array($querySprints);

$valoresWIP = "SELECT * FROM metricawip";
$resultado = $conexion->query($valoresWIP);

?>

<head>
    <meta charset="utf-8">
    <title>CorsolaCorp: Métrica WIP</title>
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../assets/css/general.css" rel="stylesheet">
    <link href="../../assets/css/MA/backlog.css" rel="stylesheet">
</head>

<body id="page-top">
    <?php include '../../alertas.php' ?>
    <script>
        Swal.fire({
            text: "Define claramente el trabajo en progreso para cada columna del tablero",
            icon: "warning"
        });
    </script>
    <div id="wrapper">
        <?php include 'Sidebar.html' ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'navPrincipal.php' ?>
                <div class="container-fluid text-center">
                    <h1 class="my-2 text-gray-900 text-center">Metrica WIP: Work in progress</h1>
                    <div class="container-fluid" id="backlog">
                        <div class="card text-center">
                            <form action="../Controlador/Metricas/modificarWIP.php" method="POST">
                                <div class="card-header">WIP por columna</div>
                                <div class="card-body">
                                    <p class="card-text">Agrega un valor limite a cada columna del tablero</p>
                                    <div class="input-group input-group-sm mb-1">
                                        <?php
                                        while ($mostrar = $resultado->fetch_assoc()) {
                                        ?>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">WIP: "Por hacer"</span>
                                            </div>
                                            <input REQUIRED type="number" min="1" max="50" class="form-control" name="valorPorHacer" value="<?php echo $mostrar['valorPorHacer']; ?>">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">WIP: "Haciendo"</span>
                                            </div>
                                            <input REQUIRED type="number" min="1" max="50" class="form-control" name="valorHaciendo" value="<?php echo $mostrar['valorHaciendo']; ?>">
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-outline-dark my-1">Modificar valor WIP</button>
                                </div>
                            </form>
                            <div class="card-footer text-muted">
                                Proyecto: <?php echo $mostrarSprint['Nombre'] ?>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm my-1" data-toggle="modal" data-target="#notasWIP">
                        Ayuda
                    </button>
                </div>
            </div>
            <?php include 'footer.html' ?>
        </div>
    </div>
</body>

<!-- Modal -->
<div class="modal fade" id="notasWIP" tabindex="-1" aria-labelledby="notasWIPLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notasWIPLabel">Notas ayuda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item">“Poner límites WIP más bajos te ayudará a sacar más fácilmente el trabajo”</li>
                    <li class="list-group-item">
                        <h5 style="color: red;">¡Importante!</h5>
                    </li>
                    <li class="list-group-item">Si tenemos una gran cantidad de trabajo en proceso; "Corremos un alto riesgo de que tareas tarden mucho tiempo en finalizar y tienden a quedar abandonadas"</li>
                    <li class="list-group-item">Menor cantidad de trabajo en proceso; "Corremos un alto riesgo de tener personas ociosas"</li>
                    <li class="list-group-item">"Afecta directamente las metricas: Lead y Cycle time"</li>
                </ul>
            </div>
        </div>
    </div>
</div>