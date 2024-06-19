<?php
session_start();

if (!isset($_SESSION['ci'])) {
    header("Location: ../index.php");
    exit();
}
include 'config.php';

$conexion = new mysqli($servidor, $usuario_db, $contrasenia_db, $base_de_datos);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $consulta = "SELECT id, equipo_1, equipo_2 FROM Partidos";
    $resultado = $conexion->query($consulta);

    echo "Aqui <br>";
    if ($resultado->num_rows > 0) {
        echo "Aqui <br>";
        while ($row = $resultado->fetch_assoc()) {
            //echo "Aqui <br>";
            $id = $row['id'];
            $partido_id = $row['id'];
            $equipo_1 = $row['equipo_1'];
            $equipo_2 = $row['equipo_2'];
            $campo_equipo_1 = "resultado-$equipo_1-$id";
            $campo_equipo_2 = "resultado-$equipo_2-$id";
            if (isset($_POST[$campo_equipo_1]) && isset($_POST[$campo_equipo_2])) {
                $goles_equipo_1 = isset($_POST["resultado-$equipo_1-$partido_id"]) ? $_POST["resultado-$equipo_1-$partido_id"] : '';
                $goles_equipo_2 = isset($_POST["resultado-$equipo_2-$partido_id"]) ? $_POST["resultado-$equipo_2-$partido_id"] : '';
                $jugado = isset($_POST["jugado$partido_id"]) && $_POST["jugado$partido_id"] == 1 ? 1 : 0;

                if ($jugado == 1) {
                    $update_sql = "UPDATE Partidos SET 
                                    goles_equipo_1 = '$goles_equipo_1', 
                                    goles_equipo_2 = '$goles_equipo_2', 
                                    jugado = '$jugado' 
                                    WHERE id = '$id'";

                    if ($conexion->query($update_sql) === TRUE) {
                        echo "Registro actualizado exitosamente<br>";
                    } else {
                        echo "Error actualizando el registro: " . $conexion->error . "<br>";
                    }
                }
            }
        }
    }
}
if ($resultado) {
   echo "<script>alert('Registro actualizado exitosamente<br>'); window.location.href = '../principales/indexAdmin.php';</script>";
} else {
  echo "<script>alert('Error actualizando el registro: " . $conexion->error . "<br>'); window.location.href = '../principales/crearPenca.php';</script>";
}
$conexion->close();
?>