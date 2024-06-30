<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="./principales/estilos.css" rel="stylesheet">
  </head>
<body>

<?php include './componentes/navbar.html'; ?>


<div class="container">
  <div class="form-container">
    <h1>Iniciar Sesión</h1>
    <form action="./persistencia/registrarseEnBD.php" method="POST">
      <div class="mb-3">
        <label for="ci" class="form-label">CI</label>
        <input type="text" class="form-control" id="ci" name="ci" aria-describedby="ciHelp">
      </div>
      <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre">
      </div>
      <div class="mb-3">
        <label for="apellido" class="form-label">Apellido</label>
        <input type="text" class="form-control" id="apellido" name="apellido">
      </div>
      <div class="mb-3">
        <label for="correo" class="form-label">Correo Electrónico</label>
        <input type="email" class="form-control" id="correo" name="correo" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="contrasenia" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="contrasenia" name="contrasenia">
      </div>
      <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>
  </div>
</div>

    
</body>
</html>