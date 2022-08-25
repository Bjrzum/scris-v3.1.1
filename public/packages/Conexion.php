<?php

function conectar($ruta)
{
    $conexion = new PDO('sqlite:' . $ruta);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conexion;
}