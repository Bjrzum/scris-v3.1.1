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
        $sql = "UPDATE tabla SET status = '0' WHERE id = '$id'";
        $resultado = $conexion->query($sql);
        echo "actualizado a salida S/N <br>";
    } else {
        $sql = "UPDATE tabla SET status = '1' WHERE id = '$id'";
        $resultado = $conexion->query($sql);
        echo "actualizado a ingreso S/N <br>";
    }
}