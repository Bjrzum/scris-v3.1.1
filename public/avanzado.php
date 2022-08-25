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
    <title>SCRIS | Avanzado</title>
    <style>
        .footer p {
            text-align: center;
            padding: 1em;
            color: #fffa;
        }

        <?php include 'css/advance.css';
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
        </nav>
    </header>
    <section class="section">
        <div class="flex">
            <a href="buscar.php" class="buscar_registros">BUSCAR REGISTROS</a>
            <a href="inicio_labores.php" class="inicio_labores">INICIO DE LABORES</a>
            <a href="termino_labores.php" class="termino_labores">TÉRMINO DE LABORES</a>
            <a href="agregar_registro.php" class="agregar_registro.php">AGREGAR REGISTRO</a>
            <button class="avanzado">OPCIONES AVANZADAS</button>
        </div>
    </section>

    <section class="administrador">
        <div class="cont_adm">
            <div class="admin">
                <div class="advertencia">
                    <h2>ADVERTENCIA</h2>
                    <p>
                        Esta opción es para administradores, los cambios realizados afectarán a la base de datos, por
                        favor
                        ingrese su contraseña para continuar.
                    </p>
                </div>

                <div class="contrasena">
                    <div class="inputs">
                        <div class="entries">
                            <input type="password" name="contraseña" id="password" autocomplete="new-password" aria-autocomplete="false" aria-disabled="true">
                        </div>
                        <div class="op">
                            <input type="submit" value="Aceptar" id="enviar">
                            <button class="cancel">Cancelar</button>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </section>
    <footer class="footer">
        <p>&copy; 2022 - SCRIS | Todos los derechos reservados</p>
    </footer>
    <script>
        $('.avanzado').click(function() {
            $('.administrador').addClass('administrador--active');
            $('.cont_adm').addClass('cont_adm--open');
            $('#password').focus();
        });
        $('.cancel').click(function() {
            $('.administrador').removeClass('administrador--active');
            $('.cont_adm').removeClass('cont_adm--open');
        });

        $('#enviar').click(function() {
            var contrasena = $('#password').val();

            $.ajax({
                url: 'packages/Actions/PassAdvance/PassAdvance.php',
                type: 'POST',
                data: {
                    contrasena: contrasena
                },
                success: function(response) {
                    if (response == 'correcto') {

                        $('#password').css('border', '2px solid #0a0');
                        window.location.href = 'packages/admin/';
                    } else {
                        //placeholder para contraseña incorrecta en color rojo
                        $('#password').css('border', '2px solid red');
                        $('#password').attr('placeholder', 'Contraseña incorrecta');
                        $('#password').val('');
                    }
                    console.log(response);
                }
            });
        });

        $('#password').keyup(function() {
            var contrasena = $('#password').val();
            //ajax para verificar contraseña
            $.ajax({
                url: 'packages/Actions/PassAdvance/PassAdvance.php',
                type: 'POST',
                data: {
                    contrasena: contrasena
                },
                success: function(response) {
                    if (response == 'correcto') {
                        $('#password').css('border', '2px solid #0a0');
                        window.location.href = 'packages/admin/';
                    } else {
                        $('#password').css('border', '2px solid red');
                        $('#password').attr('placeholder', 'Contraseña incorrecta');
                    }
                    console.log(response);
                }
            });
        });
    </script>

</body>

</html>