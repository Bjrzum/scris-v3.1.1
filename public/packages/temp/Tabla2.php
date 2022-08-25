<?php
require_once '../Conexion.php';

$ruta = "../../db/scris.db";
$conexion = conectar($ruta);

if (isset($_POST['nombre'])) {

    $nombre = $_POST['nombre'];
    $hora = $_POST['hora'];
    $fecha = $_POST['fecha'];

    $sql = "SELECT * FROM tabla WHERE nombre = '$nombre' AND fecha = '$fecha' AND (status = '1' OR status = '3')";
    $resultado = $conexion->query($sql);
    $fila = $resultado->fetch();
    $status = $fila['status'];

    if ($status == '1') {

        $sql = "UPDATE tabla SET hora_salida = '$hora', status = '0' WHERE nombre = '$nombre' AND fecha = '$fecha' AND status = '1'";
        $resultado = $conexion->query($sql);
        echo "actualizado";
    } else if ($status == '3') {
        $sql = "UPDATE tabla SET hora_salida = '$hora', status = '2' WHERE nombre = '$nombre' AND fecha = '$fecha' AND status = '3'";
        $resultado = $conexion->query($sql);
        echo "actualizado";
    } else {
        echo "no actualizado";
    }
}