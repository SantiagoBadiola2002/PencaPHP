<?php

include '../persistencia/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['correo'];
    $new_password = md5($_POST['new_password']);

    $conexion = new mysqli($servidor, $usuario_db, $contrasenia_db, $base_de_datos);

    if ($conexion->connect_error) {
        die("La conexión falló: " . $conexion->connect_error);
    }

    $consulta = "UPDATE Usuario SET contrasenia = '$new_password' WHERE email = '$email'";
    $resultado = $conexion->query($consulta); 

    $consultaNombre = "SELECT nombre FROM Usuario WHERE email = '$email'";
    $nombre_result = $conexion->query($consultaNombre);
    $nombre_row = $nombre_result->fetch_assoc();

    $nombre = $nombre_row['nombre'];
    $correo = $_POST['correo'];
    $asunto = "Cambio de Contraseña Penca2024";
    $mensaje = "Buenas $nombre, su cambio de contraseña ha sido un éxito.";
    $header = "From: penca2024@tallerphp.uy" . "\r\n";
    $header .= "Reply-To: $email" . "\r\n";
    $header .= "X-Mailer: PHP/" . phpversion();
    mail($email, $asunto, $mensaje, $header);



    if ($resultado) {
        echo "<script>alert('¡Contraseña cambiada exitosamente!'); window.location.href = '../index.php';</script>";
    } else {
        echo "<script>alert('Error al cambiar la contraseña!'); window.location.href = '../index.php';</script>";
    }
}
$conexion->close();
?>