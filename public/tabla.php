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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="js/library/jquery/dist/jquery.min.js"></script>
    <title>SCRIS | Tabla</title>
    <style>
        .footer p {
            text-align: center;
            padding: 1em;
            color: #fffa;
        }

        <?php include 'css/tabla.css';
        include 'css/tabla-buscar.css';
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
            <a href="tabla.php" class="link__nav link__nav--active">Tabla</a>
            <a href="avanzado.php" class="link__nav">Advance</a>
            <a href="cerrar.php" class="link__nav">Cerrar Sesión</a>
        </nav>
    </header>
    <section class="section">
        <div class="header2">
            <div class="generar__excel">
                <a href="generar_excel.php" class="link__excel">Enviar Reporte</a>
                <button class="btn-mas"><i class="bi bi-caret-down-fill"></i></button>
                <button class="search10">
                    <i class="bi bi-arrow-repeat"></i>
                </button>

                <div class="buscar-mas">
                    <input type="date" name="inicio" id="inicio">
                    <input type="date" name="fin" id="fin">
                    <button class="btn-buscar">Buscar</button>
                    <button class="btn-cancel">Cancelar</button>
                </div>
                <script>
                    <?php include 'js/tabla-buscar.js'; ?>
                </script>

            </div>
            <div class="administrar__tabla">
                <div class="marcar_novedades">
                    <button class="btn-novedad" data-id="novedad">Novedad</button>
                </div>
                <div class="eliminar__ingreso">
                    <button class="btn-eliminar" data-id="eliminar">Eliminar</button>
                </div>
            </div>
        </div>
        <div class="flex">
            <?php
            require_once 'packages/functions/tabla.php';
            if (isset($_GET['buscar_tabla'])) {
                $fecha_inicio = $_GET['inicio']; //2019-01-01
                $fecha_fin = $_GET['fin']; //2019-01-01
                //remplazar - por / 
                $fecha_inicio = str_replace('-', '/', $fecha_inicio);
                $fecha_fin = str_replace('-', '/', $fecha_fin);

                $db = new PDO('sqlite:db/scris.db');
                $sql = "SELECT * FROM tabla WHERE fecha BETWEEN '$fecha_inicio' AND '$fecha_fin' ORDER BY fecha, orden, hora_ingreso ASC";
                $result = $db->query($sql);
                tabla_buscar($result);
            } else {
            ?>
                <table class="tabla">
                    <thead>
                        <tr>
                            <th class="fec">fecha</th>
                            <th class="nom">nombre</th>
                            <th class="dep">dependencia</th>
                            <th class="dir">dirección de curso</th>
                            <th class="asig">asignatura</th>
                            <th class="hor">hora de ingreso</th>
                            <th class="hor2">hora de salida</th>
                            <th class="pla">placa de vehiculo</th>
                            <th class="obs">observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

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

                        // $db = "db/scris.db";
                        // $conn = new SQLite3($db);

                        // $sql = "UPDATE tabla SET orden = '1' WHERE  status != '4'";
                        // $result = $conn->query($sql);
                        // $sql = "UPDATE tabla SET orden = '2' WHERE status = '4'";
                        // $result = $conn->query($sql);
                        //seleccionar de tabla todos a la fecha actual y que no sean novedades estatus 4
                        $sql = "SELECT * FROM tabla WHERE fecha = '$fecha_hoy' ORDER BY orden, hora_ingreso ASC";
                        $resultado = $conexion->query($sql);
                        //recorrer resultado
                        tabla_tr($resultado);
                        ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </section>
    <footer class="footer">
        <p>&copy; 2022 - SCRIS | Todos los derechos reservados</p>
    </footer>
    <button id="top">
        <i class="bi bi-caret-up-fill"></i>
    </button>
    <script>
        $('#top').click(function() {
            $('html, body').animate({
                scrollTop: 0
            }, 500);
        });

        //ajustar tamañp de los textareas segun el contenido que se ingrese
        $('textarea').each(function() {
            this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
        }).on('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    </script>
    <script>
        <?php include 'js/tabla.js'; ?>

        function Modificar(clase, boolean) {
            $(clase).keyup(function() {
                //textarea
                var id = $(this).data('class');
                var valor = $(this).val();
                var text = clase; //.hora_ingreso
                var bool = boolean;
                //quitar espacios y puntos
                text = text.replace(/\s/g, '');
                text = text.replace(/\./g, '');
                var err = false;
                var recontruir = false;

                if (bool) {
                    valor = valor.toUpperCase();
                } else {

                    //eliminamos los espacios en blanco
                    if (valor != "") {
                        valor = valor.replace(/\s/g, '');
                        //verificamos que hayan :
                        if (valor.indexOf(":") == -1) {
                            err = true;
                        } else {
                            //dividimos la hora en dos partes
                            var hora = valor.split(":");
                            //tomamos el primer valor
                            var hora1 = hora[0]; //'08'
                            //verificar que se pueda pasar a entero
                            if (isNaN(hora1)) {
                                err = true;
                            } else {
                                //pasarlo a entero
                                hora1 = parseInt(hora1);

                                var hora2 = hora[1];
                                //verificar que se pueda pasar a entero
                                if (isNaN(hora2)) {
                                    err = true;
                                } else {
                                    //pasarlo a entero
                                    hora2 = parseInt(hora2);
                                    //verificar que sean menor a 60
                                    if (hora1 > 23 || hora2 > 59) {
                                        err = true;
                                    } else {
                                        recontruir = true;
                                    }
                                }

                            }
                        }
                    }
                }

                $(this).val(valor);

                if (err) {
                    $(this).css('border', '2px solid red');
                } else {

                    if (recontruir) {
                        var hora = hora1 + ":" + hora2;
                    }
                    $(this).css('border', 'none');

                    $.ajax({
                        url: 'packages/Actions/Actualizar/Actualizar.php',
                        type: 'POST',
                        data: {
                            id: id,
                            valor: valor,
                            text: text
                        },
                        success: function(data) {
                            console.log(data);
                        }
                    });
                }
            });
        }

        Modificar('.hora_ingreso', false);
        Modificar('.hora_salida', false);
        Modificar('.placa', true);
        Modificar('.observaciones', true);
    </script>

</body>

</html>