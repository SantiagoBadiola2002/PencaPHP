<?php
session_start();

if (!isset($_SESSION['ci'])) {
  header("Location: ../index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../principales/estilos.css" rel="stylesheet">
  </head>
<body>

<?php include '../componentes/navbarAdmin.html'; ?>

<div style="text-align: center;">
  <h1>PENCA COPA AMÉRICA 2024</h1>
  <img src="../imagenes/imagen1.jpeg" alt="Logo utec" style="width: 400px; height: 400px;">
</div>


<footer style="text-align: center; margin-top: 20px;">
  <p>© Santiago Badiola y Natalia Lopez</p>
</footer>

</body>
</html>