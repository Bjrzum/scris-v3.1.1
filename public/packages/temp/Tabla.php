<?php
require_once '../Conexion.php';

$ruta = "../../db/scris.db";
$conexion = conectar($ruta);

if (isset($_POST['nombre'])) {

    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];

    $sql = "SELECT * FROM funcionarios WHERE nombre = '$nombre'";
    $resultado = $conexion->query($sql);
    $fila = $resultado->fetch();

    $nombre = $fila['nombre'];
    $dependencia = $fila['dependencia'];
    $direccion = $fila['direccion'];
    $asignatura = $fila['asignatura'];
    $placa = $fila['placa'];
    $observaciones = $fila['observaciones'];
    $status = 1;
    $orden = 1;

    $sql2 = "INSERT INTO tabla (fecha, nombre, dependencia, direccion, asignatura, hora_ingreso, hora_salida, placa, observaciones, status, orden) VALUES ('$fecha', '$nombre', '$dependencia', '$direccion', '$asignatura', '$hora', '', '$placa', '$observaciones', '$status', '$orden')";
    $resultado2 = $conexion->query($sql2);
    if ($resultado2) {
        echo 'Funcionario agregado a la lista';
    } else {
        echo 'Error al agregar funcionario';
    }
}
