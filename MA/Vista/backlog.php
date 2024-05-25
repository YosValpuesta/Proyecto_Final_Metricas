<?php
session_start();
include '../ConexionBD/conexion.php';

$historiasUsuario = "SELECT * FROM hu";
$resultado = $conexion->query($historiasUsuario);

$queryUsuarios = "SELECT Usuario FROM usuarios";
$resultadoUsuarios = $conexion->query($queryUsuarios) or die($conexion->error);

$querySprints = $conexion->query("SELECT TotalSprint FROM tablero") or die($conexion->error);
$mostrarSprint = mysqli_fetch_array($querySprints);
$totalSprints = $mostrarSprint['TotalSprint'];

?>

<head>
    <meta charset="utf-8">
    <title>CorsolaCorp: Backlog</title>
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../assets/css/general.css" rel="stylesheet">
    <link href="../../assets/css/MA/backlog.css" rel="stylesheet">
</head>

<body id="page-top">
    <?php include '../../alertas.php' ?>
    <div id="wrapper">
        <?php include 'Sidebar.html' ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'navPrincipal.php' ?>
                <div class="container-fluid text-center">
                    <h1 class="my-2 text-gray-900 text-center">Backlog</h1>
                    <div class="container-fluid" id="backlog">
                        <div class="row">
                            <?php
                            while ($mostrar = $resultado->fetch_assoc()) {
                            ?>
                                <div class="col-sm-3" data-sprint="<?php echo $mostrar["Sprint"]; ?>" style="padding: 5px;">
                                    <div class="card" id="HU">
                                        <div class="card-body" style="padding: 5%;">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <a href="../Controlador/Backlog/añadirTablero.php?numeroHU=<?php echo $mostrar['numeroHU'] ?>" title="Agregar Tablero"><img src="../../assets/img/add.png" style="width: 32px;"></i></a>
                                                </div>
                                                <div class="col-sm-8">
                                                    <h6><i>HU:</i> <?php echo $mostrar["numeroHU"]; ?></h6>
                                                </div>
                                                <div class="col-sm-2">
                                                    <a href="" data-toggle="modal" data-target="#modalModificar<?php echo $mostrar['numeroHU']; ?>" title="Modificar"><i class="fa-solid fa-pen-to-square"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <li id="HU" class="list-group-item"><?php echo $mostrar["Nombre"]; ?></li>
                                        <li id="HU" class="list-group-item"><i>PH:</i> <?php echo $mostrar["PH"]; ?> &nbsp;&nbsp; <i>Sprint:</i> <?php echo $mostrar["Sprint"]; ?></li>
                                        <li id="HU" class="list-group-item"><i>Responsable: <br> </i> <?php echo $mostrar["Responsable"]; ?></li>
                                    </div>
                                </div>
                            <?php
                                include 'modalHU.php';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <button id="agregarHU" type="button" class="my-2 btn btn-sm btn-warning" data-toggle="modal" data-target="#nuevaHU">
                                Agregar Historia de usuario
                            </button>
                        </div>
                        <div class="col-4">
                            <button id="agregarHU" type="button" class="my-2 btn btn-sm btn-primary filter-btn" data-filter="all">
                                Mostrar todas las HU
                            </button>
                        </div>
                        <div class="col-4">
                            <button id="agregarHU" type="button" class="my-2 btn btn-sm btn-warning" data-toggle="modal" data-target="#modalFiltrarSprint">
                                Filtar HU por Sprint
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'footer.html' ?>
        </div>
    </div>
</body>

<!-- Filtro de HU -->
<script>
    $(document).ready(function() {
        $('.filter-btn').on('click', function() {
            var filter = $(this).data('filter');
            filtrarHU(filter);
        });
    });

    function filtrarHU(filter) {
        $('#backlog .col-sm-3').each(function() {
            var sprintHU = $(this).data('sprint');
            if (filter === 'all' || sprintHU == filter) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    $(document).ready(function() {
        $('.filter-btn').on('click', function() {
            var filter = $(this).data('filter');
            filtrarHU(filter);
            $('#modalFiltrarSprint').modal('hide'); // Cierra el modal
        });
    });
</script>

<!-- Modal para nueva HU -->
<div class="modal fade" id="nuevaHU" tabindex="-1" aria-labelledby="nuevaHULabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Historia de usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../Controlador/Backlog/insertarHU.php" method="POST">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Nombre</span>
                        </div>
                        <input REQUIRED type="text" class="form-control" name="NombreHU">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">PH</span>
                        </div>
                        <select REQUIRED class="form-control" name="PH">
                            <option selected value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="5">5</option>
                            <option value="8">8</option>
                            <option value="13">13</option>
                            <option value="20">20</option>
                            <option value="40">40</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Responsable</span>
                        </div>
                        <select REQUIRED class="form-control" name="ResponsableHU">
                            <?php
                            while ($filaUsuario = $resultadoUsuarios->fetch_assoc()) { ?>
                                <option value="<?php echo $filaUsuario['Usuario'] ?>"><?php echo $filaUsuario['Usuario'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Sprint</span>
                        </div>
                        <select REQUIRED class="form-control" name="SprintHU">
                            <?php for ($i = 1; $i <= $totalSprints; $i++) { ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" id="insertarHU" class="btn btn-dark">Agregar a Backlog</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>