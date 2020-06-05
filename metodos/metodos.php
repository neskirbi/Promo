<?php
date_default_timezone_set('America/Mexico_City');

ini_set('max_execution_time', 300);

function dias(){
  $_dias=array (1 => "cl_L",2 => "cl_M",3 => "cl_W",4 => "cl_J",5 => "cl_V",6 => "cl_S",7 => "cl_D");
  return $_dias;
}

function dias_sem(){
  $_dias=array (1 => "Lunes",2 => "Martes",3 => "Miercoles",4 => "Jueves",5 => "Viernes",6 => "Sabado",7 => "Domingo");
  return $_dias;
}


function meses(){
  $_meses=array (1 => "Enero",2 => "Febrero",3 => "Marzo",4 => "Abril",5 => "Mayo",6 => "Junio",7 => "Julio",8 => "Agosto",9 => "Septiembre",10 => "Octubre",11 => "Noviembre",12 => "Diciembre");
  return $_meses;
}
//include("grafica.php");
//devuleve el dia de la semana que es el la fecha 
function dia_hoy($fecha){

  $fechd=date("N",strtotime ( $fecha ) );
  $_dias=dias();
  
  return $_dias[$fechd];
}

function dia_hoy2($fecha){

  $fechd=date("N",strtotime ( $fecha ) );
  $_dias=dias_sem();
  
  return $_dias[$fechd];
}

//formateafecha 
function formateafecha($fecha)
{
 $_dias=dias_sem ();

$_meses=array (1 => "Enero",2 => "Febrero",3 => "Marzo",4 => "Abril",5 => "Mayo",6 => "Junio",7 => "Julio",8 => "Agosto",9 => "Septiembre",10 => "Octubre",11 => "Noviembre",12 => "Diciembre");

$fechd=date("N", strtotime($fecha)); 
$fechdi=date("d", strtotime($fecha));
$fechm=date("n", strtotime($fecha)); 
$fechaa=date("Y", strtotime($fecha)); 


//Formatenado fecha de consulata
$fechaactvidad[0]=$_dias[$fechd];
$fechaactvidad[1]=$fechdi;
$fechaactvidad[2]=$_meses[$fechm];
$fechaactvidad[3]=$fechaa;
$fecha=array();


$fecha[]=$fechaactvidad[0]." ".$fechaactvidad[1]." de ".$fechaactvidad[2]." del ".$fechaactvidad[3];
$fecha[]=$_dias[$fechd];
return $fecha;
}


//muestra descanso 
function muestradesc($fecha1,$id,$conexion)
{
  //include("../conexion/conexion.php");
  $_dias=dias();
  $falta=array();
  $_hoy=dia_hoy($fecha1);
  $fechaydia=formateafecha($fecha1);
  $desc = "SELECT  count(Id_ruta) as des from  cliente where  Id_ruta='$id' and $_hoy=1  ";
  $desc = odbc_exec($conexion, $desc);
  $desc = odbc_fetch_object($desc);


  //$fechaydia[]=$desc->des;
  if ($desc->des==0) {
    $falta[1][1]="Descanso";
  }else{

  $falta[1][1]= "Trabaj&oacute; sin aplicaci&oacute;n";  
  }

  $falta[1][0]=$fechaydia[0];

   
  return  $falta;

 
}
//devuelve un arrglo con los dias de la semana 

//devuelve las tiendas fuera de ruta por promotor
function Tiendafuerar($nombre,$fecha,$conexion){
  $fechahoy=$fecha;
  //include("../../conexion/conexion.php");
  //include "../../app/gapp1.php";
  $_dias=dias();

$_meses=meses();
  $usu=$nombre;
$fecha=$fechahoy;
$fecha;


  
  $fechd=date("N",strtotime ( $fecha ) );
  $fechdi=date("d", strtotime ( $fecha ) );
  $fechm=date("n",strtotime ( $fecha ));
  $fechaa=date("Y",strtotime ( $fecha ));
        
   $existe =0;     
    
$sql="SELECT Nombre from supervisor where Nombre='$nombre'";
$sql=odbc_exec($conexion, $sql);
$existe=odbc_num_rows($sql);
    
$contvueltas=0;

$llena=0;
$cont=1;
$conteje=100;
$totalger=array();
if ($existe==0) {
  $eje = "SELECT distinct Ejecutivo FROM Supervisor where Nombre='$nombre' or Ejecutivo='$nombre' or Gerencia='$nombre' or Monitoreo='$nombre'  order by Ejecutivo asc ";
}else{
   $eje = "SELECT distinct Nombre FROM Supervisor where Nombre='$nombre' or Ejecutivo='$nombre' or Gerencia='$nombre' or Monitoreo='$nombre'  order by Nombre asc ";
}


$eje = odbc_exec($conexion, $eje);
while($eje2 = odbc_fetch_object($eje))
{
$total=array();
$totalti=array();
$parti=array();
$tienfu=array();


if ($existe==0) {
  $sqlnom2 ="SELECT  *  FROM Supervisor WHERE  Ejecutivo='$eje2->Ejecutivo' order by Ruta asc ";
}else{
   $sqlnom2 ="SELECT  *  FROM Supervisor WHERE  Nombre='$eje2->Nombre' order by Ruta asc ";
}



$sqlnom2 = odbc_exec($conexion, $sqlnom2);
while ($rowus2 = odbc_fetch_object($sqlnom2))
{ 
  

            $comentarios=array();
       
            
          
            $sqlnom ="SELECT  *  FROM usuario WHERE dni='$rowus2->Ruta' and acceso='2' order by idusuario asc ";
            $idnom = odbc_exec($conexion, $sqlnom);
            while ($rowus = odbc_fetch_object($idnom))
            {   
                
                $nuevafecha=0;  
                $fechasum=$fecha;
                $dia=$fechd;

                
                //consultar clientes en ruta por dia
                $objdia = "SELECT idcliente as objdia FROM cliente WHERE $_dias[$dia]=1 and RutaVenta='$rowus->idusuario'";
                $objdia = odbc_exec($conexion, $objdia);
                $objetivos=array();
                while ($objdiat = odbc_fetch_object($objdia)) 
                {
                    $objetivos[]=$objdiat->objdia;
                }                     
                
                $inci= "SELECT ruta,comentario FROM incidencia WHERE fecha='$fechasum' and ruta='$rowus->idusuario'";
                $inci = odbc_exec($conexion, $inci);
                $inci1 = odbc_fetch_object($inci);
                $inci = odbc_num_rows($inci);

                
                if ($inci==0 or $inci1->comentario=="") {
                  $_ttiendas[]=count($objetivos);
                }else
                {
                  $_ttiendas[]=0;
                  
                  $comentarios['coment'][]=$inci1->comentario;

                  $incinom= "SELECT nombre FROM usuario WHERE idusuario='$inci1->ruta'";
                  $incinom = odbc_exec($conexion, $incinom);
                  $incinom1 = odbc_fetch_object($incinom);
                  $incinom = odbc_num_rows($incinom);
                                  
                  if ($incinom != 0) {
                    $comentarios['promo'][] = $incinom1->nombre;
                  }
                }

                

               if (count($objetivos)!=0) 
               {
                    //consultar visitas del dia 
                    $clirut = "SELECT  idcliente as id  from  actividad where FechaVisita='$fechasum' and idusuario='$rowus->idusuario' ";
                    $clirut = odbc_exec($conexion, $clirut);
                    $visitas=array();
                    while ($clirutt = odbc_fetch_object($clirut)) 
                        {
                            $visitas[]=$clirutt->id;
                        } 
                    $visitascom=array_diff($visitas, $objetivos);
                    $_razons[] =(count($visitas)-count($visitascom));
                    $_razons1[]=count($visitas);
                    $_razons2[]=count($visitascom);

               }else 
               {
                   
                  $_razons[] =0;
                  $_razons1[]=0;
                   $_razons2[]=0;

               }

                
              
                $obj[]=array_sum($_ttiendas);
                $vis[]=array_sum($_razons);
                $vis1[]=array_sum($_razons1);
                $vis2[]=array_sum($_razons2);
                $_razons = array();
                $_razons1 = array();
                  $_razons2 = array();
                $_ttiendas=array();

            }
            
            if ( array_sum($obj)!=0)
            {
              
              $todas=round(((array_sum($vis1)/array_sum($obj) )*180),2);
              $porc=round(((array_sum($vis1)/array_sum($obj) )*100),1);
              if ($todas>180) {
                $todas=180;
               
              }
              $todas=strval((($todas)));
              $tienfu[]=array_sum($vis2);
              $totalti[]=array_sum($obj);
              $parti[]=array_sum($vis);
              


             
              $pgrafica1[1][$llena]=round(((array_sum($vis)/ array_sum($obj))*100),1);
              $total[]=$pgrafica1[1][$llena];
              

              $todas=0;
              $porc=0;
             


            }else
            {
              
              $pgrafica1[1][$llena]=0;
               $total[]=0;
              
              
            }
            

            $vis=array();
            $vis1=array();
            $vis2=array();
            $obj=array();
            $llena++;
            $cont++;
  
}

$todas=round((array_sum($tienfu)+array_sum($parti))/array_sum($totalti)*180,2);

$totpor=round((array_sum($total)/count($total)),2); 
$texto=round((array_sum($tienfu)+array_sum($parti))/array_sum($totalti)*100,2);

$texto1=array_sum($parti).' tiendas de '.array_sum($totalti).'<br><font color="#333333">'.array_sum($tienfu).' V.F.Ruta '.$texto.'%</font>';


//echo "<script>graficarapp(".$totpor.",$conteje,'".$texto1."');flecha(".($todas).",".$conteje.");</script>";
$conteje=$conteje+1;


$totalger[]=array_sum($tienfu);



}


return array_sum($totalger);
//echo "<tr><td><div id='container-speed' style='border: 1px solid #000; width: 300px; height: 200px; float: left'></div></div></td></tr>";
         
}


function Tiendas($nombre,$fecha,$conexion){
  $fechahoy=$fecha;
  //include("../../conexion/conexion.php");
  //include "../../app/gapp1.php";
  $_dias=array (1 => "cl_L",2 => "cl_M",3 => "cl_W",4 => "cl_J",5 => "cl_V",6 => "Sabado",7 => "cl_D");

$_meses=array (1 => "Enero",2 => "Febrero",3 => "Marzo",4 => "Abril",5 => "Mayo",6 => "Junio",7 => "Julio",8 => "Agosto",9 => "Septiembre",10 => "Octubre",11 => "Noviembre",12 => "Diciembre");
  $usu=$nombre;
$fecha=$fechahoy;
$fecha;


  
  $fechd=date("N",strtotime ( $fecha ) );
  $fechdi=date("d", strtotime ( $fecha ) );
  $fechm=date("n",strtotime ( $fecha ));
  $fechaa=date("Y",strtotime ( $fecha ));
        
   $existe =0;     
    
$sql="SELECT Nombre from supervisor where Nombre='$nombre'";
$sql=odbc_exec($conexion, $sql);
$existe=odbc_num_rows($sql);
    
$contvueltas=0;

$llena=0;
$cont=1;
$conteje=100;
$totalger=array();
if ($existe==0) {
  $eje = "SELECT distinct Ejecutivo FROM Supervisor where Nombre='$nombre' or Ejecutivo='$nombre' or Gerencia='$nombre' or Monitoreo='$nombre'  order by Ejecutivo asc ";
}else{
   $eje = "SELECT distinct Nombre FROM Supervisor where Nombre='$nombre' or Ejecutivo='$nombre' or Gerencia='$nombre' or Monitoreo='$nombre'  order by Nombre asc ";
}


$eje = odbc_exec($conexion, $eje);
while($eje2 = odbc_fetch_object($eje))
{
$total=array();
$totalti=array();
$parti=array();
$tienfu=array();


if ($existe==0) {
  $sqlnom2 ="SELECT  *  FROM Supervisor WHERE  Ejecutivo='$eje2->Ejecutivo' order by Ruta asc ";
}else{
   $sqlnom2 ="SELECT  *  FROM Supervisor WHERE  Nombre='$eje2->Nombre' order by Ruta asc ";
}



$sqlnom2 = odbc_exec($conexion, $sqlnom2);
while ($rowus2 = odbc_fetch_object($sqlnom2))
{ 
  

            $comentarios=array();
       
            
          
            $sqlnom ="SELECT  *  FROM usuario WHERE dni='$rowus2->Ruta' and acceso='2' order by idusuario asc ";
            $idnom = odbc_exec($conexion, $sqlnom);
            while ($rowus = odbc_fetch_object($idnom))
            {   
                
                $nuevafecha=0;  
                $fechasum=$fecha;
                $dia=$fechd;

                
                //consultar clientes en ruta por dia
                $objdia = "SELECT idcliente as objdia FROM cliente WHERE $_dias[$dia]=1 and RutaVenta='$rowus->idusuario'";
                $objdia = odbc_exec($conexion, $objdia);
                $objetivos=array();
                while ($objdiat = odbc_fetch_object($objdia)) 
                {
                    $objetivos[]=$objdiat->objdia;
                }                     
                
                $inci= "SELECT ruta,comentario FROM incidencia WHERE fecha='$fechasum' and ruta='$rowus->idusuario'";
                $inci = odbc_exec($conexion, $inci);
                $inci1 = odbc_fetch_object($inci);
                $inci = odbc_num_rows($inci);

                
                if ($inci==0 or $inci1->comentario=="") {
                  $_ttiendas[]=count($objetivos);
                }else
                {
                  $_ttiendas[]=0;
                  
                  $comentarios['coment'][]=$inci1->comentario;

                  $incinom= "SELECT nombre FROM usuario WHERE idusuario='$inci1->ruta'";
                  $incinom = odbc_exec($conexion, $incinom);
                  $incinom1 = odbc_fetch_object($incinom);
                  $incinom = odbc_num_rows($incinom);
                                  
                  if ($incinom != 0) {
                    $comentarios['promo'][] = $incinom1->nombre;
                  }
                }

                

               if (count($objetivos)!=0) 
               {
                    //consultar visitas del dia 
                    $clirut = "SELECT  idcliente as id  from  actividad where FechaVisita='$fechasum' and idusuario='$rowus->idusuario' ";
                    $clirut = odbc_exec($conexion, $clirut);
                    $visitas=array();
                    while ($clirutt = odbc_fetch_object($clirut)) 
                        {
                            $visitas[]=$clirutt->id;
                        } 
                    $visitascom=array_diff($visitas, $objetivos);
                    $_razons[] =(count($visitas)-count($visitascom));
                    $_razons1[]=count($visitas);
                    $_razons2[]=count($visitascom);

               }else 
               {
                   
                  $_razons[] =0;
                  $_razons1[]=0;
                   $_razons2[]=0;

               }

                
              
                $obj[]=array_sum($_ttiendas);
                $vis[]=array_sum($_razons);
                $vis1[]=array_sum($_razons1);
                $vis2[]=array_sum($_razons2);
                $_razons = array();
                $_razons1 = array();
                  $_razons2 = array();
                $_ttiendas=array();

            }
            
            if ( array_sum($obj)!=0)
            {
              
              $todas=round(((array_sum($vis1)/array_sum($obj) )*180),2);
              $porc=round(((array_sum($vis1)/array_sum($obj) )*100),1);
              if ($todas>180) {
                $todas=180;
               
              }
              $todas=strval((($todas)));
              $tienfu[]=array_sum($vis2);
              $totalti[]=array_sum($obj);
              $parti[]=array_sum($vis);
              


             
              $pgrafica1[1][$llena]=round(((array_sum($vis)/ array_sum($obj))*100),1);
              $total[]=$pgrafica1[1][$llena];
              

              $todas=0;
              $porc=0;
             


            }else
            {
              
              $pgrafica1[1][$llena]=0;
               $total[]=0;
              
              
            }
            

            $vis=array();
            $vis1=array();
            $vis2=array();
            $obj=array();
            $llena++;
            $cont++;
  
}

$todas=round((array_sum($tienfu)+array_sum($parti))/array_sum($totalti)*180,2);

$totpor=round((array_sum($total)/count($total)),2); 
$texto=round((array_sum($tienfu)+array_sum($parti))/array_sum($totalti)*100,2);

$texto1=array_sum($parti).' tiendas de '.array_sum($totalti).'<br><font color="#333333">'.array_sum($tienfu).' V.F.Ruta '.$texto.'%</font>';


//echo "<script>graficarapp(".$totpor.",$conteje,'".$texto1."');flecha(".($todas).",".$conteje.");</script>";
$conteje=$conteje+1;


$totalger[]=array_sum($parti);



}


return array_sum($totalger);
//echo "<tr><td><div id='container-speed' style='border: 1px solid #000; width: 300px; height: 200px; float: left'></div></div></td></tr>";
         
}

function TTiendas($nombre,$fecha,$conexion){
  $fechahoy=$fecha;
  //include("../../conexion/conexion.php");
  //include "../../app/gapp1.php";
  $_dias=array (1 => "cl_L",2 => "cl_M",3 => "cl_W",4 => "cl_J",5 => "cl_V",6 => "Sabado",7 => "cl_D");

$_meses=array (1 => "Enero",2 => "Febrero",3 => "Marzo",4 => "Abril",5 => "Mayo",6 => "Junio",7 => "Julio",8 => "Agosto",9 => "Septiembre",10 => "Octubre",11 => "Noviembre",12 => "Diciembre");
  $usu=$nombre;
$fecha=$fechahoy;
$fecha;


  
  $fechd=date("N",strtotime ( $fecha ) );
  $fechdi=date("d", strtotime ( $fecha ) );
  $fechm=date("n",strtotime ( $fecha ));
  $fechaa=date("Y",strtotime ( $fecha ));
        
   $existe =0;     
    
$sql="SELECT Nombre from supervisor where Nombre='$nombre'";
$sql=odbc_exec($conexion, $sql);
$existe=odbc_num_rows($sql);
    
$contvueltas=0;

$llena=0;
$cont=1;
$conteje=100;
$totalger=array();
if ($existe==0) {
  $eje = "SELECT distinct Ejecutivo FROM Supervisor where Nombre='$nombre' or Ejecutivo='$nombre' or Gerencia='$nombre' or Monitoreo='$nombre'  order by Ejecutivo asc ";
}else{
   $eje = "SELECT distinct Nombre FROM Supervisor where Nombre='$nombre' or Ejecutivo='$nombre' or Gerencia='$nombre' or Monitoreo='$nombre'  order by Nombre asc ";
}


$eje = odbc_exec($conexion, $eje);
while($eje2 = odbc_fetch_object($eje))
{
$total=array();
$totalti=array();
$parti=array();
$tienfu=array();


if ($existe==0) {
  $sqlnom2 ="SELECT  *  FROM Supervisor WHERE  Ejecutivo='$eje2->Ejecutivo' order by Ruta asc ";
}else{
   $sqlnom2 ="SELECT  *  FROM Supervisor WHERE  Nombre='$eje2->Nombre' order by Ruta asc ";
}



$sqlnom2 = odbc_exec($conexion, $sqlnom2);
while ($rowus2 = odbc_fetch_object($sqlnom2))
{ 
  

            $comentarios=array();
       
            
          
            $sqlnom ="SELECT  *  FROM usuario WHERE dni='$rowus2->Ruta' and acceso='2' order by idusuario asc ";
            $idnom = odbc_exec($conexion, $sqlnom);
            while ($rowus = odbc_fetch_object($idnom))
            {   
                
                $nuevafecha=0;  
                $fechasum=$fecha;
                $dia=$fechd;

                
                //consultar clientes en ruta por dia
                $objdia = "SELECT idcliente as objdia FROM cliente WHERE $_dias[$dia]=1 and RutaVenta='$rowus->idusuario'";
                $objdia = odbc_exec($conexion, $objdia);
                $objetivos=array();
                while ($objdiat = odbc_fetch_object($objdia)) 
                {
                    $objetivos[]=$objdiat->objdia;
                }                     
                
                $inci= "SELECT ruta,comentario FROM incidencia WHERE fecha='$fechasum' and ruta='$rowus->idusuario'";
                $inci = odbc_exec($conexion, $inci);
                $inci1 = odbc_fetch_object($inci);
                $inci = odbc_num_rows($inci);

                
                if ($inci==0 or $inci1->comentario=="") {
                  $_ttiendas[]=count($objetivos);
                }else
                {
                  $_ttiendas[]=0;
                  
                  $comentarios['coment'][]=$inci1->comentario;

                  $incinom= "SELECT nombre FROM usuario WHERE idusuario='$inci1->ruta'";
                  $incinom = odbc_exec($conexion, $incinom);
                  $incinom1 = odbc_fetch_object($incinom);
                  $incinom = odbc_num_rows($incinom);
                                  
                  if ($incinom != 0) {
                    $comentarios['promo'][] = $incinom1->nombre;
                  }
                }

                

               if (count($objetivos)!=0) 
               {
                    //consultar visitas del dia 
                    $clirut = "SELECT  idcliente as id  from  actividad where FechaVisita='$fechasum' and idusuario='$rowus->idusuario' ";
                    $clirut = odbc_exec($conexion, $clirut);
                    $visitas=array();
                    while ($clirutt = odbc_fetch_object($clirut)) 
                        {
                            $visitas[]=$clirutt->id;
                        } 
                    $visitascom=array_diff($visitas, $objetivos);
                    $_razons[] =(count($visitas)-count($visitascom));
                    $_razons1[]=count($visitas);
                    $_razons2[]=count($visitascom);

               }else 
               {
                   
                  $_razons[] =0;
                  $_razons1[]=0;
                   $_razons2[]=0;

               }

                
              
                $obj[]=array_sum($_ttiendas);
                $vis[]=array_sum($_razons);
                $vis1[]=array_sum($_razons1);
                $vis2[]=array_sum($_razons2);
                $_razons = array();
                $_razons1 = array();
                  $_razons2 = array();
                $_ttiendas=array();

            }
            
            if ( array_sum($obj)!=0)
            {
              
              $todas=round(((array_sum($vis1)/array_sum($obj) )*180),2);
              $porc=round(((array_sum($vis1)/array_sum($obj) )*100),1);
              if ($todas>180) {
                $todas=180;
               
              }
              $todas=strval((($todas)));
              $tienfu[]=array_sum($vis2);
              $totalti[]=array_sum($obj);
              $parti[]=array_sum($vis);
              


             
              $pgrafica1[1][$llena]=round(((array_sum($vis)/ array_sum($obj))*100),1);
              $total[]=$pgrafica1[1][$llena];
              

              $todas=0;
              $porc=0;
             


            }else
            {
              
              $pgrafica1[1][$llena]=0;
               $total[]=0;
              
              
            }
            

            $vis=array();
            $vis1=array();
            $vis2=array();
            $obj=array();
            $llena++;
            $cont++;
  
}

$todas=round((array_sum($tienfu)+array_sum($parti))/array_sum($totalti)*180,2);

$totpor=round((array_sum($total)/count($total)),2); 
$texto=round((array_sum($tienfu)+array_sum($parti))/array_sum($totalti)*100,2);

$texto1=array_sum($parti).' tiendas de '.array_sum($totalti).'<br><font color="#333333">'.array_sum($tienfu).' V.F.Ruta '.$texto.'%</font>';


//echo "<script>graficarapp(".$totpor.",$conteje,'".$texto1."');flecha(".($todas).",".$conteje.");</script>";
$conteje=$conteje+1;


$totalger[]=array_sum($totalti);



}


return array_sum($totalger);
//echo "<tr><td><div id='container-speed' style='border: 1px solid #000; width: 300px; height: 200px; float: left'></div></div></td></tr>";
         
}

function objetivos($id,$dia,$conexion){  
  $objdia = "SELECT idcliente as objdia FROM cliente WHERE $dia=1 and RutaVenta='$id'";
  $objdia=odbc_exec($conexion,$objdia);
  $objdia=odbc_fetch_object($objdia);
  $res=count($objdia->objdia);
  return $res;
}

function grafgere($arre,$texto,$id)
{
//   




?>
  

    
    

    
    <style type="text/css">
    ${demo.css}
    </style>
    <script type="text/javascript">

        
    $(function () {
var arre=new Array();

        
        arre[0]=parseInt("<?php echo $arre[0]?>");
        arre[1]=parseInt("<?php echo $arre[5]?>");
        arre[2]=parseInt("<?php echo $arre[1]?>");
        arre[3]=parseInt("<?php echo $arre[2]?>");
        arre[4]=parseInt("<?php echo $arre[3]?>");
        arre[5]=parseInt("<?php echo $arre[4]?>");
        

        console.log(arre);

        
/*
        arre[0]=1;
        arre[1]=1;
        arre[2]=1;
        arre[3]=1;
        arre[4]=1;
        arre[5]=1;
        arre[6]=1;
        arre[7]=1;
        arre[8]=1;
        arre[9]=1;
        arre[10]=1;
        arre[11]=1;*/

        var texto =("<?php echo $texto?>");


        var id=parseInt("<?php echo $id?>");
        var conce=new Array();


conce= [
    "Activas ",
    "Objetivo",
    "Vac. Incap.",
    "Inci. Permiso. ",
    "Faltas ",
    "Sin Equip"
                
            ];

var tem=new Array();
var todo=new Array();
var j=0;
for (var i =0  ; i < arre.length; i++) {
 
 tem=Array();
 //if (arre[i]!=0) {
 tem[0]=conce[i];
 tem[1]=arre[i];

 todo[i]=tem;
 //j++;
//}
}

      

 

        
            
            
    $('#container'+id).highcharts({

        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: texto,
            align: 'center',
            verticalAlign: 'middle',
            y: 20
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: false,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white',
                        textShadow: '0px 1px 2px black'
                    }
                },
                startAngle: -90,
                endAngle: 90,
                center: ['50%', '75%']
            }
        },
        series: [{
            type: 'pie',
            name: '  ',
            innerSize: '70%',
            data: todo
        }]
    });
});
    </script>
  <body>
<!--<script src="../graficas/js/highcharts.js"></script>-->



<?php
}




function  fecha_ent($fecha)
{
  

  $datetime1 = new DateTime('1900-01-01');
  $datetime2 = new DateTime($fecha);
  $interval = $datetime1->diff($datetime2);
  $fechas= intval($interval->format('%a'))+2;
  return $fechas;
}
//tiendas por incidencia por ruta
function  incidencias($dni,$fecha,$conec)
{
  //$cateinci=["1","2","3","4","5","","","","",""];
  $arre=[0,0,0,0,0,0,0,0,0,0];

  $dia=dia_hoy($fecha);
  for ($codigo=1; $codigo <11 ; $codigo++) { 

    $sql="SELECT ruta from incidencia where dni='$dni' and codigoinci='$codigo' and fecha='$fecha'";
    $sql=odbc_exec($conec, $sql);
    $totales=array();
    while($sql1=odbc_fetch_object($sql))
    {
      $sql2="SELECT count(RutaVenta) as numero from cliente where RutaVenta='$sql1->ruta' and $dia='1' ";
      $sql2=odbc_exec($conec, $sql2);
      $sql2=odbc_fetch_object($sql2);
      
      $totales[]=$sql2->numero;
    }

    
    $arre[$codigo-1]=array_sum($totales);
  }
  return $arre;

}

//numero de incidencias por ruta
function no_inci($dni,$fecha,$conec){
   //$cateinci=["1","2","3","4","5","","","","",""];
  $arre=[0,0,0,0,0,0,0,0,0,0];

  $dia=dia_hoy($fecha);
  for ($codigo=1; $codigo <11 ; $codigo++) { 

    $sql="SELECT count(ruta)as ruta from incidencia where dni='$dni' and codigoinci='$codigo' and fecha='$fecha'";
    $sql=odbc_exec($conec, $sql);
    $sql=odbc_fetch_object($sql);
    $arre[$codigo-1]=$sql->ruta;

  }
  
  return $arre;

}


//devuelve el numero de descanssos por ruta 
function descansos($dni,$fecha,$conec)
{
  $descansos=array();
  $dia=dia_hoy($fecha);
  $sql="SELECT idusuario from usuario where dni='$dni' and acceso='2'";
  $sql=odbc_exec($conec, $sql);
  while($sql1=odbc_fetch_object($sql))
  {
    $sql2="SELECT RutaVenta from cliente where $dia='1' and RutaVenta='$sql1->idusuario' ";
    $sql2=odbc_exec($conec, $sql2);
    $sql2=odbc_num_rows($sql2);
    if ($sql2==0) {
      $descansos[]=1;
    }

  }
  return array_sum($descansos);
}
//cuenta devuelve 0 usuarios por tuta y 1 cuantos estan activos por ruta
function rut_act($dni,$fecha,$conec){
   $arre=[0,0];
   $sql="SELECT count(idusuario)as ruta from usuario where dni='$dni' and acceso='2'";
    $sql=odbc_exec($conec, $sql);
    $sql=odbc_fetch_object($sql);
    $arre[0]=$sql->ruta;

    $sql="SELECT idusuario from usuario where dni='$dni'";
    $sql=odbc_exec($conec, $sql);
    while($sql1=odbc_fetch_object($sql))
    {
      $sql2="SELECT count(idusuario) as id from actividad where idusuario='$sql1->idusuario' and FechaVisita='$fecha' ";
      $sql2=odbc_exec($conec, $sql2);
      $sql2=odbc_fetch_object($sql2);
      
      if($sql2->id>0)
      {
        $arre[1]++;
      }
    }
    $arre[0]=$arre[0]-descansos($dni,$fecha,$conec);
return $arre;
}

//devuelve el numero de tiendas por dia por promotor
function conf_desc($usu,$fecha,$conexion)
{
  $_dia=dia_hoy($fecha);

 $sql="SELECT count(Id_cliente) as des from cliente where $_dia='1' and [Id_ruta]='$usu' ";
  $sql=odbc_exec($conexion, $sql);
  $sql=odbc_fetch_object($sql);

  $sql->des;
  return $sql->des;

}


//devuelve las incidencias pordia de cada promotor
function tip_inci($usu,$fecha,$conexion){

  

      $inci="";
      $sql="SELECT codigoinci from incidencia where ruta='$usu' and fecha='$fecha'";
      $sql=odbc_exec($conexion, $sql);
      $sql=odbc_fetch_object($sql);
    
      switch (@$sql->codigoinci) {
    
        case '1':
        $inci="Vacaciones";
        
        break;
  
         case '2':
         $inci='Baja';
         
         break;
         case '3':
         $inci="Incapacidad";
         
         break;
         case '4':
         $inci="Permiso";
         
         break;
         case '5':
         $inci="Falta";
         
         break;
         case '6':
         $inci="Robo";
         
         break;
         case '7':
         $inci="Daño";
         
         break;
         case '8':
         $inci="Extravio";
         
         break;
         case '9':
         $inci="Incidencias";
         
         break;
         case '10':
         $inci="Trabajo sin aplicacion";
         
        break;

        case '11':
         $inci="Eqsinrecup";
         
        break;

        case '12':
         $inci="PromSinEquipo";
         
        break;

        case '13':
         $inci="Vacante";
         
        break;

        case '14':
         $inci="Festivo";
         
        break;

    
  
}

return $inci;
}



//de vuelve los dnis por usuario de la tabla supervisores
function dnis($usu,$conexion)
{
  
  $sql="SELECT  *  FROM Supervisor WHERE Gerencia='$usu' or Ejecutivo='$usu' or Monitoreo='$usu' or Nombre='$usu' or susu='$usu'  or susu1='$usu'  or susu2='$usu' order by Ruta asc ";
  $sql=odbc_exec($conexion, $sql);
  return $sql;
}



//devuelve si un promotor tiene alguna incidencia
function inci_prom($id,$fecha,$conexion)
{
  
  $sql="SELECT  count(Ruta) as rut  FROM incidencia WHERE ruta='$id' and fecha='$fecha'";
  $sql=odbc_exec($conexion, $sql);
  $sql=odbc_fetch_object($sql);
  return $sql->rut;
}



?>


<script type="text/javascript">
function insertinci(a,b,c,d,dni)
{
  e=document.getElementById("ta"+d).value;
  f=document.getElementById("in"+d).value;
  v=document.getElementById("sel"+d).value;
  switch(v){

    case "Nulo":
    v=0;
    break;

    case "Vacaciones":
    v=1;
    break;

    case "Baja":
    v=2;
    break;

    case "Incapacidad":
    v=3;
    break;

    case "Permiso":
    v=4;
    break;

    case "Falta":
    v=5;
    break;

    case "Robo":
    v=6;
    break;

    case "Daño":
    v=7;
    break;

    case "Extravio":
    v=8;
    break;

    case "Incidencias":
    v=9;
    break;

    case "Trabajo sin aplicacion":
    v=10;
    break;

    case "Eqsinrecup":
    v=11;
    break;

    case "PromSinEquipo":
    v=12;
    break;

    case "Vacante":
    v=13;
    break;

    case "Festivo":
    v=14;
    break;

  }




  
  if (v=="Seleccionar") {
    alert('Selecciona una opción');
  }else{

    msn=e.split(" ");
      msn=msn.join("(,)");
    window.open("../actual/insertinci.php?nombre="+a+"&telefono="+b+"&monitor="+f+"&fecha="+c+"&msn="+msn+"&dni="+dni+"&val="+v, "insidencias", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=600, height=200");


  }
  } 

  
function cambiar(id,texto)
{
  document.getElementById(id).innerHTML = texto;
}

  
  function flecha(porciento,id){
    if (porciento>180) {
        porciento=180;
    }
   
    document.getElementById(id).setAttribute("style","transform: rotate("+porciento+"deg);");

}

</script>


<script type="text/javascript">
<!--
/* This script and many more are available free online at
The JavaScript Source!! http://javascript.internet.com
Created by: Saul Salvatierra :: http://myarea.com.sapo.pt
with help from Ultimater :: http://ultimiacian.tripod.com */

var theObj="";

function toolTip1(text,me,a) {
theObj=me;
b='toolTipBox'+a;
//text=text.replace(/,/gi,"<br>"); 

theObj.onmousemove=updatePos;
document.getElementById(b).innerHTML=text;
document.getElementById(b).style.display="block";
window.onscroll=updatePos;
}

function updatePos() {
var ev=arguments[0]?arguments[0]:event;
var x=ev.clientX;
var y=ev.clientY;
diffX=-130;
diffY=20;
document.getElementById(b).style.top = y-2+diffY+document.body.scrollTop+ "px";
document.getElementById(b).style.left = x-2+diffX+document.body.scrollLeft+"px";
theObj.onmouseout=hideMe;
}
function hideMe() {
document.getElementById(b).style.display="none";
}
-->
</script>