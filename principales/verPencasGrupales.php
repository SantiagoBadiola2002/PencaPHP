<?php 

session_start();

if (!isset($_SESSION['ci'])) {
  header("Location: ../index.php");
  exit();
}

include '../persistencia/config.php';

$conexion = new mysqli($servidor, $usuario_db, $contrasenia_db, $base_de_datos);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $codigoInvitacion = $_POST["codigo-invitacion"];
    $existePencaGrupal = "SELECT * FROM Penca_Grupal WHERE codigoInvitacion = '$codigoInvitacion'";
    $resultado_verificar = $conexion->query($existePencaGrupal);

    if ($resultado_verificar->num_rows > 0) {
        $consulta = "SELECT * FROM Penca_Grupal WHERE codigoInvitacion = '$codigoInvitacion'";
        $resultado = $conexion->query($consulta);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencas Grupales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../principales/estilos.css" rel="stylesheet">
    <style>
        .no-margin-top {
    margin-top: 0;
}

    </style>
</head>

<body>
    <?php include '../componentes/navbarLogeado.html'; ?>


    <h2 class="text-center no-margin-top">Pencas Grupales</h2>
        
        <?php if (!empty($consulta)): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Código Invitación</th>
                        <th>Predicción</th>
                        <th>Puntos Actuales</th>
                        <th>Puesto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = $resultado->fetch_assoc()){ ?>
                        <tr>
                            <td><?php echo htmlspecialchars($fila['idPencaGrupal']); ?></td>
                            <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($fila['Usuario']); ?></td>
                            <td><?php echo htmlspecialchars($fila['codigoInvitacion']); ?></td>
                            <td><?php echo htmlspecialchars($fila['idPrediccion']); ?></td>
                            <td><?php echo htmlspecialchars($fila['puntosActuales']); ?></td>
                            <td><?php echo htmlspecialchars($fila['puesto']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning" role="alert">
                No hay Pencas Grupales para mostrar.
            </div>
        <?php endif; ?>

</body>

</html>
