<?php

session_start();

if (!isset($_SESSION['logado']) && $_SESSION['logado'] != true) {
    header('Location: ../../index.php');
}

if ($_SESSION['admin'] != true) {

    session_destroy();
    header('Location: ../../index.php');
}


if (isset($_POST['cerrar'])) {

    $_SESSION['admin'] = false;
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
    <title>SCRIS | Administrador</title>
    <style>
    .footer p {
        text-align: center;
        padding: 1em;
        color: #fffa;
    }

    #cerrar--admin {
        display: inline-block;
        padding: .5em 1em;
        background-color: transparent;
        color: #fff;
        border-radius: 5px;
        border: none;
        cursor: pointer;
    }

    #cerrar--admin:hover {
        background-color: #fff;
        color: #000;
    }

    <?php include '../../css/admin-index.css';

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
            <a href="" class="link__nav link__nav--active">Administrador</a>
            <button id="cerrar--admin">Regresar</button>
        </nav>
    </header>
    <section class="section">
        <div class="flex">
            <a href="agregar.php" class="agregar">Agregar</a>
            <a href="modificar.php" class="modificar">Modificar</a>
            <a href="eliminar.php" class="eliminar">Eliminar</a>
        </div>
    </section>
    <footer class="footer">
        <p>&copy; 2022 - SCRIS | Todos los derechos reservados</p>
    </footer>
    <script>
    $(document).ready(function() {
        $('#cerrar--admin').click(function() {
            $.ajax({
                url: 'index.php',
                type: 'POST',
                data: {
                    cerrar: true
                },
                success: function(response) {
                    window.location.href = '../../avanzado.php';
                }
            });
        });
    });
    </script>

</body>

</html>