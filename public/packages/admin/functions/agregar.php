<?php
require_once '../../Conexion.php';
$ruta = "../../../db/scris.db";
$conexion = conectar($ruta);


if (isset($_POST['agregar'])) {

    $nombre = $_POST['nombre'];
    $dependencia = $_POST['dependencia'];
    $direccion = $_POST['direccion'];
    $asignatura = $_POST['asignatura'];
    $placa = $_POST['placa'];
    $observaciones = $_POST['observaciones'];
    $fecha = $_POST['fecha_inicio'];

    $nombre = mb_strtoupper($nombre, 'UTF-8');
    $dependencia = mb_strtoupper($dependencia, 'UTF-8');
    $direccion = mb_strtoupper($direccion, 'UTF-8');
    $asignatura = mb_strtoupper($asignatura, 'UTF-8');
    $placa = mb_strtoupper($placa, 'UTF-8');
    $observaciones = mb_strtoupper($observaciones, 'UTF-8');

    $sql = "SELECT * FROM funcionarios WHERE nombre = '$nombre'";
    $resultado = $conexion->query($sql);
    $fila = $resultado->fetch();
    if ($fila) {
        $sql = "";
    } else {
        $sql = "INSERT INTO inicio_de_labores (nombre, fecha) VALUES ('$nombre', '$fecha')";
        $conexion->query($sql);

        $sql = "INSERT INTO funcionarios (nombre, dependencia, direccion, asignatura, placa, observaciones) VALUES ('$nombre', '$dependencia', '$direccion', '$asignatura', '$placa', '$observaciones')";
        $resultado = $conexion->query($sql);

        if ($resultado) {
            echo "ok";
        } else {
            echo "error";
        }
    }
}