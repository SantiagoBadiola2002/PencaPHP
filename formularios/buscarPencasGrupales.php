<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ver Pencas Grupales</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
      <h1>Ver Pencas Grupales</h1>
      <br>

      <form action="../principales/verPencasGrupales.php" method="post">
        <div class="mb-3">
          <h2>Cod. Invitación</h2>
          <input type="text" class="form-control" id="codigo-invitacion" name="codigo-invitacion" min="0" required>
        </div>
        <button type="submit" class="btn btn-primary">Ver</button>
      </form>
    </div>
  </div>


</body>

</html>