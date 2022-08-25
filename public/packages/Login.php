<?php
include 'Conexion.php';

$ruta = '../db/user.db';
$conexion = conectar($ruta);
$sql = "SELECT * FROM user WHERE id = 1";
$resultado = $conexion->query($sql);
$fila = $resultado->fetch();
$pin_hash =  $fila['pin'];


if (isset($_POST['validar'])) {

    $pin = $_POST['password'];

    if (password_verify($pin, $pin_hash)) {

        session_start();
        $_SESSION['logado'] = true;
        header('Location: ../inicio.php');
    } else {
        header('Location: ../index.php');
    }
}

if (isset($_POST['pin'])) {

    $pin = $_POST['pin'];

    if (password_verify($pin, $pin_hash)) {
        echo 101; //correcto
        session_start();
        $_SESSION['logado'] = true;
    } else {
        echo 100; //incorrecto
    }
}