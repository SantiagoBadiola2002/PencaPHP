<?php
session_start();

if (!isset($_SESSION['ci'])) {
  header("Location: ../index.php");
  exit();
}
include 'config.php';

$conexion = new mysqli($servidor, $usuario_db, $contrasenia_db, $base_de_datos);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
   
  $resultado_argentina_a_1 = $_POST["resultado-argentina-a-1"];
  $resultado_canada_a_1 = $_POST["resultado-canada-a-1"];
  
  $resultado_peru_a_1 = $_POST["resultado-peru-a-1"];
  $resultado_chile_a_1 = $_POST["resultado-chile-a-1"];
  
  $resultado_ecuador_b_1 = $_POST["resultado-ecuador-b-1"];
  $resultado_venezuela_b_1 = $_POST["resultado-venezuela-b-1"];
  
  $resultado_mexico_b_1 = $_POST["resultado-mexico-b-1"];
  $resultado_jamaica_b_1 = $_POST["resultado-jamaica-b-1"];
  
  $resultado_estados_unidos_c_1 = $_POST["resultado-estados-unidos-c-1"];
  $resultado_bolivia_c_1 = $_POST["resultado-bolivia-c-1"];
  
  $resultado_uruguay_c_1 = $_POST["resultado-uruguay-c-1"];
  $resultado_panama_c_1 = $_POST["resultado-panama-c-1"];
  
  $resultado_colombia_d_1 = $_POST["resultado-colombia-d-1"];
  $resultado_paraguay_d_1 = $_POST["resultado-paraguay-d-1"];
  
  $resultado_brasil_d_1 = $_POST["resultado-brasil-d-1"];
  $resultado_costa_rica_d_1 = $_POST["resultado-costa-rica-d-1"];


  $resultado_argentina_a_2 = $_POST["resultado-argentina-a-2"];
$resultado_chile_a_2 = $_POST["resultado-chile-a-2"];

$resultado_peru_a_2 = $_POST["resultado-peru-a-2"];
$resultado_canada_a_2 = $_POST["resultado-canada-a-2"];

$resultado_ecuador_b_2 = $_POST["resultado-ecuador-b-2"];
$resultado_jamaica_b_2 = $_POST["resultado-jamaica-b-2"];

$resultado_mexico_b_2 = $_POST["resultado-mexico-b-2"];
$resultado_venezuela_b_2 = $_POST["resultado-venezuela-b-2"];

$resultado_uruguay_c_2 = $_POST["resultado-uruguay-c-2"];
$resultado_bolivia_c_2 = $_POST["resultado-bolivia-c-2"];

$resultado_estados_unidos_c_2 = $_POST["resultado-estados-unidos-c-2"];
$resultado_panama_c_2 = $_POST["resultado-panama-c-2"];

$resultado_colombia_d_2 = $_POST["resultado-colombia-d-2"];
$resultado_costa_rica_d_2 = $_POST["resultado-costa-rica-d-2"];

$resultado_brasil_d_2 = $_POST["resultado-brasil-d-2"];
$resultado_paraguay_d_2 = $_POST["resultado-paraguay-d-2"];


$resultado_argentina_a_3 = $_POST["resultado-argentina-a-3"];
$resultado_peru_a_3 = $_POST["resultado-peru-a-3"];

$resultado_chile_a_3 = $_POST["resultado-chile-a-3"];
$resultado_canada_a_3 = $_POST["resultado-canada-a-3"];

$resultado_jamaica_b_3 = $_POST["resultado-jamaica-b-3"];
$resultado_venezuela_b_3 = $_POST["resultado-venezuela-b-3"];

$resultado_mexico_b_3 = $_POST["resultado-mexico-b-3"];
$resultado_ecuador_b_3 = $_POST["resultado-ecuador-b-3"];

$resultado_panama_c_3 = $_POST["resultado-panama-c-3"];
$resultado_bolivia_c_3 = $_POST["resultado-bolivia-c-3"];

$resultado_estados_unidos_c_3 = $_POST["resultado-estados-unidos-c-3"];
$resultado_uruguay_c_3 = $_POST["resultado-uruguay-c-3"];

$resultado_costa_rica_d_3 = $_POST["resultado-costa-rica-d-3"];
$resultado_paraguay_d_3 = $_POST["resultado-paraguay-d-3"];

$resultado_brasil_d_3 = $_POST["resultado-brasil-d-3"];
$resultado_colombia_d_3 = $_POST["resultado-colombia-d-3"];

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
    $consulta = "INSERT INTO Prediccion_Partidos (idPrediccion, partido_id, prediccion_goles_Equipo1, prediccion_goles_Equipo2, puntosPartido) VALUES
     ($idPrediccion, 1, $resultado_argentina_a_1, $resultado_canada_a_1, 0), 
    ($idPrediccion, 2, $resultado_peru_a_1, $resultado_chile_a_1, 0),
    ($idPrediccion, 3, $resultado_ecuador_b_1, $resultado_venezuela_b_1, 0),
    ($idPrediccion, 4, $resultado_mexico_b_1, $resultado_jamaica_b_1, 0),
    ($idPrediccion, 5, $resultado_estados_unidos_c_1, $resultado_bolivia_c_1, 0),
    ($idPrediccion, 6, $resultado_uruguay_c_1, $resultado_panama_c_1, 0),
    ($idPrediccion, 7, $resultado_colombia_d_1, $resultado_paraguay_d_1, 0),
    ($idPrediccion, 8, $resultado_brasil_d_1, $resultado_costa_rica_d_1, 0)";
    
    $resultado = $conexion->query($consulta);

    $consulta = "INSERT INTO Prediccion_Partidos (idPrediccion, partido_id, prediccion_goles_Equipo1, prediccion_goles_Equipo2, puntosPartido) VALUES
    ($idPrediccion, 9, $resultado_argentina_a_2, $resultado_chile_a_2, 0), 
    ($idPrediccion, 10, $resultado_peru_a_2, $resultado_canada_a_2, 0),
    ($idPrediccion, 11, $resultado_ecuador_b_2, $resultado_jamaica_b_2, 0),
    ($idPrediccion, 12, $resultado_mexico_b_2, $resultado_venezuela_b_2, 0),
    ($idPrediccion, 13, $resultado_uruguay_c_2, $resultado_bolivia_c_2, 0),
    ($idPrediccion, 14, $resultado_estados_unidos_c_2, $resultado_panama_c_2, 0),
    ($idPrediccion, 15, $resultado_colombia_d_2, $resultado_costa_rica_d_2, 0),
    ($idPrediccion, 16, $resultado_brasil_d_2, $resultado_paraguay_d_2, 0)";
    
    $resultado = $conexion->query($consulta);

    $consulta = "INSERT INTO Prediccion_Partidos (idPrediccion, partido_id, prediccion_goles_Equipo1, prediccion_goles_Equipo2, puntosPartido) VALUES
    ($idPrediccion, 17, $resultado_argentina_a_3, $resultado_peru_a_3, 0), 
    ($idPrediccion, 18, $resultado_chile_a_3, $resultado_canada_a_3, 0),
    ($idPrediccion, 19, $resultado_jamaica_b_3, $resultado_venezuela_b_3, 0),
    ($idPrediccion, 20, $resultado_mexico_b_3, $resultado_ecuador_b_3, 0),
    ($idPrediccion, 21, $resultado_panama_c_3, $resultado_bolivia_c_3, 0),
    ($idPrediccion, 22, $resultado_estados_unidos_c_3, $resultado_uruguay_c_3, 0),
    ($idPrediccion, 23, $resultado_costa_rica_d_3, $resultado_paraguay_d_3, 0),
    ($idPrediccion, 24, $resultado_brasil_d_3, $resultado_colombia_d_3, 0)";
    
    $resultado = $conexion->query($consulta);
    
//echo $consulta;
    
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
