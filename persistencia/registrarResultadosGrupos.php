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

    // Crear una consulta de actualización para cada partido
$consultas = [
    "UPDATE Partidos SET goles_equipo_1 = $resultado_argentina_a, goles_equipo_2 = $resultado_peru_a WHERE equipo_1 = 'Argentina' AND equipo_2 = 'Peru'",
    "UPDATE Partidos SET goles_equipo_1 = $resultado_chile_a, goles_equipo_2 = $resultado_canada_a WHERE equipo_1 = 'Chile' AND equipo_2 = 'Canada'",
    "UPDATE Partidos SET goles_equipo_1 = $resultado_mexico_b, goles_equipo_2 = $resultado_colombia_b WHERE equipo_1 = 'Mexico' AND equipo_2 = 'Colombia'",
    "UPDATE Partidos SET goles_equipo_1 = $resultado_venezuela_b, goles_equipo_2 = $resultado_jamaica_b WHERE equipo_1 = 'Venezuela' AND equipo_2 = 'Jamaica'",
    "UPDATE Partidos SET goles_equipo_1 = $resultado_estados_unidos_c, goles_equipo_2 = $resultado_uruguay_c WHERE equipo_1 = 'Estados Unidos' AND equipo_2 = 'Uruguay'",
    "UPDATE Partidos SET goles_equipo_1 = $resultado_republica_dominicana_c, goles_equipo_2 = $resultado_bolivia_c WHERE equipo_1 = 'Republica Dominicana' AND equipo_2 = 'Bolivia'",
    "UPDATE Partidos SET goles_equipo_1 = $resultado_brasil_d, goles_equipo_2 = $resultado_ecuador_d WHERE equipo_1 = 'Brasil' AND equipo_2 = 'Ecuador'",
    "UPDATE Partidos SET goles_equipo_1 = $resultado_paraguay_d, goles_equipo_2 = $resultado_honduras_d WHERE equipo_1 = 'Paraguay' AND equipo_2 = 'Honduras'"
];

// Ejecutar cada consulta
foreach ($consultas as $consulta) {
    if ($conexion->query($consulta) === TRUE) {
        echo "Registro actualizado exitosamente<br>";
    } else {
        echo "Error actualizando el registro: " . $conexion->error . "<br>";
    }
}
    

    
}    

//if ($resultado) {
 //   echo "<script>alert('Penca registrads exitosamente!'); window.location.href = '../principales/indexLogeado.php';</script>";
//} else {
  //  echo "<script>alert('¡Error al crear la penca!'); window.location.href = '../principales/crearPenca.php';</script>";
//}

echo "<script>alert('Resultados ingresados exitosamente!'); window.location.href = '../principales/indexLogeado.php';</script>";

$conexion->close();
?>
