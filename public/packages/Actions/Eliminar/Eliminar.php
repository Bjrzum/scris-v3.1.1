<?php
require '../../Conexion.php';
$ruta = '../../../db/scris.db';
$conexion = conectar($ruta);

if (isset($_POST['id'])) {

    $id = $_POST['id'];
    $id = (int) $id;

    $sql = "DELETE FROM tabla WHERE id = '$id'";
    $resultado = $conexion->query($sql);
    echo "eliminado <br>";
}