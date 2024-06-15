<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="./principales/estilos.css" rel="stylesheet">
  </head>
<body>

<?php include './componentes/navbar.html'; ?>


<div class="container">
  <div class="form-container">
    <h1>Iniciar Sesión</h1>
    <form action="./persistencia/validar.php" method="POST">
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
    <div class="mt-3">
      <a href="./recuperarContrasenia.php">Olvidé mi contraseña</a>
    </div>
  </div>
</div>

    
</body>
</html>
