<?php
require_once '../../Conexion.php';
$ruta = "../../../db/scris.db";
$conexion = conectar($ruta);



if (isset($_POST['eliminar'])) {

    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];

    $sql = "SELECT * FROM funcionarios WHERE nombre = '$nombre'";
    $resultado = $conexion->query($sql);
    $fila = $resultado->fetch();

    $id = $fila['id'];

    $dependencia = $fila['dependencia'];
    $direccion = $fila['direccion'];
    $asignatura = $fila['asignatura'];
    $placa = $fila['placa'];

    $sql = "INSERT INTO funcionarios_eliminados (fecha_eliminacion, nombre, dependencia, direccion, asignatura, placa) VALUES ('$fecha', '$nombre', '$dependencia', '$direccion', '$asignatura', '$placa')";
    $conexion->query($sql);

    $sql = "DELETE FROM funcionarios WHERE id = '$id'";
    $resultado = $conexion->query($sql);

    if ($resultado) {
        echo "ok";
    } else {
        echo "error";
    }
}