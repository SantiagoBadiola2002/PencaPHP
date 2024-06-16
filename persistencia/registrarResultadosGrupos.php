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

    $jugado1 = isset($_POST['jugado1']) ? $_POST['jugado1'] : 0;
    $jugado2 = isset($_POST['jugado2']) ? $_POST['jugado2'] : 0;
    $jugado3 = isset($_POST['jugado3']) ? $_POST['jugado3'] : 0;
    $jugado4 = isset($_POST['jugado4']) ? $_POST['jugado4'] : 0;
    $jugado5 = isset($_POST['jugado5']) ? $_POST['jugado5'] : 0;
    $jugado6 = isset($_POST['jugado6']) ? $_POST['jugado6'] : 0;
    $jugado7 = isset($_POST['jugado7']) ? $_POST['jugado7'] : 0;
    $jugado8 = isset($_POST['jugado8']) ? $_POST['jugado8'] : 0;

    echo "Valores de jugado: ";
echo "jugado1 = $jugado1, ";
echo "jugado2 = $jugado2, ";
echo "jugado3 = $jugado3, ";
echo "jugado4 = $jugado4, ";
echo "jugado5 = $jugado5, ";
echo "jugado6 = $jugado6, ";
echo "jugado7 = $jugado7, ";
echo "jugado8 = $jugado8<br>";

    $consultas = [
        ["jugado" => $jugado1, "query" => "UPDATE Partidos SET goles_equipo_1 = $resultado_argentina_a, goles_equipo_2 = $resultado_peru_a , jugado = $jugado1 WHERE equipo_1 = 'Argentina' AND equipo_2 = 'Peru'"],
        ["jugado" => $jugado2, "query" => "UPDATE Partidos SET goles_equipo_1 = $resultado_chile_a, goles_equipo_2 = $resultado_canada_a , jugado = $jugado2 WHERE equipo_1 = 'Chile' AND equipo_2 = 'Canada'"],
        ["jugado" => $jugado3, "query" => "UPDATE Partidos SET goles_equipo_1 = $resultado_mexico_b, goles_equipo_2 = $resultado_colombia_b , jugado = $jugado3 WHERE equipo_1 = 'Mexico' AND equipo_2 = 'Colombia'"],
        ["jugado" => $jugado4, "query" => "UPDATE Partidos SET goles_equipo_1 = $resultado_venezuela_b, goles_equipo_2 = $resultado_jamaica_b , jugado = $jugado4 WHERE equipo_1 = 'Venezuela' AND equipo_2 = 'Jamaica'"],
        ["jugado" => $jugado5, "query" => "UPDATE Partidos SET goles_equipo_1 = $resultado_estados_unidos_c, goles_equipo_2 = $resultado_uruguay_c , jugado = $jugado5 WHERE equipo_1 = 'Estados Unidos' AND equipo_2 = 'Uruguay'"],
        ["jugado" => $jugado6, "query" => "UPDATE Partidos SET goles_equipo_1 = $resultado_republica_dominicana_c, goles_equipo_2 = $resultado_bolivia_c , jugado = $jugado6 WHERE equipo_1 = 'Republica Dominicana' AND equipo_2 = 'Bolivia'"],
        ["jugado" => $jugado7, "query" => "UPDATE Partidos SET goles_equipo_1 = $resultado_brasil_d, goles_equipo_2 = $resultado_ecuador_d , jugado = $jugado7 WHERE equipo_1 = 'Brasil' AND equipo_2 = 'Ecuador' "],
        ["jugado" => $jugado8, "query" => "UPDATE Partidos SET goles_equipo_1 = $resultado_paraguay_d, goles_equipo_2 = $resultado_honduras_d , jugado = $jugado8 WHERE equipo_1 = 'Paraguay' AND equipo_2 = 'Honduras'"]
    ];
    
    // Ejecutar cada consulta solo si jugado es distinto de 0
    foreach ($consultas as $consulta) {
        if ($consulta["jugado"] != 0) {
            echo  $consulta["query"] . "<br>";
            if ($conexion->query($consulta["query"]) === TRUE) {
                echo "Registro actualizado exitosamente<br>";
            } else {
                echo "Error actualizando el registro: " . $conexion->error . "<br>";
            }
        }
    }


}

//if ($resultado) {
//   echo "<script>alert('Penca registrads exitosamente!'); window.location.href = '../principales/indexLogeado.php';</script>";
//} else {
//  echo "<script>alert('¡Error al crear la penca!'); window.location.href = '../principales/crearPenca.php';</script>";
//}

//echo "<script>alert('Resultados ingresados exitosamente!'); window.location.href = '../principales/indexAdmin.php';</script>";

$conexion->close();
?>