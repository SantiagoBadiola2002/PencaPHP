<?php
session_start();

if (!isset($_SESSION['ci'])) {
  header("Location: ../index.php");
  exit();
}
include '../persistencia/config.php';

$conexion = new mysqli($servidor, $usuario_db, $contrasenia_db, $base_de_datos);

$ci = htmlspecialchars($_SESSION['ci']);

$prediccionesSQL = "
SELECT 
    pr.idPrediccion,
    p.id AS partido_id,
    p.grupo,
    p.equipo_1,
    p.equipo_2,
    pp.prediccion_goles_Equipo1,
    pp.prediccion_goles_Equipo2
FROM 
    Predicciones pr
JOIN 
    Prediccion_Partidos pp ON pr.idPrediccion = pp.idPrediccion
JOIN 
    Partidos p ON pp.partido_id = p.id
WHERE 
    pr.usuario_ci = '$ci'
";

$generalesSQL = "SELECT * FROM Penca_General WHERE Usuario = $ci";

$gruposSQL = "SELECT * FROM Penca_Grupal WHERE Usuario = $ci";

$resultadoPredicciones = $conexion->query($prediccionesSQL);
$resultadoPencasGeneral = $conexion->query($generalesSQL);
$resultadoPencasGrupal = $conexion->query($gruposSQL);



require('../fpdf/fpdf.php');

// Creación del PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

$fecha_hora_actual = date('d-m-Y H:i:s');

$pdf->Cell(0, 10, "Usuario CI: '$ci', emitido el $fecha_hora_actual", 1);

$pdf->Ln();

// Título del documento
$pdf->Cell(0, 10, 'Mis Predicciones', 0, 1, 'C');
$pdf->Ln(10);


// Encabezados de la tabla de predicciones
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(15, 10, 'ID Pred.', 1);
$pdf->Cell(15, 10, 'ID Part', 1);
$pdf->Cell(15, 10, 'Grupo', 1);
$pdf->Cell(40, 10, 'Equip 1', 1);
$pdf->Cell(40, 10, 'Equip 2', 1);
$pdf->Cell(25, 10, 'Goles Eq. 1', 1);
$pdf->Cell(25, 10, 'Goles Eq. 2', 1);
$pdf->Ln();

// Datos de la tabla de predicciones
$pdf->SetFont('Arial', '', 10);

if ($resultadoPredicciones->num_rows > 0) {
    while ($fila = $resultadoPredicciones->fetch_assoc()) {
        $pdf->Cell(15, 10, htmlspecialchars($fila['idPrediccion']), 1);
        $pdf->Cell(15, 10, htmlspecialchars($fila['partido_id']), 1);
        $pdf->Cell(15, 10, htmlspecialchars($fila['grupo']), 1);
        $pdf->Cell(40, 10, htmlspecialchars($fila['equipo_1']), 1);
        $pdf->Cell(40, 10, htmlspecialchars($fila['equipo_2']), 1);
        $pdf->Cell(25, 10, htmlspecialchars($fila['prediccion_goles_Equipo1']), 1);
        $pdf->Cell(25, 10, htmlspecialchars($fila['prediccion_goles_Equipo2']), 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No se encontraron resultados.', 1, 1, 'C');
}

$pdf->Ln(10);

// Título del documento para Pencas Generales
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Mis Pencas Generales', 0, 1, 'C');
$pdf->Ln(10);

// Encabezados de la tabla de pencas generales
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 10, 'ID Penca Gen.', 1);
$pdf->Cell(50, 10, 'Nombre', 1);
$pdf->Cell(30, 10, 'ID Pred.', 1);
$pdf->Cell(30, 10, 'Puntos', 1);
$pdf->Cell(30, 10, 'Puesto', 1);
$pdf->Ln();

// Datos de la tabla de pencas generales
$pdf->SetFont('Arial', '', 10);

if ($resultadoPencasGeneral->num_rows > 0) {
    while ($fila = $resultadoPencasGeneral->fetch_assoc()) {
        $pdf->Cell(30, 10, htmlspecialchars($fila['idPencaGeneral']), 1);
        $pdf->Cell(50, 10, htmlspecialchars($fila['nombre']), 1);
        $pdf->Cell(30, 10, htmlspecialchars($fila['idPrediccion']), 1);
        $pdf->Cell(30, 10, htmlspecialchars($fila['puntosActuales']), 1);
        $pdf->Cell(30, 10, htmlspecialchars($fila['puesto']), 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No se encontraron resultados.', 1, 1, 'C');
}

$pdf->Ln(10);

// Título del documento para Pencas Grupales
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Mis Pencas Grupales', 0, 1, 'C');
$pdf->Ln(10);

// Encabezados de la tabla de pencas grupales
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 10, 'ID Penca Grup.', 1);
$pdf->Cell(40, 10, 'Nombre', 1);
$pdf->Cell(30, 10, 'ID Pred.', 1);
$pdf->Cell(30, 10, 'Puntos', 1);
$pdf->Cell(30, 10, 'Puesto', 1);
$pdf->Cell(30, 10, 'Cod. Inv.', 1);
$pdf->Ln();

// Datos de la tabla de pencas grupales
$pdf->SetFont('Arial', '', 10);

if ($resultadoPencasGrupal->num_rows > 0) {
    while ($fila = $resultadoPencasGrupal->fetch_assoc()) {
        $pdf->Cell(30, 10, htmlspecialchars($fila['idPencaGrupal']), 1);
        $pdf->Cell(40, 10, htmlspecialchars($fila['nombre']), 1);
        $pdf->Cell(30, 10, htmlspecialchars($fila['idPrediccion']), 1);
        $pdf->Cell(30, 10, htmlspecialchars($fila['puntosActuales']), 1);
        $pdf->Cell(30, 10, htmlspecialchars($fila['puesto']), 1);
        $pdf->Cell(30, 10, htmlspecialchars($fila['codigoInvitacion']), 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No se encontraron resultados.', 1, 1, 'C');
}

$pdf->Output();
$conn->close();
?>
<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Predicciones y Pencas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../principales/estilos.css" rel="stylesheet">
</head>
<body>

<?php include '../componentes/navbarLogeado.html'; ?>

<h1 style="text-align: center;">Mis Predicciones</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Prediccion</th>
                <th>Partido ID</th>
                <th>Grupo</th>
                <th>Equipo 1</th>
                <th>Equipo 2</th>
                <th>Predicción Goles Equipo 1</th>
                <th>Predicción Goles Equipo 2</th>
            </tr>
        </thead>
        <tbody>
            <?php
            /*
            if ($resultadoPredicciones && $resultadoPredicciones->num_rows > 0) {
                while ($fila = $resultadoPredicciones->fetch_assoc()) {
                    echo '<tr>
                            <td>' . htmlspecialchars($fila['idPrediccion']) . '</td>
                            <td>' . htmlspecialchars($fila['partido_id']) . '</td>
                            <td>' . htmlspecialchars($fila['grupo']) . '</td>
                            <td>' . htmlspecialchars($fila['equipo_1']) . '</td>
                            <td>' . htmlspecialchars($fila['equipo_2']) . '</td>
                            <td>' . htmlspecialchars($fila['prediccion_goles_Equipo1']) . '</td>
                            <td>' . htmlspecialchars($fila['prediccion_goles_Equipo2']) . '</td>
                          </tr>';
                }
            } else {
                echo '<tr>
                        <td colspan="6">No se encontraron resultados.</td>
                      </tr>';
            }
            */
            ?>
        </tbody>
    </table>

    <h1 style="text-align: center;">Mis Pencas Generales</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Penca General</th>
                <th>Nombre</th>
                <th>ID Prediccion</th>
                <th>Puntos</th>
                <th>Puesto</th>
            </tr>
        </thead>
        <tbody>
            <?php
            /*
            if ($resultadoPencasGeneral && $resultadoPencasGeneral->num_rows > 0) {
                while ($fila = $resultadoPencasGeneral->fetch_assoc()) {
                    echo '<tr>
                            <td>' . htmlspecialchars($fila['idPencaGeneral']) . '</td>
                            <td>' . htmlspecialchars($fila['nombre']) . '</td>
                            <td>' . htmlspecialchars($fila['idPrediccion']) . '</td>
                            <td>' . htmlspecialchars($fila['puntosActuales']) . '</td>
                            <td>' . htmlspecialchars($fila['puesto']) . '</td>
                          </tr>';
                }
            } else {
                echo '<tr>
                        <td colspan="6">No se encontraron resultados.</td>
                      </tr>';
            }
            */
            ?>
        </tbody>
    </table>

    <h1 style="text-align: center;">Mis Pencas Grupales</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Penca Grupal</th>
                <th>Nombre</th>
                <th>ID Prediccion</th>
                <th>Puntos</th>
                <th>Puesto</th>
                <th>Codigo Invitacion</th>
            </tr>
        </thead>
        <tbody>
            <?php
            /*
            if ($resultadoPencasGrupal && $resultadoPencasGrupal->num_rows > 0) {
                while ($fila = $resultadoPencasGrupal->fetch_assoc()) {
                    echo '<tr>
                            <td>' . htmlspecialchars($fila['idPencaGrupal']) . '</td>
                            <td>' . htmlspecialchars($fila['nombre']) . '</td>
                            <td>' . htmlspecialchars($fila['idPrediccion']) . '</td>
                            <td>' . htmlspecialchars($fila['puntosActuales']) . '</td>
                            <td>' . htmlspecialchars($fila['puesto']) . '</td>
                            <td>' . htmlspecialchars($fila['codigoInvitacion']) . '</td>
                          </tr>';
                }
            } else {
                echo '<tr>
                        <td colspan="6">No se encontraron resultados.</td>
                      </tr>';
            }
            */
            ?>
        </tbody>
    </table>


</body>
</html>
        -->