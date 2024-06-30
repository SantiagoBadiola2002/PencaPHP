<?php
session_start();

if (!isset($_SESSION['ci'])) {
  header("Location: ../index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Penca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../principales/estilos.css" rel="stylesheet">
  </head>
<body>

<?php include '../componentes/navbarLogeado.html'; ?>


<div class="container">
<div class="form-container">
<h1>Crear Penca</h1>
<form action="../persistencia/registrarPencaEnBD.php" method="POST">
  <div class="mb-3">
    <label for="exampleInputNombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre" >
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Puntos</label>
    <input type="number" id="puntos" name="puntos">
  </div>
  <button type="submit" class="btn btn-primary">Ingresar</button>
</form>

</div>
</div>
    
</body>
</html>