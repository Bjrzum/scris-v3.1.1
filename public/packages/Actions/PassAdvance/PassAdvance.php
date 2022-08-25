<?php

require_once '../../Conexion.php';

if (isset($_POST['contrasena'])) {

    $ruta = '../../../db/user.db';
    $conexion = conectar($ruta);

    $pass = $_POST['contrasena'];
    $sql = "SELECT * FROM admin WHERE pass = '$pass'";
    $resultado = $conexion->query($sql);

    $fila = $resultado->fetch();
    $password = $fila['pass'];

    if ($pass == $password) {
        session_start();
        $_SESSION['admin'] = true;
        echo 'correcto';
    } else {
        echo 'incorrecto';
    }
}