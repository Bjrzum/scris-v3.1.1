<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

date_default_timezone_set('America/Bogota');

include 'packages/Conexion.php';
require_once 'packages/functions/tabla.php';
require_once 'packages/functions/Colores.php';
require_once 'packages/functions/HoraAmPm.php';
require_once 'packages/functions/StylesExcel.php';


$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$db = new SQLite3('db/scris.db');

if (isset($_POST['sql'])) {

    // $query = '
    // UPDATE tabla SET orden = 0 WHERE status = 0 OR status = 1 OR status = 2 OR status = 3;
    //';
    //$query2 = '
    //UPDATE tabla SET orden = 1 WHERE  status = 4;
    //';

    //$result = $db->query($query);
    // $result2 = $db->query($query2);


    $sql = $_POST['sql'];
    $sql2 = $_POST['sql2'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    $fecha_inicio = date('Y/m/d', strtotime($fecha_inicio));
    $fecha_fin = date('Y/m/d', strtotime($fecha_fin));

    $fila = 1;

    while ($fecha_inicio <= $fecha_fin) {
        $fecha = $fecha_inicio;
        $sentencia = $sql . ' fecha = "' . $fecha . '"' . $sql2 . ' ORDER BY orden, hora_ingreso';
        $result = $db->query($sentencia);

        //verificar que existan registros
        if ($result->numColumns() > 0) {
            $sheet = Encabezados($fila, $sheet);
            $spreadsheet = StylesEncab($fila, $spreadsheet);
            $fila++;
        }

        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
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
            $sheet = StyleDep($fila, $sheet, $fecha, $nombre, $dependencia, $direccion, $asignatura, $hora_ingreso, $hora_salida, $placa, $observaciones, $status);
            $fila++;
        }


        $fila++;


        $fecha_inicio = date('Y/m/d', strtotime($fecha_inicio . ' +1 day'));
    }

    $ruta = 'reportes/';
    $nombre = 'reporte.xlsx';
    //eliminar el archivo si existe
    if (file_exists($ruta . $nombre)) {
        unlink($ruta . $nombre);
    }
    $ruta = $ruta . $nombre;
    $writer = new Xlsx($spreadsheet);
    $writer->save($ruta);

    echo 'ok';
}
