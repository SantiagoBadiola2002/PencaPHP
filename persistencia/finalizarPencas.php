<?php
session_start();

if (!isset($_SESSION['ci'])) {
    header("Location: ../index.php");
    exit();
}

include '../persistencia/config.php';

$conexion = new mysqli($servidor, $usuario_db, $contrasenia_db, $base_de_datos);

//CALCULAR PUNTOS DE LAS PENCAS GENERALES

// Obtener todas las Pencas Generales
$sqlPencasGenerales = "SELECT * FROM Penca_General";
$resultadoPencasGenerales = $conexion->query($sqlPencasGenerales);

// Recorrer todas las Pencas Generales
while ($filaPenca = $resultadoPencasGenerales->fetch_assoc()) {
    $idPencaGeneral = $filaPenca['idPencaGeneral'];
    $idPrediccion = $filaPenca['idPrediccion'];
    $puntosActuales = 0;

    // Obtener todas las predicciones asociadas a esta Penca General
    $sqlPredicciones = "SELECT * FROM Prediccion_Partidos WHERE idPrediccion = $idPrediccion";
    $resultadoPredicciones = $conexion->query($sqlPredicciones);

    // Recorrer todas las predicciones asociadas a esta Penca General
    while ($filaPrediccion = $resultadoPredicciones->fetch_assoc()) {
        $partido_id = $filaPrediccion['partido_id'];
        $prediccion_goles_Equipo1 = $filaPrediccion['prediccion_goles_Equipo1'];
        $prediccion_goles_Equipo2 = $filaPrediccion['prediccion_goles_Equipo2'];

        // Obtener los resultados del partido
        $sqlPartido = "SELECT goles_equipo_1, goles_equipo_2 FROM Partidos WHERE id = $partido_id AND jugado = 1";
        $resultadoPartido = $conexion->query($sqlPartido);
        $filaPartido = $resultadoPartido->fetch_assoc();
        $goles_equipo_1 = $filaPartido['goles_equipo_1'];
        $goles_equipo_2 = $filaPartido['goles_equipo_2'];

        if ($resultadoPartido->num_rows > 0) {
        // Comparar la predicción con el resultado del partido y asignar puntos
       if ($goles_equipo_1 == $prediccion_goles_Equipo1 && $goles_equipo_2 == $prediccion_goles_Equipo2) {
            $puntosActuales += 5; // Resultado exacto, 5 puntos
            $sqlActualizarPuntosDelPartido = "UPDATE Prediccion_Partidos SET puntosPartido = 5 WHERE partido_id = '$partido_id' AND idPrediccion = '$idPrediccion'";
            $conexion->query($sqlActualizarPuntosDelPartido);
        } elseif (($goles_equipo_1 - $goles_equipo_2) == ($prediccion_goles_Equipo1 - $prediccion_goles_Equipo2)) {
            $puntosActuales += 3; // Ganador y Diferencia de goles correcta, 3 puntos
            $sqlActualizarPuntosDelPartido = "UPDATE Prediccion_Partidos SET puntosPartido = 3 WHERE partido_id = '$partido_id' AND idPrediccion = '$idPrediccion'";
            $conexion->query($sqlActualizarPuntosDelPartido);
        } elseif ((($goles_equipo_1 >= $goles_equipo_2) && ($prediccion_goles_Equipo1 >= $prediccion_goles_Equipo2)) || (($goles_equipo_1 <= $goles_equipo_2) && ($resultado_goles_Equipo1 <= $resultado_goles_Equipo2))) {
            $puntosActuales += 2; // Ganador, 2 puntos
            $sqlActualizarPuntosDelPartido = "UPDATE Prediccion_Partidos SET puntosPartido = 2 WHERE partido_id = '$partido_id' AND idPrediccion = '$idPrediccion'";
            $conexion->query($sqlActualizarPuntosDelPartido);
        }
    }

    }

    // Actualizar los puntos actuales en la Penca General
    $sqlActualizarPuntos = "UPDATE Penca_General SET puntosActuales = $puntosActuales WHERE idPencaGeneral = $idPencaGeneral";
    $conexion->query($sqlActualizarPuntos);

    // Liberar los resultados de la consulta de predicciones
    $resultadoPredicciones->free();
}

// Actualizar los puestos
$sqlActualizarPuestosPencaGeneral = "SET @row_number = 0; UPDATE Penca_General SET puesto = (@row_number:=@row_number+1) ORDER BY puntosActuales DESC";
$conexion->multi_query($sqlActualizarPuestosPencaGeneral);


$conexion2 = new mysqli($servidor, $usuario_db, $contrasenia_db, $base_de_datos);

//CALCULAR PUNTOS DE LAS PENCAS GRUPALES
// Obtener todas las Pencas Grupales
$sqlPencasGrupales = "SELECT * FROM Penca_Grupal";
$resultadoPencasGrupales = $conexion2->query($sqlPencasGrupales);

// Recorrer todas las Pencas Grupales
while ($filaPenca = $resultadoPencasGrupales->fetch_assoc()) {
    $idPencaGrupal = $filaPenca['idPencaGrupal'];
    $idPrediccion = $filaPenca['idPrediccion'];
    $puntosActuales = 0;

    // Obtener todas las predicciones asociadas a esta Penca Grupal
    $sqlPredicciones = "SELECT * FROM Prediccion_Partidos WHERE idPrediccion = $idPrediccion";
    $resultadoPredicciones = $conexion2->query($sqlPredicciones);

    // Recorrer todas las predicciones asociadas a esta Penca Grupal
    while ($filaPrediccion = $resultadoPredicciones->fetch_assoc()) {
        $partido_id = $filaPrediccion['partido_id'];
        $prediccion_goles_Equipo1 = $filaPrediccion['prediccion_goles_Equipo1'];
        $prediccion_goles_Equipo2 = $filaPrediccion['prediccion_goles_Equipo2'];

        // Obtener los resultados del partido
        $sqlPartido = "SELECT goles_equipo_1, goles_equipo_2 FROM Partidos WHERE id = $partido_id";
        $resultadoPartido = $conexion2->query($sqlPartido);
        $filaPartido = $resultadoPartido->fetch_assoc();
        $goles_equipo_1 = $filaPartido['goles_equipo_1'];
        $goles_equipo_2 = $filaPartido['goles_equipo_2'];

        // Comparar la predicción con el resultado del partido y asignar puntos
        if ($goles_equipo_1 == $resultado_goles_Equipo1 && $goles_equipo_2 == $resultado_goles_Equipo2) {
            $puntosActuales += 5; // Resultado exacto, 5 puntos
            $puntosActuales += 2; // Ganador, 2 puntos
        } elseif (($goles_equipo_1 - $goles_equipo_2) == ($resultado_goles_Equipo1 - $resultado_goles_Equipo2)) {
            $puntosActuales += 3; // Ganador y Diferencia de goles correcta, 3 puntos
        } elseif ((($goles_equipo_1 > $goles_equipo_2) && ($resultado_goles_Equipo1 > $resultado_goles_Equipo2)) || (($goles_equipo_1 < $goles_equipo_2) && ($resultado_goles_Equipo1 < $resultado_goles_Equipo2))) {
            $puntosActuales += 2; // Ganador, 2 puntos
        }

    }

    // Actualizar los puntos actuales en la Penca Grupal
    $sqlActualizarPuntos = "UPDATE Penca_Grupal SET puntosActuales = $puntosActuales WHERE idPencaGrupal = $idPencaGrupal";
    $conexion2->query($sqlActualizarPuntos);

    // Liberar los resultados de la consulta de predicciones
    $resultadoPredicciones->free();
}

// Actualizar los puestos
$sqlActualizarPuestosPencaGrupal = "SET @row_number = 0; UPDATE Penca_Grupal SET puesto = (@row_number:=@row_number+1) ORDER BY puntosActuales DESC";
$conexion2->multi_query($sqlActualizarPuestosPencaGrupal);

echo "<script>alert('¡Pencas finalizas exitosamente!'); window.location.href = '../principales/indexAdmin.php';</script>";
?>