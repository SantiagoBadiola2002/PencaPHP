<?php
session_start();

if (!isset($_SESSION['ci'])) {
  header("Location: ../index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mensaje</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="../principales/estilos.css" rel="stylesheet">
  
</head>
<body>
  <div class="container">
    <div class="message">
    <?php

    if (isset($_GET['mensaje'])) {
      $mensaje = $_GET['mensaje'];
      echo '<p style="font-size: 18px; color: white;">' . htmlspecialchars($mensaje) . '</p>';
    }

    ?>

    <a href="../principales/indexLogeado.php" class="btn btn-primary">Volver al inicio</a>
  </div>
</div>
</body>
</html>
