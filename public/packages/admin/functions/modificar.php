<?php
require_once '../../Conexion.php';
$ruta = "../../../db/scris.db";
$conexion = conectar($ruta);

if (isset($_POST['nombre'])) {

    $nombre = $_POST['nombre2'];

    $sql = "SELECT * FROM funcionarios WHERE nombre = '$nombre'";
    $resultado = $conexion->query($sql);
    $fila = $resultado->fetch();
    $id = $fila['id'];
    $nombre_bd = $fila['nombre'];
    $dependencia_bd = $fila['dependencia'];
    $direccion_bd = $fila['direccion'];
    $asignatura_bd = $fila['asignatura'];
    $placa_bd = $fila['placa'];
    $observaciones_bd = $fila['observaciones'];

    $nombre_a = $_POST['nombre'];
    $dependencia_a = $_POST['dependencia'];
    $direccion_a = $_POST['direccion'];
    $asignatura_a = $_POST['asignatura'];
    $placa_a = $_POST['placa'];
    $observaciones_a = $_POST['observaciones'];

    $nombre_a = mb_strtoupper($nombre_a, 'UTF-8');
    $dependencia_a = mb_strtoupper($dependencia_a, 'UTF-8');
    $direccion_a = mb_strtoupper($direccion_a, 'UTF-8');
    $asignatura_a = mb_strtoupper($asignatura_a, 'UTF-8');
    $placa_a = mb_strtoupper($placa_a, 'UTF-8');
    $observaciones_a = mb_strtoupper($observaciones_a, 'UTF-8');


    if ($nombre_a == "") {
        $nombre_a = $nombre_bd;
    }

    if ($dependencia_a == "") {
        $dependencia_a = $dependencia_bd;
    }

    if ($direccion_a == "") {
        $direccion_a = $direccion_bd;
    }

    if ($asignatura_a == "") {
        $asignatura_a = $asignatura_bd;
    }

    if ($placa_a == "") {
        $placa_a = $placa_bd;
    }

    if ($observaciones_a == "") {
        $observaciones_a = $observaciones_bd;
    }

    $sql = "UPDATE funcionarios SET nombre = '$nombre_a', dependencia = '$dependencia_a', direccion = '$direccion_a', asignatura = '$asignatura_a', placa = '$placa_a', observaciones = '$observaciones_a' WHERE id = '$id'";
    $resultado = $conexion->query($sql);
    if ($resultado) {
        echo "ok";
    } else {
        echo "error";
    }
}