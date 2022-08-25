<?php
session_start();

if (!isset($_SESSION['logado']) && $_SESSION['logado'] != true) {
    header('Location: index.php');
}
//zona horaria de colombia
date_default_timezone_set('America/Bogota');

include 'packages/Conexion.php';


$directivos = "";
$docentes = "";
$serviciosGenerales = "";
$administrativos = "";
$funcionarioCafeteria = "";
$seguridad = "";
$mensajeria = "";
$funcionarioExterno = "";
$fecha_hoy = date("Y/m/d");

$ruta = 'db/scris.db';
$conexion = conectar($ruta);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.png" type="image/png">
    <link rel="stylesheet" href="css/normalize.css">
    <script src="js/library/jquery/dist/jquery.min.js"></script>
    <title>SCRIS | Buscar</title>
    <style>
    .footer p {
        text-align: center;
        padding: 1em;
        color: #fffa;
    }

    #descargar {
        text-decoration: none;
    }

    #no_doata {
        text-align: center;
        padding: 1em;
        color: #fffa;
        font-weight: bold;
    }

    <?php include "css/buscar.css";
    ?>
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
            <a href="inicio.php" class="link__nav">Ingresos</a>
            <a href="salidas.php" class="link__nav">Salidas</a>
            <a href="ausentes.php" class="link__nav">Ausentes</a>
            <a href="tabla.php" class="link__nav">Tabla</a>
            <a href="avanzado.php" class="link__nav link__nav--active">Advance</a>
            <a href="cerrar.php" class="link__nav">Cerrar Sesión</a>
        </nav>
    </header>
    <section class="section">
        <div class="buscar__container">
            <form>
                <span>Desde:</span>
                <input type="date" name="fecha_inicio" id="fecha_inicio">
                <span>Hasta:</span>
                <input type="date" name="fecha_fin" id="fecha_fin">
                <div class="btn-buscar">Buscar</div>
            </form>

            <div class="filtros_seleccionados">
                <!-- <span>Nombre 1</span>
                <span>Nombre 2</span>
                <span>Nombre 3</span>
                <span>Nombre 4</span>
                <span>Nombre 5</span>
                <span>Nombre 6</span> -->
            </div>

            <div class="error__information">

            </div>

            <div class="resultado">
                <!-- <span id="descargar">
                    Descargar resultado
                </span> -->
            </div>
        </div>
        <h3 class="ti">Filtros</h3>
        <div class="buscar__filtros">
            <div class="filtro__funcionario contenet">
                <h2 class="subtitle subtitle1">Funcionarios</h2>
                <div class="container container1">
                    <?php
                    $sql = "SELECT * FROM funcionarios ORDER BY nombre ASC";
                    $resultado = $conexion->query($sql);
                    //recorrer con un while
                    while ($fila = $resultado->fetch()) {

                        $nombre = $fila['nombre'];
                        $dependencia = $fila['dependencia'];

                        if ($dependencia == "DIRECTIVO") {
                            echo '<button class="btn__funcionario directivo">' . $nombre . '</button>';
                        } else if ($dependencia == "DOCENTE") {
                            echo '<button class="btn__funcionario docente">' . $nombre . '</button>';
                        } else if ($dependencia == "SERVICIOS GENERALES") {
                            echo '<button class="btn__funcionario sg">' . $nombre . '</button>';
                        } else if ($dependencia == "ADMINISTRATIVO") {
                            echo '<button class="btn__funcionario administrativo">' . $nombre . '</button>';
                        } else if ($dependencia == "FUNCIONARIO CAFETERÍA") {
                            echo '<button class="btn__funcionario fc">' . $nombre . '</button>';
                        } else if ($dependencia == "SEGURIDAD") {
                            echo '<button class="btn__funcionario seguridad">' . $nombre . '</button>';
                        } else if ($dependencia == "MENSAJERÍA") {
                            echo '<button class="btn__funcionario mensajeria">' . $nombre . '</button>';
                        } else if ($dependencia == "FUNCIONARIO EXTERNO") {
                            echo '<button class="btn__funcionario fe">' . $nombre . '</button>';
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="terminaron__labores  contenet">
                <h2 class="subtitle subtitle4">Terminaron labores</h2>
                <div class="container container4">
                    <?php
                    $sql = "SELECT * FROM funcionarios_eliminados ORDER BY nombre ASC";
                    $resultado = $conexion->query($sql);

                    $directivos2 = "";
                    $docentes2 = "";
                    $serviciosGenerales2 = "";
                    $administrativos2 = "";
                    $funcionarioCafeteria2 = "";
                    $seguridad2 = "";
                    $mensajeria2 = "";
                    $funcionarioExterno2 = "";


                    while ($fila = $resultado->fetch()) {
                        $nombre = $fila['nombre'];
                        $dependencia = $fila['dependencia'];
                        if ($dependencia == "DIRECTIVO") {
                            $directivos2 .= '<button class="btn__funcionario directivo">' . $nombre . '</button>';
                        } else if ($dependencia == "DOCENTE") {
                            $docentes2 .= '<button class="btn__funcionario docente">' . $nombre . '</button>';
                        } else if ($dependencia == "SERVICIOS GENERALES") {
                            $serviciosGenerales2 .= '<button class="btn__funcionario sg">' . $nombre . '</button>';
                        } else if ($dependencia == "ADMINISTRATIVO") {
                            $administrativos2 .= '<button class="btn__funcionario administrativo">' . $nombre . '</button>';
                        } else if ($dependencia == "FUNCIONARIO CAFETERÍA") {
                            $funcionarioCafeteria2 .= '<button class="btn__funcionario fc">' . $nombre . '</button>';
                        } else if ($dependencia == "SEGURIDAD") {
                            $seguridad2 .= '<button class="btn__funcionario seguridad">' . $nombre . '</button>';
                        } else if ($dependencia == "MENSAJERÍA") {
                            $mensajeria2 .= '<button class="btn__funcionario mensajeria">' . $nombre . '</button>';
                        } else if ($dependencia == "FUNCIONARIO EXTERNO") {
                            $funcionarioExterno2 .= '<button class="btn__funcionario fe">' . $nombre . '</button>';
                        }
                    }

                    echo $directivos2;
                    echo $docentes2;
                    echo $serviciosGenerales2;
                    echo $administrativos2;
                    echo $funcionarioCafeteria2;
                    echo $seguridad2;
                    echo $mensajeria2;
                    echo $funcionarioExterno2;


                    ?>
                </div>

            </div>
        </div>
    </section>
    <footer class="footer">
        <p>&copy; 2022 - SCRIS | Todos los derechos reservados</p>
    </footer>
    <script>
    var arrayFuncionarios = [];
    $('.btn__funcionario').click(function() {

        var contenedor = $('.filtros_seleccionados');
        var nombre = $(this).text();
        contenedor.append('<span class="nombre_funcionario">' + nombre + '</span>');
        arrayFuncionarios.push(nombre);
        $(this).hide();
        var resultado = $('.resultado');
        resultado.html('');

    });

    $('.btn-buscar').click(function() {

        //_fecha = 2022-07-07 pasar a fecha = 2022/07/07  a/m/d  
        function FechaJS(_fecha) {
            var fecha = _fecha.split("-");
            var fecha_js = fecha[0] + "/" + fecha[1] + "/" + fecha[2];
            return fecha_js;
        }

        var funcionarios = arrayFuncionarios;
        var fecha_inicio = $('#fecha_inicio').val(); //busqueda principal
        var fecha_fin = $('#fecha_fin').val(); //busqueda principal

        var error = $('.error__information');

        if (fecha_fin == "") {
            fecha_fin = fecha_inicio;
        }

        if (fecha_inicio == "") {
            error.html(
                "<p style='color:red; text-aling:center; background:#fff; padding:1em;max-width:500px; margin:auto;'>Debe ingresar una fecha de inicio</p>"
            );
        } else if (fecha_inicio > fecha_fin) {
            error.html(
                "<p style='color:red; text-aling:center; background:#fff; padding:1em;max-width:500px; margin:auto;'>La fecha de inicio no puede ser mayor a la fecha fin</p>"
            );
        } else {



            fecha_inicio = FechaJS(fecha_inicio);
            fecha_fin = FechaJS(fecha_fin);

            var sql = "SELECT * FROM tabla WHERE ";
            var sql2 = "";


            if (funcionarios.length > 0) {
                sql2 += " AND nombre IN ('" + funcionarios.join("','") + "')";
            }

            //MANDAR A las pagina reporte con post
            window.location.href = "reporte.php?fecha_inicio=" + fecha_inicio + "&fecha_fin=" + fecha_fin +
                "&sql=" + sql + "&sql2=" + sql2;


        }
    });

    $('.subtitle1').click(function() {
        $('.container1').slideToggle();
        $('.subtitle1').addClass('cont');
        $('.subtitle2').removeClass('cont');
        $('.subtitle3').removeClass('cont');
        $('.subtitle4').removeClass('cont');
    });
    $('.subtitle2').click(function() {
        $('.container2').slideToggle();
        $('.subtitle2').addClass('cont');
        $('.subtitle1').removeClass('cont');
        $('.subtitle3').removeClass('cont');
        $('.subtitle4').removeClass('cont');
    });
    $('.subtitle3').click(function() {
        $('.container3').slideToggle();
        $('.subtitle3').addClass('cont');
        $('.subtitle1').removeClass('cont');
        $('.subtitle2').removeClass('cont');
        $('.subtitle4').removeClass('cont');
    });
    $('.subtitle4').click(function() {
        $('.container4').slideToggle();
        $('.subtitle4').addClass('cont');
        $('.subtitle1').removeClass('cont');
        $('.subtitle2').removeClass('cont');
        $('.subtitle3').removeClass('cont');
    });
    </script>

</body>

</html>