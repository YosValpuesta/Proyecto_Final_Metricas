<?php session_start() ?>

<head>
    <meta charset="utf-8">
    <title>CorsolaCorp: Complejidad</title>
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
                    <h1 class="my-2 text-gray-900 text-center">Identificar funcionalidad y complejidad</h1>
                    <div class="container-fluid" id="tableRequisitos">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Requisito</th>
                                    <th scope="col">Tipo de función</th>
                                    <th scope="col">DET</th>
                                    <th scope="col">FTR</th>
                                    <th scope="col">Complejidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_SESSION['requisitos'])) {
                                    foreach ($_SESSION['requisitos'] as $index => $requisito) { ?>
                                        <tr>
                                            <th scope="row"> <?php echo ($index + 1) ?></th>
                                            <td>
                                                <input type="text" class="form-control" name="nombre" disabled value="<?php echo htmlspecialchars($requisito) ?>">
                                            </td>
                                            <td>
                                                <select class="custom-select tipoFuncion" id="tipoFuncion<?php echo $index ?>">
                                                    <option selected>Selecciona</option>
                                                    <optgroup label="Función transaccional">
                                                        <option value="EI">Entrada Externa (EI)</option>
                                                        <option value="EO">Salida Externa (EO)</option>
                                                        <option value="EQ">Consulta Externa (EQ)</option>
                                                    </optgroup>
                                                    <optgroup label="Función de datos">
                                                        <option value="ILF">Fichero lógico interno (ILF)</option>
                                                        <option value="EIF">Fichero externo de interfaz (EIF)</option>
                                                    </optgroup>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" name="DET" min="1">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" name="FTR" min="1">
                                            </td>
                                            <td class="complejidad" id="complejidad<?php echo $index ?>"></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="container my-2">
                        <div class="row">
                            <div class="col-12">
                                <a type="button" class="btn btn-primary btn-sm" href="3PFSA.php">
                                    Calcular Puntos de función
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const selects = document.querySelectorAll(".tipoFuncion");
        const detInputs = document.querySelectorAll(".form-control[name='DET']");
        const ftrInputs = document.querySelectorAll(".form-control[name='FTR']");
        const complejidadCells = document.querySelectorAll(".complejidad");

        const calcularComplejidad = (index) => {
            const tipoFuncion = selects[index].value;
            const det = parseInt(detInputs[index].value);
            const ftr = parseInt(ftrInputs[index].value);
            let complejidad = "Complejidad desconocida";

            if (tipoFuncion === "ILF" || tipoFuncion === "EIF") {
                if (det >= 1 && det <= 19) {
                    if (ftr === 1)
                        complejidad = "Baja";
                    else if (ftr >= 2 && ftr <= 5)
                        complejidad = "Baja";
                    else if (ftr >= 6)
                        complejidad = "Media";
                } else if (det >= 20 && det <= 50) {
                    if (ftr === 1)
                        complejidad = "Baja";
                    else if (ftr >= 2 && ftr <= 5)
                        complejidad = "Media";
                    else if (ftr >= 6)
                        complejidad = "Alta";
                } else if (det >= 51) {
                    if (ftr === 1)
                        complejidad = "Media";
                    else if (ftr >= 2 && ftr <= 5)
                        complejidad = "Alta";
                    else if (ftr >= 6)
                        complejidad = "Alta";
                }
            } else if (tipoFuncion === "EO" || tipoFuncion === "EQ") {
                if (det >= 1 && det <= 5) {
                    if (ftr >= 0 && ftr <= 1)
                        complejidad = "Baja";
                    else if (ftr >= 2 && ftr <= 3)
                        complejidad = "Baja";
                    else if (ftr >= 4)
                        complejidad = "Media";
                } else if (det >= 6 && det <= 19) {
                    if (ftr >= 0 && ftr <= 1)
                        complejidad = "Baja";
                    else if (ftr >= 2 && ftr <= 3)
                        complejidad = "Media";
                    else if (ftr >= 4)
                        complejidad = "Alta";
                } else if (det >= 20) {
                    if (ftr >= 0 && ftr <= 1)
                        complejidad = "Media";
                    else if (ftr >= 2 && ftr <= 3)
                        complejidad = "Alta";
                    else if (ftr >= 4)
                        complejidad = "Alta";
                }
            } else if (tipoFuncion === "EI") {
                if (det >= 1 && det <= 4) {
                    if (ftr >= 0 && ftr <= 1)
                        complejidad = "Baja";
                    else if (ftr >= 2 && ftr <= 3)
                        complejidad = "Baja";
                    else if (ftr >= 3)
                        complejidad = "Media";
                } else if (det >= 5 && det <= 15) {
                    if (ftr >= 0 && ftr <= 1)
                        complejidad = "Baja";
                    else if (ftr >= 2 && ftr <= 3)
                        complejidad = "Media";
                    else if (ftr >= 3)
                        complejidad = "Alta";
                } else if (det >= 16) {
                    if (ftr >= 0 && ftr <= 1)
                        complejidad = "Media";
                    else if (ftr >= 2 && ftr <= 3)
                        complejidad = "Alta";
                    else if (ftr >= 3)
                        complejidad = "Alta";
                }
            }
            return complejidad;
        };

        const guardarDatosEnSesion = (index, nombre, tipoFuncion, det, ftr, complejidad) => {
            if (nombre && tipoFuncion && !isNaN(det) && !isNaN(ftr) && complejidad) {
                // Solo guardar datos válidos en la sesión
                $.post('../Controlador/Complejidad/guardarDatos.php', {
                    index: index,
                    nombre: nombre,
                    tipoFuncion: tipoFuncion,
                    det: det,
                    ftr: ftr,
                    complejidad: complejidad
                }, function(response) {
                    if (response.status === 'success') {
                        console.log('Datos guardados en sesión exitosamente');
                    } else {
                        console.log('Error al guardar los datos en sesión');
                    }
                }, 'json');
            }
        };

        // Escuchador de eventos para todos los elementos relevantes
        selects.forEach((select, index) => {
            select.addEventListener("change", () => {
                const nombre = document.querySelectorAll(".form-control[name='nombre']")[index].value;
                const tipoFuncion = select.value;
                const det = parseInt(detInputs[index].value);
                const ftr = parseInt(ftrInputs[index].value);
                const complejidad = calcularComplejidad(index);
                complejidadCells[index].textContent = complejidad;
                guardarDatosEnSesion(index, nombre, tipoFuncion, det, ftr, complejidad);
            });

            detInputs[index].addEventListener("input", () => {
                const nombre = document.querySelectorAll(".form-control[name='nombre']")[index].value;
                const tipoFuncion = selects[index].value;
                const det = parseInt(detInputs[index].value);
                const ftr = parseInt(ftrInputs[index].value);
                const complejidad = calcularComplejidad(index);
                complejidadCells[index].textContent = complejidad;
                guardarDatosEnSesion(index, nombre, tipoFuncion, det, ftr, complejidad);
            });

            ftrInputs[index].addEventListener("input", () => {
                const nombre = document.querySelectorAll(".form-control[name='nombre']")[index].value;
                const tipoFuncion = selects[index].value;
                const det = parseInt(detInputs[index].value);
                const ftr = parseInt(ftrInputs[index].value);
                const complejidad = calcularComplejidad(index);
                complejidadCells[index].textContent = complejidad;
                guardarDatosEnSesion(index, nombre, tipoFuncion, det, ftr, complejidad);
            });
        });
    });
</script>