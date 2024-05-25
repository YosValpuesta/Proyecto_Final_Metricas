<?php
session_start();
// Recuperar el valor de totalGeneral de la sesión
$pfsa = isset($_SESSION['totalGeneral']) ? $_SESSION['totalGeneral'] : 0;
?>

<head>
    <meta charset="utf-8">
    <title>CorsolaCorp: Factor de ajuste</title>
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
                    <h1 class="my-2 text-gray-900 text-center">Evaluar atributos de ajuste</h1>
                    <div class="container-fluid" id="tableRequisitos">
                        <table class="table table-hover">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Atributo</th>
                                    <th scope="col"></th>
                                    <th scope="col">Grado de influencia</th>
                                    <th scope="col" style="align-content: center;">
                                        <a href="#" data-toggle="modal" data-target="#infoGrados" style="color: white;">
                                            <i class="fa-solid fa-circle-question fa-xl"></i>
                                        </a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Comunicación de datos</td>
                                    <td class="text-center">Grado en que el sistema se comunica con otros sistemas</td>
                                    <td colspan="2">
                                        <select class="custom-select gradoInfluencia text-center">
                                            <option selected>Selecciona</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Procesamiento distribuido</td>
                                    <td class="text-center">Nivel de distribución de las funciones del sistema</td>
                                    <td colspan="2">
                                        <select class="custom-select gradoInfluencia text-center">
                                            <option selected>Selecciona</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Objetivos de rendimiento</td>
                                    <td class="text-center">Requisitos de rendimiento del sistema</td>
                                    <td colspan="2">
                                        <select class="custom-select gradoInfluencia text-center">
                                            <option selected>Selecciona</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>Configuración del equipamiento</td>
                                    <td class="text-center">Nivel de complejidad y configuración necesaria para el hardware y el software</td>
                                    <td colspan="2">
                                        <select class="custom-select gradoInfluencia text-center">
                                            <option selected>Selecciona</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td>Tasa de transacciones</td>
                                    <td class="text-center">Frecuencia y volumen de transacciones procesadas</td>
                                    <td colspan="2">
                                        <select class="custom-select gradoInfluencia text-center">
                                            <option selected>Selecciona</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">6</th>
                                    <td>Entrada de datos en línea</td>
                                    <td class="text-center">Cuantifica la entrada de datos on-line provista por la aplicación</td>
                                    <td colspan="2">
                                        <select class="custom-select gradoInfluencia text-center">
                                            <option selected>Selecciona</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">7</th>
                                    <td>Interfase con el usuario</td>
                                    <td class="text-center">Facilidad y eficiencia con la que los usuarios interactuan y utilizan el sistema</td>
                                    <td colspan="2">
                                        <select class="custom-select gradoInfluencia text-center">
                                            <option selected>Selecciona</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">8</th>
                                    <td>Actualización en línea</td>
                                    <td class="text-center">Capacidad del sistema para actualizar datos en tiempo real</td>
                                    <td colspan="2">
                                        <select class="custom-select gradoInfluencia text-center">
                                            <option selected>Selecciona</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">9</th>
                                    <td>Procesamiento complejo</td>
                                    <td class="text-center">Complejidad de los algoritmos y lógicas de procesamiento</td>
                                    <td colspan="2">
                                        <select class="custom-select gradoInfluencia text-center">
                                            <option selected>Selecciona</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">10</th>
                                    <td>Reusabilidad del código</td>
                                    <td class="text-center">Capacidad de reutilizar componentes del sistema</td>
                                    <td colspan="2">
                                        <select class="custom-select gradoInfluencia text-center">
                                            <option selected>Selecciona</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">11</th>
                                    <td>Facilidad de implementación</td>
                                    <td class="text-center">Facilidad con la que el sistema puede ser implementado</td>
                                    <td colspan="2">
                                        <select class="custom-select gradoInfluencia text-center">
                                            <option selected>Selecciona</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">12</th>
                                    <td>Facilidad de operación</td>
                                    <td class="text-center">Facilidad de operación y administración del sistema</td>
                                    <td colspan="2">
                                        <select class="custom-select gradoInfluencia text-center">
                                            <option selected>Selecciona</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">13</th>
                                    <td>Instalaciones múltiples</td>
                                    <td class="text-center">Soporte para múltiples instalaciones y entornos</td>
                                    <td colspan="2">
                                        <select class="custom-select gradoInfluencia text-center">
                                            <option selected>Selecciona</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">14</th>
                                    <td>Facilidad de cambios</td>
                                    <td class="text-center">Facilidad con la que el sistema puede ser modificado o actualizado</td>
                                    <td colspan="2">
                                        <select class="custom-select gradoInfluencia text-center">
                                            <option selected>Selecciona</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td class="table-success text-center">Total</td>
                                    <td colspan="2" class="table-success text-center" id="totalAtributos"></td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td class="table-success text-center">Factor de ajuste</td>
                                    <td colspan="2" class="table-success text-center" id="vfa"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h1 class="my-2 text-gray-900 text-center">Puntos de función ajustados</h1>
                    <div class="container-fluid" id="tableRequisitos">
                        <table class="table table-hover table-sm text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">PFSA</th>
                                    <th scope="col">VFA</th>
                                    <th scope="col">PFA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="pfsa"><?php echo $pfsa; ?></td>
                                    <td id="vfaAdjusted"></td>
                                    <td id="productoPFA" class="table-success"></td>
                                </tr>
                            </tbody>
                        </table>
                        <form action="5Estimaciones.php" method="post" id="formEstimaciones">
                            <input type="hidden" name="pfa" id="inputPFA">
                            <button type="button" class="btn btn-primary" onclick="calcularEstimaciones()">Calcular estimaciones</button>
                        </form>
                    </div>
                    <br>
                </div>
            </div>
            <?php include 'footer.html'; ?>
        </div>
    </div>
</body>

<!-- Modal info -->
<div class="modal fade" id="infoGrados" tabindex="-1" aria-labelledby="infoGradosLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="infoGradosLabel">Grados de Influencia</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">Estos grados se basan en la evaluación subjetiva de lo que se considera que tiene o requiere
                    el sistema en términos de características, requisitos y complejidad.</p>
                <center>
                    <table class="table table-sm text-center" style="width: 70%">
                        <thead class="thead-dark">
                            <th scope="col">#</th>
                            <th scope="col"></th>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">0</th>
                                <td>No incluye</td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>Influencia insignificante</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Influencia moderada</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Influencia media</td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>Influencia significativa</td>
                            </tr>
                            <tr>
                                <th scope="row">5</th>
                                <td>Influencia fuerte</td>
                            </tr>
                        </tbody>
                    </table>
                </center>
            </div>
        </div>
    </div>
</div>

<script>
    function calcularTotalPF() {
        let total = 0;
        document.querySelectorAll('.gradoInfluencia').forEach(select => {
            const value = parseInt(select.value);
            if (!isNaN(value)) {
                total += value;
            }
        });

        // Muestra el total en el elemento con id "totalAtributos"
        document.getElementById('totalAtributos').textContent = total;

        const vfa = (total * 0.01) + 0.65;

        document.getElementById('vfa').textContent = vfa.toFixed(2);

        document.getElementById('vfaAdjusted').textContent = vfa.toFixed(2);

        const pfsa = parseFloat(document.getElementById('pfsa').textContent);

        const producto = pfsa * vfa;
        document.getElementById('productoPFA').textContent = producto.toFixed(2);

        const pfa = parseFloat(document.getElementById('productoPFA').textContent);

        fetch('../Controlador/PFA.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    pfa: pfa
                }),
            })
            .then(response => {
                console.log('Valor de PFA enviado al servidor');
            })
            .catch(error => {
                console.error('Error al enviar el valor de PFA al servidor:', error);
            });
    }

    document.querySelectorAll('.gradoInfluencia').forEach(select => {
        select.addEventListener('change', calcularTotalPF);
    });

    calcularTotalPF();
</script>

<script>
    function calcularEstimaciones() {
        const pfa = parseFloat(document.getElementById('productoPFA').textContent);

        document.getElementById('inputPFA').value = pfa;

        document.cookie = `pfa=${pfa}; expires=Thu, 31 Dec 2026 23:59:59 UTC; path=/`;

        document.getElementById('formEstimaciones').submit();
    }
</script>