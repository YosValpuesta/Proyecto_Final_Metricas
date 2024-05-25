<?php
session_start();
include '../ConexionBD/conexion.php';
include '../Controlador/Metricas/leadTime.php';

$querySprints = $conexion->query("SELECT TotalSprint FROM tablero") or die($conexion->error);
$mostrarSprint = mysqli_fetch_array($querySprints);
$totalSprints = $mostrarSprint['TotalSprint'];

?>

<head>
    <meta charset="utf-8">
    <title>CorsolaCorp: Métrica LeadTime</title>
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
                <h1 class="my-2 text-gray-900 text-center">Métrica LeadTime</h1>
                <center>
                    <div class="btn-group btn-group-sm" role="group">
                        <?php for ($i = 1; $i <= $totalSprints; $i++) { ?>
                            <a href="?sprint=<?php echo $i ?>" class="btn btn-secondary">Sprint <?php echo $i ?></a>
                        <?php } ?>
                    </div>
                </center>
                <div class="container my-2" style="width:60%; height: 60%;">
                    <div>
                        <canvas id="leadTimeChart" width="400" height="200" style="background-color: #16253d;"></canvas>
                        <script>
                            const ctx = document.getElementById('leadTimeChart').getContext('2d');
                            // Obtener los datos de Lead Time y números de HU
                            const leadTimesData = <?php echo json_encode($leadTimes); ?>;
                            const numerosHU = <?php echo json_encode(array_keys($leadTimes)); ?>;
                            const labels = numerosHU.map(numero => 'HU ' + numero);

                            // Calcular el promedio
                            const leadTimesArray = Object.values(leadTimesData);
                            const leadTimesSum = leadTimesArray.reduce((acc, curr) => acc + curr, 0);
                            const leadTimesAverage = leadTimesSum / leadTimesArray.length;

                            // Crear un array con el promedio
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
                                    label: 'Promedio de LeadTime',
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
                        <!-- Recomendaciones -->
                        <script>
                            <?php if ($recomendaciones) : ?>
                                document.addEventListener('DOMContentLoaded', function() {
                                    <?php foreach ($recomendaciones as $rec) : ?>
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