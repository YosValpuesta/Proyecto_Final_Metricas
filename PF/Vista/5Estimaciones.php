<?php
if (isset($_COOKIE['pfa'])) {
    $pfa = floatval($_COOKIE['pfa']);
}
?>

<head>
    <meta charset="utf-8">
    <title>CorsolaCorp: Estimaciones</title>
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
                    <h1 class="my-2 text-gray-900 text-center">Estimaciones del proyecto</h1>
                    <div class="container-fluid" id="tableRequisitos">
                        <em><b>
                                <h5>Estimación de Esfuerzo <i class="fa-solid fa-computer"></i></h5>
                            </b></em>
                        <p>Cantidad total de trabajo que se requiere para completar el proyecto.
                            Ayuda a calcular la duración y personal necesario</p>
                        <form id="formEstimacionEsfuerzo">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="mr-3 d-lg-inline large">
                                                Característica
                                            </span>
                                        </div>
                                    </div>
                                    <select REQUIRED class="form-control text-center" id="caracteristicaEsfuerzo" name="caracteristicaEsfuerzo">
                                        <option value="MF">MF</option>
                                        <option value="MR">MR</option>
                                        <option value="PC">PC</option>
                                        <option value="Multi">Multi</option>
                                        <option value="3GL">3GL</option>
                                        <option value="4GL">4GL</option>
                                        <option value="GenAp">GenAp</option>
                                        <option value="Multi-3GL">Multi-3GL</option>
                                        <option value="Multi-4GL">Multi-4GL</option>
                                    </select>
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <a href="#" data-toggle="modal" data-target="#infoFactores">
                                                <i class="fa-solid fa-circle-question fa-xl"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-hover table-sm text-center">
                                <thead class="thead-dark text-center">
                                    <tr>
                                        <th scope="col">Formula</th>
                                        <th scope="col">Valor C</th>
                                        <th scope="col">Valor E</th>
                                        <th scope="col">PF</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Esfuerzo = C * PF<sup>E</sup></td>
                                        <td id="valorC"></td>
                                        <td id="valorE"></td>
                                        <td id="pfEsfuerzo" name="pfEsfuerzo"><?php echo $pfa; ?></td>
                                    </tr>
                                    <tr class="table-warning">
                                        <td colspan="4" id="resultadoEsfuerzo"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-warning btn-sm">Calcular Esfuerzo</button>
                        </form>
                    </div>
                    <hr>
                    <div class="container-fluid" id="tableRequisitos">
                        <em><b>
                                <h5>Estimación de Duración <i class="fa-regular fa-calendar"></i></h5>
                            </b></em>
                        <p>Tiempo estimado para completar el proyecto, expresado en meses.</p>
                        <form id="formEstimacionDuracion">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="mr-3 d-lg-inline large">
                                                Característica
                                            </span>
                                        </div>
                                    </div>
                                    <select class="form-control" id="caracteristicaDuracion" name="caracteristicaDuracion">
                                        <option value="PC">PC</option>
                                        <option value="Multi">Multi</option>
                                        <option value="4GL">4GL</option>
                                        <option value="Nuevo">Nuevo</option>
                                        <option value="PC-4GL">PC-4GL</option>
                                        <option value="Multi-4G">Multi-4G</option>
                                        <option value="PC-4GL-Nuevo">PC-4GL-Nuevo</option>
                                        <option value="Multi-4GL-Nuevo">Multi-4GL-Nuevo</option>
                                        <option value="GenAp">GenAp</option>
                                        <option value="Multi-3GL">Multi-3GL</option>
                                        <option value="Multi-4GL">Multi-4GL</option>
                                    </select>
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <a href="#" data-toggle="modal" data-target="#infoFactores">
                                                <i class="fa-solid fa-circle-question fa-xl"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-hover table-sm text-center">
                                <thead class="thead-dark text-center">
                                    <tr>
                                        <th scope="col">Formula</th>
                                        <th scope="col">Valor C</th>
                                        <th scope="col">Valor E</th>
                                        <th scope="col" colspan="2">PF</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Duración = C * PF<sup>E</sup></td>
                                        <td id="valorCDuracion"></td>
                                        <td id="valorEDuracion"></td>
                                        <td id="pfDuracion" name="pfDuracion" colspan="2"><?php echo $pfa; ?></td>
                                    </tr>
                                    <tr class="table-warning">
                                        <td colspan="4" id="resultadoDuracion"></td>
                                        <td>Meses</td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-warning btn-sm">Calcular Duración</button>
                        </form>
                    </div>
                    <hr>
                    <div class="container-fluid" id="tableRequisitos">
                        <em><b>
                                <h5>Estimación de Cantidad de Personas <i class="fa-solid fa-users"></i></h5>
                            </b></em>
                        <p>Se puede conocer el número de personas que se estima podrían trabajar en el proyecto.</p>
                        <table class="table table-hover table-sm text-center">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th scope="col">Formula</th>
                                    <th scope="col">Esfuerzo</th>
                                    <th scope="col">Duración</th>
                                    <th scope="col">Días</th>
                                    <th scope="col" colspan="2">Horas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Personas = Esfuerzo / (Duración * Días trabajados * Horas)</td>
                                    <td id="esfuerzoTotal">0</td>
                                    <td id="duracionTotal">0</td>
                                    <td><input class="form-control" type="number" id="diasTrabajados" min="1" max="31"></td>
                                    <td colspan="2"><input class="form-control" type="number" id="horasTrabajadas" min="1"></td>
                                </tr>
                                <tr class="table-warning">
                                    <td colspan="5" id="totalPersonas"></td>
                                    <td>Personas</td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" id="calcularPersonas" class="btn btn-warning btn-sm">Calcular Personas</button>
                    </div>
                    <hr>
                    <div class="container-fluid" id="tableRequisitos">
                        <em><b>
                                <h5>Estimación de Costo <i class="fa-solid fa-money-bill"></i></h5>
                            </b></em>
                        <p>Se utilizará el valor medio del costo por hora en $, información que proporcionará el jefe del proyecto o un medio de información confiable</p>
                        <table class="table table-hover table-sm text-center">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th scope="col">Formula</th>
                                    <th scope="col">Esfuerzo</th>
                                    <th scope="col">Costo Medio por Hora (MXN):</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Costo = Esfuerzo * CostoMedioHora</td>
                                    <td id="esfuerzoTotalCosto">0</td>
                                    <td><input class="form-control" type="number" id="costoPromedio" min="1" max="1000"></td>
                                </tr>
                                <tr class="table-warning">
                                    <td colspan="3" id="totalCosto"></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" id="calcularCosto" class="btn btn-warning btn-sm">Calcular Costo</button>
                    </div>
                    <br>
                    <div class="row my-2">
                        <div class="col-6">
                            <button type="button" id="reporte" class="btn btn-success">Reporte</button>
                        </div>
                        <div class="col-6">
                            <button type="button" id="reset" class="btn btn-danger">Finalizar estimación</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'footer.html' ?>
        </div>
    </div>
</body>

<!-- Calculo de todo -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Definición de valores para estimación de esfuerzo
        const caracteristicasEsfuerzo = {
            MF: {
                C: 49.02,
                E: 0.736
            },
            MR: {
                C: 78.08,
                E: 0.937
            },
            PC: {
                C: 36.24,
                E: 1.02
            },
            Multi: {
                C: 35.49,
                E: 1.049
            },
            '3GL': {
                C: 22.5,
                E: 1.25
            },
            '4GL': {
                C: 13.75,
                E: 1.08
            },
            GenAp: {
                C: 68.11,
                E: 0.66
            },
            'Multi-3GL': {
                C: 19.82,
                E: 0.666
            },
            'Multi-4GL': {
                C: 6.49,
                E: 0.983
            }
        };

        // Definición de valores para estimación de duración
        const caracteristicasDuracion = {
            PC: {
                C: 0.503,
                E: 0.409
            },
            Multi: {
                C: 0.679,
                E: 0.341
            },
            '4GL': {
                C: 0.578,
                E: 0.393
            },
            Nuevo: {
                C: 0.739,
                E: 0.359
            },
            'PC-4GL': {
                C: 0.348,
                E: 0.471
            },
            'Multi-4G': {
                C: 0.366,
                E: 0.451
            },
            'PC-4GL-Nuevo': {
                C: 0.25,
                E: 0.515
            },
            'Multi-4GL-Nuevo': {
                C: 0.24,
                E: 0.518
            },
            GenAp: {
                C: 68.11,
                E: 0.66
            },
            'Multi-3GL': {
                C: 19.82,
                E: 0.666
            },
            'Multi-4GL': {
                C: 6.49,
                E: 0.983
            }
        };

        let esfuerzoTotal = 0;
        let duracionTotal = 0;

        // Función para actualizar los valores de C y E en la tabla de esfuerzo
        function actualizarValoresEsfuerzo(C, E) {
            document.getElementById('valorC').innerText = C;
            document.getElementById('valorE').innerText = E;
            const caracteristica = document.getElementById('caracteristicaEsfuerzo').value;
            const PF = parseFloat(document.getElementById('pfEsfuerzo').innerText);
            const esfuerzo = C * Math.pow(PF, E);
            esfuerzoTotal = esfuerzo;
            document.getElementById('resultadoEsfuerzo').innerText = ` ${esfuerzo.toFixed(2)}`;
            document.getElementById('esfuerzoTotal').innerText = esfuerzoTotal.toFixed(2);
            document.getElementById('esfuerzoTotalCosto').innerText = esfuerzoTotal.toFixed(2);
        }

        // Función para actualizar los valores de C y E en la tabla de duración
        function actualizarValoresDuracion(C, E) {
            document.getElementById('valorCDuracion').innerText = C;
            document.getElementById('valorEDuracion').innerText = E;
            const caracteristica = document.getElementById('caracteristicaDuracion').value;
            const PF = parseFloat(document.getElementById('pfDuracion').innerText);
            const duracion = C * Math.pow(PF, E);
            duracionTotal = duracion;
            document.getElementById('resultadoDuracion').innerText = ` ${duracion.toFixed(2)} `;
            document.getElementById('duracionTotal').innerText = duracionTotal.toFixed(2);
        }

        // Evento para el formulario de estimación de esfuerzo
        document.getElementById('formEstimacionEsfuerzo').addEventListener('submit', function(event) {
            event.preventDefault();
            const caracteristica = document.getElementById('caracteristicaEsfuerzo').value;
            const {
                C,
                E
            } = caracteristicasEsfuerzo[caracteristica];
            const PF = parseFloat(document.getElementById('pfEsfuerzo').innerText);
            const esfuerzo = C * Math.pow(PF, E);
            actualizarValoresEsfuerzo(C, E);
        });

        function actualizarValoresDuracion(C, E) {
            document.getElementById('valorCDuracion').innerText = C;
            document.getElementById('valorEDuracion').innerText = E;
            const PF = parseFloat(document.getElementById('pfDuracion').innerText);
            const duracion = C * Math.pow(PF, E);
            duracionTotal = duracion;
            document.getElementById('resultadoDuracion').innerText = ` ${duracion.toFixed(2)} `;
            document.getElementById('duracionTotal').innerText = duracionTotal.toFixed(2);
        }

        document.getElementById('formEstimacionDuracion').addEventListener('submit', function(event) {
            event.preventDefault();
            const caracteristica = document.getElementById('caracteristicaDuracion').value;
            const {
                C,
                E
            } = caracteristicasDuracion[caracteristica];
            actualizarValoresDuracion(C, E);
        });

        // Evento para el botón de calcular personas
        document.getElementById('calcularPersonas').addEventListener('click', function() {
            const diasTrabajados = parseInt(document.getElementById('diasTrabajados').value);
            const horasTrabajadas = parseInt(document.getElementById('horasTrabajadas').value);

            if (!isNaN(diasTrabajados) && !isNaN(horasTrabajadas) && diasTrabajados > 0 && horasTrabajadas > 0) {
                if (esfuerzoTotal > 0 && duracionTotal > 0) {
                    const personas = esfuerzoTotal / (duracionTotal * diasTrabajados * horasTrabajadas);
                    document.getElementById('totalPersonas').innerText = `${personas.toFixed(2)}`;
                } else {
                    document.getElementById('totalPersonas').innerText = 'Por favor, calcula primero el esfuerzo y la duración.';
                }
            } else {
                document.getElementById('totalPersonas').innerText = 'Por favor, ingresa valores válidos para los días y las horas trabajadas.';
            }
        });

        // Evento para el botón de calcular costo
        document.getElementById('calcularCosto').addEventListener('click', function() {
            const esfuerzoTotal = parseFloat(document.getElementById('esfuerzoTotal').innerText);
            const costoPromedio = parseFloat(document.getElementById('costoPromedio').value);

            if (!isNaN(esfuerzoTotal) && !isNaN(costoPromedio) && costoPromedio > 0) {
                const costoTotal = esfuerzoTotal * costoPromedio;
                document.getElementById('totalCosto').innerText = `$${costoTotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")} MXN`;
                document.getElementById('costoEstimado').innerText = `$${costoTotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")} MXN`;
            } else {
                document.getElementById('totalCosto').innerText = 'Por favor, ingresa un costo promedio válido.';
                document.getElementById('costoEstimado').innerText = '';
            }
        });

        document.getElementById('reporte').addEventListener('click', function() {
            // Obtener los valores de las estimaciones
            const esfuerzoTotal = document.getElementById('esfuerzoTotalCosto').innerText;
            const duracionTotal = document.getElementById('resultadoDuracion').innerText;
            const cantidadPersonas = document.getElementById('totalPersonas').innerText;
            const costoEstimado = document.getElementById('totalCosto').innerText;

            // Guardar los valores en la sesión utilizando una petición AJAX
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../Controlador/guardarEstimaciones.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Redireccionar a la página reporte.php
                    window.location.href = `Reporte.php?esfuerzo=${encodeURIComponent(esfuerzoTotal)}&duracion=${encodeURIComponent(duracionTotal)}&personas=${encodeURIComponent(cantidadPersonas)}&costo=${encodeURIComponent(costoEstimado)}`;
                }
            };
            xhr.send(`esfuerzo=${encodeURIComponent(esfuerzoTotal)}&duracion=${encodeURIComponent(duracionTotal)}&personas=${encodeURIComponent(cantidadPersonas)}&costo=${encodeURIComponent(costoEstimado)}`);
        });

        document.getElementById('reset').addEventListener('click', function() {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../Controlador/Complejidad/borrarDatos.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    console.log("AJAX request completed with status: " + xhr.status);
                    if (xhr.status === 200) {
                        try {
                            const response = JSON.parse(xhr.responseText);
                            console.log("Response: ", response);
                            if (response.status === 'success') {
                                console.log("Redirection triggered");
                                window.location.href = 'indexPF.php'; 
                            } else {
                                console.error("Error in response status: ", response);
                            }
                        } catch (e) {
                            console.error("Error parsing JSON response: ", e);
                        }
                    } else {
                        console.error("AJAX request failed with status: " + xhr.status);
                    }
                }
            };
            xhr.send();
        });
    });
</script>

<!-- Modal info -->
<div class="modal fade" id="infoFactores" tabindex="-1" aria-labelledby="infoFactoresLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"">
        <div class=" modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p class="text-center"><b><em>Los valores de C y E son factores que se utilizan para ajustar las estimaciones
                        según diferentes características del proyecto y el entorno de desarrollo.</em></b></p>
            <ul>
                <li><b>MF (Midrange):</b> Proyectos que se desarrollan para sistemas de rango medio.</li>
                <li><b>MR (Mainframe):</b> Proyectos que se desarrollan para ejecutarse en sistemas mainframe.</li>
                <li><b>PC (Personal Computer):</b> Proyectos desarrollados para ejecutarse en computadoras personales.</li>
                <li><b>Multi (Multiplatform):</b> Proyectos que deben ejecutarse en múltiples plataformas o entornos.</li>
                <li><b>3GL:</b> Lenguajes de tercera generación como COBOL, FORTRAN, C y Java.</li>
                <li><b>4GL:</b> Lenguajes de cuarta generación como SQL, MATLAB y herramientas de desarrollo de aplicaciones de bases de datos.</li>
                <li><b>GenAp:</b> Aplicaciones generales que no tienen una especialización específica en términos de tipo de sistema o entorno operativo.</li>
                <li><b>Multi-3GL:</b> Proyectos que se desarrollan utilizando múltiples lenguajes de tercera generación.</li>
                <li><b>Multi-4GL:</b> Proyectos que se desarrollan utilizando múltiples lenguajes de cuarta generación.</li>
            </ul>
        </div>
    </div>
</div>