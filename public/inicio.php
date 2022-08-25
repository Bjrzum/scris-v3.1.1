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
    <link rel="shortcut icon" href="img/favicon.png" type="image/png">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/inicio.css">
    <script src="js/library/jquery/dist/jquery.min.js"></script>
    <title>SCRIS | Ingresos</title>
    <style>
        .footer p {
            text-align: center;
            padding: 1em;
            color: #fffa;
        }

        .psicologia {
            background: #444;
        }

        .psicologia:hover {
            background: #333;
        }
    </style>
</head>

<body>

    <header class="header">
        <div class="logo">
            <img src="img/logo.png" alt="">
            <h1>
                SCRIS
            </h1>
        </div>

        <nav class="nav">
            <a href="inicio.php" class="link__nav link__nav--active">Ingresos</a>
            <a href="salidas.php" class="link__nav">Salidas</a>
            <a href="ausentes.php" class="link__nav">Ausentes</a>
            <a href="tabla.php" class="link__nav">Tabla</a>
            <a href="avanzado.php" class="link__nav">Advance</a>
            <a href="cerrar.php" class="link__nav">Cerrar Sesión</a>
        </nav>
    </header>
    <section class="section">
        <div class="flex">
            <?php

            include 'packages/Conexion.php';


            $directivos = "";
            $docentes = "";
            $serviciosGenerales = "";
            $administrativos = "";
            $funcionarioCafeteria = "";
            $seguridad = "";
            $mensajeria = "";
            $psicologia = "";
            $funcionarioExterno = "";
            $fecha_hoy = date("Y/m/d");


            $ruta = 'db/scris.db';
            $conexion = conectar($ruta);
            $sql = "SELECT * FROM funcionarios ORDER BY nombre ASC";
            $resultado = $conexion->query($sql);
            //recorrer con un while
            while ($fila = $resultado->fetch()) {

                $nombre = $fila['nombre'];
                $dependencia = $fila['dependencia'];

                $sql2 = "SELECT * FROM tabla WHERE fecha = '$fecha_hoy' AND nombre = '$nombre' AND (status = '1' OR status = '3' OR status = '4')";
                $resultado2 = $conexion->query($sql2);
                $fila2 = $resultado2->fetch();

                //verificar si fila2 esta vacia
                if ($fila2 == null) {

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
                    } else if ($dependencia == "PSICOLOGÍA") {
                        $psicologia .= '<button class="btn__funcionario psicologia">' . $nombre . '</button>';
                    }
                }
            }


            if ($directivos != "") {
                echo '<div class="funcionarios">
                <h2>Directivos SCALAS</h2>
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

            if ($psicologia != "") {
                echo '<div class="funcionarios">
                <h2>Psicología</h2>
                <div class="funcionarios__lista">
                    ' . $psicologia . '
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

            ?>
        </div>
    </section>
    <footer class="footer">
        <p>&copy; 2022 - SCRIS | Todos los derechos reservados</p>
    </footer>
    <script>
        $('.btn__funcionario').click(function() {
            var nombre = $(this).text();
            //fecha YYYY/MM/DD
            var fecha = new Date();
            var dia = fecha.getDate();
            var mes = fecha.getMonth() + 1;
            var anio = fecha.getFullYear();
            var hora = fecha.getHours();
            var minutos = fecha.getMinutes();

            if (dia < 10) {
                dia = '0' + dia;
            }

            if (mes < 10) {
                mes = '0' + mes;
            }
            if (hora < 10) {
                hora = '0' + hora;
            }

            if (minutos < 10) {
                minutos = "0" + minutos;
            }


            var fecha = anio + "/" + mes + "/" + dia;
            var horas = hora + ":" + minutos;


            $(this).hide();

            $.ajax({
                url: 'packages/temp/Tabla.php',
                type: 'POST',
                data: {
                    nombre: nombre,
                    fecha: fecha,
                    hora: horas
                },
                success: function(respuesta) {


                    console.log(respuesta);
                    //ocultar elemento clickeado

                }
            });
        });
    </script>

</body>

</html>