<?php
session_start();

if (!isset($_SESSION['ci'])) {
    header("Location: ../index.php");
    exit();
}

include '../persistencia/config.php';

$conexion = new mysqli($servidor, $usuario_db, $contrasenia_db, $base_de_datos);

$ci = htmlspecialchars($_SESSION['ci']);

//PASO 1: OBTENER TODOS LOS PARTIDOS
//########################################################
$sqlPartidos = "SELECT id, goles_equipo_1, goles_equipo_2 FROM Partidos";
$resultadoPartidos = $conexion->query($sqlPartidos);

if ($resultadoPartidos->num_rows > 0) {
    echo "Array de Partidos:<br>";
    while($fila = $resultadoPartidos->fetch_assoc()) {
        echo "ID del partido: " . $fila["id"] . " - Goles equipo 1: " . $fila["goles_equipo_1"] . " - Goles equipo 2: " . $fila["goles_equipo_2"] . "<br>";
    }
} else {
    echo "0 resultados";
}
//#########################################################
//PASO 2: OBTENER TODAS LAS PREDICCIONES DEL USUARIO ASOCIADAS A UNA PENCA GENERAL
// Obtener todas las predicciones
$sqlPredicciones = "SELECT pg.idPencaGeneral, pp.idPrediccion, pp.partido_id, pp.prediccion_goles_Equipo1, pp.prediccion_goles_Equipo2, pg.Usuario
                    FROM Prediccion_Partidos pp
                    JOIN Penca_General pg ON pp.idPrediccion = pg.idPrediccion
                    WHERE pg.Usuario = $ci";

$resultadoPredicciones = $conexion->query($sqlPredicciones);

if ($resultadoPredicciones->num_rows > 0) {
    // Muestra los resultados usando un bucle while y echo
    echo "<br>Array de Predicciones del usuario asociadas a una Penca General:<br>";
    while ($fila = $resultadoPredicciones->fetch_assoc()) {
        echo "ID de Predicción: " . $fila['idPrediccion'] . " - ID de Partido: " . $fila['partido_id'] . " - Predicción Goles Equipo 1: " . $fila['prediccion_goles_Equipo1'] . " - Predicción Goles Equipo 2: " . $fila['prediccion_goles_Equipo2'] . " - Usuario: " . $fila['Usuario'] . "<br>";
    }
} else {
    echo "La consulta no devolvió ningún resultado.";
}

//#########################################################
//PASO 3: OBTENER TODAS LAS PENCAS GENERALES DEL USUARIO 
$sqlPencasGenerales = "SELECT * FROM Penca_General WHERE Usuario = $ci";
$resultadoPencasGenerales = $conexion->query($sqlPencasGenerales);
if ($resultadoPencasGenerales->num_rows > 0) {
    // Muestra los resultados usando un bucle while y echo
    echo "<br>Array de Pencas Generales del usuario:<br>";
    while ($fila = $resultadoPencasGenerales->fetch_assoc()) {
        echo "ID Penca Gen: " . $fila['idPencaGeneral'] . " - Nombre Penca: " . $fila['nombre'] . " - CI Usuario: " . $fila['Usuario'] . " - ID Prediccion: " . $fila['idPrediccion'] . " - Puntos Actuales: " . $fila['puntosActuales'] . " - puesto: " . $fila['puesto'] . "<br>";
    }
} else {
    echo "La consulta no devolvió ningún resultado.";
}
//#########################################################
// ########################################################
// CALCULAR PUNTOS DE LAS PENCAS GENERALES
while ($filaPartido = $resultadoPartidos->fetch_assoc()) {
    $idPartido = $filaPartido['id'];
    $golesEquipo1 = $filaPartido['goles_equipo_1'];
    $golesEquipo2 = $filaPartido['goles_equipo_2'];

    // Recorrer las predicciones asociadas a cada partido
    $resultadoPredicciones->data_seek(0); // Reiniciar el puntero del resultado
    while ($filaPrediccion = $resultadoPredicciones->fetch_assoc()) {
        if ($filaPrediccion['partido_id'] == $idPartido) {
            $prediccionEquipo1 = $filaPrediccion['prediccion_goles_Equipo1'];
            $prediccionEquipo2 = $filaPrediccion['prediccion_goles_Equipo2'];

            // Calcular los puntos para esta predicción
            $puntos = 0;
            if ($golesEquipo1 == $prediccionEquipo1 && $golesEquipo2 == $prediccionEquipo2) {
                $puntos = 3; // Pronóstico exacto, 3 puntos
            } elseif (($golesEquipo1 - $golesEquipo2) == ($prediccionEquipo1 - $prediccionEquipo2)) {
                $puntos = 1; // Diferencia de goles correcta, 1 punto
            }

            // Actualizar los puntos en la Penca General
            $idPencaGeneral = $filaPrediccion['idPencaGeneral'];
            $sqlActualizarPuntos = "UPDATE Penca_General SET puntosActuales = puntosActuales + $puntos WHERE idPencaGeneral = $idPencaGeneral";
            $conexion->query($sqlActualizarPuntos);
        }
    }
}
// ########################################################

$conexion->close();

echo "Puntos actualizados correctamente.";

?>