<?php
session_start();

if (!isset($_SESSION['ci'])) {
    header("Location: ../index.php");
    exit();
}

include '../persistencia/config.php';

$conexion = new mysqli($servidor, $usuario_db, $contrasenia_db, $base_de_datos);

$consulta = "SELECT
    u.ci,
    u.nombre AS nombre_usuario,
    u.apellido,
    u.email,
    pg.idPencaGeneral AS id_penca,
    pg.nombre AS nombre_penca,
    'General' AS tipo_penca,
    pg.puntosActuales AS puntos_actuales,
    pg.puesto
FROM
    Usuario u
JOIN
    Penca_General pg ON u.ci = pg.Usuario
UNION
SELECT
    u.ci,
    u.nombre AS nombre_usuario,
    u.apellido,
    u.email,
    pg.idPencaGrupal AS id_penca,
    pg.nombre AS nombre_penca,
    'Grupal' AS tipo_penca,
    pg.puntosActuales AS puntos_actuales,
    pg.puesto
FROM
    Usuario u
JOIN
    Penca_Grupal pg ON u.ci = pg.Usuario;";

$usuarios = $conexion->query($consulta);

require('../fpdf/fpdf.php');

// Creación del PDF
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Título del documento
$pdf->Cell(0, 10, 'Usuarios y sus Pencas', 0, 1, 'C');
$pdf->Ln(10);

// Encabezados de la tabla
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 10, 'CI', 1);
$pdf->Cell(35, 10, 'Nombre', 1);
$pdf->Cell(35, 10, 'Apellido', 1);
$pdf->Cell(35, 10, 'Email', 1);
$pdf->Cell(20, 10, 'Penca ID', 1);
$pdf->Cell(40, 10, 'Nombre Penca', 1);
$pdf->Cell(15, 10, 'Tipo', 1);
$pdf->Cell(15, 10, 'Puntos', 1);
$pdf->Cell(15, 10, 'Puesto', 1);
$pdf->Ln();

// Datos de la tabla
$pdf->SetFont('Arial', '', 10);
while ($row = $usuarios->fetch_assoc()) {
    $pdf->Cell(30, 10, $row['ci'], 1);
    $pdf->Cell(35, 10, $row['nombre_usuario'], 1);
    $pdf->Cell(35, 10, $row['apellido'], 1);
    $pdf->Cell(35, 10, $row['email'], 1);
    $pdf->Cell(20, 10, $row['id_penca'], 1);
    $pdf->Cell(40, 10, $row['nombre_penca'], 1);
    $pdf->Cell(15, 10, $row['tipo_penca'], 1);
    $pdf->Cell(15, 10, $row['puntos_actuales'], 1);
    $pdf->Cell(15, 10, $row['puesto'], 1);
    $pdf->Ln();
}

// Cerrar conexión
$conexion->close();

// Salida del PDF
$pdf->Output();
?>
