<?php
ob_start();
?>

<?php
// Inicia la sesión para poder acceder a las variables de sesión
session_start();

// Obtener los valores de las variables de sesión
$esfuerzoTotal = $_SESSION['esfuerzoTotal'] ?? '';
$duracionTotal = $_SESSION['duracionTotal'] ?? '';
$cantidadPersonas = $_SESSION['cantidadPersonas'] ?? '';
$costoEstimado = $_SESSION['costoEstimado'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Estimaciones del Proyecto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/Metricas-Dashboard/CorsolaCorp.jpg" width="90" height="74">
                CorsolaCorp
            </a>
        </div>
    </nav>
    <h1 class="text-center">"Aplicacion-Streaming"</h1>
    <h3>Listado de requisitos</h3>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre Requisito</th>
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
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
    <h3 class="text-center">Reporte de Estimaciones del Proyecto</h3>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th scope="col"></th>
                <th scope="col">Duración Total</th>
            </tr>
            <tr>
                <th scope="col"></th>
                <th scope="col">Cantidad de Personas</th>
            </tr>
            <tr>
                <th scope="col"></th>
                <th scope="col">Costo Estimado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="col">En base a los cálculos se obtiene que aproximadamente el proyecto se realizará en:</th>
                <td><?php echo number_format($duracionTotal, 0); ?> meses</td>
            </tr>
            <tr>
                <th scope="col">En base a los cálculos se obtiene que aproximadamente se necesitaran: </th>
                <td><?php echo number_format($cantidadPersonas, 0); ?> personas para realizar el proyecto</td>
            </tr>
            <tr>
                <th scope="col">En base a los cálculos se obtiene que aproximadamente tendrá un costo de: </th>
                <td><?php echo $costoEstimado; ?></td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <p>Cliente</p>
    ______________________________
    <p>Firma</p>

</body>

<?php
$html = ob_get_clean();
// // echo $html;

require_once '../../Libreria/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml("$html");
$dompdf->setPaper('A4', 'landscape');

$dompdf->render();
$dompdf->stream("archivo.pdf", array("Attachment" => true));
?>