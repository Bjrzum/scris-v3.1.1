<?php
session_start();

if (!isset($_SESSION['logado']) && $_SESSION['logado'] != true) {
    header('Location: index.php');
}
//zona horaria de colombia
date_default_timezone_set('America/Bogota');


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/favicon.png" type="image/png">
    <link rel="stylesheet" href="../../css/normalize.css">
    <link rel="stylesheet" href="../../css/inicio.css">
    <script src="../../js/library/jquery/dist/jquery.min.js"></script>
    <title>SCRIS | Administrador - eliminar</title>
    <style>
        .footer p {
            text-align: center;
            padding: 1em;
            color: #fffa;
        }

        .otros {
            background-color: #444;
        }

        .otros:hover {
            background-color: #333;
        }

        <?php include '../../css/eliminar.css'; ?>
    </style>
</head>

<body>

    <header class="header">
        <div class="logo">
            <img src="../../img/logo.png" alt="">
            <h1>
                SCRIS
            </h1>
        </div>

        <nav class="nav">
            <a href="index.php" class="link__nav link__nav--active">Regresar</a>
        </nav>
    </header>
    <section class="section" style="text-align: center ;">
        <h1 style="text-align:center ; color: #000; padding: .5em; background: #ff5; font-size:25px;">
            PULSE SOBRE UN FUNCIONARIO PARA ELIMINARLO
        </h1>
        <div class="flex">
            <?php

            include '../Conexion.php';


            $directivos = "";
            $docentes = "";
            $serviciosGenerales = "";
            $administrativos = "";
            $funcionarioCafeteria = "";
            $seguridad = "";
            $mensajeria = "";
            $funcionarioExterno = "";
            $otros = "";
            $fecha_hoy = date("j/n/Y");


            $ruta = '../../db/scris.db';
            $conexion = conectar($ruta);
            $sql = "SELECT * FROM funcionarios ORDER BY nombre ASC";
            $resultado = $conexion->query($sql);
            //recorrer con un while
            while ($fila = $resultado->fetch()) {

                $nombre = $fila['nombre'];
                $dependencia = $fila['dependencia'];


                if ($dependencia == "DIRECTIVO") {
                    $directivos .= '<button class="btn__funcionario directivo">' . $nombre . '</button>';
                } else if ($dependencia == "DOCENTE") {
                    $docentes .= '<button class="btn__funcionario docente">' . $nombre . '</button>';
                } else if ($dependencia == "SERVICIOS GENERALES") {
                    $serviciosGenerales .= '<button class="btn__funcionario sg">' . $nombre . '</button>';
                } else if ($dependencia == "ADMINISTRATIVO") {
                    $administrativos .= '<button class="btn__funcionario administrativo">' . $nombre . '</button>';
                } else if ($dependencia == "FUNCIONARIO CAFETER??A") {
                    $funcionarioCafeteria .= '<button class="btn__funcionario fc">' . $nombre . '</button>';
                } else if ($dependencia == "SEGURIDAD") {
                    $seguridad .= '<button class="btn__funcionario seguridad">' . $nombre . '</button>';
                } else if ($dependencia == "MENSAJER??A") {
                    $mensajeria .= '<button class="btn__funcionario mensajeria">' . $nombre . '</button>';
                } else if ($dependencia == "FUNCIONARIO EXTERNO") {
                    $funcionarioExterno .= '<button class="btn__funcionario fe">' . $nombre . '</button>';
                } else {
                    $otros .= '<button class="btn__funcionario otros">' . $nombre . '</button>';
                }
            }


            if ($directivos != "") {
                echo '<div class="funcionarios">
                <h2>Directivos</h2>
                <div class="funcionarios__lista">
                    ' . $directivos . '
                </div>
            </div>';
            }

            if ($docentes != "") {
                echo '<div class="funcionarios">
                <h2>Docentes</h2>
                <div class="funcionarios__lista">
                    ' . $docentes . '
                </div>
            </div>';
            }
            if ($administrativos != "") {
                echo '<div class="funcionarios">
                <h2>Administrativos</h2>
                <div class="funcionarios__lista">
                    ' . $administrativos . '
                </div>
            </div>';
            }

            if ($serviciosGenerales != "") {
                echo '<div class="funcionarios">
                <h2>Servicios Generales</h2>
                <div class="funcionarios__lista">
                    ' . $serviciosGenerales . '
                </div>
            </div>';
            }


            if ($funcionarioCafeteria != "") {
                echo '<div class="funcionarios">
                <h2>Funcionarios de Cafeteria</h2>
                <div class="funcionarios__lista">
                    ' . $funcionarioCafeteria . '
                </div>
            </div>';
            }



            if ($mensajeria != "") {
                echo '<div class="funcionarios">
                <h2>Mensajeria</h2>
                <div class="funcionarios__lista">
                    ' . $mensajeria . '
                </div>
            </div>';
            }

            if ($funcionarioExterno != "") {
                echo '<div class="funcionarios">
                <h2>Funcionarios Externos</h2>
                <div class="funcionarios__lista">
                    ' . $funcionarioExterno . '
                </div>
            </div>';
            }

            if ($seguridad != "") {
                echo '<div class="funcionarios">
                <h2>Seguridad</h2>
                <div class="funcionarios__lista">
                    ' . $seguridad . '
                </div>
            </div>';
            }

            if ($otros != "") {
                echo '<div class="funcionarios">
                <h2>Otros</h2>
                <div class="funcionarios__lista">
                    ' . $otros . '
                </div>
            </div>';
            }


            ?>
        </div>
    </section>
    <section class="emergent">
        <div class="container__emerget">
            <div class="title">
                <p class="msm msm1">
                    Esta acci??n no se puede deshacer.
                </p>
                <p class="msm msm2">
                    ??Est??s seguro de querer eliminar este funcionario?
                </p>
                <p id="nombre-funcionario">DAMAR NARV??EZ</p>
            </div>
            <div class="cuerpo">
                <input type="date" name="fecha" id="fecha-deleted">
            </div>
            <div class="errores">
                <!-- <p>* La fecha es obligatoria</p> -->
            </div>
            <div class="accion">
                <button class="btn__delete" id="btn-delete">Eliminar</button>
                <button class="btn__cancel" id="btn-cancel">Cancelar</button>
            </div>
        </div>
    </section>
    <footer class="footer">
        <p>&copy; 2022 - SCRIS | Todos los derechos reservados</p>
    </footer>
    <script>
        <?php include '../../js/eliminar.js'; ?>
    </script>

</body>

</html>