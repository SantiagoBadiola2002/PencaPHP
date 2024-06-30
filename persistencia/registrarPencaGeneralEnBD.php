<?php
session_start();

if (!isset($_SESSION['ci'])) {
  header("Location: ../index.php");
  exit();
}
include 'config.php';

$conexion = new mysqli($servidor, $usuario_db, $contrasenia_db, $base_de_datos);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nombrePenca = $_POST["nombre-penca"];
    $idPrediccion = $_POST["prediccion-nombre"]; // -> LLEGA EL idPrediccion
    $ci = htmlspecialchars($_SESSION['ci']);

    $existePenncaGeneral = "SELECT * FROM Penca_General WHERE Usuario = '$ci' AND nombre = '$nombrePenca'";
    $resultado_verificar = $conexion->query($existePenncaGeneral); 

    if ($resultado_verificar->num_rows > 0) {
        echo "<script>alert('Error: Ya existe una Penca General con ese nombre!'); window.location.href = '../formularios/crearPencaGeneral.php';</script>";
    } else {

    $consulta = "INSERT INTO Penca_General (nombre, Usuario, idPrediccion) VALUES ('$nombrePenca','$ci', $idPrediccion)";

    $resultado = $conexion->query($consulta);

if ($resultado) {
    echo "<script>alert('Penca registrada exitosamente!'); window.location.href = '../principales/indexLogeado.php';</script>";
} else {
    echo "<script>alert('¡Error al crear la penca!'); window.location.href = '../principales/crearPenca.php';</script>";
}


    }
}
$conexion->close();
?>
