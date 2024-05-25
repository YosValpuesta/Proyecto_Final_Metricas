<?php
session_start();
include '../ConexionBD/conexion.php';

//Limite WIP
$resultado = $conexion->query("SELECT * FROM metricawip") or die($conexion->error);
$WIP = mysqli_fetch_assoc($resultado);
$PorHacerWIP = $WIP['valorPorHacer'];
$HaciendoWIP = $WIP['valorHaciendo'];
?>

<head>
    <meta charset="utf-8">
    <title>CorsolaCorp: Tablero kanban</title>
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../assets/css/general.css" rel="stylesheet">
    <link href="../../assets/css/MA/tablero.css" rel="stylesheet">
</head>

<body id="page-top">
    <?php include '../../alertas.php' ?>
    <div id="wrapper">
        <?php include 'Sidebar.html' ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'navPrincipal.php' ?>
                <div class="container">
                    <div class="row lanes">
                        <div class="col-sm-4 swim-lane" id="PorHacer">
                            <div class="card-header" style="border-radius: 16px;">
                                <h4 class="card-title heading text-center">Por hacer (<?php echo $PorHacerWIP ?>)</h4>
                            </div>
                            <div class="card-body">
                                <?php
                                $resultado = $conexion->query("SELECT * FROM hu_tablero WHERE estado = 'Por Hacer'") or die($conexion->error);
                                while ($mostrarHU = mysqli_fetch_assoc($resultado)) {
                                    $numeroHU = $mostrarHU['numeroHU'];
                                    //Muestra datos de la FK
                                    $resultadoHU = $conexion->query("SELECT * FROM hu WHERE numeroHU = '$numeroHU'") or die($conexion->error);
                                    $mostrarHistoriaUsuario = mysqli_fetch_assoc($resultadoHU);
                                    $fechaAgregado = $mostrarHU['FechaAgregada'];
                                    $fecha = date('Y-m-d');
                                    $fechaActual = date('Y-m-d', strtotime('-1 day', strtotime($fecha)));
                                ?>
                                    <div class="card" id="HU">
                                        <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modalInformacionHU<?php echo $mostrarHistoriaUsuario['numeroHU']; ?>" style="background-color: #00293c; color: white;">
                                            <h5><?php echo $mostrarHistoriaUsuario['Nombre'] ?></h5>
                                        </button>

                                        <div class="card-footer text-center">
                                            <button type="button" class="btn btn-sm btn-outline-warning" onclick="comenzarHU(<?php echo $mostrarHistoriaUsuario['numeroHU'] ?>)">Comenzar</button>
                                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="eliminarHU('<?php echo $fechaAgregado; ?>', '<?php echo $fechaActual; ?>', <?php echo $mostrarHistoriaUsuario['numeroHU']; ?>)">Eliminar</button>
                                        </div>
                                    </div>
                                    <br>
                                <?php
                                    include 'modalTablero.php';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-sm-4 swim-lane" id="EnProgreso">
                            <div class="card-header" style="border-radius: 16px;">
                                <h4 class="card-title heading text-center">En progreso (<?php echo $HaciendoWIP ?>)</h4>
                            </div>
                            <div class="card-body">
                                <?php
                                $resultado = $conexion->query("SELECT hu_tablero.*, hu.nombre AS nombre_hu FROM hu_tablero INNER JOIN hu ON hu_tablero.numeroHU = hu.numeroHU WHERE hu_tablero.estado = 'En progreso'") or die($conexion->error);
                                while ($mostrarHU = mysqli_fetch_assoc($resultado)) {
                                ?>
                                    <div class="card" id="HU">
                                        <button type="button" class="btn btn-sm" style="pointer-events: none; background-color: #00293c; color: white;">
                                            <h5><?php echo $mostrarHU['nombre_hu'] ?></h5>
                                        </button>

                                        <div class="card-footer text-center">
                                            <button type="button" class="btn btn-sm btn-outline-dark" onclick="finalizarHU(<?php echo $mostrarHU['numeroHU'] ?>)">Finalizar HU</button>
                                        </div>
                                    </div>
                                    <br>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-sm-3 swim-lane" id="Terminada">
                            <div class="card-header" style="border-radius: 16px;">
                                <h4 class="card-title heading text-center">Terminado</h4>
                            </div>
                            <div class="card-body">
                                <?php
                                $resultado = $conexion->query("SELECT hu_tablero.*, hu.nombre AS nombre_hu FROM hu_tablero INNER JOIN hu ON hu_tablero.numeroHU = hu.numeroHU WHERE hu_tablero.estado = 'Terminada'") or die($conexion->error);
                                while ($mostrarHU = mysqli_fetch_assoc($resultado)) {
                                ?>
                                    <div class="card" id="HU">
                                        <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modalInformacionHU<?php echo $mostrarHU['numeroHU']; ?>" style="background-color: #00293c; color: white;">
                                            <h5><?php echo $mostrarHU['nombre_hu'] ?></h5>
                                        </button>
                                    </div>
                                    <br>
                                <?php
                                    include 'modalTablero.php';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <?php include 'footer.html' ?>
        </div>
    </div>
</body>

<!-- Borrar de por hacer si solo ha pasado un dia -->
<script>
    function eliminarHU(fechaAgregado, fechaActual, numeroHU) {
        if (fechaAgregado === fechaActual) {
            Swal.fire({
                icon: 'warning',
                title: '¿Estás seguro?',
                text: '¿Estás seguro de eliminar esta tarea?',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    eliminarTarea(numeroHU);
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se puede eliminar. Ha pasado más de un día desde que se agregó.'
            });
        }
    }

    function eliminarTarea(numeroHU) {
        $.ajax({
            type: 'POST',
            url: '../Controlador/Tablero/eliminarTablero.php',
            data: {
                numeroHU: numeroHU
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: 'Tarea eliminada correctamente.'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrió un error al eliminar la tarea.'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error al eliminar la tarea.'
                });
            }
        });
    }
</script>

<!-- Mover a Haciendo -->
<script>
    function comenzarHU(numeroHU) {
        $.ajax({
            type: 'POST',
            url: '../Controlador/Tablero/actualizarEstadoHU.php',
            data: {
                numeroHU: numeroHU
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: 'La HU se ha movido a "En Progreso"',
                        showConfirmButton: true,
                        timer: 1500
                    }).then((result) => {
                        if (result.isConfirmed || result.isDismissed) {
                            location.reload();
                        }
                    });
                } else {
                    location.reload();
                }
            }
        });
    }
</script>

<!-- Mover a Terminado -->
<script>
    function finalizarHU(numeroHU) {
        $.ajax({
            type: 'POST',
            url: '../Controlador/Tablero/finalizarHU.php',
            data: {
                numeroHU: numeroHU
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: 'La HU se ha movido a "Terminado"',
                        showConfirmButton: true,
                        timer: 1500
                    }).then((result) => {
                        if (result.isConfirmed || result.isDismissed) {
                            location.reload();
                        }
                    });
                }
            }
        });
    }
</script>