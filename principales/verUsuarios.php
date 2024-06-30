<?php
session_start();

if (!isset($_SESSION['ci'])) {
    header("Location: ../index.php");
    exit();
}

include '../persistencia/config.php';

$conexion = new mysqli($servidor, $usuario_db, $contrasenia_db, $base_de_datos);

$consulta = "SELECT
    u.ci,
    u.nombre AS nombre_usuario,
    u.apellido,
    u.email,
    pg.idPencaGeneral AS id_penca,
    pg.nombre AS nombre_penca,
    'General' AS tipo_penca,
    pg.puntosActuales AS puntos_actuales,
    pg.puesto
FROM
    Usuario u
JOIN
    Penca_General pg ON u.ci = pg.Usuario
UNION
SELECT
    u.ci,
    u.nombre AS nombre_usuario,
    u.apellido,
    u.email,
    pg.idPencaGrupal AS id_penca,
    pg.nombre AS nombre_penca,
    'Grupal' AS tipo_penca,
    pg.puntosActuales AS puntos_actuales,
    pg.puesto
FROM
    Usuario u
JOIN
    Penca_Grupal pg ON u.ci = pg.Usuario;";

$usuarios = $conexion->query($consulta);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Usuarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="../principales/estilos.css" rel="stylesheet">
    <style>
    .form-container {
        max-width: 1000px;
        margin: 50px auto;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow-x: auto; /* Permitir desplazamiento horizontal si la tabla es más ancha */
    }

    .table {
        width: 100%; /* Asegura que la tabla ocupe todo el ancho del contenedor */
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
    }

    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }

    .table tbody + tbody {
        border-top: 2px solid #dee2e6;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.05);
    }
</style>
</head>
<body>
<?php include '../componentes/navbarAdmin.html'; ?>

<div class="container-fluid">
<div class="form-container">

<h1 style="text-align: center;">Listado de Usuarios y sus Pencas</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>CI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Penca ID</th>
                    <th>Nombre Penca</th>
                    <th>Tipo</th>
                    <th>Puntos</th>
                    <th>Puesto</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $usuarios->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['ci']; ?></td>
                        <td><?php echo $row['nombre_usuario']; ?></td>
                        <td><?php echo $row['apellido']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['id_penca']; ?></td>
                        <td><?php echo $row['nombre_penca']; ?></td>
                        <td><?php echo $row['tipo_penca']; ?></td>
                        <td><?php echo $row['puntos_actuales']; ?></td>
                        <td><?php echo $row['puesto']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <form action="generar_pdf.php" method="post">
            <button type="submit" class="btn btn-primary">Generar PDF</button>
        </form>
    </div>
    </div>
</body>
</html>

<?php
$conexion->close();
?>