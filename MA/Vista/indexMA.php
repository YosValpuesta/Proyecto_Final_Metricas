<?php
session_start();
include '../ConexionBD/conexion.php';
include '../Controlador/Metricas/cycleTime.php';
include '../Controlador/Metricas/leadTime.php';

$resultado = $conexion->query("SELECT * FROM tablero") or die($conexion->error);
$mostrar = mysqli_fetch_array($resultado);

//Conteo HU
$queryConteoHU = $conexion->query("SELECT COUNT(*) AS totalHU FROM hu") or die($conexion->error);
$resultadoConteoHU = $queryConteoHU->fetch_assoc();
$totalHU = $resultadoConteoHU['totalHU'];
?>

<head>
    <meta charset="utf-8">
    <title>CorsolaCorp: Dashboard</title>
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../assets/css/general.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body id="page-top">
    <?php include '../../alertas.php' ?>
    <div id="wrapper">
        <?php include 'Sidebar.html'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'navPrincipal.php' ?>
                <div class="container-fluid">
                    <div class="text-center">
                        <h1 class="mb-0 my-2 text-gray-900">"<?php echo $mostrar["Nombre"]; ?>"</h1>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Backlog</div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $totalHU; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">N° Sprints</div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                                <li><?php echo $mostrar["TotalSprint"] ?> Sprints</li>
                                                <li><?php echo $mostrar["DuracionSprint"] ?> <?php echo $mostrar["Duracion"] ?> c/u</li>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Equipo desarrollo</div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                                <li><?php echo $mostrar["Desarrolladores"] ?> Personas</li>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Duración proyecto</div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                                <li><?php echo $mostrar["FechaInicio"] ?></li>
                                                <li><?php echo $mostrar["FechaFin"] ?></li>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <h3 class="text-center">LeadTime</h3>
                            <canvas id="leadTimeChart" width="400" height="200" style="background-color: #16253d;"></canvas>
                            <script>
                                const ctx = document.getElementById('leadTimeChart').getContext('2d');
                                const leadTimesData = <?php echo json_encode($leadTimes); ?>;
                                const numerosHU = <?php echo json_encode(array_keys($leadTimes)); ?>;
                                const labels = numerosHU.map(numero => 'HU ' + numero);

                                const leadTimesArray = Object.values(leadTimesData);
                                const leadTimesSum = leadTimesArray.reduce((acc, curr) => acc + curr, 0);
                                const leadTimesAverage = leadTimesSum / leadTimesArray.length;

                                const leadTimesAverageArray = Array.from({
                                    length: leadTimesArray.length
                                }, () => leadTimesAverage);

                                const data = {
                                    labels: labels,
                                    datasets: [{
                                        label: 'LeadTime de HU',
                                        data: leadTimesArray,
                                        fill: false,
                                        borderColor: '#efb509',
                                        backgroundColor: '#efb509',
                                        tension: 0.1
                                    }, {
                                        label: 'Promedio de Lead Time',
                                        data: leadTimesAverageArray,
                                        fill: false,
                                        borderColor: '#cd7213',
                                        borderDash: [5, 5],
                                        tension: 0.1
                                    }]
                                };

                                const leadTimeChart = new Chart(ctx, {
                                    type: 'line',
                                    data: data,
                                    options: {
                                        scales: {
                                            x: {
                                                title: {
                                                    display: true,
                                                    text: 'Número de HU',
                                                    color: 'white'
                                                },
                                                ticks: {
                                                    color: 'white',
                                                }
                                            },
                                            y: {
                                                title: {
                                                    display: true,
                                                    text: 'Días de LeadTime de HU',
                                                    color: 'white'
                                                },
                                                ticks: {
                                                    color: 'white',
                                                }
                                            }
                                        },
                                        plugins: {
                                            legend: {
                                                labels: {
                                                    color: 'white',

                                                }
                                            },
                                            tooltip: {
                                                callbacks: {
                                                    label: function(context) {
                                                        const dataIndex = context.dataIndex;
                                                        const numeroHU = numerosHU[dataIndex];
                                                        return 'HU ' + numeroHU + ': ' + context.parsed.y + ' días';
                                                    }
                                                }
                                            }
                                        }
                                    }
                                });
                            </script>
                        </div>
                        <div class="col-6">
                            <h3 class="text-center">CycleTime</h3>
                            <canvas id="cycleTimeChart" width="400" height="200" style="background-color: #16253d;"></canvas>
                            <script>
                                const ctx1 = document.getElementById('cycleTimeChart').getContext('2d');
                                const cycleTimesData = <?php echo json_encode($cycleTimes); ?>;
                                const numerosHU1 = <?php echo json_encode(array_keys($cycleTimes)); ?>;
                                const labels1 = numerosHU.map(numero => 'HU ' + numero);
                                const cycleTimesArray = Object.values(cycleTimesData);
                                const cycleTimesSum = cycleTimesArray.reduce((acc, curr) => acc + curr, 0);
                                const cycleTimesAverage = cycleTimesSum / cycleTimesArray.length;

                                const cycleTimesAverageArray = Array.from({
                                    length: cycleTimesArray.length
                                }, () => cycleTimesAverage);

                                const data1 = {
                                    labels: labels1,
                                    datasets: [{
                                        label: 'CycleTime de HU',
                                        data: cycleTimesArray,
                                        fill: false,
                                        borderColor: '#efb509',
                                        backgroundColor: '#efb509',
                                        tension: 0.1
                                    }, {
                                        label: 'Promedio de CycleTime',
                                        data: cycleTimesAverageArray,
                                        fill: false,
                                        borderColor: '#cd7213',
                                        borderDash: [5, 5],
                                        tension: 0.1
                                    }]
                                };

                                const cycleTimeChart = new Chart(ctx1, {
                                    type: 'line',
                                    data: data1,
                                    options: {
                                        scales: {
                                            x: {
                                                title: {
                                                    display: true,
                                                    text: 'Número de HU',
                                                    color: 'white'
                                                },
                                                ticks: {
                                                    color: 'white',
                                                }
                                            },
                                            y: {
                                                title: {
                                                    display: true,
                                                    text: 'Días de CycleTime de HU',
                                                    color: 'white'
                                                },
                                                ticks: {
                                                    color: 'white',
                                                }
                                            }
                                        },
                                        plugins: {
                                            legend: {
                                                labels: {
                                                    color: 'white',

                                                }
                                            },
                                            tooltip: {
                                                callbacks: {
                                                    label: function(context) {
                                                        const dataIndex = context.dataIndex;
                                                        const numeroHU1 = numerosHU1[dataIndex];
                                                        return 'HU ' + numeroHU1 + ': ' + context.parsed.y + ' días';
                                                    }
                                                }
                                            }
                                        }
                                    }
                                });
                            </script>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
            <?php include 'footer.html'; ?>
        </div>
    </div>
</body>