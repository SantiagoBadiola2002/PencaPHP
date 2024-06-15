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
  </head>
<body>

<?php include '../componentes/navbarLogeado.html'; ?>

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

</body>
</html>