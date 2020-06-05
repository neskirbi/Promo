<?php
    $title ="Tickets | ";
    include "head.php";
    include "sidebar.php";
    //nota en el head esta el conect db
?>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->              
            <div class="page-title"><!--- --->
              <div class="title_left">
                <h3>Dias totales <small>muestra de resultados</small></h3>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row"><!--- --->
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Diseño <small>HD dias totales</small></h2>
                
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h1>
                                          <i class="fa fa-globe"> Nomina</i> <!--- Periordo. --->
                                          <small class="pull-right">Fecha: <?php echo date("d/m/Y"); ?></small>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          De
                          <address>
                                          <strong>RH 1</strong>
                                          <br>795 Freedom Ave, Suite 600
                                          <br>New York, CA 94107
                                          <br>Phone: 1 (804) 123-9876
                                          <br>Email: ironadmin.com
                                      </address>
                        </div>
            
                        <div class="col-sm-4 invoice-col">
                          Para
                          <address>
                                          <strong>RH 2</strong>
                                          <br>795 Freedom Ave, Suite 600
                                          <br>New York, CA 94107
                                          <br>Phone: 1 (804) 123-9876
                                          <br>Email: jon@ironadmin.com
                                      </address>
                        </div>
                     
                        <div class="col-sm-4 invoice-col">
                          <b>Invoice #007612</b>
                          <br>
                          <br>
                          <b>Order ID:</b> 4F3S8J
                          <br>
                          <b>Payment Due:</b> 2/22/2014
                          <br>
                          <b>Account:</b> 968-34567
                        </div>
                       
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
<?php     
//solo lo que corresponde al que se logeo ...falta moverle el id usuaro por otra cosa
//$result = sqlsrv_query($conn, "SELECT * FROM usuario WHERE Id_usuario=".$_SESSION['Id_usuario']." ORDER BY Id_usuario DESC");

        $sql = "SELECT * FROM usuario ORDER BY Id_usuario ASC";
        $result = sqlsrv_query($conn, $sql);
//$result = sqlsrv_query($conn, "SELECT * FROM usuario ORDER BY Id_usuario DESC");  

?>                      
                      <div class="row">
                        <div class="col-xs-12 table">
                          <table id="datatable" class="table table-striped table-bordered">
                            <!--- thead>
                              <tr>
                                <th>id</th>
                                <th>Empleado</th>
                                <th>Días</th>
                                <th>Description</th>
                                <th>Subtotal</th>
                                <th>Total</th>
                                <th>Info</th>
                              </tr>
                            </thead --->
                            <thead>
                              <tr>
                              <th>id</th>
                              <th>Empleado</th>
                              <th>Días*</th>
                              <th>D. Descanso</th>
                              <th>D. Adicionales*</th>
                              <th>D. Descanso Ad</th>
                              <th>D. Totales</th>
                              <th>Sueldo Diario*</th>
                              <th>Sueldo</th>
                              <th>Pasaje Dirario*</th>
                              <th>Pasajes</th>
                              <!---th>Pasaje Monto</th --->
                              <th>Incentivo*</th>
                              <th>Total</th>
                              <th>Info</th>
                              </tr>
                            </thead>
                            <tbody>

  <?php  
  while($usuario = sqlsrv_fetch_array($result)) {   
  $idusuario=$usuario['idusuario'];
  $foto=$usuario['foto'];
  $us_nombre_real=utf8_encode($usuario['us_nombre_real']);
  $ruta=$usuario['ruta'];
  $puesto=$usuario['puesto'];
  $NoEmpleado=$usuario['ucfdi'];
  $incentivo=$usuario['incdia'];
  $usuario_pago=$usuario['pago'];
  $dias_trabajados=$usuario['dias_trabajados'];
 $dias_adicionales=$usuario['dias_adicionales'];
$sueldos=$usuario['sueldos'];
$pasajes=$usuario['Pasajes'];

$sql = sqlsrv_query($conn, "select * from puesto where id=$puesto");
                            if($c=sqlsrv_fetch_array($sql)) {
                                $puesto_descripcion=$c['descripcion'];
                      
                            } 

$total+=$usuario['incdia'];                          
$total_us_pago+=$usuario['pago'];
$total_us_dias_trabajados+=$usuario['dias_trabajados'];  
$total_us_dias_adicionales+=$usuario['dias_adicionales']; 
$total_us_sueldos+=$usuario['sueldos']; 
$suma_de_todo+=$total_suma_final;
//operadores
$OneDivSix = 1/6;
$toatels_trabajados = ($dias_adicionales+($dias_adicionales*($OneDivSix)))+($dias_trabajados+($dias_trabajados*($OneDivSix)));
$totales_adicionales = $dias_adicionales*($OneDivSix);
$totales_trabj_sueld = $toatels_trabajados*$sueldos;
$dias_descanso = $dias_trabajados*($OneDivSix);
$pasaje_total= $toatels_trabajados*$pasajes;
$pasaje_monto= 50*$pasaje_total;
$total_suma_final = $totales_trabj_sueld+$incentivo+$pasaje_total;

$suma_pasaje_total+=$pasaje_total;
$suma_totales_trabj_sueld+=$totales_trabj_sueld;
    ?>

                              <tr>
                                <td><?php echo $idusuario; ?></td>
                                <td><?php echo $us_nombre_real;  ?></td>
                                <td class="text-center"><?php echo $dias_trabajados;  ?></td>
                                <td><?php echo  number_format($dias_descanso, 2, ".", ","); ?></td>
                                <td><?php echo  $dias_adicionales;  ?></td>
                                <td><?php echo  number_format($totales_adicionales, 2, ".", ",");  ?></td>
                                <td><?php echo  number_format($toatels_trabajados, 2, ".", ","); ?></td>
                                <td>$<?php echo  number_format($sueldos,2, ".", ","); ?></td>
                                <td>$<?php echo number_format($totales_trabj_sueld, 2, ".", ","); ?></td>

                                <td>$<?php echo number_format($pasajes, 2, ".", ","); ?></td>
                                <td>$<?php echo number_format($pasaje_total, 2, ".", ","); ?></td>
                              <?php /* <td>$<?php echo number_format($pasaje_monto, 2, ".", ","); ?></td> */ ?>
                                <td>$<?php echo $incentivo; ?></td>
                                <td>$<?php echo number_format($total_suma_final, 2, ".", ","); ?></td>
<?php /* echo "<td><a href=\"dias_totales_edit.php?idusuario=$idusuario\" title='Info'><i class='glyphicon glyphicon-info-sign'></i></a></td>"; */ ?>
<td><a href="#" title="Info"><i class="glyphicon glyphicon-info-sign"></i></a></td>

                              </tr>
<?php } ?>                              
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                          <p class="lead">Metodo de Pago:</p>
                          <img src="images/visa.png" alt="Visa">
                          <img src="images/mastercard.png" alt="Mastercard">
                          <img src="images/american-express.png" alt="American Express">
                          <img src="images/paypal.png" alt="Paypal">
                          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                          </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                          <p class="lead">Monto Suma Total <?php echo date("d/m/Y"); ?></p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Subtotal Sueldo:</th>
                                  <td>$<?php echo number_format($suma_totales_trabj_sueld, 2, ".", ","); ?></td>
                                </tr>
                                <tr>
                                  <th>Pasaje:</th>
                                  <td>$<?php echo number_format($suma_pasaje_total, 2, ".", ","); ?></td>
                                </tr>
                                <tr>
                                  <th>Incentivos:</th>
                                  <td>$<?php echo number_format($total, 2, ".", ","); ?></td>
                                </tr>
                                <tr>
                                  <th>Total:</th>
                                  <td>$<?php echo number_format($suma_de_todo, 2, ".", ","); ?></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12 no-print">
                          <button class="btn btn-success pull-right no-print" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                          
                         
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div><!--- --->
   




<!----------------------------------------------------------------------------------------------------------------------------------------------------->          
<?php include "footer.php" ?>