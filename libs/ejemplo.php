<?php
/**
 * Created by PhpStorm.
 * User: nztr
 * Date: 19/1/2018
 * Time: 14:48
 */

include "PHPExcel/Classes/PHPExcel.php";

$result = odbc_exec($conexion, $query);
odbc_next_result($result);
odbc_next_result($result);
//<editor-fold desc="Init Excel">
// Objeto PHP Excel
$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
// Propiedades
$objPHPExcel->getProperties()->setCreator("Raul Martinez")
    ->setLastModifiedBy("Raul Martinez")
    ->setTitle("Documento de Excel")
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
    ->setCellValue("B" . 1, "Supervisor")
    ->setCellValue("C" . 1, "ID-Ruta");

    $objPHPExcel->getActiveSheet()
    ->setCellValue("B" . 2, "Supervisor")
    ->setCellValue("C" . 2, "ID-Ruta");

//$columna = PHPExcel_Cell::columnIndexFromString('H'); //Devuelve el numero de columna de esa letra

/*
Relleno de fila
$objPHPExcel->getActiveSheet()
->getStyle("A")
->applyFromArray(array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'D8E4BC')
        )
    )
);
*/

//Auto size
//$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);

//<editor-fold desc="Bordes estaticos">
//Borde Azul

/*
borde de celda A1;C1
$objPHPExcel->getActiveSheet()->getStyle('A1:C1' )->applyFromArray(
    array('borders' =>
        array('bottom' =>
            array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' =>
                array('rgb' => '4A7EBB'),
            ),
        ),
    )
);
*/
//Borde negro
/*
$objPHPExcel->getActiveSheet()->getStyle('A' . $fila . ':' . $letra . $fila)->applyFromArray(array(
    'borders' => array(
        'outline' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
));
*/

//Texto centrado de toda la informacion
/*
$objPHPExcel->getActiveSheet()->getStyle('A' . ($fila_inicio) . ':' . $letra . $fila)->applyFromArray(
    array('alignment' =>
        array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER),
        array('vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER))
);
*/
//Estilo de fuente de los titulos.
/*$objPHPExcel->getActiveSheet()->getStyle('A1:C1')->applyFromArray(
    array(
        'font' => array(
            'bold' => true,
            'size' => 12
        ))
);*/



//Centrar texto
$objPHPExcel->getDefaultStyle()
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getDefaultStyle()
    ->getAlignment()
    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Documento excel');
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Documento excel.xls"');
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