<?php
/**
 * Created by PhpStorm.
 * User: nztr
 * Date: 19/1/2018
 * Time: 14:48
 */
include "../conexion/conexion.php";
include "PHPExcel/Classes/PHPExcel.php";
if (isset($_GET['fecha_ini']) and isset($_GET['fecha_fin'])) {
    $fecha1 = $_GET['fecha_ini'];
    $fecha2 = $_GET['fecha_fin'];

    $query = "DECLARE @fechaInicio date
                DECLARE @fechaFinal date
                
                SET @fechaInicio='$fecha1'
                SET @fechaFinal='$fecha2'
                
                SELECT 
                sp.Nombre as [Supervisor],
                ai.id_usuario as IDRuta,
                us.us_nombre as Ruta,
                us.us_nombre_real as Nombre,
                ai.fecha as Fecha,
                ai.asistencia Asistencia,
                mv.motivo as Motivo
                FROM asistencia ai
                LEFT JOIN usuario us on us.Id_usuario =  ai.id_usuario
                LEFT JOIN motivo mv on mv.id_motivo = ai.id_motivo
                LEFT JOIN supervisor sp on sp.Ruta = us.dni
                WHERE fecha BETWEEN @fechaInicio and @fechaFinal
                ORDER BY ai.fecha ASC, us.dni ASC";
} else {
    die("No para.");
}
$result = odbc_exec($conexion, $query);
odbc_next_result($result);
odbc_next_result($result);
//<editor-fold desc="Init Excel">
// Objeto PHP Excel
$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
// Propiedades
$objPHPExcel->getProperties()->setCreator("Nestor Pérez")
    ->setLastModifiedBy("Nestor Pérez")
    ->setTitle("Reporte Asistencia")
    ->setSubject("Office 2007 XLSX")
    ->setDescription("Generated using PHP classes.")
    ->setKeywords("office 2007")
    ->setCategory("Excel File");
$activeSheet = $objPHPExcel->getActiveSheet();
//</editor-fold>
$fila_inicio = 8;
$fila = $fila_inicio;      //Fila de inicio
//<editor-fold desc="Encabezado">
$objPHPExcel->getActiveSheet()
    ->setCellValue("B3", "PromoTécnicas y Ventas S.A. de C.V.");
$objPHPExcel->getActiveSheet()
    ->setCellValue("B4", "Numero de encuestas por SD");
//</editor-fold>

//<editor-fold desc="Encabezados">
$objPHPExcel->getActiveSheet()
    ->setCellValue("B" . $fila, "Supervisor")
    ->setCellValue("C" . $fila, "ID-Ruta")
    ->setCellValue("D" . $fila, "Ruta")
    ->setCellValue("E" . $fila, "Nombre")
    ->setCellValue("F" . $fila, "Fecha")
    ->setCellValue("G" . $fila, "Asistencia")
    ->setCellValue("H" . $fila, "Motivo");
$columna = PHPExcel_Cell::columnIndexFromString('H'); //Devuelve el numero de columna de esa letra
//</editor-fold>

//<editor-fold desc="Color verde en titulos">
for ($i = 1; $i < $columna; $i++) {
    $letra = PHPExcel_Cell::stringFromColumnIndex($i);
    $objPHPExcel->getActiveSheet()
        ->getStyle("$letra$fila")
        ->applyFromArray(array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'D8E4BC')
                )
            )
        );
}
//</editor-fold>

//<editor-fold desc="Auto dimensiones">
$letra = PHPExcel_Cell::stringFromColumnIndex($columna);
for ($i = 0; $i < $columna; $i++) {
    $letra = PHPExcel_Cell::stringFromColumnIndex($i);
    $objPHPExcel->getActiveSheet()->getColumnDimension($letra)->setAutoSize(true);
}
//</editor-fold>

//<editor-fold desc="Bordes estaticos">
//Borde Azul
$objPHPExcel->getActiveSheet()->getStyle('A' . ($fila - 3) . ':' . $letra . ($fila - 3))->applyFromArray(
    array('borders' =>
        array('bottom' =>
            array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' =>
                array('rgb' => '4A7EBB'),
            ),
        ),
    )
);
//Borde negro
$objPHPExcel->getActiveSheet()->getStyle('A' . $fila . ':' . $letra . $fila)->applyFromArray(array(
    'borders' => array(
        'outline' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
));
//</editor-fold>

//<editor-fold desc="Estilo fuente de titulos">
//Texto centrado de toda la informacion
$objPHPExcel->getActiveSheet()->getStyle('A' . ($fila_inicio) . ':' . $letra . $fila)->applyFromArray(
    array('alignment' =>
        array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER),
        array('vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER))
);

//Estilo de fuente de los titulos.
$objPHPExcel->getActiveSheet()->getStyle('A' . ($fila_inicio) . ':' . $letra . $fila_inicio)->applyFromArray(
    array(
        'font' => array(
            'bold' => true,
            'size' => 12
        ))
);
//</editor-fold>
if ($result == false) {
    die("Error en SQL");
}

while (odbc_fetch_row($result)) {
    $fila++;
    $columna1 = 1;  //Columna de inicio 'B'

    //<editor-fold desc="Usuario SD">
    $letra = PHPExcel_Cell::stringFromColumnIndex($columna1);
    $activeSheet->setCellValue("$letra$fila", odbc_result($result, "Supervisor"));
    $columna1++;
    //</editor-fold>

    //<editor-fold desc="Nombre">
    $letra = PHPExcel_Cell::stringFromColumnIndex($columna1);
    $activeSheet->setCellValue("$letra$fila", odbc_result($result, "IDRuta"));
    $columna1++;
    //</editor-fold>

    //<editor-fold desc="Fecha de ingreso">
    $letra = PHPExcel_Cell::stringFromColumnIndex($columna1);
    $activeSheet->setCellValue("$letra$fila", odbc_result($result, "Ruta"));
    $columna1++;
    //</editor-fold>

    //<editor-fold desc="Fecha de ingreso">
    $letra = PHPExcel_Cell::stringFromColumnIndex($columna1);
    $activeSheet->setCellValue("$letra$fila", utf8_encode(odbc_result($result, "Nombre")));
    $columna1++;
    //</editor-fold>

    //<editor-fold desc="Fecha de ingreso">
    $letra = PHPExcel_Cell::stringFromColumnIndex($columna1);
    $activeSheet->setCellValue("$letra$fila", odbc_result($result, "Fecha"));
    $columna1++;
    //</editor-fold>

    //<editor-fold desc="Fecha de ingreso">
    $letra = PHPExcel_Cell::stringFromColumnIndex($columna1);
    $activeSheet->setCellValue("$letra$fila", odbc_result($result, "Asistencia"));
    $columna1++;
    //</editor-fold>

    //<editor-fold desc="Motivo">
    $letra = PHPExcel_Cell::stringFromColumnIndex($columna1);
    $activeSheet->setCellValue("$letra$fila", odbc_result($result, "Motivo"));
    $columna1++;
    //</editor-fold>
}

//<editor-fold desc="Centrar texto">
$objPHPExcel->getDefaultStyle()
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getDefaultStyle()
    ->getAlignment()
    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
//</editor-fold>

//<editor-fold desc="Guardar y descargar">
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Reporte de asistencia');
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Reporte asistencia.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
//</editor-fold>
?>