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
    <title>SCRIS | Administrador - modificar</title>
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

    <?php //include '../../css/admin-agregar.css';
    include '../../css/admin-modificar.css';

    ?>
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
            PULSE SOBRE UN FUNCIONARIO QUE DESEA MODIFICAR
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
                } else if ($dependencia == "FUNCIONARIO CAFETERÍA") {
                    $funcionarioCafeteria .= '<button class="btn__funcionario fc">' . $nombre . '</button>';
                } else if ($dependencia == "SEGURIDAD") {
                    $seguridad .= '<button class="btn__funcionario seguridad">' . $nombre . '</button>';
                } else if ($dependencia == "MENSAJERÍA") {
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

    <div class="section2">

        <div class="flex">

            <form>
                <div class="form-group">
                    <h3>
                        Modificar al funcionario <span class="nombre_funcionario"></span>
                    </h3>
                </div>

                <div class="form-group">
                    <label for="">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" autofocus>
                </div>
                <div class="form-group">
                    <label for="">Dependencia:</label>
                    <select name="dependencia" id="dependencia">
                        <option value="">Seleccione...</option>
                        <option value="ADMINISTRATIVO">ADMINISTRATIVO</option>
                        <option value="DIRECTIVO">DIRECTIVO</option>
                        <option value="DOCENTE">DOCENTE</option>
                        <option value="FUNCIONARIO CAFETERÍA">FUNCIONARIO CAFETERÍA</option>
                        <option value="FUNCIONARIO EXTERNO">FUNCIONARIO EXTERNO</option>
                        <option value="MENSAJERÍA">MENSAJERÍA</option>
                        <option value="SEGURIDAD">SEGURIDAD</option>
                        <option value="SERVICIOS GENERALES">SERVICIOS GENERALES</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Direcció de curso:</label>
                    <input type="text" name="direccion" id="direccion" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Asignatura:</label>
                    <input type="text" name="asignatura" id="asignatura" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Placa de vehiculo:</label>
                    <input type="text" name="placa" id="placa" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Observaciones:</label>
                    <textarea name="observaciones" id="observaciones" cols="30" rows="10"
                        class="form-control"></textarea>
                </div>

                <div class="form-group control">
                    <span class="btn-modificar span">Modificar</span>
                    <span class="btn-cancelar span">Cancelar</span>
                </div>

            </form>
        </div>
    </div>
    <footer class="footer">
        <p>&copy; 2022 - SCRIS | Todos los derechos reservados</p>
    </footer>
    <script>
    $('.btn__funcionario').click(function() {
        var nombre = $(this).text();
        $('.nombre_funcionario').text(nombre);
        $('.section2').addClass('section2--active');
    });

    $('.btn-cancelar').click(function() {
        $('.section2').removeClass('section2--active');
        $('.form-group input').val('');
    });

    $('.btn-modificar').click(function() {
        var nombre = $('#nombre').val();
        var nombre2 = $('.nombre_funcionario').text();
        var dependencia = $('#dependencia').val();
        var direccion = $('#direccion').val();
        var asignatura = $('#asignatura').val();
        var placa = $('#placa').val();
        var observaciones = $('#observaciones').val();
        var url = 'functions/modificar.php';
        var data = {
            'nombre': nombre,
            'nombre2': nombre2,
            'dependencia': dependencia,
            'direccion': direccion,
            'asignatura': asignatura,
            'placa': placa,
            'observaciones': observaciones
        };
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function(response) {
                if (response == 'ok') {
                    $('.section2').removeClass('section2--active');
                    $('.form-group input').val('');
                    location.reload();
                } else {

                    $('.section2').removeClass('section2--active');
                }
                console.log(response);
            }
        });
    });
    </script>

</body>

</html>