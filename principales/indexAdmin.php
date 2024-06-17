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
    <style>
        .form-container {
            max-width: 650px; 
            margin: 50px auto;
            padding: 5px; 
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
  </head>
<body>

<?php include '../componentes/navbarAdmin.html'; ?>

<div class="container-fluid">
<div class="form-container">
  <h1 style="text-align: center;">PENCA ADMIN</h1>
  </div>
</div>
<div style="text-align: center;">
  <img src="../imagenes/imagen1.jpeg" alt="Logo IA" style="width: 400px; height: 400px;">
</div>


<footer style="text-align: center; margin-top: 20px;">
  <p>© Santiago Badiola y Natalia Lopez</p>
</footer>

</body>
</html>