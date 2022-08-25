<?php
session_start();

if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
    header('Location: inicio.php');
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.png" type="image/png">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/login.css">
    <title>SCRIS | Login</title>
    <script src="js/library/jquery/dist/jquery.min.js"></script>
</head>

<body>
    <div class="fondo"></div>
    <header class="header">
        <h1>
            BIENVENIDO AL SISTEMA DE REGISTRO SCRIS
        </h1>
    </header>
    <section class="section">
        <form action="packages/Login.php" method="post">
            <div class="form-group">
                <label for="password">Ingrese el PIN:</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="PIN" autofocus>
            </div>
            <div class="form-group">
                <input type="submit" value="Ingresar" class="btn btn-primary" name="validar">
            </div>
        </form>
    </section>
    <footer class="footer">
        <p>
            Copyright &copy; 2022 - Todos los derechos reservados - SCRIS
        </p>
    </footer>
    <script src="js/peticion.js"></script>

</body>

</html>