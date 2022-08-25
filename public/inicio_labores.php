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
    <title>SCRIS | Advance - Termino labores</title>
    <style>
        .footer p {
            text-align: center;
            padding: 1em;
            color: #fffa;
        }

        tr {
            background-color: #6d6;
        }

        <?php
        include 'css/tabla.css';
        include 'css/tabla-eliminados.css';
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
        <div class="flex">
            <table class="tabla">
                <caption class="caption">
                    <h2 class="table-title">fecha de inicio de labores del personal</h2>
                </caption>
                <thead>
                    <tr>
                        <th class="fec">fecha</th>
                        <th class="nom">nombre</th>
                        <th class="dep">dependencia</th>
                        <th class="act">acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    include 'packages/Conexion.php';
                    require_once 'packages/functions/tabla.php';

                    $ruta = 'db/scris.db';
                    $conexion = conectar($ruta);
                    //seleccionar de tabla todos a la fecha actual y que no sean novedades estatus 4
                    $sql = "SELECT * FROM inicio_de_labores ORDER BY fecha ASC";
                    $resultado = $conexion->query($sql);

                    while ($fila = $resultado->fetch()) {

                        $id = $fila['id'];
                        $fecha = $fila['fecha'];
                        $nombre = $fila['nombre'];

                        $sql2 = "SELECT dependencia FROM funcionarios WHERE nombre = '$nombre'";
                        $resultado2 = $conexion->query($sql2);
                        $dependencia = $resultado2->fetch();
                        $dependencia = $dependencia['dependencia'];

                        echo '
                     <tr>
                        <td><textarea class="fecha" data-class="' . $id . '">' . $fecha . '</textarea></td>
                        <td>' . $nombre . '</td>
                        <td>' . $dependencia . '</td>
                        <td><button class="btn-dlt" data-class="' . $id . '">Eliminar</button></td>
                     </tr>
                    ';
                    }



                    ?>
                </tbody>
            </table>
        </div>
    </section>
    <footer class="footer">
        <p>&copy; 2022 - SCRIS | Todos los derechos reservados</p>
    </footer>
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

                if (bool) {
                    valor = valor.toUpperCase();
                } else {

                    //eliminamos los espacios en blanco
                    if (valor != "") {
                        valor = valor.replace(/\s/g, '');
                        //verificamos que hayan 2 /
                        var contador = 0;
                        for (var i = 0; i < valor.length; i++) {
                            if (valor[i] == '/') {
                                contador++;
                            }
                        }
                        if (contador != 2) {
                            err = true;
                        } else {
                            //array de fechas
                            var fechas = valor.split('/');
                            var year = fechas[0];
                            var month = fechas[1];
                            var day = fechas[2];
                            //verificamos que la fecha sea valida
                            if (year.length != 4 || month.length != 2 || day.length != 2) {
                                err = true;
                            } else {
                                //vrificamos que el mes sea valido y que el dia sea valido
                                if (month > 12 || month < 1 || day > 31 || day < 1) {
                                    err = true;
                                } else {
                                    //verificamos que el mes tenga 31 dias
                                    if (month == 4 || month == 6 || month == 9 || month == 11) {
                                        if (day > 30 || day < 1) {
                                            err = true;
                                        }
                                    } else {
                                        //verificamos que el mes tenga 28 dias
                                        if (month == 2) {
                                            //verificamos que el año sea bisiesto
                                            if (year % 4 == 0) {
                                                if (day > 29 || day < 1) {
                                                    err = true;
                                                }
                                            } else {
                                                if (day > 28 || day < 1) {
                                                    err = true;
                                                }
                                            }
                                        }
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


                    $(this).css('border', 'none');
                    let sql = "UPDATE inicio_de_labores SET " + text + " = '" + valor + "' WHERE id = " + id;

                    $.ajax({
                        url: 'packages/Actions/eliminados.php',
                        type: 'POST',
                        data: {
                            'sql': sql
                        },
                        success: function(data) {
                            console.log(data);
                        }
                    });
                }
            });
        }

        Modificar('.fecha', false);
        Modificar('.observaciones', true);

        $('.btn-dlt').click(function() {
            var id = $(this).data('class');
            var sql = "DELETE FROM inicio_de_labores WHERE id = " + id;
            $.ajax({
                url: 'packages/Actions/eliminados.php',
                type: 'POST',
                data: {
                    'sql': sql
                },
                success: function(data) {
                    console.log(data);
                    location.reload();
                }
            });
        });

        // Modificar('.hora_ingreso', false);
        // Modificar('.hora_salida', false);
        // Modificar('.placa', true);
        // Modificar('.observaciones', true);
    </script>

</body>

</html>