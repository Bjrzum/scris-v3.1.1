<?php

include 'packages/Conexion.php';
require_once 'packages/functions/tabla.php';


function HoraAmPm($hora)
{
    $h = $hora;

    if ($h != "") {
        $h = explode(':', $h);
        $h[0] = intval($h[0]);
        $h[1] = intval($h[1]);
        $ampm = 'a.m.'; // a.m. || p.m.
        if ($h[0] > 12) {
            $ampm = 'p.m.';
            $h[0] = $h[0] - 12;
        } elseif ($h[0] == 12) {
            $ampm = 'p.m.';
        } elseif ($h[0] == 0) {
            $h[0] = 12;
        }

        //agregar 0 a los minutos si son menos de 10
        if ($h[1] < 10) {
            $h[1] = '0' . $h[1];
        }
        return $h[0] . ':' . $h[1] . ' ' . $ampm;
    } else {
        return "";
    }
}

$ruta = 'db/scris.db';
$conexion = conectar($ruta);

$tabla_ecab = "
<table class='table table-bordered table-striped'>
<thead>
<tr>
<th id='date'>FECHA</th>
<th id='name'>NOMBRE</th>
<th id='dependency'>DEPENDENCIA</th>
<th id='address'>DIRECCIÓN DE CURSO</th>
<th id='asig'>ASIGNATURA</th>
<th id='hour'>HORA DE INGRESO</th>
<th id='hour2'>HORA DE SALIDA</th>
<th id='auto'>PLACA DE VEHÍCULO</th>
<th id='obj'>OBSERVACIONES</th>
</tr>
</thead>
<tbody>";

$tabla = "";

$tabla_pie = "
</tbody>
</table>";

$tabla_completa = "";

if (isset($_GET['sql'])) {

    $sql_ajax = $_GET['sql'];
    $sql2_ajax = $_GET['sql2'];
    $fecha_inicio_ajax = $_GET['fecha_inicio'];
    $fecha_fin_ajax = $_GET['fecha_fin'];
    $fecha_inicio_ajax = date('Y/m/d', strtotime($fecha_inicio_ajax));


    while ($fecha_inicio_ajax <= $fecha_fin_ajax) {

        $sql = $sql_ajax . " fecha = '" . $fecha_inicio_ajax . "'" . $sql2_ajax . " AND  status != 4 ORDER BY hora_ingreso";
        $result = $conexion->query($sql);
        $bool = false;

        $sql2 = "SELECT * FROM tabla WHERE fecha = '" . $fecha_inicio_ajax . "'" . $sql2_ajax;
        $result2 = $conexion->query($sql2);

        while ($row2 = $result2->fetch()) {
            $bool = true;
        }

        if ($bool) {
            $tabla .= $tabla_ecab;
        }


        while ($row = $result->fetch()) {

            $fecha = $row['fecha'];
            $nombre = $row['nombre'];
            $dependencia = $row['dependencia'];
            $direccion = $row['direccion'];
            $asignatura = $row['asignatura'];
            $hora_ingreso = $row['hora_ingreso'];
            $hora_salida = $row['hora_salida'];
            $placa = $row['placa'];
            $observaciones = $row['observaciones'];
            $status = intval($row['status']);

            $hli = date("H:i", mktime(6, 15));
            $hlisg = date("H:i", mktime(8, 00));
            $hlisgc = date("H:i", mktime(6, 30));
            $hls = date("H:i", mktime(15, 00));
            $hstl = date("H:i", mktime(14, 30));

            $hid = "";
            $hsd = "";

            if ($hora_ingreso != "") {
                $h_p = explode(':', $hora_ingreso);
                $h_p[0] = intval($h_p[0]);
                $h_p[1] = intval($h_p[1]);
                //convertir a hora php
                $h_p = $h_p[0] . ':' . $h_p[1];
                $hid = date("H:i", strtotime($h_p));
            }
            if ($hora_salida != "") {
                $h_s = explode(':', $hora_salida);
                $h_s[0] = intval($h_s[0]);
                $h_s[1] = intval($h_s[1]);
                //convertir a hora php
                $h_s = $h_s[0] . ':' . $h_s[1];
                $hsd = date("H:i", strtotime($h_s));
            }

            $cl_dep = "";
            $cl_tarde_ingreso = "";
            $cl_tarde_salida = "";

            if ($dependencia == "DIRECTIVO") {
                $cl_dep = "class='directivo'";
            } else if ($dependencia == "DOCENTE") {
                $cl_dep = "class='docente'";
            } else if ($dependencia == "ADMINISTRATIVO") {
                $cl_dep = "class='administrativo'";
            } else if ($dependencia == "SERVICIOS GENERALES") {
                $cl_dep = "class='servicios_generales'";
            } else if ($dependencia == "FUNCIONARIO CAFETERÍA") {
                $cl_dep = "class='funcionario_cafeteria'";
            } else if ($dependencia == "MENSAJERÍA") {
                $cl_dep = "class='mensajeria'";
            } else if ($dependencia == "FUNCIONARIO EXTERNO") {
                $cl_dep = "class='funcionario_externo'";
            } else if ($dependencia == "SEGURIDAD") {
                $cl_dep = "class='seguridad'";
            }
            if ($status == '2' || $status == '3') {

                $cl_dep = "class='novedad'";

                if ($dependencia == "DOCENTE" || $direccion == "ENFERMERA") {

                    if ($hid > $hli) {
                        $cl_tarde_ingreso = "class='llegada_tarde'";
                    }

                    if ($hsd < $hstl || $hsd > $hls) {
                        $cl_tarde_salida = "class='salida_tarde'";
                    }
                }
                if ($dependencia == "SERVICIOS GENERALES" && $nombre != "ADRIANA SILVA") {

                    if ($hid > $hlisg) {
                        $cl_tarde_ingreso = "class='llegada_tarde'";
                    }
                }

                if ($dependencia == "SERVICIOS GENERALES" && $nombre == "ADRIANA SILVA") {

                    if ($hid > $hlisgc) {
                        $cl_tarde_ingreso = "class='llegada_tarde'";
                    }
                }
            } else {

                if ($dependencia == "DOCENTE" || $direccion == "ENFERMERA") {

                    if ($hid > $hli) {
                        $cl_tarde_ingreso = "class='llegada_tarde'";
                    }

                    if ($hsd < $hstl || $hsd > $hls) {
                        $cl_tarde_salida = "class='salida_tarde'";
                    }
                }
                if ($dependencia == "SERVICIOS GENERALES" && $nombre != "ADRIANA SILVA") {

                    if ($hid > $hlisg) {
                        $cl_tarde_ingreso = "class='llegada_tarde'";
                    }
                }

                if ($dependencia == "SERVICIOS GENERALES" && $nombre == "ADRIANA SILVA") {

                    if ($hid > $hlisgc) {
                        $cl_tarde_ingreso = "class='llegada_tarde'";
                    }
                }
            }

            $tabla .= "<tr " . $cl_dep . ">";
            $tabla .= "<td>" . $fecha . "</td>";
            $tabla .= "<td>" . $nombre . "</td>";
            $tabla .= "<td>" . $dependencia . "</td>";
            $tabla .= "<td>" . $direccion . "</td>";
            $tabla .= "<td>" . $asignatura . "</td>";
            $tabla .= "<td " . $cl_tarde_ingreso . ">" . HoraAmPm($hora_ingreso) . "</td>";
            $tabla .= "<td " . $cl_tarde_salida . ">" . HoraAmPm($hora_salida) . "</td>";
            $tabla .= "<td>" . $placa . "</td>";
            $tabla .= "<td>" . $observaciones . "</td>";
            $tabla .= "</tr>";
        }

        $sql = $sql_ajax . " fecha = '" . $fecha_inicio_ajax . "' AND status = 4"  . $sql2_ajax;
        $result = $conexion->query($sql);

        while ($row = $result->fetch()) {
            $fecha = $row['fecha'];
            $nombre = $row['nombre'];
            $dependencia = $row['dependencia'];
            $direccion = $row['direccion'];
            $asignatura = $row['asignatura'];
            $hora_ingreso = $row['hora_ingreso'];
            $hora_salida = $row['hora_salida'];
            $placa = $row['placa'];
            $observaciones = $row['observaciones'];
            $status = $row['status'];
            $status = intval($status);

            $hli = date("H:i", mktime(6, 15));
            $hlisg = date("H:i", mktime(8, 00));
            $hlisgc = date("H:i", mktime(6, 30));
            $hls = date("H:i", mktime(15, 00));
            $hstl = date("H:i", mktime(14, 30));

            $hid = "";
            $hsd = "";

            if ($hora_ingreso != "") {
                $h_p = explode(':', $hora_ingreso);
                $h_p[0] = intval($h_p[0]);
                $h_p[1] = intval($h_p[1]);
                //convertir a hora php
                $h_p = $h_p[0] . ':' . $h_p[1];
                $hid = date("H:i", strtotime($h_p));
            }
            if ($hora_salida != "") {
                $h_s = explode(':', $hora_salida);
                $h_s[0] = intval($h_s[0]);
                $h_s[1] = intval($h_s[1]);
                //convertir a hora php
                $h_s = $h_s[0] . ':' . $h_s[1];
                $hsd = date("H:i", strtotime($h_s));
            }

            $tabla .= "<tr class='novedad'>";
            $tabla .= "<td>" . $fecha . "</td>";
            $tabla .= "<td>" . $nombre . "</td>";
            $tabla .= "<td>" . $dependencia . "</td>";
            $tabla .= "<td>" . $direccion . "</td>";
            $tabla .= "<td>" . $asignatura . "</td>";
            $tabla .= "<td>" . HoraAmPm($hora_ingreso) . "</td>";
            $tabla .= "<td>" . HoraAmPm($hora_salida) . "</td>";
            $tabla .= "<td>" . $placa . "</td>";
            $tabla .= "<td>" . $observaciones . "</td>";
            $tabla .= "</tr>";
        }
        if ($bool) {
            $tabla .= $tabla_pie;
        }

        $fecha_inicio_ajax = date('Y/m/d', strtotime($fecha_inicio_ajax . ' +1 day'));
    }
}



?>


<!DOCTYPE html>
<html lang="eS">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/library/jquery/dist/jquery.min.js"></script>
    <title>
        REGISTROS
    </title>
    <style>
    .download {
        display: inline-block;
        position: fixed;
        right: 1em;
        top: 1em;
        border: 1px solid #fff;
        background-color: #070;
        color: #fff;
        padding: 0.5em 1em;
        border-radius: 3px;
        font-family: Calibri, sans-serif !important;
        font-weight: bold;
        text-transform: uppercase;
        text-decoration: none;
    }

    .download:hover {
        background-color: #fff;
        color: #070;
    }

    table {
        font-family: Calibri, sans-serif !important;
        font-size: 14px;
        font-weight: bold;
        text-align: center !important;
        padding: .5em;
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 4em;

    }

    .llegada_tarde,
    .salida_tarde {
        color: #ff0000 !important;
    }

    .novedad {
        background-color: #ff0 !important;
    }

    thead {
        background-color: #C65911 !important;
        font-size: 16px;
    }

    th {
        padding-top: 1em;
        padding-bottom: 1em;
    }

    th,
    td {
        border: 1px solid #000;
    }

    .docente {
        background-color: #BDD7EE;
    }

    .administrativo {
        background-color: #00B050;
    }

    .directivo {
        background-color: #00B0F0;
    }

    .funcionario_cafeteria {
        background-color: #FFE699;
    }

    .mensajeria {
        background-color: #87c;
    }

    .servicios_generales {
        background-color: #C6E0B4;
    }

    .seguridad {
        background-color: #aaa;
    }

    .funcionario_externo {
        background-color: #eee;
    }

    #date {
        width: 75px !important;
    }

    #name {
        width: 200px !important;
    }

    #dependency {
        width: 160px !important;
    }

    #address {
        width: 200px !important;
    }

    #asig {
        width: 200px !important;
    }

    #hour {
        width: 75px !important;
    }

    #hour2 {
        width: 75px !important;
    }

    #auto {
        width: 75px !important;
    }

    #obj {
        width: auto;
    }
    </style>
</head>

<body>
    <?php

    if ($tabla != "") {

        echo '<div id="post-result"></div>';
        echo $tabla;
    } else {
        echo "<h1>No hay registros</h1>";
    }
    ?>

    <script>
    <?php
        if (isset($_GET['sql'])) {
            $sql = $_GET['sql'];
            $sql2 = $_GET['sql2'];
            $fecha_inicio = $_GET['fecha_inicio'];
            $fecha_fin = $_GET['fecha_fin'];

            echo "var sql = '" . $sql . "';";
            echo "var sql2 = '" . $sql2 . "';";
            echo "var fecha_inicio = '" . $fecha_inicio . "';";
            echo "var fecha_fin = '" . $fecha_fin . "';";

        ?>

    $(document).ready(function() {
        $.ajax({
            url: "reporteExcel.php",
            type: "POST",
            data: {
                sql: sql,
                sql2: sql2,
                fecha_inicio: fecha_inicio,
                fecha_fin: fecha_fin
            },
            success: function(data) {
                console.log(data);
                if (data == "ok") {
                    $("#post-result").html("<a href='<?php $ruta = 'reportes/reporte.xlsx';
                                                                echo $ruta; ?>' class='download'>Descargar</a>");
                }
            }
        });
    });


    <?php
            //$fecha_inicio = date('Y/m/d', strtotime($fecha_inicio));
        }
        ?>
    </script>

</body>

</html>