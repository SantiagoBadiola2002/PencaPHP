<?php

session_start();

if (!isset($_SESSION['ci'])) {
    header("Location: ../index.php");
    exit();
}
include '../persistencia/config.php';
$ciUsuario = htmlspecialchars($_SESSION['ci']);

$conexion = new mysqli($servidor, $usuario_db, $contrasenia_db, $base_de_datos);

$consulta = "SELECT * FROM Predicciones WHERE usuario_ci = $ciUsuario";


$resultado = $conexion->query($consulta);

$options = '';
while ($fila = $resultado->fetch_assoc()) {
    $idPrediccion = $fila['idPrediccion'];
    $usuario_ci = $fila['usuario_ci'];
    $nombre = $fila['nombre'];
    $options .= "<option value='$idPrediccion'>$nombre</option>";
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Penca General</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../principales/estilos.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<?php include '../componentes/navbarLogeado.html'; ?>

<div class="container-fluid">
  <div class="form-container">
    <h1>Crear Penca General</h1>
    <br>
    
    <form action="../persistencia/registrarPencaGeneralEnBD.php" method="post">
      <div class="mb-3">
        <h2>Nombre de la Penca</h2>
        <input type="text" class="form-control" id="nombre-penca" name="nombre-penca" min="0" required>
      </div>
      <div class="mb-3">
        <h2>Predicciones</h2>
        <label for="prediccion-nombre" class="form-label">Nombre:</label>
        <select class="form-control" id="prediccion-nombre" name="prediccion-nombre" required>
          <?php echo $options; ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+5WROglyEYbVJnYw1ow/3snFw0Pp+" crossorigin="anonymous"></script>

</body>
</html>
