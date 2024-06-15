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
    <title>Generar Predicción</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" rel="stylesheet">
    <style>
      body{
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
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .r18-time, .r18-columns {
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
        .r18-columns .r18-team-l, .r18-columns .r18-team-r {
            display: flex;
            align-items: center;
        }
        .r18-columns .r18-team-l .r18-name, .r18-columns .r18-team-r .r18-name {
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
<!-- <form action="../persistencia/registrarPrediccionGrupos.php" method="post"> -->
<?php include '../componentes/navbarLogeado.html'; ?>

<div class="container-fluid">
  <div class="form-container">
    <h1 style="text-align: center;">Fase de Grupos</h1>
    <br>
    
    <form action="../persistencia/registrarPrediccionGrupos.php" method="post">
    
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nombre de la Predicción:</label>
    <input type="text" class="form-control" id="nombre-prediccion" name="nombre-prediccion" aria-describedby="emailHelp">
    <div id="nombre-prediccion" class="form-text"></div>
  </div>


      <div class="r18-container">
        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">11:00</div>
            <div class="r18-text">
              <span>Grupo A</span>
              <span>Argentina vs Perú</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-ar"></span>
              <span class="r18-name">Argentina</span>
              <input type="number" class="form-control" id="resultado-argentina-a" name="resultado-argentina-a" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-peru-a" name="resultado-peru-a" min="0" required>
              <span class="r18-name">Perú</span>
              <span class="flag-icon flag-icon-pe"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">11:00</div>
            <div class="r18-text">
              <span>Grupo A</span>
              <span>Chile vs Canadá</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-cl"></span>
              <span class="r18-name">Chile</span>
              <input type="number" class="form-control" id="resultado-chile-a" name="resultado-chile-a" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-canada-a" name="resultado-canada-a" min="0" required>
              <span class="r18-name">Canadá</span>
              <span class="flag-icon flag-icon-ca"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">11:00</div>
            <div class="r18-text">
              <span>Grupo B</span>
              <span>México vs Colombia</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-mx"></span>
              <span class="r18-name">México</span>
              <input type="number" class="form-control" id="resultado-mexico-b" name="resultado-mexico-b" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-colombia-b" name="resultado-colombia-b" min="0" required>
              <span class="r18-name">Colombia</span>
              <span class="flag-icon flag-icon-co"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">11:00</div>
            <div class="r18-text">
              <span>Grupo B</span>
              <span>Venezuela vs Jamaica</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-ve"></span>
              <span class="r18-name">Venezuela</span>
              <input type="number" class="form-control" id="resultado-venezuela-b" name="resultado-venezuela-b" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-jamaica-b" name="resultado-jamaica-b" min="0" required>
              <span class="r18-name">Jamaica</span>
              <span class="flag-icon flag-icon-jm"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">11:00</div>
            <div class="r18-text">
              <span>Grupo C</span>
              <span>Estados Unidos vs Uruguay</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-us"></span>
              <span class="r18-name">Estados Unidos</span>
              <input type="number" class="form-control" id="resultado-estados-unidos-c" name="resultado-estados-unidos-c" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-uruguay-c" name="resultado-uruguay-c" min="0" required>
              <span class="r18-name">Uruguay</span>
              <span class="flag-icon flag-icon-uy"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">11:00</div>
            <div class="r18-text">
              <span>Grupo C</span>
              <span>República Dominicana vs Bolivia</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-do"></span>
              <span class="r18-name">República Dominicana</span>
              <input type="number" class="form-control" id="resultado-republica-dominicana-c" name="resultado-republica-dominicana-c" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-bolivia-c" name="resultado-bolivia-c" min="0" required>
              <span class="r18-name">Bolivia</span>
              <span class="flag-icon flag-icon-bo"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">11:00</div>
            <div class="r18-text">
              <span>Grupo D</span>
              <span>Brasil vs Ecuador</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-br"></span>
              <span class="r18-name">Brasil</span>
              <input type="number" class="form-control" id="resultado-brasil-d" name="resultado-brasil-d" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-ecuador-d" name="resultado-ecuador-d" min="0" required>
              <span class="r18-name">Ecuador</span>
              <span class="flag-icon flag-icon-ec"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">11:00</div>
            <div class="r18-text">
              <span>Grupo D</span>
              <span>Paraguay vs Honduras</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-py"></span>
              <span class="r18-name">Paraguay</span>
              <input type="number" class="form-control" id="resultado-paraguay-d" name="resultado-paraguay-d" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-honduras-d" name="resultado-honduras-d" min="0" required>
              <span class="r18-name">Honduras</span>
              <span class="flag-icon flag-icon-hn"></span>
            </div>
          </div>
        </div>
      </div>
      <div style="text-align: center;">
      <button type="submit" class="btn btn-primary mt-3">Enviar</button>
      </div>
    </form>
  </div>
</div>

</body>
</html>