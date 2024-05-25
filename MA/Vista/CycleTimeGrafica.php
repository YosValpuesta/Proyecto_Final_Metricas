<?php
session_start();
include '../ConexionBD/conexion.php';
include '../Controlador/Metricas/cycleTime.php';

$querySprints = $conexion->query("SELECT TotalSprint FROM tablero") or die($conexion->error);
$mostrarSprint = mysqli_fetch_array($querySprints);
$totalSprints = $mostrarSprint['TotalSprint'];

?>

<head>
    <meta charset="utf-8">
    <title>CorsolaCorp: Métrica CycleTime</title>
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../assets/css/general.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include 'Sidebar.html' ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'navPrincipal.php' ?>
                <h1 class="my-2 text-gray-900 text-center">Métrica CycleTime</h1>
                <center>
                    <div class="btn-group btn-group-sm" role="group">
                        <?php for ($i = 1; $i <= $totalSprints; $i++) { ?>
                            <a href="?sprint=<?php echo $i ?>" class="btn btn-secondary">Sprint <?php echo $i ?></a>
                        <?php } ?>
                    </div>
                </center>
                <div class="container my-2" style="width: 60%; height: 60%;">
                    <div>
                        <canvas id="cycleTimeChart" width="400" height="200" style="background-color: #16253d;"></canvas>
                        <script>
                            const ctx1 = document.getElementById('cycleTimeChart').getContext('2d');
                            const cycleTimesData = <?php echo json_encode($cycleTimes); ?>;
                            const numerosHU = <?php echo json_encode(array_keys($cycleTimes)); ?>;
                            const labels1 = numerosHU.map(numero => 'HU ' + numero);
                            // Calcular el promedio
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
                                                    const numeroHU = numerosHU[dataIndex];
                                                    return 'HU ' + numeroHU + ': ' + context.parsed.y + ' días';
                                                }
                                            }
                                        }
                                    }
                                }
                            });
                        </script>
                        <!-- Recomendaciones -->
                        <script>
                            <?php if ($recomendacionesCycleTime) : ?>
                                document.addEventListener('DOMContentLoaded', function() {
                                    <?php foreach ($recomendacionesCycleTime as $rec) : ?>
                                        <?php if ($rec['tipo'] === 'alerta') : ?>
                                            Swal.fire({
                                                title: 'Alerta',
                                                text: '<?php echo $rec['mensaje']; ?>',
                                                icon: 'warning',
                                                confirmButtonText: 'OK'
                                            });
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                });
                            <?php endif; ?>
                        </script>
                    </div>
                </div>
            </div>
            <?php include 'footer.html' ?>
        </div>
    </div>
</body>