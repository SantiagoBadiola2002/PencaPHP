<?php

session_start();

if (!isset($_SESSION['ci'])) {
  header("Location: ../index.php");
  exit();
}

include '../persistencia/config.php';

$conexion = new mysqli($servidor, $usuario_db, $contrasenia_db, $base_de_datos);

$consulta = "SELECT * FROM Penca_General ORDER BY puntosActuales DESC";

$resultado = $conexion->query($consulta);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking Pencas Generales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../principales/estilos.css" rel="stylesheet">
    <style>
    .form-container {
        max-width: 1000px;
        margin: 50px auto;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow-x: auto; /* Permitir desplazamiento horizontal si la tabla es más ancha */
    }

    .table {
        width: 100%; /* Asegura que la tabla ocupe todo el ancho del contenedor */
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
    }

    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }

    .table tbody + tbody {
        border-top: 2px solid #dee2e6;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.05);
    }
</style>
  </head>
<body>

<?php include '../componentes/navbarLogeado.html'; ?>

<div class="container-fluid">
<div class="form-container">

<h1 style="text-align: center;">Ranking General</h1>
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>ID Predicción</th>
            <th>Puntos Actuales</th>
            <th>Puesto</th>
        </tr>
        <?php
        // Verificar si se obtuvieron resultados
        if ($resultado->num_rows > 0) {
            // Recorrer los resultados y generar las filas de la tabla
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $fila["idPencaGeneral"] . "</td>";
                echo "<td>" . $fila["nombre"] . "</td>";
                echo "<td>" . $fila["Usuario"] . "</td>";
                echo "<td>" . $fila["idPrediccion"] . "</td>";
                echo "<td>" . $fila["puntosActuales"] . "</td>";
                echo "<td>" . $fila["puesto"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No se encontraron resultados.</td></tr>";
        }
        // Cerrar la conexión
        $conexion->close();
        ?>
    </table>
    </div>
</div>
</body>
</html>