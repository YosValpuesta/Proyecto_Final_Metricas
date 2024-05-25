<?php session_start(); ?>

<head>
    <meta charset="utf-8">
    <title>CorsolaCorp: Funcionalidades</title>
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../assets/css/general.css" rel="stylesheet">
    <link href="../../assets/css/PF/requisitos.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include 'Sidebar.html'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'navPrincipal.php' ?>
                <div class="container-fluid text-center">
                    <h1 class="my-2 text-gray-900 text-center">Listado de funcionalidades</h1>
                    <div class="container-fluid" id="tableRequisitos">
                        <div class="row" id="contenedorRequisitos">
                            <?php
                            if (isset($_SESSION['requisitos'])) {
                                foreach ($_SESSION['requisitos'] as $index => $requisito) { ?>
                                    <div class="col-4">
                                        <div class="card">
                                            <div class="card-header" style="background-color: black;">
                                                <?php echo  htmlspecialchars($requisito)  ?>
                                            </div>
                                            <div class="card-footer text-muted" style="background-color: black;">
                                                <button class="btn btn-danger btn-sm" onclick="eliminarRequisito(<?php echo $index; ?>)">Eliminar</button>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <button type="button" class="btn btn-dark my-2" data-toggle="modal" data-target="#archivoModal">
                        Subir archivo
                    </button>
                    <button type="button" class="btn btn-primary my-2" id="btnAgregarRequisito" data-toggle="modal" data-target="#agregarRequisitoModal">
                        Agregar requisito
                    </button>
                    <a type="button" class="btn btn-primary my-2" href="2Complejidad.php">
                        Calcular complejidad
                    </a>
                </div>
            </div>
            <?php include 'footer.html'; ?>
        </div>
    </div>
</body>

<!-- Modal para subir archivo -->
<div class="modal fade" id="archivoModal" tabindex="-1" role="dialog" aria-labelledby="archivoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="archivoModalLabel">Subir archivo de requisitos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="uploadForm" action="../Controlador/Requisitos/archivoCargar.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="file" class="form-control-file" id="fileInput" name="requisitosArchivo" accept=".txt" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" form="uploadForm" class="btn btn-primary">Subir</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para agregar requisito -->
<div class="modal fade" id="agregarRequisitoModal" tabindex="-1" role="dialog" aria-labelledby="agregarRequisitoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarRequisitoModalLabel">Agregar nuevo requisito</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Nombre</span>
                    </div>
                    <input type="text" class="form-control" id="txtNuevoRequisito">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnGuardarRequisito">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Agrega Requisito -->
<script>
    document.getElementById('btnGuardarRequisito').addEventListener('click', function() {
        var nuevoRequisito = document.getElementById('txtNuevoRequisito').value;
        if (nuevoRequisito.trim() !== '') {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    window.location.reload();
                }
            };
            xhr.open('POST', '../Controlador/Requisitos/agregarRequisito.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('nuevoRequisito=' + encodeURIComponent(nuevoRequisito));
        }
    });
</script>

<!-- Elimina Requisito -->
<script>
    function eliminarRequisito(index) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                window.location.reload();
            }
        };
        xhr.open('POST', '../Controlador/Requisitos/eliminarRequisito.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('index=' + encodeURIComponent(index));
    }
</script>