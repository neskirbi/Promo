<?php
    $title ="Tickets | ";
    include "head.php";
    include "sidebar.php";
?>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->             <div class="page-title"><!--- --->
              <div class="title_left">
                
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row"><!--- --->
              <div  valign="middle" style="width:95%; margin:0 auto;">
                <div class="x_panel">
                  <div class="x_title">
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h3>
                          <i class="fa fa-globe"> Head Count <small>MARS</small></i> <!--- Periordo. --->
                          </h3>
                        </div>
                        <!-- /.col -->
                      </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
<?php     
//solo lo que corresponde al que se logeo ...falta moverle el id usuaro por otra cosa
//$result = sqlsrv_query($conn, "SELECT * FROM usuario WHERE Id_usuario=".$_SESSION['Id_usuario']." ORDER BY Id_usuario DESC");

	     //session_start();        
         $id= $_SESSION['user_log']; 
	  echo $id;
	//solo lo que corresponde al que se logeo ...falta moverle el id usuaro por otra cosa
	$resultusu = sqlsrv_query($conn, "SELECT * FROM usuaripsPromo WHERE nombre='$id'");
	If($c=sqlsrv_fetch_array($resultusu)) 
	{
            $zonausu=$c['zona'];							
    } 



        $sql = "SELECT * FROM usuario";
        $result = sqlsrv_query($conn, $sql);
//$result = sqlsrv_query($conn, "SELECT * FROM usuario ORDER BY Id_usuario DESC");  

?> 



                    <section class="content invoice">
                      <!-- title row -->
         

                      <div class="row">
                        <div class="col-xs-12 table">                 
<table class="table table-responsive jambo_table table-striped table-bordered bulk_action">
  <!--- id="datatable" --->
<thead>  

        <th>Canal</th>
        <th>Puesto</th>
        <th class="text-center">Autorizados</th>
        <th class="text-center">Activos</th>
        <th class="text-center">Vacantes</th>
     <!--   <th class="text-center">Smartphones</th>
        <th class="text-center">Laptops</th>
   -->
   
</thead>    
    <?php
    $sql123 = "
    with total as(
      select us.canal, us.puesto, count(*) as [Rutas]
      from usuarionom us
      where us.us_nombre_real NOT LIKE '%VACANTE%' and us.puesto !='8' and us.dni != 'P0'
      group by us.canal, us.puesto),
    smartphone as (
      select us.canal, us.puesto, count(*) as [Smartphone]
      from usuarionom us
      where us.cuenta_smart LIKE '%Si%' and us.dni != 'P0'
      group by us.canal, us.puesto),
    laptop as (
      select us.canal, us.puesto, count(*) as [Laptops]
      from usuarionom us
      where us.Laptop LIKE '%Si%' and us.us_nombre_real NOT LIKE '%VACANTE%' and us.dni != 'P0'
      group by us.canal, us.puesto),

    pruebaRutas   as (SELECT count(*) as [Rutas]   FROM usuarionom us WHERE us.dni = 'P0'),
    pruebaEquipos as (SELECT count(*) as [Equipos] FROM usuarionom us WHERE us.dni = 'P0' and us.cuenta_smart LIKE '%Si%'),
    pruebaLaptops as (SELECT count(*) as [Laptops] FROM usuarionom us WHERE us.dni = 'P0' and us.Laptop LIKE '%Si%'),

    vacantes as (
      select us.canal, us.puesto, count(*) as [Vacantes]
      from usuarionom us
      where us.us_nombre_real LIKE '%VACANTE%' and us.dni != 'P0'
      group by us.canal, us.puesto),
    autorizados as (
      select us.canal, us.puesto, count(*) as [Autorizados]
      from usuarionom us
      WHERE us.dni != 'P0'
      group by us.canal, us.puesto)

        select cn.[descripcion] as [canal], pt.[descripcion] as [Puesto] ,
        tt.[Rutas] as [Activos], --tt.[Rutas]
    CASE WHEN vc.[Vacantes] IS NULL THEN 0 ELSE vc.[Vacantes] END as [Vacantes],
    CASE WHEN au.[Autorizados] IS NULL THEN 0 ELSE au.[Autorizados] END as [Autorizados],
     --tt.[Rutas]
    CASE WHEN sm.smartphone IS NULL THEN 0 ELSE
    sm.smartphone
    END as [Smartphone],
    CASE WHEN lp.Laptops IS NULL THEN 0 ELSE
    lp.Laptops
    END as [Laptops]
    from total tt
    left join canal cn on cn.id = tt.canal
    left join puesto pt on pt.id = tt.puesto
    left join smartphone sm on sm.canal = tt.canal and sm.puesto = tt.puesto
    left join vacantes vc on vc.canal = tt.canal and vc.puesto = tt.puesto
    left join laptop lp on lp.canal = tt.canal and lp.puesto = tt.puesto
    left join autorizados au on au.canal = tt.canal and au.puesto = tt.puesto
    UNION SELECT 'Prueba' as [canal], 'Prueba' as [Puesto], 0 as [Activos], 0 as [Vacantes], 0 as [Autorizados], (SELECT * FROM pruebaEquipos) as [Equipos], (SELECT * FROM pruebaLaptops) as [Laptops]
    order by cn.descripcion asc, pt.descripcion asc
";//NOTA!!!! CAMBIAR ESTO A ALGO MAS DIGERIBLE !!! EL SQL123 NO ES COMPLICADO PERO VA A ARRASTRAR MUCHOS PROBLEMAS A LARGO PLAZO
//DIVIDIR EN 3 QUERRYS 

$sql123="Select
      channel.descripcion As canal,
      position.descripcion As Puesto,
      Count(*) As Autorizados,
      Count(Case
          When usuarios.us_nombre_real != 'VACANTE'
          Then 1
          Else Null
      End) As Activos,
      Count(Case
          When usuarios.us_nombre_real = 'VACANTE'
          Then 1
          Else Null
      End) As Vacantes,
      Count(Case
          When usuarios.Laptop = 'Si' 
          Then 1
          Else Null
      End) As Laptops,
      Count(Case
          When usuarios.cuenta_smart = 'Si' 
          Then 1
          Else Null
      End) As Smartphone
  From
      dbdds.dbo.usuarionom usuarios Inner Join
      dbdds.dbo.canal channel On channel.id = usuarios.canal Inner Join
      dbdds.dbo.puesto position On position.id = usuarios.puesto
  Where
      usuarios.dni Is Not Null and usuarios.gafete ='B' and
        usuarios.dni in ('".str_replace(",","','",$zonausu)."') And
    usuarios.us_nombre_real != 'CERRADA'
  Group By
      channel.descripcion,
      position.descripcion
  Order By
      canal,
      Puesto";

    $result123 = sqlsrv_query($conn, $sql123);
    $total = array('Activos' => 0,'Vacantes' => 0, 'Autorizados' => 0, 'Smartphone' => 0, 'Laptops' => 0); 
    while ($row = sqlsrv_fetch_array($result123)) {
$canal_1=$row['canal']; //sale de usuarios canal(id) donde id= canal de tasbla canal
$Puesto_1=$row['Puesto'];//puesto(id) de usuarios id=  descripcion de tabla puesto (se le puso mayuscula pára encontrarlo en el sql)
$autorizado_1=$row['Autorizados'];//suma de puestos, se juega con este dato para conseguir el No. de +puestos de cada canal
$Activos_1=$row['Activos'];
$Vacantes_1=$row['Vacantes'];
$Smartphone_1=$row['Smartphone'];
$Lapdops_1=$row['Laptops'];
        ?>
      </tbody>  
        <tr>
            <td><?php echo $canal_1; ?></td>
            <td><?php echo $Puesto_1; ?></td>
            <td class="text-center"><?php echo $autorizado_1; $total['Autorizados'] += $row['Autorizados']?></td>
            <td class="text-center"><?php echo $Activos_1; $total['Activos'] += $row['Activos']?></td>
            <td class="text-center"><?php echo $Vacantes_1; $total['Vacantes'] += $row['Vacantes']?></td>
            
     		</tr>
        <?php
    }
    ?>
    <tr>
        <td></td>
        <td><b>Total</b></td>
        <td class="text-center"><b><?php echo $total['Autorizados'] ?></b></td>
        <td class="text-center"><b><?php echo $total['Activos'] ?></b></td>
        <td class="text-center"><b><?php echo $total['Vacantes'] ?></b></td>
        
       
    </tr>
    </tbody>
</table>
</div><!-- /.col -->
</div><!-- /.row -->

                      

                  
                    </section>
                  </div>
                </div>
              </div>
            </div>  

<!------------> 
<?php ?>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->          
<?php include "footer.php" ?>