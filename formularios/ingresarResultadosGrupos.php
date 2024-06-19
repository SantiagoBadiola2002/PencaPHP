<?php
session_start();

if (!isset($_SESSION['ci'])) {
  header("Location: ../index.php");
  exit();
}

include '../persistencia/config.php';

$conexion = new mysqli($servidor, $usuario_db, $contrasenia_db, $base_de_datos);

$consulta = "SELECT * FROM Partidos";
$resultado = $conexion->query($consulta);


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ingresar Resultados</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- <link href="./estiloResultados.css" rel="stylesheet"> -->
  <link href="../principales/estilos.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #34495e;
    }

    .r18-container {
      display: flex;
      flex-direction: column;
      gap: 1rem;
      padding: 1rem;
    }

    .r18-items {
      display: flex;
      flex-direction: column;
      background-color: #f8f9fa;
      border-radius: 5px;
      padding: 1rem;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .r18-time,
    .r18-columns {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .r18-time {
      margin-bottom: 1rem;
    }

    .r18-hour {
      font-size: 1.5rem;
      font-weight: bold;
    }

    .r18-text {
      display: flex;
      flex-direction: column;
    }

    .r18-columns .r18-team-l,
    .r18-columns .r18-team-r {
      display: flex;
      align-items: center;
    }

    .r18-columns .r18-team-l .r18-name,
    .r18-columns .r18-team-r .r18-name {
      margin: 0 0.5rem;
    }

    .flag-icon {
      margin-right: 0.5rem;
    }

    .form-container {
      max-width: 600px;
      margin: 2rem auto;
    }
  </style>
</head>

<body>

  <?php include '../componentes/navbarAdmin.html'; ?>

  <div class="form-container">
    <h1 style="text-align: center;">Fase de Grupos</h1>
    <br>

    <form action="../persistencia/registrarResultadosGrupos.php" method="post">
        <div class="r18-container">
            <?php
            if ($resultado->num_rows > 0) {
                while($row = $resultado->fetch_assoc()) {
                    $partido_id = $row['id'];
                    $grupo = $row['grupo'];
                    $equipo_1 = $row['equipo_1'];
                    $equipo_2 = $row['equipo_2'];
                    $goles_equipo_1 = $row['goles_equipo_1'];
                    $goles_equipo_2 = $row['goles_equipo_2'];
                    $jugado = $row['jugado'];

                    echo "<div class='r18-items'>
                            <div class='r18-time'>
                                <div class='r18-hour'>08:00</div>
                                <div class='r18-text'>
                                    <span>Grupo $grupo</span>
                                    <span>$equipo_1 vs $equipo_2</span>
                                </div>
                                <div class='form-check'>
                                    <input type='hidden' name='jugado$partido_id' value='0'>
                                    <input class='form-check-input' type='checkbox' value='1' name='jugado$partido_id' id='jugado$partido_id' " . ($jugado ? "checked" : "") . ">
                                    <label class='form-check-label' for='jugado$partido_id'>
                                        Partido Jugado
                                    </label>
                                </div>
                            </div>

                            <div class='r18-columns'>
                                <div class='r18-team-l'>
                                    <span class='r18-name'>$equipo_1</span>
                                    <input type='number' class='form-control' id='resultado-$equipo_1-$partido_id' name='resultado-$equipo_1-$partido_id' value='$goles_equipo_1'>
                                </div>
                                <div class='r18-team-r'>
                                    <input type='number' class='form-control' id='resultado-$equipo_2-$partido_id' name='resultado-$equipo_2-$partido_id' value='$goles_equipo_2'>
                                    <span class='r18-name'>$equipo_2</span>
                                </div>
                            </div>
                        </div>";
                }
            } else {
                echo "No hay partidos disponibles.";
            }

            $conexion->close();
            ?>
        </div>
        <div style="text-align: center;">
            <button type="submit" class="btn btn-primary mt-3">Enviar</button>
        </div>
    </form>
</div>

</body>

</html>