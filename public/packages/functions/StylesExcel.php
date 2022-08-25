<?php

//funciones
function Encabezados($fila, $sheet)
{
    $sheet->setCellValue('A' . $fila, 'FECHA');
    $sheet->setCellValue('B' . $fila, 'NOMBRE');
    $sheet->setCellValue('C' . $fila, 'DEPENDENCIA');
    $sheet->setCellValue('D' . $fila, 'DIRECCIÓN DE CURSO');
    $sheet->setCellValue('E' . $fila, 'ASIGNATURA');
    $sheet->setCellValue('F' . $fila, 'HORA DE INGRESO');
    $sheet->setCellValue('G' . $fila, 'HORA DE SALIDA');
    $sheet->setCellValue('H' . $fila, 'PLACA DE VEHICULO');
    $sheet->setCellValue('I' . $fila, 'OBSERVACIONES');
    return $sheet;
}
function StylesEncab($fila, $spreadsheet)
{
    $spreadsheet->getActiveSheet()->getStyle('A' . $fila . ':I' . $fila)->getAlignment()->setWrapText(true);
    $spreadsheet->getActiveSheet()->getStyle('A' . $fila . ':I' . $fila)->applyFromArray(
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
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(14);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(40);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(30);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(30);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(12);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(12);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(50);
    $spreadsheet->getActiveSheet()->getRowDimension($fila)->setRowHeight(50);

    return $spreadsheet;
}

function StyleDep($fila, $sheet, $fecha, $nombre, $dependencia, $direccion, $asignatura, $hora_ingreso, $hora_salida, $placa, $observaciones, $status)
{
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

    $sheet->setCellValue('A' . $fila, $fecha);
    $sheet->setCellValue('B' . $fila, $nombre);
    $sheet->setCellValue('C' . $fila, $dependencia);
    $sheet->setCellValue('D' . $fila, $direccion);
    $sheet->setCellValue('E' . $fila, $asignatura);
    $sheet->setCellValue('F' . $fila, HoraAmPm($hora_ingreso));
    $sheet->setCellValue('G' . $fila, HoraAmPm($hora_salida));
    $sheet->setCellValue('H' . $fila, $placa);
    $sheet->setCellValue('I' . $fila, $observaciones);
    $sheet->getStyle('A' . $fila . ':I' . $fila)->getAlignment()->setWrapText(true);
    $sheet->getStyle('A' . $fila . ':I' . $fila)->applyFromArray($stylesArray);
 
 
 /* --- modificacion de colores */
 
    if ($dependencia == "DIRECTIVO") {
        $sheet->getStyle('A' . $fila . ':I' . $fila)->applyFromArray($stylesArrayDirectivo);
    } else if ($dependencia == "DOCENTE") {
        $sheet->getStyle('A' . $fila . ':I' . $fila)->applyFromArray($stylesArrayDocente);
    } else if ($dependencia == "ADMINISTRATIVO") {
        $sheet->getStyle('A' . $fila . ':I' . $fila)->applyFromArray($stylesArrayAdministrativo);
    } else if ($dependencia == "SERVICIOS GENERALES") {
        $sheet->getStyle('A' . $fila . ':I' . $fila)->applyFromArray($stylesArraySG);
    } else if ($dependencia == "FUNCIONARIO CAFETERÍA") {
        $sheet->getStyle('A' . $fila . ':I' . $fila)->applyFromArray($stylesArrayFC);
    } else if ($dependencia == "MENSAJERÍA") {
        $sheet->getStyle('A' . $fila . ':I' . $fila)->applyFromArray($stylesArrayMensajeria);
    } else if ($dependencia == "FUNCIONARIO EXTERNO") {
        $sheet->getStyle('A' . $fila . ':I' . $fila)->applyFromArray($stylesArrayFE);
    } else if ($dependencia == "SEGURIDAD") {
        $sheet->getStyle('A' . $fila . ':I' . $fila)->applyFromArray($stylesArraySeguridad);
    }
    
    
    /*Nueva linea agregada
    if ($dependencia == "DOCENTE" || $dependencia != "DOCENTE") {
        $sheet->getStyle('A' . $fila . ':I' . $fila)->applyFromArray($stylesArrayDocente);
    }*/

    if ($status == '4') {

        $sheet->getStyle('A' . $fila . ':I' . $fila)->applyFromArray($stylesArrayNovedad);
    } else {

        if ($status == '2' || $status == '3') {

            $sheet->getStyle('A' . $fila . ':I' . $fila)->applyFromArray($stylesArrayNovedad);

            if ($dependencia == "DOCENTE" || $direccion == "ENFERMERA") {

                if ($hid > $hli) {
                    $sheet->getStyle('F' . $fila)->applyFromArray($stylesArrayFalta);
                }

                if ($hsd < $hstl || $hsd > $hls) {
                    $sheet->getStyle('G' . $fila)->applyFromArray($stylesArrayFalta);
                }
            }
            if ($dependencia == "SERVICIOS GENERALES" && $nombre != "ADRIANA SILVA") {

                if ($hid > $hlisg) {
                    $sheet->getStyle('F' . $fila)->applyFromArray($stylesArrayFalta);
                }
            }

            if ($dependencia == "SERVICIOS GENERALES" && $nombre == "ADRIANA SILVA") {

                if ($hid > $hlisgc) {
                    $sheet->getStyle('F' . $fila)->applyFromArray($stylesArrayFalta);
                }
            }
        } else {

            if ($dependencia == "DOCENTE" || $direccion == "ENFERMERA") {

                if ($hid > $hli) {
                    $sheet->getStyle('F' . $fila)->applyFromArray($stylesArrayFalta);
                }

                if ($hsd < $hstl || $hsd > $hls) {
                    $sheet->getStyle('G' . $fila)->applyFromArray($stylesArrayFalta);
                }
            }
            if ($dependencia == "SERVICIOS GENERALES" && $nombre != "ADRIANA SILVA") {

                if ($hid > $hlisg) {
                    $sheet->getStyle('F' . $fila)->applyFromArray($stylesArrayFalta);
                }
            }

            if ($dependencia == "SERVICIOS GENERALES" && $nombre == "ADRIANA SILVA") {

                if ($hid > $hlisgc) {
                    $sheet->getStyle('F' . $fila)->applyFromArray($stylesArrayFalta);
                }
            }
        }
    }

    return $sheet;
}