<?php
include 'config.php';

$conexion = new mysqli($servidor, $usuario_db, $contrasenia_db, $base_de_datos);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $ci = $_POST["ci"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $contrasenia = md5($_POST["contrasenia"]);

    $existenUsuarios = "SELECT * FROM Usuario";
    $resultado = $conexion->query($existenUsuarios);

    if($resultado->num_rows > 0){
        
    } else {
        $contraseniaAdmin = md5('penca2024');
        $consultaCrearUsuario = "INSERT INTO Usuario Values (000, 'admin', 'admin', 'penca2024@tallerphp.uy', '$contraseniaAdmin')";
        $crearUsuario = $conexion->query($consultaCrearUsuario);
    }
    

    $existeUsuario = "SELECT * FROM Usuario WHERE ci = '$ci' OR email = '$correo'";
    $resultado_verificar = $conexion->query($existeUsuario);

    if ($resultado_verificar->num_rows > 0) {
        echo "<script>alert('Error: CI y/o correo ya registado!'); window.location.href = '../registrarse.php';</script>";
    } else {
        $consulta = "INSERT INTO Usuario (ci, nombre, apellido, email, contrasenia)
VALUES ('$ci', '$nombre', '$apellido', '$correo', '$contrasenia')";

$resultado = $conexion->query($consulta);

if ($resultado) {
    echo "<script>alert('¡Usuario registrado exitosamente!'); window.location.href = '../index.php';</script>";
} else {
    echo "<script>alert('Error al registrar el usuario!'); window.location.href = '../principales/registrarse.php';</script>";
}
    }

}
$conexion->close();
?>
