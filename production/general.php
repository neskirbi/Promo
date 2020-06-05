<?php
include"../conexion/conexion.php";
    $title ="Tickets | ";
    include "head.php";
    include "sidebar.php";
?>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->              


<?php
//include("../metodos/metodos1.php");
include("../conexion/conexion.php");
header("Content-Type: text/html;charset=utf-8");


function getRegiones($conexion)
{
    $sql = "SELECT * FROM regiones";
    $res = odbc_exec($conexion, $sql);
    $results = array();
    while ($row = odbc_fetch_array($res)) {
        $results[] = $row;
    }
    return $results;
}

$fecha_inicio = '';
$fecha_final = '';
if (isset($_POST["fecha_ini"])) {
    $fecha_inicio = $_POST['fecha_ini'];
} else {
    $fecha_inicio = date('Y-m-01', strtotime(date("Y-m-d")));
}

if (isset($_POST["fecha_fin"])) {
    $fecha_final = $_POST['fecha_fin'];
} else {
    $fecha_final = date('Y-m-t', strtotime(date("Y-m-d")));
}

if (isset($_POST['is_submitted'])) {
    $id_ruta = $_POST['is_submitted'];  //ID de ruta
    $region = $_POST['region'];
    if ($region != '0') {
        $sql_update = "UPDATE usuario SET us_region = $region WHERE id_ruta = $id_ruta";
        odbc_exec($conexion, $sql_update);
    } else {
        echo '<script type="text/javascript"> window.alert("La region no puede ser \'Empty\'") </script>';
    }
    //$sql = "UPDATE usuario SET $sql_foto_update us_nombre_real = '$nombre_promotor' WHERE Id_ruta = '$id_ruta'";
}
?>


<div class="table-responsive-md" align="center">
    <table class="table table-striped">
        <tr>
            <th class="col-md-1">Canal</th>
            <th class="col-md-1">Puesto</th>
            <th class="col-md-1">Autorizados</th>
            <th class="col-md-1">Activos</th>
            <th class="col-md-1">Vacantes</th>
            <th class="col-md-1">Smartphone</th>
            <th class="col-md-1">Laptops</th>
        </tr>
        <?php
        $sql = "
with total as(
      select us.canal, us.puesto, count(*) as [Rutas] from usuario us
      where us.us_nombre_real NOT LIKE '%VACANTE%' and us.dni != 'P0'
      group by us.canal, us.puesto),
    smartphone as (
      select us.canal, us.puesto, count(*) as [Smartphone]
      from usuario us
      where us.cuenta_smart LIKE '%Si%' and us.dni != 'P0'
      group by us.canal, us.puesto),
    laptop as (
      select us.canal, us.puesto, count(*) as [Laptops]
      from usuario us
      where us.Laptop LIKE '%Si%' and us.us_nombre_real NOT LIKE '%VACANTE%' and us.dni != 'P0'
      group by us.canal, us.puesto),
    pruebaRutas as (SELECT count(*) as [Rutas] FROM usuario us WHERE us.dni = 'P0'),
    pruebaEquipos as (SELECT count(*) as [Equipos] FROM usuario us WHERE us.dni = 'P0' and us.cuenta_smart LIKE '%Si%'),
    pruebaLaptops as (SELECT count(*) as [Laptops] FROM usuario us WHERE us.dni = 'P0' and us.Laptop LIKE '%Si%'),
    vacantes as (select us.canal, us.puesto, count(*) as [Vacantes]
      from usuario us
      where us.us_nombre_real LIKE '%VACANTE%' and us.dni != 'P0'
      group by us.canal, us.puesto),
    autorizados as (select us.canal, us.puesto, count(*) as [Autorizados]
      from usuario us
      WHERE us.dni != 'P0'
      group by us.canal, us.puesto)

      select cn.[descripcion] as [Canal], pt.[descripcion] as [Puesto],
    tt.[Rutas] as [Activos], --tt.[Rutas]
    CASE WHEN vc.[Vacantes] IS NULL THEN 0 ELSE vc.[Vacantes] END as [Vacantes],
    CASE WHEN au.[Autorizados] IS NULL THEN 0 ELSE au.[Autorizados] END as [Autorizados], --tt.[Rutas]
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
";
        $result = odbc_exec($conexion, $sql);
        $total = array('Activos' => 0, 'Vacantes' => 0, 'Autorizados' => 0, 'Smartphone' => 0, 'Laptops' => 0);
        while ($row = odbc_fetch_array($result)) {
            ?>
            <tr>
                <td><?php echo $row['Canal'] ?></td>
                <td><?php echo $row['Puesto']; ?></td>
                <td><?php echo $row['Autorizados'];
                    $total['Autorizados'] += $row['Autorizados'] ?></td>
                <td><?php echo $row['Activos'];
                    $total['Activos'] += $row['Activos'] ?></td>
                <td><?php echo $row['Vacantes'];
                    $total['Vacantes'] += $row['Vacantes'] ?></td>
                <td><?php echo $row['Smartphone'];
                    $total['Smartphone'] += $row['Smartphone'] ?></td>
                <td><?php echo $row['Laptops'];
                    $total['Laptops'] += $row['Laptops'] ?></td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td></td>
            <td><b>Total</b></td>
            <td><b><?php echo $total['Autorizados'] ?></b></td>
            <td><b><?php echo $total['Activos'] ?></b></td>
            <td><b><?php echo $total['Vacantes'] ?></b></td>
            <td><b><?php echo $total['Smartphone'] ?></b></td>
            <td><b><?php echo $total['Laptops'] ?></b></td>
        </tr>
    </table>
</div>





<?php
/**
 * Created by PhpStorm.
 * User: nztr
 * Date: 05/12/2017
 * Time: 17:16
 */
/*
$result = dnis($_COOKIE['login'], $conexion);
$request = "";
while (odbc_fetch_row($result)) {
    $request = $request . "'" . odbc_result($result, "Ruta") . "'" . ",";
}
$request = substr($request, 0, -1);
$sql = "SELECT Id_usuario FROM usuario WHERE dni in ($request)";
$res2 = odbc_exec($conexion, $sql);

$usuarios = "";
while (odbc_fetch_row($res2)) {
    $usuarios = $usuarios . odbc_result($res2, "Id_usuario") . ",";
}

$usuarios = substr($usuarios, 0, -1);
//include "../../helpdesk/app/index.php?usuarios=$usuarios";
//<li><a href="../../helpdesk/app/kpi.php?id=' . $id_usuario . '&programa=jti" target="frame_a">Seguimiento incidencias</a></li>
//echo '<iframe src="../../helpdesk/promotores.php?usuarios=' . $usuarios . '&programa=jti" height="100%" width="100%" frameborder="0px"></iframe>'
$sql_nuevo = "
SELECT ROW_NUMBER() OVER (ORDER BY cast(us.Id_usuario as int) ASC) as RowNumber,
us.Id_usuario as 'Id-ruta',
us.us_nombre as 'Ruta',
us.us_apellidos as 'Ciudad',
us.us_telefono,
us.mail,
us.us_nombre_real as 'Nombre Promotor',
canal.descripcion as 'Canal',
puesto.descripcion as 'Puesto',
us.foto as 'Foto',
sp.Nombre 'ID-Supervisor',
us2.us_nombre_real as 'Nombre Supervisor',
CASE WHEN sc.tipo = 1 THEN us.fechaalta --Activo
   WHEN sc.tipo = 2 THEN NULL--Vacante
   ELSE us.fechaalta
END as 'Fecha de Alta',
rg.region as 'region',
CASE WHEN sc.tipo = 1 THEN (SELECT COUNT(*) FROM incidencia inc WHERE inc.ruta = us.Id_usuario and inc.codigoinci = 5) --Activo
   WHEN sc.tipo = 2 THEN 0--Vacante
   ELSE (SELECT COUNT(*) FROM incidencia inc WHERE inc.ruta = us.Id_usuario and inc.codigoinci = 5)
   END as 'Faltas acumuladas',

   CASE WHEN sc.tipo = 1 THEN (SELECT COUNT(*)
  FROM incidencia inc
  WHERE inc.codigoinci = 4
  and inc.fecha BETWEEN '$fecha_inicio' and '$fecha_final' and ruta = us.Id_usuario) --Activo
   WHEN sc.tipo = 2 THEN 0--Vacante
   ELSE (SELECT COUNT(*)
  FROM incidencia inc
  WHERE inc.codigoinci = 4
  and inc.fecha BETWEEN '$fecha_inicio' and '$fecha_final' and ruta = us.Id_usuario)
  END
 as 'Permisos',
 CASE WHEN sc.tipo = 1 THEN (SELECT COUNT(*) FROM incidencia inc WHERE inc.ruta = us.Id_usuario and inc.codigoinci = 5 and inc.fecha BETWEEN '$fecha_inicio' and '$fecha_final') --Activo
   WHEN sc.tipo = 2 THEN 0--Vacante
   WHEN sc.tipo = 7 THEN 0--Ruta Cerrada
   ELSE (SELECT COUNT(*) FROM incidencia inc WHERE inc.ruta = us.Id_usuario and inc.codigoinci = 5 and inc.fecha BETWEEN '$fecha_inicio' and '$fecha_final')
   END as 'Faltas',
CASE WHEN sc.tipo = 1 THEN 'Activo'
   WHEN sc.tipo = 2 THEN 'Vacante'
   WHEN sc.tipo = 7 THEN 'Ruta Cerrada'
END as Vacante,
CASE WHEN sc.tipo = 2 THEN DATEDIFF(DAY, sc.fecha, GETDATE())
  ELSE NULL
END as 'Dias Vacante',
us.cuenta_smart as 'Movil',
us.Laptop as 'Laptop',
us.Comenta as 'Comentario',
us.gafete as 'Gafete',
us.fecha_entrega as 'Fecha de entrega'
FROM usuario us
LEFT JOIN supervisor sp on sp.Ruta = us.dni         -- Obtiene el supervisor de cada DNI
LEFT JOIN usuario us2 on sp.Nombre = us2.us_nombre and us2.dni != 'T3'-- Obtiene el
LEFT JOIN regiones rg on rg.id = us.us_region
LEFT JOIN canal canal on canal.id = us.canal
LEFT JOIN puesto puesto on puesto.id = us.puesto
OUTER APPLY (SELECT TOP 1 * FROM seguimiento_cambios sc WHERE sc.Id_usuario = us.Id_usuario and (sc.tipo = 1 or sc.tipo = 2 or sc.tipo = 7) ORDER BY sc.id DESC) sc
WHERE us.dni != 'P0'
--and us.dni != 'T3'--oculta usuario de prueba.
ORDER BY us.dni ASC, us.Id_tipouser ASC,cast(us.Id_usuario as int) ASC
";
$resultado = odbc_exec($conexion, $sql_nuevo);
echo '<table border="1" class="table">
    <tr>
        <th>Id-ruta</th>
        <th>Ruta</th>
        <th>Ciudad</th>
        <th>Telefono</th>
        <th>Email</th>
        <th>Nombre promotor</th>
        <th>Canal</th>
        <th>Puesto</th>
        <th>Foto</th>
        <th>ID-Supervisor</th>
        <th>Nombre Supervisor</th>
        <th>Fecha alta</th>
        <th>Faltas acumuladas</th>
        <th>Permisos</th>
        <th>Faltas</th>
        <th>Region</th>
        <th>Vacante/Activo</th>
        <th>Tiempo Vacante</th>
        <th>Cuenta con Smartphone</th>
        <th>Cuenta con Laptop</th>
        <th>Gafete</th>
        <th>Fecha de entrega</th>
    </tr>';
while (odbc_fetch_row($resultado)) {
    echo '<form action="promotores.php" method="post" enctype="multipart/form-data">';
    echo '<input type="hidden" value="' . odbc_result($resultado, "Id-ruta") . '" name="is_submitted">';
    echo '<tr>';
    //echo '<td>' . odbc_result($resultado, "RowNumber") . '</td>';
    echo '<td>' . odbc_result($resultado, "Id-ruta") . '</td>';
    echo '<td>' . odbc_result($resultado, "Ruta") . '</td>';
    echo '<td>' . utf8_encode(odbc_result($resultado, "Ciudad")) . '</td>';
    echo '<td>' . odbc_result($resultado, "us_telefono") . '</td>';
    echo '<td>' . odbc_result($resultado, "mail") . '</td>';
    echo '<td>' . utf8_encode(odbc_result($resultado, "Nombre Promotor")) . '</td>';
    echo '<td>' . odbc_result($resultado, "Canal") . '</td>';
    echo '<td>' . odbc_result($resultado, "Puesto") . '</td>';
    echo '<td> <img src="' . odbc_result($resultado, "foto") . '" alt="" height=100 width=100/></td>';
    echo '<td>' . odbc_result($resultado, "ID-Supervisor") . '</td>';
    echo '<td>' . utf8_encode(odbc_result($resultado, "Nombre Supervisor")) . '</td>';
    echo '<td>' . odbc_result($resultado, "Fecha de alta") . '</td>';
    echo '<td>' . odbc_result($resultado, "Faltas acumuladas") . '</td>';
    echo '<td>' . odbc_result($resultado, "Permisos") . '</td>';
    echo '<td>' . odbc_result($resultado, "Faltas") . '</td>';
    echo '<td>' . odbc_result($resultado, "region") . '</select></td>';//Region
    echo '<td>' . odbc_result($resultado, "Vacante") . '</td>';//Vacante / Activo
    echo '<td>' . odbc_result($resultado, "Dias Vacante") . '</td>';//Dias vacante
    echo '<td>' . odbc_result($resultado, "Movil") . '</td>';//Cuenta con smart
    echo '<td>' . odbc_result($resultado, "Laptop") . '</td>';//Cuenta con Laptop
    echo '<td>' . odbc_result($resultado, "Gafete") . '</td>';//Cuenta con Gafete
    echo '<td>' . odbc_result($resultado, "Fecha de entrega") . '</td>';//Fecha de entrega de gafete
    //echo '<td>' . odbc_result($resultado, "Comentario") . '</td>';//Comentario
    //echo '<td> <input type="submit" value="Actualizar"> </td>';
    echo '</tr>';
    echo '</form>';
}
echo '</table>';
*/
?>


<!----------------------------------------------------------------------------------------------------------------------------------------------------->          
<?php include "footer.php" ?>