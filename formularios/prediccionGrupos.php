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
    <link href="../principales/estilos.css" rel="stylesheet">
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

<?php include '../componentes/navbarLogeado.html'; ?>

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
            <div class="r18-hour">20 de junio 21:00 </div>
            <div class="r18-text">
              <span>Grupo A</span>
              <span>Argentina vs Canadá</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-ar"></span>
              <span class="r18-name">Argentina</span>
              <input type="number" class="form-control" id="resultado-argentina-a-1" name="resultado-argentina-a-1" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-canada-a-1" name="resultado-canada-a-1" min="0" required>
              <span class="r18-name">Canadá</span>
              <span class="flag-icon flag-icon-ca"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">21 de junio 21:00</div>
            <div class="r18-text">
              <span>Grupo A</span>
              <span>Perú vs Chile</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-pe"></span>
              <span class="r18-name">Perú</span>
              <input type="number" class="form-control" id="resultado-peru-a-1" name="resultado-peru-a-1" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-chile-a-1" name="resultado-chile-a-1" min="0" required>
              <span class="r18-name">Chile</span>
              <span class="flag-icon flag-icon-cl"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">22 de junio 19:00</div>
            <div class="r18-text">
              <span>Grupo B</span>
              <span>Ecuador vs Venezuela</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-ec"></span>
              <span class="r18-name">Ecuador</span>
              <input type="number" class="form-control" id="resultado-ecuador-b-1" name="resultado-ecuador-b-1" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-venezuela-b-1" name="resultado-venezuela-b-1" min="0" required>
              <span class="r18-name">Venezuela</span>
              <span class="flag-icon flag-icon-ve"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">22 de junio 22:00</div>
            <div class="r18-text">
              <span>Grupo B</span>
              <span>México vs Jamaica</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-mx"></span>
              <span class="r18-name">México</span>
              <input type="number" class="form-control" id="resultado-mexico-b-1" name="resultado-mexico-b-1" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-jamaica-b-1" name="resultado-jamaica-b-1" min="0" required>
              <span class="r18-name">Jamaica</span>
              <span class="flag-icon flag-icon-jm"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">23 de junio 19:00</div>
            <div class="r18-text">
              <span>Grupo C</span>
              <span>Estados Unidos vs Bolivia</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-us"></span>
              <span class="r18-name">Estados Unidos</span>
              <input type="number" class="form-control" id="resultado-estados-unidos-c-1" name="resultado-estados-unidos-c-1" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-bolivia-c-1" name="resultado-bolivia-c-1" min="0" required>
              <span class="r18-name">Bolivia</span>
              <span class="flag-icon flag-icon-bo"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">23 de junio 22:00</div>
            <div class="r18-text">
              <span>Grupo C</span>
              <span>Uruguay vs Panamá</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-uy"></span>
              <span class="r18-name">Uruguay</span>
              <input type="number" class="form-control" id="resultado-uruguay-c-1" name="resultado-uruguay-c-1" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-panama-c-1" name="resultado-panama-c-1" min="0" required>
              <span class="r18-name">Panamá</span>
              <span class="flag-icon flag-icon-pa"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">24 de junio 19:00</div>
            <div class="r18-text">
              <span>Grupo D</span>
              <span>Colombia vs Paraguay</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-co"></span>
              <span class="r18-name">Colombia</span>
              <input type="number" class="form-control" id="resultado-colombia-d-1" name="resultado-colombia-d-1" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-paraguay-d-1" name="resultado-paraguay-d-1" min="0" required>
              <span class="r18-name">Paraguay</span>
              <span class="flag-icon flag-icon-py"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">24 de junio 22:00</div>
            <div class="r18-text">
              <span>Grupo D</span>
              <span>Brasil vs Costa Rica</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-br"></span>
              <span class="r18-name">Brasil</span>
              <input type="number" class="form-control" id="resultado-brasil-d-1" name="resultado-brasil-d-1" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-costa-rica-d-1" name="resultado-costa-rica-d-1" min="0" required>
              <span class="r18-name">Costa Rica</span>
              <span class="flag-icon flag-icon-cr"></span>
            </div>
          </div>
        </div>

        
        <div class="r18-container">
        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">25 de junio 19:00 </div>
            <div class="r18-text">
              <span>Grupo A</span>
              <span>Argentina vs Chile</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-ar"></span>
              <span class="r18-name">Argentina</span>
              <input type="number" class="form-control" id="resultado-argentina-a-2" name="resultado-argentina-a-2" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-chile-a-2" name="resultado-chile-a-2" min="0" required>
              <span class="r18-name">Chile</span>
              <span class="flag-icon flag-icon-cl"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">25 de junio 19:00</div>
            <div class="r18-text">
              <span>Grupo A</span>
              <span>Perú vs Canadá</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-pe"></span>
              <span class="r18-name">Perú</span>
              <input type="number" class="form-control" id="resultado-peru-a-2" name="resultado-peru-a-2" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-canada-a-2" name="resultado-canada-a-2" min="0" required>
              <span class="r18-name">Canadá</span>
              <span class="flag-icon flag-icon-ca"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">26 de junio 19:00</div>
            <div class="r18-text">
              <span>Grupo B</span>
              <span>Ecuador vs Jamaica</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-ec"></span>
              <span class="r18-name">Ecuador</span>
              <input type="number" class="form-control" id="resultado-ecuador-b-2" name="resultado-ecuador-b-2" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-jamaica-b-2" name="resultado-jamaica-b-2" min="0" required>
              <span class="r18-name">Jamaica</span>
              <span class="flag-icon flag-icon-jm"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">26 de junio 22:00</div>
            <div class="r18-text">
              <span>Grupo B</span>
              <span>México vs Venezuela</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-mx"></span>
              <span class="r18-name">México</span>
              <input type="number" class="form-control" id="resultado-mexico-b-2" name="resultado-mexico-b-2" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-venezuela-b-2" name="resultado-venezuela-b-2" min="0" required>
              <span class="r18-name">Venezuela</span>
              <span class="flag-icon flag-icon-ve"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">27 de junio 22:00</div>
            <div class="r18-text">
              <span>Grupo C</span>
              <span>Uruguay vs Bolivia</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-uy"></span>
              <span class="r18-name">Uruguay</span>
              <input type="number" class="form-control" id="resultado-uruguay-c-2" name="resultado-uruguay-c-2" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-bolivia-c-2" name="resultado-bolivia-c-2" min="0" required>
              <span class="r18-name">Bolivia</span>
              <span class="flag-icon flag-icon-bo"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">27 de junio 19:00</div>
            <div class="r18-text">
              <span>Grupo C</span>
              <span>Estados Unidos vs Panamá</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-us"></span>
              <span class="r18-name">Estados Unidos</span>
              <input type="number" class="form-control" id="resultado-estados-unidos-c-2" name="resultado-estados-unidos-c-2" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-panama-c-2" name="resultado-panama-c-2" min="0" required>
              <span class="r18-name">Panamá</span>
              <span class="flag-icon flag-icon-pa"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">28 de junio 19:00</div>
            <div class="r18-text">
              <span>Grupo D</span>
              <span>Colombia vs Costa Rica</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-co"></span>
              <span class="r18-name">Colombia</span>
              <input type="number" class="form-control" id="resultado-colombia-d-2" name="resultado-colombia-d-2" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-costa-rica-d-2" name="resultado-costa-rica-d-2" min="0" required>
              <span class="r18-name">Costa Rica</span>
              <span class="flag-icon flag-icon-cr"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">28 de junio 22:00</div>
            <div class="r18-text">
              <span>Grupo D</span>
              <span>Brasil vs Paraguay</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-br"></span>
              <span class="r18-name">Brasil</span>
              <input type="number" class="form-control" id="resultado-brasil-d-2" name="resultado-brasil-d-2" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-paraguay-d-2" name="resultado-paraguay-d-2" min="0" required>
              <span class="r18-name">Paraguay</span>
              <span class="flag-icon flag-icon-py"></span>
            </div>
          </div>
        </div>


        <div class="r18-container">
        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">29 de junio 21:00 </div>
            <div class="r18-text">
              <span>Grupo A</span>
              <span>Argentina vs Perú</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-ar"></span>
              <span class="r18-name">Argentina</span>
              <input type="number" class="form-control" id="resultado-argentina-a-3" name="resultado-argentina-a-3" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-peru-a-3" name="resultado-peru-a-3" min="0" required>
              <span class="r18-name">Perú</span>
              <span class="flag-icon flag-icon-pe"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">29 de junio 21:00</div>
            <div class="r18-text">
              <span>Grupo A</span>
              <span>Chile vs Canadá</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-cl"></span>
              <span class="r18-name">Chile</span>
              <input type="number" class="form-control" id="resultado-chile-a-3" name="resultado-chile-a-3" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-canada-a-3" name="resultado-canada-a-3" min="0" required>
              <span class="r18-name">Canadá</span>
              <span class="flag-icon flag-icon-ca"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">30 de junio 21:00</div>
            <div class="r18-text">
              <span>Grupo B</span>
              <span>Jamaica vs Venezuela</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-jm"></span>
              <span class="r18-name">Jamaica</span>
              <input type="number" class="form-control" id="resultado-jamaica-b-3" name="resultado-jamaica-b-3" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-venezuela-b-3" name="resultado-venezuela-b-3" min="0" required>
              <span class="r18-name">Venezuela</span>
              <span class="flag-icon flag-icon-ve"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">30 de junio 21:00</div>
            <div class="r18-text">
              <span>Grupo B</span>
              <span>México vs Ecuador</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-mx"></span>
              <span class="r18-name">México</span>
              <input type="number" class="form-control" id="resultado-mexico-b-3" name="resultado-mexico-b-3" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-ecuador-b-3" name="resultado-ecuador-b-3" min="0" required>
              <span class="r18-name">Ecuador</span>
              <span class="flag-icon flag-icon-ec"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">1 de julio 22:00</div>
            <div class="r18-text">
              <span>Grupo C</span>
              <span>Panamá vs Bolivia</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-pm"></span>
              <span class="r18-name">Panamá</span>
              <input type="number" class="form-control" id="resultado-panama-c-3" name="resultado-panama-c-3" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-bolivia-c-3" name="resultado-bolivia-c-3" min="0" required>
              <span class="r18-name">Bolivia</span>
              <span class="flag-icon flag-icon-bo"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">1 de julio 22:00</div>
            <div class="r18-text">
              <span>Grupo C</span>
              <span>Estados Unidos vs Uruguay</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-us"></span>
              <span class="r18-name">Estados Unidos</span>
              <input type="number" class="form-control" id="resultado-estados-unidos-c-3" name="resultado-estados-unidos-c-3" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-uruguay-c-3" name="resultado-uruguay-c-3" min="0" required>
              <span class="r18-name">Uruguay</span>
              <span class="flag-icon flag-icon-uy"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">2 de julio 22:00</div>
            <div class="r18-text">
              <span>Grupo D</span>
              <span>Costa Rica vs Paraguay</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-cr"></span>
              <span class="r18-name">Costa Rica</span>
              <input type="number" class="form-control" id="resultado-costa-rica-d-3" name="resultado-costa-rica-d-3" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-paraguay-d-3" name="resultado-paraguay-d-3" min="0" required>
              <span class="r18-name">Paraguay</span>
              <span class="flag-icon flag-icon-py"></span>
            </div>
          </div>
        </div>

        <div class="r18-items">
          <div class="r18-time">
            <div class="r18-hour">2 de julio 22:00</div>
            <div class="r18-text">
              <span>Grupo D</span>
              <span>Brasil vs Colombia</span>
            </div>
          </div>

          <div class="r18-columns">
            <div class="r18-team-l">
              <span class="flag-icon flag-icon-br"></span>
              <span class="r18-name">Brasil</span>
              <input type="number" class="form-control" id="resultado-brasil-d-3" name="resultado-brasil-d-3" min="0" required>
            </div>
            <div class="r18-team-r">
              <input type="number" class="form-control" id="resultado-colombia-d-3" name="resultado-colombia-d-3" min="0" required>
              <span class="r18-name">Colombia</span>
              <span class="flag-icon flag-icon-co"></span>
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