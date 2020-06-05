<?php
include "../conexion/conexion.php";
include "../conexion/metodos/metodos1.php";
include "../funciones/consultaKua.php";


//obtener el max numero de filas de los productos
$max_fila=0;
$sql     ="SELECT Id_marca, count(Id_marca) contador FROM producto group by Id_marca";
$sql     =odbc_exec($conexion, $sql);
while ($row=odbc_fetch_array($sql))
{
    if ($max_fila<$row['contador'])
    {
        $max_fila=$row['contador'];
    }
}
$max_fila=59; // $max_fila - 1;

//Obtener nombre de las marcas
$nom_marcas=array();
$sql       ="SELECT ma_nommarca from marca order by Id_marca asc";
$sql       =odbc_exec($conexion, $sql);
while ($row=odbc_fetch_array($sql))
{
    $nom_marcas[]=$row['ma_nommarca'];
}

//Obtener incidencias del producto
$incidencia=array();
$sql       ="SELECT incidencia from incidencias_producto order by id asc";
$sql       =odbc_exec($conexion, $sql);
while ($row=odbc_fetch_array($sql))
{
    $incidencia[]=$row['incidencia'];
}


error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
//ini_set('max_input_time', 3000);
ini_set('max_execution_time', 3000);
ini_set('memory_limit', '1024M');
//set_time_limit(30);
//ini_set('memory_limit', '2024M');


function SaveViaTempFile($objWriter)
{
    $filePath=sys_get_temp_dir() . "/" . rand(0, getrandmax()) . rand(0, getrandmax()) . ".tmp";
    $objWriter->save($filePath);
    readfile($filePath);
    unlink($filePath);
}

date_default_timezone_set('America/Mexico_City');

if (PHP_SAPI=='cli')
    die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '../exel/Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel=new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("")->setLastModifiedBy("")->setTitle("Office 2007 XLSX Test Document")->setSubject("Office 2007 XLSX Test Document")->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")->setKeywords("office 2007 openxml php")->setCategory("Test result file");


//Logo

//Titulo

//--Width Column
//Estilo
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(30);

//COLOREAR BORDER LINEA NEGRA bottom
$bordenegro2=array(
    'borders'=>array(
        'top'=>array(
            'style'=>PHPExcel_Style_Border::BORDER_THIN,
            'color'=>array(
                'rgb'=>'000000'
            )
        )
    )
);

//COLOREAR BORDER LINEA NEGRA bottom
$bordenegro=array(
    'borders'=>array(
        'bottom'=>array(
            'style'=>PHPExcel_Style_Border::BORDER_THIN,
            'color'=>array(
                'rgb'=>'000000'
            )
        )
    )
);

//Lista de ejecucion
$eje=array(
    4=>"Emplayes",
    1=>"Sin producto",
    2=>"No atendí"
);

//Tabla
$letra =1;
$titulo=array(
    "",
    "Región",
    "Mes",
    "Plaza",
    "Semana",
    "Tipo de cadena",
    "Cadena",
    "Sucursal",
    "Operador",
    "Día",
    "Objetivo Emplayes por Tienda",
    "Total Emplayes Realizados",
    "Emplayes Realizados E1",
    "Estrategia 1",
    "Emplayes Realizados E2",
    "Estrategia 2",
    "Emplayes Realizados E3",
    "Estrategia 3",
    "Emplayes Realizados E4",
    "Estrategia 4",
    "Emplayes Realizados E5",
    "Estrategia 5",
    "Emplayes Realizados E6",
    "Estrategia 6",
    "Emplayes Realizados E7",
    "Estrategia 7",
    "Emplayes Realizados E8",
    "Estrategia 8",
    "Emplayes Realizados E9",
    "Estrategia 9",
    "Emplayes Realizados E10",
    "Estrategia 10"
);

for ($i=1; $i<count($titulo); $i++)
{
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue(letra($i) . '1', $titulo[$i]);
    $letra++;
}
$styleArray = array(
  'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
  )
);



$objPHPExcel->getActiveSheet()->getStyle('A:AE')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('A1:AE1')->applyFromArray($bordenegro);
$objPHPExcel->getActiveSheet()->getStyle('A1:AE1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A1:AE1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1:AE1')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('A1:AE1')->getFill()->applyFromArray(array(
    
    'type'=>PHPExcel_Style_Fill::FILL_SOLID,
    'startcolor'=>array(
        'rgb'=>'D8E4BC'
    )
));
$objPHPExcel->getActiveSheet()->getStyle('A1:AE1')->applyFromArray($styleArray);
unset($styleArray);



//Obtener informaciones de actividadespersefone nostra morte 
$day   =array(
    1=>"Lunes",
    2=>"Martes",
    3=>"Miercoles",
    4=>"Jueves",
    5=>"Viernes",
    6=>"Sabado",
    7=>"Domingo"
);
$ehx   =array(
    0=>"No",
    1=>"Si"
);
$dia   =getDia($fecha);
$json  =reporteproductosvisitas($fecha, $fecha_fin, $conexion, $dia);
$ban   =false;
$igual1="primer";

$fila=2;

for ($i=0; $i<count($json); $i++)
{
    if (!empty($json[$i]['salida'])&&($json[$i]['determinante']==$txtcadena||$txtcadena==""))
    {
        
        if ($igual1!=$json[$i]['nombre'])
        {
            $igual1=$json[$i]['nombre'];
            $ban   =false;       
        }
        
        if (!empty($json[$i]['salida'])and$ban==true)
        {
            //calcular traslado
            $h_traslado="=R" . ($fila) . "-S" . ($fila-1);
        }
        else
        {
            $h_traslado="";
            $ban       =true;
        }       
        
        $fila2=$fila;
        
        $comcad=$json[$i]['determinante'];
        
        if ($comcad!='Cedis')
        {
            for ($a=0; $a<60; $a++)
            {
                $fecha_fort =date("Ymd", strtotime($json[$i]['fecha']));
                $fecha_fort2=date("d/m/Y", strtotime($json[$i]['fecha']));
                $visit_day  =$day[date("N", strtotime($json[$i]['fecha']))];
                
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $fila2, $json[$i]['area'])->setCellValue('B' . $fila2, $json[$i]['mes']) //$json[$i]['ruta'])
                    ->setCellValue('C' . $fila2, $json[$i]['ciudad'])->setCellValue('D' . $fila2, $json[$i]['semana']) //$json[$i]['nombre'])
                    ->setCellValue('E' . $fila2, 'Nacional') //$json[$i]['nombre_real'])
                    ->setCellValue('F' . $fila2, $json[$i]['determinante']) //$json[$i]['supervisor1'])
                    ->setCellValue('G' . $fila2, $json[$i]['nombre_cliente']) //$json[$i]['ciudad'])
                    ->setCellValue('H' . $fila2, $json[$i]['nombre_real'])->setCellValue('I' . $fila2, $fecha_fort2); //$json[$i]['Id_cliente'])
                
                
                //Formato hora
                $objPHPExcel->getActiveSheet()->getStyle('Q' . $fila2)->getNumberFormat()->setFormatCode('hh:mm:ss');
                $fila2++;
            }
        }
             
        //Obtener producto
        $json_p = inventarios($json[$i]['Id_cliente'], $json[$i]['ruta'], $json[$i]['fecha']); //id_cliente, id_usuario, fecha
        //$json_p = utf8_decode($json_p);
        $datos  =json_decode($json_p, true);
        //echo json_encode($datos,JSON_PRETTY_PRINT);
        $fila1  =$fila;
        $igual  ="primero";
        $letra  =27;
        $columna=2;
        $piezas ="";
        
        if (!empty($datos['inventario']))
        {
            if (count($datos['inventario'])>0)
            {
                $pases=0;
                foreach ($datos['inventario'] as $key=>$value)
                {
                    if ($datos['inventario'][$key]['razon']==4)
                    {     
                        $igual=$datos['inventario'][$key]['id_marca'];
                        $fila1=$fila;
                        if ($igual==1)
                        {
                            $letra++;
                        }
                        else
                        {
                            $letra=$letra+18; //-15 original 18
                        }
                        $piezas="";
                        $exh   =0;
                        if ($datos['inventario'][$key]['bodega']==0&&$datos['inventario'][$key]['piso1']==0)
                        {
                            
                        }
                        else
                        {
                            $objPHPExcel->setActiveSheetIndex(0)
							
							//escribe los resultados verdaderos
							//->setCellValue(letra($letra-2).$fila1, $eje[$datos['inventario'][$key]['razon']])
                                ->setCellValue('K' . $fila1, $datos['inventario'][$key]['id_marca'])->setCellValue('Y' . $fila1, '')
                            //->setCellValue('L'.$fila1, $datos['inventario'][$key]['codigobarras'])
                                ->setCellValue('Z' . $fila1, '')
                            //->setCellValue('P'.$fila1, '1')
                                ->setCellValue('AA' . $fila1, '')->setCellValue('M' . $fila1, $datos['inventario'][$key]['pr_nomproducto'])->setCellValue('AB' . $fila1, '')
                            //->setCellValue('N'.$fila1, $datos['inventario'][$key]['piso1'])
                                ->setCellValue('AC' . $fila1, '')->setCellValue('j' . $fila1, $datos['inventario'][$key]['objetivo'])->setCellValue('L' . $fila1, $datos['inventario'][$key]['bodega']);
                            
                        } 
                        //Formato hora
                        
                        $objPHPExcel->getActiveSheet()->getStyle(letra($letra) . $fila1)->getNumberFormat()->setFormatCode('0');
                        $fila++;
                    }
                    else if ($datos['inventario'][$key]['razon']==-1)
                    {
                        $letra++;
                        $fila1=$fila;
                        
                        $fila2=$fila1;
                        for ($a=0; $a<$max_fila+1; $a++)
                        {
                            
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M' . $fila2, "Sin Packs")->setCellValue('O' . $fila2, "Salio sin ejecucion")->setCellValue('X' . $fila2, "");
                            $fila2++;
                            break;
                        }
                        $fila++;
                    }
                }
            }
        }
        //Siguiente fila
        $fila++; 
    }
}

$objWorksheet=$objPHPExcel->getActiveSheet();
$highestRow  =$objWorksheet->getHighestRow();


    

for ($rowd=$highestRow; $rowd>=2; $rowd--)
{
	
    $valueA=$objPHPExcel->getActiveSheet()->getCell('X' . $rowd)->getValue();
    $valueB=$objPHPExcel->getActiveSheet()->getCell('Y' . $rowd)->getValue();
    $valueC=$objPHPExcel->getActiveSheet()->getCell('Z' . $rowd)->getValue();
    if ($valueB===NULL&&$valueA===NULL)
    {
        $objPHPExcel->getActiveSheet()->removeRow($rowd);
    }
    else if ($valueB!==NULL&&$valueC===NULL)
    {
        $objPHPExcel->getActiveSheet()->removeRow($rowd);
    }
}
//////////sumar cadenas//////////////

for ($rowd=$highestRow; $rowd>=2; $rowd--)
{
    $ciudadA =$objPHPExcel->getActiveSheet()->getCell('C' . $rowd)->getValue();  //plaza
    $ciudadB =$objPHPExcel->getActiveSheet()->getCell('C' . ($rowd-1))->getValue(); //plaza
    $valueA =$objPHPExcel->getActiveSheet()->getCell('G' . $rowd)->getValue();  //sucursal
    $valueB =$objPHPExcel->getActiveSheet()->getCell('G' . ($rowd-1))->getValue();  //sucursal
    $packA  =$objPHPExcel->getActiveSheet()->getCell('K' . $rowd)->getValue();
    $packB  =$objPHPExcel->getActiveSheet()->getCell('K' . ($rowd-1))->getValue();
    $operadorA=$objPHPExcel->getActiveSheet()->getCell('H' . $rowd)->getValue();
    $operadorB=$objPHPExcel->getActiveSheet()->getCell('H' . ($rowd-1))->getValue();
	
	    
	$piezas1=0;
    $piezas2=0;
    if ($valueA===$valueB&&$packA===$packB&&$operadorA===$operadorB&&$ciudadA===$ciudadB)
	{
        if ($objPHPExcel->getActiveSheet()->getCell('M' . $rowd)->getValue()!=null)
        {
            $nombre1=$objPHPExcel->getActiveSheet()->getCell('M' . $rowd)->getValue();
            $nombre2=$objPHPExcel->getActiveSheet()->getCell('M' . ($rowd-1))->getValue();
            $piezas1=$objPHPExcel->getActiveSheet()->getCell('L' . $rowd)->getValue();
            $piezas2=$objPHPExcel->getActiveSheet()->getCell('L' . ($rowd-1))->getValue();
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M' . ($rowd-1), $nombre1 . " + " . $nombre2);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L' . ($rowd-1), $piezas1 + $piezas2 );
            $objPHPExcel->getActiveSheet()->removeRow($rowd);
						
        }
        
    }
}
$highestRow=$objWorksheet->getHighestRow();
//////asignar marcas a sus lotes//////
for ($rowd=$highestRow; $rowd>=2; $rowd--)
{
    $ciudadA =$objPHPExcel->getActiveSheet()->getCell('C' . $rowd)->getValue();
    $ciudadB =$objPHPExcel->getActiveSheet()->getCell('C' . ($rowd-1))->getValue();
    $sucursalA=$objPHPExcel->getActiveSheet()->getCell('G' . $rowd)->getValue();
    $sucursalB=$objPHPExcel->getActiveSheet()->getCell('G' . ($rowd-1))->getValue();
    $operadorA=$objPHPExcel->getActiveSheet()->getCell('H' . $rowd)->getValue();
    $operadorB=$objPHPExcel->getActiveSheet()->getCell('H' . ($rowd-1))->getValue();
    if ($sucursalA===$sucursalB&&$operadorA===$operadorB&&$ciudadA===$ciudadB)
    {
        $marcaActual=$objPHPExcel->getActiveSheet()->getCell('K' . $rowd)->getValue();
        
		$cantidad   =$objPHPExcel->getActiveSheet()->getCell('L' . $rowd)->getValue();
        $nombreMarca=$objPHPExcel->getActiveSheet()->getCell('M' . $rowd)->getValue();
        if ($marcaActual==10)
        {
            $objWorksheet->setCellValue('AD' . ($rowd-9), $cantidad);
            $objWorksheet->setCellValue('AE' . ($rowd-9), $nombreMarca);
        }
        else if ($marcaActual==9)
        {
            $objWorksheet->setCellValue('AB' . ($rowd-8), $cantidad);
            $objWorksheet->setCellValue('AC' . ($rowd-8), $nombreMarca);
        }
        else if ($marcaActual==8)
        {
            $objWorksheet->setCellValue('Z' . ($rowd-7), $cantidad);
            $objWorksheet->setCellValue('AA' . ($rowd-7), $nombreMarca);
        }
        else if ($marcaActual==7)
        {
            $objWorksheet->setCellValue('X' . ($rowd-6), $cantidad);
            $objWorksheet->setCellValue('Y' . ($rowd-6), $nombreMarca);
        }
        else if ($marcaActual==6)
        {
            $objWorksheet->setCellValue('V' . ($rowd-5), $cantidad);
            $objWorksheet->setCellValue('W' . ($rowd-5), $nombreMarca);
        }
        else if ($marcaActual==5)
        {
            $objWorksheet->setCellValue('T' . ($rowd-4), $cantidad);
            $objWorksheet->setCellValue('U' . ($rowd-4), $nombreMarca);
        }
        else if ($marcaActual==4)
        {
            $objWorksheet->setCellValue('R' . ($rowd-3), $cantidad);
            $objWorksheet->setCellValue('S' . ($rowd-3), $nombreMarca);
        }
        else if ($marcaActual==3)
        {
            $objWorksheet->setCellValue('P' . ($rowd-2), $cantidad);
            $objWorksheet->setCellValue('Q' . ($rowd-2), $nombreMarca);
        }
        else if ($marcaActual==2)
        {
            $objWorksheet->setCellValue('N' . ($rowd-1), $cantidad);
            $objWorksheet->setCellValue('O' . ($rowd-1), $nombreMarca);
        }
		else if ($marcaActual==1)
        {
            $objWorksheet->setCellValue('L' . ($rowd), $cantidad);
            $objWorksheet->setCellValue('M' . ($rowd), $nombreMarca);
        }
        $objWorksheet->removeRow($rowd);
    }
}
$highestRow=$objWorksheet->getHighestRow();
for ($rowd=$highestRow; $rowd>=2; $rowd--)
{
    $val1 =$objPHPExcel->getActiveSheet()->getCell('L' . $rowd)->getValue()==null ? 0 : $objPHPExcel->getActiveSheet()->getCell('L' . $rowd)->getValue();
    $val2 =$objPHPExcel->getActiveSheet()->getCell('N' . $rowd)->getValue()==null ? 0 : $objPHPExcel->getActiveSheet()->getCell('N' . $rowd)->getValue();
    $val3 =$objPHPExcel->getActiveSheet()->getCell('P' . $rowd)->getValue()==null ? 0 : $objPHPExcel->getActiveSheet()->getCell('P' . $rowd)->getValue();
    $val4 =$objPHPExcel->getActiveSheet()->getCell('R' . $rowd)->getValue()==null ? 0 : $objPHPExcel->getActiveSheet()->getCell('R' . $rowd)->getValue();
    $val5 =$objPHPExcel->getActiveSheet()->getCell('T' . $rowd)->getValue()==null ? 0 : $objPHPExcel->getActiveSheet()->getCell('T' . $rowd)->getValue();
    $val6 =$objPHPExcel->getActiveSheet()->getCell('V' . $rowd)->getValue()==null ? 0 : $objPHPExcel->getActiveSheet()->getCell('V' . $rowd)->getValue();
    $val7 =$objPHPExcel->getActiveSheet()->getCell('X' . $rowd)->getValue()==null ? 0 : $objPHPExcel->getActiveSheet()->getCell('X' . $rowd)->getValue();
    $val8 =$objPHPExcel->getActiveSheet()->getCell('Z' . $rowd)->getValue()==null ? 0 : $objPHPExcel->getActiveSheet()->getCell('Z' . $rowd)->getValue();
    $val9 =$objPHPExcel->getActiveSheet()->getCell('AB' . $rowd)->getValue()==null ? 0 : $objPHPExcel->getActiveSheet()->getCell('AB' . $rowd)->getValue();
    $val10=$objPHPExcel->getActiveSheet()->getCell('AD' . $rowd)->getValue()==null ? 0 : $objPHPExcel->getActiveSheet()->getCell('AD' . $rowd)->getValue();
    //echo $val1.'-'.$val2.'-'.$val3.'-'.$val4.'-'.$val5.'-'.$val6.'-'.$val7.'-'.$val8.'-'.$val9.'-'.$val10.'fin';
    $valor=$val1+$val2+$val3+$val4+$val5+$val6+$val7+$val8+$val9+$val10;
    
	$objWorksheet->setCellValue('K' . $rowd, $valor);
}
$highestRow=$objWorksheet->getHighestRow();
for ($rowd=$highestRow; $rowd>=2; $rowd--)
{
    $valueA=$objPHPExcel->getActiveSheet()->getCell('A' . $rowd)->getValue();
    $valueB=$objPHPExcel->getActiveSheet()->getCell('B' . $rowd)->getValue();
    $valueC=$objPHPExcel->getActiveSheet()->getCell('C' . $rowd)->getValue();
    if ($valueB===NULL&&$valueA===NULL)
    {
        $objPHPExcel->getActiveSheet()->removeRow($rowd);
    }
    else if ($valueB!==NULL&&$valueC===NULL)
    {
        $objPHPExcel->getActiveSheet()->removeRow($rowd);
    }
}

for ($rowd=$highestRow; $rowd>=2; $rowd--)
{
    $styleArray = array(
        'borders' => array(
          'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
          )
        )
    );
    $valueA=$objPHPExcel->getActiveSheet()->getCell('A' . $rowd)->getValue();
    if($valueA!=null)
    {
        $objPHPExcel->getActiveSheet()->getStyle('A'.($rowd).':AE'.($rowd))->applyFromArray($styleArray);
        unset($styleArray);
    }
    
}

$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(100);
$objPHPExcel->getActiveSheet()->getStyle('M2:AE100')->getAlignment()->setWrapText(true);

//Eliminar lineas
$objPHPExcel->getActiveSheet()->setShowGridlines(false);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Layout sin fotos');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Layout sin fotos.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$objWriter=new PHPExcel_Writer_Excel2007($objPHPExcel);
//$objWriter->save('php://output');
SaveViaTempFile($objWriter)
//exit;
    ;
?>