<?php
session_start();

if (!isset($_SESSION['logado']) && $_SESSION['logado'] != true) {
    header('Location: ../../index.php');
}

if ($_SESSION['admin'] != true) {

    session_destroy();
    header('Location: ../../index.php');
}

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
    <title>SCRIS | Administrador - agregar</title>
    <style>
    .footer p {
        text-align: center;
        padding: 1em;
        color: #fffa;
    }

    <?php include '../../css/admin-agregar.css';

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
    <section class="section">
        <div class="flex">
            <form action="">
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
                        <option value="PSICOLOGÍA">PSICOLOGÍA</option>
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
                <div class="form-group">
                    <label for="">Fecha de inicio de labores:</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
                </div>

                <div class="form-group control">
                    <button id="btn-enviar">
                        Enviar
                    </button>
                </div>

            </form>
        </div>
    </section>
    <footer class="footer">
        <p>&copy; 2022 - SCRIS | Todos los derechos reservados</p>
    </footer>
    <script>
    $('#btn-enviar').click(function() {
        var nombre = $('#nombre').val();
        var dependencia = $('#dependencia').val();
        var direccion = $('#direccion').val();
        var asignatura = $('#asignatura').val();
        var placa = $('#placa').val();
        var observaciones = $('#observaciones').val();
        var fecha_inicio = $('#fecha_inicio').val();
        if (nombre == '') {
            alert('Ingrese al menos un nombre');
        } else {
            $.ajax({
                url: 'functions/agregar.php',
                type: 'POST',
                data: {
                    agregar: true,
                    nombre: nombre,
                    dependencia: dependencia,
                    direccion: direccion,
                    asignatura: asignatura,
                    placa: placa,
                    observaciones: observaciones,
                    fecha_inicio: fecha_inicio
                },
                success: function(response) {
                    if (response == 'ok') {
                        alert('Registro agregado correctamente');
                    } else {
                        alert('Error al agregar el registro');
                    }
                    console.log(response);
                }
            });
        }
    });
    </script>

</body>

</html>