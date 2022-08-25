<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

date_default_timezone_set('America/Bogota');

include 'packages/Conexion.php';
require_once 'packages/functions/tabla.php';
require_once 'packages/functions/HoraAmPm.php';


$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();


$sheet->setCellValue('A1', 'FECHA');
$sheet->setCellValue('B1', 'NOMBRE');
$sheet->setCellValue('C1', 'DEPENDENCIA');
$sheet->setCellValue('D1', 'DIRECCIÓN DE CURSO');
$sheet->setCellValue('E1', 'ASIGNATURA');
$sheet->setCellValue('F1', 'HORA DE INGRESO');
$sheet->setCellValue('G1', 'HORA DE SALIDA');
$sheet->setCellValue('H1', 'PLACA DE VEHICULO');
$sheet->setCellValue('I1', 'OBSERVACIONES');
$spreadsheet->getActiveSheet()->getStyle('A1:I1')->getAlignment()->setWrapText(true);

//relleno solido C65911
$spreadsheet->getActiveSheet()->getStyle('A1:I1')->applyFromArray(
    [
        'font' => [
            'bold' => true,
            'size' => 12
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '000000']
            ]
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'color' => ['argb' => 'C65911']
        ]
    ]
);

$stylesArray = [
    'font' => [
        'bold' => true,
        'size' => 11
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '000000']
        ]
    ]
];

$stylesArrayNovedad = [
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'color' => ['argb' => 'FFFF00']
    ]
];

$stylesArrayDirectivo = [
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'color' => ['argb' => '00B0F0']
    ]
];

$stylesArrayDocente = [
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'color' => ['argb' => 'BDD7EE']
    ]
];

$stylesArrayAdministrativo = [
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'color' => ['argb' => '00B050']
    ]
];

$stylesArraySG = [
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'color' => ['argb' => 'C6E0B4']
    ]
];

$stylesArrayFC = [
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'color' => ['argb' => 'FFE699']
    ]
];

$stylesArrayMensajeria = [
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'color' => ['argb' => 'FFFFFF']
    ]
];

$stylesArrayFE = [
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'color' => ['argb' => 'FFFFF']
    ]
];

$stylesArraySeguridad = [
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'color' => ['argb' => 'AEAAAA']
    ]
];

$stylesArrayFalta = [
    'font' => [
        'color' => ['argb' => 'FF0000']
    ]
];


$fecha_hoy = date("Y/m/d");

$ruta = 'db/scris.db';
$conexion = conectar($ruta);

$sql = "SELECT * FROM tabla WHERE fecha = '$fecha_hoy' AND status != 4 ORDER BY hora_ingreso ASC";
$resultado = $conexion->query($sql);

$row = 2;



while ($fila = $resultado->fetch()) {

    $n = $row;

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

    $sheet->setCellValue('A' . $n, $fecha);
    $sheet->setCellValue('B' . $n, $nombre);
    $sheet->setCellValue('C' . $n, $dependencia);
    $sheet->setCellValue('D' . $n, $direccion);
    $sheet->setCellValue('E' . $n, $asignatura);
    $sheet->setCellValue('F' . $n, HoraAmPm($hora_ingreso));
    $sheet->setCellValue('G' . $n, HoraAmPm($hora_salida));
    $sheet->setCellValue('H' . $n, $placa);
    $sheet->setCellValue('I' . $n, $observaciones);
    $sheet->getStyle('A' . $n . ':I' . $n)->getAlignment()->setWrapText(true);
    $sheet->getStyle('A' . $n . ':I' . $n)->applyFromArray($stylesArray);

/*---- bloque de codigo modificado

    if ($dependencia == "DIRECTIVO") {
        $sheet->getStyle('A' . $n . ':I' . $n)->applyFromArray($stylesArrayDirectivo);
    } else if ($dependencia == "DOCENTE") {
        $sheet->getStyle('A' . $n . ':I' . $n)->applyFromArray($stylesArrayDocente);
    } else if ($dependencia == "ADMINISTRATIVO") {
        $sheet->getStyle('A' . $n . ':I' . $n)->applyFromArray($stylesArrayAdministrativo);
    } else if ($dependencia == "SERVICIOS GENERALES") {
        $sheet->getStyle('A' . $n . ':I' . $n)->applyFromArray($stylesArraySG);
    } else if ($dependencia == "FUNCIONARIO CAFETERÍA") {
        $sheet->getStyle('A' . $n . ':I' . $n)->applyFromArray($stylesArrayFC);
    } else if ($dependencia == "MENSAJERÍA") {
        $sheet->getStyle('A' . $n . ':I' . $n)->applyFromArray($stylesArrayMensajeria);
    } else if ($dependencia == "FUNCIONARIO EXTERNO") {
        $sheet->getStyle('A' . $n . ':I' . $n)->applyFromArray($stylesArrayFE);
    } else if ($dependencia == "SEGURIDAD") {
        $sheet->getStyle('A' . $n . ':I' . $n)->applyFromArray($stylesArraySeguridad);
    }
    */
    
    /*nuevo bloque de código*/
    if ($dependencia == "DOCENTE" || $dependencia != "DOCENTE") {
        $sheet->getStyle('A' . $n . ':I' . $n)->applyFromArray($stylesArrayDocente);
    }
    
    

    if ($status == '4') {

        $sheet->getStyle('A' . $n . ':I' . $n)->applyFromArray($stylesArrayNovedad);
    } else {

        if ($status == '2' || $status == '3') {

            $sheet->getStyle('A' . $n . ':I' . $n)->applyFromArray($stylesArrayNovedad);

            if ($dependencia == "DOCENTE" || $direccion == "ENFERMERA") {

                if ($hid > $hli) {
                    $sheet->getStyle('F' . $n)->applyFromArray($stylesArrayFalta);
                }

                if ($hsd < $hstl || $hsd > $hls) {
                    $sheet->getStyle('G' . $n)->applyFromArray($stylesArrayFalta);
                }
            }
            if ($dependencia == "SERVICIOS GENERALES" && $nombre != "ADRIANA SILVA") {

                if ($hid > $hlisg) {
                    $sheet->getStyle('F' . $n)->applyFromArray($stylesArrayFalta);
                }
            }

            if ($dependencia == "SERVICIOS GENERALES" && $nombre == "ADRIANA SILVA") {

                if ($hid > $hlisgc) {
                    $sheet->getStyle('F' . $n)->applyFromArray($stylesArrayFalta);
                }
            }
        } else {

            if ($dependencia == "DOCENTE" || $direccion == "ENFERMERA") {

                if ($hid > $hli) {
                    $sheet->getStyle('F' . $n)->applyFromArray($stylesArrayFalta);
                }

                if ($hsd < $hstl || $hsd > $hls) {
                    $sheet->getStyle('G' . $n)->applyFromArray($stylesArrayFalta);
                }
            }
            if ($dependencia == "SERVICIOS GENERALES" && $nombre != "ADRIANA SILVA") {

                if ($hid > $hlisg) {
                    $sheet->getStyle('F' . $n)->applyFromArray($stylesArrayFalta);
                }
            }

            if ($dependencia == "SERVICIOS GENERALES" && $nombre == "ADRIANA SILVA") {

                if ($hid > $hlisgc) {
                    $sheet->getStyle('F' . $n)->applyFromArray($stylesArrayFalta);
                }
            }
        }
    }

    $row++;
}


$sql = "SELECT * FROM tabla WHERE fecha = '$fecha_hoy' AND  status = '4'";
$resultado = $conexion->query($sql);

while ($fila = $resultado->fetch()) {

    $n = $row;

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

    $sheet->setCellValue('A' . $n, $fecha);
    $sheet->setCellValue('B' . $n, $nombre);
    $sheet->setCellValue('C' . $n, $dependencia);
    $sheet->setCellValue('D' . $n, $direccion);
    $sheet->setCellValue('E' . $n, $asignatura);
    $sheet->setCellValue('F' . $n, HoraAmPm($hora_ingreso));
    $sheet->setCellValue('G' . $n, HoraAmPm($hora_salida));
    $sheet->setCellValue('H' . $n, $placa);
    $sheet->setCellValue('I' . $n, $observaciones);
    $sheet->getStyle('A' . $n . ':I' . $n)->getAlignment()->setWrapText(true);
    $sheet->getStyle('A' . $n . ':I' . $n)->applyFromArray($stylesArray);
    $sheet->getStyle('A' . $n . ':I' . $n)->applyFromArray($stylesArrayNovedad);



    $row++;
}
//ancho de 14 a A1
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(14);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(30);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(12);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(12);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(50);
$spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(50);




// $fecha_nombre = date("Y-m-d");
// $ruta = "xlsx/' . $fecha_nombre . '.xlsx";

// if (file_exists($ruta)) {
//     unlink($ruta);
// }

// $writer = new Xlsx($spreadsheet);
// $writer->save($ruta);
$ruta = "enviar/funcionarios.xlsx";
if (file_exists($ruta)) {
    unlink($ruta);
}

$writer = new Xlsx($spreadsheet);
$writer->save('enviar/funcionarios.xlsx');

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Reporte</title>

    <style>
    * {
        font-family: 'Arial';
        box-sizing: border-box;
        padding: 0;
        margin: 0;
    }

    body {
        width: 100%;
        height: 100%;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    form {
        width: 100%;
        max-width: 500px;
        margin: auto;
        padding: 20px;
    }

    p {
        background-color: #ffd500aa;
        color: #ff5500;
        text-align: center;
        padding: 10px;
        margin: 10px;
        font-size: 20px;
        font-weight: bold;
    }

    .respuestas {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    input {
        padding: 10px;
        margin: 10px;
        border: 1px solid #ff5500;
        border-radius: 5px;
        color: #fff;
        font-size: 1em;
        font-weight: bold;
        cursor: pointer;
        background-color: #a00000;
        display: inline-block;
        width: 100px;
        text-align: center;

    }

    input:hover {
        background-color: #ff5500;
    }

    a {
        padding: 10px;
        margin: 10px;
        text-decoration: none;
        color: #fff;
        font-size: 1em;
        font-weight: bold;
        cursor: pointer;
        background-color: #00aa00;
        border: 1px solid #006600;
        display: inline-block;
        border-radius: 5px;
        width: 100px;
        text-align: center;
    }

    a:hover {
        background-color: #48e;
    }
    </style>
</head>

<body>

    <form action="enviar.php" method="post">
        <p class="info">
            ¿Seguro que deseas enviar el reporte?
        </p>
        <div class="respuestas">
            <input type="submit" value="Enviar" name="enviar">
            <a href="tabla.php">Cancelar</a>
            <a href="enviar/funcionarios.xlsx">Descargar</a>
        </div>
    </form>

</body>

</html>