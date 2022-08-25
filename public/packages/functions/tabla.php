<?php

function tabla_tr($param)
{
    $resultado = $param;

    while ($fila = $resultado->fetch()) {

        $id = $fila['id'];
        $fecha = $fila['fecha'];
        $nombre = $fila['nombre'];
        $dependencia = $fila['dependencia'];
        $direccion = $fila['direccion'];
        $asignatura = $fila['asignatura'];
        $hora_ingreso = $fila['hora_ingreso'];
        $hora_salida = $fila['hora_salida'];
        $placa = $fila['placa'];
        $observaciones = $fila['observaciones'];
        $status = $fila['status'];


        $hli = date("H:i", mktime(6, 15));
        $hlisg = date("H:i", mktime(8, 00));
        $hlisgc = date("H:i", mktime(6, 30));
        $hls = date("H:i", mktime(15, 00));
        $hstl = date("H:i", mktime(14, 30));

        if ($hora_ingreso != "") {
            $hora_ingreso = date("H:i", strtotime($hora_ingreso));
        }

        if ($hora_salida != "") {
            $hora_salida = date("H:i", strtotime($hora_salida));
        }


        $hid = $hora_ingreso;
        $hsd = $hora_salida;



        $novedad_salida = "";
        $novedad_entrada = "";

        if ($status == "2" || $status == "3") {
            $nnt = "tr-novedad-true";
        } else {
            $nnt = "";
        }

        if (($dependencia == "DOCENTE" || $direccion == "ENFERMERA") && ($nombre != "ALDUBAR SALAZAR") && ($hid  > $hli)) {
            $novedad_entrada = "hora__novedad";
        }
        if (($dependencia == "SERVICIOS GENERALES" && $nombre != "ADRIANA SILVA" && $hid > $hlisg) || ($dependencia == "SERVICIOS GENERALES" && $nombre == "ADRIANA SILVA" && $hid > $hlisgc)) {
            $novedad_entrada = "hora__novedad";
        }
        if (($dependencia == "DOCENTE" || $direccion == "ENFERMERA") && ($nombre != "ALDUBAR SALAZAR") && ($hsd > $hls) && $hsd != '') {
            $novedad_salida = "hora__novedad";
        }

        if (($dependencia == "DOCENTE" || $direccion == "ENFERMERA") && ($nombre != "ALDUBAR SALAZAR") && ($hsd < $hstl) && $hsd != '') {
            $novedad_salida = "hora__novedad";
        }

        echo '
    <tr class="' . $dependencia . ' status-' . $status . ' ' . $nnt . '" data-class="status-' . $status . '" data-indice="' . $id . '">
        <td>' . $fecha . '</td>
        <td>' . $nombre . '</td>
        <td>' . $dependencia . '</td>
        <td>' . $direccion . '</td>
        <td>' . $asignatura . '</td>
        <td class="' . $novedad_entrada . '"><textarea class="hora_ingreso" data-class="' . $id . '">' . $hora_ingreso . '</textarea></td>
        <td class="' . $novedad_salida . '"><textarea class="hora_salida" data-class="' . $id . '">' . $hora_salida . '</textarea></td>
        <td><textarea class="placa" data-class="' . $id . '">' . $placa . '</textarea></td>
        <td><textarea class="observaciones" data-class="' . $id . '">' . $observaciones . '</textarea></td>
    </tr>
    ';
    }
}

function tabla_buscar($param)
{
    $resultado = $param;

    $fecha_anterior = "";

    while ($fila = $resultado->fetch()) {

        $id = $fila['id'];
        $fecha = $fila['fecha'];
        $nombre = $fila['nombre'];
        $dependencia = $fila['dependencia'];
        $direccion = $fila['direccion'];
        $asignatura = $fila['asignatura'];
        $hora_ingreso = $fila['hora_ingreso'];
        $hora_salida = $fila['hora_salida'];
        $placa = $fila['placa'];
        $observaciones = $fila['observaciones'];
        $status = $fila['status'];


        $hli = date("H:i", mktime(6, 15));
        $hlisg = date("H:i", mktime(8, 00));
        $hlisgc = date("H:i", mktime(6, 30));
        $hls = date("H:i", mktime(15, 00));
        $hstl = date("H:i", mktime(14, 30));

        if ($hora_ingreso != "") {
            $hora_ingreso = date("H:i", strtotime($hora_ingreso));
        }

        if ($hora_salida != "") {
            $hora_salida = date("H:i", strtotime($hora_salida));
        }


        $hid = $hora_ingreso;
        $hsd = $hora_salida;



        $novedad_salida = "";
        $novedad_entrada = "";

        if ($status == "2" || $status == "3") {
            $nnt = "tr-novedad-true";
        } else {
            $nnt = "";
        }

        if (($dependencia == "DOCENTE" || $direccion == "ENFERMERA") && ($nombre != "ALDUBAR SALAZAR") && ($hid  > $hli)) {
            $novedad_entrada = "hora__novedad";
        }
        if (($dependencia == "SERVICIOS GENERALES" && $nombre != "ADRIANA SILVA" && $hid > $hlisg) || ($dependencia == "SERVICIOS GENERALES" && $nombre == "ADRIANA SILVA" && $hid > $hlisgc)) {
            $novedad_entrada = "hora__novedad";
        }
        if (($dependencia == "DOCENTE" || $direccion == "ENFERMERA") && ($nombre != "ALDUBAR SALAZAR") && ($hsd > $hls) && $hsd != '') {
            $novedad_salida = "hora__novedad";
        }

        if (($dependencia == "DOCENTE" || $direccion == "ENFERMERA") && ($nombre != "ALDUBAR SALAZAR") && ($hsd < $hstl) && $hsd != '') {
            $novedad_salida = "hora__novedad";
        }

        if ($fecha_anterior == "") {

            echo '

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
            ';

            $fecha_anterior = $fecha;
        }


        if ($fecha != $fecha_anterior && $fecha_anterior != "") {
            echo '
            </tbody>
            </table>
            <table class="tabla t-margin">
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

                        <tr class="' . $dependencia . ' status-' . $status . ' ' . $nnt . '" data-class="status-' . $status . '" data-indice="' . $id . '">
                            <td>' . $fecha . '</td>
                            <td>' . $nombre . '</td>
                            <td>' . $dependencia . '</td>
                            <td>' . $direccion . '</td>
                            <td>' . $asignatura . '</td>
                            <td class="' . $novedad_entrada . '"><textarea class="hora_ingreso" data-class="' . $id . '">' . $hora_ingreso . '</textarea></td>
                            <td class="' . $novedad_salida . '"><textarea class="hora_salida" data-class="' . $id . '">' . $hora_salida . '</textarea></td>
                            <td><textarea class="placa" data-class="' . $id . '">' . $placa . '</textarea></td>
                            <td><textarea class="observaciones" data-class="' . $id . '">' . $observaciones . '</textarea></td>
                        </tr>      
            ';
        } else {
            echo '
            <tr class="' . $dependencia . ' status-' . $status . ' ' . $nnt . '" data-class="status-' . $status . '" data-indice="' . $id . '">
                <td>' . $fecha . '</td>
                <td>' . $nombre . '</td>
                <td>' . $dependencia . '</td>
                <td>' . $direccion . '</td>
                <td>' . $asignatura . '</td>
                <td class="' . $novedad_entrada . '"><textarea class="hora_ingreso" data-class="' . $id . '">' . $hora_ingreso . '</textarea></td>
                <td class="' . $novedad_salida . '"><textarea class="hora_salida" data-class="' . $id . '">' . $hora_salida . '</textarea></td>
                <td><textarea class="placa" data-class="' . $id . '">' . $placa . '</textarea></td>
                <td><textarea class="observaciones" data-class="' . $id . '">' . $observaciones . '</textarea></td>
            </tr>
            ';
        }


        $fecha_anterior = $fecha;
    }
    echo '
            </tbody>
            </table>
            ';
}
//DIRECTIVO #00B0F0
//DOCENTE #BDD7EE
//ADMINISTRATIVO #00B050
//SERVICIOS GENERALES #C6E0B4
//FUNCIONARIO CAFETERÍA #FFE699
//MENSAJERÍA #FFf
//FUNCIONARIO EXTERNO #fff
//SEGURIDAD #AEAAAA
//#FFFF00 novedades
//#FF0000 retrasos
// en negrilla con todos los bordes cada celda
//todo centrado vertical y horizontalmente
//tamaño de letra 11

//quitar todas las tildes de las palabras