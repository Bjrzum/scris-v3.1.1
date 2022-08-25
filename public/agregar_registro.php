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
    <title>SCRIS | Agregar Registro</title>
    <style>
        .footer p {
            text-align: center;
            padding: 1em;
            color: #fffa;
        }

        <?php include 'css/agregar_registro.css';
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
        <table class="table">
            <thead>
                <tr>
                    <th>FECHA</th>
                    <th>NOMBRE</th>
                    <th>DEPENDENCIA</th>
                    <th>DIRECCIÓN DE CURSO</th>
                    <th>ASIGNATURA</th>
                    <th>HORA DE INGRESO</th>
                    <th>HORA DE SALIDA</th>
                    <th>PLACA DE VEHICULO</th>
                    <th>OBSERVACIONES</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="date" name="fecha" id="fecha" class="fecha">
                    </td>
                    <td>
                        <select name="nombre" id="nombre">
                            <option value="">Seleccione</option>
                            <?php
                            $db = new SQLite3('db/scris.db');
                            $sql = 'SELECT nombre FROM funcionarios';
                            $result = $db->query($sql);
                            while ($row = $result->fetchArray()) {
                                echo '<option value="' . $row['nombre'] . '">' . $row['nombre'] . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select name="dependencia" id="dependencia">
                            <option value="">Seleccione</option>
                            <?php $db = new SQLite3('db/scris.db');
                            $sql = 'SELECT dependencia FROM funcionarios GROUP BY dependencia';
                            $result = $db->query($sql);
                            while ($row = $result->fetchArray()) {
                                echo '<option value="' . $row['dependencia'] . '">' . $row['dependencia'] . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                    <td class="direccion">
                    </td>
                    <td class="asignatura">
                    </td>
                    <td>
                        <input type="time" name="hora_ingreso" id="hora_ingreso" class="hora_ingreso">
                    </td>
                    <td>
                        <input type="time" name="hora_salida" id="hora_salida" class="hora_salida">
                    </td>
                    <td>
                        <input type="text" name="placa" id="placa" class="placa">
                    </td>
                    <td>
                        <input type="text" name="observaciones" id="observaciones" class="observaciones">
                    </td>
                </tr>

            </tbody>
        </table>
        <button class="btn btn-agregar">AGREGAR</button>

    </section>
    <footer class="footer">
        <p>&copy; 2022 - SCRIS | Todos los derechos reservados</p>
    </footer>
    <script>
        <?php include 'js/agregar_registro.js'; ?>
    </script>

</body>

</html>