<?php
session_start();
$usuario = $_SESSION['Usuario'];
?>

<head>
    <title>Dashboard: Datos proyecto</title>
    <script src="https://kit.fontawesome.com/be3b2da769.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../../assets/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="../../assets/css/MA/login.css">
    <link rel="stylesheet" href="../../assets/css/general.css">
</head>

<body>
    <?php include '../../alertas.php' ?>
    <div id="wrapper">
        <?php include '../Vista/SidebarSinCuenta.html'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light topbar" style="background-color: #2d3033;">
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" style="pointer-events: none;">
                                <span class="mr-2 d-lg-inline text-gray-300 large"><?php echo "$usuario" ?></span>
                                <i class="fa-solid fa-circle-user fa-2x"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="container">
                    <div class="col-ms-2">
                        <div class="card my-4">
                            <div class="p-1">
                                <div class="text-center">
                                    <h1 class="mb-2">Datos del proyecto</h1>
                                </div>
                                <hr>
                                <form action="Controlador/proyecto.php" method="POST">
                                    <div class="container">
                                        <div class="input-group input-group-sm mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Nombre del tablero</span>
                                            </div>
                                            <input REQUIRED type="text" class="form-control" name="NombreTablero">
                                        </div>
                                        <div class="input-group input-group-sm mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Total de Sprints</span>
                                            </div>
                                            <input REQUIRED type="number" min="1" max="30" class="form-control" name="TotalSprints">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Duración de cada Sprint</span>
                                            </div>
                                            <input REQUIRED type="number" min="1" max="30" class="form-control" name="DuracionSprint">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Duración</span>
                                            </div>
                                            <select REQUIRED class="form-control" name="Duracion">
                                                <option selected value="Dias">Días</option>
                                                <option value="Semanas">Semanas</option>
                                            </select>
                                        </div>
                                        <div class="input-group input-group-sm mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Número de desarrolladores</span>
                                            </div>
                                            <input REQUIRED type="number" min="1" max="30" class="form-control" name="Desarrolladores" id="numDesarrolladores">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Fecha inicio</span>
                                            </div>
                                            <input REQUIRED type="date" class="form-control" name="FechaIni">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Fecha fin</span>
                                            </div>
                                            <input REQUIRED type="date" class="form-control" name="FechaFin">
                                        </div>
                                        <hr>
                                        <h3 class="mb-2 text-center">Agregar personas</h3>
                                        <div id="contenedorInputs"></div>
                                    </div>
                                    <hr>
                                    <center><button type="submit" class="btn" id="iniciar">Crear tablero</button></center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include '../Vista/footer.html' ?>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Desarrolladores -->
<script>
    function upperCase() {
        var x = document.getElementById("datos").value
        document.getElementById("datos").value = x.toUpperCase()
    }

    function upperCase1() {
        var y = document.getElementById("datos1").value
        document.getElementById("datos1").value = y.toUpperCase()
    }

    $(document).ready(function() {
        $('#numDesarrolladores').on('input', function() {
            var numDesarrolladores = $(this).val();
            $('#contenedorInputs').empty(); // Limpiar el contenedor antes de agregar nuevos inputs

            for (var i = 0; i < numDesarrolladores; i++) {
                $('#contenedorInputs').append(`
                    <div class="input-group input-group-sm mb-2">
                        <input REQUIRED type="text" class="form-control" onblur="upperCase()" name="Nombres[]" placeholder="Nombre(s)" id="datos">
                        <input REQUIRED type="text" class="form-control" onblur="upperCase1()" name="Apellidos[]" placeholder="Apellidos" id="datos1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Email</span>
                        </div>
                        <input REQUIRED type="email" class="form-control" name="Correos[]" placeholder="cuenta@algo.com">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Usuario</span>
                        </div>
                        <input REQUIRED type="text" class="form-control" name="Usuarios[]">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rol</span>
                        </div>
                        <select REQUIRED class="form-control" name="Roles[]">
                            <option selected value="Desarrollador">Desarrollador</option>
                            <option value="Tester">Tester</option>
                            <option value="Analista de datos">Analista de datos</option>
                            <option value="Diseñador">Diseñador</option>
                        </select>
                    </div>
                `);
            }
        });
    });
</script>