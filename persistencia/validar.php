<?php
session_start();

include 'config.php';

$conexion = new mysqli($servidor, $usuario_db, $contrasenia_db, $base_de_datos);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $contrasenia = md5($_POST["contrasenia"]);
   
    $consulta = "SELECT * FROM Usuario WHERE email = '$correo' AND Contrasenia = '$contrasenia'";
    $resultado = $conexion->query($consulta);

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $_SESSION['ci'] = $row['ci'];

        // Verificar si el usuario es administrador
        if ($row['ci'] == 0) {
            // Si es administrador, redireccionar a otra página para administradores
            header("Location: ../principales/indexAdmin.php");
        } else {
            // Si no es administrador, redireccionar a la página normal para usuarios logeados
            header("Location: ../principales/indexLogeado.php");
        }
    } else {
        echo "<script>alert('Usuario no encontrado. Por favor, verifica tus credenciales.'); window.location.href = '../index.php';</script>";
    }
}

$conexion->close();
?>
