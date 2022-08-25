<?php
require '../../Conexion.php';
$ruta = '../../../db/scris.db';
$conexion = conectar($ruta);

if (isset($_POST['id'])) {

    $id = $_POST['id'];
    $id = (int) $id;

    $sql = "SELECT * FROM tabla WHERE id = '$id'";
    $resultado = $conexion->query($sql);
    $fila = $resultado->fetch();

    $hora_salida = $fila['hora_salida'];

    if ($hora_salida != "") {
        $sql = "UPDATE tabla SET status = '2' WHERE id = '$id'";
        $resultado = $conexion->query($sql);
        echo "actualizado a salida con novedad <br>";
    } else {
        $sql = "UPDATE tabla SET status = '3' WHERE id = '$id'";
        $resultado = $conexion->query($sql);
        echo "actualizado a ingreso con novedad <br>";
    }
}