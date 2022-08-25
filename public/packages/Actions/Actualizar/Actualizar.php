<?php
require '../../Conexion.php';
$ruta = '../../../db/scris.db';
$conexion = conectar($ruta);

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $datos = $_POST['valor'];
    $fila = $_POST['text'];

    $id = (int) $id;

    $sql = "UPDATE tabla SET $fila = '$datos' WHERE id = '$id'";
    $resultado = $conexion->query($sql);
    if ($resultado) {

        if ($fila == 'hora_salida' && $datos == "") {

            $sql = "UPDATE tabla SET status = '1' WHERE id = '$id' AND status = '0'";
            $resultado = $conexion->query($sql);

            $sql2 = "UPDATE tabla SET status = '3' WHERE id = '$id' AND status = '2'";
            $resultado2 = $conexion->query($sql2);

            if ($resultado && $resultado2) {
                echo "actualizado a salida <br>";
            } else {
                echo "error al actualizar <br>";
            }
        } else if ($fila == 'hora_salida' && $datos != "") {

            $sql = "UPDATE tabla SET status = '0' WHERE id = '$id' AND status = '1'";
            $resultado = $conexion->query($sql);

            $sql2 = "UPDATE tabla SET status = '2' WHERE id = '$id' AND status = '3'";
            $resultado2 = $conexion->query($sql2);

            if ($resultado && $resultado2) {
                echo "actualizado a salida <br>";
            } else {
                echo "error al actualizar <br>";
            }
        }
    } else {
        echo "error <br>";
    }
}