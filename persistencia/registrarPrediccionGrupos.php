<?php
session_start();

if (!isset($_SESSION['ci'])) {
  header("Location: ../index.php");
  exit();
}
include 'config.php';

$conexion = new mysqli($servidor, $usuario_db, $contrasenia_db, $base_de_datos);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $resultado_peru_a = $_POST["resultado-peru-a"];
    $resultado_argentina_a = $_POST["resultado-argentina-a"];

    $resultado_chile_a = $_POST["resultado-chile-a"];
    $resultado_canada_a = $_POST["resultado-canada-a"];

    $resultado_colombia_b = $_POST["resultado-colombia-b"];
    $resultado_mexico_b = $_POST["resultado-mexico-b"];

    $resultado_venezuela_b = $_POST["resultado-venezuela-b"];
    $resultado_jamaica_b = $_POST["resultado-jamaica-b"];

    $resultado_estados_unidos_c = $_POST["resultado-estados-unidos-c"];
    $resultado_uruguay_c = $_POST["resultado-uruguay-c"];

    $resultado_republica_dominicana_c = $_POST["resultado-republica-dominicana-c"];
    $resultado_bolivia_c = $_POST["resultado-bolivia-c"];

    $resultado_brasil_d = $_POST["resultado-brasil-d"];
    $resultado_ecuador_d = $_POST["resultado-ecuador-d"];

    $resultado_paraguay_d = $_POST["resultado-paraguay-d"];
    $resultado_honduras_d = $_POST["resultado-honduras-d"];

    //CREAR LA PREDICCION -> TABLA PREDICCION
    $ciUsuario = htmlspecialchars($_SESSION['ci']);
    $nombrePrediccion = $_POST["nombre-prediccion"];

    $existePrediccion = "SELECT * FROM Predicciones WHERE usuario_ci = '$ciUsuario' AND nombre = '$nombrePrediccion'";
    $resultado_verificar = $conexion->query($existePrediccion);

    if ($resultado_verificar->num_rows > 0) {
      echo "<script>alert('Error: Ya existe una prediccion con ese nombre!'); window.location.href = '../formularios/prediccionGrupos.php';</script>";
  } else {

    $consulta = "INSERT INTO Predicciones (usuario_ci, nombre) VALUES ('$ciUsuario', '$nombrePrediccion')";

    $resultado = $conexion->query($consulta);

    //CONSEGUIR EL ID DE LA PREDICCION
    $idPrediccion = $conexion->insert_id;


    //LLENAR LA TABLA PREDICCION_PARTIDOS
    $consulta = "INSERT INTO Prediccion_Partidos (idPrediccion, partido_id, prediccion_goles_Equipo1, prediccion_goles_Equipo2) VALUES
    ($idPrediccion, 1, $resultado_argentina_a, $resultado_peru_a), 
    ($idPrediccion, 2, $resultado_chile_a, $resultado_canada_a),
    ($idPrediccion, 3, $resultado_mexico_b, $resultado_colombia_b),
    ($idPrediccion, 4, $resultado_venezuela_b, $resultado_jamaica_b),
    ($idPrediccion, 5, $resultado_estados_unidos_c, $resultado_uruguay_c),
    ($idPrediccion, 6, $resultado_republica_dominicana_c, $resultado_bolivia_c),
    ($idPrediccion, 7, $resultado_brasil_d, $resultado_ecuador_d),
    ($idPrediccion, 8, $resultado_paraguay_d, $resultado_honduras_d)";
    //GRUPO A: ARGENTINA VS PERU
    //GRUPO A: CHILE VS CANADA
    //GRUPO B: MEXICO VS COLOMBIA
    //GRUPO B: VENEZUELA VS JAMAICA
    //GRUPO C: EE.UU VS URUGUAY
    //GRUPO C: REPUBLIC DOMINICANA VS BOLIVIA
    //GRUPO D: BRASIL VS ECUADOR
    //GRUPO D: PÀRAGUAY VS HONDURAS

    $resultado = $conexion->query($consulta);
    

    
}    

//if ($resultado) {
 //   echo "<script>alert('Penca registrads exitosamente!'); window.location.href = '../principales/indexLogeado.php';</script>";
//} else {
  //  echo "<script>alert('¡Error al crear la penca!'); window.location.href = '../principales/crearPenca.php';</script>";
//}

echo "<script>alert('Predicciones guardadas exitosamente!'); window.location.href = '../principales/indexLogeado.php';</script>";

$conexion->close();
}
?>
